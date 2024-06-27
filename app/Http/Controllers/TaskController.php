<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return $tasks;
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pending,in-progress,completed',
            'due_date' => 'required|date',
        ]);
    
        $task = Task::create([
            'title' => strip_tags(trim($validatedData['title'])),
            'description' => strip_tags(trim($validatedData['description'])),
            'status' => strip_tags(trim($validatedData['status'])),
            'due_date' => strip_tags(trim($validatedData['due_date'])),
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findorfail($id);

        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pending,in-progress,completed',
            'due_date' => 'required|date',
        ]);

        $task = Task::findorfail($id);

        if (isset($validatedData['title'])) {
            $task->title = strip_tags(trim($validatedData['title']));
        }

        if (isset($validatedData['description'])) {
            $task->description = strip_tags(trim($validatedData['description']));
        }

        if (isset($validatedData['status'])) {
            $task->status = strip_tags(trim($validatedData['status']));
        }

        if (isset($validatedData['due_date'])) {
            $task->due_date = strip_tags(trim($validatedData['due_date']));
        }

        $task->save();

        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findorfail($id);
        $task->delete();

        return response()->json(['message' => 'Successfully deleted task'], 200);
    }
}
