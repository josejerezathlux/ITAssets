<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignAdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        if (!$admin) {
            return;
        }
        $userWithAdmin = User::whereHas('roles', fn ($q) => $q->where('roles.id', $admin->id))->exists();
        if (!$userWithAdmin) {
            $first = User::first();
            if ($first) {
                $first->roles()->attach($admin->id);
            }
        }
    }
}
