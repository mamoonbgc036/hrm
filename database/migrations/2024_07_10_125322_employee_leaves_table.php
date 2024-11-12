<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeeLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['leave_id']);
            
            // Now, drop the index if needed
            $table->dropIndex(['leave_id_foreign']);
            
            // Or drop the column if that's what you intend to do
            $table->dropColumn('leave_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            // Reverse the operations, add the column back if necessary
            $table->unsignedBigInteger('leave_id');
            
            // Add the foreign key constraint back
            $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('cascade');
        });
    }
}
