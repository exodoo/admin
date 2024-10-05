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
        Schema::create('planets', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('type');
            $table->text('description')->nullable();
            $table->float('mass')->nullable();
            $table->float('radius')->nullable();
            $table->float('orbital_period')->nullable();
            $table->float('semi_major_axis')->nullable();
            $table->float('eccentricity')->nullable();
            $table->float('temperature')->nullable();
            $table->float('gravity')->nullable();
            $table->float('density')->nullable();
            $table->boolean('habitability')->nullable();
            $table->text('surface_conditions')->nullable();
            $table->float('age')->nullable();
            $table->float('distance_from_earth')->nullable();
            $table->float('travel_time')->nullable();
            $table->string('discovered_method')->nullable();
            $table->string('image')->nullable();
            $table->string('planet_texture')->nullable();
            $table->string('locals_portrait')->nullable();
            $table->string('flora_photos')->nullable();
            $table->string('camp_photo')->nullable();
            $table->json('surface_photos')->nullable();
            $table->json('sky_photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
