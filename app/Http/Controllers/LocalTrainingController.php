<?php

namespace App\Http\Controllers;

use App\Classes\DateTimeHelper;
use App\Models\Employee;
use App\Models\LocalTrainedEmployee;
use App\Models\LocalTraining;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LocalTrainingController extends Controller
{

    public function index()
    {
        $local_trainings = LocalTraining::query()->with('employees')->latest()->get();
        $local_training_employees = LocalTrainedEmployee::query()->with('country','employee','local_training')->where('status','active')->latest();

        if (\request()->ajax()){
            return DataTables::of($local_training_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row){
                    $route = route('employee.show',$row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
                    return $employee;
                })
                ->filterColumn('employee_name', function ($query,$keyword){
                    $employee_ids = Employee::query()->where('name','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('employee_id',$employee_ids);
                })
                ->addColumn('local_training_name', function ($row){
                    $route = route('local-training.show',$row->local_training->id);
                    $name = $row->local_training->course_title ?? '';
                    $local_training = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Inland Training Show">'.$name.'</a>';
                    return $local_training;
                })
                ->filterColumn('local_training_name', function ($query,$keyword){
                    $local_training_ids = LocalTraining::query()->where('course_title','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('local_training_id',$local_training_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.local_training.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','local_training_name','action'])
                ->toJson();
        }
        return view('admin.local_training.index',compact('local_trainings','local_training_employees'));
    }

    public function create()
    {
        return view('admin.local_training.create');
    }

    public function store(Request $request)
    {
        $this->validate($request ,[
            'course_title'=>'required|string|unique:local_trainings,course_title',
            'course_code'=>'nullable|unique:local_trainings,course_code',
        ]);
        $local_training = new LocalTraining();
        $local_training->fill($request->except('hr_id','from_date','to_date','memo_date'));
        $local_training->hr_number();

        $local_training->save();
        Toastr::success('Local Training Created Successfully!', 'Success');
        return redirect()->route('local-training.index');
    }

    public function show(LocalTraining $localTraining)
    {
        $local_training_employees = LocalTrainedEmployee::query()
                                        ->with('country','employee','local_training')
                                        ->where('local_training_id',$localTraining->id)
                                        ->where('status','active')
                                        ->latest();

        if (\request()->ajax()){
            return DataTables::of($local_training_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row){
                    $route = route('employee.show',$row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
                    return $employee;
                })
                ->filterColumn('employee_name', function ($query,$keyword){
                    $employee_ids = Employee::query()->where('name','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('employee_id',$employee_ids);
                })
                ->addColumn('local_training_name', function ($row){
                    $route = route('local-training.show',$row->local_training->id);
                    $name = $row->local_training->course_title ?? '';
                    $local_training = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Inland Training Show">'.$name.'</a>';
                    return $local_training;
                })
                ->filterColumn('local_training_name', function ($query,$keyword){
                    $local_training_ids = LocalTraining::query()->where('course_title','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('local_training_id',$local_training_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.local_training.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','local_training_name','action'])
                ->toJson();
        }
        return view('admin.local_training.view',compact('localTraining','local_training_employees'));
    }

    public function edit(LocalTraining $localTraining)
    {
        $employees=Employee::all();
        return view('admin.local_training.edit',compact('localTraining','employees'));
    }

    public function update(Request $request, LocalTraining $localTraining)
    {
        $this->validate($request ,[
            'course_title'=>'required|string|unique:local_trainings,course_title,'.$localTraining->id,
            'course_code'=>'nullable|unique:local_trainings,course_code,'.$localTraining->id,
        ]);

        $localTraining->fill($request->except('hr_id','from_date','to_date','memo_date'));

        $localTraining->update();
        Toastr::success('Local Training Updated Successfully!', 'Success');
        return redirect()->route('local-training.index');
    }

    public function destroy(LocalTraining $localTraining)
    {
        $localTraining->delete();
        \Toastr::success('Local Training Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('local-training.index');
    }
    public function getDeletedLocalTraining()
    {
        $local_trainings = LocalTraining::onlyTrashed()->get();
        return view('admin.local_training.deleted_local_training',compact('local_trainings'));
    }
    public function restore($id)
    {
        LocalTraining::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Local Training Restore Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('local-training.deleted');
    }
    public function permanentDelete($id)
    {
        LocalTraining::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Local Training Permanently Deleted!');
        return redirect()->route('local-training.deleted');
    }

    public function getLocalTrainedEmployeeId()
    {
        $lTrainingId = request()->lTrainingId;
        $localTraining = LocalTraining::findOrFail($lTrainingId);
        $employees_id = $localTraining->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($lTrainingId)
    {
        $l_training = LocalTraining::findOrFail($lTrainingId);
        return view('admin.local_training.select-employee', compact('l_training'));
    }

    public function setLocalTraining()
    {
        $l_training = LocalTraining::query()->find(request('l_training_id'));
        $employee = Employee::query()->findOrFail(request('employee_id'));
        $l_trainings = LocalTraining::all();
        $countries = Country::all();
        return view('admin.local_training.set-l-training', compact('l_training','employee','l_trainings','countries'));
    }

    public function addEmployeeToLocalTraining(Request $request){
        $request->validate([
            "l_training_id" => 'required',
            "memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $memo_date = Carbon::parse($request->memo_date)->format('Y-m-d');

        foreach ($request->employees as $value){
            LocalTrainedEmployee::query()->insert([
                'employee_id' => $value['id'],
                'local_training_id' => $request->l_training_id,
                'venue' => $request->venue,
                'from_date' => $request->from_date ? $from_date : null,
                'to_date' => $request->to_date ? $to_date : null,
                'duration' => $request->duration,
                'memo_number' => $request->memo_number,
                'memo_date' => $request->memo_date ? $memo_date : null,
                'result' => $value['result'],
                'course_coordinator' => $request->course_coordinator,
                'description' => $request->description,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return 'done';
        Toastr::success('Employees added to this local training.');
        return redirect()->route('local-training.index');
    }

    public function add_local_trainings_to_employee(Request $request){
        $request->validate([
            'employee_id' => 'required',
            "local_training.*.id" => 'required',
            "local_training.*.memo_date" => 'nullable|date_format:d-m-Y',
            "local_training.*.from_date" => 'nullable|date_format:d-m-Y',
            "local_training.*.to_date" => 'nullable|date_format:d-m-Y',
        ]);

        foreach ($request->local_training as $value){
            $from_date = Carbon::parse($value['from_date'])->format('Y-m-d');
            $to_date = Carbon::parse($value['to_date'])->format('Y-m-d');
            $memo_date = Carbon::parse($value['memo_date'])->format('Y-m-d');

            LocalTrainedEmployee::query()->insert([
                'employee_id' => $request->employee_id,
                'local_training_id' => $value['id'],
                'venue' => $value['venue'],
                'course_coordinator' => $value['course_coordinator'],
                'from_date' => $from_date ?? null,
                'to_date' => $to_date ?? null,
                'duration' => $value['duration'],
                'memo_number' => $value['memo_number'],
                'memo_date' => $memo_date ?? null,
                'result' => $value['result'],
                'description' => $value['description'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Toastr::success('Inland Trainings added to this Employee.');
        DB::commit();
        return response()->json([
            'url'=> route('employee.assign',$request->employee_id)
        ]);
    }

    public function pendingEmployeesToLocalTraining()
    {
        $pendingEmployeeToLocalTrainings = DB::table('employee_local_trainings')
            ->join('employees','employee_local_trainings.employee_id','=','employees.id')
            ->join('local_trainings','employee_local_trainings.local_training_id','=','local_trainings.id')
            ->where('employee_local_trainings.status','=','inactive')
            ->select('employee_local_trainings.*','employees.name as employee_name','employees.pin_no','employees.new_pin','local_trainings.course_title as course_title')
            ->get();
        return view('admin.local_training.pending-employees',compact('pendingEmployeeToLocalTrainings'));
    }

    public function approveDenyEmployeeToLocalTraining($pivotId, $status)
    {
        if ($status == 'approve'){
            LocalTrainedEmployee::query()->findOrFail($pivotId)->update(['status'=>'active']);
            Toastr::success('Employees Approved to Local Training.');
        }elseif ($status == 'deny'){
            LocalTrainedEmployee::query()->findOrFail($pivotId)->delete();
            Toastr::warning('Record Deleted.');
        }else{
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function removeEmployeeFromLocalTraining($pivotId)
    {
        LocalTrainedEmployee::query()->findOrFail($pivotId)->delete();

        Toastr::success('Employee removed from Local Training.');
        return back();
    }

    public function showLocalTrainedEmployee($pivotId)
    {
        $pivot = LocalTrainedEmployee::query()->findOrFail($pivotId);
//        return $pivot->id; // *** IMPORTANT NOTE *** return $pivot; will show error even if it has children
        $local_training = LocalTraining::findOrFail($pivot->local_training_id);
        return view('admin.local_training.show_local_trained_employee', compact('pivot','local_training'));
    }

    public function editLocalTrainedEmployee($pivotId)
    {
        $pivot = LocalTrainedEmployee::query()->findOrFail($pivotId);
//        return $pivot->id; // *** IMPORTANT NOTE *** return $pivot; will show error even if it has children
        $local_training = LocalTraining::query()->findOrFail($pivot->local_training_id);
        return view('admin.local_training.edit_local_trained_employee', compact('pivot','local_training'));
    }

    public function updateLocalTrainedEmployee(Request $request)
    {
        $request->validate([
            "memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        LocalTrainedEmployee::query()->findOrFail($request->pivot_id)->update([
            'memo_number' => $request->memo_number,
            'memo_date' => $request->memo_date ? Carbon::parse($request->memo_date)->format('Y-m-d') : null,
            'from_date' => $request->from_date ? Carbon::parse($request->from_date)->format('Y-m-d') : null,
            'to_date' => $request->to_date ? Carbon::parse($request->to_date)->format('Y-m-d') : null,
            'duration' => $request->duration,
            'venue' => $request->venue,
            'result' => $request->result,
            'course_coordinator' => $request->course_coordinator,
            'description' => $request->description,
            'updated_at' => now(),
        ]);
        LocalTraining::query()->with('approvedEmployees')->findOrFail($request->local_training_id);
        Toastr::success('Inland Trained Employee information updated.');
        return redirect()->route('local-training.index');
    }
}
