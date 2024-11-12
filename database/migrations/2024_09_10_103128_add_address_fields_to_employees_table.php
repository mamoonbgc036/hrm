<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Adding integer columns for IDs
            $table->integer('present_country_id')->nullable();
            $table->integer('pr_division_id')->nullable();
            $table->integer('pr_district_id')->nullable();
            $table->integer('pr_upazila_id')->nullable();
            $table->integer('permanent_country_id')->nullable();
            $table->integer('pa_division_id')->nullable();
            $table->integer('pa_district_id')->nullable();
            $table->integer('pa_upazila_id')->nullable();

            // Adding string columns for other fields
            $table->string('pr_post_office')->nullable();
            $table->string('pr_postal_code')->nullable();
            $table->string('pr_area')->nullable();
            $table->string('pr_u_c_c_w')->nullable();
            $table->string('pr_house_no')->nullable();
            $table->string('pa_post_office')->nullable();
            $table->string('pa_postal_code')->nullable();
            $table->string('pa_area')->nullable();
            $table->string('pa_u_c_c_w')->nullable();
            $table->string('pa_house_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Dropping the columns when rolling back
            $table->dropColumn([
                'present_country_id', 'pr_division_id', 'pr_district_id', 'pr_upazila_id',
                'pr_post_office', 'pr_postal_code', 'pr_area', 'pr_u_c_c_w', 'pr_house_no',
                'permanent_country_id', 'pa_division_id', 'pa_district_id', 'pa_upazila_id',
                'pa_post_office', 'pa_postal_code', 'pa_area', 'pa_u_c_c_w', 'pa_house_no'
            ]);
        });
    }
};
