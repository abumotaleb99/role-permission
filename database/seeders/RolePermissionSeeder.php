<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        // $superAdminRole = Role::create(['name' => 'Super Admin']);
        // $adminRole = Role::create(['name' => 'Admin']);
        // $editorRole = Role::create(['name' => 'Editor']);
        // $userRole = Role::create(['name' => 'User']);

        // Permissions
        $permissions = [
            [
                'group_name' => "dashboard",
                'permissions' => [
                    'dashboard.view'
                ]
            ],
            [
                'group_name' => "admin",
                'permissions' => [
                    'admin.index',
                    'admin.add',
                    'admin.insert',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => "blog",
                'permissions' => [
                    'blog.index',
                    'blog.add',
                    'blog.insert',
                    'blog.edit',
                    'blog.delete',
                ]
            ]
        ];

        // for ($i = 0; $i < count($permissions); $i++) {
        //     $permission = Permission::create(['name' => $permissions[$i]]);
        //     $superAdminRole->givePermissionTo($permission);
        //     $permission->assignRole($superAdminRole);
        // }

        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);

        for ($i = 0; $i < count($permissions); $i++) {
            $groupName = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $groupName, 'guard_name' => 'admin']);
                $superAdminRole->givePermissionTo($permission);
                $permission->assignRole($superAdminRole);
            }
        }

    }
}
