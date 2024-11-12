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
            $table->string('deduct_amount')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salary_deduction', function (Blueprint $table) {
            $table->dropColumn('deduct_amount');
        });
    }
};
