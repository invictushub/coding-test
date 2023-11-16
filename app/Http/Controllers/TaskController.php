<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Phase;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskController extends Controller
{

    public function kanban()
    {
        return view('tasks.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \App\Models\Phase::with('tasks.user')
            ->withCount('tasks')
            ->get();
    }

    /**
     * Display a listing of the Users resource.
     */
    public function users()
    {
        return \App\Models\User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        // Create a new task from the $request
        $task = Task::create($request->validated());

        return response()->json($task, ResponseAlias::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $data = $request->validated();
        $task->update([
            'name' => $data['name']
        ]);

        return response()->json($task, ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Task::destroy($task->id);
    }

    public function updateAssignee(Task $task, User $user): JsonResponse
    {
        $task->update([
            'user_id' => $user->id
        ]);
        $task->load('user');
        return response()->json($task, ResponseAlias::HTTP_OK);
    }

    public function updatePhase(Task $task, Phase $phase): JsonResponse
    {
        $completedAt = $task->completed_at;
        if ($phase->is_completed && is_null($completedAt)) {
            $completedAt = Carbon::now();
        }
        $task->update([
            'phase_id' => $phase->id,
            'completed_at' => $completedAt
        ]);

        return response()->json($task, ResponseAlias::HTTP_OK);
    }
}
