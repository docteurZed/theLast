<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    public function index()
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $user = Auth::user();

        return view('admin.task.index', [
            'tasks' => $this->taskService->getTasksForUser($user),
            'pendingTasks' => $this->taskService->getTasksByStatusForUser('pending', $user),
            'progressTasks' => $this->taskService->getTasksByStatusForUser('in_progress', $user),
            'completedTasks' => $this->taskService->getTasksByStatusForUser('completed', $user),
            'users' => User::where('role', '!=', 'guest')->get(),
        ]);
    }

    public function detail($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $task = Task::findOrFail($id);
        $stats = $this->taskService->getTaskDetailsStats($task);

        return view('admin.task.detail', [
            'task' => $task,
            'total' => $stats['total'],
            'completed' => $stats['completed'],
        ]);
    }

    public function store(TaskRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->taskService->storeTask($request);

        return back()->with(['success' => 'Tâche ajoutée avec succès']);
    }

    public function update(TaskRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->taskService->updateTask($request, $id);

        return back()->with(['success' => 'Tâche modifiée avec succès']);
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $this->taskService->deleteTask($id);

        return back()->with(['success' => 'Tâche supprimée avec succès']);
    }
}
