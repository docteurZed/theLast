<?php

namespace App\Services;

use App\Models\Testimony;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TestimonyService
{
    public function list(): Collection
    {
        return Testimony::all();
    }

    public function create(Request $data): Testimony
    {
        $payload = $data->only(['name', 'testimony']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $payload['image'] = $data->file('image')->store('public');
        }

        return Testimony::create($payload);
    }

    public function update(Request $data, $id): Testimony
    {
        $testimony = Testimony::findOrFail($id);
        $payload = $data->only(['name', 'testimony']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $oldPath = $testimony->image;
            $payload['image'] = $data->file('image')->store('public');
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        $testimony->update($payload);
        return $testimony;
    }

    public function delete($id): void
    {
        $testimony = Testimony::findOrFail($id);
        $oldPath = $testimony->image;
        if ($oldPath && Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }
        $testimony->delete();
    }
}
