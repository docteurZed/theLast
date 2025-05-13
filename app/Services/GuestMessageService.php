<?php

namespace App\Services;

use App\Models\GuestMessage;
use Illuminate\Support\Collection;

class GuestMessageService
{
    public function getAllMessages(): Collection
    {
        return GuestMessage::orderBy('created_at', 'desc')->get();
    }

    public function store(array $data): GuestMessage
    {
        return GuestMessage::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }

    public function markAsRead(int $id): array
    {
        $message = GuestMessage::findOrFail($id);

        if ($message->has_read) {
            return ['success' => false, 'message' => 'Le message a été déjà lu.'];
        }

        $message->has_read = true;
        $message->save();

        return ['success' => true, 'message' => 'Message marqué comme lu.'];
    }

    public function deleteMessage(int $id): void
    {
        $message = GuestMessage::findOrFail($id);
        $message->delete();
    }
}
