<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use modules\Admins\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Admin::create([
             'name' => "Super admin",
             'email' =>'admin@gmail.com',
             'password' =>Hash::make('123456789'),
             'country_id' => 1,
             'city_id' => 1,
             'contact' => '010368686',
         ]);

         $roles = ['Admin', 'Vendor', 'User'];
         foreach($roles as $role){
         Role::create([
             'name' => $role,
         ]);
         }
         DB::table('model_has_roles')->insert([
             'role_id' => 7,
             'model_id' => 6,
             'model_type' => 'modules\Admins\Models\Admin'
         ]);

         Permission::create(['name' => 'creat_user']);
         Permission::create(['name' => 'edit_user']);
         Permission::create(['name' => 'delete_user']);
         Permission::create(['name' => 'view_user']);
         Permission::create(['name' => 'creat_vendor']);
         Permission::create(['name' => 'edit_vendor']);
         Permission::create(['name' => 'delete_vendor']);
         Permission::create(['name' => 'view_vendor']);
         Permission::create(['name' => 'creat_category']);
         Permission::create(['name' => 'edit_category']);
         Permission::create(['name' => 'delete_category']);
         Permission::create(['name' => 'view_category']);
         Permission::create(['name' => 'creat_product']);
         Permission::create(['name' => 'edit_product']);
         Permission::create(['name' => 'delete_product']);
         Permission::create(['name' => 'view_product']);
     
         $role = Role::get()->first();
        $role->givePermissionTo(Permission::all());
    }

   
}
