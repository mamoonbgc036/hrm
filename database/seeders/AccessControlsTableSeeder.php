<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AccessControlsTableSeeder extends Seeder
{


    public function run()
    {

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $dev = \App\Models\User::where('email', 'super@admin.com')->first();

        if (empty($dev)) {

            $data = [
                [
                    'id'=>'1',
                    'name' => 'Super Admin',
                    'email' => 'super@admin.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id'=>'2',
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('12345678'),
                ], [
                    'id'=>'3',
                    'name' => 'Employee',
                    'email' => 'employee@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
            ];

            \DB::table('users')->insert($data);

        }

        $dev = \App\Models\User::where('email', 'super@admin.com')->first();

        //data for roles table
        $data = [
            ['name' => 'Super Admin', 'guard_name' => 'web'],
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Employee', 'guard_name' => 'web'],
        ];
        \DB::table('roles')->insert($data);

        //data for permissions table
        $data = [
            ['name' => 'dashboard', 'guard_name' => 'web'],

            ['name' => 'employee-list', 'guard_name' => 'web'],
            ['name' => 'employee-create', 'guard_name' => 'web'],
            ['name' => 'employee-show', 'guard_name' => 'web'],
            ['name' => 'employee-edit', 'guard_name' => 'web'],
            ['name' => 'employee-delete', 'guard_name' => 'web'],

            ['name' => 'award-list', 'guard_name' => 'web'],
            ['name' => 'award-create', 'guard_name' => 'web'],
            ['name' => 'award-show', 'guard_name' => 'web'],
            ['name' => 'award-edit', 'guard_name' => 'web'],
            ['name' => 'award-delete', 'guard_name' => 'web'],

            ['name' => 'education_qualification-list', 'guard_name' => 'web'],
            ['name' => 'education_qualification-create', 'guard_name' => 'web'],
            ['name' => 'education_qualification-show', 'guard_name' => 'web'],
            ['name' => 'education_qualification-edit', 'guard_name' => 'web'],
            ['name' => 'education_qualification-delete', 'guard_name' => 'web'],

            ['name' => 'punishment-list', 'guard_name' => 'web'],
            ['name' => 'punishment-create', 'guard_name' => 'web'],
            ['name' => 'punishment-show', 'guard_name' => 'web'],
            ['name' => 'punishment-edit', 'guard_name' => 'web'],
            ['name' => 'punishment-delete', 'guard_name' => 'web'],

            ['name' => 'role-list', 'guard_name' => 'web'],
            ['name' => 'role-create', 'guard_name' => 'web'],
            ['name' => 'role-show', 'guard_name' => 'web'],
            ['name' => 'role-edit', 'guard_name' => 'web'],
            ['name' => 'role-delete', 'guard_name' => 'web'],

            ['name' => 'user-list', 'guard_name' => 'web'],
            ['name' => 'user-create', 'guard_name' => 'web'],
            ['name' => 'user-show', 'guard_name' => 'web'],
            ['name' => 'user-edit', 'guard_name' => 'web'],
            ['name' => 'user-delete', 'guard_name' => 'web'],

        ];

        \DB::table('permissions')->insert($data);
        //Data for role user pivot
        $data = [
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => $dev->id],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 2],
            ['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => 3],
        ];
        \DB::table('model_has_roles')->insert($data);
        //Data for role permission pivot
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $data = [
                ['permission_id' => $value->id, 'role_id' => 1],
            ];

            \DB::table('role_has_permissions')->insert($data);

        }


    }
}
