<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\GradePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-level', function (User $user){

            if($user->role ==3){
                return true;
            }
                return false;
        });

        Gate::define('teacher-level', function (User $user){

            if($user->role ==2){
                return true;
            }
                return false;
        });

        Gate::define('student-level', function (User $user){

            if($user->role ==1){
                return true;
            }
                return false;
        });

    }
}
