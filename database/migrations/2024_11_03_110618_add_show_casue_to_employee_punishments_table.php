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
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->decimal('fine_amount')->after('financial_punishment_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->dropColumn('fine_amount');
        });
    }
};
