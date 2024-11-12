<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominees', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('employee_id')->nullable();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('relationship_id')->nullable()->constrained('relationships')->onDelete('set null');
            $table->string('relationship')->nullable();
            $table->string('name');
            $table->text('permanent_address')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('percentage')->nullable();
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
        Schema::dropIfExists('nominees');
    }
}
