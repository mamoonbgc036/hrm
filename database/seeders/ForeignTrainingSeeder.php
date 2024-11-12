<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForeignTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data =[
            [
             'hr_id'=>'1',
             'course_title'=>'HAZMAT TRAINING COURSE',
             //'organization'=>'MALAYSIA FIRE DEPARTMENT',
             'country_id'=>'1',
             'from_date'=>'2018-04-30',
             'to_date'=>'2018-05-13',
             'duration'=>'15',
             ]
         ];
        DB::table('foreign_trainings')->insert($data);
    }
}
