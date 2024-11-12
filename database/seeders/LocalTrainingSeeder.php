<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocalTrainingSeeder extends Seeder
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
                'course_title'=>'OFFICER FOUNDATION COURSE',
                //'organization'=>'FSCD',
                'location'=>'demra',
                'from_date'=>'2016-08-24',
                'to_date'=>'2017-05-05',
                'duration'=>'286',
            ],
            [
                'hr_id'=>'2',
                'course_title'=>'ORIENTATION COURSE',
                //'organization'=>'FSCD',
                'location'=>'Badda',
                'from_date'=>'2017-08-24',
                'to_date'=>'2018-05-05',
                'duration'=>'286',
            ],
            [
                'hr_id'=>'3',
                'course_title'=>'MFR & CSSR',
                //'organization'=>'FSCD',
                'location'=>'Joyra',
                'from_date'=>'2018-08-24',
                'to_date'=>'2019-05-05',
                'duration'=>'286',
            ],  [
                'hr_id'=>'4',
                'course_title'=>'COMPUTER & ENGLISH LANGUAGE COURSE',
                //'organization'=>'FSCD',
                'location'=>'Goforgao',
                'from_date'=>'2019-08-24',
                'to_date'=>'2020-05-05',
                'duration'=>'286',
            ],
        ];
        \DB::table('local_trainings')->insert($data);
    }
}
