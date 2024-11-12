<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSerialAndPayScaleColumnToDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('designations', function (Blueprint $table) {
            $table->integer('serial')->unique()->after('id')->nullable();
            $table->string('pay_scale')->after('short_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('designations', function (Blueprint $table) {
            $table->dropColumn(['pay_scale','serial']);
        });
    }
}
