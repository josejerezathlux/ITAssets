<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UserSeeder::class,
            RoomsTableSeeder::class,
            AssetCategoriesSeeder::class,
            DefaultAssetFieldsSeeder::class,
            DepartmentsTableSeeder::class,
            EmployeesTableSeeder::class,
            AssetsTableSeeder::class,
            AssetAssignmentsSeeder::class,
            MaintenanceLogsSeeder::class,
            ActivityLogsSeeder::class,
        ]);
    }
}
