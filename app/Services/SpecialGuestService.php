<?php

namespace App\Services;

use App\Models\SpecialGuest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SpecialGuestService
{
    public function list(): Collection
    {
        return SpecialGuest::all();
    }

    public function create(Request $data): SpecialGuest
    {
        $payload = $data->only(['title', 'name', 'domain', 'description', 'role']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $payload['image'] = $data->file('image')->store('public');
        }

        return SpecialGuest::create($payload);
    }

    public function update(Request $data, $id): SpecialGuest
    {
        $guest = SpecialGuest::findOrFail($id);
        $payload = $data->only(['title', 'name', 'domain', 'description', 'role']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $oldPath = $guest->image;
            $payload['image'] = $data->file('image')->store('public');
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        $guest->update($payload);
        return $guest;
    }

    public function delete($id): void
    {
        $guest = SpecialGuest::findOrFail($id);
        $oldPath = $guest->image;
        if ($oldPath && Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }
        $guest->delete();
    }
}
