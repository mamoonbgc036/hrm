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
        Schema::create('staff_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('reason')->nullable();
            $table->date('suspension_date')->nullable();
            $table->text('remarks')->nullable();
            $table->string('attoshat_amount')->nullable();
            $table->string('amount_due')->nullable();
            $table->date('filling_date')->nullable();
            $table->string('advocate')->nullable();
            $table->string('advocate_chamber')->nullable();
            $table->string('advocate_phone')->nullable();
            $table->string('dealing_employee')->nullable();
            $table->string('dealing_employee_phone')->nullable();
            $table->string('dealing_employee_pin')->nullable();
            $table->enum('is_court_thana', ['court', 'thana'])->nullable()->default('court');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_cases');
    }
};
