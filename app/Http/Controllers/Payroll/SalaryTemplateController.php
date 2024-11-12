<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\Salary_template;
use App\Models\Salary_allowance;
use App\Models\Salary_deduction;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SalaryTemplateController extends Controller
{
    public function get_salary_template()
    {
        $grades = Grade::all();
        $template = Salary_template::all();
        return view('payroll.salary-template', compact('grades', 'template'));
    }

    public function edit($id)
    {
        $salary_template_data = Salary_template::with([
            'deduction' => function ($query) {
                $query->select('id', 'salary_template_id', 'deduction_label', 'deduction_value', 'deduct_amount', 'type');
            },
            'allowances' => function ($query) {
                $query->select('id', 'salary_template_id', 'allowance_label', 'allowance_value', 'allowance_percent', 'allowance_type');
            }
        ])->find($id);
        return view('payroll.edit_salary_template', compact('salary_template_data'));
    }


    public function update(Request $req, $id)
    {
        // $req->validate([
        //     'grade_id' => 'required|unique:salary_template,grade_id',
        // ]);

        // Creating a Salary Template
        $salaryTemplateData = [
            "grade_id" => $req->grade_id,
            "basic_salary" => $req->basic_salary,
            "overtime_salary" => $req->overtime_salary
        ];
        $salaryTemplate = Salary_template::find($id);

        $salaryTemplate->update($salaryTemplateData);

        Salary_allowance::where('salary_template_id', $id)->forceDelete();
        Salary_deduction::where('salary_template_id', $id)->forceDelete();

        if (!empty($req->allowance)) {
            foreach ($req->allowance as $i => $allowanceValue) {
                $allowanceData = [
                    "salary_template_id" => $salaryTemplate->id,
                    "allowance_label" => $req->allowance_name[$i],
                    "allowance_type" => $req->allowance_type[$i],
                    "allowance_percent" => $allowanceValue,
                    "allowance_value" => $req->allowance_type[$i] == 'percent'
                        ? $req->basic_salary * ($allowanceValue / 100)
                        : $allowanceValue,
                ];
                Salary_allowance::create($allowanceData);
            }
        }
        if (!empty($req->deduct)) {
            foreach ($req->deduct as $i => $deductionValue) {
                $deductionData = [
                    "salary_template_id" => $salaryTemplate->id,
                    "deduction_label" => $req->deduction_name[$i],
                    "type" => $req->type[$i],
                    "deduction_value" => $deductionValue,
                    'deduct_amount' => $req->type[$i] == 'percent'
                        ? $req->basic_salary * ($deductionValue / 100)
                        : $deductionValue,
                ];
                Salary_deduction::create($deductionData);
            }
        }

        $turn = true;

        Toastr::success('Staff case of ' . $salaryTemplate->grade_id . ' updated Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);

        return redirect()->route('payroll.salary-template')->with('turn', $turn);

    }

    public function destroy($id)
    {
        Salary_allowance::where('salary_template_id', $id)->forceDelete();
        Salary_deduction::where('salary_template_id', $id)->forceDelete();

        $salaryTemplate = Salary_template::find($id);
        if ($salaryTemplate) {
            $salaryTemplate->forceDelete();
        }
        Toastr::success('Staff case of ' . $salaryTemplate->grade_id . ' deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->back()->with('toggle', 'yes');
    }


    public function store(Request $req)
    {
        $req->validate([
            'grade_id' => 'required|unique:salary_template,grade_id',
        ]);

        // Creating a Salary Template
        $salaryTemplateData = [
            "grade_id" => $req->grade_id,
            "basic_salary" => $req->basic_salary,
            "overtime_salary" => $req->overtime_salary
        ];
        $salaryTemplate = Salary_template::create($salaryTemplateData);

        // Handling Allowances
        if (!empty($req->allowance)) {
            foreach ($req->allowance as $i => $allowanceValue) {
                $allowanceData = [
                    "salary_template_id" => $salaryTemplate->id,
                    "allowance_label" => $req->allowance_name[$i],
                    "allowance_type" => $req->allowance_type[$i],
                    "allowance_percent" => $allowanceValue,
                    "allowance_value" => $req->allowance_type[$i] == 'percent'
                        ? $req->basic_salary * ($allowanceValue / 100)
                        : $allowanceValue,
                ];
                Salary_allowance::create($allowanceData);
            }
        }
        if (!empty($req->deduct)) {
            foreach ($req->deduct as $i => $deductionValue) {
                $deductionData = [
                    "salary_template_id" => $salaryTemplate->id,
                    "deduction_label" => $req->deduction_name[$i],
                    "type" => $req->type[$i],
                    "deduction_value" => $deductionValue,
                    'deduct_amount' => $req->type[$i] == 'percent'
                        ? $req->basic_salary * ($deductionValue / 100)
                        : $deductionValue,
                ];
                Salary_deduction::create($deductionData);
            }
        }
        Toastr::success('Staff case of ' . $salaryTemplate->grade_id . ' created Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->back()->with('toggle', 'yes');
    }

}
