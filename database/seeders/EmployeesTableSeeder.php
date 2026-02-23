<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['name' => 'John Doe', 'department' => 'IT', 'email' => 'john.doe@company.com', 'phone' => '+1 555-0101'],
            ['name' => 'Jane Smith', 'department' => 'HR', 'email' => 'jane.smith@company.com', 'phone' => '+1 555-0102'],
            ['name' => 'Bob Wilson', 'department' => 'Operations', 'email' => 'bob.wilson@company.com', 'phone' => '+1 555-0103'],
            ['name' => 'Maria Garcia', 'department' => 'Finance', 'email' => 'maria.garcia@company.com', 'phone' => '+1 555-0104'],
            ['name' => 'David Kim', 'department' => 'Engineering', 'email' => 'david.kim@company.com', 'phone' => '+1 555-0105'],
            ['name' => 'Sarah Johnson', 'department' => 'Marketing', 'email' => 'sarah.johnson@company.com', 'phone' => '+1 555-0106'],
            ['name' => 'James Wright', 'department' => 'IT', 'email' => 'james.wright@company.com', 'phone' => '+1 555-0107'],
            ['name' => 'Emily Davis', 'department' => 'Sales', 'email' => 'emily.davis@company.com', 'phone' => '+1 555-0108'],
            ['name' => 'Michael Brown', 'department' => 'Engineering', 'email' => 'michael.brown@company.com', 'phone' => '+1 555-0109'],
            ['name' => 'Lisa Anderson', 'department' => 'HR', 'email' => 'lisa.anderson@company.com', 'phone' => '+1 555-0110'],
            ['name' => 'Chris Taylor', 'department' => 'Operations', 'email' => 'chris.taylor@company.com', 'phone' => null],
            ['name' => 'Amanda Martinez', 'department' => 'Finance', 'email' => 'amanda.martinez@company.com', 'phone' => null],
        ];
        foreach ($employees as $e) {
            $deptName = $e['department'] ?? null;
            unset($e['department']);
            $e['department_id'] = $deptName ? Department::where('name', $deptName)->first()?->id : null;
            Employee::firstOrCreate(['email' => $e['email']], $e);
        }
    }
}
