<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Designation;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Grade;
use App\Models\Relationship;
use App\Models\Station;
use App\Models\Upazila;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $religions = Employee::religions();
        $blood_groups = Employee::blood_groups();
        $batches = Batch::select('name')->get();
        $date = new DateTime(rand(1900,2000).'-'.str_pad(rand(1,12),2,"0",STR_PAD_LEFT).'-'.str_pad(rand(1,31),2,"0",STR_PAD_LEFT));
        $districts = District::select('name')->get();
        $relationships = Relationship::select('name')->get();
        $genders = ['Male','Female','Other'];
        $birth_countries = ['Bangladesh','India','Pakistan','Other'];
        $nationalities = ['General','Freedom Fighter','Pakistani','Other'];
        $maritals = ['single','married','separated'];
        $quotas = ['General','Freedom Fighter'];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'f_name' => $this->faker->name(),
            'm_name' => $this->faker->name(),
            'pin_no' => $this->faker->numberBetween(1000,999999),
            'new_pin' => $this->faker->numberBetween(1000,999999),
            'religion' => $religions[rand(0,4)],
            'blood_group' => $blood_groups[rand(0,7)],
            'batch_no' => $batches[rand(0,7)]['name'],

            'batch_no_ext' => rand(1,99),
            'id_card_no' => Str::random(1).$this->faker->numberBetween(1000000,9999999),
            'gpf_no' => $this->faker->name().rand(10,999),
            'welfare_no' => rand(1000,99999),
            'womens_welfare_no' => rand(1000,99999),
            'passport_no' => $this->faker->numberBetween(1000000000,9999999999),
            'nid_no' => $this->faker->numberBetween(100000000000000,999999999999999),
            'gender' => $genders[rand(0,2)],
            'dob' => $date->format('Y-m-d'),
            'join_date' => $date->format('Y-m-d'),
            'lpr_date' => $date->format('Y-m-d'),
            'birth_country' => $birth_countries[rand(0,3)],
            'birth_district' => $districts[rand(1,District::count()-1)],
            'nationality' => $nationalities[rand(0,3)],
            'disability_code' => NULL,
            'e_tin_no' => Str::random(10),
            'quota' => $quotas[rand(0,1)],
            'marital_status' => $maritals[rand(0,2)],
            'height' => rand(50,80).'INCH',
            'weight' => rand(45,100).'KG',
            'identification' => Str::random(20),
            'mobile_no' => '01'.$this->faker->numberBetween(100000000,999999999),
            'home_contact_number' => '01'.$this->faker->numberBetween(100000000,999999999),
            'e_contact_person_name' => $this->faker->name(),
            'e_contact_person_number' => '01'.$this->faker->numberBetween(100000000,999999999),
            'e_contact_person_relation' => rand(1,Relationship::count()),

            'designation_id' => rand(1,Designation::count()),
            'police_station_id' => rand(1,Station::count()),
            'grade_id' => rand(1,Grade::count()),
            'division_id' => rand(1,Division::count()),
            'district_id' => rand(1,District::count()),
            'upazila_id' => rand(1,Upazila::count()),
            'attached_designation_id' => rand(1,Designation::count()),
            'attached_police_station_id' => rand(1,Station::count()),
            'attached_grade_id' => rand(1,Grade::count()),
            'attached_division_id' => rand(1,Division::count()),
            'attached_district_id' => rand(1,District::count()),
            'attached_upazila_id' => rand(1,Upazila::count()),

        ];
    }
}
