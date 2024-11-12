<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('examinations')->truncate();

        $jsc_examinations = [
            ['name' => 'J.S.C', 'type' => 'JSC'],
            ['name' => 'J.D.C', 'type' => 'JSC'],
            ['name' => 'J.S.C Vocational', 'type' => 'JSC'],
            ['name' => 'J.S.C Equivalent', 'type' => 'JSC'],
            ['name' => 'Class 8 Passed', 'type' => 'JSC'],
        ];

        $ssc_examinations = [
            ['name' => 'S.S.C', 'type' => 'SSC'],
            ['name' => 'Dakhil', 'type' => 'SSC'],
            ['name' => 'S.S.C Vocational', 'type' => 'SSC'],
            ['name' => 'O Level/Cambridge', 'type' => 'SSC'],
            ['name' => 'S.S.C Equivalent', 'type' => 'SSC'],
        ];

        $hsc_examinations = [
            ['name' => 'H.S.C', 'type' => 'HSC'],
            ['name' => 'Alim', 'type' => 'HSC'],
            ['name' => 'Business Management', 'type' => 'HSC'],
            ['name' => 'Diploma Engineering', 'type' => 'HSC'],
            ['name' => 'A Level/Sr. Cambridge', 'type' => 'HSC'],
            ['name' => 'H.S.C Equivalent', 'type' => 'HSC'],
            ['name' => 'Diploma in Pharmacy', 'type' => 'HSC'],
        ];

        $graduation_examinations = [
            ['name' => 'B.Sc(Engineering/Architecture)', 'type' => 'Graduation'],
            ['name' => 'B.Sc(Agricultural Science)', 'type' => 'Graduation'],
            ['name' => 'M.B.B.S./B.D.S', 'type' => 'Graduation'],
            ['name' => 'Honors', 'type' => 'Graduation'],
            ['name' => 'Pass Course', 'type' => 'Graduation'],
            ['name' => 'Fazil', 'type' => 'Graduation'],
            ['name' => 'Graduation Equivalent', 'type' => 'Graduation'],
        ];

        $masters_examinations = [
            ['name' => 'M.A', 'type' => 'Masters'],
            ['name' => 'M.S.S', 'type' => 'Masters'],
            ['name' => 'M.Sc', 'type' => 'Masters'],
            ['name' => 'M.Com', 'type' => 'Masters'],
            ['name' => 'M.B.A', 'type' => 'Masters'],
            ['name' => 'L.L.M', 'type' => 'Masters'],
            ['name' => 'M.Phil', 'type' => 'Masters'],
            ['name' => 'Kamil', 'type' => 'Masters'],
            ['name' => 'Others', 'type' => 'Masters'],
            ['name' => 'Masters Equivalent', 'type' => 'Masters'],
        ];

        DB::table('examinations')->insert($jsc_examinations);
        DB::table('examinations')->insert($ssc_examinations);
        DB::table('examinations')->insert($hsc_examinations);
        DB::table('examinations')->insert($graduation_examinations);
        DB::table('examinations')->insert($masters_examinations);
    }
}
