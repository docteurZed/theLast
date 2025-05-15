<?php

namespace App\Services;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class InvitationService
{
    public function list(): Collection
    {
        return Invitation::all();
    }

    public function show(int $id): Invitation
    {
        return Invitation::findOrFail($id);
    }

    public function storeOrUpdate(int $event_id, int $user_id): Invitation
    {
        return Invitation::updateOrCreate(
            [
                'user_id'  => $user_id,
                'event_id' => $event_id,
            ],
            [
                'code'  => Str::uuid(),
            ]
        );
    }

    public function delete(int $id): Invitation
    {
        $invitation = Invitation::findOrFail($id);
        return $invitation->delete();
    }
}
