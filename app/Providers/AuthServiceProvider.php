<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use modules\Orders\Models\Order;
use modules\Orders\Policy\OrderPolicy;
use modules\Permissions\Policy\PermissionPolicy;
use modules\Roles\Policy\RolePolicy;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Permission::class =>PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Order::class =>OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
