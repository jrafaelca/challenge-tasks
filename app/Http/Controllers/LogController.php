<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogRequest;
use App\Models\Log;
use App\Models\Task;
use App\Notifications\NewLog;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;

class LogController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Task $task
     * @param StoreLogRequest $request
     * @return RedirectResponseAlias
     * @throws AuthorizationException
     */
    public function store(Task $task, StoreLogRequest $request)
    {
        $this->authorize('create', [Log::class, $task]);

        $log = new Log();
        $log->fill($request->all());
        $log->task()->associate($request->get('task_id'));
        $log->user()->associate(auth()->id());
        $log->save();

        $log->task->user->notify(new NewLog($log));

        return redirect()->route('tasks.show', $log->task);
    }
}
