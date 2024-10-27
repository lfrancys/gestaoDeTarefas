<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['user', 'status'])->get();
        return response()->json($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::with(['user', 'status'])->findOrFail($id);
        return response()->json($task);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
