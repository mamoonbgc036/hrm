<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data=[
       /* [
            'id'=>'',
            'department_id'=>'',
            'name'=>'',
            'created_by'=>'',
            'updated_by'=>'',
            'status'=>'',
        ]*/

        /* ['name' =>1,'test', 'status' => 'active'],
          ['name' => 1,'test1', 'status' => 'active'],
          ['name' => 2,'test2', 'status' => 'active'],
          ['name' =>2, 'test3', 'status' => 'active'],*/

          [
              'department_id'=>1,
              'name'=>'test',
          ],
          [
              'department_id'=>1,
              'name'=>'test2',
          ]
      ];
        \DB::table('sub_departments')->insert($data);
    }
}
