<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {


        $todo = Todo::all();

        if ($todo) {
            $data = [
                'message' => 'Get all tasks',
                'data' => $todo
            ];
        } else {
            $data = [
                'message' => 'task is empty'
            ];
        }

        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $todo = Todo::create([
            'title' => $request->title,
        ]);

        return response()->json([
            'message' => 'Todo created successfully',
            'todo' => $todo,
        ]);
    }


    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $todo->update([
            'title' => $request->title,
        ]);

        return response()->json([
            'message' => 'Todo updated successfully',
            'data' => $todo,
        ]);
    }

    public function completed(Request $request, Todo $todo)
    {
        $request->validate([
            'completed' => ['required', 'boolean'],
        ]);

        $todo->update([
            'completed' => $request->completed,
        ]);

        return response()->json([
            'message' => 'Todo updated successfully',
            'data' => $todo,
        ]);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully',
        ]);
    }

    public function show($todo)
    {
        $todo = Todo::find($todo);

        if ($todo) {
            $data = [
                'message' => 'Get detail task',
                'data' => $todo
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Task not found'
            ];

            return response()->json($data, 404);
        }
    }
}
