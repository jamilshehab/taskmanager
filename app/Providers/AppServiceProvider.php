<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $policies=[
        Task::class =>TaskPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
   Gate::define('assign', function ($user) {
        return $user->role === 'manager';
    });

    Gate::define('viewAssignedTickets',function($agent){
        return $agent->role === 'agent';
    });
     
    Gate::define('viewComments',function($user){
      return $user->role === 'angent' || $user->role === 'manager';
    });

    Gate::define('createComments',function($user){
      return $user->role === 'angent' || $user->role === 'manager';
    });

    Gate::define('viewTasks',function($user){
        return $user->role === 'client';
    });

    Gate::define('createUsers',function($user){
        return $user->role === 'manager';
    });

    Gate::define('createDepartments',function($user){
        return $user->role === 'manager';
    });
}
}