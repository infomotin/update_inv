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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name')->unique();
            $table->string('symbol')->unique();
            $table->string('std_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_base_unit')->default(false);
            $table->double('conversion_value', 8, 2)->default(0.00);
            $table->string('conversion_unit_id')->nullable();
            $table->boolean('is_base_conversion')->default(false);
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
