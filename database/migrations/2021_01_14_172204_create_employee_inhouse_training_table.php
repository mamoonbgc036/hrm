<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInhouseTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_inhouse_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inhouse_training_id')->constrained('inhouse_trainings')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('country')->nullable();
            $table->string('venue')->nullable();
            $table->string('memo_number')->nullable();
            $table->date('memo_date')->nullable();
            $table->string('result')->nullable();
            $table->string('course_coordinator')->nullable();
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('employee_inhouse_training');
    }
}
