<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SweetAlert2\Laravel\Swal;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('active', 1)->orderBy('name', 'asc')->get();
        return view('tasks.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en_proceso,completado',
            'due_date' => 'required|date',
            'client_id' => 'nullable|exists:clients,id'
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->client_id = $request->client_id;
        $task->user_id = Auth::id();
        $task->save();
        Swal::success([
            'title' => 'Tarea creada',
            'text' => 'La tarea se creó correctamente',
            'icon' => 'success',
        ]);

        return redirect()->route('tasks.index');
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
        $clients = Client::where('active', 1)->orderBy('name', 'asc')->get();
        return view('tasks.edit', compact('task', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en_proceso,completado',
            'due_date' => 'required|date',
            'client_id' => 'nullable|exists:clients,id'
        ]);

        $task->update($request->all());
             Swal::success([
            'title' => 'Tarea actualizada',
            'text' => 'La tarea se actualizó correctamente',
            'icon' => 'success',
        ]);

        $clients = Client::where('active', 1)->orderBy('name', 'asc')->get();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        
        $task->delete();
        Swal::success([
            'title' => 'Tarea eliminada',
            'text' => 'La tarea se eliminó correctamente',
            'icon' => 'success',
        ]);
        return redirect()->route('tasks.index');
    }
    public function calendar()
    {
        return view('tasks.calendar');
    }
}
