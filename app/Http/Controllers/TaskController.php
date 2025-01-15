<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Auth::user()->tasks();

        if($request->filled("title")) {
            $tasks = $tasks->where("title", "like", '%' . $request->input('title') . '%');
        }

        if ($request->filled("statusTask")) {
            if ($request->input('statusTask') == 2) {
                $tasks = $tasks->where("is_completed", true);
            } elseif ($request->input('statusTask') == 3) {
                $tasks = $tasks->where("is_completed", false);
            }
        }

        if($request->filled("initialPeriod") && $request->filled("finalPeriod")) {
            $tasks = $tasks->whereBetween("date_limit", [$request->input(key: 'initialPeriod'), $request->input('finalPeriod')]);
        }

        $tasks = $tasks->orderBy('date_limit', 'asc')
                        ->paginate(20);

        return view("tasks.index", ["tasks" => $tasks, "request" => $request]);
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
        Gate::authorize("view", $task);

        return view("tasks.show", ["task" => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize("update", $task);

        return view("tasks.edit", ["task" => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route("tasks.index")->with("success","Task atualizada com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize("delete", $task);

        $task->delete();

        return redirect()->route("tasks.index")->with("success","Task deletada com sucesso.");
    }

    public function complete(Task $task)
    {
        Gate::authorize("complete", $task);

        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->route("tasks.index")->with("success","Status da task alterada com sucesso.");
    }
}
