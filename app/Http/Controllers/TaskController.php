<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'message' => 'Tasks retrieved successfully.',
            'data' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'status' => ['required', Rule::in(['completed', 'pending'])],
            'attachment' => 'nullable|string',
        ]);
        $task = Task::create($validatedData);
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'data' => $task
        ], 201);
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'status' => ['required', Rule::in(['completed', 'pending'])],
            'attachment' => 'nullable|string',
        ]);

        $task->update($validatedData);
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'data' => $task
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}
