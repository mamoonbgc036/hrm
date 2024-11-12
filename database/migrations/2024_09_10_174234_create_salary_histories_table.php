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
        Schema::create('salary_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->string('gross_salary')->nullable();
            $table->string('t_allowanc')->nullable();
            $table->string('t_deduction')->nullable();
            $table->string('o_deduction')->nullable();
            $table->string('o_allowanc')->nullable();
            $table->string('month_year')->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_histories');
    }
};
