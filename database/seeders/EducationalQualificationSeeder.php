<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EducationalQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
          [
              'employee_id'=>1,
              'degree'=>'HSC',
              'year'=>'2005',
              'gpa'=>'4.06',
              'subject_name'=>'SCIENCE',
              'board'=>'RAJSHAHI',
          ]
        ];

        \DB::table('educational_qualifications')->insert($data);
    }
}
