<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'IT', 'code' => 'IT'],
            ['name' => 'HR', 'code' => 'HR'],
            ['name' => 'Operations', 'code' => 'OPS'],
            ['name' => 'Finance', 'code' => 'FIN'],
            ['name' => 'Engineering', 'code' => 'ENG'],
            ['name' => 'Marketing', 'code' => 'MKT'],
            ['name' => 'Sales', 'code' => 'SAL'],
        ];
        foreach ($departments as $d) {
            Department::firstOrCreate(['name' => $d['name']], $d);
        }
    }
}
