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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('driver_number');
            $table->unsignedTinyInteger('lap_number');
            $table->decimal('duration_sector_1', 7, 3)->nullable();
            $table->decimal('duration_sector_2', 7, 3)->nullable();
            $table->decimal('duration_sector_3', 7, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
