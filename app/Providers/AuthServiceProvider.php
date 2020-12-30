<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Blade::directive('hasrole', function ($arguments) {
//            $roles = explode('|', $arguments);
//
        /*            return "<?php if (auth()->check() && in_array(auth()->user()->role, {$roles})): ?>";*/
//        });
//
//        Blade::directive('endhasrole', function () {
        /*            return '<?php endif; ?>';*/
//        });

        Gate::define('view-creat-edit-delete_users', function ($user) {
            return $user->hasRole('admin');
        });

//        Blade::directive('admin', function ($user) {
//            $admin = $user->hasRole('admin');
//        });


    }
}
