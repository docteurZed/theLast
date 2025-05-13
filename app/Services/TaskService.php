<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class TaskService
{
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

        if ($request->hasFile('image')) {
            $task->image = $request->file('image')->store('public');
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

        if ($request->hasFile('image')) {
            $task->image = $request->file('image')->store('public');
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
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
        $task->delete();
    }
}
