<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionToRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::all()->pluck('name');

        $role = Role::query()
            ->where('name', 'admin')
            ->first();


        $role->givePermissionTo($permission);

        $managerPermission = collect($permission)
            ->pluck([
                'user-view',
                'user-create',
                'user-edit'
            ]);

        $role = Role::query()
            ->where('name', 'manager')
            ->first();


        $role->givePermissionTo($managerPermission);
    }
}
