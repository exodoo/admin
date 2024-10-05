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


        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exoplanet_id');
            $table->string('title');
            $table->string('link');
            $table->text('description')->nullable();
            $table->text('authors')->nullable();
            $table->timestamps();

            $table->foreign('exoplanet_id')
                ->references('id')
                ->on('exoplanets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
