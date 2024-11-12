<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmployeePunishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_punishments', function (Blueprint $table) {
            $table->string('punishment_notice')->nullable();
            $table->string('accused_reply')->nullable();
            $table->string('action_apply')->nullable();
            $table->string('disposal_verdict')->nullable();
            $table->string('additional_notes')->nullable();
            $table->string('complaint_file')->nullable();
            $table->string('departmental_case_file')->nullable();
            $table->string('settlement_punishment_file')->nullable();
            $table->string('appeal_and_disposal_file')->nullable();
            $table->string('case_no_and_judgment_file')->nullable();
            $table->string('case_no_administrative_file')->nullable();
            $table->string('leave_to_memo_file')->nullable();
            $table->string('review_case_no_file')->nullable();
            $table->string('comments_file')->nullable();
            $table->string('punishment_notice_file')->nullable();
            $table->string('accused_reply_file')->nullable();
            $table->string('action_apply_file')->nullable();
            $table->string('disposal_verdict_file')->nullable();
            $table->string('additional_notes_file')->nullable();
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
            $table->dropColumn([
                'punishment_notice',
                'accused_reply',
                'action_apply',
                'disposal_verdict',
                'additional_notes',
                'complaint_file',
                'departmental_case_file',
                'settlement_punishment_file',
                'appeal_and_disposal_file',
                'case_no_and_judgment_file',
                'case_no_administrative_file',
                'leave_to_memo_file',
                'review_case_no_file',
                'comments_file',
                'punishment_notice_file',
                'accused_reply_file',
                'action_apply_file',
                'disposal_verdict_file',
                'additional_notes_file'
            ]);
        });
    }
}
