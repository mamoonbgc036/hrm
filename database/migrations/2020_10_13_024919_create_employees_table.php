<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            //employee general information
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('f_name')->nullable(); //father's name
            $table->string('m_name')->nullable(); //mother's name
            $table->string('pin_no')->unique()->nullable();
            $table->string('religion')->nullable();
            $table->string('highest_education')->nullable();
            $table->enum('blood_group', ['A+', 'A-','B+','B-','O+','O-','AB+','AB-'])->nullable();
            $table->string('batch_no')->nullable();
            $table->string('batch_no_ext')->nullable();
            $table->string('id_card_no')->unique()->nullable();
            $table->string('gpf_no')->nullable();
            $table->string('welfare_no')->nullable();
            $table->string('passport_no')->unique()->nullable();
            $table->string('nid_no')->unique()->nullable();
            $table->string('e_tin_no')->nullable();
            $table->enum('gender', ['Male','Female','Other'])->nullable();
            //personal information
            $table->date('dob')->nullable(); //date of birth
            $table->date('join_date')->nullable();
            $table->date('lpr_date')->nullable(); //retired date
            $table->string('age')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('birth_district')->nullable();
            $table->string('nationality')->nullable();
            $table->string('disability_code')->nullable();
            $table->string('quota')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('s_name')->nullable(); //spouse name
            $table->foreignId('e_home_district_id')->nullable()->constrained('districts')->onDelete('set null');//employee home destrict
            $table->foreignId('s_home_district_id')->nullable()->constrained('districts')->onDelete('set null');//spouse home destrict
            $table->integer('total_boy_child')->nullable();
            $table->integer('total_girl_child')->nullable();
            //contact information
            $table->string('mobile_no')->unique()->nullable();
            $table->string('alter_mobile')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('alter_email')->nullable();
            $table->string('home_contact_number')->nullable();
            $table->string('e_contact_person_name')->nullable(); //emergency contact
            $table->string('e_contact_person_number')->nullable();
            $table->string('e_contact_person_relation')->nullable();
            //body details
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('identification')->nullable();

            $table->foreignId('sub_department_id')->nullable()->constrained('sub_departments')->onDelete('set null');
            $table->foreignId('station_id')->nullable()->constrained('stations')->onDelete('set null');

            //job assign
            $table->foreignId('designation_id')->nullable()->constrained('designations')->onDelete('set null');
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('police_station_id')->nullable()->constrained('stations')->onDelete('set null');
            $table->string('upazila_id')->nullable();
            $table->string('grade_id')->nullable();
            $table->string('office')->nullable();
            $table->string('post_office')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('img_url')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
