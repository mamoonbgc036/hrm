<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Employee;
use App\Models\Welfare;
use Illuminate\Http\Request;
use App\Models\WelfareContribution;
use App\Http\Controllers\Controller;

class WelfareFundController extends Controller
{
    public function create()
    {
        $employees = Employee::all();
        $welfares = Welfare::all();
        return view('welfare.fund-create', compact('employees', 'welfares'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "employee_id" => ['required', 'exists:employees,id'], // Ensures the employee ID exists in the employees table
            "welfare_id" => ['required', 'exists:welfares,id'], // Ensures the welfare ID exists in the welfare_contributions table
            "amount" => ['required', 'numeric'],
            "contribution_date" => ['required', 'date'],
            "type" => ['required', 'string'], // Validates that the type is a string
        ]);

        WelfareContribution::create($data);

        return redirect()->back();
    }
}
