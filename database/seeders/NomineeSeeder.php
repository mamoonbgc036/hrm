<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NomineeSeeder extends Seeder
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
          'employee_id'=>'1',
          'name'=>'MT. RASHADA BEGUM',
          'relationship'=>'MOTHER',
          'permanent_address'=>'bagmara,rajshahi',
          'nid_no'=>'811125016783907',
          'percentage'=>'50%',

      ]
    ];
        \DB::table('nominees')->insert($data);
    }
}
