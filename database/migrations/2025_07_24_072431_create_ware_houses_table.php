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
        Schema::create('ware_houses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            // Additional fields can be added as needed
            $table->boolean('status')->default(true); // Active/Inactive status
            $table->string('created_by')->nullable(); // User who created the warehouse
            $table->string('updated_by')->nullable(); // User who last updated the warehouse
            $table->timestamp('deleted_at')->nullable(); // Soft delete timestamp
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            // social media links;
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('website_link')->nullable();
            // Add any other fields as necessary
            $table->string('logo')->nullable(); // Logo for the warehouse
            $table->string('banner_image')->nullable(); // Banner image for the warehouse
            $table->string('contact_person')->nullable(); // Contact person for the warehouse
            $table->string('contact_person_phone')->nullable(); // Contact person's phone number
            $table->string('contact_person_email')->nullable(); // Contact person's email address
            $table->string('warehouse_code')->unique(); // Unique code for the warehouse
            $table->string('tax_id')->nullable(); // Tax ID for the warehouse
            $table->string('vat_number')->nullable(); // VAT number for the warehouse
            $table->string('business_license')->nullable(); // Business license number
            $table->string('business_license_expiry')->nullable(); // Expiry date for the business license
            $table->string('warehouse_type')->nullable(); // Type of warehouse (e.g., cold storage, dry storage, etc.)
            $table->string('operational_hours')->nullable(); // Operational hours of the warehouse
            $table->string('security_features')->nullable(); // Security features of the warehouse
            $table->string('accessibility_features')->nullable(); // Accessibility features of the warehouse
            $table->string('environmental_certifications')->nullable(); // Environmental certifications of the warehouse
            $table->string('insurance_details')->nullable(); // Insurance details
            $table->string('insurance_provider')->nullable(); // Insurance provider for the warehouse
            $table->string('insurance_policy_number')->nullable(); // Insurance policy number
            $table->date('insurance_expiry_date')->nullable(); // Expiry date for the insurance policy
            $table->string('emergency_contact_name')->nullable(); // Emergency contact name
            $table->string('emergency_contact_phone')->nullable(); // Emergency contact phone number
            $table->string('emergency_contact_email')->nullable(); // Emergency contact email address
            $table->string('warehouse_manager')->nullable(); // Name of the warehouse manager
            $table->string('warehouse_manager_phone')->nullable(); // Phone number of the warehouse manager
            $table->string('warehouse_manager_email')->nullable(); // Email address of the warehouse manager
            $table->string('warehouse_capacity')->nullable(); // Total capacity of the warehouse
            $table->string('current_stock')->nullable(); // Current stock in the warehouse
            // $table->string('stock_capacity')->nullable(); // Stock capacity of the warehouse
            // $table->string('temperature_control')->nullable(); // Temperature control features of the warehouse
            // $table->string('humidity_control')->nullable(); // Humidity control features of the warehouse
            // $table->string('loading_docks')->nullable(); // Number of loading docks available
            // $table->string('forklift_availability')->nullable(); // Availability of forklifts in the warehouse
            $table->string('pallet_racking_system')->nullable(); // Type of pallet racking system used
            $table->string('safety_features')->nullable(); // Safety features of the warehouse
            $table->string('fire_safety_measures')->nullable(); // Fire safety measures in place
            $table->string('emergency_exits')->nullable(); // Emergency exits available in the warehouse
            $table->string('first_aid_facilities')->nullable(); // First aid facilities available
            $table->string('warehouse_layout')->nullable(); // Layout of the warehouse
            $table->string('warehouse_size')->nullable(); // Size of the warehouse
            $table->string('warehouse_location')->nullable(); // Location of the warehouse
            $table->string('warehouse_coordinates')->nullable(); // GPS coordinates of the warehouse
            $table->string('warehouse_accessibility')->nullable(); // Accessibility features of the warehouse
            // $table->string('warehouse_security')->nullable(); // Security features of the warehouse
            // $table->string('warehouse_maintenance_schedule')->nullable(); // Maintenance schedule for the warehouse
            // $table->string('warehouse_cleaning_schedule')->nullable(); // Cleaning schedule for the warehouse
            // $table->string('warehouse_inspection_schedule')->nullable(); // Inspection schedule for the warehouse
            $table->string('warehouse_compliance_certifications')->nullable(); // Compliance certifications for the warehouse
            $table->string('warehouse_regulatory_compliance')->nullable(); // Regulatory compliance details


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ware_houses');
    }
};
