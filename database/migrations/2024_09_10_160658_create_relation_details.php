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
        Schema::create('relation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(); // Assuming there's an employee relationship
            $table->string('relationship')->nullable(); // Relationship field
            $table->string('relation_name')->nullable(); // Name field
            $table->string('relation_occupation')->nullable(); // Occupation field
            $table->string('relation_contact')->nullable(); // Contact Info field
            $table->date('relation_dob')->nullable(); // Date of Birth field

            // Add timestamps to track creation and updates
            $table->timestamps();

            // Add foreign key constraint if employee_id is linked to employees table
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation_details');
    }
};
