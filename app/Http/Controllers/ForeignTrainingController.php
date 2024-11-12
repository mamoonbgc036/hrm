<?php

namespace App\Http\Controllers;

use App\Classes\DateTimeHelper;
use App\Http\Requests\ForeignTrainingRequest;
use App\Models\Country;
use App\Models\Employee;
use App\Models\ForeignTrainedEmployee;
use App\Models\ForeignTraining;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ForeignTrainingController extends Controller
{
    public function index()
    {
        $foreign_trainings = ForeignTraining::latest()->get();
        $foreign_training_employees = ForeignTrainedEmployee::query()->with('country','employee','foreign_training')->where('status','active')->latest();

        if (\request()->ajax()){
            return DataTables::of($foreign_training_employees)
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
                ->addColumn('foreign_training_name', function ($row){
                    $route = route('foreign-training.show',$row->foreign_training->id);
                    $name = $row->foreign_training->course_title ?? '';
                    $foreign_training = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Abroad Training Show">'.$name.'</a>';
                    return $foreign_training;
                })
                ->filterColumn('foreign_training_name', function ($query,$keyword){
                    $foreign_training_ids = ForeignTraining::query()->where('course_title','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('foreign_training_id',$foreign_training_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.foreign_training.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','foreign_training_name','action'])
                ->toJson();
        }

        return view('admin.foreign_training.index',compact('foreign_trainings','foreign_training_employees'));
    }

    public function create()
    {
        return view('admin.foreign_training.create');
    }

    public function store(Request $request)
    {

        $this->validate($request ,[
            'course_title'=>'required|string|unique:foreign_trainings,course_title',
            'course_code'=>'nullable|unique:foreign_trainings,course_code',
        ]);
        $foreign_training = new ForeignTraining();
        $foreign_training->hr_number();
        $foreign_training->fill(\request()->except('hr_id','from_date','to_date','memo_date'));

        $foreign_training->save();
        Toastr::success('Foreign Training Created Successfully!.', 'Success');
        return redirect()->route('foreign-training.index');
    }

    public function show(ForeignTraining $foreignTraining)
    {
        $foreign_training_employees = ForeignTrainedEmployee::query()
                                            ->with('country','employee','foreign_training')
                                            ->where('foreign_training_id',$foreignTraining->id)
                                            ->where('status','active')
                                            ->latest();

        if (\request()->ajax()){
            return DataTables::of($foreign_training_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row){
                    $route = route('employee.show',$row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
                    return $employee;
                })
                ->addColumn('foreign_training_name', function ($row){
                    $route = route('foreign-training.show',$row->foreign_training->id);
                    $name = $row->foreign_training->course_title ?? '';
                    $foreign_training = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Abroad Training Show">'.$name.'</a>';
                    return $foreign_training;
                })
                ->addColumn('date_of_foreign_training', function ($row){
                    return @$row->created_at ? \Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y h:i:s A') : '';
                })
                ->addColumn('action', function ($row){
                    return view('admin.foreign_training.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','foreign_training_name','action'])
                ->toJson();
        }

        return view('admin.foreign_training.view',compact('foreignTraining','foreign_training_employees'));
    }

    public function edit(ForeignTraining $foreignTraining)
    {
        $countries = Country::all();
        $employees = Employee::all();
        return view('admin.foreign_training.edit',compact('foreignTraining','employees','countries'));
    }

    public function update(Request $request, ForeignTraining $foreignTraining)
    {
        $this->validate($request ,[
            'course_title'=>'required|string|unique:foreign_trainings,course_title,'.$foreignTraining->id,
            'course_code'=>'nullable|unique:foreign_trainings,course_code,'.$foreignTraining->id,
        ]);

        $foreignTraining->fill(\request()->except('hr_id','from_date','to_date','memo_date'));
        $foreignTraining->update();

        Toastr::success('Foreign Training Updated Successfully!.', 'Success');
        return redirect()->route('foreign-training.index');
    }

    public function destroy(ForeignTraining $foreignTraining)
    {
        $foreignTraining->delete();
        \Toastr::success('Foreign Training Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('foreign-training.index');
    }

    public function getDeletedForeignTraining()
    {
        $foreign_trainings = ForeignTraining::onlyTrashed()->get();
        return view('admin.foreign_training.deleted_foreign_training',compact('foreign_trainings'));
    }

    public function restore($id)
    {
        $foreign_trainings = ForeignTraining::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Foreign Training Restored Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('foreign-training.deleted');
    }

    public function permanentDelete($id)
    {
        $foreign_trainings = ForeignTraining::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Foreign Training Permanently Deleted!.');
        return redirect()->route('foreign-training.deleted');
    }

    public function duration(){
        $from_date = request()->from_date;
        $to_date = request()->to_date;
        $result = Carbon::parse($from_date)->diffInDays($to_date);
        $years = ($result / 365) ;
        $years = floor($years);
        $month = ($result % 365) / 30.5;
        $months = floor($month);
        $days = ($result % 365) % 30.5;
        return $data = [
          'years' => $years,
          'months' => $months,
          'days' => $days
        ];
    }
    public function duration2(){
        $date1 = new DateTime(request()->from_date);
        $date2 = new DateTime(request()->to_date);
        $date2 = date_add($date2, date_interval_create_from_date_string('1 day'));
        $interval = $date1->diff($date2);

        if ($interval->y < 2){
            $year = $interval->y.' Year';
        } else {
            $year = $interval->y.' Years';
        }

        if ($interval->m < 2){
            $month = $interval->m.' Month';
        } else {
            $month = $interval->m.' Months';
        }

        if ($interval->d < 2){
            $day = $interval->d.' Day';
        } else {
            $day = $interval->d.' Days';
        }

        if($interval->y == 0 && $interval->m == 0){
            $duration = $day;
        } else if($interval->y == 0){
            $duration = $month.', '.$day;
        }else {
            $duration = $year.', '.$month.', '.$day;
        }

        return $data = [
            'output' => $duration,
        ];
    }

    public function getForeignTrainedEmployeeId()
    {
        $fTrainingId = request()->fTrainingId;
        $foreignTraining = ForeignTraining::findOrFail($fTrainingId);
        $employees_id = $foreignTraining->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($fTrainingId)
    {
        $f_training = ForeignTraining::findOrFail($fTrainingId);
        $countries = Country::orderBy('name','ASC')->get();
        return view('admin.foreign_training.select-employee', compact('f_training','countries'));
    }

    public function setForeignTraining()
    {
        $f_training = ForeignTraining::find(request('f_training_id'));
        $employee = Employee::findOrFail(request('employee_id'));
        $f_trainings = ForeignTraining::all();
        $countries = Country::all();
        return view('admin.foreign_training.set-f-training', compact('f_training','employee','f_trainings','countries'));
    }

    public function addEmployeeToForeignTraining(Request $request){
        $request->validate([
            "memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $memo_date = Carbon::parse($request->memo_date)->format('Y-m-d');

        foreach ($request->employees as $value){
            DB::table('employee_foreign_trainings')->insert([
                'employee_id' => $value['id'],
                'foreign_training_id' => $request->f_training_id,
                'country_id' => $request->country_id,
                'venue' => $request->venue,
                'from_date' => $request->from_date ? $from_date : null,
                'to_date' => $request->to_date ? $to_date : null,
                'duration' => $request->duration,
                'memo_number' => $request->memo_number,
                'memo_date' => $request->memo_date ? $memo_date : null,
                'result' => $value['result'],
                'description' => $request->description,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return 'done';

        Toastr::success('Employees added to this foreign training.');
        return redirect()->route('foreign-training.index');
    }

    public function add_foreign_trainings_to_employee(Request $request){
        $request->validate([
            'employee_id' => 'required',
            "foreign_training.*.id" => 'required',
            "foreign_training.*.memo_date" => 'nullable|date_format:d-m-Y',
            "foreign_training.*.from_date" => 'nullable|date_format:d-m-Y',
            "foreign_training.*.to_date" => 'nullable|date_format:d-m-Y',
        ]);

        foreach ($request->foreign_training as $value){
            $from_date = Carbon::parse($value['from_date'])->format('Y-m-d');
            $to_date = Carbon::parse($value['to_date'])->format('Y-m-d');
            $memo_date = Carbon::parse($value['memo_date'])->format('Y-m-d');

            DB::table('employee_foreign_trainings')->insert([
                'employee_id' => $request->employee_id,
                'foreign_training_id' => $value['id'],
                'country_id' => $value['country_id'] ?? null,
                'venue' => $value['venue'],
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

        Toastr::success('Abroad Trainings added to this Employee.');
        DB::commit();
        return response()->json([
            'url'=> route('employee.assign',$request->employee_id)
        ]);
    }

    public function pendingEmployeesToForeignTraining()
    {
        $pendingEmployeeToForeignTrainings = DB::table('employee_foreign_trainings')
            ->join('employees','employee_foreign_trainings.employee_id','=','employees.id')
            ->join('foreign_trainings','employee_foreign_trainings.foreign_training_id','=','foreign_trainings.id')
            ->where('employee_foreign_trainings.status','=','inactive')
            ->select('employee_foreign_trainings.*','employees.name as employee_name','employees.pin_no','employees.new_pin','foreign_trainings.course_title as course_title')
            ->get();
        return view('admin.foreign_training.pending-employees',compact('pendingEmployeeToForeignTrainings'));
    }

    public function approveDenyEmployeeToForeignTraining($foreignTrainingId, $status)
    {
        if ($status == 'approve'){
            ForeignTrainedEmployee::query()->findOrFail($foreignTrainingId)->update(['status'=>'active']);
            Toastr::success('Employees Approved to Foreign Training.');
        }elseif ($status == 'deny'){
            ForeignTrainedEmployee::query()->findOrFail($foreignTrainingId)->delete();
            Toastr::warning('Record Deleted.');
        }else{
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function removeEmployeeFromForeignTraining($pivotId)
    {
        ForeignTrainedEmployee::query()->findOrFail($pivotId)->delete();

        Toastr::success('Employee removed from Foreign Training.');
        return back();
    }

    public function showForeignTrainedEmployee($pivot_id)
    {
        $countries = Country::all();
        $pivot = ForeignTrainedEmployee::query()->findOrFail($pivot_id);
//        return $pivot->id; // *** IMPORTANT NOTE *** return $pivot; will show error even if it has children
        $foreign_training = ForeignTraining::findOrFail($pivot->foreign_training_id);
        return view('admin.foreign_training.show_foreign_trained_employee', compact('pivot','foreign_training','countries'));
    }

    public function editForeignTrainedEmployee($pivot_id)
    {
        $countries = Country::all();
        $pivot = ForeignTrainedEmployee::query()->findOrFail($pivot_id);
//        return $pivot->id; // *** IMPORTANT NOTE *** return $pivot; will show error even if it has children
        $foreign_training = ForeignTraining::findOrFail($pivot->foreign_training_id);
        return view('admin.foreign_training.edit_foreign_trained_employee', compact('pivot','foreign_training','countries'));
    }

    public function updateForeignTrainedEmployee(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            "memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        ForeignTrainedEmployee::query()->findOrFail($request->pivot_id)->update([
            'country_id' => $request->country_id,
            'memo_number' => $request->memo_number,
            'memo_date' => $request->memo_date ? Carbon::parse($request->memo_date)->format('Y-m-d') : null,
            'from_date' => $request->from_date ? Carbon::parse($request->from_date)->format('Y-m-d') : null,
            'to_date' => $request->to_date ? Carbon::parse($request->to_date)->format('Y-m-d') : null,
            'duration' => $request->duration,
            'venue' => $request->venue,
            'result' => $request->result,
            'description' => $request->description,
            'updated_at' => now(),
        ]);
        ForeignTraining::with('approvedEmployees')->find($request->foreign_training_id);
        Toastr::success('Abroad Trained Employee information updated.');
        return redirect()->route('foreign-training.index');
    }
}
