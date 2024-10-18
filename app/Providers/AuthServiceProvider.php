<?php

namespace App\Providers;

use App\Policies\TaskPolicy;
use App\Models\Task;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\TaskStatus;
use App\Policies\TaskStatusPolicy;
use App\Models\Label;
use App\Policies\LabelPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class,
        TaskStatus::class => TaskStatusPolicy::class,
        Label::class => LabelPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
