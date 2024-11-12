<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_id')->constrained('achievements')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('issue_authorities')->nullable();
            $table->text('memo_no')->nullable();
            $table->date('memo_date')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('attachment_file')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievement_employee');
    }
}
