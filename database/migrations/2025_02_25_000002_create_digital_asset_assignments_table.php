<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('digital_asset_id')->constrained()->cascadeOnDelete();
            $table->string('assignable_type'); // App\Models\User or App\Models\Employee
            $table->unsignedBigInteger('assignable_id');
            $table->date('assigned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['assignable_type', 'assignable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_asset_assignments');
    }
};
