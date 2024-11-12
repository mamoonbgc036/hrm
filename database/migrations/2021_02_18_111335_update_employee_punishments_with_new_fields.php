<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeePunishmentsWithNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->string('complaint_description')->nullable();
            $table->string('departmental_case_memo_no_date_and_section')->nullable();
            $table->string('settlement_punishment_memo_date_and_description_of_punishment')->nullable();
            $table->string('appeal_and_disposal_order_along_with_the_secretary')->nullable();
            $table->string('case_no_and_judgment_of_the_administrative_tribunal')->nullable();
            $table->string('case_no_and_judgment_of_the_administrative_appeal_tribunal')->nullable();
            $table->string('leave_to_memo_no_and_judgement')->nullable();
            $table->string('review_case_no_and_judgement')->nullable();
            $table->string('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->dropColumn(['complaint_description','departmental_case_memo_no_date_and_section','settlement_punishment_memo_date_and_description_of_punishment','appeal_and_disposal_order_along_with_the_secretary','case_no_and_judgment_of_the_administrative_tribunal','case_no_and_judgment_of_the_administrative_appeal_tribunal','leave_to_memo_no_and_judgement','review_case_no_and_judgement','comments']);
        });
    }
}
