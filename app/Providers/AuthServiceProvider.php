<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Providers\Dreamer\DreamerAdminAuthUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Auth::provider(
//            'dreamer_admin_auth_user_provider',
//            function ($application, array $config) {
//                return new DreamerAdminAuthUserProvider();
//            }
//        );
    }
}
