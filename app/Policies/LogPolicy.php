<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function create(User $user, Task $task)
    {
        if ($user->id == $task->user_id) {
            return true;
        }

        return $user->id == $task->responsible_id;
    }
}
