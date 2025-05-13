<?php

namespace App\Services;

use App\Models\EventProgram;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EventProgramService
{
    public function list(int $eventId): Collection
    {
        return EventProgram::where('event_id', $eventId)->orderBy('starts_at')->get();
    }

    public function create(Request $data): EventProgram
    {
        $payload = $data->only([
            'event_id',
            'starts_at',
            'ends_at',
            'title',
            'description',
            'speaker',
        ]);

        return EventProgram::create($payload);
    }

    public function update(Request $data, int $id): EventProgram
    {
        $program = EventProgram::findOrFail($id);

        $payload = $data->only([
            'event_id',
            'starts_at',
            'ends_at',
            'title',
            'description',
            'speaker',
        ]);

        $program->update($payload);

        return $program;
    }

    public function delete(int $id): void
    {
        $program = EventProgram::findOrFail($id);
        $program->delete();
    }
}
