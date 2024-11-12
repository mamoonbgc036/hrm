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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('hour_rate_id')->constrained('hour_rates')->cascadeOnDelete();
            $table->string('name');
            $table->string('category_id')->nullable();
            $table->string('start_date');
            $table->string('due_date');
            $table->text('description')->nullable();
            $table->string('estimated_time')->nullable();
            $table->string('task_status');
            $table->string('billable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
