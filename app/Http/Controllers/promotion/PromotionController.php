<?php

namespace App\Http\Controllers\promotion;

use Toastr;
use App\Models\Grade;
use App\Models\Station;
use App\Models\Employee;
use App\Models\Promotion;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\PostingRecord;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
    {
        $data['departments'] = Department::where('status', 'active')->orderBy('name', 'ASC')->get();
        $data['designations'] = Designation::where('status', 'active')->orderBy('en_name', 'ASC')->get();
        $data['stations'] = Station::where('status', 'active')->orderBy('name', 'ASC')->get();
        $data['grades'] = Grade::where('status', 'active')->orderBy('grade', 'ASC')->get();
        $data['posting_types'] = posting_types();

        return view('admin.promotion.index', $data);
    }

    public function store(Request $request)
    {
        $employee_promotion = Employee::findOrFail($request->employee_id);
        $employee_promotion->update([
            'grade_id' => $request->promoted_grade,
            'designation_id' => $request->promoted_designation
        ]);

        $request->validate([
            'type' => 'required|in:promotion,transfer,joind,both',
        ]);
        $promotion = [
            'employee_id' => $request->employee_id,
            'department_id' => $request->promoted_department,
            'designation_id' => $request->promoted_designation,
            'station_id' => @$employee_promotion->station_id,
            'grade_id' => $request->promoted_grade,
            'from_date' => Carbon::parse($request->from_date),
            'type' => $request->type
        ];

        DB::table('posting_records')->insert($promotion);
        Promotion::create($promotion);

        Toastr::success('Employee promoted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('promotion.index');
    }

    // public function search()
    // {
    //     $search_key = Request()->pin_no;
    //     $status = Request()->status;
    //     if (!empty($search_key) && $status == 'confirmation') {
    //         $employees = Employee::with('designation', 'monthly_grade')->where('pin_no', 'like', "%$search_key%")->orWhere('name', 'like', "%$search_key%")->limit(25)->get();
    //         $designations = Designation::all();
    //     } else if (!empty($search_key) && $status == 'redesignation') {
    //         $employees = Employee::with('designation')->where('pin_no', 'like', "%$search_key%")->orWhere('name', 'like', "%$search_key%")->limit(25)->get();
    //         $designations = Designation::all();
    //     } else {
    //         $employees = null;
    //     }

    //     return response()->json([
    //         'employees' => $employees,
    //         'designations' => $designations
    //     ]);
    // }
}
