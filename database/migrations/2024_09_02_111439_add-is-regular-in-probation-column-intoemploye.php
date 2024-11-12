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
        Schema::table('employees', function (Blueprint $table) {
            $table->char('is_contractual', 1)->default('N'); // Add your first column with a fixed length of 10 characters
            $table->char('in_probation', 1)->default('Y'); // Add second column with a fixed length of 1 character and default value 'Y'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
