<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Welfare;
use App\Models\Employee;
use App\Models\WelfareBenefitRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelfareFundRequestController extends Controller
{
    public function create()
    {
        $employees = Employee::all();
        $welfares = Welfare::all();
        return view('welfare.request', compact('employees', 'welfares'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "employee_id" => ['required'],
            "welfare_id" => ['required'],
            "amount" => ['required', 'numeric'],
            "description" => ['required']
        ]);
        WelfareBenefitRequest::create($data);
        return redirect()->back();
    }
}
