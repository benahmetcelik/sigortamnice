<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained('domains');
            //Tüm servislerden yanıt alındı mı ?
            $table->boolean('is_completed')->default(false);
            $table->foreignId('dealer_customer_id')->nullable()->constrained('dealer_customers');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('service_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
