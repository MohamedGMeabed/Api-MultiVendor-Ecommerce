<?php

namespace modules\Orders\Policy;


use Illuminate\Auth\Access\HandlesAuthorization;
use modules\Orders\Models\Order;
use modules\Users\Models\User;

class OrderPolicy
{
    use HandlesAuthorization;
    public function create(User $user)
    {  
       return  $user->hasPermissionTo('create_order');
    }
    public function update(User $user, Order $order)
    {
        return  $user->hasPermissionTo('edit_order');
    }

    public function delete(User $user, Order $order)
    {
        return  $user->hasPermissionTo('delete_order');
    }
    public function view(User $user)
    {
        return  $user->hasPermissionTo('view_order');
    }
}
