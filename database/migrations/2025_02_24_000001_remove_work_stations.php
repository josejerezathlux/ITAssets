<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['work_station_id']);
            $table->dropColumn('work_station_id');
        });
        Schema::dropIfExists('work_stations');
    }

    public function down(): void
    {
        Schema::create('work_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
        });
        Schema::table('assets', function (Blueprint $table) {
            $table->unsignedBigInteger('work_station_id')->nullable()->after('room_id');
            $table->foreign('work_station_id')->references('id')->on('work_stations')->onDelete('set null');
        });
    }
};
