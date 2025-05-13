<?php

namespace App\Services;

use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SponsorService
{
    public function list(): Collection
    {
        return Sponsor::all();
    }

    public function create(Request $data): Sponsor
    {
        $payload = $data->only(['name', 'description']);

        if ($data->hasFile('logo') && $data->file('logo')->isValid()) {
            $payload['logo'] = $data->file('logo')->store('public');
        }

        return Sponsor::create($payload);
    }

    public function update(Request $data, $id): Sponsor
    {
        $sponsor = Sponsor::findOrFail($id);
        $payload = $data->only(['name', 'description']);

        if ($data->hasFile('logo') && $data->file('logo')->isValid()) {
            $oldPath = $sponsor->logo;
            $payload['logo'] = $data->file('logo')->store('public');
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        $sponsor->update($payload);
        return $sponsor;
    }

    public function delete($id): void
    {
        $sponsor = Sponsor::findOrFail($id);
        $oldPath = $sponsor->logo;
        if ($oldPath && Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }
        $sponsor->delete();
    }
}
