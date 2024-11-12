<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Dashboard',
                'parent' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Employee list',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Employee create',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Employee show',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Employee edit',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Employee delete',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Award list',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Award create',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Award show',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Award edit',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Award delete',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Achievement list',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Achievement create',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Achievement show',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Achievement edit',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Achievement delete',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Punishment list',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Punishment create',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Punishment show',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Punishment edit',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Punishment delete',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Role list',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Role create',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Role show',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Role edit',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Role delete',
                'parent' => 'Role',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'User list',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'User create',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'User show',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'User edit',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'User delete',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'Station menu',
                'parent' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:31:26',
                'updated_at' => '2021-06-02 10:31:26',
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'Core data menu',
                'parent' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:34:01',
                'updated_at' => '2021-06-02 10:34:01',
            ),
            33 =>
            array (
                'id' => 34,
                'name' => 'Access control menu',
                'parent' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:34:26',
                'updated_at' => '2021-06-02 10:34:26',
            ),
            34 =>
            array (
                'id' => 35,
                'name' => 'Activity log menu',
                'parent' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:34:36',
                'updated_at' => '2021-06-02 10:34:36',
            ),
            35 =>
            array (
                'id' => 36,
                'name' => 'Job history list',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:38:35',
                'updated_at' => '2021-06-02 10:38:35',
            ),
            36 =>
            array (
                'id' => 37,
                'name' => 'Job history create',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:38:54',
                'updated_at' => '2021-06-02 10:38:54',
            ),
            37 =>
            array (
                'id' => 38,
                'name' => 'Job history show',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:39:01',
                'updated_at' => '2021-06-02 10:39:01',
            ),
            38 =>
            array (
                'id' => 39,
                'name' => 'Job history edit',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:39:08',
                'updated_at' => '2021-06-02 10:39:08',
            ),
            39 =>
            array (
                'id' => 40,
                'name' => 'Job history delete',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:39:15',
                'updated_at' => '2021-06-02 10:39:15',
            ),
            40 =>
            array (
                'id' => 41,
                'name' => 'Abroad training list',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:40:07',
                'updated_at' => '2021-06-02 10:40:07',
            ),
            41 =>
            array (
                'id' => 42,
                'name' => 'Abroad training create',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:40:25',
                'updated_at' => '2021-06-02 10:40:25',
            ),
            42 =>
            array (
                'id' => 43,
                'name' => 'Abroad training show',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:40:31',
                'updated_at' => '2021-06-02 10:40:31',
            ),
            43 =>
            array (
                'id' => 44,
                'name' => 'Abroad training edit',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:40:41',
                'updated_at' => '2021-06-02 10:40:41',
            ),
            44 =>
            array (
                'id' => 45,
                'name' => 'Abroad training delete',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:40:59',
                'updated_at' => '2021-06-02 10:40:59',
            ),
            45 =>
            array (
                'id' => 46,
                'name' => 'Inland training list',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:42:03',
                'updated_at' => '2021-06-02 10:42:03',
            ),
            46 =>
            array (
                'id' => 47,
                'name' => 'Inland training create',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:42:26',
                'updated_at' => '2021-06-02 10:42:26',
            ),
            47 =>
            array (
                'id' => 48,
                'name' => 'Inland training show',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:42:35',
                'updated_at' => '2021-06-02 10:42:35',
            ),
            48 =>
            array (
                'id' => 49,
                'name' => 'Inland training edit',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:42:40',
                'updated_at' => '2021-06-02 10:42:40',
            ),
            49 =>
            array (
                'id' => 50,
                'name' => 'Inland training delete',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:42:46',
                'updated_at' => '2021-06-02 10:42:46',
            ),
            50 =>
            array (
                'id' => 51,
                'name' => 'Inhouse training list',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:43:15',
                'updated_at' => '2021-06-02 10:43:15',
            ),
            51 =>
            array (
                'id' => 52,
                'name' => 'Inhouse training create',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:43:22',
                'updated_at' => '2021-06-02 10:43:22',
            ),
            52 =>
            array (
                'id' => 53,
                'name' => 'Inhouse training show',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:43:28',
                'updated_at' => '2021-06-02 10:43:28',
            ),
            53 =>
            array (
                'id' => 54,
                'name' => 'Inhouse training edit',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:43:33',
                'updated_at' => '2021-06-02 10:43:33',
            ),
            54 =>
            array (
                'id' => 55,
                'name' => 'Inhouse training delete',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:43:39',
                'updated_at' => '2021-06-02 10:43:39',
            ),
            55 =>
            array (
                'id' => 56,
                'name' => 'Leave list',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:44:09',
                'updated_at' => '2021-06-02 10:44:09',
            ),
            56 =>
            array (
                'id' => 57,
                'name' => 'Leave create',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:44:16',
                'updated_at' => '2021-06-02 10:44:16',
            ),
            57 =>
            array (
                'id' => 58,
                'name' => 'Leave show',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:44:24',
                'updated_at' => '2021-06-02 10:44:24',
            ),
            58 =>
            array (
                'id' => 59,
                'name' => 'Leave edit',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:44:35',
                'updated_at' => '2021-06-02 10:44:35',
            ),
            59 =>
            array (
                'id' => 60,
                'name' => 'Leave delete',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:44:41',
                'updated_at' => '2021-06-02 10:44:41',
            ),
            60 =>
            array (
                'id' => 61,
                'name' => 'Station list',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:47:38',
                'updated_at' => '2021-06-02 10:47:38',
            ),
            61 =>
            array (
                'id' => 62,
                'name' => 'Station create',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:47:49',
                'updated_at' => '2021-06-02 10:47:49',
            ),
            62 =>
            array (
                'id' => 63,
                'name' => 'Station show',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:47:56',
                'updated_at' => '2021-06-02 10:47:56',
            ),
            63 =>
            array (
                'id' => 64,
                'name' => 'Station edit',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:48:01',
                'updated_at' => '2021-06-02 10:48:01',
            ),
            64 =>
            array (
                'id' => 65,
                'name' => 'Station delete',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:48:06',
                'updated_at' => '2021-06-02 10:48:06',
            ),
            65 =>
            array (
                'id' => 66,
                'name' => 'Station category list',
                'parent' => 'Station category',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:48:58',
                'updated_at' => '2021-06-02 10:48:58',
            ),
            66 =>
            array (
                'id' => 67,
                'name' => 'Station category create',
                'parent' => 'Station category',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:49:06',
                'updated_at' => '2021-06-02 10:49:06',
            ),
            67 =>
            array (
                'id' => 68,
                'name' => 'Station category show',
                'parent' => 'Station category',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:49:38',
                'updated_at' => '2021-06-02 10:49:38',
            ),
            68 =>
            array (
                'id' => 69,
                'name' => 'Station category edit',
                'parent' => 'Station category',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:49:44',
                'updated_at' => '2021-06-02 10:49:44',
            ),
            69 =>
            array (
                'id' => 70,
                'name' => 'Station category delete',
                'parent' => 'Station category',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 10:49:50',
                'updated_at' => '2021-06-02 10:49:50',
            ),
            70 =>
            array (
                'id' => 71,
                'name' => 'Department list',
                'parent' => 'Department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 17:06:22',
                'updated_at' => '2021-06-02 17:06:22',
            ),
            71 =>
            array (
                'id' => 72,
                'name' => 'Department create',
                'parent' => 'Department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 17:07:17',
                'updated_at' => '2021-06-02 17:07:17',
            ),
            72 =>
            array (
                'id' => 73,
                'name' => 'Department show',
                'parent' => 'Department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 17:07:25',
                'updated_at' => '2021-06-02 17:07:25',
            ),
            73 =>
            array (
                'id' => 74,
                'name' => 'Department edit',
                'parent' => 'Department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 17:07:31',
                'updated_at' => '2021-06-02 17:07:31',
            ),
            74 =>
            array (
                'id' => 75,
                'name' => 'Department delete',
                'parent' => 'Department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 17:07:36',
                'updated_at' => '2021-06-02 17:07:36',
            ),
            75 =>
            array (
                'id' => 76,
                'name' => 'Sub department list',
                'parent' => 'Sub department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:40:33',
                'updated_at' => '2021-06-02 21:40:33',
            ),
            76 =>
            array (
                'id' => 77,
                'name' => 'Sub department create',
                'parent' => 'Sub department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:41:26',
                'updated_at' => '2021-06-02 21:41:26',
            ),
            77 =>
            array (
                'id' => 78,
                'name' => 'Sub department show',
                'parent' => 'Sub department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:41:36',
                'updated_at' => '2021-06-02 21:41:36',
            ),
            78 =>
            array (
                'id' => 79,
                'name' => 'Sub department edit',
                'parent' => 'Sub department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:41:43',
                'updated_at' => '2021-06-02 21:41:43',
            ),
            79 =>
            array (
                'id' => 80,
                'name' => 'Sub department delete',
                'parent' => 'Sub department',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:41:52',
                'updated_at' => '2021-06-02 21:41:52',
            ),
            80 =>
            array (
                'id' => 81,
                'name' => 'Designation list',
                'parent' => 'Designation',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:42:15',
                'updated_at' => '2021-06-02 21:42:15',
            ),
            81 =>
            array (
                'id' => 82,
                'name' => 'Designation create',
                'parent' => 'Designation',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:42:23',
                'updated_at' => '2021-06-02 21:42:23',
            ),
            82 =>
            array (
                'id' => 83,
                'name' => 'Designation show',
                'parent' => 'Designation',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:42:32',
                'updated_at' => '2021-06-02 21:42:32',
            ),
            83 =>
            array (
                'id' => 84,
                'name' => 'Designation edit',
                'parent' => 'Designation',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:45:35',
                'updated_at' => '2021-06-02 21:45:35',
            ),
            84 =>
            array (
                'id' => 85,
                'name' => 'Designation delete',
                'parent' => 'Designation',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:45:49',
                'updated_at' => '2021-06-02 21:45:49',
            ),
            85 =>
            array (
                'id' => 86,
                'name' => 'Division list',
                'parent' => 'Division',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:46:24',
                'updated_at' => '2021-06-02 21:46:24',
            ),
            86 =>
            array (
                'id' => 87,
                'name' => 'Division create',
                'parent' => 'Division',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:46:35',
                'updated_at' => '2021-06-02 21:46:35',
            ),
            87 =>
            array (
                'id' => 88,
                'name' => 'Division show',
                'parent' => 'Division',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:46:49',
                'updated_at' => '2021-06-02 21:46:49',
            ),
            88 =>
            array (
                'id' => 89,
                'name' => 'Division edit',
                'parent' => 'Division',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:47:03',
                'updated_at' => '2021-06-02 21:47:03',
            ),
            89 =>
            array (
                'id' => 90,
                'name' => 'Division delete',
                'parent' => 'Division',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:47:13',
                'updated_at' => '2021-06-02 21:47:13',
            ),
            90 =>
            array (
                'id' => 91,
                'name' => 'District list',
                'parent' => 'District',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:47:35',
                'updated_at' => '2021-06-02 21:47:35',
            ),
            91 =>
            array (
                'id' => 92,
                'name' => 'District create',
                'parent' => 'District',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:47:41',
                'updated_at' => '2021-06-02 21:47:41',
            ),
            92 =>
            array (
                'id' => 93,
                'name' => 'District show',
                'parent' => 'District',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:47:48',
                'updated_at' => '2021-06-02 21:47:48',
            ),
            93 =>
            array (
                'id' => 94,
                'name' => 'District edit',
                'parent' => 'District',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:47:55',
                'updated_at' => '2021-06-02 21:47:55',
            ),
            94 =>
            array (
                'id' => 95,
                'name' => 'District delete',
                'parent' => 'District',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:48:03',
                'updated_at' => '2021-06-02 21:48:03',
            ),
            95 =>
            array (
                'id' => 96,
                'name' => 'Upazila list',
                'parent' => 'Upazila',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:48:24',
                'updated_at' => '2021-06-02 21:48:24',
            ),
            96 =>
            array (
                'id' => 97,
                'name' => 'Upazila create',
                'parent' => 'Upazila',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:48:33',
                'updated_at' => '2021-06-02 21:48:33',
            ),
            97 =>
            array (
                'id' => 98,
                'name' => 'Upazila show',
                'parent' => 'Upazila',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:48:45',
                'updated_at' => '2021-06-02 21:48:45',
            ),
            98 =>
            array (
                'id' => 99,
                'name' => 'Upazila edit',
                'parent' => 'Upazila',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:48:51',
                'updated_at' => '2021-06-02 21:48:51',
            ),
            99 =>
            array (
                'id' => 100,
                'name' => 'Upazila delete',
                'parent' => 'Upazila',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:49:06',
                'updated_at' => '2021-06-02 21:49:06',
            ),
            100 =>
            array (
                'id' => 101,
                'name' => 'Relationship list',
                'parent' => 'Relationship',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:49:27',
                'updated_at' => '2021-06-02 21:49:27',
            ),
            101 =>
            array (
                'id' => 102,
                'name' => 'Relationship create',
                'parent' => 'Relationship',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:49:35',
                'updated_at' => '2021-06-02 21:49:35',
            ),
            102 =>
            array (
                'id' => 103,
                'name' => 'Relationship show',
                'parent' => 'Relationship',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:49:41',
                'updated_at' => '2021-06-02 21:49:41',
            ),
            103 =>
            array (
                'id' => 104,
                'name' => 'Relationship edit',
                'parent' => 'Relationship',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:49:49',
                'updated_at' => '2021-06-02 21:49:49',
            ),
            104 =>
            array (
                'id' => 105,
                'name' => 'Relationship delete',
                'parent' => 'Relationship',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:50:01',
                'updated_at' => '2021-06-02 21:50:01',
            ),
            105 =>
            array (
                'id' => 106,
                'name' => 'Quota list',
                'parent' => 'Quota',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:50:30',
                'updated_at' => '2021-06-02 21:50:30',
            ),
            106 =>
            array (
                'id' => 107,
                'name' => 'Quota create',
                'parent' => 'Quota',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:50:41',
                'updated_at' => '2021-06-02 21:50:41',
            ),
            107 =>
            array (
                'id' => 108,
                'name' => 'Quota show',
                'parent' => 'Quota',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:50:50',
                'updated_at' => '2021-06-02 21:50:50',
            ),
            108 =>
            array (
                'id' => 109,
                'name' => 'Quota edit',
                'parent' => 'Quota',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:50:57',
                'updated_at' => '2021-06-02 21:50:57',
            ),
            109 =>
            array (
                'id' => 110,
                'name' => 'Quota delete',
                'parent' => 'Quota',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:51:04',
                'updated_at' => '2021-06-02 21:51:04',
            ),
            110 =>
            array (
                'id' => 111,
                'name' => 'Grade list',
                'parent' => 'Grade',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:51:39',
                'updated_at' => '2021-06-02 21:51:39',
            ),
            111 =>
            array (
                'id' => 112,
                'name' => 'Grade create',
                'parent' => 'Grade',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:51:52',
                'updated_at' => '2021-06-02 21:51:52',
            ),
            112 =>
            array (
                'id' => 113,
                'name' => 'Grade show',
                'parent' => 'Grade',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:51:58',
                'updated_at' => '2021-06-02 21:51:58',
            ),
            113 =>
            array (
                'id' => 114,
                'name' => 'Grade edit',
                'parent' => 'Grade',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:52:06',
                'updated_at' => '2021-06-02 21:52:06',
            ),
            114 =>
            array (
                'id' => 115,
                'name' => 'Grade delete',
                'parent' => 'Grade',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:52:18',
                'updated_at' => '2021-06-02 21:52:18',
            ),
            115 =>
            array (
                'id' => 116,
                'name' => 'Office list',
                'parent' => 'Office',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:52:34',
                'updated_at' => '2021-06-02 21:52:34',
            ),
            116 =>
            array (
                'id' => 117,
                'name' => 'Office create',
                'parent' => 'Office',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:52:43',
                'updated_at' => '2021-06-02 21:52:43',
            ),
            117 =>
            array (
                'id' => 118,
                'name' => 'Office show',
                'parent' => 'Office',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:52:53',
                'updated_at' => '2021-06-02 21:52:53',
            ),
            118 =>
            array (
                'id' => 119,
                'name' => 'Office edit',
                'parent' => 'Office',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:53:00',
                'updated_at' => '2021-06-02 21:53:00',
            ),
            119 =>
            array (
                'id' => 120,
                'name' => 'Office delete',
                'parent' => 'Office',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:53:09',
                'updated_at' => '2021-06-02 21:53:09',
            ),
            120 =>
            array (
                'id' => 121,
                'name' => 'Subject list',
                'parent' => 'Subject',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:53:24',
                'updated_at' => '2021-06-02 21:53:24',
            ),
            121 =>
            array (
                'id' => 122,
                'name' => 'Subject create',
                'parent' => 'Subject',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:53:34',
                'updated_at' => '2021-06-02 21:53:34',
            ),
            122 =>
            array (
                'id' => 123,
                'name' => 'Subject show',
                'parent' => 'Subject',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:53:47',
                'updated_at' => '2021-06-02 21:53:47',
            ),
            123 =>
            array (
                'id' => 124,
                'name' => 'Subject edit',
                'parent' => 'Subject',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:55:57',
                'updated_at' => '2021-06-02 21:55:57',
            ),
            124 =>
            array (
                'id' => 125,
                'name' => 'Subject delete',
                'parent' => 'Subject',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:56:51',
                'updated_at' => '2021-06-02 21:56:51',
            ),
            125 =>
            array (
                'id' => 126,
                'name' => 'Institute list',
                'parent' => 'Institute',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:57:55',
                'updated_at' => '2021-06-02 21:57:55',
            ),
            126 =>
            array (
                'id' => 127,
                'name' => 'Institute create',
                'parent' => 'Institute',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:58:16',
                'updated_at' => '2021-06-02 21:58:16',
            ),
            127 =>
            array (
                'id' => 128,
                'name' => 'Institute show',
                'parent' => 'Institute',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:59:32',
                'updated_at' => '2021-06-02 21:59:32',
            ),
            128 =>
            array (
                'id' => 129,
                'name' => 'Institute edit',
                'parent' => 'Institute',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 21:59:44',
                'updated_at' => '2021-06-02 21:59:44',
            ),
            129 =>
            array (
                'id' => 130,
                'name' => 'Institute delete',
                'parent' => 'Institute',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:00:21',
                'updated_at' => '2021-06-02 22:00:21',
            ),
            130 =>
            array (
                'id' => 131,
                'name' => 'Batch list',
                'parent' => 'Batch',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:01:23',
                'updated_at' => '2021-06-02 22:01:23',
            ),
            131 =>
            array (
                'id' => 132,
                'name' => 'Batch create',
                'parent' => 'Batch',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:01:36',
                'updated_at' => '2021-06-02 22:01:36',
            ),
            132 =>
            array (
                'id' => 133,
                'name' => 'Batch show',
                'parent' => 'Batch',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:01:48',
                'updated_at' => '2021-06-02 22:01:48',
            ),
            133 =>
            array (
                'id' => 134,
                'name' => 'Batch edit',
                'parent' => 'Batch',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:01:57',
                'updated_at' => '2021-06-02 22:01:57',
            ),
            134 =>
            array (
                'id' => 135,
                'name' => 'Batch delete',
                'parent' => 'Batch',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:02:03',
                'updated_at' => '2021-06-02 22:02:03',
            ),
            135 =>
            array (
                'id' => 136,
                'name' => 'Action list',
                'parent' => 'Action',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:02:18',
                'updated_at' => '2021-06-02 22:02:18',
            ),
            136 =>
            array (
                'id' => 137,
                'name' => 'Action create',
                'parent' => 'Action',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:02:28',
                'updated_at' => '2021-06-02 22:02:28',
            ),
            137 =>
            array (
                'id' => 138,
                'name' => 'Action show',
                'parent' => 'Action',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:02:35',
                'updated_at' => '2021-06-02 22:02:35',
            ),
            138 =>
            array (
                'id' => 139,
                'name' => 'Action edit',
                'parent' => 'Action',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:02:41',
                'updated_at' => '2021-06-02 22:02:41',
            ),
            139 =>
            array (
                'id' => 140,
                'name' => 'Action delete',
                'parent' => 'Action',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:02:47',
                'updated_at' => '2021-06-02 22:02:47',
            ),
            140 =>
            array (
                'id' => 141,
                'name' => 'Permission list',
                'parent' => 'Permission',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:03:04',
                'updated_at' => '2021-06-02 22:03:04',
            ),
            141 =>
            array (
                'id' => 142,
                'name' => 'Permission create',
                'parent' => 'Permission',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:03:14',
                'updated_at' => '2021-06-02 22:03:14',
            ),
            142 =>
            array (
                'id' => 143,
                'name' => 'Permission show',
                'parent' => 'Permission',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:03:22',
                'updated_at' => '2021-06-02 22:03:22',
            ),
            143 =>
            array (
                'id' => 144,
                'name' => 'Permission edit',
                'parent' => 'Permission',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:03:30',
                'updated_at' => '2021-06-02 22:03:30',
            ),
            144 =>
            array (
                'id' => 145,
                'name' => 'Permission delete',
                'parent' => 'Permission',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:03:39',
                'updated_at' => '2021-06-02 22:03:39',
            ),
            145 =>
            array (
                'id' => 146,
                'name' => 'Login activity list',
                'parent' => 'Login activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:04:00',
                'updated_at' => '2021-06-02 22:04:00',
            ),
            146 =>
            array (
                'id' => 148,
                'name' => 'Login activity show',
                'parent' => 'Login activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:04:14',
                'updated_at' => '2021-06-02 22:04:14',
            ),
            147 =>
            array (
                'id' => 150,
                'name' => 'Login activity clear button',
                'parent' => 'Login activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:04:29',
                'updated_at' => '2021-06-02 22:04:29',
            ),
            148 =>
            array (
                'id' => 151,
                'name' => 'Admin activity list',
                'parent' => 'Admin activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:04:54',
                'updated_at' => '2021-06-02 22:04:54',
            ),
            149 =>
            array (
                'id' => 153,
                'name' => 'Admin activity show',
                'parent' => 'Admin activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:05:06',
                'updated_at' => '2021-06-02 22:05:06',
            ),
            150 =>
            array (
                'id' => 155,
                'name' => 'Admin activity clear button',
                'parent' => 'Admin activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-02 22:05:17',
                'updated_at' => '2021-06-02 22:05:17',
            ),
            151 =>
            array (
                'id' => 156,
                'name' => 'Employee assign',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 18:58:52',
                'updated_at' => '2021-06-05 18:58:52',
            ),
            152 =>
            array (
                'id' => 157,
                'name' => 'Employee upcoming prl list',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 18:59:42',
                'updated_at' => '2021-06-05 18:59:42',
            ),
            153 =>
            array (
                'id' => 158,
                'name' => 'Employee prl list',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 18:59:57',
                'updated_at' => '2021-06-05 18:59:57',
            ),
            154 =>
            array (
                'id' => 159,
                'name' => 'Employee search button',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 19:00:23',
                'updated_at' => '2021-06-05 19:00:23',
            ),
            155 =>
            array (
                'id' => 160,
                'name' => 'Employee deleted button',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 19:00:32',
                'updated_at' => '2021-06-05 19:00:32',
            ),
            156 =>
            array (
                'id' => 161,
                'name' => 'Employee export button',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 19:00:53',
                'updated_at' => '2021-06-05 19:00:53',
            ),
            157 =>
            array (
                'id' => 162,
                'name' => 'Employee pds button',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-05 19:20:07',
                'updated_at' => '2021-06-05 19:20:07',
            ),
            158 =>
            array (
                'id' => 163,
                'name' => 'Job history promotions button',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:09:17',
                'updated_at' => '2021-06-06 10:09:17',
            ),
            159 =>
            array (
                'id' => 164,
                'name' => 'Job history transfers button',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:09:36',
                'updated_at' => '2021-06-06 10:09:36',
            ),
            160 =>
            array (
                'id' => 165,
                'name' => 'Job history deleted button',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:09:52',
                'updated_at' => '2021-06-06 10:09:52',
            ),
            161 =>
            array (
                'id' => 166,
                'name' => 'Job history reset types button',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:14:21',
                'updated_at' => '2021-06-06 10:14:21',
            ),
            162 =>
            array (
                'id' => 167,
                'name' => 'Employee restore',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:30:07',
                'updated_at' => '2021-06-06 10:30:07',
            ),
            163 =>
            array (
                'id' => 168,
                'name' => 'Employee permanent delete',
                'parent' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:33:45',
                'updated_at' => '2021-06-06 10:33:45',
            ),
            164 =>
            array (
                'id' => 169,
                'name' => 'Job history restore',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:49:03',
                'updated_at' => '2021-06-06 10:49:03',
            ),
            165 =>
            array (
                'id' => 170,
                'name' => 'Job history permanent delete',
                'parent' => 'Job history',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 10:49:22',
                'updated_at' => '2021-06-06 10:49:22',
            ),
            166 =>
            array (
                'id' => 171,
                'name' => 'Punishment deleted button',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:06:52',
                'updated_at' => '2021-06-06 13:06:52',
            ),
            167 =>
            array (
                'id' => 172,
                'name' => 'Punishment pending button',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:07:05',
                'updated_at' => '2021-06-06 13:07:05',
            ),
            168 =>
            array (
                'id' => 173,
                'name' => 'Punishment give/assign',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:07:43',
                'updated_at' => '2021-06-06 13:07:43',
            ),
            169 =>
            array (
                'id' => 174,
                'name' => 'Punishment approve',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:09:04',
                'updated_at' => '2021-06-06 13:09:04',
            ),
            170 =>
            array (
                'id' => 175,
                'name' => 'Punishment deny',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:09:11',
                'updated_at' => '2021-06-06 13:09:11',
            ),
            171 =>
            array (
                'id' => 176,
                'name' => 'Punishment restore',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:09:32',
                'updated_at' => '2021-06-06 13:09:32',
            ),
            172 =>
            array (
                'id' => 177,
                'name' => 'Punishment permanent delete',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:10:07',
                'updated_at' => '2021-06-06 13:10:07',
            ),
            173 =>
            array (
                'id' => 178,
                'name' => 'Punishment delete assigned',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:12:20',
                'updated_at' => '2021-06-06 13:12:20',
            ),
            174 =>
            array (
                'id' => 179,
                'name' => 'Punishment edit assigned',
                'parent' => 'Punishment',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 13:12:29',
                'updated_at' => '2021-06-06 13:12:29',
            ),
            175 =>
            array (
                'id' => 180,
                'name' => 'Award deleted button',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:51:03',
                'updated_at' => '2021-06-06 14:51:03',
            ),
            176 =>
            array (
                'id' => 181,
                'name' => 'Award pending button',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:51:11',
                'updated_at' => '2021-06-06 14:51:11',
            ),
            177 =>
            array (
                'id' => 182,
                'name' => 'Award give/assign',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:52:29',
                'updated_at' => '2021-06-06 14:52:29',
            ),
            178 =>
            array (
                'id' => 183,
                'name' => 'Award approve',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:52:44',
                'updated_at' => '2021-06-06 14:52:44',
            ),
            179 =>
            array (
                'id' => 184,
                'name' => 'Award deny',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:52:49',
                'updated_at' => '2021-06-06 14:52:49',
            ),
            180 =>
            array (
                'id' => 185,
                'name' => 'Award restore',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:54:52',
                'updated_at' => '2021-06-06 14:54:52',
            ),
            181 =>
            array (
                'id' => 186,
                'name' => 'Award permanent delete',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:55:02',
                'updated_at' => '2021-06-06 14:55:02',
            ),
            182 =>
            array (
                'id' => 187,
                'name' => 'Award delete assigned',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:55:22',
                'updated_at' => '2021-06-06 14:55:22',
            ),
            183 =>
            array (
                'id' => 188,
                'name' => 'Award edit assigned',
                'parent' => 'Award',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 14:56:24',
                'updated_at' => '2021-06-06 14:56:24',
            ),
            184 =>
            array (
                'id' => 189,
                'name' => 'Achievement deleted button',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:15:29',
                'updated_at' => '2021-06-06 15:15:29',
            ),
            185 =>
            array (
                'id' => 190,
                'name' => 'Achievement pending button',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:15:39',
                'updated_at' => '2021-06-06 15:15:39',
            ),
            186 =>
            array (
                'id' => 191,
                'name' => 'Achievement give/assign',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:15:46',
                'updated_at' => '2021-06-06 15:15:46',
            ),
            187 =>
            array (
                'id' => 192,
                'name' => 'Achievement approve',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:16:05',
                'updated_at' => '2021-06-06 15:16:05',
            ),
            188 =>
            array (
                'id' => 193,
                'name' => 'Achievement deny',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:16:08',
                'updated_at' => '2021-06-06 15:16:08',
            ),
            189 =>
            array (
                'id' => 194,
                'name' => 'Achievement restore',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:16:32',
                'updated_at' => '2021-06-06 15:16:32',
            ),
            190 =>
            array (
                'id' => 195,
                'name' => 'Achievement permanent delete',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:17:11',
                'updated_at' => '2021-06-06 15:17:11',
            ),
            191 =>
            array (
                'id' => 196,
                'name' => 'Achievement delete assigned',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:17:44',
                'updated_at' => '2021-06-06 15:17:44',
            ),
            192 =>
            array (
                'id' => 197,
                'name' => 'Achievement edit assigned',
                'parent' => 'Achievement',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:17:51',
                'updated_at' => '2021-06-06 15:17:51',
            ),
            193 =>
            array (
                'id' => 198,
                'name' => 'Leave deleted button',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:37:21',
                'updated_at' => '2021-06-06 15:37:21',
            ),
            194 =>
            array (
                'id' => 199,
                'name' => 'Leave pending button',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:37:28',
                'updated_at' => '2021-06-06 15:37:28',
            ),
            195 =>
            array (
                'id' => 200,
                'name' => 'Leave give/assign',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:38:17',
                'updated_at' => '2021-06-06 15:38:17',
            ),
            196 =>
            array (
                'id' => 201,
                'name' => 'Leave approve',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:38:28',
                'updated_at' => '2021-06-06 15:38:28',
            ),
            197 =>
            array (
                'id' => 202,
                'name' => 'Leave deny',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:38:35',
                'updated_at' => '2021-06-06 15:38:35',
            ),
            198 =>
            array (
                'id' => 203,
                'name' => 'Leave restore',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:38:47',
                'updated_at' => '2021-06-06 15:38:47',
            ),
            199 =>
            array (
                'id' => 204,
                'name' => 'Leave permanent delete',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:38:58',
                'updated_at' => '2021-06-06 15:38:58',
            ),
            200 =>
            array (
                'id' => 205,
                'name' => 'Leave delete assigned',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:39:07',
                'updated_at' => '2021-06-06 15:39:07',
            ),
            201 =>
            array (
                'id' => 206,
                'name' => 'Leave edit assigned',
                'parent' => 'Leave',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 15:39:14',
                'updated_at' => '2021-06-06 15:39:14',
            ),
            202 =>
            array (
                'id' => 207,
                'name' => 'Abroad training deleted button',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:27:35',
                'updated_at' => '2021-06-06 16:27:35',
            ),
            203 =>
            array (
                'id' => 208,
                'name' => 'Abroad training pending button',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:27:42',
                'updated_at' => '2021-06-06 16:27:42',
            ),
            204 =>
            array (
                'id' => 209,
                'name' => 'Abroad training give/assign',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:27:59',
                'updated_at' => '2021-06-06 16:27:59',
            ),
            205 =>
            array (
                'id' => 210,
                'name' => 'Abroad training approve',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:28:04',
                'updated_at' => '2021-06-06 16:28:04',
            ),
            206 =>
            array (
                'id' => 211,
                'name' => 'Abroad training deny',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:28:08',
                'updated_at' => '2021-06-06 16:28:08',
            ),
            207 =>
            array (
                'id' => 212,
                'name' => 'Abroad training restore',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:28:18',
                'updated_at' => '2021-06-06 16:28:18',
            ),
            208 =>
            array (
                'id' => 213,
                'name' => 'Abroad training permanent delete',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:28:27',
                'updated_at' => '2021-06-06 16:28:27',
            ),
            209 =>
            array (
                'id' => 214,
                'name' => 'Abroad training edit assigned',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:28:35',
                'updated_at' => '2021-06-06 16:28:35',
            ),
            210 =>
            array (
                'id' => 215,
                'name' => 'Abroad training delete assigned',
                'parent' => 'Abroad training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:28:41',
                'updated_at' => '2021-06-06 16:28:41',
            ),
            211 =>
            array (
                'id' => 216,
                'name' => 'Inland training deleted button',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:09',
                'updated_at' => '2021-06-06 16:42:09',
            ),
            212 =>
            array (
                'id' => 217,
                'name' => 'Inland training pending button',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:17',
                'updated_at' => '2021-06-06 16:42:17',
            ),
            213 =>
            array (
                'id' => 218,
                'name' => 'Inland training give/assign',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:27',
                'updated_at' => '2021-06-06 16:42:27',
            ),
            214 =>
            array (
                'id' => 219,
                'name' => 'Inland training approve',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:36',
                'updated_at' => '2021-06-06 16:42:36',
            ),
            215 =>
            array (
                'id' => 220,
                'name' => 'Inland training deny',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:42',
                'updated_at' => '2021-06-06 16:42:42',
            ),
            216 =>
            array (
                'id' => 221,
                'name' => 'Inland training restore',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:46',
                'updated_at' => '2021-06-06 16:42:46',
            ),
            217 =>
            array (
                'id' => 222,
                'name' => 'Inland training permanent delete',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:42:53',
                'updated_at' => '2021-06-06 16:42:53',
            ),
            218 =>
            array (
                'id' => 223,
                'name' => 'Inland training edit assigned',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:43:07',
                'updated_at' => '2021-06-06 16:43:07',
            ),
            219 =>
            array (
                'id' => 224,
                'name' => 'Inland training delete assigned',
                'parent' => 'Inland training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 16:43:15',
                'updated_at' => '2021-06-06 16:43:15',
            ),
            220 =>
            array (
                'id' => 225,
                'name' => 'Inhouse training deleted button',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:10',
                'updated_at' => '2021-06-06 17:02:10',
            ),
            221 =>
            array (
                'id' => 226,
                'name' => 'Inhouse training pending button',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:18',
                'updated_at' => '2021-06-06 17:02:18',
            ),
            222 =>
            array (
                'id' => 227,
                'name' => 'Inhouse training give/assign',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:24',
                'updated_at' => '2021-06-06 17:02:24',
            ),
            223 =>
            array (
                'id' => 228,
                'name' => 'Inhouse training approve',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:33',
                'updated_at' => '2021-06-06 17:02:33',
            ),
            224 =>
            array (
                'id' => 229,
                'name' => 'Inhouse training deny',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:37',
                'updated_at' => '2021-06-06 17:02:37',
            ),
            225 =>
            array (
                'id' => 230,
                'name' => 'Inhouse training restore',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:44',
                'updated_at' => '2021-06-06 17:02:44',
            ),
            226 =>
            array (
                'id' => 231,
                'name' => 'Inhouse training permanent delete',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:02:59',
                'updated_at' => '2021-06-06 17:02:59',
            ),
            227 =>
            array (
                'id' => 232,
                'name' => 'Inhouse training edit assigned',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:03:12',
                'updated_at' => '2021-06-06 17:03:12',
            ),
            228 =>
            array (
                'id' => 233,
                'name' => 'Inhouse training delete assigned',
                'parent' => 'Inhouse training',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 17:03:18',
                'updated_at' => '2021-06-06 17:03:18',
            ),
            229 =>
            array (
                'id' => 234,
                'name' => 'Station deleted button',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 18:36:15',
                'updated_at' => '2021-06-06 18:36:15',
            ),
            230 =>
            array (
                'id' => 235,
                'name' => 'Station restore',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 18:37:00',
                'updated_at' => '2021-06-06 18:37:00',
            ),
            231 =>
            array (
                'id' => 236,
                'name' => 'Station permanent delete',
                'parent' => 'Station',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 18:36:51',
                'updated_at' => '2021-06-06 18:36:51',
            ),
            232 =>
            array (
                'id' => 238,
                'name' => 'User deleted button',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 19:42:35',
                'updated_at' => '2021-06-06 19:42:35',
            ),
            233 =>
            array (
                'id' => 239,
                'name' => 'User restore',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 19:42:48',
                'updated_at' => '2021-06-06 19:42:48',
            ),
            234 =>
            array (
                'id' => 240,
                'name' => 'User permanent delete',
                'parent' => 'User',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 19:42:56',
                'updated_at' => '2021-06-06 19:42:56',
            ),
            235 =>
            array (
                'id' => 241,
                'name' => 'Admin activity revert button',
                'parent' => 'Admin activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 19:54:25',
                'updated_at' => '2021-06-06 19:54:25',
            ),
            236 =>
            array (
                'id' => 242,
                'name' => 'Admin activity revert all button',
                'parent' => 'Admin activity',
                'guard_name' => 'web',
                'created_at' => '2021-06-06 19:54:33',
                'updated_at' => '2021-06-06 19:54:33',
            ),
            237 =>
                array (
                    'id' => 243,
                    'name' => 'Organization list',
                    'parent' => 'Organization',
                    'guard_name' => 'web',
                    'created_at' => '2021-06-02 17:06:22',
                    'updated_at' => '2021-06-02 17:06:22',
                ),
            238 =>
                array (
                    'id' => 244,
                    'name' => 'Organization create',
                    'parent' => 'Organization',
                    'guard_name' => 'web',
                    'created_at' => '2021-06-02 17:07:17',
                    'updated_at' => '2021-06-02 17:07:17',
                ),
            239 =>
                array (
                    'id' => 245,
                    'name' => 'Organization show',
                    'parent' => 'Organization',
                    'guard_name' => 'web',
                    'created_at' => '2021-06-02 17:07:25',
                    'updated_at' => '2021-06-02 17:07:25',
                ),
            240 =>
                array (
                    'id' => 246,
                    'name' => 'Organization edit',
                    'parent' => 'Organization',
                    'guard_name' => 'web',
                    'created_at' => '2021-06-02 17:07:31',
                    'updated_at' => '2021-06-02 17:07:31',
                ),
            241 =>
                array (
                    'id' => 247,
                    'name' => 'Organization delete',
                    'parent' => 'Organization',
                    'guard_name' => 'web',
                    'created_at' => '2021-06-02 17:07:36',
                    'updated_at' => '2021-06-02 17:07:36',
                ),

        ));


    }
}
