<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('show_sidebar')->default(1);
            $table->boolean('show_recent_posts')->default(1);
            $table->boolean('show_categories')->default(1);
            $table->integer('recent_posts_count')->default(5);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_settings');
    }
};
