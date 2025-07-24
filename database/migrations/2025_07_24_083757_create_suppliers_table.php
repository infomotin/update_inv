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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->boolean('status')->default(true);
            $table->string('brand')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('supplier_code')->unique(); // Unique code
            $table->string('tax_id')->nullable(); // Optional tax ID
            $table->string('bank_account')->nullable(); // Optional bank account details
            $table->string('bank_name')->nullable(); // Optional bank name
            $table->string('bank_branch')->nullable(); // Optional bank branch
            $table->string('bank_ifsc')->nullable(); // Optional IFSC code for bank
            $table->string('bank_swift')->nullable(); // Optional SWIFT code for international transactions
            $table->string('payment_terms')->nullable(); // Optional payment terms
            $table->string('shipping_terms')->nullable(); // Optional shipping terms
            $table->string('notes')->nullable(); // Optional notes field for additional information
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
