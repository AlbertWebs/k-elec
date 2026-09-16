<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('contact_person_name');
            $table->string('business_name');
            $table->string('location');
            $table->enum('partnership_type', [
                'retail_shop',
                'distributor',
                'corporate_purchase',
                'real_estate',
                'other'
            ]);
            $table->text('other_details')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('status', ['new', 'contacted', 'in_progress', 'approved', 'rejected'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
