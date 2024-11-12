<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('hr_id')->unique(); //auto generate unique number for search
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->string('course_title');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->string('course_code')->nullable();
            $table->string('memo_number')->nullable();
            $table->string('memo_date')->nullable();
            $table->string('result')->nullable();
            $table->string('course_coordinator')->nullable();
            $table->string('venue')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_trainings');
    }
}
