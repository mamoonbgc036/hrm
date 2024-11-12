<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessControlsTableSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SubDepartmentSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);
//        $this->call(StationCategorySeederTable::class);
//        $this->call(StationSeeder::class);
//        $this->call(EmployeeSeeder::class);
//        $this->call(EducationalQualificationSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ForeignTrainingSeeder::class);
        $this->call(LocalTrainingSeeder::class);
//        $this->call(PostingRecordSeeder::class);
        $this->call(AwardSeeder::class);
//        $this->call(PunishmentSeeder::class);
//        $this->call(NomineeSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(RelationshipsTableSeeder::class);

        $this->call(StationsTableSeeder::class);
//        $this->call(StationCategorySeederTable::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
