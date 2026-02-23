<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateSingleAdminCommand extends Command
{
    protected $signature = 'app:create-admin
                            {--email= : Admin email (default: admin@example.com)}
                            {--password= : Admin password (if omitted, a random one is generated)}
                            {--force : Skip confirmation prompt}';

    protected $description = 'Remove all users and create a single admin user. Outputs credentials.';

    public function handle(): int
    {
        $this->warn('This will delete ALL users and create one admin account.');

        if (!$this->option('force') && !$this->confirm('Continue?', true)) {
            return self::FAILURE;
        }

        $email = $this->option('email') ?: 'admin@example.com';
        $password = $this->option('password');

        if (!$password) {
            $password = Str::password(16, true, true, true, false);
        } else {
            if (strlen($password) < 12) {
                $this->error('Password must be at least 12 characters when provided via --password.');
                return self::FAILURE;
            }
        }

        DB::transaction(function () use ($email, $password) {
            User::query()->delete();

            $adminRole = Role::where('name', 'admin')->first();
            if (!$adminRole) {
                throw new \RuntimeException('Admin role not found. Run migrations and seeders first (e.g. php artisan migrate:fresh --seed).');
            }

            User::create([
                'name' => 'Administrator',
                'email' => $email,
                'password' => $password,
                'role_id' => $adminRole->id,
            ]);
        });

        $this->newLine();
        $this->info('Single admin user created successfully.');
        $this->newLine();
        $this->table(
            ['Field', 'Value'],
            [
                ['Email', $email],
                ['Password', $password],
            ]
        );
        $this->newLine();
        $this->warn('Save these credentials securely. You will not see the password again.');

        return self::SUCCESS;
    }
}
