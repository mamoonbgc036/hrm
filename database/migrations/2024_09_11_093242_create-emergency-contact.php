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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('employee_id')->nullable(); // Foreign key, nullable
            $table->string('e_contact_person_name')->nullable(); // Name, nullable
            $table->string('e_contact_person_number')->nullable(); // Contact Number, nullable
            $table->string('e_contact_person_relation')->nullable(); // Relation, nullable
            $table->string('e_contact_person_email')->nullable(); // Email, nullable
            $table->text('e_contact_person_address')->nullable(); // Address, nullable
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
