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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size_name')->unique();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('size_group')->default(false);
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->string('symbol')->nullable(); // Optional symbol for size
            $table->boolean('is_base_size')->default(false); // Indicates if this is a base size
            $table->double('conversion_value', 8, 2)->default(0.00); // Conversion value for size
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
