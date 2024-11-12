<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grade_types')->insert([
            'name' => 'Hourly',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('grade_types')->insert([
            'name' => 'Monthly',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
