<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function list(): Collection
    {
        return Event::all();
    }

    public function create(Request $data): Event
    {
        $payload = $data->only([
            'name', 'starts_at', 'location',
            'location_latitude', 'location_longitude',
            'dress_code',
            'primary_color_name', 'primary_color_hex',
            'secondary_color_name', 'secondary_color_hex'
        ]);

        if ($data->hasFile('primary_image') && $data->file('primary_image')->isValid()) {
            $payload['primary_image'] = $data->file('primary_image')->store('public');
        }

        if ($data->hasFile('secondary_image') && $data->file('secondary_image')->isValid()) {
            $payload['secondary_image'] = $data->file('secondary_image')->store('public');
        }

        return Event::create($payload);
    }

    public function update(Request $data, int $id): Event
    {
        $event = Event::findOrFail($id);

        $payload = $data->only([
            'name', 'starts_at', 'location',
            'location_latitude', 'location_longitude',
            'dress_code',
            'primary_color_name', 'primary_color_hex',
            'secondary_color_name', 'secondary_color_hex'
        ]);

        if ($data->hasFile('primary_image') && $data->file('primary_image')->isValid()) {
            $this->deleteFile($event->primary_image);
            $payload['primary_image'] = $data->file('primary_image')->store('public');
        }

        if ($data->hasFile('secondary_image') && $data->file('secondary_image')->isValid()) {
            $this->deleteFile($event->secondary_image);
            $payload['secondary_image'] = $data->file('secondary_image')->store('public');
        }

        $event->update($payload);

        return $event;
    }

    public function delete(int $id): void
    {
        $event = Event::findOrFail($id);
        $this->deleteFile($event->primary_image);
        $this->deleteFile($event->secondary_image);
        $event->delete();
    }

    protected function deleteFile(?string $path): void
    {
        if ($path && Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
