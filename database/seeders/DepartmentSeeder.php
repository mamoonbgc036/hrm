<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Admin', 'status' => 'active'],
            ['name' => 'Operation Maintenance', 'status' => 'active'],
            ['name' => 'Training Development', 'status' => 'active'],
            ['name' => 'Training Center', 'status' => 'active'],
        ];
        \DB::table('departments')->insert($data);
    }
}
