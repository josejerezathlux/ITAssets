<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('subscription'); // license, subscription, saas, maintenance, support_contract, other
            $table->string('vendor')->nullable();
            $table->string('product_name')->nullable();
            $table->string('sku')->nullable()->index();
            $table->text('description')->nullable();
            $table->string('license_key_reference')->nullable()->comment('Masked key or reference ID');
            $table->string('status')->default('active'); // active, expired, cancelled, pending_renewal, trial, suspended
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('renewal_date')->nullable();
            $table->date('next_billing_date')->nullable();
            $table->string('billing_cycle')->nullable(); // one_time, monthly, quarterly, annually, biennially, custom
            $table->decimal('cost', 12, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->unsignedInteger('quantity')->default(1)->comment('Total seats/users/licenses');
            $table->boolean('auto_renew')->default(false);
            $table->string('terms_url')->nullable();
            $table->string('portal_url')->nullable();
            $table->string('category')->nullable()->comment('e.g. Productivity, Security, Development');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_assets');
    }
};
