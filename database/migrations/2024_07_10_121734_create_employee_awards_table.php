<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_awards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('award_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();
    
            $table->foreign('award_id')->references('id')->on('awards')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('employee_awards');
    }
    
}
