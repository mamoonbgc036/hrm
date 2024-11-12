<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posting_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('designation_id')->nullable()->constrained('designations')->onDelete('set null');
            $table->foreignId('station_id')->nullable()->constrained('stations')->onDelete('set null');
            $table->string('grade_id')->nullable();
            $table->string('station_name')->nullable();
            $table->text('station_location')->nullable();
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('attachment_file')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('posting_records');
    }
}
