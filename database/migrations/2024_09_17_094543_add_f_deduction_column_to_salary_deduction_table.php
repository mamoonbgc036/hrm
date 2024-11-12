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
        Schema::table('salary_deduction', function (Blueprint $table) {
            $table->string('f_deduction')->nullable()->after('deduction_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salary_deduction', function (Blueprint $table) {
            $table->dropColumn('f_deduction');
        });
    }
};
