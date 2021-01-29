<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'display_name' => 'User Administrator', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
        ]);

        $user = Role::firstOrCreate([
            'name' => 'user',
            'display_name' => 'User', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
        ]);

        Permission::firstOrCreate(['name' => 'create_user', 'display_name' => 'Create User']);
        Permission::firstOrCreate(['name' => 'update_user', 'display_name' => 'Update User']);
        Permission::firstOrCreate(['name' => 'delete_user', 'display_name' => 'Delete User']);
        Permission::firstOrCreate(['name' => 'view_user', 'display_name' => 'View User']);

        $admin->attachPermissions(Permission::all());
    }
}
