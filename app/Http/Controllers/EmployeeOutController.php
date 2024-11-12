<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeOutController extends Controller
{
    public function index()
    {
        return view('admin.discontinuation.index');
    }

    public function store(Request $request)
    {
        // employee table delete
        // dd($request['params']['id']);
        $employee_terminate = Employee::findOrFail($request['params']['id']);
        // logger($request->all());
        // return response()->json($employee_terminate);
        $employees_with_trash = Employee::with('designation', 'monthly_grade', 'employee_out')->onlyTrashed()->get();
        $employee_terminate->update([
            'deleted_at' => now()->format('Y-m-d'),
        ]);
        // insert in employee_out table
        $employee_terminate->employee_out()->create([
            'type' => $request['params']['type'],
            'effective_date' => $request['params']['effective_date'],
        ]);
        return response()->json(['message' => 'success', 'employees' => $employees_with_trash], 200);
    }

    public function employee_discontinuation()
    {
        // Pin	Name	Designation	Grade	Discontinuation Type
        // $employees_with_trash = Employee::with(['designation', 'monthly_grade', 'employee_out'])->onlyTrashed()->get();
        $employees_with_trash = Employee::with([
            'designation' => function ($query) {
                $query->select('id', 'en_name');
            },
            'monthly_grade' => function ($query) {
                $query->select('id', 'grade_id');
            },
            'employee_out' => function ($query) {
                $query->select('id', 'type', 'employee_id');
            }
        ])->onlyTrashed()->paginate(2, ['id', 'name', 'pin_no', 'designation_id', 'grade_id']);
        return response()->json($employees_with_trash);
    }

    public function employee_discontinuation_list()
    {
        $discontinuationEmployees = Employee::with([
            'designation:id,en_name',
            'monthly_grade:id,grade_id',
            'employee_out:id,type,employee_id,effective_date',
        ])->onlyTrashed()->orderBy('id','DESC')->get();
        // logger($discontinuationEmployees);
        if (request()->ajax()) {
            return DataTables::of($discontinuationEmployees)
                ->addIndexColumn()
                ->toJson();
        }
        
        return view('admin.discontinuation.index');
    }
}
