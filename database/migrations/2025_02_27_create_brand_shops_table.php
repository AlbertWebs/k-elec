<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location'); // e.g., "Westlands, Nairobi"
            $table->string('city')->nullable(); // e.g., "Nairobi"
            $table->string('area')->nullable(); // e.g., "Westlands"
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->json('timings'); // Store as JSON: {"Monday": "9AM-6PM", "Tuesday": "9AM-6PM", ...}
            $table->string('directions_url')->nullable(); // Google Maps URL
            $table->boolean('is_active')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_shops');
    }
};
