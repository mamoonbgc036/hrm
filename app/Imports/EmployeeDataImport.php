<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeDataImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $uniqueDepartments = [];
        $uniqueDesignations = [];
        $uniqueBranchs = [];
        $uniqueGrades = [];
        $uniqueGradeBasics = [];
        $uniqueDegrees = [];

        foreach ($rows as $row) {
            // Check for unique department names
            // if (!in_array($row['department'], $uniqueDepartments)) {
            //     $uniqueDepartments[] = $row['department'];
            // }

            // Check for unique designations with salary grades
            $designations = explode(',', $row['designation']);
            $uniqueGrades = explode(',', $row['basic_salary']);
            $salaryGrades = explode(',', $row['salary_grade']);

            // foreach ($designations as $index => $designation) {
            //     $designation = trim($designation);
            //     $salaryGrade = isset($salaryGrades[$index]) ? trim($salaryGrades[$index]) : null;

            //     // Check if the designation with its salary grade is unique
            //     if (!isset($uniqueDesignations[$designation])) {
            //         $uniqueDesignations[$designation] = $salaryGrade;
            //     }
            // }

            // foreach ($uniqueGrades as $index => $uniqueGradeBasic) {
            //     $uniqueGradeBasic = trim($uniqueGradeBasic);
            //     $salaryGrade = isset($salaryGrades[$index]) ? trim($salaryGrades[$index]) : null;
            //     if (!isset($uniqueGradeBasics[$uniqueGradeBasic]) && !in_array($salaryGrade, $uniqueGradeBasics)) {
            //         $uniqueGradeBasics[$uniqueGradeBasic] = $salaryGrade;
            //     }
            // }

            
            // if (!in_array($row['branch'], $uniqueBranchs)) {
            //     $uniqueBranchs[] = $row['branch'];
            // }

            // if (!in_array($row['salary_grade'], $uniqueGrades)) {
            //     $uniqueGrades[] = $row['salary_grade'];
            // }

            if (!in_array($row['education_qualification'], $uniqueDegrees)) {
                $uniqueDegrees[] = $row['education_qualification'];
            }
        }

        // dd($uniqueDegrees);

        // logger($uniqueDesignations);

        // foreach ($uniqueDepartments as $departmentName) {
        //     Department::firstOrCreate(['name' => $departmentName, 'status' => 'active']);
        // }
        // $i = 1;
        // foreach ($uniqueDesignations as $designationName => $salaryGrade) {
        //     DB::table('designations')->insert([
        //         'serial' => $i,
        //         'en_name' => $designationName,
        //         'pay_scale' => $salaryGrade,
        //     ]);
        //     $i++;
        // }

        // foreach ($uniqueBranchs as $uniqueBranch) {
        //     DB::table('branchs')->insert([
        //         'name' => $uniqueBranch,
        //         'status' => 'active',
        //     ]);

        // }
        // logger($uniqueGrades);
        // foreach ($uniqueGrades as $uniqueGrade) {
        //     DB::table('grades')->insert([
        //         'grade' => $uniqueGrade,
        //         'status' => 'active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);

        // }
        foreach ($uniqueGradeBasics as $basicSal => $grade) {
            DB::table('salary_template')->insert([
                'grade_id' => $grade,
                'basic_salary' => $basicSal,
                'overtime_salary' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }

    }
}

