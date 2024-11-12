<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostingRecordSeeder extends Seeder
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
                'employee_id'=>1,
                'designation_id'=>1,
                'station_id'=>1,
                'station_location'=>'DHAKA',
                'from_date'=>'2016-08-24',
                'to_date'=>'2017-05-05',
                'duration'=>'150',
                'description'=>'This employee was fine enough during the working period in this station',
            ],
        ];
        \DB::table('posting_records')->insert($data);
    }
}
