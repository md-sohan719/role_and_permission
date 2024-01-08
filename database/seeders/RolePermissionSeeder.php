<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleEditor = Role::create(['name' => 'editor']);
        // blog permissions
        $permissions = [
            // Dashboard
            'dashboard.view',

            // Blog Permissions
            'blog.create',
            'blog.view',
            'blog.edit',
            'blog.delete',
            'blog.approve',

            // Admin Permissions
            'admin.create',
            'admin.view',
            'admin.edit',
            'admin.delete',
            'admin.approve',

            // Role Permissions
            'role.create',
            'role.view',
            'role.edit',
            'role.delete',
            'role.approve',

            // Profile Permissions
            'profile.view',
            'profile.edit',
        ];

        // Create and Assign Permissions
        // $permission = Permission::create(['name' => 'dashboard.view']);
        for ($i = 0; $i < count($permissions); $i++) {
            // create Permission
            $permission = Permission::create(['name' => $permissions[$i]]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }
}
