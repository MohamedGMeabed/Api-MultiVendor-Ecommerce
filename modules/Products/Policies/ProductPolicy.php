<?php

namespace models\Products\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use modules\Products\Models\Product;
use modules\Users\Models\User;
use modules\Vendors\Models\Vendor;
use Spatie\Permission\Models\Role;

class ProductPolicy
{
    use HandlesAuthorization;

    public function update(Vendor $user, Product $product)
    {
        return $user->id === $product->vendor_id || $user->hasPermission('product-update');
    }

    public function delete(Vendor $user, Product $product)
    {
        return $user->id === $product->vendor_id || $user->hasPermission('product-delete');
    }

    public function store(Vendor $user, Product $product)
    {
        return $user->id === $product->vendor_id || $user->hasPermission('Product-store');
    }




    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $product
     * @param  string  $ability
     * @return void|bool
     */

    public function can (User $user, Product $product, string $ability)
    {
        $role = Role::with('permissions')->find($user->role_id);
        $permissions = $role->permissions;

        for ($i=0; $i<count($permissions); $i++) {
            $userPermissions[$i] = $permissions[$i]['name'];
        }
        if (in_array($ability, $userPermissions)) {
            return true;
        }
        return false;
    }
}
