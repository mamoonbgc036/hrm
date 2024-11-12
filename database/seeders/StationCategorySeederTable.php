<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationCategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('station_categories')->truncate();

        DB::table('station_categories')->insert([
            [
                'name' => '1st'
            ],[
                'name' => '2nd'
            ],[
                'name' => '3rd'
            ],[
                'name' => 'Land'
            ],[
                'name' => 'Come River'
            ]
        ]);
    }
}
