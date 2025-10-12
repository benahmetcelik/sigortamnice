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
        Schema::create('web_service_modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('requirements')->nullable();
            $table->foreignId('web_service_id')->constrained('web_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_web_service_module_id_foreign');
        });
        Schema::dropIfExists('web_service_modules');
    }
};
