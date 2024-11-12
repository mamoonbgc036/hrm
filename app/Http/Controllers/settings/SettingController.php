<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Salary_allowance;
use App\Models\Salary_template;
use Illuminate\Http\Request;

class SettingController extends Controller
{
   public function getTemplate($id){
    $salaryTemplate=Salary_template::where('grade_id',$id)->first();
    // Check if the salary template was found
    if (!$salaryTemplate) {
        return response()->json(['error' => 'Salary Template not found'], 404);
    }
   
    $allowance=$salaryTemplate->allowances;
    $deductions=$salaryTemplate->deduction;
     // Check if the salary template was found
     if (!$allowance) {
        return response()->json(['error' => 'Allowance not found'], 404);
    }
     $data = [
        'salary_template' => $salaryTemplate,
        // 'allowance' => $allowance
    ];

    return response()->json($data);
   }
}
