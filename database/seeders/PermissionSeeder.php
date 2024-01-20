<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public const PERMISSIONS = [
        'user-view',
        'user-create',
        'user-update',
        'user-delete',
        'user-restore',
        'user-force-delete',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionSeeder::PERMISSIONS as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
