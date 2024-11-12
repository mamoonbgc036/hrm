<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachedStationOrOfficeFieldsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            //job assign
            $table->string('is_attached_to_station_or_office')->nullable()->after('attached_file');
            $table->foreignId('attached_designation_id')->nullable()->after('is_attached_to_station_or_office')->constrained('designations')->onDelete('set null');
            $table->foreignId('attached_police_station_id')->nullable()->after('attached_designation_id')->constrained('stations')->onDelete('set null');
            $table->foreignId('attached_division_id')->nullable()->after('attached_police_station_id')->constrained('divisions')->onDelete('set null');
            $table->foreignId('attached_district_id')->nullable()->after('attached_division_id')->constrained('districts')->onDelete('set null');
            $table->foreignId('attached_upazila_id')->nullable()->after('attached_district_id')->constrained('upazilas')->onDelete('set null');
            $table->string('attached_grade_id')->nullable()->after('attached_upazila_id');
            $table->string('attached_attached_file')->nullable()->after('attached_grade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['attached_designation_id']);
            $table->dropForeign(['attached_police_station_id']);
            $table->dropForeign(['attached_division_id']);
            $table->dropForeign(['attached_district_id']);
            $table->dropForeign(['attached_upazila_id']);
            $table->dropColumn(['is_attached_to_station_or_office','attached_designation_id','attached_police_station_id','attached_division_id','attached_district_id','attached_upazila_id','attached_grade_id','attached_attached_file']);
        });
    }
}
