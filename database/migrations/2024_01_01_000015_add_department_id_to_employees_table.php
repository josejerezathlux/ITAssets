<?php

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('department_id')->nullable()->after('name')->constrained()->nullOnDelete();
        });

        $existing = Employee::whereNotNull('department')->where('department', '!=', '')->distinct()->pluck('department');
        foreach ($existing as $name) {
            $dept = Department::firstOrCreate(['name' => $name]);
            Employee::where('department', $name)->update(['department_id' => $dept->id]);
        }

        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('department');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('department')->nullable()->after('name');
        });

        $employees = Employee::with('department')->get();
        foreach ($employees as $e) {
            if ($e->department) {
                $e->update(['department' => $e->department->name]);
            }
        }

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
};
