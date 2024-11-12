<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Station;
use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\PostingRecord;
use Yajra\DataTables\Facades\DataTables;

class EmployeeConfirmationController extends Controller
{
    public function index()
    {
        $designations = Designation::where('status', 'active')->orderBy('en_name', 'ASC')->get();
        $stations = Station::where('status', 'active')->orderBy('name', 'ASC')->get();
        $grades = Grade::where('status', 'active')->orderBy('grade', 'ASC')->get();
        $posting_types = collect(PostingRecord::posting_types());
        return view('confirmation.index', compact('stations', 'designations', 'grades', 'posting_types'));
    }

    public function confirmed_employees()
    {
        // <th>PIN</th>
        // <th>Name</th>
        // <th>Branch</th>
        // <th>Region</th>
        // <th>Designation</th>
        // <th>Joining Date</th>
        $allConfirmedEmployees = Employee::with([
            'posting_station' => function ($query) {
                $query->select('id', 'name', 'division_id');
            },
            'posting_station.division' => function ($query) {
                $query->select('id', 'name');
            },
            'designation' => function ($query) {
                $query->select('id', 'en_name');
            }
        ])->where('is_confirmed', 'yes')->paginate(3, ['id', 'name', 'pin_no', 'station_id', 'designation_id']);
        return response()->json($allConfirmedEmployees);
    }

    public function confirmed_employees_list()
    {
        // Name	PIN	Current Branch  Designation
        $allConfirmedEmployees = Employee::with([
            'posting_station:id,name,division_id',
            'posting_station.division:id,name',
            'designation:id,en_name',
        ])->where('is_confirmed', 'yes')->orderBy('id', 'DESC')->get();

        if (request()->ajax()) {
            return DataTables::of($allConfirmedEmployees)
                ->addIndexColumn()
                ->toJson();
        }
        
        return view('confirmation.index');
    }
}
