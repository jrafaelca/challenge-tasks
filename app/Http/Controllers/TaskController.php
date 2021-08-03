<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $responsibles;

    public function __construct()
    {
        $this->responsibles = User::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Task::class);

        $tasks = Task::latest()
            ->paginate();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        return view('tasks.create', [
            'responsibles' => $this->responsibles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $task = new Task();
        $task->fill($request->validated());
        $task->user()->associate(auth()->id());
        $task->responsible()->associate($request->get('responsible_id'));
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return View
     * @throws AuthorizationException
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', [
            'task' => $task
        ]);
    }
}
