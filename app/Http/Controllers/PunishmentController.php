<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Action;
use App\Models\Station;
use App\Models\Employee;
use App\Models\Punishment;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PostingRecord;
use App\Models\PunishmentEmployee;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Storage;
use Yajra\DataTables\Facades\DataTables;

class PunishmentController extends Controller
{

    public function Specific_Employee_Punishment()
    {
        $a_employee_punishments_lists = Employee::with('punishments')->where('pin_no', request()->employee_id)->first();
        return response()->json($a_employee_punishments_lists);
    }

    public function all()
    {
        $punishments = Punishment::all();
        return response()->json($punishments);
    }
    public function financialPunishTypes()
    {
        $financialPunishTypes = financialPunishmentType();
        return response()->json($financialPunishTypes);
    }
    public function punishmentList()
    {
        $punishmentEmployees = PunishmentEmployee::orderBy('created_at', 'desc')->get();
        $punishmentData = $punishmentEmployees->map(function($punishmentEmployee) {
            $punishTypeArr = financialPunishmentType()->toArray();
            // logger($punishmentEmployee->fine_amount);
            $punishName = array_key_exists($punishmentEmployee->financial_punishment_type, $punishTypeArr) ? $punishTypeArr[$punishmentEmployee->financial_punishment_type] : '';
            return [
                'pin_no' => $punishmentEmployee->employee->pin_no??null,
                'name' => $punishmentEmployee->employee->name??null,
                'duration' => $punishmentEmployee->duration??null,
                'description' => $punishmentEmployee->description??null,
                'date' => $punishmentEmployee->created_at->format('Y-m-d')??null,
                'punishment_title' => $punishmentEmployee->punishment->name??null,
                'offence' => $punishmentEmployee->punishment->offence??null,
                'show_cause' => $punishmentEmployee->show_cause === 1 ? 'Yes' : 'No',
                'financial_punishment_type' => $punishmentEmployee->financial_punishment_type === 1 ? $punishName.'('.$punishmentEmployee->fine_amount.')' : $punishName,
                'fine_amount' => $punishmentEmployee->fine_amount??null,
            ];
        });

        
        
        if (request()->ajax()) {
            return DataTables::of($punishmentData)
                ->addIndexColumn()
                ->toJson();
        }
    }

    public function punishment_store(Request $request)
    {

        $employee_to_punish = Employee::findOrFail($request->employee_id);

        if($request->action_type == 6 && $request->extend_date != null){
            
            $extendDays = Carbon::parse($employee_to_punish->tentative_date)->diffInDays(Carbon::parse($request->extend_date));

            if ($employee_to_punish->extend_date) {
                $new_extended_date = Carbon::parse($employee_to_punish->extend_date)->addDays($extendDays)->format('Y-m-d');
            } else {
                $new_extended_date = $request->extend_date;
            }
            
            $new_tentative_date = Carbon::parse($employee_to_punish->tentative_date)->addDays($extendDays)->format('Y-m-d');

            if ($employee_to_punish->actual_confirmation_date) {
                $actualConfirmDays = Carbon::parse($employee_to_punish->actual_confirmation_date)->diffInDays(Carbon::parse($request->extend_date));
                $actual_confirm_date = Carbon::parse($employee_to_punish->actual_confirmation_date)->addDays($actualConfirmDays)->format('Y-m-d');
            } else {
                if ($employee_to_punish->extend_date) {
                    $new_extended_actual_date = Carbon::parse($employee_to_punish->extend_date)->addDays($extendDays)->format('Y-m-d');
                }else {
                    $new_extended_actual_date = $request->extend_date;
                }
                // $actualConfirmDays = Carbon::parse($new_extended_date)->diffInDays(Carbon::parse($request->extend_date));
                $actual_confirm_date = $new_extended_actual_date;
            }

            $employee_to_punish->update([
                'extend_date' => $new_extended_date,
                'tentative_date' => $new_tentative_date,
                'actual_confirmation_date' => $actual_confirm_date,
            ]);

            $employee_to_punish->punishments()->attach($request->action_type, 
                [
                    'from_date'=> $request->effective_date, 
                    'description' => $request->action_reason, 
                    'duration' => $request->extend_date,
                    'show_cause' => 0,
                    'financial_punishment_type' => 0,
                    'fine_amount' => 0,
                ]
            );
            return redirect()->route('employee.punishment');

        }

        $employee_to_punish->punishments()->attach($request->action_type, 
            [
                'from_date'=> $request->effective_date,
                'description' => $request->action_reason,
                'duration' => $request->extend_date,
                'show_cause' => $request->has('show_cause') ? 1 : 0,
                'financial_punishment_type' => $request->financial_puhishment_type?? 0,
                'fine_amount' => $request->fine_amount?? 0,
            ]
        );
        return redirect()->route('employee.punishment');


        // if ($request->extension_month != null) {
        //     $new_extension_month = $request->extension_month + $employee_to_punish->extend_date;
        //     $new_tentative_date = Carbon::parse($employee_to_punish->tentative_date)->addMonth($new_extension_month)->format('Y-m-d');
        //     $actual_confirm_date = Carbon::parse($employee_to_punish->actual_confirmation_date)->addMonth($new_extension_month)->format('Y-m-d');
        //     $employee_to_punish->update([
        //         'extend_date' => $new_extension_month,
        //         'tentative_date' => $new_tentative_date,
        //         'actual_confirmation_date' => $actual_confirm_date,
        //     ]);
        //     $employee_to_punish->punishments()->attach($request->action_type, ['description' => $request->action_reason, 'duration' => $request->extension_month]);
        //     return redirect()->route('employee.punishment');
        // }
        // $employee_to_punish->punishments()->attach($request->action_type, ['description' => $request->action_reason]);
        // return redirect()->route('employee.punishment');
    }

    public function punish()
    {
        // Storage::delete('pin_no');
        $designations = Designation::where('status', 'active')->orderBy('en_name', 'ASC')->get();
        $stations = Station::where('status', 'active')->orderBy('name', 'ASC')->get();
        $grades = Grade::where('status', 'active')->orderBy('grade', 'ASC')->get();
        $posting_types = collect(PostingRecord::posting_types());
        return view('admin.punishment.punish', compact('stations', 'designations', 'grades', 'posting_types'));
    }
    public function index()
    {
        $punishments = Punishment::with('employees')->latest()->get();
        $punishment_employees = PunishmentEmployee::query()->with('employee', 'punishment')->where('status', 'active')->latest();

        if (\request()->ajax()) {
            return DataTables::of($punishment_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row) {
                    $route = route('employee.show', $row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="' . $route . '" data-toggle="tooltip" title="Employee Show">' . $name . '</a>';
                    return $employee;
                })
                ->filterColumn('employee_name', function ($query, $keyword) {
                    $employee_ids = Employee::query()->where('name', 'LIKE', "%{$keyword}%")->pluck('id');
                    $query->whereIn('employee_id', $employee_ids);
                })
                ->addColumn('punishment_name', function ($row) {
                    $route = route('punishment.show', $row->punishment->id);
                    $name = $row->punishment->name ?? '';
                    $punishment = '<a class="text-success alert-link" href="' . $route . '" data-toggle="tooltip" title="Leave Show">' . $name . '</a>';
                    return $punishment;
                })
                ->filterColumn('punishment_name', function ($query, $keyword) {
                    $punishment_ids = Punishment::query()->where('name', 'LIKE', "%{$keyword}%")->pluck('id');
                    $query->whereIn('punishment_id', $punishment_ids);
                })
                ->addColumn('date_of_punishment', function ($row) {
                    return @$row->created_at ? \Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y h:i:s A') : '';
                })
                ->addColumn('action', function ($row) {
                    return view('admin.punishment.action-button', compact('row'));
                })
                ->rawColumns(['employee_name', 'punishment_name', 'action'])
                ->toJson();
        }

        return view('admin.punishment.index', compact('punishments', 'punishment_employees'));
    }

    public function create()
    {
        return view('admin.punishment.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $punishment = new Punishment();
        $punishment->fill($request->except('_token'));
        $punishment->save();

        Toastr::success('Punishment Created Successfully!', 'Success');
        return redirect()->route('punishment.index');
    }

    public function show(Punishment $punishment)
    {
        $punishment = Punishment::with('approvedEmployees')->find($punishment->id);
        $punishment_employees = PunishmentEmployee::query()
            ->with('employee', 'punishment')
            ->where('punishment_id', $punishment->id)
            ->where('status', 'active')
            ->latest();

        if (\request()->ajax()) {
            return DataTables::of($punishment_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row) {
                    $route = route('employee.show', $row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="' . $route . '" data-toggle="tooltip" title="Employee Show">' . $name . '</a>';
                    return $employee;
                })
                ->addColumn('punishment_name', function ($row) {
                    $route = route('punishment.show', $row->punishment->id);
                    $name = $row->punishment->name ?? '';
                    $punishment = '<a class="text-success alert-link" href="' . $route . '" data-toggle="tooltip" title="Leave Show">' . $name . '</a>';
                    return $punishment;
                })
                ->addColumn('date_of_punishment', function ($row) {
                    return @$row->created_at ? \Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y h:i:s A') : '';
                })
                ->addColumn('action', function ($row) {
                    return view('admin.punishment.action-button', compact('row'));
                })
                ->rawColumns(['employee_name', 'punishment_name', 'action'])
                ->toJson();
        }
        return view('admin.punishment.view', compact('punishment', 'punishment_employees'));
    }

    public function punishmentDeletedShow($id)
    {
        $punishment = Punishment::onlyTrashed()->with('approvedEmployees')->find($id);
        $punishment_employees = PunishmentEmployee::query()
            ->with('employee', 'punishment')
            ->where('punishment_id', $punishment->id)
            ->where('status', 'active')
            ->latest();
        if (\request()->ajax()) {
            return DataTables::of($punishment_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row) {
                    return @$row->employee->name;
                })
                ->addColumn('date_of_punishment', function ($row) {
                    return @$row->created_at ? \Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y h:i:s A') : '';
                })
                ->addColumn('action', function ($row) {
                    $route = route('remove-employee-from-punishment', [$row->id]);
                    $name = $row->employee->name ?? '';
                    $action = '<form method="POST" action="' . $route . '" class="">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button data-name="' . $name . '" type="submit" class="btn btn-sm btn-danger delete-confirm" data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i>
                                    </button>
                                </form>';
                    return $action;
                })
                ->rawColumns(['employee_name', 'action'])
                ->toJson();
        }
        return view('admin.punishment.deletedView', compact('punishment', 'punishment_employees'));
    }


    public function edit(Punishment $punishment)
    {
        $employees = Employee::all();
        return view('admin.punishment.edit', compact('punishment', 'employees'));
    }

    public function update(Request $request, Punishment $punishment)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $punishment->fill($request->except('_token'));

        $punishment->update();
        Toastr::success('Punishment Updated Successfully!', 'Success');
        return redirect()->route('punishment.index');
    }

    public function destroy(Punishment $punishment)
    {
        $punishment->delete();
        Toastr::success('Punishment Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('punishment.index');
    }
    public function getDeletedPunishment()
    {
        $punishment = Punishment::onlyTrashed()->get();
        return view('admin.punishment.deleted_punishment', compact('punishment'));
    }
    public function restore($id)
    {
        Punishment::withTrashed()->findOrFail($id)->restore();

        Toastr::success('Punishment Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('punishment.index');
    }
    public function permanentDelete($id)
    {
        Punishment::withTrashed()->findOrFail($id)->forceDelete();
        Toastr::success('Punishment Permanently Deleted!.');
        return redirect()->route('punishment.deleted');
    }

    public function getPunishmentEmployeeId()
    {
        $punishment_id = request()->punishment_id;
        $punishment = Punishment::findOrFail($punishment_id);
        $employees_id = $punishment->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($punishmentId)
    {
        $punishment = Punishment::findOrFail($punishmentId);
        $actions = Action::all();
        return view('admin.punishment.select-employee', compact('punishment', 'actions'));
    }

    public function setPunishment()
    {
        $punishment = Punishment::find(request('punishment_id'));
        $employee = Employee::findOrFail(request('employee_id'));
        $punishments = Punishment::all();
        return view('admin.punishment.set-punishment', compact('punishment', 'employee', 'punishments'));
    }

    public function addEmployeesToPunishment(Request $request)
    {
        $request->validate([
            "punishment_id" => 'required',

            'complaint_file' => 'nullable|mimes:doc,pdf,docx',
            'departmental_case_file' => 'nullable|mimes:doc,pdf,docx',
            'settlement_punishment_file' => 'nullable|mimes:doc,pdf,docx',
            'appeal_and_disposal_file' => 'nullable|mimes:doc,pdf,docx',
            'case_no_and_judgment_file' => 'nullable|mimes:doc,pdf,docx',
            'case_no_administrative_file' => 'nullable|mimes:doc,pdf,docx',
            'leave_to_memo_file' => 'nullable|mimes:doc,pdf,docx',
            'review_case_no_file' => 'nullable|mimes:doc,pdf,docx',
            'comments_file' => 'nullable|mimes:doc,pdf,docx',
            'punishment_notice_file' => 'nullable|mimes:doc,pdf,docx',
            'accused_reply_file' => 'nullable|mimes:doc,pdf,docx',
            'action_apply_file' => 'nullable|mimes:doc,pdf,docx',
            'disposal_verdict_file' => 'nullable|mimes:doc,pdf,docx',
            'additional_notes_file' => 'nullable|mimes:doc,pdf,docx',

            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        $generated_new_name = '';
        if ($request->file != null) {
            $upload_path = public_path('assets/punishment');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->file->move($upload_path, $generated_new_name);
        }

        $complaint_file = $request->file('complaint_file');
        $departmental_case_file = $request->file('departmental_case_file');
        $settlement_punishment_file = $request->file('settlement_punishment_file');
        $appeal_and_disposal_file = $request->file('appeal_and_disposal_file');
        $case_no_and_judgment_file = $request->file('case_no_and_judgment_file');
        $case_no_administrative_file = $request->file('case_no_administrative_file');
        $leave_to_memo_file = $request->file('leave_to_memo_file');
        $review_case_no_file = $request->file('review_case_no_file');
        $comments_file = $request->file('comments_file');
        $punishment_notice_file = $request->file('punishment_notice_file');
        $accused_reply_file = $request->file('accused_reply_file');
        $action_apply_file = $request->file('action_apply_file');
        $disposal_verdict_file = $request->file('disposal_verdict_file');
        $additional_notes_file = $request->file('additional_notes_file');

        $path = public_path() . '/assets/punishment/attachments/';

        foreach ($request->employees_ids as $value) {
            $em_punishment = new PunishmentEmployee();
            $em_punishment->employee_id = $value;
            $em_punishment->punishment_id = $request->punishment_id;
            $em_punishment->complaint_description = $request->complaint_description;
            $em_punishment->departmental_case_memo_no_date_and_section = $request->departmental_case_memo_no_date_and_section;
            $em_punishment->settlement_punishment_memo_date_and_description_of_punishment = $request->settlement_punishment_memo_date_and_description_of_punishment;
            $em_punishment->appeal_and_disposal_order_along_with_the_secretary = $request->appeal_and_disposal_order_along_with_the_secretary;
            $em_punishment->case_no_and_judgment_of_the_administrative_tribunal = $request->case_no_and_judgment_of_the_administrative_tribunal;
            $em_punishment->case_no_and_judgment_of_the_administrative_appeal_tribunal = $request->case_no_and_judgment_of_the_administrative_appeal_tribunal;
            $em_punishment->leave_to_memo_no_and_judgement = $request->leave_to_memo_no_and_judgement;
            $em_punishment->review_case_no_and_judgement = $request->review_case_no_and_judgement;
            $em_punishment->punishment_notice = $request->punishment_notice;
            $em_punishment->accused_reply = $request->accused_reply;
            $em_punishment->action_apply = $request->action_apply;
            $em_punishment->disposal_verdict = $request->disposal_verdict;
            $em_punishment->additional_notes = $request->additional_notes;
            $em_punishment->comments = $request->comments;

            if ($complaint_file) {
                $filename1 = @$complaint_file->getClientOriginalName();
                $complaint_file->move($path, $filename1);
                $em_punishment->complaint_file = $filename1;
            }
            if ($departmental_case_file) {
                $filename2 = @$departmental_case_file->getClientOriginalName();
                $departmental_case_file->move($path, $filename2);
                $em_punishment->departmental_case_file = $filename2;
            }
            if ($settlement_punishment_file) {
                $filename3 = @$settlement_punishment_file->getClientOriginalName();
                $settlement_punishment_file->move($path, $filename3);
                $em_punishment->settlement_punishment_file = $filename3;
            }
            if ($appeal_and_disposal_file) {
                $filename4 = @$appeal_and_disposal_file->getClientOriginalName();
                $appeal_and_disposal_file->move($path, $filename4);
                $em_punishment->appeal_and_disposal_file = $filename4;
            }
            if ($case_no_and_judgment_file) {
                $filename5 = @$case_no_and_judgment_file->getClientOriginalName();
                $case_no_and_judgment_file->move($path, $filename5);
                $em_punishment->case_no_and_judgment_file = $filename5;
            }
            if ($case_no_administrative_file) {
                $filename6 = @$case_no_administrative_file->getClientOriginalName();
                $case_no_administrative_file->move($path, $filename6);
                $em_punishment->case_no_administrative_file = $filename6;
            }
            if ($leave_to_memo_file) {
                $filename7 = @$leave_to_memo_file->getClientOriginalName();
                $leave_to_memo_file->move($path, $filename7);
                $em_punishment->leave_to_memo_file = $filename7;
            }
            if ($review_case_no_file) {
                $filename8 = @$review_case_no_file->getClientOriginalName();
                $review_case_no_file->move($path, $filename8);
                $em_punishment->review_case_no_file = $filename8;
            }
            if ($comments_file) {
                $filename9 = @$comments_file->getClientOriginalName();
                $comments_file->move($path, $filename9);
                $em_punishment->comments_file = $filename9;
            }
            if ($punishment_notice_file) {
                $filename10 = @$punishment_notice_file->getClientOriginalName();
                $punishment_notice_file->move($path, $filename10);
                $em_punishment->punishment_notice_file = $filename10;
            }
            if ($accused_reply_file) {
                $filename11 = @$accused_reply_file->getClientOriginalName();
                $accused_reply_file->move($path, $filename11);
                $em_punishment->accused_reply_file = $filename11;
            }
            if ($action_apply_file) {
                $filename12 = @$action_apply_file->getClientOriginalName();
                $action_apply_file->move($path, $filename12);
                $em_punishment->action_apply_file = $filename12;
            }
            if ($disposal_verdict_file) {
                $filename13 = @$disposal_verdict_file->getClientOriginalName();
                $disposal_verdict_file->move($path, $filename13);
                $em_punishment->disposal_verdict_file = $filename13;
            }
            if ($additional_notes_file) {
                $filename14 = @$additional_notes_file->getClientOriginalName();
                $additional_notes_file->move($path, $filename14);
                $em_punishment->additional_notes_file = $filename14;
            }

            $em_punishment->status = 'active';
            $em_punishment->created_at = now();
            $em_punishment->updated_at = now();
            $em_punishment->save();
        }
        return 'done';
    }

    public function pendingEmployeesToPunishment()
    {
        $pendingEmployeePunishment = DB::table('employee_punishments')
            ->join('employees', 'employee_punishments.employee_id', '=', 'employees.id')
            ->join('punishments', 'employee_punishments.punishment_id', '=', 'punishments.id')
            ->where('employee_punishments.status', '=', 'inactive')
            ->select('employee_punishments.*', 'employees.name as employee_name', 'employees.pin_no', 'employees.new_pin', 'punishments.name as punishment_name')
            ->get();
        return view('admin.punishment.pending-employee-punishments', compact('pendingEmployeePunishment'));
    }

    public function approveDenyEmployeesToPunishment($pivotId, $status)
    {
        if ($status == 'approve') {
            PunishmentEmployee::query()->findOrFail($pivotId)->update(['status' => 'active']);
            Toastr::success('Employees Approved to punishment.');
        } elseif ($status == 'deny') {
            PunishmentEmployee::query()->findOrFail($pivotId)->delete();
            Toastr::warning('Record Deleted.');
        } else {
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function removeEmployeeFromPunishment($pivotId)
    {
        PunishmentEmployee::query()->findOrFail($pivotId)->delete();

        Toastr::success('Employee removed from Punishment.');
        return back();
    }

    public function showPunishedEmployee($pivotId)
    {
        $actions = Action::all();
        $pivot = PunishmentEmployee::query()->findOrFail($pivotId);
        $punishment = Punishment::findOrFail($pivot->punishment_id);
        return view('admin.punishment.show_punished_employee', compact('pivot', 'punishment', 'actions'));
    }

    public function editPunishedEmployee($pivotId)
    {
        $actions = Action::all();
        $pivot = PunishmentEmployee::query()->findOrFail($pivotId);
        $punishment = Punishment::findOrFail($pivot->punishment_id);
        return view('admin.punishment.edit_punished_employee', compact('pivot', 'punishment', 'actions'));
    }

    function attachment_file()
    {
        $fileName = PunishmentEmployee::query()->findOrFail(request()->id)->get()[0]->attachment_file;
        $filePath = public_path('assets/punishment/') . $fileName;
        $headers = ['Content-Type: application/pdf'];
        return response()->download($filePath, $fileName, $headers);
    }

    public function updatePunishedEmployee(Request $request)
    {
        $request->validate([
            "punishment_id" => 'required',

            'complaint_file' => 'nullable|mimes:doc,pdf,docx',
            'departmental_case_file' => 'nullable|mimes:doc,pdf,docx',
            'settlement_punishment_file' => 'nullable|mimes:doc,pdf,docx',
            'appeal_and_disposal_file' => 'nullable|mimes:doc,pdf,docx',
            'case_no_and_judgment_file' => 'nullable|mimes:doc,pdf,docx',
            'case_no_administrative_file' => 'nullable|mimes:doc,pdf,docx',
            'leave_to_memo_file' => 'nullable|mimes:doc,pdf,docx',
            'review_case_no_file' => 'nullable|mimes:doc,pdf,docx',
            'comments_file' => 'nullable|mimes:doc,pdf,docx',
            'punishment_notice_file' => 'nullable|mimes:doc,pdf,docx',
            'accused_reply_file' => 'nullable|mimes:doc,pdf,docx',
            'action_apply_file' => 'nullable|mimes:doc,pdf,docx',
            'disposal_verdict_file' => 'nullable|mimes:doc,pdf,docx',
            'additional_notes_file' => 'nullable|mimes:doc,pdf,docx',
        ]);

        $complaint_file = $request->file('complaint_file');
        $departmental_case_file = $request->file('departmental_case_file');
        $settlement_punishment_file = $request->file('settlement_punishment_file');
        $appeal_and_disposal_file = $request->file('appeal_and_disposal_file');
        $case_no_and_judgment_file = $request->file('case_no_and_judgment_file');
        $case_no_administrative_file = $request->file('case_no_administrative_file');
        $leave_to_memo_file = $request->file('leave_to_memo_file');
        $review_case_no_file = $request->file('review_case_no_file');
        $comments_file = $request->file('comments_file');

        $punishment_notice_file = $request->file('punishment_notice_file');
        $accused_reply_file = $request->file('accused_reply_file');
        $action_apply_file = $request->file('action_apply_file');
        $disposal_verdict_file = $request->file('disposal_verdict_file');
        $additional_notes_file = $request->file('additional_notes_file');

        $path = public_path() . '/assets/punishment/attachments/';

        if ($complaint_file) {
            $filename1 = @$complaint_file->getClientOriginalName();
            $complaint_file->move($path, $filename1);
        }
        if ($departmental_case_file) {
            $filename2 = @$departmental_case_file->getClientOriginalName();
            $departmental_case_file->move($path, $filename2);
        }
        if ($settlement_punishment_file) {
            $filename3 = @$settlement_punishment_file->getClientOriginalName();
            $settlement_punishment_file->move($path, $filename3);
        }
        if ($appeal_and_disposal_file) {
            $filename4 = @$appeal_and_disposal_file->getClientOriginalName();
            $appeal_and_disposal_file->move($path, $filename4);
        }
        if ($case_no_and_judgment_file) {
            $filename5 = @$case_no_and_judgment_file->getClientOriginalName();
            $case_no_and_judgment_file->move($path, $filename5);
        }
        if ($case_no_administrative_file) {
            $filename6 = @$case_no_administrative_file->getClientOriginalName();
            $case_no_administrative_file->move($path, $filename6);
        }
        if ($leave_to_memo_file) {
            $filename7 = @$leave_to_memo_file->getClientOriginalName();
            $leave_to_memo_file->move($path, $filename7);
        }
        if ($review_case_no_file) {
            $filename8 = @$review_case_no_file->getClientOriginalName();
            $review_case_no_file->move($path, $filename8);
        }
        if ($comments_file) {
            $filename9 = @$comments_file->getClientOriginalName();
            $comments_file->move($path, $filename9);
        }
        if ($punishment_notice_file) {
            $filename10 = @$punishment_notice_file->getClientOriginalName();
            $punishment_notice_file->move($path, $filename10);
        }
        if ($accused_reply_file) {
            $filename11 = @$accused_reply_file->getClientOriginalName();
            $accused_reply_file->move($path, $filename11);
        }
        if ($action_apply_file) {
            $filename12 = @$action_apply_file->getClientOriginalName();
            $action_apply_file->move($path, $filename12);
        }
        if ($disposal_verdict_file) {
            $filename13 = @$disposal_verdict_file->getClientOriginalName();
            $disposal_verdict_file->move($path, $filename13);
        }
        if ($additional_notes_file) {
            $filename14 = @$additional_notes_file->getClientOriginalName();
            $additional_notes_file->move($path, $filename14);
        }

        $em_punishment = PunishmentEmployee::query()->findOrFail($request->pivot_id);

        $em_punishment->complaint_description = $request->complaint_description;
        $em_punishment->departmental_case_memo_no_date_and_section = $request->departmental_case_memo_no_date_and_section;
        $em_punishment->settlement_punishment_memo_date_and_description_of_punishment = $request->settlement_punishment_memo_date_and_description_of_punishment;
        $em_punishment->appeal_and_disposal_order_along_with_the_secretary = $request->appeal_and_disposal_order_along_with_the_secretary;
        $em_punishment->case_no_and_judgment_of_the_administrative_tribunal = $request->case_no_and_judgment_of_the_administrative_tribunal;
        $em_punishment->case_no_and_judgment_of_the_administrative_appeal_tribunal = $request->case_no_and_judgment_of_the_administrative_appeal_tribunal;
        $em_punishment->leave_to_memo_no_and_judgement = $request->leave_to_memo_no_and_judgement;
        $em_punishment->review_case_no_and_judgement = $request->review_case_no_and_judgement;
        $em_punishment->punishment_notice = $request->punishment_notice;
        $em_punishment->accused_reply = $request->accused_reply;
        $em_punishment->action_apply = $request->action_apply;
        $em_punishment->disposal_verdict = $request->disposal_verdict;
        $em_punishment->additional_notes = $request->additional_notes;
        $em_punishment->comments = $request->comments;

        if ($complaint_file) {
            $em_punishment->complaint_file = $filename1;
        }
        if ($departmental_case_file) {
            $em_punishment->departmental_case_file = $filename2;
        }
        if ($settlement_punishment_file) {
            $em_punishment->settlement_punishment_file = $filename3;
        }
        if ($appeal_and_disposal_file) {
            $em_punishment->appeal_and_disposal_file = $filename4;
        }
        if ($case_no_and_judgment_file) {
            $em_punishment->case_no_and_judgment_file = $filename5;
        }
        if ($case_no_administrative_file) {
            $em_punishment->case_no_administrative_file = $filename6;
        }
        if ($leave_to_memo_file) {
            $em_punishment->leave_to_memo_file = $filename7;
        }
        if ($review_case_no_file) {
            $em_punishment->review_case_no_file = $filename8;
        }
        if ($comments_file) {
            $em_punishment->comments_file = $filename9;
        }
        if ($punishment_notice_file) {
            $em_punishment->punishment_notice_file = $filename10;
        }
        if ($accused_reply_file) {
            $em_punishment->accused_reply_file = $filename11;
        }
        if ($action_apply_file) {
            $em_punishment->action_apply_file = $filename12;
        }
        if ($disposal_verdict_file) {
            $em_punishment->disposal_verdict_file = $filename13;
        }
        if ($additional_notes_file) {
            $em_punishment->additional_notes_file = $filename14;
        }
        $em_punishment->updated_at = now();
        $em_punishment->save();



        //        PunishmentEmployee::query()->findOrFail($request->pivot_id)->update([
//            'complaint_description' => $request->complaint_description,
//            'departmental_case_memo_no_date_and_section' => $request->departmental_case_memo_no_date_and_section,
//            'settlement_punishment_memo_date_and_description_of_punishment' => $request->settlement_punishment_memo_date_and_description_of_punishment,
//            'appeal_and_disposal_order_along_with_the_secretary' => $request->appeal_and_disposal_order_along_with_the_secretary,
//            'case_no_and_judgment_of_the_administrative_tribunal' => $request->case_no_and_judgment_of_the_administrative_tribunal,
//            'case_no_and_judgment_of_the_administrative_appeal_tribunal' => $request->case_no_and_judgment_of_the_administrative_appeal_tribunal,
//            'leave_to_memo_no_and_judgement' => $request->leave_to_memo_no_and_judgement,
//            'review_case_no_and_judgement' => $request->review_case_no_and_judgement,
//            'punishment_notice' => $request->punishment_notice,
//            'accused_reply' => $request->accused_reply,
//            'action_apply' => $request->action_apply,
//            'disposal_verdict' => $request->disposal_verdict,
//            'additional_notes' => $request->additional_notes,
//            'comments' => $request->comments,
//
//            //file uploads
//
//
//            'complaint_file' => $filename1,
//            'departmental_case_file' => $filename2,
//            'settlement_punishment_file' => $filename3,
//            'appeal_and_disposal_file' => $filename4,
//            'case_no_and_judgment_file' => $filename5,
//            'case_no_administrative_file' => $filename6,
//            'leave_to_memo_file' => $filename7,
//            'review_case_no_file' => $filename8,
//            'comments_file' => $filename9,
//            'punishment_notice_file' => $filename10,
//            'accused_reply_file' => $filename11,
//            'action_apply_file' => $filename12,
//            'disposal_verdict_file' => $filename13,
//            'additional_notes_file' => $filename14,
//
//
//            'updated_at' => now(),
//        ]);

        Toastr::success('Punished Employee information updated.');
        return redirect()->route('punishment.index');
    }
}
