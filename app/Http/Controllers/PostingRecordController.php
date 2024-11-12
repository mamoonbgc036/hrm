<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Exports\PostingRecordsExport;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Grade;
use App\Models\PostingRecord;
use App\Models\Station;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PostingRecordController extends Controller
{

    public function index()
    {


        // <tr>
        //     <th style="width: 10px;">SL NO</th>
        //     <th>Pin No</th>
        //     <th>Emp. Id</th>
        //     <th>Name</th>
        //     <th>Designation</th>
        //     <th>Department</th>
        //     <th>Branch</th>
        //     <th>Grade</th>
        //     <th>Basic.S</th>
        //     <th>Gross.S</th>
        //     <th>Consolidated.S</th>
        //     <th>Age</th>
        //     <th>S. Age</th>
        //     <th>S.L.F.L.P</th>
        //     <th>C.B. Service Age</th>
        //     <th>Date of Join</th>
        //     <th class="text-center" style="width: 10%;">Action</th>
        // </tr>

        $postingRecordInfos = PostingRecord::select('id', 'employee_id','station_name', 'station_location', 'from_date', 'to_date', 'duration', 'type', 'department_id', 'designation_id', 'station_id','grade_id')
        ->with([
            'employee:id,pin_no,name,join_date,dob',
            'designation:id,en_name',
            'department:id,name',
            'station:id,name',
            'monthly_grade:id,grade_id,basic_salary',
            'monthly_grade.allowances:id,salary_template_id,allowance_label,allowance_value,allowance_percent',
            'monthly_grade.grades:id,grade',
            'grade:id,grade',
            'grade.getGrade:id,id,grade_id,basic_salary'
        ])
        ->get();

        // logger($postingRecordInfos->toArray());

        $postingRecordFilters = $postingRecordInfos->map(function($postingRecordInfo) {
            return [
                'employee_id' => $postingRecordInfo->employee_id,
                'pin_no' => $postingRecordInfo->employee->pin_no??null,
                'name' => $postingRecordInfo->employee->name??null,
                'designation' => $postingRecordInfo->designation->en_name??null,
                'department' => $postingRecordInfo->department->name??null,
                'branch' => $postingRecordInfo->station->name??null,
                'basic' => $postingRecordInfo->monthly_grade->basic_salary??null,
                'gross' => $postingRecordInfo->monthly_grade->basic_salary??null,
                'punishment_title' => $postingRecordInfo->punishment->name??null,
                'offence' => $postingRecordInfo->punishment->offence??null,
            ];
        });

        // if (\request()->ajax()) {
        //     return DataTables::of($postingRecordInfos)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             return view('admin.posting_record.action-button', compact('row'));
        //         })
        //         ->addColumn('employee_id', function ($row) {
        //             return $row->employee_id;
        //         })
        //         ->addColumn('pin_no', function ($row) {
        //             return $row->employee->pin_no??null;
        //         })
        //         ->addColumn('name', function ($row) {
        //             return $row->employee->name??null;
        //         })
        //         ->addColumn('designation', function ($row) {
        //             return $row->designation->en_name??null;
        //         })
        //         ->addColumn('department', function ($row) {
        //             return $row->department->name??null;
        //         })
        //         ->addColumn('branch', function ($row) {
        //             return $row->station->name??null;
        //         })
        //         ->addColumn('basic', function ($row) {
        //             return $row->monthly_grade->basic_salary??null;
        //         })
        //         ->addColumn('gross', function ($row) {
        //             $gross = 0;
        //             if($row->monthly_grade->allowances){
        //                 $gross += $gross + $row->monthly_grade->allowances->allowance_value;
        //             }else{
        //                 $gross = 0;
        //             }
        //             return $gross;
        //         })
        //         ->addColumn('gross', function ($row) {
        //             $gross = 0;
        //             if($row->monthly_grade->allowances){
        //                 $gross += $gross + $row->monthly_grade->allowances->allowance_value;
        //             }else{
        //                 $gross = 0;
        //             }
        //             return $gross;
        //         })
        //         ->addColumn('age', function ($row) {
        //             $dob = Carbon::parse($row->dob);
        //             // $formattedDob = $dob->format('y-m-d');
        //             $pdate = $formattedDateTime = Carbon::now();
        //             $diff = $dob->diff($pdate);
        //             $age = "{$diff->y} years {$diff->m} months {$diff->d} days";
        //             return $age;
        //         })
        //         ->addColumn('basic', function ($row) {
        //             $dob = Carbon::parse($row->dob);
        //             // $formattedDob = $dob->format('y-m-d');
        //             $pdate = $formattedDateTime = Carbon::now();
        //             $diff = $dob->diff($pdate);
        //             $age = "{$diff->y} years {$diff->m} months {$diff->d} days";
        //             return $age;
        //         })
        //         ->addColumn('from', function ($row) {
        //             return $row->from_date ? date('d-m-Y', strtotime($row->from_date)) : '';
        //         })
        //         ->addColumn('to', function ($row) {
        //             return $row->to_date ? date('d-m-Y', strtotime($row->to_date)) : 'Present';
        //         })
        //         ->addColumn('duration', function ($row) {
        //             $origin = new DateTime($row->from_date);
        //             $target = new DateTime($row->to_date);
        //             $interval = $origin->diff($target);

        //             if ($interval->y < 2) {
        //                 $year = $interval->y . ' Year';
        //             } else {
        //                 $year = $interval->y . ' Years';
        //             }

        //             if ($interval->m < 2) {
        //                 $month = $interval->m . ' Month';
        //             } else {
        //                 $month = $interval->m . ' Months';
        //             }

        //             $interval->d = $interval->d + 1;
        //             if ($interval->d < 2) {
        //                 $day = $interval->d . ' Day';
        //             } else {
        //                 $day = $interval->d . ' Days';
        //             }

        //             if ($interval->y == 0 && $interval->m == 0) {
        //                 $duration = $day;
        //             } else if ($interval->y == 0) {
        //                 $duration = $month . ', ' . $day;
        //             } else {
        //                 $duration = $year . ', ' . $month . ', ' . $day;
        //             }

        //             return $duration;
        //         })
        //         ->addColumn('type', function ($row) {
        //             $type = '';
        //             if ($row->type == 'transfer')
        //                 $type = 'TRANSFER';
        //             elseif ($row->type == 'promotion') {
        //                 $type = 'PROMOTION';
        //             } elseif ($row->type == 'both') {
        //                 $type = 'PROMOTION & TRANSFER';
        //             } elseif ($row->type == 'joined') {
        //                 $type = 'JOINED';
        //             } elseif ($row->type == 'administrative_transfer') {
        //                 $type = 'Administrative Transfer';
        //             } elseif ($row->type == 'end_of_service') {
        //                 $type = 'End of Service';
        //             } elseif ($row->type == 'attachment') {
        //                 $type = 'ATTACHMENT';
        //             }
        //             return $type;
        //         })
        //         ->rawColumns(['action'])
        //         ->toJson();
        // }
        $posting_records = PostingRecord::query()->with('employee', 'designation', 'station')->latest('id');
        if (\request()->ajax()) {
            return DataTables::of($posting_records)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('admin.posting_record.action-button', compact('row'));
                })
                ->addColumn('from', function ($row) {
                    return $row->from_date ? date('d-m-Y', strtotime($row->from_date)) : '';
                })
                ->addColumn('to', function ($row) {
                    return $row->to_date ? date('d-m-Y', strtotime($row->to_date)) : 'Present';
                })
                ->addColumn('duration', function ($row) {
                    $origin = new DateTime($row->from_date);
                    $target = new DateTime($row->to_date);
                    $interval = $origin->diff($target);

                    if ($interval->y < 2) {
                        $year = $interval->y . ' Year';
                    } else {
                        $year = $interval->y . ' Years';
                    }

                    if ($interval->m < 2) {
                        $month = $interval->m . ' Month';
                    } else {
                        $month = $interval->m . ' Months';
                    }

                    $interval->d = $interval->d + 1;
                    if ($interval->d < 2) {
                        $day = $interval->d . ' Day';
                    } else {
                        $day = $interval->d . ' Days';
                    }

                    if ($interval->y == 0 && $interval->m == 0) {
                        $duration = $day;
                    } else if ($interval->y == 0) {
                        $duration = $month . ', ' . $day;
                    } else {
                        $duration = $year . ', ' . $month . ', ' . $day;
                    }

                    return $duration;
                })
                ->addColumn('type', function ($row) {
                    $type = '';
                    if ($row->type == 'transfer')
                        $type = 'TRANSFER';
                    elseif ($row->type == 'promotion') {
                        $type = 'PROMOTION';
                    } elseif ($row->type == 'both') {
                        $type = 'PROMOTION & TRANSFER';
                    } elseif ($row->type == 'joined') {
                        $type = 'JOINED';
                    } elseif ($row->type == 'administrative_transfer') {
                        $type = 'Administrative Transfer';
                    } elseif ($row->type == 'end_of_service') {
                        $type = 'End of Service';
                    } elseif ($row->type == 'attachment') {
                        $type = 'ATTACHMENT';
                    }
                    return $type;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.posting_record.index', compact('posting_records'));
    }

    public function create()
    {
        $designations = Designation::where('status', 'active')->orderBy('en_name', 'ASC')->get();
        $stations = Station::where('status', 'active')->orderBy('name', 'ASC')->get();
        $grades = Grade::where('status', 'active')->orderBy('grade', 'ASC')->get();
        $posting_types = collect(PostingRecord::posting_types());

        return view('admin.posting_record.create', compact('stations', 'designations', 'grades', 'posting_types'));
    }

    public function allJobHistory()
    {
        // Name	PIN	Current Branch  Designation
        // $all_job_histories = Employee::with('posting_records', 'posting_records')->get();

        $all_job_histories = PostingRecord::with([
            'employee' => function ($query) {
                $query->select('id', 'name', 'pin_no'); // Select 'id', 'name', and 'pin_no' from employee
            },
            'designation' => function ($query) {
                $query->select('id', 'en_name'); // Select 'id' and 'en_name' from designation
            },
            'station' => function ($query) {
                $query->select('id', 'name', 'division_id'); // Select 'id' and 'name' from station
            },
            'station.division' => function ($query) {
                $query->select('id', 'name'); // Select 'id' and 'name' from division
            }
        ])
            ->latest()
            ->paginate(3);

        // dd($all_job_histories);
        return response()->json($all_job_histories);
    }

    public function allJobHistoryData()
    {
        // Name	PIN	Current Branch  Designation
        $all_job_histories = PostingRecord::with([
            'employee:id,name,pin_no',
            'department:id,name',
            'designation:id,en_name',
            'station:id,name,division_id',
            'station.division:id,name'
        ])
        ->where('type', 'transfer')
        ->whereNot('department_id', 0)
        ->latest()
        ->get();

        logger($all_job_histories->toArray());

        if (request()->ajax()) {
            return DataTables::of($all_job_histories)
                ->addIndexColumn()
                ->toJson();
        }
        
        return view('transfer.index');
    }


    public function store(Request $request)
    {
        //update employee station id
        // search if employee have a record at posting table 
        //if yes update it to_date by effective from field 
        //and insert a new row with new branch with from_date will be effective from field
        //if no insert two record. one is with existing branch from_date(joining date) to_date(effective from)
        // another record will be with new branch from_date(effective from fiedl) and to_date(null)

        $employee = Employee::findOrFail($request->employee_id);
        // dd($employee);

        // dd($employee->join_date);

        $employee->update([
            'station_id' => $request->branch_id,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            'division_id' => $request->region_id,
            'district_id' => $request->zone_id
        ]);

        $check_in_posting_record = PostingRecord::where('employee_id', $request->employee_id)->latest()->first();

        $posting_records = new PostingRecord();
        $startDate = Carbon::parse($employee->join_date);
        $endDate = Carbon::parse($request->effective_date);
        $diff = $startDate->diff($endDate);
        $duration = "{$diff->y} years {$diff->m} months {$diff->d} days";
        if (empty($check_in_posting_record)) {
            DB::table('posting_records')->insert([
                'employee_id' => $employee->id,
                'designation_id' => @$employee->designation_id,
                'department_id' => @$request->department_id,
                'grade_id' => @$employee->grade_id,
                'station_id' => @$employee->station_id,
                'from_date' => $startDate,
                'to_date' => @$request->effective_date,
                'duration' => $duration,
                'type' => 'transfer'
            ]);
        } else {
            $check_in_posting_record->update([
                'to_date' => @$request->effective_date,
                'duration' => $duration,
            ]);
            DB::table('posting_records')->insert([
                'employee_id' => $employee->id,
                'designation_id' => @$request->designation_id,
                'department_id' => @$request->department_id,
                'grade_id' => @$employee->grade_id,
                'station_id' => @$request->branch_id,
                'from_date' => @$request->effective_date,
                'to_date' => null,
                'type' => 'transfer'
            ]);
        }

        Toastr::success('Employee transfer done Successfully!', 'Success');

        return redirect()->route('posting-record.index');
    }

    // public function store(Request $request)
    // {
    //     //update employee station id
    //     // search if employee have a record at posting table 
    //     //if yes update it to_date by effective from field 
    //     //and insert a new row with new branch with from_date will be effective from field
    //     //if no insert two record. one is with existing branch from_date(joining date) to_date(effective from)
    //     // another record will be with new branch from_date(effective from fiedl) and to_date(null)
    //     $this->validate($request, [
    //         'posting.*.employee_id' => 'required',
    //         'posting.*.designation_id' => 'required',
    //         'posting.*.station_id' => 'required',
    //         'posting.*.from_date' => 'required|date',
    //     ]);

    //     foreach ($request->posting as $value) {
    //         $posting_record = new PostingRecord();

    //         $posting_record->employee_id = $value['employee_id'];
    //         $posting_record->grade_id = $value['grade_id'] ?? null;
    //         $posting_record->designation_id = $value['designation_id'];
    //         $posting_record->station_id = $value['station_id'];
    //         $posting_record->from_date = Carbon::parse($value['from_date'])->format('Y-m-d');
    //         if ($value['to_date']) {
    //             $posting_record->to_date = Carbon::parse($value['to_date'])->format('Y-m-d');
    //         }
    //         $posting_record->duration = $value['duration'];
    //         if (!empty($value['attachment'])) {
    //             $pdfFileName = time() . '.' . $value['attachment']->extension();
    //             $value['attachment']->move(public_path('assets/employee/attached_files'), $pdfFileName);
    //             $posting_record->attachment_file = $pdfFileName;
    //         }

    //         $posting_record->description = $value['description'];
    //         $posting_record->type = $value['type'];

    //         $posting_record->save();
    //     }

    //     Toastr::success('Job History Created Successfully!', 'Success');

    //     return redirect()->route('posting-record.index');
    // }

    public function add_posting_records_to_employee(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'posting.*.designation_id' => 'required',
            'posting.*.station_id' => 'required',
            'posting.*.from_date' => 'required|date',
        ]);

        foreach ($request->posting as $value) {
            $posting_record = new PostingRecord();

            $posting_record->employee_id = $request->employee_id;
            $posting_record->grade_id = $value['grade_id'] ?? null;
            $posting_record->designation_id = $value['designation_id'];
            $posting_record->designation_id = $value['designation_id'];
            $posting_record->station_id = $value['station_id'];
            $posting_record->from_date = Carbon::parse($value['from_date'])->format('Y-m-d');
            if ($value['to_date']) {
                $posting_record->to_date = Carbon::parse($value['to_date'])->format('Y-m-d');
            }
            $posting_record->duration = $value['duration'];
            if (!empty($value['attachment'])) {
                $pdfFileName = time() . '.' . $value['attachment']->extension();
                $value['attachment']->move(public_path('assets/employee/attached_files'), $pdfFileName);
                $posting_record->attachment_file = $pdfFileName;
            }

            $posting_record->description = $value['description'];
            $posting_record->type = $value['type'];

            $posting_record->save();
        }

        Toastr::success('Job Histories Added Successfully!', 'Success');

        return response()->json([
            'url' => route('employee.assign', $request->employee_id)
        ]);
    }

    public function show(PostingRecord $postingRecord)
    {

    }

    public function edit(PostingRecord $postingRecord)
    {
        $designations = Designation::orderBy('en_name', 'ASC')->get();
        $stations = Station::orderBy('name', 'ASC')->get();
        $grades = Grade::orderBy('grade', 'ASC')->get();
        $posting_types = collect(PostingRecord::posting_types());

        return view('admin.posting_record.edit', compact('postingRecord', 'stations', 'designations', 'grades', 'posting_types'));
    }

    public function update(Request $request, PostingRecord $posting_record)
    {

        $this->validate($request, [
            'designation_id' => 'required',
            'station_id' => 'required',
            'from_date' => 'bail|required|date|date_format:d-m-Y',
            'to_date' => 'bail|date|nullable|date_format:d-m-Y',
        ]);


        $posting_record->fill($request->except('from_date', 'to_date', 'duration'));

        $posting_record->from_date = $request->from_date ? Carbon::parse($request->from_date)->format('Y-m-d') : null;
        $posting_record->to_date = $request->to_date ? Carbon::parse($request->to_date)->format('Y-m-d') : null;
        $posting_record->duration = $request->duration;
        $posting_record->type = $request->type;
        $posting_record->update();

        Toastr::success('Job History Updated Successfully!', 'Success');

        return redirect()->route('posting-record.index');
    }

    public function destroy(PostingRecord $postingRecord)
    {
        $postingRecord->delete();
        Toastr::success('Job History Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);

        return redirect()->route('posting-record.index');
    }

    public function getDeletedPostingRecord()
    {
        $postingRecord = PostingRecord::onlyTrashed()->get();
        return view('admin.posting_record.deleted_posting_record', compact('postingRecord'));
    }

    public function restore($id)
    {
        PostingRecord::withTrashed()->findOrFail($id)->restore();
        Toastr::success('Job History Restore Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);

        return redirect()->route('posting-record.deleted');
    }

    public function permanentDelete($id)
    {
        PostingRecord::withTrashed()->findOrFail($id)->forceDelete();
        Toastr::success('Job History Permanently Deleted!');

        return redirect()->route('posting-record.deleted');
    }

    public function getPromotions()
    {
        $promotion_records = PostingRecord::with('employee', 'designation', 'station')->where('type', 'promotion')->latest('id')->get();
        return view('admin.posting_record.promotions', compact('promotion_records'));
    }

    public function getTransfers()
    {
        $transfer_records = PostingRecord::with('employee', 'designation', 'station')->where('type', 'transfer')->latest('id')->get();
        return view('admin.posting_record.transfers', compact('transfer_records'));
    }

    public function export_excel()
    {
        return Excel::download(new PostingRecordsExport(), 'job_history.xlsx');
    }

}
