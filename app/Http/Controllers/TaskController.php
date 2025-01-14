<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks;

        return view("tasks.index", ["tasks" => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tasks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = new Task();

        $task->user_id = Auth::id();
        $task->fill($request->validated());

        $task->save();

        return redirect()->route("tasks.index")->with("success","Task criada com sucesso.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view("tasks.show", ["task" => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view("tasks.edit", ["task" => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route("tasks.index")->with("success","Task atualizada com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route("tasks.index")->with("success","Task deletada com sucesso.");
    }

    public function complete(Task $task)
    {
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->route("tasks.index")->with("success","Status da task alterada com sucesso.");
    }
}
