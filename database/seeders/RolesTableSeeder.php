<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $allPermissions = Role::permissionKeys();

        $roles = [
            [
                'name' => 'admin',
                'label' => 'Administrator',
                'permissions' => ['*'],
            ],
            [
                'name' => 'technician',
                'label' => 'Technician',
                'permissions' => array_values(array_filter($allPermissions, fn ($p) => !in_array($p, ['users.create', 'users.update', 'users.delete', 'roles.create', 'roles.update', 'roles.delete'], true))),
            ],
            [
                'name' => 'viewer',
                'label' => 'Viewer',
                'permissions' => array_values(array_filter($allPermissions, fn ($p) => str_ends_with($p, '.view'))),
            ],
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
