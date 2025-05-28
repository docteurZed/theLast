<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class TaskService
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}

    public function getTasksForUser($user)
    {
        return Task::orderBy('created_at', 'desc')
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereHas('users', function($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
            })
            ->get();
    }

    public function getTasksByStatusForUser($status, $user)
    {
        return Task::where('statut', $status)
            ->orderBy('created_at', 'desc')
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereHas('users', function($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
            })
            ->get();
    }

    public function getTaskDetailsStats($task)
    {
        return [
            'total' => $task->task_details()->count(),
            'completed' => $task->task_details()->where('statut', 'completed')->count()
        ];
    }

    public function storeTask($request)
    {
        $task = Task::create($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filePath = $request->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $task->image = $uploadResult['secure_url'] ?? null;
            $task->save();
        }

        if ($request->has('userIds')) {
            $task->users()->attach($request->userIds);
        }

        return $task;
    }

    public function updateTask($request, $id)
    {
        $task = Task::findOrFail($id);
        $oldImagePath = $task->image;

        $task->update($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($oldImagePath) {
                $publicId = $this->cloudinary->extractPublicId($oldImagePath);
                $this->cloudinary->delete($publicId);
            }

            $filePath = $request->file('image')->getRealPath();
            $uploadResult = $this->cloudinary->upload($filePath, [
                'folder' => 'images',
            ]);

            $task->image = $uploadResult['secure_url'] ?? null;
            $task->save();
        }

        if ($request->has('userIds')) {
            $task->users()->sync($request->userIds);
        } else {
            $task->users()->detach();
        }

        return $task;
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        if ($task->image) {
            $publicId = $this->cloudinary->extractPublicId($task->image);
            $this->cloudinary->delete($publicId);
        }
        $task->delete();
    }
}
