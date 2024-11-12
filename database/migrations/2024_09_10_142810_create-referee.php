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
        Schema::create('referees', function (Blueprint $table){
            $table->id();
            $table->Integer('employee_id')->nullable(); // If employee_id refers to another table
            $table->string('referee_name')->nullable(); // Adjust length as needed
            $table->unsignedBigInteger('referee_organization_id')->nullable();
            $table->string('referee_occupation')->nullable(); // Adjust length as needed
            $table->string('referee_contact')->nullable(); // Adjust length as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referees');
    }
};
