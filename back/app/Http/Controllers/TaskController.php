<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'column_id' => 'required|exists:columns,id',
            ]);

            $task = new Task();
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->user_id = 1;
            $task->column_id = $request->input('column_id');
            $task->save();

            return response()->json($task, 201);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $task = Task::findOrFail($request->task_id);
        $task->column_id = $request->column_id;
        $task->save();

        return response()->json(['message' => 'Task updated successfully'], 200);
    }


}
