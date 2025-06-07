<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use App\Notifications\UserActivationNotification;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    protected $participation_fee;
    protected $cloudinary;
    protected $score;

    public function __construct(CloudinaryService $cloudinary, ProfileScoreService $score)
    {
        $setting = Setting::where('singleton_key', 'main')->first();
        $this->participation_fee = $setting->participation_fee;
        $this->cloudinary = $cloudinary;
        $this->score = $score;
    }

    public function showAll(string $role)
    {
        return User::where('role', $role)->orderBy('created_at', 'desc')->get();
    }

    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    public function create(Request $data, string $role = 'guest', bool $is_active = false)
    {
        $user = User::create([
            'name'          => $data->name,
            'first_name'    => $data->first_name,
            'phone'         => $data->phone,
            'email'         => $data->email,
            'password'      => Hash::make('password'),
            'role'          => $role,
            'is_active'     => $is_active,
        ]);

        if (isset($data->profile_photo) && $data->profile_photo instanceof UploadedFile) {

            $filePath = $data->file('profile_photo')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $user->update([
                'profile_photo' => $uploadResult['secure_url'] ?? null,
            ]);
        }

        $user->update([
            'password' => Hash::make(strtolower($user->personal_code)),
        ]);

        if($user->is_active && !$user->is_welcomed_message_sent) {
            $user->notify(new UserActivationNotification($user));
            $user->is_welcomed_message_sent = true;
            $user->save();
        }

        $this->score->store($user);

        return $user;
    }

    public function update(int $id, Request $data)
    {
        $user = $this->show($id);

        $user->update([
            'name'       => $data->name ?? $user->name,
            'first_name' => $data->first_name ?? $user->first_name,
            'phone'      => $data->phone ?? $user->phone,
            'bio'        => $data->bio ?? $user->bio,
            'role' => $data->role ?? $user->role,
        ]);

        if (isset($data->profile_photo) && $data->profile_photo instanceof UploadedFile) {
            $oldImagePath = $user->profile_photo;

            $filePath = $data->file('profile_photo')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $user->update([
                'profile_photo' => $uploadResult['secure_url'] ?? null,
            ]);

            if ($oldImagePath) {
                $publicId = $this->cloudinary->extractPublicId($oldImagePath);
                $this->cloudinary->delete($publicId);
            }
        }

        if($user->role != 'guest' && !$user->is_active) {
            $user->update([
                'is_active' => true,
            ]);
        }

        if($user->is_active && !$user->is_welcomed_message_sent) {
            $user->notify(new UserActivationNotification($user));
            $user->is_welcomed_message_sent = true;
            $user->save();
        }

        $this->score->store($user);

        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->show($id);

        if ($user->profile_photo) {
            $publicId = $this->cloudinary->extractPublicId($user->profile_photo);
            $this->cloudinary->delete($publicId);
        }

        if ($user->payments->isNotEmpty()) {
            foreach ($user->payments as $payment) {
                $payment->delete();
            }
        }

        return $user->delete();
    }

    public function updateProfilePhoto(int $id, Request $data)
    {
        $user = $this->show($id);

        if (isset($data->profile_photo) && $data->profile_photo instanceof UploadedFile) {
            $oldImagePath = $user->profile_photo;

            $filePath = $data->file('profile_photo')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $user->update([
                'profile_photo' => $uploadResult['secure_url'] ?? null,
            ]);

            if ($oldImagePath) {
                $publicId = $this->cloudinary->extractPublicId($oldImagePath);
                $this->cloudinary->delete($publicId);
            }
        }

        $this->score->store($user);

        return $user;
    }

    public function updateBannerImage(int $id, Request $data)
    {
        $user = $this->show($id);

        if (isset($data->banner_image) && $data->banner_image instanceof UploadedFile) {
            $oldImagePath = $user->banner_image;

            $filePath = $data->file('banner_image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $user->update([
                'banner_image' => $uploadResult['secure_url'] ?? null,
            ]);

            if ($oldImagePath) {
                $publicId = $this->cloudinary->extractPublicId($oldImagePath);
                $this->cloudinary->delete($publicId);
            }
        }

        $this->score->store($user);

        return $user;
    }

    public function toggleActive(int $id)
    {
        $user = $this->show($id);
        $user->is_active = !$user->is_active;
        $user->save();

        if($user->is_active && !$user->is_welcomed_message_sent) {
            $user->notify(new UserActivationNotification($user));
            $user->is_welcomed_message_sent = true;
            $user->save();
        }

        return $user;
    }

    public function updatePaymentStatus(int $id, int $amount = null, int $oldAmount = null, string $action)
    {
        $user = $this->show($id);

        // Gérer le calcul du montant total en fonction de l'action
        if ($action == 'add') {
            $user->total_amount += $amount;
        } elseif ($action == 'update') {
            $user->total_amount = $user->total_amount - $oldAmount + $amount;
        } elseif ($action == 'delete') {
            $user->total_amount = $user->total_amount - $oldAmount;
        }

        // Mise à jour du statut de paiement
        if ($user->total_amount >= $this->participation_fee) {
            $user->payment_status = 'paid';
            if (!$user->is_active) {
                $user->is_active = true;
            }
        } elseif ($user->total_amount == 0) {
            $user->payment_status = 'unpaid';
        } else {
            $user->payment_status = 'pending';
        }
        $user->save();

        if($user->is_active && !$user->is_welcomed_message_sent) {
            $user->notify(new UserActivationNotification($user));
            $user->is_welcomed_message_sent = true;
            $user->save();
        }

        return $user;
    }
}
