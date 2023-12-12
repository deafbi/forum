<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\MessagePolicy;
use App\Policies\ReportPolicy;
use App\Policies\VouchPolicy;
use App\Policies\ReputationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Topic' => 'App\Policies\TopicPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Like' => 'App\Policies\LikePolicy',
        // 'App\Models\User' => 'App\Policies\ReputationPolicy',
        // 'App\Models\User' => 'App\Policies\VouchPolicy',
        // 'App\Models\User' => 'App\Policies\ReportPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('give-reputation', [ReputationPolicy::class, 'create']);
        Gate::define('vouch', [VouchPolicy::class, 'create']);
        Gate::define('report', [ReportPolicy::class, 'create']);
        Gate::define('message', [MessagePolicy::class, 'create']);
        // Gate::define('like', [LikePolicy::class, 'create']);

        // Implicitly grant "admin" role all permission checks using can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
