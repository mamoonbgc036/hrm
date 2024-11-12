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
            $table->tinyInteger('show_cause')->after('offence');
            $table->tinyInteger('financial_punishment_type')->after('show_cause');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->dropColumn('show_cause');
            $table->dropColumn('financial_punishment_type');
        });
    }
};
