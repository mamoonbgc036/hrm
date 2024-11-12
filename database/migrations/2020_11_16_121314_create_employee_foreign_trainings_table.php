<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeForeignTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_foreign_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foreign_training_id')->constrained('foreign_trainings')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->string('memo_number')->nullable();
            $table->date('memo_date')->nullable();
            $table->string('result')->nullable();
            $table->string('course_coordinator')->nullable();
            $table->string('venue')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
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
        Schema::dropIfExists('employee_foreign_trainings');
    }
}
