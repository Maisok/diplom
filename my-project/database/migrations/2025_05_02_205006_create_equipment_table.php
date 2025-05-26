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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generation_id')->constrained()->onDelete('cascade');
            $table->foreignId('body_type_id')->constrained();
            $table->foreignId('engine_type_id')->constrained();
            $table->string('engine_name', 50);
            $table->decimal('engine_volume', 3, 1);
            $table->integer('engine_power');
            $table->foreignId('transmission_type_id')->constrained();
            $table->string('transmission_name', 50);
            $table->foreignId('drive_type_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->text('description')->nullable();
            $table->decimal('weight', 6, 1);
            $table->integer('load_capacity')->nullable();
            $table->integer('seats');
            $table->decimal('fuel_consumption', 4, 1);
            $table->integer('fuel_tank_volume')->nullable();
            $table->integer('battery_capacity')->nullable();
            $table->integer('range');
            $table->integer('max_speed');
            $table->integer('clearance');
            $table->string('model_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
