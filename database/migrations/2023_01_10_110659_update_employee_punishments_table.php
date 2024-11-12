<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeePunishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->text('complaint_description')->change();
            $table->text('departmental_case_memo_no_date_and_section')->change();
            $table->text('settlement_punishment_memo_date_and_description_of_punishment')->change();
            $table->text('appeal_and_disposal_order_along_with_the_secretary')->change();
            $table->text('case_no_and_judgment_of_the_administrative_tribunal')->change();
            $table->text('case_no_and_judgment_of_the_administrative_appeal_tribunal')->change();
            $table->text('leave_to_memo_no_and_judgement')->change();
            $table->text('review_case_no_and_judgement')->change();
            $table->text('comments')->change();
            $table->text('punishment_notice')->change();
            $table->text('accused_reply')->change();
            $table->text('action_apply')->change();
            $table->text('disposal_verdict')->change();
            $table->text('additional_notes')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_punishments');
    }
}
