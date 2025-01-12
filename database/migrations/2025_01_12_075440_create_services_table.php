<?php

use App\Helpers\Backend;
use App\Models\Service;
use Carbon\Carbon;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug');
            $table->string('image');
            $table->text('description');
            $table->string('hero_image');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Service::insert([
            'title' => 'Labor',
            'slug' => Backend::Slug('labor'),
            'image' => 'demo.png',
            'description' => 'This is labor',
            'hero_image' => 'demo.png',
            'created_at' => Carbon::now(),
        ]);
        Service::insert([
            'title' => 'Specialist',
            'slug' => Backend::Slug('Specialist'),
            'image' => 'demo.png',
            'description' => 'This is Specialist',
            'hero_image' => 'demo.png',
            'created_at' => Carbon::now(),
        ]);
        Service::insert([
            'title' => 'Event',
            'slug' => Backend::Slug('Event'),
            'image' => 'demo.png',
            'description' => 'This is Event',
            'hero_image' => 'demo.png',
            'created_at' => Carbon::now(),
        ]);
        Service::insert([
            'title' => 'Delivery',
            'slug' => Backend::Slug('Delivery'),
            'image' => 'demo.png',
            'description' => 'This is Delivery',
            'hero_image' => 'demo.png',
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
