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
        Schema::create('salary_allowance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_template_id');
            $table->string('allowance_label');
            $table->decimal('allowance_value', 10, 2);            
            $table->decimal('allowance_percent', 10, 2);
            $table->string('allowance_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_allowance');
    }
};
