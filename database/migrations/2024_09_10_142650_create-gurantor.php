<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('guarantors', function (Blueprint $table) {
            $table->id();
            $table->Integer('employee_id')->nullable(); // If employee_id refers to another table
            $table->string('gurantor_name')->nullable(); // Adjust length as needed
            $table->unsignedBigInteger('gurantor_organization_id')->nullable();
            $table->string('gurantor_occupation')->nullable(); // Adjust length as needed
            $table->string('gurantor_contact')->nullable(); // Adjust length as needed
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurantors');
    }
};
