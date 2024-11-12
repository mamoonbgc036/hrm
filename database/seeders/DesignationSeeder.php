<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['bn_name' => 'স্টেশন ইনচার্জ', 'status' => 'active'],
            ['bn_name' => 'উপসহকারী পরিচালক', 'status' => 'active'],
            ['bn_name' => 'সহকারী পরিচালক',  'status' => 'active'],
            ['bn_name' => 'উপপরিচালক', 'status' => 'active'],
            ['bn_name' => 'মহাপরিচালক', 'status' => 'active'],
            ['bn_name' => 'পরিচালক', 'status' => 'active'],
            ['bn_name' => 'অধ্যক্ষ', 'status' => 'active'],
            ['bn_name' => 'যুগ্মঃ পরিচালক', 'status' => 'active'],
            ['bn_name' => 'সহকারী পরিচালক (ক্রয় ও স্টোর)', 'status' => 'active'],
            ['bn_name' => 'ফোরম্যান', 'status' => 'active'],
        ];
        \DB::table('designations')->insert($data);
    }
}
