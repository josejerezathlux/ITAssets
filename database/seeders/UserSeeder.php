<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Alex Rivera', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'Sam Chen', 'email' => 'technician@example.com', 'role' => 'technician'],
            ['name' => 'Jordan Lee', 'email' => 'viewer@example.com', 'role' => 'viewer'],
        ];

        foreach ($users as $u) {
            $role = Role::where('name', $u['role'])->first();
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => Hash::make('password'), 'role_id' => $role?->id]
            );
            if ($role && $user->role_id !== $role->id) {
                $user->update(['role_id' => $role->id]);
            }
        }
    }
}
