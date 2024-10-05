<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exoplanets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('star_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');
            $table->string('type');
            $table->text('description')->nullable();
            $table->float('mass')->nullable();
            $table->float('radius')->nullable();
            $table->float('orbital_period')->default(0);
            $table->string('semi_major_axis')->nullable();
            $table->float('eccentricity')->default(0);
            $table->float('temperature')->nullable();
            $table->float('gravity')->default(0);
            $table->float('density')->default(0);
            $table->boolean('habitability')->default(false);
            $table->text('surface_conditions')->nullable();
            $table->float('age')->nullable();
            $table->float('distance_from_earth')->nullable();
            $table->float('travel_time')->default(0);
            $table->string('discovered_method')->nullable();
            $table->string('exoplanet_type')->nullable();
            $table->string('planet_texture')->nullable();
            $table->string('surface_photos')->nullable();
            $table->string('locals_portrait')->nullable();
            $table->string('flora_photos')->nullable();
            $table->string('camp_photo')->nullable();
            $table->string('background')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exoplanets');
    }
};
