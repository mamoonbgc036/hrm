<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_category_id')->nullable()->constrained('station_categories')->onDelete('set null');
            $table->string('name')->unique();
            $table->string('bn_name')->unique()->nullable();
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->onDelete('set null');
            /*$table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('upazila_id');*/
            $table->text('phone')->nullable();
            $table->text('area')->nullable();
            $table->integer('code')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('stations');
    }
}
