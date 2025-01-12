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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('hero_image')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->nullable();
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade')->nullable();
            $table->boolean('labor_id')->nullable();
            $table->boolean('specialist_id')->nullable();
            $table->boolean('event_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
