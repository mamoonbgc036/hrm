<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParmanentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parmanent_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->onDelete('set null');
            $table->string('post_office')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('area')->nullable();
            $table->string('u_c_c_w')->nullable(); //union_city_corporation_word
            $table->string('house_no')->nullable();
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
        Schema::dropIfExists('parmanent_addresses');
    }
}
