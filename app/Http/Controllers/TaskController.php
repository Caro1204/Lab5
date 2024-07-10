<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::all(); // Obtén todos los usuarios
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'priority' => 'required|in:baja,media,alta',
        'user_id' => 'nullable|exists:users,id', // Validar el user_id
    ]);

    Task::create([
        'title' => $request->title,
        'priority' => $request->priority,
        'completed' => false,
        'user_id' => $request->user_id, // Guardar el user_id
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
}

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:baja,media,alta',
            'completed' => 'required',
        ]);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority,
            'completed' => $request->completed,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function complete(Task $task)
    {
        $task->update(['completed' => true]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }
}
