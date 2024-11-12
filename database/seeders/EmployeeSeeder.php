<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\ParmanentAddress;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()
            ->count(1)
            ->hasPresentAddress(1)
            ->hasParmanentAddress(1)
            ->hasEducations(3)
            ->create();
    }
}

