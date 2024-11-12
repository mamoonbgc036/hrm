<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Station;
use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\PostingRecord;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RedesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::where('status', 'active')->orderBy('en_name', 'ASC')->get();
        $stations = Station::where('status', 'active')->orderBy('name', 'ASC')->get();
        $grades = Grade::where('status', 'active')->orderBy('grade', 'ASC')->get();
        $posting_types = collect(PostingRecord::posting_types());
        return view('redesignation.index', compact('stations', 'designations', 'grades', 'posting_types'));
    }

    public function redesignationList(){

        // $employees = Employee::select('id', 'name', 'pin_no', 'join_date', 'designation_id')
        //     ->with([
        //     'designation:id,en_name',
        //     'monthly_grade:id,grade_id,basic_salary,overtime_salary'
        // ])->get();
        $employees = DB::table('employees')
        ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
        ->leftJoin('salary_template', 'employees.grade_id', '=', 'salary_template.grade_id')
        ->select(
            'employees.name', 
            'employees.pin_no',
            'employees.join_date', 
            'designations.en_name', 
            'salary_template.grade_id', 
            'salary_template.basic_salary', 
            'salary_template.overtime_salary'
        )
        ->get();

        // return response()->json($employees);

        if (\request()->ajax()) {
            return DataTables::of($employees)
                ->addIndexColumn()
                ->toJson();
        }
        return view('redesignation.index');
    }
}
