<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PunishmentSeeder extends Seeder
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
            'name'=>'WITHOUT PAY',
            'offence'=>'MISCONDUCT',
            'from_date'=>'2018-01-01',
            'to_date'=>'2018-12-31',
            'duration'=>'365', 'description'=>'Here we will describe about this person in a short.'
          ],
        ];
        \DB::table('punishments')->insert($data);
    }
}
