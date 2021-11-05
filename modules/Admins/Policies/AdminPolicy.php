<?php

namespace modules\Admins\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use modules\Admins\Models\Admin;
use Spatie\Permission\Models\Role;

class AdminPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user)
    {
        return $user->hasRole('admin');
    }

    public function view(Admin $user, Admin $admin)
    {
        return $user->id === $admin->id || $user->hasRole('admin');
    }

    public function delete(Admin $user, Admin $admin)
    {
        return $user->id === $admin->id || $user->hasRole('admin');
    }

    public function store(Admin $user, Admin $admin)
    {
        return $user->hasPermissionTo('admin-store', 'admin');
    }

    public function update(Admin $user, Admin $admin)
    {
        return $user->id === $admin->id || $user->hasPermission('admin-update');
    }

}
