<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_qualifications', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('employee_id')->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('cascade');
            $table->enum('type',['jsc','ssc','hsc','graduation','masters','more'])->nullable();
            $table->string('examination')->nullable();
            $table->string('board')->nullable();
            $table->string('roll')->nullable();
            $table->string('result')->nullable();
            $table->string('subject')->nullable();
            $table->string('duration')->nullable();
            $table->string('passing_year')->nullable();
            $table->string('institute')->nullable();

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
//        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('educational_qualifications');
//        Schema::enableForeignKeyConstraints();
    }
}
