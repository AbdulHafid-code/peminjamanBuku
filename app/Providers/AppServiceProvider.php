<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Gate::define('admin', function (User $user) {
           return $user->role_id == 1; 
       });

       Gate::define('user', function (User $user){
            return $user->role_id == 2;
       });

        Gate::define('admin-user', function(User $user){
            return in_array($user->role_id, [1,2]);
        });
    }
}
