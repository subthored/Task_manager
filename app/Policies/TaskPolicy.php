<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(?User $user, Task $task): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Task $task): bool
    {
        return Auth::check();
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->created_by_id;
    }
}
