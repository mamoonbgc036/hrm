<?php

namespace App\Http\Controllers;

use App\Classes\DateTimeHelper;
use App\Models\Employee;
use App\Models\InhouseTrainedEmployee;
use App\Models\InhouseTraining;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InhouseTrainingController extends Controller
{
    public function index()
    {
        $inhouse_trainings = InhouseTraining::query()->latest()->get();
        $inhouse_training_employees = InhouseTrainedEmployee::query()->with('country','employee','inhouse_training')->where('status','active')->latest();

        if (\request()->ajax()){
            return DataTables::of($inhouse_training_employees)
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
                ->addColumn('inhouse_training_name', function ($row){
                    $route = route('inhouse-training.show',$row->inhouse_training->id);
                    $name = $row->inhouse_training->course_title ?? '';
                    $inhouse_training = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Inhouse Training Show">'.$name.'</a>';
                    return $inhouse_training;
                })
                ->filterColumn('inhouse_training_name', function ($query,$keyword){
                    $inhouse_training_ids = InhouseTraining::query()->where('course_title','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('inhouse_training_id',$inhouse_training_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.inhouse_training.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','inhouse_training_name','action'])
                ->toJson();
        }

        return view('admin.inhouse_training.index',compact('inhouse_trainings','inhouse_training_employees'));
    }

    public function create()
    {
        return view('admin.inhouse_training.create');
    }

    public function store(Request $request)
    {
        $this->validate($request ,[
            'course_title'=>'required|string|unique:inhouse_trainings,course_title',
            'course_code'=>'nullable|unique:inhouse_trainings,course_code',
        ]);
        $inhouse_training = new InhouseTraining();
        $inhouse_training->fill($request->except('hr_id'));
        $inhouse_training->hr_number();

        $inhouse_training->save();
        Toastr::success('Inhouse Training Created Successfully!', 'Success');
        return redirect()->route('inhouse-training.index');
    }

    public function show(InhouseTraining $inhouseTraining)
    {
        $inhouse_training_employees = InhouseTrainedEmployee::query()
                            ->with('country','employee','inhouse_training')
                            ->where('inhouse_training_id',$inhouseTraining->id)
                            ->where('status','active')
                            ->latest();

        if (\request()->ajax()){
            return DataTables::of($inhouse_training_employees)
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
                ->addColumn('inhouse_training_name', function ($row){
                    $route = route('inhouse-training.show',$row->inhouse_training->id);
                    $name = $row->inhouse_training->course_title ?? '';
                    $inhouse_training = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Inhouse Training Show">'.$name.'</a>';
                    return $inhouse_training;
                })
                ->filterColumn('inhouse_training_name', function ($query,$keyword){
                    $inhouse_training_ids = InhouseTraining::query()->where('course_title','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('inhouse_training_id',$inhouse_training_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.inhouse_training.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','inhouse_training_name','action'])
                ->toJson();
        }

        return view('admin.inhouse_training.view',compact('inhouseTraining','inhouse_training_employees'));
    }

    public function edit(InhouseTraining $inhouseTraining)
    {
        $employees = Employee::all();
        return view('admin.inhouse_training.edit',compact('inhouseTraining','employees'));
    }

    public function update(Request $request, InhouseTraining $inhouseTraining)
    {
        $this->validate($request ,[
            'course_title'=>'required|string|unique:inhouse_trainings,course_title,'.$inhouseTraining->id,
            'course_code'=>'nullable|unique:inhouse_trainings,course_code,'.$inhouseTraining->id,

        ]);

        $inhouseTraining->fill($request->except('hr_id','from_date','to_date','memo_date'));

        $inhouseTraining->update();
        Toastr::success('Inhouse Training Updated Successfully!', 'Success');
        return redirect()->route('inhouse-training.index');
    }

    public function destroy(InhouseTraining $inhouseTraining)
    {
        $inhouseTraining->delete();
        Toastr::success('Inhouse Training Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('inhouse-training.index');
    }
    public function getDeletedInhouseTraining()
    {
        $inhouse_trainings = InhouseTraining::onlyTrashed()->get();
        return view('admin.inhouse_training.deleted_inhouse_training',compact('inhouse_trainings'));
    }
    public function restore($id)
    {
        InhouseTraining::withTrashed()->findOrFail($id)->restore();
        Toastr::success('Inhouse Training Restore Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('inhouse-training.deleted');
    }
    public function permanentDelete($id)
    {
        InhouseTraining::withTrashed()->findOrFail($id)->forceDelete();
        Toastr::success('Inhouse Training Permanently Deleted!');
        return redirect()->route('inhouse-training.deleted');
    }

    public function getInhouseTrainedEmployeeId()
    {
        $iTrainingId = request()->iTrainingId;
        $inhouseTraining = InhouseTraining::findOrFail($iTrainingId);
        $employees_id = $inhouseTraining->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($iTrainingId)
    {
        $i_training = InhouseTraining::findOrFail($iTrainingId);
        return view('admin.inhouse_training.select-employee', compact('i_training'));
    }

    public function addEmployeeToInhouseTraining(Request $request){
        $request->validate([
            "i_training_id" => 'required',
            "memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $memo_date = Carbon::parse($request->memo_date)->format('Y-m-d');

        foreach ($request->employees as $value){
            InhouseTrainedEmployee::query()->insert([
                'employee_id' => $value['id'],
                'inhouse_training_id' => $request->i_training_id,
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
        Toastr::success('Employees added to this Inhouse training.');
        return redirect()->route('inhouse-training.index');
    }

    public function add_inhouse_trainings_to_employee(Request $request){
        $request->validate([
            'employee_id' => 'required',
            "inhouse_training.*.id" => 'required',
            "inhouse_training.*.memo_date" => 'nullable|date_format:d-m-Y',
            "inhouse_training.*.from_date" => 'nullable|date_format:d-m-Y',
            "inhouse_training.*.to_date" => 'nullable|date_format:d-m-Y',
        ]);

        foreach ($request->inhouse_training as $value){
            $from_date = Carbon::parse($value['from_date'])->format('Y-m-d');
            $to_date = Carbon::parse($value['to_date'])->format('Y-m-d');
            $memo_date = Carbon::parse($value['memo_date'])->format('Y-m-d');

            InhouseTrainedEmployee::query()->insert([
                'employee_id' => $request->employee_id,
                'inhouse_training_id' => $value['id'],
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

        Toastr::success('Inhouse Trainings added to this Employee.');
        DB::commit();
        return response()->json([
            'url'=> route('employee.assign',$request->employee_id)
        ]);
    }

    public function pendingEmployeesToInhouseTraining ()
    {
        $pendingEmployeeToinhouseTrainings = DB::table('employee_inhouse_training')
            ->join('employees','employee_inhouse_training.employee_id','=','employees.id')
            ->join('inhouse_trainings','employee_inhouse_training.inhouse_training_id','=','inhouse_trainings.id')
            ->where('employee_inhouse_training.status','=','inactive')
            ->select('employee_inhouse_training.*','employees.name as employee_name','employees.pin_no','employees.new_pin','inhouse_trainings.course_title as course_title')
            ->get();
        return view('admin.inhouse_training.pending-employees',compact('pendingEmployeeToinhouseTrainings'));
    }

    public function approveDenyEmployeeToInhouseTraining($ipivotId, $status)
    {
        if ($status == 'approve'){
            InhouseTrainedEmployee::query()->findOrFail($ipivotId)->update(['status'=>'active']);
            Toastr::success('Employees Approved to Inhouse Training.');
        }elseif ($status == 'deny'){
            InhouseTrainedEmployee::query()->findOrFail($ipivotId)->delete();
            Toastr::warning('Record Deleted.');
        }else{
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function removeEmployeeFromInhouseTraining($employeeInhouseTrainingId)
    {
        InhouseTrainedEmployee::query()->findOrFail($employeeInhouseTrainingId)->delete();
        Toastr::success('Employee removed from Inhouse Training.');
        return back();
    }

    public function showInhouseTrainedEmployee($pivot_id)
    {
        $pivot = InhouseTrainedEmployee::query()->findOrFail($pivot_id);
//        return $pivot->id; // *** IMPORTANT NOTE *** return $pivot; will show error even if it has children
        $inhouse_training = InhouseTraining::findOrFail($pivot->inhouse_training_id);
        return view('admin.inhouse_training.show_inhouse_trained_employee', compact('pivot','inhouse_training'));
    }

    public function editInhouseTrainedEmployee($pivot_id)
    {
        $pivot = InhouseTrainedEmployee::query()->findOrFail($pivot_id);
//        return $pivot->id; // *** IMPORTANT NOTE *** return $pivot; will show error even if it has children
        $inhouse_training = InhouseTraining::findOrFail($pivot->inhouse_training_id);
        return view('admin.inhouse_training.edit_inhouse_trained_employee', compact('pivot','inhouse_training'));
    }

    public function updateInhouseTrainedEmployee(Request $request)
    {
        $request->validate([
            "memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        InhouseTrainedEmployee::query()->findOrFail($request->pivot_id)->update([
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
        $inhouseTraining = InhouseTraining::with('approvedEmployees')->findOrFail($request->inhouse_training_id);
        Toastr::success('Inhouse Trained Employee information updated.');
        return view('admin.inhouse_training.view',compact('inhouseTraining'));
    }
}
