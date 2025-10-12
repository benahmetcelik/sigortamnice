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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_service_id')->constrained('web_services');
            $table->foreignId('web_service_module_id')->constrained('web_service_modules');
            $table->foreignId('quote_request_id')->constrained('quote_requests');
            $table->string('price')->nullable();
            // Servisten Yanıt Alındı Mı ?
            $table->boolean('is_completed')->default(false);
            // Sigorta Kesilebilir Mi ?
            $table->boolean('is_acceptable')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
