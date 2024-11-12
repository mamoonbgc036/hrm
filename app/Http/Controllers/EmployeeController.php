<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Award;
use App\Models\Batch;
use App\Models\Board;
use App\Models\Brand;
use App\Models\Grade;
use App\Models\Leave;
use App\Models\Quota;
use App\Models\Office;
use App\Models\Spouse;
use App\Models\Country;
use App\Models\Disease;
use App\Models\Journal;
use App\Models\Nominee;
use App\Models\Station;
use App\Models\Subject;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Institute;
use App\Models\Department;
use App\Models\Experience;
use App\Models\Punishment;
use App\Models\Achievement;
use App\Models\Designation;
use App\Models\DynamicName;
use App\Models\Examination;
use App\Models\Specialized;
use App\Models\SubLocation;
use App\Models\Termination;
use Illuminate\Support\Arr;
use App\Models\Organization;
use App\Models\Relationship;
use Illuminate\Http\Request;
use App\Models\LocalTraining;
use App\Models\PostingRecord;
use App\Models\PresentAddress;
use App\Models\ForeignTraining;
use App\Models\InhouseTraining;
use App\Models\Salary_template;
use App\Exports\EmployeesExport;
use App\Models\ParmanentAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExperienceJobPosition;
use Intervention\Image\Facades\Image;
use App\Models\ProfessionalExperience;
use Illuminate\Support\Facades\Schema;
use App\Exports\EmployeesExportDynamic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\EducationalQualification;
use Yajra\DataTables\Facades\DataTables;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class EmployeeController extends Controller
{
    public function all()
    {
        $terminations = Termination::all();
        return response()->json($terminations);
    }
    public function index(Request $request)
    {
        $allBranch = Station::select('id', 'name')->get();
        $data['branchs'] = $allBranch;

        // if ($request->has('daterange') && !empty($request->daterange)) {
        //     $dateRangeInput = $request->input('daterange');
        //     $range = explode('-', $dateRangeInput);
        //     $startDate = Carbon::parse(trim($range[0]));
        //     $endDate = Carbon::parse(trim($range[1]));
        //     $fDate = $startDate->format('Y-m-d');
        //     $sDate = $endDate->format('Y-m-d');
        //     $employees = Employee::with('designation', 'posting_station', 'monthly_grade')->whereBetween('join_date', [$fDate, $sDate])->get();
        // }
        $query = Employee::with('designation', 'posting_station', 'monthly_grade');
        // $employeeInfos = Employee::select('id', 'pin_no', 'name', 'join_date', 'designation_id', 'department_id', 'station_id','grade_id')
        //     ->with([
        //         'designation:id,en_name',
        //         'department:id,name',
        //         'posting_station:id,name',
        //         'monthly_grade:id,grade_id,basic_salary',
        //         'monthly_grade.allowances:id,salary_template_id,allowance_label,allowance_value,allowance_percent',
        //         'monthly_grade.grades:id,grade'
        //     ])
        // ->get();

        // Check if the 'filter' parameter exists and is not empty

        if ($request->has('filter') && !empty($request->filter)) {
            $employees = $query->where('status', $request->filter);
        } elseif (Session::get('created') == 'yes') {
            $employees = $query->orderBy('created_at', 'desc');
        } else {
            $employees = $query->select('employees.*')
                ->orderByRaw("CASE WHEN status = 'active' THEN 0 ELSE 1 END");
        }

        // Check if the 'daterange' parameter exists and is not empty
        if ($request->has('daterange') && !empty($request->daterange)) {
            $dateRangeInput = $request->input('daterange');
            $range = explode('-', $dateRangeInput);

            // Parse the dates using Carbon
            $startDate = Carbon::parse(trim($range[0]));
            $endDate = Carbon::parse(trim($range[1]));

            // Format the dates to 'YYYY-MM-DD'
            $fDate = $startDate->format('Y-m-d');
            $sDate = $endDate->format('Y-m-d');

            // Apply the date range filter using whereBetween
            $query->whereBetween('join_date', [$fDate, $sDate]);
        }

        // // Default sorting if no filter is applied
        if (!$request->has('filter') && !$request->has('daterange')) {
            $query->orderBy('created_at', 'desc');
        }
        if ($request->has('branch') && !empty($request->branch)) {
            $query->where('station_id', $request->branch);
        }
        // Execute the query and get the results
        $employees = $query->get();
        // logger($query->toSql());
        if (\request()->ajax()) {
            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('admin.employee.action-button', compact('row'));
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.employee.index', $data);
    }

    public function getPrlEmployees()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $prl = Employee::with('designation', 'jobStation')
            ->where('status', 'active')
            ->where('lpr_date', "<=", $current_date)
            ->select('employees.*')->get();

        return view('admin.employee.prl_list', compact('prl'));
    }

    public function getUpcomingPrlEmployees()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $next_year_same_date = Carbon::now()->addYear()->format('Y-m-d');
        $upcoming_prl = Employee::with('designation', 'jobStation')
            ->where('status', 'active')
            ->whereBetween('lpr_date', [$current_date, $next_year_same_date])
            ->select('employees.*')->get();

        return view('admin.employee.upcoming_prl', compact('upcoming_prl'));
    }

    public function create()
    {
        $subjects = new Subject;
        $institutes = new Institute;
        $data = [
            'quotas' => Quota::query()->where('status', 'active')->get(),
            'experience_job_positions' => ExperienceJobPosition::all(),
            'countries' => Country::query()->orderBy('name', 'ASC')->get(),
            'districts' => District::query()->orderBy('name', 'ASC')->get(),
            'divisions' => Division::query()->orderBy('name', 'ASC')->get(),
            'designations' => Designation::query()->where('status', 'active')->orderBy('en_name', 'ASC')->get(),
            'stations' => Station::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'offices' => Office::query()->where('status', 'active')->get(),
            // 'grades' => Grade::query()->where('status', 'active')->get(),
            'specialized_skills' => Specialized::pluck('name'),
            'grades' => Salary_template::pluck('grade_id'),
            'ssc_subjects' => $subjects->where('type', 'SSC')->orderBy('name', 'ASC')->get(),
            'hsc_subjects' => $subjects->where('type', 'HSC')->orderBy('name', 'ASC')->get(),
            'graduation_subjects' => $subjects->where('type', 'Graduation')->orderBy('name', 'ASC')->get(),
            'masters_subjects' => $subjects->where('type', 'Masters')->orderBy('name', 'ASC')->get(),
            'graduation_institutes' => $institutes->where('type', 'Graduation')->orderBy('name', 'ASC')->get(),
            'masters_institutes' => $institutes->where('type', 'Masters')->orderBy('name', 'ASC')->get(),
            'relationship' => Relationship::all(),
            'batch' => Batch::all(),
            'upazillas' => Upazila::query()->orderBy('name', 'ASC')->get(),
            'organizations' => Organization::query()->where('status', 'active')->orderBy('name', 'ASC')->get(), //have to make crud,
            'diseases' => Disease::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'departments' => Department::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'locations' => Location::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'subLocations' => SubLocation::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),

        ];
        return view('admin.employee.create', $data);
    }

    public function store(Request $request)
    {
        // $data = $request->validate([
        //     "course_title.*" => ['required'],
        //     "course_start_date.*" => ['required', 'date'],
        //     "course_end_date.*" => ['required', 'date'],
        //     "course_description.*" => ['required'],
        //     "training_type.*" => ['required'],
        //     "institute_name.*" => ['required'],
        //     "institute_address.*" => ['required'],
        //     "result.*" => ['numeric'],
        //     "year.*" => ['required']
        // ]);

        // foreach ($data['course_title'] as $index => $title) {
        //     Training::create([
        //         'course_title' => $title,
        //         'course_start_date' => $data['course_start_date'][$index],
        //         'course_end_date' => $data['course_end_date'][$index],
        //         'course_description' => $data['course_description'][$index],
        //         'training_type' => $data['training_type'][$index],
        //         'institute_name' => $data['institute_name'][$index],
        //         'institute_address' => $data['institute_address'][$index],
        //         'result' => $data['result'][$index],
        //         'year' => $data['year'][$index],
        //         'employee_id' => 4, // Assuming you're storing the related employee ID
        //     ]);
        // }

        // return 'done';

        $this->validate($request, [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            //            'pin_no' => 'required|unique:employees,pin_no',
//            'new_pin' => 'nullable|unique:employees,new_pin',
//            'batch_no' => 'required_with:batch_no_ext',
            /*'batch_no_ext' => 'required_with:batch_no',*/
            'id_card_no' => 'nullable|unique:employees,id_card_no',
            'email' => 'nullable|unique:employees,email|email',
            'nid_no' => 'nullable|unique:employees,nid_no',
            'mobile_no' => 'nullable|unique:employees,mobile_no',
            'dob' => 'nullable|date_format:d-m-Y',
            'join_date' => 'nullable',
            'lpr_date' => 'nullable|date_format:d-m-Y',

            'jsc_examination' => 'required_with:jsc_board,jsc_roll,jsc_result,jsc_gpa,jsc_passing_year,jsc_institute',
            'jsc_board' => 'required_with:jsc_roll',
            'jsc_roll' => 'nullable|min:2|max:20',
            'jsc_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'ssc_examination' => 'required_with:ssc_board,ssc_roll,ssc_result,ssc_gpa,ssc_subject,ssc_passing_year,ssc_institute',
            'ssc_board' => 'required_with:ssc_roll',
            'ssc_roll' => 'nullable|min:2|max:20',
            'ssc_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'hsc_examination' => 'required_with:hsc_board,hsc_roll,hsc_result,hsc_gpa,hsc_subject,hsc_passing_year,hsc_institute',
            'hsc_board' => 'required_with:hsc_roll',
            'hsc_roll' => 'nullable|min:2|max:20',
            'hsc_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'graduation_examination' => 'required_with:graduation_course_duration,graduation_result,graduation_gpa,graduation_subject,graduation_passing_year,graduation_institute',
            'graduation_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'masters_examination' => 'required_with:masters_course_duration,masters_result,masters_gpa,masters_subject,masters_passing_year,masters_institute',
            'masters_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'professional_designation' => 'required_with:professional_organization,professional_from_date,professional_to_date,professional_responsibilities',
            'professional_from_date' => 'required_with:professional_to_date|nullable|date_format:d-m-Y',
            'professional_to_date' => 'nullable|date_format:d-m-Y',

            'img_url' => 'nullable|image|max:200|min:20',
            'signature_url' => 'nullable|image|max:200|min:20',
            'nominees.*.picture' => 'nullable|image|max:200|min:20',

            /*'nominees.*.percentage' => [
                'required_with:nominees.*.name',
                'integer',
            ],*/
        ]);

        DB::beginTransaction();

        try {
            $employee = new Employee();

            //--------profile picture image-----------//
            if ($request->img_url) {
                $img = $request->file('img_url');
                $firstimageName = uniqid('employee', false) . '.' . $img->getClientOriginalExtension();
                $directory = '/assets/employee/';
                $imgUrl = $directory . $firstimageName;
                Image::make($img)->save(getcwd() . $imgUrl);
                $employee->img_url = $firstimageName;
            }

            //--------signature image-----------//
            if ($request->signature_url) {
                $img = $request->file('signature_url');
                $firstimageName = uniqid('signature', false) . '.' . $img->getClientOriginalExtension();
                $directory = '/assets/employee/signatures/';
                $imgUrl = $directory . $firstimageName;
                Image::make($img)->save(getcwd() . $imgUrl);
                $employee->signature_url = $firstimageName;
            }

            //--------Job Assign attachment-file-----------//
            if ($request->attached_file) {
                $pdfFileName = time() . '.' . $request->attached_file->extension();
                $request->attached_file->move(getcwd() . '/assets/employee/attached_files', $pdfFileName);
                $employee->attached_file = $pdfFileName;
            }

            //--------Attached Information attachment-file-----------//
            if ($request->attached_attached_file) {
                $pdfFileName = time() . '.' . $request->attached_attached_file->extension();
                $request->attached_attached_file->move(getcwd() . '/assets/employee/attached_files', $pdfFileName);
                $employee->attached_attached_file = $pdfFileName;
            }

            $employee->fill($request->except('join_date', 'img_url', 'signature_url', 'lpr_date', 's_name', 's_home_district_id', 'total_boy_child', 'total_girl_child', 'attached_file', 'attached_attached_file', 'batch_no'));

            if ($employee->police_station_id != null) {
                $station = Station::find($employee->police_station_id);
                $employee->division_id = $station->division_id;
                $employee->district_id = $station->district_id;
                $employee->upazila_id = $station->upazila_id;
            }

            if ($employee->attached_police_station_id != null) {
                $attached_station = Station::find($employee->attached_police_station_id);
                $employee->attached_division_id = $attached_station->division_id;
                $employee->attached_district_id = $attached_station->district_id;
                $employee->attached_upazila_id = $attached_station->upazila_id;
            }

            if ($request->batch_no) {
                $employee->batch_no = $request->batch_no;
                $employee->batch_no_ext = $request->batch_no_ext;
            }
            if ($request->date_of_birth) {
                $employee->dob = Carbon::parse($request->date_of_birth)->format('Y-m-d');
                $employee->lpr_date = Carbon::parse($request->lpr_date)->format('Y-m-d');
            }
            if ($request->join_date) {
                $employee->join_date = Carbon::parse($request->join_date)->format('Y-m-d');
            }

            if ($request->marital_status == 'married') {
                $employee->s_name = $request->s_name;
                $employee->s_home_district_id = $request->s_home_district_id;
            }
            if ($request->haveChild) {
                $employee->total_boy_child = $request->total_boy_child;
                $employee->total_girl_child = $request->total_girl_child;
            }
            //save info
            $employee->name = $request->first_name;
            $employee->middle_name = $request->middle_name;
            $employee->last_name = $request->last_name;
            //            $employee->dob = $request->date_of_birth;
            $employee->organization_id = $request->organization_id;
            $employee->department_id = $request->department_id;
            $employee->location_id = $request->location_id;
            $employee->sub_location_id = $request->sub_location_id;
            $employee->ot_eligibility = $request->ot_eligibility;
            $employee->pf_eligibility = $request->pf_eligibility;
            $employee->is_auto_approved_leave = $request->is_auto_approved_leave;
            $employee->birth_certificate_no = $request->birth_certificate_no;
            $employee->disease_id = $request->disease_id;

            $employee->save();

            /*if ($request->spouses) {
                foreach ($request->spouses as $value) {
                    if (!empty($value['name'])) {
                        $spouse = new Spouse();
                        $spouse->employee_id = $employee->id;
                        $spouse->name = $value['name'];
                        $spouse->tin = $value['tin'];
                        $spouse->profession = $value['profession'];
                        $spouse->district = $value['district'] ?? '';
                        $spouse->total_child = $value['total_child'];
                        $spouse->save();
                    }
                }
            }*/

            //experience save
            if (!empty($request->company_name) || !empty($request->job_position) || !empty($request->company_location) || !empty($request->project_name) || !empty($request->from_date) || !empty($request->to_date) || !empty($request->job_responsibility)) {
                $experience = new Experience;
                $experience->employee_id = $employee->id;
                $experience->company_name = $request->company_name;
                $experience->job_position = $request->job_position;
                $experience->company_location = $request->company_location;
                $experience->project_name = $request->project_name;
                if ($request->from_date) {
                    $experience->from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                }
                if ($request->to_date) {
                    $experience->to_date = Carbon::parse($request->to_date)->format('Y-m-d');
                }
                $experience->job_responsibility = $request->job_responsibility;
                $experience->save();
            }

            if ($request->relationship) {
                $spouse = new Spouse;
                $spouse->employee_id = $employee->id;
                $spouse->name = $request->relation_name;
                $spouse->relationship = $request->relationship;
                $spouse->profession = $request->relation_occupation;
                $spouse->organization_id = $request->relation_organization_id;
                $spouse->contact = $request->relation_contact;
                if ($request->relation_dob) {
                    $spouse->dob = Carbon::parse($request->relation_dob)->format('Y-m-d');
                }
                $spouse->save();

            }

            if (is_int($request->pr_division_id) || is_int($request->present_country_id) || is_int($request->pr_district_id) || is_int($request->pr_upazila_id)) {
                $presentAddress = PresentAddress::create([
                    'employee_id' => $employee->id,
                    'division_id' => $request->pr_division_id,
                    'district_id' => $request->pr_district_id,
                    'upazila_id' => $request->pr_upazila_id,
                    'post_office' => $request->pr_post_office,
                    'postal_code' => $request->pr_postal_code,
                    'area' => $request->pr_area,
                    'u_c_c_w' => $request->pr_u_c_c_w,
                    'house_no' => $request->pr_house_no,
                    'country_id' => $request->present_country_id
                ]);
            }

            if (is_int($request->pa_division_id) || is_int($request->permanent_country_id) || is_int($request->pa_district_id) || is_int($request->pa_upazila_id)) {
                $parmanentAddress = ParmanentAddress::create([
                    'employee_id' => $employee->id,
                    'division_id' => $request->pa_division_id,
                    'district_id' => $request->pa_district_id,
                    'upazila_id' => $request->pa_upazila_id,
                    'post_office' => $request->pa_post_office,
                    'postal_code' => $request->pa_postal_code,
                    'area' => $request->pa_area,
                    'u_c_c_w' => $request->pa_u_c_c_w,
                    'house_no' => $request->pa_house_no,
                    'country_id' => $request->permanent_country_id
                ]);
            }


            if ($request->nominees) {
                $percentage = 0;
                foreach ($request->nominees as $key => $value) {
                    if (!empty($value['name'])) {
                        $nominee = new Nominee();
                        $nominee->employee_id = $employee->id;
                        $nominee->name = $value['name'];
                        $nominee->relationship_id = $value['relationship'] ?? null;
                        $nominee->permanent_address = $value['permanent_address'] ?? null;
                        $nominee->nid_no = $value['nid_no'] ?? null;
                        //                        $nominee->percentage = $value['percentage'];
                        if ($value['dob']) {
                            $nominee->dob = Carbon::parse($value['dob'])->format('Y-m-d');
                        }
                        if (!empty($value['picture'])) {
                            $picture = 'nominee' . $key . '-' . $employee->id . '-' . time() . '.' . $value['picture']->extension();
                            $value['picture']->move(getcwd() . '/assets/employee/nominees/', $picture);
                            $nominee->picture_url = $picture;
                        }
                        if (!empty($value['signature'])) {
                            $picture = 'nominee' . $key . '-' . $employee->id . '-' . time() . '.' . $value['signature']->extension();
                            $value['signature']->move(getcwd() . '/assets/employee/nominees/', $picture);
                            $nominee->signature = $picture;
                        }
                        $nominee->save();
                        //                        $percentage += $value['percentage'];
                    }
                }
                /*if ($percentage > 100) {
                    Toastr::error('Nominee percentages total can\'t be more than 100%, Currently you are trying to give ' . $percentage . '%!', 'Error');
                    return back();
                }*/
            }

            if ($request->jsc_examination) {
                $educational_qualification = new EducationalQualification();

                $educational_qualification->employee_id = $employee->id;
                $educational_qualification->type = 'jsc';
                $educational_qualification->examination = $request->jsc_examination;
                $educational_qualification->board = $request->jsc_board;
                $educational_qualification->roll = $request->jsc_roll;
                if (!($request->jsc_result == 4 || $request->jsc_result == 5)) {
                    $educational_qualification->result = $request->jsc_result;
                } else {
                    $educational_qualification->result = $request->jsc_gpa;
                }
                $educational_qualification->passing_year = $request->jsc_passing_year;
                $educational_qualification->institute = $request->jsc_institute;

                $educational_qualification->save();
            }

            if ($request->ssc_examination) {
                $educational_qualification = new EducationalQualification();

                $educational_qualification->employee_id = $employee->id;
                $educational_qualification->type = 'ssc';
                $educational_qualification->examination = $request->ssc_examination;
                $educational_qualification->board = $request->ssc_board;
                $educational_qualification->roll = $request->ssc_roll;
                if (!($request->ssc_result == 4 || $request->ssc_result == 5)) {
                    $educational_qualification->result = $request->ssc_result;
                } else {
                    $educational_qualification->result = $request->ssc_gpa;
                }
                $educational_qualification->subject = $request->ssc_subject;
                $educational_qualification->passing_year = $request->ssc_passing_year;
                $educational_qualification->institute = $request->ssc_institute;

                $educational_qualification->save();
            }

            if ($request->hsc_examination) {
                $educational_qualification = new EducationalQualification();

                $educational_qualification->employee_id = $employee->id;
                $educational_qualification->type = 'hsc';
                $educational_qualification->examination = $request->hsc_examination;
                $educational_qualification->board = $request->hsc_board;
                $educational_qualification->roll = $request->hsc_roll;
                if (!($request->hsc_result == 4 || $request->hsc_result == 5)) {
                    $educational_qualification->result = $request->hsc_result;
                } else {
                    $educational_qualification->result = $request->hsc_gpa;
                }
                $educational_qualification->subject = $request->hsc_subject;
                $educational_qualification->passing_year = $request->hsc_passing_year;
                $educational_qualification->institute = $request->hsc_institute;

                $educational_qualification->save();
            }

            if ($request->graduation_examination) {
                $educational_qualification = new EducationalQualification();

                if ($request->graduation_institute) {
                    if (Institute::where('type', 'Graduation')->where('name', $request->graduation_institute)->get()->isEmpty()) {
                        Institute::create([
                            'name' => $request->graduation_institute,
                            'type' => 'Graduation',
                        ]);
                    }
                }

                $educational_qualification->employee_id = $employee->id;
                $educational_qualification->type = 'graduation';
                $educational_qualification->examination = $request->graduation_examination;
                $educational_qualification->duration = $request->graduation_course_duration;
                if (!($request->graduation_result == 4 || $request->graduation_result == 5)) {
                    $educational_qualification->result = $request->graduation_result;
                } else {
                    $educational_qualification->result = $request->graduation_gpa;
                }
                $educational_qualification->subject = $request->graduation_subject;
                $educational_qualification->passing_year = $request->graduation_passing_year;
                $educational_qualification->institute = $request->graduation_institute;

                $educational_qualification->save();
            }

            if ($request->masters_examination) {
                $educational_qualification = new EducationalQualification();

                if ($request->masters_institute) {
                    if (Institute::where('type', 'Masters')->where('name', $request->masters_institute)->get()->isEmpty()) {
                        Institute::create([
                            'name' => $request->masters_institute,
                            'type' => 'Masters',
                        ]);
                    }
                }


                $educational_qualification->employee_id = $employee->id;
                $educational_qualification->type = 'masters';
                $educational_qualification->examination = $request->masters_examination;
                $educational_qualification->duration = $request->masters_course_duration;
                if (!($request->masters_result == 4 || $request->masters_result == 5)) {
                    $educational_qualification->result = $request->masters_result;
                } else {
                    $educational_qualification->result = $request->masters_gpa;
                }
                $educational_qualification->subject = $request->masters_subject;
                $educational_qualification->passing_year = $request->masters_passing_year;
                $educational_qualification->institute = $request->masters_institute;

                $educational_qualification->save();
            }

            if ($request->more_education) {
                foreach ($request->more_education as $more_education) {
                    $educational_qualification = new EducationalQualification();

                    if ($more_education['examination']) {
                        $educational_qualification->employee_id = $employee->id;
                        $educational_qualification->type = 'more';
                        $educational_qualification->examination = $more_education['examination'];
                        $educational_qualification->duration = $more_education['duration'];

                        if (!($more_education['result'] == 4 || $more_education['result'] == 5)) {
                            $educational_qualification->result = $more_education['result'];
                        } else {
                            $educational_qualification->result = $more_education['gpa'];
                        }

                        $educational_qualification->subject = $more_education['subject'];
                        $educational_qualification->passing_year = $more_education['passing_year'];
                        $educational_qualification->institute = $more_education['institute'];

                        $educational_qualification->save();
                    }
                }
            }

            if ($request->professional_designation) {
                $professional_experience = new ProfessionalExperience();

                if ($request->professional_organization) {
                    $professional_experience->employee_id = $employee->id;
                    $professional_experience->designation = $request->professional_designation;
                    $professional_experience->organization = $request->professional_organization;
                    $professional_experience->from_date = Carbon::parse($request->professional_from_date)->format('Y-m-d');
                    $professional_experience->to_date = Carbon::parse($request->professional_to_date)->format('Y-m-d');
                    $professional_experience->responsibilities = $request->professional_responsibilities;

                    $professional_experience->save();
                }
            }

            if ($request->professional) {
                foreach ($request->professional as $key => $professional) {
                    $professional_experience = new ProfessionalExperience();

                    if ($professional['designation']) {
                        $professional_experience->employee_id = $employee->id;
                        $professional_experience->designation = $professional['designation'];
                        $professional_experience->organization = $professional['organization'];
                        $professional_experience->from_date = Carbon::parse($professional['from_date'])->format('Y-m-d');
                        $professional_experience->to_date = Carbon::parse($professional['to_date'])->format('Y-m-d');
                        $professional_experience->responsibilities = $professional['responsibilities'];

                        $professional_experience->save();
                    }
                }
            }

            if ($request->journal) {
                foreach ($request->journal as $key => $journal_request) {
                    $journal = new Journal();

                    if ($journal_request['title']) {
                        $journal->employee_id = $employee->id;
                        $journal->title = $journal_request['title'];
                        $journal->publication = $journal_request['publication'];
                        $journal->publication_date = Carbon::parse($journal_request['publication_date'])->format('Y-m-d');
                        $journal->author = $journal_request['author'];
                        $journal->publication_url = $journal_request['publication_url'];

                        $journal->save();
                    } else {
                        Toastr::error('You have some errors in Publication/Journal section', 'Error');
                        return back();
                    }
                }
            }

            DB::commit();
            Toastr::success('Employee Created Successfully!', 'Success');
            return redirect()->route('employee.edit', $employee->id);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
            // something went wrong
            Toastr::error('Something went wrong!', 'Error');
            return back();
        }
    }

    public function show($id)
    {
        $relationships = Relationship::all();
        $employee = Employee::findOrFail($id);

        // logger($employee->speciliazes);
        foreach ($employee->speciliazes as $spect) {
            $spect->specilizedSkill;
        }

        if (\request()->wantsJson()) {
            return response()->json($employee);
        }
        return view('admin.employee.show', compact('employee', 'relationships'));
    }

    public function edit($id)
    {
        $employee = Employee::with(['education_professional', 'speciliazes', 'education_masters', 'education_graduation', 'education_hsc', 'education_ssc', 'education_jsc', 'monthly_grade.allowances', 'monthly_grade.deduction', 'experiences'])->find($id);
        // dd($employee);
        Session::forget('employee_id');
        Session::put('employee_id', $id);

        $subjects = new Subject;
        $institutes = new Institute;
        $data = [
            'quotas' => Quota::query()->where('status', 'active')->get(),
            'experience_job_positions' => ExperienceJobPosition::all(),
            'countries' => Country::query()->orderBy('name', 'ASC')->get(),
            'districts' => District::query()->orderBy('name', 'ASC')->get(),
            'divisions' => Division::query()->orderBy('name', 'ASC')->get(),
            'designations' => Designation::query()->where('status', 'active')->orderBy('en_name', 'ASC')->get(),
            'stations' => Station::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'offices' => Office::query()->where('status', 'active')->get(),
            // 'grades' => Grade::query()->where('status', 'active')->get(),stations
            'grades' => Salary_template::pluck('grade_id'),
            'ssc_subjects' => $subjects->where('type', 'SSC')->orderBy('name', 'ASC')->get(),
            'hsc_subjects' => $subjects->where('type', 'HSC')->orderBy('name', 'ASC')->get(),
            'graduation_subjects' => $subjects->where('type', 'Graduation')->orderBy('name', 'ASC')->get(),
            'masters_subjects' => $subjects->where('type', 'Masters')->orderBy('name', 'ASC')->get(),
            'graduation_institutes' => $institutes->where('type', 'Graduation')->orderBy('name', 'ASC')->get(),
            'masters_institutes' => $institutes->where('type', 'Masters')->orderBy('name', 'ASC')->get(),
            'relationship' => Relationship::all(),
            'batch' => Batch::all(),
            'specialized_skills' => Specialized::all(),
            'upazillas' => Upazila::query()->orderBy('name', 'ASC')->get(),
            'organizations' => Organization::query()->where('status', 'active')->orderBy('name', 'ASC')->get(), //have to make crud,
            'diseases' => Disease::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'departments' => Department::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'locations' => Location::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'subLocations' => SubLocation::query()->where('status', 'active')->orderBy('name', 'ASC')->get(),
            'employee' => $employee,
        ];
        return view('admin.employee.edit', $data);
    }

    public function update(Request $request, Employee $employee)
    {
        /*$availablePercentage = $employee->availableNomineePercentage();
        $givenPercentage = 0;
        if ($request->nominees) {
            foreach ($request->nominees as $percentage) {
                $givenPercentage += $percentage['percentage'];
            }
        }*/

        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            /*'pin_no' => ['required', 'unique:employees,pin_no,' . $employee->id],
            'new_pin' => ['nullable', 'unique:employees,new_pin,' . $employee->id],
            'batch_no' => 'required_with:batch_no_ext',*/
            /*'batch_no_ext' => 'required_with:batch_no',*/
            'id_card_no' => 'nullable|unique:employees,id_card_no,' . $employee->id,
            'email' => 'nullable|unique:employees,email,' . $employee->id . '|email',
            'nid_no' => 'nullable|unique:employees,nid_no,' . $employee->id,
            'mobile_no' => 'nullable|unique:employees,mobile_no,' . $employee->id,
            'dob' => 'nullable|date_format:d-m-Y',
            'join_date' => 'nullable|date_format:d-m-Y',
            'lpr_date' => 'nullable|date_format:d-m-Y',

            'jsc_examination' => 'required_with:jsc_board,jsc_roll,jsc_result,jsc_gpa,jsc_passing_year,jsc_institute',
            'jsc_board' => 'required_with:jsc_roll',
            'jsc_roll' => 'nullable|min:2|max:20',
            'jsc_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'ssc_examination' => 'required_with:ssc_board,ssc_roll,ssc_result,ssc_gpa,ssc_subject,ssc_passing_year,ssc_institute',
            'ssc_board' => 'required_with:ssc_roll',
            'ssc_roll' => 'nullable|min:2|max:20',
            'ssc_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'hsc_examination' => 'required_with:hsc_board,hsc_roll,hsc_result,hsc_gpa,hsc_subject,hsc_passing_year,hsc_institute',
            'hsc_board' => 'required_with:hsc_roll',
            'hsc_roll' => 'nullable|min:2|max:20',
            'hsc_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'graduation_examination' => 'required_with:graduation_course_duration,graduation_result,graduation_gpa,graduation_subject,graduation_passing_year,graduation_institute',
            'graduation_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            'masters_examination' => 'required_with:masters_course_duration,masters_result,masters_gpa,masters_subject,masters_passing_year,masters_institute',
            'masters_gpa' => ['nullable', 'numeric', 'between:1.00,5.00'],

            /*'professional.designation' => 'required_with:professional.organization,professional.from_date,professional.to_date,professional.responsibilities',
            'professional.to_date' => 'required_with:professional_to_date|nullable|date_format:d-m-Y',
            'professional.from_date' => 'nullable|date_format:d-m-Y',*/

            'img_url' => 'nullable|image|max:200|min:20',
            'signature_url' => 'nullable|image|max:200|min:20',
            'nominees.*.picture' => 'nullable|image|max:200|min:20',

            /*'nominees.*.percentage' => [
                'required_with:nominees.*.name',
                'integer',
                function ($attribute, $value, $fail) use ($availablePercentage, $givenPercentage) {
                    if ($givenPercentage > 100) {
                        $fail('Available Percentage for New Nominee ' . $availablePercentage . '%');
                    }
                },
            ],*/
        ]);

        //----------profile picture image---------//
        if ($request->img_url) {
            $img = $request->file('img_url');
            $firstimageName = uniqid('employee', false) . '.' . $img->getClientOriginalExtension();
            $directory = 'assets/employee/';
            $imgUrl = $directory . $firstimageName;
            Image::make($img)->save(getcwd() . '/' . $imgUrl);

            if ($employee->img_url) {
                if (file_exists('assets/employee/' . $employee->img_url)) {
                    unlink('assets/employee/' . $employee->img_url);
                }
            }
            $employee->img_url = $firstimageName;
        }

        //----------signature image---------//
        if ($request->signature_url) {

            $img = $request->file('signature_url');
            $firstimageName = uniqid('employee', false) . '.' . $img->getClientOriginalExtension();
            $directory = '/assets/employee/signatures/';
            $imgUrl = $directory . $firstimageName;

            Image::make($img)->save(getcwd() . $imgUrl);

            if ($employee->signature_url) {
                if (file_exists('assets/employee/signatures/' . $employee->signature_url)) {
                    unlink('assets/employee/signatures/' . $employee->signature_url);
                }
            }
            $employee->signature_url = $firstimageName;
        }

        //--------Job Assign attachment-file-----------//
        if ($request->attached_file) {
            Storage::delete(public_path('assets/employee/attached_files') . $employee->attached_file);
            $pdfFileName = time() . '.' . $request->attached_file->extension();
            $request->attached_file->move(getcwd() . '/assets/employee/attached_files', $pdfFileName);
            $employee->attached_file = $pdfFileName;
        }

        //--------Attached Information attachment-file-----------//
        if ($request->attached_attached_file) {
            $pdfFileName = time() . '.' . $request->attached_attached_file->extension();
            $request->attached_attached_file->move(getcwd() . '/assets/employee/attached_files', $pdfFileName);
            $employee->attached_attached_file = $pdfFileName;
        }

        $employee->fill($request->except('img_url', 'signature_url', 'join_date', 'lpr_date', 'attached_file', 'attached_attached_file'));

        if ($employee->police_station_id != null) {
            $station = Station::find($employee->police_station_id);
            $employee->division_id = $station->division_id;
            $employee->district_id = $station->district_id;
            $employee->upazila_id = $station->upazila_id;
        }

        if ($request->is_attached_to_station_or_office === 'NO') {
            $employee->attached_designation_id = null;
            $employee->attached_police_station_id = null;
            $employee->attached_division_id = null;
            $employee->attached_district_id = null;
            $employee->attached_upazila_id = null;
            $employee->attached_attached_file = null;
        } else {
            if ($employee->attached_police_station_id != null) {
                $attached_station = Station::find($employee->attached_police_station_id);
                $employee->attached_division_id = $attached_station->division_id;
                $employee->attached_district_id = $attached_station->district_id;
                $employee->attached_upazila_id = $attached_station->upazila_id;
            }
        }

        $employee->dob = $request->dob ? Carbon::parse($request->dob)->format('Y-m-d') : null;
        $employee->join_date = $request->join_date ? Carbon::parse($request->join_date)->format('Y-m-d') : null;
        $employee->lpr_date = $request->lpr_date ? Carbon::parse($request->lpr_date)->format('Y-m-d') : null;

        if ($request->batch_no) {
            $employee->batch_no = $request->batch_no;
            $employee->batch_no_ext = $request->batch_no_ext;
        }

        $employee->name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->organization_id = $request->organization_id;
        $employee->department_id = $request->department_id;
        $employee->location_id = $request->location_id;
        $employee->sub_location_id = $request->sub_location_id;
        $employee->ot_eligibility = $request->ot_eligibility;
        $employee->pf_eligibility = $request->pf_eligibility;
        $employee->is_auto_approved_leave = $request->is_auto_approved_leave;
        $employee->birth_certificate_no = $request->birth_certificate_no;
        $employee->disease_id = $request->disease_id;
        $employee->update();

        /*if ($request->spouses) {
            $ids = Arr::pluck($request->spouses, 'id');
            $employee->spouses()->whereNotIn('id', $ids)->delete();

            foreach ($request->spouses as $value) {
                if (!empty($value['name'])) {
                    Spouse::updateOrCreate(
                        ['id' => $value['id']],
                        [
                            'employee_id' => $employee->id,
                            'name' => $value['name'],
                            'tin' => $value['tin'],
                            'profession' => $value['profession'],
                            'district' => $value['district'] ?? '',
                            'total_child' => $value['total_child'],
                        ]
                    );
                }
            }
        } else {
            $employee->spouses()->delete();
        }*/

        //experience save
        if (!empty($request->company_name) || !empty($request->job_position) || !empty($request->company_location) || !empty($request->project_name) || !empty($request->from_date) || !empty($request->to_date) || !empty($request->job_responsibility)) {
            $experience = Experience::where('employee_id', $employee->id)->first();
            $experience->employee_id = $employee->id;
            $experience->company_name = $request->company_name;
            $experience->job_position = $request->job_position;
            $experience->company_location = $request->company_location;
            $experience->project_name = $request->project_name;
            if ($request->from_date) {
                $experience->from_date = Carbon::parse($request->from_date)->format('Y-m-d');
            }
            if ($request->to_date) {
                $experience->to_date = Carbon::parse($request->to_date)->format('Y-m-d');
            }
            $experience->job_responsibility = $request->job_responsibility;
            $experience->save();
        }

        if ($request->relationship) { //have to work on this
            $spouse = Spouse::where('employee_id', $employee->id)->first();
            $spouse->employee_id = $employee->id;
            $spouse->name = $request->relation_name;
            $spouse->relationship = $request->relationship;
            $spouse->profession = $request->relation_occupation;
            $spouse->organization_id = $request->relation_organization_id;
            $spouse->contact = $request->relation_contact;
            if ($request->relation_dob) {
                $spouse->dob = Carbon::parse($request->relation_dob)->format('Y-m-d');
            }
            $spouse->save();

        }

        $presentAddress = $employee->presentAddress()->update([
            'division_id' => $request->pr_division_id,
            'district_id' => $request->pr_district_id,
            'upazila_id' => $request->pr_upazila_id,
            'post_office' => $request->pr_post_office,
            'postal_code' => $request->pr_postal_code,
            'area' => $request->pr_area,
            'u_c_c_w' => $request->pr_u_c_c_w,
            'house_no' => $request->pr_house_no,
            'country_id' => $request->present_country_id
        ]);

        $parmanentAddress = $employee->parmanentAddress()->update([
            'division_id' => $request->pa_division_id,
            'district_id' => $request->pa_district_id,
            'upazila_id' => $request->pa_upazila_id,
            'post_office' => $request->pa_post_office,
            'postal_code' => $request->pa_postal_code,
            'area' => $request->pa_area,
            'u_c_c_w' => $request->pa_u_c_c_w,
            'house_no' => $request->pa_house_no,
            'country_id' => $request->permanent_country_id
        ]);

        if ($request->nominees) {
            $ids = Arr::pluck($request->nominees, 'id');
            $employee->nominees()->whereNotIn('id', $ids)->delete();

            foreach ($request->nominees as $key => $value) {
                if (!empty($value['name'])) {
                    $nominee = Nominee::updateOrCreate(
                        ['id' => $value['id']],
                        [
                            'employee_id' => $employee->id,
                            'name' => $value['name'],
                            'relationship_id' => $value['relationship'],
                            'permanent_address' => $value['permanent_address'],
                            'nid_no' => $value['nid_no'],
                            //                            'percentage' => $value['percentage'],

                        ]
                    );
                    if ($value['dob']) {
                        $nominee->dob = Carbon::parse($value['dob'])->format('Y-m-d');
                    }

                    if (!empty($value['picture'])) {
                        $picture = 'nominee' . $key . '-' . $employee->id . '-' . time() . '.' . $value['picture']->extension();
                        $value['picture']->move(getcwd() . '/assets/employee/nominees/', $picture);
                        $nominee->picture_url = $picture;
                    }
                    if (!empty($value['signature'])) {
                        $picture = 'nominee' . $key . '-' . $employee->id . '-' . time() . '.' . $value['signature']->extension();
                        $value['signature']->move(getcwd() . '/assets/employee/nominees/', $picture);
                        $nominee->signature = $picture;
                    }
                    $nominee->save();
                }
            }
        } else {
            $employee->nominees()->delete();
        }

        if ($request->jsc_examination) {

            if ($employee->education_jsc) {
                $jsc = $employee->education_jsc;
            } else {
                $jsc = new EducationalQualification();
            }

            $jsc->employee_id = $employee->id;
            $jsc->type = 'jsc';
            $jsc->examination = $request->jsc_examination;
            $jsc->board = $request->jsc_board;
            $jsc->roll = $request->jsc_roll;
            if (!($request->jsc_result == 4 || $request->jsc_result == 5)) {
                $jsc->result = $request->jsc_result;
            } else {
                $jsc->result = $request->jsc_gpa;
            }
            $jsc->passing_year = $request->jsc_passing_year;
            $jsc->institute = $request->jsc_institute;

            $jsc->save();
        } else {
            $jsc = $employee->education_jsc ? $employee->education_jsc->delete() : null;
        }

        if ($request->ssc_examination) {
            if ($employee->education_ssc) {
                $ssc = $employee->education_ssc;
            } else {
                $ssc = new EducationalQualification();
            }

            $ssc->employee_id = $employee->id;
            $ssc->type = 'ssc';
            $ssc->examination = $request->ssc_examination;
            $ssc->board = $request->ssc_board;
            $ssc->roll = $request->ssc_roll;
            if (!($request->ssc_result == 4 || $request->ssc_result == 5)) {
                $ssc->result = $request->ssc_result;
            } else {
                $ssc->result = $request->ssc_gpa;
            }
            $ssc->subject = $request->ssc_subject;
            $ssc->passing_year = $request->ssc_passing_year;
            $ssc->institute = $request->ssc_institute;

            $ssc->save();
        } else {
            $ssc = $employee->education_ssc ? $employee->education_ssc->delete() : null;
        }

        if ($request->hsc_examination) {
            if ($employee->education_hsc) {
                $hsc = $employee->education_hsc;
            } else {
                $hsc = new EducationalQualification();
            }

            $hsc->employee_id = $employee->id;
            $hsc->type = 'hsc';
            $hsc->examination = $request->hsc_examination;
            $hsc->board = $request->hsc_board;
            $hsc->roll = $request->hsc_roll;
            if (!($request->hsc_result == 4 || $request->hsc_result == 5)) {
                $hsc->result = $request->hsc_result;
            } else {
                $hsc->result = $request->hsc_gpa;
            }
            $hsc->subject = $request->hsc_subject;
            $hsc->passing_year = $request->hsc_passing_year;
            $hsc->institute = $request->hsc_institute;

            $hsc->save();
        } else {
            $hsc = $employee->education_hsc ? $employee->education_hsc->delete() : null;
        }

        if ($request->graduation_examination) {
            if ($employee->education_graduation) {
                $graduation = $employee->education_graduation;
            } else {
                $graduation = new EducationalQualification();
            }

            if ($request->graduation_institute) {
                if (Institute::where('type', 'Graduation')->where('name', $request->graduation_institute)->get()->isEmpty()) {
                    Institute::create([
                        'name' => $request->graduation_institute,
                        'type' => 'Graduation',
                    ]);
                }
            }

            $graduation->employee_id = $employee->id;
            $graduation->type = 'graduation';
            $graduation->examination = $request->graduation_examination;
            $graduation->duration = $request->graduation_course_duration;
            if (!($request->graduation_result == 4 || $request->graduation_result == 5)) {
                $graduation->result = $request->graduation_result;
            } else {
                $graduation->result = $request->graduation_gpa;
            }
            $graduation->subject = $request->graduation_subject;
            $graduation->passing_year = $request->graduation_passing_year;
            $graduation->institute = $request->graduation_institute;

            $graduation->save();
        } else {
            $graduation = $employee->education_graduation ? $employee->education_graduation->delete() : null;
        }

        if ($request->masters_examination) {
            if ($employee->education_masters) {
                $masters = $employee->education_masters;
            } else {
                $masters = new EducationalQualification();
            }

            if ($request->masters_institute) {
                if (Institute::where('type', 'Masters')->where('name', $request->masters_institute)->get()->isEmpty()) {
                    Institute::create([
                        'name' => $request->masters_institute,
                        'type' => 'Masters',
                    ]);
                }
            }

            $masters->employee_id = $employee->id;
            $masters->type = 'masters';
            $masters->examination = $request->masters_examination;
            $masters->duration = $request->masters_course_duration;
            if (!($request->masters_result == 4 || $request->masters_result == 5)) {
                $masters->result = $request->masters_result;
            } else {
                $masters->result = $request->masters_gpa;
            }
            $masters->subject = $request->masters_subject;
            $masters->passing_year = $request->masters_passing_year;
            $masters->institute = $request->masters_institute;

            $masters->save();
        } else {
            $masters = $employee->education_masters ? $employee->education_masters->delete() : null;
        }

        if ($request->more_education) {
            $ids = [];
            $more_education = $request->more_education;
            foreach ($more_education as $key => $education) {
                if (isset($education['check'])) {
                    array_push($ids, array_keys($more_education, $education));
                }
                if (isset($education['examination'])) {
                    if (EducationalQualification::find($education['id'])) {
                        $more = EducationalQualification::find($education['id']);
                    } else {
                        $more = new EducationalQualification();
                    }
                    $more->employee_id = $employee->id;
                    $more->type = 'more';
                    $more->examination = $education['examination'];
                    $more->duration = $education['duration'];

                    if (!($education['result'] == 4 || $education['result'] == 5)) {
                        $more->result = $education['result'];
                    } else {
                        $more->result = $education['gpa'];
                    }

                    $more->subject = $education['subject'];
                    $more->passing_year = $education['passing_year'];
                    $more->institute = $education['institute'];

                    $more->save();
                }
            }
            $employee->educations()->whereIn('id', $ids)->delete();
        }

        if ($request->professional) {
            $ids = [];
            foreach ($request->professional as $key => $input) {
                if (isset($input['check'])) {
                    array_push($ids, array_keys($request->professional, $input));
                }
                if (isset($input['designation'])) {
                    if (ProfessionalExperience::find($input['id'])) {
                        $professional = ProfessionalExperience::find($input['id']);
                    } else {
                        $professional = new ProfessionalExperience();
                    }
                    $professional->employee_id = $employee->id;
                    $professional->designation = $input['designation'];
                    $professional->organization = $input['organization'];
                    $professional->from_date = $input['from_date'] ? Carbon::parse($input['from_date'])->format('Y-m-d') : null;
                    $professional->to_date = $input['to_date'] ? Carbon::parse($input['to_date'])->format('Y-m-d') : null;
                    $professional->responsibilities = $input['responsibilities'];

                    $professional->save();
                }
            }

            $employee->professional_experiences()->whereIn('id', $ids)->delete();
        }

        if ($request->journal) {
            $ids = [];
            $journals = $request->journal;
            foreach ($journals as $key => $journal_request) {
                if (isset($journal_request['check'])) {
                    array_push($ids, array_keys($request->journal, $journal_request));
                }
                if (isset($journal_request['title'])) {
                    if (Journal::find($journal_request['id'])) {
                        $journal = Journal::find($journal_request['id']);
                    } else {
                        $journal = new Journal();
                    }

                    $journal->employee_id = $employee->id;
                    $journal->title = $journal_request['title'];
                    $journal->publication = $journal_request['publication'];
                    $journal->publication_date = $journal_request['publication_date'] ? Carbon::parse($journal_request['publication_date'])->format('Y-m-d') : '';
                    $journal->author = $journal_request['author'];
                    $journal->publication_url = $journal_request['publication_url'];

                    $journal->save();
                }
            }
            $employee->journals()->whereIn('id', $ids)->delete();
        }

        Toastr::success('Employee Updated Successfully!', 'Success');
        return back();
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        Toastr::success('Employee Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('employee.index');
    }

    public function getDeletedEmployee()
    {
        $employees = Employee::onlyTrashed()->get();
        return view('admin.employee.deleted_employee', compact('employees'));
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id)->restore();

        Toastr::success('Employee Restore Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('employee.deleted');
    }

    public function permanentDelete($id)
    {

        $employee = Employee::withTrashed()->findOrFail($id);

        $employee->educations()->delete();
        $employee->professional_experiences()->delete();
        $employee->awards()->delete();
        $employee->leaves()->delete();
        $employee->achievements()->delete();
        $employee->punishments()->delete();
        $employee->nominees()->delete();
        $employee->foreign_trainings()->delete();
        $employee->local_trainings()->delete();
        $employee->inhouse_trainings()->delete();
        $employee->posting_records()->delete();
        $employee->spouses()->delete();
        $employee->presentAddress()->delete();
        $employee->parmanentAddress()->delete();
        $employee->education_professional()->delete();
        $employee->journals()->delete();

        $employee->forceDelete();

        Toastr::success('Employee Permanently Deleted with all related data!');
        return redirect()->route('employee.deleted');
    }

    function short_generate_pdf($employee_id)
    {
        // dd($employee_id);
        $employee = Employee::find($employee_id);
        $company = DynamicName::find(1);
        $logo = Brand::find(1);
        $age = '';
        if ($employee->dob) {
            $dob = Carbon::parse($employee->dob)->format('d-m-Y');
            $age = $this->age($dob);
        }


        $data = [
            'employee' => $employee,
            'age' => $age,
            'company' => $company,
            'logo' => $logo,

        ];
        // dd($data);
        $pdf = PDF::loadView(
            'admin.employee.pdf.short',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
            ]
        );

        $name = $employee->pin_no . '-short-' . \Carbon\Carbon::now()->format('d-m-Y');
        return $pdf->stream($name . '.pdf');
    }

    function long_generate_pdf($employee_id)
    {
        $relationships = Relationship::all();
        $employee = Employee::find($employee_id);
        $company = DynamicName::find(1);
        $logo = Brand::find(1);
        if ($employee->dob) {
            $dob = Carbon::parse($employee->dob)->format('d-m-Y');
            $age = $this->age($dob);
        }

        $data = [
            'employee' => $employee,
            'age' => $age,
            'relationships' => $relationships,
            'company' => $company,
            'logo' => $logo,
        ];

        $pdf = PDF::loadView(
            'admin.employee.pdf.long',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
            ]
        );
        $name = $employee->pin_no . '-long-' . \Carbon\Carbon::now()->format('d-m-Y');
        return $pdf->stream($name . '.pdf');
    }


    function attached_file()
    {
        $pdfFileName = \request()->file;
        $filePath = getcwd() . '/assets/employee/attached_files/' . $pdfFileName;
        $headers = ['Content-Type: application/pdf'];
        return response()->download($filePath, $pdfFileName, $headers);
    }

    public function age($dob)
    {
        $today = now()->format('Y-m-d');
        $date1 = date_create($today);
        $date2 = date_create($dob);
        $interval = date_diff($date2, $date1);

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
        } else if ($interval->y != 0 && $interval->m == 0) {
            $duration = $year . ', ' . $day;
        } else {
            $duration = $year . ', ' . $month . ', ' . $day;
        }

        return $duration;
    }

    public function searchEmployee()
    {
        // -Pin, name, ,grade, designation,joining date,Tentitive date,Confirmation Up to Extend period, Actual Confirmation Date
        $pin_no = request()->pin_no;
        if (!empty($pin_no)) {
            $employees = Employee::with('department', 'designation', 'posting_station', 'posting_station.district', 'posting_station.division')
                ->where('pin_no', 'like', "%$pin_no%")
                ->orWhere('name', 'like', "%$pin_no%")
                ->limit(25)->get();

        } else {
            $employees = null;
        }
        // logger($employees);
        return response()->json([
            'employees' => $employees,
        ]);
    }

    public function getEmployeesInfo()
    {
        $employee_ids = \request()->ids;
        if (!empty($employee_ids)) {
            if (gettype(\request()->ids) == 'string') {
                return $details = Employee::with('designation')->find($employee_ids);
            } elseif (gettype(\request()->ids) == 'array') {
                $details = Employee::with('designation')->whereIn('id', $employee_ids)->get();
            } else {
                $details = null;
            }

        } else {
            $details = null;
        }

        return response()->json([
            'employeesInfo' => $details,
        ]);
    }

    public function search(Request $request)
    {
        $employees = Employee::with('presentAddress', 'parmanentAddress', 'designation', 'jobGrade', 'jobStation', 'jobDivision', 'jobDistrict', 'jobUpazila', 'attachedDesignation', 'attachedStation', 'attachedDivision', 'attachedDistrict', 'attachedUpazila');

        $flag = 0;
        $count = 0;

        $data = [
            'columns' => Schema::getColumnListing('employees'),
            'batch' => Batch::all(),
            'designations' => Designation::query()->where('status', 'active')->orderBy('en_name')->get(),
            'grades' => Grade::query()->where('status', 'active')->orderBy('grade')->get(),
            'quotas' => Quota::query()->where('status', 'active')->orderBy('name')->get(),
            'countries' => Country::query()->orderBy('name', 'ASC')->orderBy('name')->get(),
            'stations' => Station::query()->where('status', 'active')->orderBy('name')->get(),
            'offices' => Office::query()->where('status', 'active')->orderBy('office')->get(),
            'relationships' => Relationship::all(),
            'employees' => $employees->get(),
            'awards' => Award::query()->orderBy('award_name')->get(),
            'achievements' => Achievement::query()->orderBy('achievement_name')->get(),
            'foreign_trainings' => ForeignTraining::query()->orderBy('course_title')->get(),
            'local_trainings' => LocalTraining::query()->orderBy('course_title')->get(),
            'inhouse_trainings' => InhouseTraining::query()->orderBy('course_title')->get(),
            'punishments' => Punishment::query()->orderBy('name')->get(),
            'leaves' => Leave::query()->orderBy('name')->get(),

            'jsc_examinations' => Examination::query()->where('type', 'JSC')->orderBy('name')->get(),
            'jsc_boards' => Board::query()->where('type', 'JSC')->orderBy('name')->get(),

            'ssc_examinations' => Examination::query()->where('type', 'SSC')->orderBy('name')->get(),
            'ssc_boards' => Board::query()->where('type', 'SSC')->orderBy('name')->get(),
            'ssc_subjects' => Subject::query()->where('type', 'SSC')->orderBy('name')->get(),

            'hsc_examinations' => Examination::query()->where('type', 'HSC')->orderBy('name')->get(),
            'hsc_boards' => Board::query()->where('type', 'HSC')->orderBy('name')->get(),
            'hsc_subjects' => Subject::query()->where('type', 'HSC')->orderBy('name')->get(),

            'graduation_examinations' => Examination::query()->where('type', 'Graduation')->orderBy('name')->get(),
            'graduation_institutes' => Institute::query()->where('type', 'Graduation')->orderBy('name')->get(),
            'graduation_subjects' => Subject::query()->where('type', 'Graduation')->orderBy('name')->get(),

            'masters_examinations' => Examination::query()->where('type', 'Masters')->orderBy('name')->get(),
            'masters_institutes' => Institute::query()->where('type', 'Masters')->orderBy('name')->get(),
            'masters_subjects' => Subject::query()->where('type', 'Masters')->orderBy('name')->get(),

            'divisions' => Division::query()->orderBy('name')->get(),
            'districts' => District::query()->orderBy('name')->get(),
            'thanas' => Upazila::query()->orderBy('name')->get(),

        ];

        if (\request()->ajax()) {

            if (!empty($request->query())) {
                $count = count($request->query());
                foreach ($request->query() as $key => $value) {
                    if (explode('_', $key)[0] == 'form') {
                        $key = explode('_', $key, 2)[1];
                        if (!empty($value) && $key != 'dynamic_criteria' && !in_array('field', explode('_', $key))) {
                            if (Schema::connection("mysql")->hasColumn('employees', $key)) {
                                if (request('form_' . $key . '_select') == '!=') {
                                    $employees->where($key, '!=', $value);
                                } else {
                                    if (explode('_', $key)[count(explode('_', $key)) - 1] == 'date') {
                                        $date = Carbon::parse($value)->format('Y-m-d');
                                        $employees = $employees->where(explode('_', $key)[0] . '_date', $date);
                                    } else {
                                        $employees->where($key, $value);
                                    }
                                }
                            } else if ($key == 'birth_date') {
                                $date = Carbon::parse($value)->format('Y-m-d');
                                $employees = $employees->where('dob', $date);
                            } else {
                                if (!($value == '==' || $value == '!=')) {
                                    if (array_key_exists('form_' . $key . '_field', $request->query())) {
                                        $model_and_column = explode('-', request('form_' . $key . '_field'));
                                        $model_name = 'App\Models\\' . $model_and_column[0];
                                        $model = $model_name::query()->where($model_and_column[1], $value)->first();
                                        $employees = $employees->where($model_and_column[2], $model->id ?? '');
                                    } else {
                                        if (array_key_exists('form_' . $key . '_select', $request->query())) {
                                            if (explode('_', $key)[0] == 'spouse') {
                                                $employees = $employees->whereHas('spouses', function ($query) use ($key, $value) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('spouses.' . explode('_', $key, 2)[1], $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('spouses.' . explode('_', $key, 2)[1], '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key)[0] == 'present') {
                                                $column = explode('_', $key, 3)[2];
                                                $employees = $employees->whereHas('presentAddress', function ($query) use ($key, $value, $column) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('present_addresses.' . $column, $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('present_addresses.' . $column, '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key)[0] == 'parmanent') {
                                                $column = explode('_', $key, 3)[2];
                                                $employees = $employees->whereHas('parmanentAddress', function ($query) use ($key, $value, $column) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('parmanent_addresses.' . $column, $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('parmanent_addresses.' . $column, '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key)[count(explode('_', $key)) - 1] == 'id') {
                                                $employees = $employees->whereHas(explode('_id', $key)[0] . 's', function ($query) use ($key, $value) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where(explode('_id', $key)[0] . 's.id', $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where(explode('_id', $key)[0] . 's.id', '!=', $value);
                                                    }
                                                });
                                            } elseif (
                                                explode('_', $key, 2)[0] == 'jsc' ||
                                                explode('_', $key, 2)[0] == 'ssc' ||
                                                explode('_', $key, 2)[0] == 'hsc' ||
                                                explode('_', $key, 2)[0] == 'graduation' ||
                                                explode('_', $key, 2)[0] == 'masters'
                                            ) {
                                                $employees = $employees->whereHas('education_' . explode('_', $key, 2)[0], function ($query) use ($key, $value) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('educational_qualifications.' . explode('_', $key, 2)[1], $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('educational_qualifications.' . explode('_', $key, 2)[1], '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key, 2)[0] == 'professional') {
                                                if (explode('_', $key, 2)[1] == 'to_date' || explode('_', $key, 2)[1] == 'from_date') {
                                                    $date = Carbon::parse($value)->format('Y-m-d');
                                                    $employees = $employees->whereHas('education_professional', function ($query) use ($key, $date) {
                                                        if (request('form_' . $key . '_select') == '==') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], $date);
                                                        } else if (request('form_' . $key . '_select') == '!=') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], '!=', $date);
                                                        }
                                                    });
                                                } else {
                                                    $employees = $employees->whereHas('education_professional', function ($query) use ($key, $value) {
                                                        if (request('form_' . $key . '_select') == '==') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], $value);
                                                        } else if (request('form_' . $key . '_select') == '!=') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], '!=', $value);
                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if (request('form_' . $key . '_select'))
                                $flag++;
                        } else {
                            $flag++;
                        }
                    }

                }
            }

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('admin.employee.action-button', compact('row'));
                })
                ->addColumn('presentAddress', function ($row) {
                    return '<b>Division:</b> ' . @$row->presentAddress->division->name . '<br>'
                        . '<b>District:</b> ' . @$row->presentAddress->district->name . '<br>'
                        . '<b>Upazila: </b>' . @$row->presentAddress->upazila->name . '<br>'
                        . '<b>Post-Office:</b> ' . @$row->presentAddress->post_office . '<br>'
                        . '<b>Postal-Code:</b> ' . @$row->presentAddress->postal_code . '<br>'
                        . '<b>Village: </b>' . @$row->presentAddress->area . '<br>'
                        . '<b>Union: </b>' . @$row->presentAddress->u_c_c_w . '<br>'
                        . '<b>House-No:</b> ' . @$row->presentAddress->house_no;
                })
                ->addColumn('permanentAddress', function ($row) {
                    return '<b>Division:</b> ' . @$row->parmanentAddress->division->name . '<br>'
                        . '<b>District:</b> ' . @$row->parmanentAddress->district->name . '<br>'
                        . '<b>Upazila:</b> ' . @$row->parmanentAddress->upazila->name . '<br>'
                        . '<b>Post-Office:</b> ' . @$row->parmanentAddress->post_office . '<br>'
                        . '<b>Postal-Code:</b> ' . @$row->parmanentAddress->postal_code . '<br>'
                        . '<b>Village:</b> ' . @$row->parmanentAddress->area . '<br>'
                        . '<b>Union:</b> ' . @$row->parmanentAddress->u_c_c_w . '<br>'
                        . '<b>House-No:</b> ' . @$row->parmanentAddress->house_no;
                })
                ->addColumn('grade', function ($row) {
                    return @$row->jobGrade->grade;
                })
                ->addColumn('job_details', function ($row) {
                    return '<b>Designation:</b> ' . @$row->designation->en_name . '<br>'
                        . '<b>Office/Station:</b> ' . @$row->jobStation->name . '<br>'
                        . '<b>Office/Station Division:</b> ' . @$row->jobDivision->name . '<br>'
                        . '<b>Office/Station District:</b> ' . @$row->jobDistrict->name . '<br>'
                        . '<b>Office/Station Upazila:</b> ' . @$row->jobUpazila->name;
                })
                ->addColumn('attached_job_details', function ($row) {
                    return '<b>Attached Designation:</b> ' . @$row->designation->en_name . '<br>'
                        . '<b>Attached Office/Station:</b> ' . @$row->jobStation->name . '<br>'
                        . '<b>Attached Office/Station Division:</b> ' . @$row->jobDivision->name . '<br>'
                        . '<b>Attached Office/Station District:</b> ' . @$row->jobDistrict->name . '<br>'
                        . '<b>Attached Office/Station Upazila:</b> ' . @$row->jobUpazila->name;
                })
                ->addColumn('designation', function ($row) {
                    return @$row->designation->en_name;
                })
                ->addColumn('jobStation', function ($row) {
                    return @$row->jobStation->name . ' [' . @$row->jobStation->code . ']';
                })
                ->addColumn('jobDivision', function ($row) {
                    return @$row->jobDivision->name;
                })
                ->addColumn('jobDistrict', function ($row) {
                    return @$row->jobDistrict->name;
                })
                ->addColumn('jobUpazila', function ($row) {
                    return @$row->jobUpazila->name;
                })
                ->addColumn('JSC', function ($row) {
                    if ($row->education_jsc) {
                        return '<b>Exam-</b>' . @$row->education_jsc->examination . '<br> <b>Board-</b>' . @$row->education_jsc->board . '<br> <b>Roll-</b>' . @$row->education_jsc->roll . '<br><b>Result-</b>' . @$row->education_jsc->result . '<br><b>Passing Year-</b>' . @$row->education_jsc->passing_year . '<br> <b>Institute-</b>' . @$row->education_jsc->isntitute;
                    } else {
                        return '<b>N/A</b>';
                    }
                })
                ->addColumn('SSC', function ($row) {
                    if ($row->education_ssc) {
                        return '<b>Exam-</b>' . @$row->education_ssc->examination . '<br> <b>Board-</b>' . @$row->education_ssc->board . '<br> <b>Roll-</b>' . @$row->education_ssc->roll . '<br><b>Result-</b>' . @$row->education_ssc->result . '<br> <b>Subject-</b>' . @$row->education_ssc->subject . '<br><b>Passing Year-</b>' . @$row->education_ssc->passing_year . '<br> <b>Institute-</b>' . @$row->education_ssc->isntitute;
                    } else {
                        return '<b>N/A</b>';
                    }
                })
                ->addColumn('HSC', function ($row) {
                    if ($row->education_hsc) {
                        return '<b>Exam-</b>' . @$row->education_hsc->examination . '<br> <b>Board-</b>' . @$row->education_hsc->board . '<br> <b>Roll-</b>' . @$row->education_hsc->roll . '<br><b>Result-</b>' . @$row->education_hsc->result . '<br> <b>Subject-</b>' . @$row->education_hsc->subject . '<br><b>Passing Year-</b>' . @$row->education_hsc->passing_year . '<br> <b>Institute-</b>' . @$row->education_hsc->isntitute;
                    } else {
                        return '<b>N/A</b>';
                    }
                })
                ->addColumn('Graduation', function ($row) {
                    if ($row->education_graduation) {
                        return '<b>Exam-</b>' . @$row->education_graduation->examination . '<br> <b>Duration-</b>' . @$row->education_graduation->duration . '<br> <b>Result-</b>' . @$row->education_graduation->result . '<br> <b>Subject-</b>' . @$row->education_graduation->subject . '<br> <b>Year-</b>' . @$row->education_graduation->passing_year . '<br> <b>Institute-</b>' . @$row->education_graduation->institute;
                    } else {
                        return '<b>N/A</b>';
                    }
                })
                ->addColumn('Masters', function ($row) {
                    if ($row->education_masters) {
                        return '<b>Exam-</b>' . @$row->education_masters->examination . '<br> <b>Duration-</b>' . @$row->education_masters->duration . '<br> <b>Result-</b>' . @$row->education_masters->result . '<br> <b>Subject-</b>' . @$row->education_masters->subject . '<br> <b>Year-</b>' . @$row->education_masters->passing_year . '<br> <b>Institute-</b>' . @$row->education_masters->institute;
                    } else {
                        return '<b>N/A</b>';
                    }
                })
                ->rawColumns(['action', 'presentAddress', 'permanentAddress', 'job_details', 'attached_job_details', 'grade', 'JSC', 'SSC', 'HSC', 'Graduation', 'Masters'])
                ->toJson();
        }

        return view('admin.employee.search', $data);
    }

    public function exportDynamic(Request $request)
    {
        $employees = Employee::with('presentAddress', 'parmanentAddress', 'designation', 'jobGrade', 'jobStation', 'jobDivision', 'jobDistrict', 'jobUpazila', 'attachedDesignation', 'attachedStation', 'attachedDivision', 'attachedDistrict', 'attachedUpazila');

        $flag = 0;
        $count = 0;

        $data = [
            'columns' => Schema::getColumnListing('employees'),
            'batch' => Batch::all(),
            'designations' => Designation::query()->where('status', 'active')->orderBy('en_name')->get(),
            'grades' => Grade::query()->where('status', 'active')->orderBy('grade')->get(),
            'quotas' => Quota::query()->where('status', 'active')->orderBy('name')->get(),
            'countries' => Country::query()->orderBy('name', 'ASC')->orderBy('name')->get(),
            'stations' => Station::query()->where('status', 'active')->orderBy('name')->get(),
            'offices' => Office::query()->where('status', 'active')->orderBy('office')->get(),
            'relationships' => Relationship::all(),
            'employees' => $employees->get(),
            'awards' => Award::query()->orderBy('award_name')->get(),
            'achievements' => Achievement::query()->orderBy('achievement_name')->get(),
            'foreign_trainings' => ForeignTraining::query()->orderBy('course_title')->get(),
            'local_trainings' => LocalTraining::query()->orderBy('course_title')->get(),
            'inhouse_trainings' => InhouseTraining::query()->orderBy('course_title')->get(),
            'punishments' => Punishment::query()->orderBy('name')->get(),
            'leaves' => Leave::query()->orderBy('name')->get(),

            'jsc_examinations' => Examination::query()->where('type', 'JSC')->orderBy('name')->get(),
            'jsc_boards' => Board::query()->where('type', 'JSC')->orderBy('name')->get(),

            'ssc_examinations' => Examination::query()->where('type', 'SSC')->orderBy('name')->get(),
            'ssc_boards' => Board::query()->where('type', 'SSC')->orderBy('name')->get(),
            'ssc_subjects' => Subject::query()->where('type', 'SSC')->orderBy('name')->get(),

            'hsc_examinations' => Examination::query()->where('type', 'HSC')->orderBy('name')->get(),
            'hsc_boards' => Board::query()->where('type', 'HSC')->orderBy('name')->get(),
            'hsc_subjects' => Subject::query()->where('type', 'HSC')->orderBy('name')->get(),

            'graduation_examinations' => Examination::query()->where('type', 'Graduation')->orderBy('name')->get(),
            'graduation_institutes' => Institute::query()->where('type', 'Graduation')->orderBy('name')->get(),
            'graduation_subjects' => Subject::query()->where('type', 'Graduation')->orderBy('name')->get(),

            'masters_examinations' => Examination::query()->where('type', 'Masters')->orderBy('name')->get(),
            'masters_institutes' => Institute::query()->where('type', 'Masters')->orderBy('name')->get(),
            'masters_subjects' => Subject::query()->where('type', 'Masters')->orderBy('name')->get(),

            'divisions' => Division::query()->orderBy('name')->get(),
            'districts' => District::query()->orderBy('name')->get(),
            'thanas' => Upazila::query()->orderBy('name')->get(),

        ];

        if (\request()->ajax()) {

            if (!empty($request->query())) {
                $count = count($request->query());
                foreach ($request->query() as $key => $value) {
                    if (explode('_', $key)[0] == 'form') {
                        $key = explode('_', $key, 2)[1];
                        if (!empty($value) && $key != 'dynamic_criteria' && !in_array('field', explode('_', $key))) {
                            if (Schema::connection("mysql")->hasColumn('employees', $key)) {
                                if (request('form_' . $key . '_select') == '!=') {
                                    $employees->where($key, '!=', $value);
                                } else {
                                    if (explode('_', $key)[count(explode('_', $key)) - 1] == 'date') {
                                        $date = Carbon::parse($value)->format('Y-m-d');
                                        $employees = $employees->where(explode('_', $key)[0] . '_date', $date);
                                    } else {
                                        $employees->where($key, $value);
                                    }
                                }
                            } else if ($key == 'birth_date') {
                                $date = Carbon::parse($value)->format('Y-m-d');
                                $employees = $employees->where('dob', $date);
                            } else {
                                if (!($value == '==' || $value == '!=')) {
                                    if (array_key_exists('form_' . $key . '_field', $request->query())) {
                                        $model_and_column = explode('-', request('form_' . $key . '_field'));
                                        $model_name = 'App\Models\\' . $model_and_column[0];
                                        $model = $model_name::query()->where($model_and_column[1], $value)->first();
                                        $employees = $employees->where($model_and_column[2], $model->id ?? '');
                                    } else {
                                        if (array_key_exists('form_' . $key . '_select', $request->query())) {
                                            if (explode('_', $key)[0] == 'spouse') {
                                                $employees = $employees->whereHas('spouses', function ($query) use ($key, $value) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('spouses.' . explode('_', $key, 2)[1], $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('spouses.' . explode('_', $key, 2)[1], '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key)[0] == 'present') {
                                                $column = explode('_', $key, 3)[2];
                                                $employees = $employees->whereHas('presentAddress', function ($query) use ($key, $value, $column) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('present_addresses.' . $column, $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('present_addresses.' . $column, '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key)[0] == 'parmanent') {
                                                $column = explode('_', $key, 3)[2];
                                                $employees = $employees->whereHas('parmanentAddress', function ($query) use ($key, $value, $column) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('parmanent_addresses.' . $column, $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('parmanent_addresses.' . $column, '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key)[count(explode('_', $key)) - 1] == 'id') {
                                                $employees = $employees->whereHas(explode('_id', $key)[0] . 's', function ($query) use ($key, $value) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where(explode('_id', $key)[0] . 's.id', $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where(explode('_id', $key)[0] . 's.id', '!=', $value);
                                                    }
                                                });
                                            } elseif (
                                                explode('_', $key, 2)[0] == 'jsc' ||
                                                explode('_', $key, 2)[0] == 'ssc' ||
                                                explode('_', $key, 2)[0] == 'hsc' ||
                                                explode('_', $key, 2)[0] == 'graduation' ||
                                                explode('_', $key, 2)[0] == 'masters'
                                            ) {
                                                $employees = $employees->whereHas('education_' . explode('_', $key, 2)[0], function ($query) use ($key, $value) {
                                                    if (request('form_' . $key . '_select') == '==') {
                                                        $query->where('educational_qualifications.' . explode('_', $key, 2)[1], $value);
                                                    } else if (request('form_' . $key . '_select') == '!=') {
                                                        $query->where('educational_qualifications.' . explode('_', $key, 2)[1], '!=', $value);
                                                    }
                                                });
                                            } elseif (explode('_', $key, 2)[0] == 'professional') {
                                                if (explode('_', $key, 2)[1] == 'to_date' || explode('_', $key, 2)[1] == 'from_date') {
                                                    $date = Carbon::parse($value)->format('Y-m-d');
                                                    $employees = $employees->whereHas('education_professional', function ($query) use ($key, $date) {
                                                        if (request('form_' . $key . '_select') == '==') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], $date);
                                                        } else if (request('form_' . $key . '_select') == '!=') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], '!=', $date);
                                                        }
                                                    });
                                                } else {
                                                    $employees = $employees->whereHas('education_professional', function ($query) use ($key, $value) {
                                                        if (request('form_' . $key . '_select') == '==') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], $value);
                                                        } else if (request('form_' . $key . '_select') == '!=') {
                                                            $query->where('professional_experiences.' . explode('_', $key, 2)[1], '!=', $value);
                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if (request('form_' . $key . '_select'))
                                $flag++;
                        } else {
                            $flag++;
                        }
                    }

                }
            }

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('admin.employee.action-button', compact('row'));
                })
                ->addColumn('presentAddress', function ($row) {
                    return '<b>Division:</b> ' . @$row->presentAddress->division->name . '<br>'
                        . '<b>District:</b> ' . @$row->presentAddress->district->name . '<br>'
                        . '<b>Upazila: </b>' . @$row->presentAddress->upazila->name . '<br>'
                        . '<b>Post-Office:</b> ' . @$row->presentAddress->post_office . '<br>'
                        . '<b>Postal-Code:</b> ' . @$row->presentAddress->postal_code . '<br>'
                        . '<b>Village: </b>' . @$row->presentAddress->area . '<br>'
                        . '<b>Union: </b>' . @$row->presentAddress->u_c_c_w . '<br>'
                        . '<b>House-No:</b> ' . @$row->presentAddress->house_no;
                })
                ->addColumn('permanentAddress', function ($row) {
                    return '<b>Division:</b> ' . @$row->parmanentAddress->division->name . '<br>'
                        . '<b>District:</b> ' . @$row->parmanentAddress->district->name . '<br>'
                        . '<b>Upazila:</b> ' . @$row->parmanentAddress->upazila->name . '<br>'
                        . '<b>Post-Office:</b> ' . @$row->parmanentAddress->post_office . '<br>'
                        . '<b>Postal-Code:</b> ' . @$row->parmanentAddress->postal_code . '<br>'
                        . '<b>Village:</b> ' . @$row->parmanentAddress->area . '<br>'
                        . '<b>Union:</b> ' . @$row->parmanentAddress->u_c_c_w . '<br>'
                        . '<b>House-No:</b> ' . @$row->parmanentAddress->house_no;
                })
                ->addColumn('grade', function ($row) {
                    return @$row->jobGrade->grade;
                })
                ->addColumn('job_details', function ($row) {
                    return '<b>Designation:</b> ' . @$row->designation->en_name . '<br>'
                        . '<b>Office/Station:</b> ' . @$row->jobStation->name . '<br>'
                        . '<b>Office/Station Division:</b> ' . @$row->jobDivision->name . '<br>'
                        . '<b>Office/Station District:</b> ' . @$row->jobDistrict->name . '<br>'
                        . '<b>Office/Station Upazila:</b> ' . @$row->jobUpazila->name;
                })
                ->addColumn('attached_job_details', function ($row) {
                    return '<b>Attached Designation:</b> ' . @$row->designation->en_name . '<br>'
                        . '<b>Attached Office/Station:</b> ' . @$row->jobStation->name . '<br>'
                        . '<b>Attached Office/Station Division:</b> ' . @$row->jobDivision->name . '<br>'
                        . '<b>Attached Office/Station District:</b> ' . @$row->jobDistrict->name . '<br>'
                        . '<b>Attached Office/Station Upazila:</b> ' . @$row->jobUpazila->name;
                })
                ->addColumn('JSC', function ($row) {
                    return '<b>Exam-</b>' . @$row->education_jsc->examination . '<br> <b>Board-</b>' . @$row->education_jsc->board . '<br> <b>Roll-</b>' . @$row->education_jsc->roll . '<br><b>Result-</b>' . @$row->education_jsc->result . '<br><b>Passing Year-</b>' . @$row->education_jsc->passing_year . '<br> <b>Institute-</b>' . @$row->education_jsc->isntitute;
                })
                ->addColumn('SSC', function ($row) {
                    return '<b>Exam-</b>' . @$row->education_ssc->examination . '<br> <b>Board-</b>' . @$row->education_ssc->board . '<br> <b>Roll-</b>' . @$row->education_ssc->roll . '<br><b>Result-</b>' . @$row->education_ssc->result . '<br> <b>Subject-</b>' . @$row->education_ssc->subject . '<br><b>Passing Year-</b>' . @$row->education_ssc->passing_year . '<br> <b>Institute-</b>' . @$row->education_ssc->isntitute;
                })
                ->addColumn('HSC', function ($row) {
                    return '<b>Exam-</b>' . @$row->education_hsc->examination . '<br> <b>Board-</b>' . @$row->education_hsc->board . '<br> <b>Roll-</b>' . @$row->education_hsc->roll . '<br><b>Result-</b>' . @$row->education_hsc->result . '<br> <b>Subject-</b>' . @$row->education_hsc->subject . '<br><b>Passing Year-</b>' . @$row->education_hsc->passing_year . '<br> <b>Institute-</b>' . @$row->education_hsc->isntitute;
                })
                ->addColumn('Graduation', function ($row) {
                    return '<b>Exam-</b>' . @$row->education_grad->examination . '<br> <b>Duration-</b>' . @$row->education_grad->duration . '<br> <b>Result-</b>' . @$row->education_grad->result . '<br> <b>Subject-</b>' . @$row->education_grad->subject . '<br> <b>Year-</b>' . @$row->education_grad->passing_year . '<br> <b>Institute-</b>' . @$row->education_grad->institute;
                })
                ->addColumn('Masters', function ($row) {
                    return '<b>Exam-</b>' . @$row->education_masters->examination . '<br> <b>Duration-</b>' . @$row->education_masters->duration . '<br> <b>Result-</b>' . @$row->education_masters->result . '<br> <b>Subject-</b>' . @$row->education_masters->subject . '<br> <b>Year-</b>' . @$row->education_masters->passing_year . '<br> <b>Institute-</b>' . @$row->education_masters->institute;
                })
                ->rawColumns(['action', 'presentAddress', 'permanentAddress', 'job_details', 'attached_job_details', 'grade', 'JSC', 'SSC', 'HSC', 'Graduation', 'Masters'])
                ->toJson();
        }

        return view('admin.employee.export_dynamic', $data);
    }

    public function getNominees($id)
    {
        $nominees = Employee::find($id)->nominees;
        return $nominees;
    }

    public function export_excel()
    {
        return Excel::download(new EmployeesExport(), 'employees.xlsx');
    }

    public function export_excel_dynamic(Request $request)
    {
        $fields = [];
        $employees = Employee::query();
        if (!empty($request->except('_token', 'dynamic_criteria'))) {
            foreach ($request->except('_token', 'dynamic_criteria') as $key => $value) {
                if (!empty($value) && !in_array('field', explode('_', $key))) {
                    if (Schema::connection("mysql")->hasColumn('employees', $key)) {
                        if (request($key . '_select') == '!=') {
                            $employees->where($key, '!=', $value);
                        } else {
                            if (explode('_', $key)[count(explode('_', $key)) - 1] == 'date') {
                                $date = Carbon::parse($value)->format('Y-m-d');
                                $employees = $employees->where(explode('_', $key)[0] . '_date', $date);
                            } else {
                                $employees->where($key, $value);
                            }
                        }
                    } else if ($key == 'birth_date') {
                        $date = Carbon::parse($value)->format('Y-m-d');
                        $employees = $employees->where('dob', $date);
                    } else {
                        if (!($value == '==' || $value == '!=')) {
                            if (array_key_exists($key . '_field', $request->query())) {
                                $model_and_column = explode('-', request($key . '_field'));
                                $model_name = 'App\Models\\' . $model_and_column[0];
                                $model = $model_name::query()->where($model_and_column[1], $value)->first();
                                $employees = $employees->where($model_and_column[2], $model->id ?? '');
                            } else {
                                if (array_key_exists($key . '_select', $request->query())) {
                                    if (explode('_', $key)[0] == 'spouse') {
                                        $employees = $employees->whereHas('spouses', function ($query) use ($key, $value) {
                                            if (request($key . '_select') == '==') {
                                                $query->where('spouses.' . explode('_', $key, 2)[1], $value);
                                            } else if (request($key . '_select') == '!=') {
                                                $query->where('spouses.' . explode('_', $key, 2)[1], '!=', $value);
                                            }
                                        });
                                    } elseif (explode('_', $key)[0] == 'present') {
                                        $column = explode('_', $key, 3)[2];
                                        $employees = $employees->whereHas('presentAddress', function ($query) use ($key, $value, $column) {
                                            if (request($key . '_select') == '==') {
                                                $query->where('present_addresses.' . $column, $value);
                                            } else if (request($key . '_select') == '!=') {
                                                $query->where('present_addresses.' . $column, '!=', $value);
                                            }
                                        });
                                    } elseif (explode('_', $key)[0] == 'parmanent') {
                                        $column = explode('_', $key, 3)[2];
                                        $employees = $employees->whereHas('parmanentAddress', function ($query) use ($key, $value, $column) {
                                            if (request($key . '_select') == '==') {
                                                $query->where('parmanent_addresses.' . $column, $value);
                                            } else if (request($key . '_select') == '!=') {
                                                $query->where('parmanent_addresses.' . $column, '!=', $value);
                                            }
                                        });
                                    } elseif (explode('_', $key)[count(explode('_', $key)) - 1] == 'id') {
                                        $employees = $employees->whereHas(explode('_id', $key)[0] . 's', function ($query) use ($key, $value) {
                                            if (request($key . '_select') == '==') {
                                                $query->where(explode('_id', $key)[0] . 's.id', $value);
                                            } else if (request($key . '_select') == '!=') {
                                                $query->where(explode('_id', $key)[0] . 's.id', '!=', $value);
                                            }
                                        });
                                    } elseif (
                                        explode('_', $key, 2)[0] == 'jsc' ||
                                        explode('_', $key, 2)[0] == 'ssc' ||
                                        explode('_', $key, 2)[0] == 'hsc' ||
                                        explode('_', $key, 2)[0] == 'graduation' ||
                                        explode('_', $key, 2)[0] == 'masters'
                                    ) {
                                        $employees = $employees->whereHas('education_' . explode('_', $key, 2)[0], function ($query) use ($key, $value) {
                                            if (request($key . '_select') == '==') {
                                                $query->where('educational_qualifications.' . explode('_', $key, 2)[1], $value);
                                            } else if (request($key . '_select') == '!=') {
                                                $query->where('educational_qualifications.' . explode('_', $key, 2)[1], '!=', $value);
                                            }
                                        });
                                    } elseif (explode('_', $key, 2)[0] == 'professional') {
                                        if (explode('_', $key, 2)[1] == 'to_date' || explode('_', $key, 2)[1] == 'from_date') {
                                            $date = Carbon::parse($value)->format('Y-m-d');
                                            $employees = $employees->whereHas('education_professional', function ($query) use ($key, $date) {
                                                if (request($key . '_select') == '==') {
                                                    $query->where('professional_experiences.' . explode('_', $key, 2)[1], $date);
                                                } else if (request($key . '_select') == '!=') {
                                                    $query->where('professional_experiences.' . explode('_', $key, 2)[1], '!=', $date);
                                                }
                                            });
                                        } else {
                                            $employees = $employees->whereHas('education_professional', function ($query) use ($key, $value) {
                                                if (request($key . '_select') == '==') {
                                                    $query->where('professional_experiences.' . explode('_', $key, 2)[1], $value);
                                                } else if (request($key . '_select') == '!=') {
                                                    $query->where('professional_experiences.' . explode('_', $key, 2)[1], '!=', $value);
                                                }
                                            });
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $parameters = [
            'query' => $employees
        ];

        return Excel::download(new EmployeesExportDynamic($parameters), 'employees_dynamic.xlsx');

    }

    public function getEmployees(Request $request)
    {
        if ($request->token === config('auth.api_token_for_fscd_id')) {
            $employees = Employee::all();

            foreach ($employees as $key => $employee) {
                $data[$key]['Name'] = $employee->name;
                $data[$key]['OptionalName'] = '';
                $data[$key]['PnNumber'] = $employee->pin_no;
                $data[$key]['PnType'] = '';
                $data[$key]['Letter'] = $employee->designation->short_name ?? '';
                $data[$key]['Rank'] = '';
                $data[$key]['IdNo'] = $employee->id_card_no;
                $data[$key]['SignaturePath'] = '';
                $data[$key]['BloodGroup'] = $employee->blood_group;
                $data[$key]['PassportPhoto'] = '';
                $data[$key]['HolderSignature'] = '';
            }

            return $data;
        } else {
            return response()->json([
                'message' => 'Unauthorized Access!',
            ]);
        }
    }

    public function getEmployeeNamePin(Request $request)
    {
        if ($request->token == config('auth.api_token_for_fscd_id')) {
            $employees = Employee::all();

            foreach ($employees as $key => $employee) {
                $data[$key]['Name'] = $employee->name;
                $data[$key]['OptionalName'] = '';
                $data[$key]['PnNumber'] = $employee->pin_no;
                $data[$key]['PnType'] = '';
                $data[$key]['Letter'] = '';
                $data[$key]['Rank'] = '';
                $data[$key]['IdNo'] = '';
                $data[$key]['SignaturePath'] = '';
                $data[$key]['BloodGroup'] = '';
                $data[$key]['PassportPhoto'] = '';
                $data[$key]['HolderSignature'] = '';
            }

            return $data;
        } else {
            return response()->json([
                'message' => 'Unauthorized Access',
            ]);
        }
    }

    public function getEmployeesForWorkshop(Request $request)
    {
        if ($request->token === config('auth.api_token_for_workshop')) {
            return Employee::query()
                ->with('designation')
                ->with('jobStation')
                ->with('presentAddress')
                ->with('parmanentAddress')
                ->with('jobDivision')
                ->with('jobDistrict')
                ->with('jobUpazila')
                ->where('pin_no', $request->pin)
                ->orWhere('new_pin', $request->pin)
                ->firstOrFail();
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    //api for SAFER projects
    public function getEmployeeWithOldPinForSafer(Request $request)
    {
        if ($request->token === config('auth.api_token_for_safer')) {
            $employee = Employee::query()
                ->with('designation')
                ->with('jobStation')
                ->with('presentAddress')
                ->with('parmanentAddress')
                ->with('jobDivision')
                ->with('jobDistrict')
                ->with('jobUpazila')
                ->where('pin_no', $request->old_pin)
                ->first();
            $employee['new_pin'] = strval($employee['new_pin']);
            if ($employee != null) {
                return $employee;
            } elseif ($employee == null) {
                return response()->json([
                    'message' => "Please Enter a valid PIN. Your given PIN doesn't match our records.",
                    'error' => '204',
                ]);
            }
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }
    public function getEmployeeWithNewPinForSafer(Request $request)
    {
        if ($request->token === config('auth.api_token_for_safer')) {
            $employee = Employee::query()
                ->with('designation')
                ->with('jobStation')
                ->with('presentAddress')
                ->with('parmanentAddress')
                ->with('jobDivision')
                ->with('jobDistrict')
                ->with('jobUpazila')
                ->where('new_pin', $request->new_pin)
                ->first();
            $employee['new_pin'] = strval($employee['new_pin']);
            if ($employee != null) {
                return $employee;
            } elseif ($employee == null) {
                return response()->json([
                    'message' => "Please Enter a valid PIN. Your given PIN doesn't match our records.",
                    'error' => '204',
                ]);
            }
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    public function getEmployeeImageForWorkshop(Request $request)
    {
        if ($request->token == config('auth.api_token_for_workshop')) {
            $image_url = $request->img_url;
            $type = pathinfo($image_url, PATHINFO_EXTENSION);
            $data = file_get_contents(public_path() . '/assets/employee/' . $image_url);
            $value['base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $value;
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    public function getEmployeeSignatureForWorkshop(Request $request)
    {
        if ($request->token == config('auth.api_token_for_workshop')) {
            $signature_url = $request->signature_url;
            $type = pathinfo($signature_url, PATHINFO_EXTENSION);
            $data = file_get_contents(public_path() . '/assets/employee/signatures/' . $signature_url);
            $value['base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $value;
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    public function getEmployeesForOneStop(Request $request)
    {
        if ($request->token === config('auth.api_token_for_one_stop')) {
            return Employee::query()
                ->with('designation')
                ->with('jobStation')
                ->with('presentAddress')
                ->with('parmanentAddress')
                ->with('jobDivision')
                ->with('jobDistrict')
                ->with('jobUpazila')
                ->with('jobUpazila')
                ->with('highest_education')
                ->where('pin_no', $request->pin)
                ->orWhere('new_pin', $request->pin)
                ->firstOrFail();
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    public function getEmployeeImageForOneStop(Request $request)
    {
        if ($request->token == config('auth.api_token_for_one_stop')) {
            $image_url = $request->img_url;
            $type = pathinfo($image_url, PATHINFO_EXTENSION);
            $data = file_get_contents(public_path() . '/assets/employee/' . $image_url);
            $value['base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $value;
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    public function getEmployeeSignatureForOneStop(Request $request)
    {
        if ($request->token == config('auth.api_token_for_one_stop')) {
            $signature_url = $request->signature_url;
            $type = pathinfo($signature_url, PATHINFO_EXTENSION);
            $data = file_get_contents(public_path() . '/assets/employee/signatures/' . $signature_url);
            $value['base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $value;
        } else {
            return response()->json([
                'error' => '401',
                'status' => 'Unauthorized Access!',
                'message' => 'Please check for authorized TOKEN!',
            ]);
        }
    }

    public function assign($id)
    {
        $data = [];
        $data['employee'] = Employee::query()->findOrFail($id);
        $data['leaves'] = Leave::all();
        $data['countries'] = Country::all();
        $data['foreign_trainings'] = ForeignTraining::all();
        $data['local_trainings'] = LocalTraining::all();
        $data['inhouse_trainings'] = InhouseTraining::all();
        $data['grades'] = Grade::query()->where('status', 'active')->orderBy('grade', 'asc')->get();
        $data['designations'] = Designation::query()->where('status', 'active')->orderBy('en_name', 'asc')->get();
        $data['stations'] = Station::query()->where('status', 'active')->orderBy('name', 'asc')->get();
        $data['posting_types'] = collect(PostingRecord::posting_types());

        return view('admin.employee.assign', $data);
    }

    public function correct_interval_values()
    {
        try {
            foreach (Employee::all() as $employee) {
                $employee->update([
                    'age' => $this->age($employee->dob),
                ]);

                $latest_posting = $employee->posting_records()->latest()->first();
                if ($latest_posting != null) {
                    $latest_posting->update([
                        'duration' => $this->age($latest_posting->from_date),
                    ]);
                }
            }
            Log::stack(['single', 'daily'])->info('Age corrected!');
        } catch (\Exception $e) {
            Log::stack(['single', 'daily'])->error('Age correction error!');
        }
    }

    public function latestPromotionLists()
    {

        // $employeesWithSalaryHistories = SalaryHistory::whereIn('id', function ($query) {
        //     $query->select(DB::raw('MAX(id)'))
        //           ->from('salary_histories')
        //           ->groupBy('employee_id');
        //     })
        //     ->with(['employee' => function ($query) {
        //         // Load employee along with designation and monthly_grade
        //         $query->withTrashed()
        //               ->select('id', 'name', 'pin_no', 'join_date', 'designation_id')
        //               ->with([
        //                 'designation:id,en_name',
        //                 'monthly_grade:id,grade_id,basic_salary,overtime_salary'
        //             ]);
        //     }])
        // ->get();

        $employeesWithSalaryHistories = DB::table('salary_histories')
            ->whereIn('salary_histories.id', function ($query) {
                $query->select(DB::raw('MAX(salary_histories.id)')) // Specify the table name here
                    ->from('salary_histories')
                    ->groupBy('employee_id');
            })
            ->join('employees', 'salary_histories.employee_id', '=', 'employees.id')
            ->leftJoin('salary_template', 'employees.grade_id', '=', 'salary_template.grade_id')
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->select(
                'salary_histories.*',
                'employees.name',
                'employees.pin_no',
                'employees.join_date',
                'designations.en_name',
                'salary_template.grade_id',
                'salary_template.basic_salary',
                'salary_template.overtime_salary'
            )
            ->get();

        if (request()->ajax()) {
            return DataTables::of($employeesWithSalaryHistories)
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.promotion.index');

    }

}
