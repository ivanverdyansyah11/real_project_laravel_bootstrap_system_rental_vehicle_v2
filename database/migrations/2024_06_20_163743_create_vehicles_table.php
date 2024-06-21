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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_series_id')->index()->nullable();
            $table->string('vehicle_image', 255)->nullable();
            $table->string('name', 100);
            $table->string('stnk_name', 100);
            $table->string('license_plate_number', 25);
            $table->integer('kilometer');
            $table->integer('capacity');
            $table->integer('price');
            $table->string('year_of_creation');
            $table->date('date_purchased');
            $table->string('color', 50);
            $table->string('frame_number', 100);
            $table->string('machine_number', 100);
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
