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
        Schema::create('salary_template', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('overtime_salary', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_template');
    }
};
