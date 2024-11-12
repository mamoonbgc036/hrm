<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('CASCADE');
            $table->string('course_title');
            $table->dateTime('course_start_date');
            $table->dateTime('course_end_date');
            $table->string('training_type');
            $table->string('institute_name');
            $table->string('institute_address');
            $table->longText('course_description');
            $table->string('result');
            $table->dateTime('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
