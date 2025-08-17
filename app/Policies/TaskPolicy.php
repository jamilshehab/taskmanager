<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAnyTasks(User $user): bool
    {
        return $user->role =='manager'; //for now only manager can views all tasks 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->role=="agent" && $user->id==$task->user_id; //only agent can view the specific tasks  
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == 'manager';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->role == 'manager';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->role == "manager";
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Task $task): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Task $task): bool
    // {
    //     return false;
    // }
}
