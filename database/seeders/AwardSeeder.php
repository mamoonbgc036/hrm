<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param $data
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'hr_id'=>'AR-20110',
                'award_name'=>'FIRE SERVICE & CIVIL DEFENCE AWARD',
                'date' => now(),
                /*'achievement_name'=>'1',
                'name'=>'FIRE SERVICE & CIVIL DEFENCE AWARD',
                'authority'=>'GOVT. OF BANGLADESH',
                'memo_no'=>'fscd/hq/02.0000.03.29',
                'date'=>'2019-11-06',
                'description'=>'Here we will describe about this person in a short.'*/
            ],
        ];
        \DB::table('awards')->insert($data);
    }
}
