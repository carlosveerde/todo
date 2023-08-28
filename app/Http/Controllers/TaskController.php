<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function listTasks()
    {
        return response()->json(Task::all());
    }

    public function show($id)
    {
        return response()->json(Task::find($id));
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return response()->json([
            'task' => $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return response()->json([
            'task' => $task
        ]);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json([
            'task' => $task
        ]);
    }
}
