<?php

namespace App\Http\Controllers\Admin;

use App\Events\ActivityEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskDetailRequest;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskDetailController extends Controller
{
    public function store (TaskDetailRequest $request)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $detail = TaskDetail::create($request->all());

        $task = $detail->task;

        $totalDetails = $task->task_details()->count();
        $completedDetails = $task->task_details()->where('statut', 'completed')->count();

        if ($completedDetails == 0) {
        $task->statut = 'pending';
        } elseif ($completedDetails > 0 && $completedDetails < $totalDetails) {
            $task->statut = 'in_progress';
        } elseif ($completedDetails === $totalDetails) {
        $task->statut = 'completed';
        }

        $task->save();

        return back()->with(['status' => 'Détail ajouté avec succès']);
    }

    public function update (TaskDetailRequest $request, $id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $detail = TaskDetail::find($id);

        $detail->update($request->all());

        $task = $detail->task;

        $totalDetails = $task->task_details()->count();
        $completedDetails = $task->task_details()->where('statut', 'completed')->count();

        if ($completedDetails == 0) {
        $task->statut = 'pending';
        } elseif ($completedDetails > 0 && $completedDetails < $totalDetails) {
            $task->statut = 'in_progress';
        } elseif ($completedDetails === $totalDetails) {
        $task->statut = 'completed';
        }

        $task->save();

        return back()->with(['status' => 'Détail modifié avec succès']);
    }

    public function updateStatut ($id)
    {
        try {
            if(Auth::user()->role == 'guest') {
                return response()->json(['success' => false, 'message' => 'Vous n\'avez pas les autorisations nécessaires']);
            }

            $detail = TaskDetail::find($id);

            if ($detail->statut == 'uncompleted') {
                $detail->statut = 'completed';
            } else {
                $detail->statut = 'uncompleted';
            }

            $detail->save();

            $task = $detail->task;

            $totalDetails = $task->task_details()->count();
            $completedDetails = $task->task_details()->where('statut', 'completed')->count();

            if ($completedDetails == 0) {
                $task->statut = 'pending';
            } elseif ($completedDetails > 0 && $completedDetails < $totalDetails) {
                $task->statut = 'in_progress';
            } elseif ($completedDetails === $totalDetails) {
                $task->statut = 'completed';
            }

            $task->save();

            return response()->json(['success' => true, 'message' => 'Statut modifié avec succès', 'total' => $totalDetails, 'completed' => $completedDetails]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur lors de la modification du statut']);
        }
    }

    public function destroy ($id)
    {
        if (Auth::user()->role == 'guest') {
            abort(403);
        }

        $detail = TaskDetail::find($id);
        $task = $detail->task;

        $detail->delete();

        $totalDetails = $task->task_details()->count();
        $completedDetails = $task->task_details()->where('statut', 'completed')->count();

        if ($completedDetails == 0) {
            $task->statut = 'pending';
        } elseif ($completedDetails > 0 && $completedDetails < $totalDetails) {
            $task->statut = 'in_progress';
        } elseif ($completedDetails === $totalDetails) {
            $task->statut = 'completed';
        }

        $task->save();

        return back()->with(['status' => 'Détail supprimé avec succès']);
    }
}
