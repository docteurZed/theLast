<?php

namespace App\Services;

use App\Models\Slide;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideService
{
    public function list(): Collection
    {
        return Slide::all();
    }

    public function create(Request $data): Slide
    {
        $payload = $data->only(['name']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $payload['image'] = $data->file('image')->store('public');
        }

        return Slide::create($payload);
    }

    public function update(Request $data, int $id): Slide
    {
        $slide = Slide::findOrFail($id);
        $payload = $data->only(['name']);

        if ($data->hasFile('image') && $data->file('image')->isValid()) {
            $oldPath = $slide->image;
            $payload['image'] = $data->file('image')->store('public');
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        $slide->update($payload);

        return $slide;
    }

    public function delete(int $id): void
    {
        $slide = Slide::findOrFail($id);
        $oldPath = $slide->image;
        if ($oldPath && Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }
        $slide->delete();
    }
}
