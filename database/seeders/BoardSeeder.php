<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boards')->truncate();

        $jsc_boards = [
            ['name' => 'Dhaka', 'type' => 'JSC'],
            ['name' => 'Cumilla', 'type' => 'JSC'],
            ['name' => 'Rajshahi', 'type' => 'JSC'],
            ['name' => 'Jashore', 'type' => 'JSC'],
            ['name' => 'Chittagong', 'type' => 'JSC'],
            ['name' => 'Barishal', 'type' => 'JSC'],
            ['name' => 'Sylhet', 'type' => 'JSC'],
            ['name' => 'Dinajpur', 'type' => 'JSC'],
            ['name' => 'Madrasah', 'type' => 'JSC'],
            ['name' => 'Mymensingh', 'type' => 'JSC'],
            ['name' => 'Cambridge International - IGCE', 'type' => 'JSC'],
            ['name' => 'Edexcel International', 'type' => 'JSC'],
            ['name' => 'Bangladesh Technical Education Board (BTEB)', 'type' => 'JSC'],
            ['name' => 'Others', 'type' => 'JSC'],
        ];

        $ssc_boards = [
            ['name' => 'Dhaka', 'type' => 'SSC'],
            ['name' => 'Cumilla', 'type' => 'SSC'],
            ['name' => 'Rajshahi', 'type' => 'SSC'],
            ['name' => 'Jashore', 'type' => 'SSC'],
            ['name' => 'Chittagong', 'type' => 'SSC'],
            ['name' => 'Barishal', 'type' => 'SSC'],
            ['name' => 'Sylhet', 'type' => 'SSC'],
            ['name' => 'Dinajpur', 'type' => 'SSC'],
            ['name' => 'Madrasah', 'type' => 'SSC'],
            ['name' => 'Mymensingh', 'type' => 'SSC'],
            ['name' => 'Cambridge International - IGCE', 'type' => 'SSC'],
            ['name' => 'Edexcel International', 'type' => 'SSC'],
            ['name' => 'Bangladesh Technical Education Board (BTEB)', 'type' => 'SSC'],
            ['name' => 'Others', 'type' => 'SSC'],
        ];

        $hsc_boards = [
            ['name' => 'Dhaka', 'type' => 'HSC'],
            ['name' => 'Cumilla', 'type' => 'HSC'],
            ['name' => 'Rajshahi', 'type' => 'HSC'],
            ['name' => 'Jashore', 'type' => 'HSC'],
            ['name' => 'Chittagong', 'type' => 'HSC'],
            ['name' => 'Barishal', 'type' => 'HSC'],
            ['name' => 'Sylhet', 'type' => 'HSC'],
            ['name' => 'Dinajpur', 'type' => 'HSC'],
            ['name' => 'Madrasah', 'type' => 'HSC'],
            ['name' => 'Mymensingh', 'type' => 'HSC'],
            ['name' => 'Cambridge International - IGCE', 'type' => 'HSC'],
            ['name' => 'Edexcel International', 'type' => 'HSC'],
            ['name' => 'Bangladesh Technical Education Board (BTEB)', 'type' => 'HSC'],
            ['name' => 'Others', 'type' => 'HSC'],
        ];

        DB::table('boards')->insert($jsc_boards);
        DB::table('boards')->insert($ssc_boards);
        DB::table('boards')->insert($hsc_boards);
    }
}
