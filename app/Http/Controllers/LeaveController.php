<?php

namespace App\Http\Controllers;

use App\Classes\DateTimeHelper;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveEmployee;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LeaveController extends Controller
{

    public function index()
    {

//        $leave_ids = LeaveEmployee::get()->groupBy('employee_id');
//        $employee_ids_from_em_leave = array_keys($leave_ids->toArray());
//        $missing_ids = [];
//        foreach ($employee_ids_from_em_leave as $employee_id){
//            if (empty(Employee::find($employee_id))){
//                $missing_ids[] = $employee_id;
//            }
//        }
        $leaves = Leave::with('employees')->latest()->get();
        $leave_employees = LeaveEmployee::query()->with('employee','leave')->where('status','active')->latest();

        if (\request()->ajax()){
            return DataTables::of($leave_employees)
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
                ->addColumn('leave_name', function ($row){
                    $route = route('leave.show',$row->leave->id);
                    $name = $row->leave->name ?? '';
                    $leave = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Leave Show">'.$name.'</a>';
                    return $leave;
                })
                ->filterColumn('leave_name', function ($query,$keyword){
                    $leave_ids = Leave::query()->where('name','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('leave_id',$leave_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.leave.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','leave_name','action'])
                ->toJson();
        }

        return view('admin.leave.index',compact('leaves','leave_employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.leave.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:leaves,name',
        ]);

        $leave = new Leave();
        $leave->fill($request->except('_token'));
        $leave->save();

        Toastr::success('Leave Created Successfully!', 'Success');
        return redirect()->route('leave.index');
    }

    public function show(Leave $leave)
    {
        $leave = Leave::with('approvedEmployees')->find($leave->id);
        $leave_employees = LeaveEmployee::query()
                                ->with('employee','leave')
                                ->where('leave_id',$leave->id)
                                ->where('status','active')
                                ->latest();

        if (\request()->ajax()){
            return DataTables::of($leave_employees)
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
                ->addColumn('leave_name', function ($row){
                    $route = route('leave.show',$row->leave->id);
                    $name = $row->leave->name ?? '';
                    $leave = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Leave Show">'.$name.'</a>';
                    return $leave;
                })
                ->filterColumn('leave_name', function ($query,$keyword){
                    $leave_ids = Leave::query()->where('name','LIKE',"%{$keyword}%")->pluck('id');
                    $query->whereIn('leave_id',$leave_ids);
                })
                ->addColumn('duration', function ($row){
                    return DateTimeHelper::calculateDuration($row->from_date,$row->to_date);
                })
                ->addColumn('action', function ($row){
                    return view('admin.leave.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','leave_name','action'])
                ->toJson();
        }

        return view('admin.leave.view',compact('leave','leave_employees'));
    }

    public function edit(Leave $leave)
    {
        $employees = Employee::all();
        if (auth()->user()->can('Leave edit')){
            return view('admin.leave.edit',compact('leave','employees'));
        } else{
            $message = 'User does not have the permission!';
            abort(403, $message);
        }
    }

    public function update(Request $request, Leave $leave)
    {
        $this->validate($request, [
            'name' => 'required|unique:leaves,name,'.$leave->id,
        ]);

        $leave->fill($request->except('_token'));
        $leave->update();

        Toastr::success('Leave Updated Successfully!', 'Success');
        return redirect()->route('leave.index');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        Toastr::success('Leave Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('leave.index');
    }

    public function getDeletedLeave()
    {
        $leave = Leave::onlyTrashed()->get();
        return view('admin.leave.deleted_leaves',compact('leave'));
    }

    public function restore($id)
    {
        Leave::withTrashed()->findOrFail($id)->restore();

        Toastr::success('Leave Restore Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('leave.index');
    }

    public function permanentDelete($id)
    {
        Leave::withTrashed()->findOrFail($id)->forceDelete();
        Toastr::success('Leave Permanently Deleted!');
        return redirect()->route('leave.deleted');
    }

    public function getLeaveEmployeeId()
    {
        $leave_id = request()->leave_id;
        $leave = Leave::findOrFail($leave_id);
        $employees_id = $leave->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($leaveId)
    {
        $leave = Leave::findOrFail($leaveId);
        return view('admin.leave.select-employee', compact('leave'));
    }

    public function addEmployeesToLeave(Request $request){
        $request->validate([
            "leave_id" => 'required',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);
        $generated_new_name = '';

        if ($request->file != null){
            $upload_path = public_path('assets/leave');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->file->move($upload_path, $generated_new_name);
        }

        $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $memo_date = Carbon::parse($request->memo_date)->format('Y-m-d');

        foreach ($request->employees_ids as $value){
            LeaveEmployee::query()->insert([
                'employee_id' => $value,
                'leave_id' => $request->leave_id,
                'memo_no' => $request->memo_no,
                'memo_date' => $request->memo_date ? $memo_date : null,
                'from_date' => $request->from_date ? $from_date : null,
                'to_date' => $request->to_date ? $to_date : null,
                'duration' => $request->duration,
                'description' => $request->description,
                'attachment_file' => $generated_new_name,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return 'done';
    }

    public function addLeavesToEmployee(Request $request){

        $request->validate([
            "employee_id" => 'required',
            "leaves.*.id" => 'required',
            "leaves.*.from_date" => 'bail|date|required|date_format:d-m-Y',
            "leaves.*.to_date" => 'bail|date|required|date_format:d-m-Y',
            "leaves.*.memo_date" => 'bail|date|nullable|date_format:d-m-Y',
            "leaves.*.attachment" => 'nullable|max:10000|mimes:doc,docx,pdf,txt,xls,xlsx'
        ]);

        foreach ($request->leaves as $key => $leave_input){

            $generated_new_name = '';

            if (!empty($leave_input['attachment'])){
                $upload_path = public_path('assets/leave');
                $file_name = $leave_input['attachment']->getClientOriginalName();
                $generated_new_name = time() . '_' . $file_name;
                $leave_input['attachment']->move($upload_path, $generated_new_name);
            }

            $leave_input['memo_date'] = Carbon::parse($leave_input['memo_date'])->format('Y-m-d');
            $leave_input['from_date'] = Carbon::parse($leave_input['from_date'])->format('Y-m-d');
            $leave_input['to_date'] = Carbon::parse($leave_input['to_date'])->format('Y-m-d');

            LeaveEmployee::query()->insert([
                'employee_id' => $request->employee_id,
                'leave_id' => $leave_input['id'],
                'memo_no' => $leave_input['memo_no'],
                'memo_date' => $leave_input['memo_date'] ?? null,
                'from_date' => $leave_input['from_date'] ?? null,
                'to_date' => $leave_input['to_date'] ?? null,
                'duration' => $leave_input['duration'],
                'description' => $leave_input['description'],
                'attachment_file' => $generated_new_name,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Toastr::success('Leaves added to Employee', 'Success');
        DB::commit();
        return response()->json([
            'url'=> route('employee.assign',$request->employee_id)
        ]);
    }

    public function pendingEmployeesToLeave()
    {
        $pendingEmployeeLeave = DB::table('employee_leaves')
            ->join('employees','employee_leaves.employee_id','=','employees.id')
            ->join('leaves','employee_leaves.leave_id','=','leaves.id')
            ->where('employee_leaves.status','=','inactive')
            ->select('employee_leaves.*','employees.name as employee_name','employees.pin_no','employees.new_pin','leaves.name as leave_name')
            ->get();
        return view('admin.leave.pending-employee-leaves',compact('pendingEmployeeLeave'));
    }

    public function approveDenyEmployeesToLeave($employeeLeaveId, $status)
    {
        if ($status == 'approve'){
            DB::table('employee_leaves')->where('id',$employeeLeaveId)->update(['status'=>'active']);
            Toastr::success('Employees Approved to leave.');
        }elseif ($status == 'deny'){
            DB::table('employee_leaves')->where('id',$employeeLeaveId)->delete();
            Toastr::warning('Record Deleted.');
        }else{
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function removeEmployeeFromLeave($employeeLeaveId)
    {
        LeaveEmployee::query()->findOrFail($employeeLeaveId)->delete();
        Toastr::success('Employee removed from Leave.');

        return back();
    }

    public function showLeaveEmployee($pivot_id)
    {
        $pivot = LeaveEmployee::query()->findOrFail($pivot_id);
        $leave = Leave::query()->findOrFail($pivot->leave_id);
        return view('admin.leave.show_employee_leave', compact('pivot','leave'));
    }

    public function editLeaveEmployee($pivot_id)
    {
        $pivot = LeaveEmployee::query()->findOrFail($pivot_id);
        $leave = Leave::query()->findOrFail($pivot->leave_id);
        return view('admin.leave.edit_employee_leave', compact('pivot','leave'));
    }

    function attachment_file()
    {
        $fileName = LeaveEmployee::query()->findOrFail(request()->id)->get()[0]->attachment_file;
        $filePath = public_path('assets/leave/').$fileName;
        $headers = ['Content-Type: application/pdf'];
        return response()->download($filePath, $fileName, $headers);
    }

    public function updateLeaveEmployee(Request $request)
    {
        $request->validate([
            "leave_id" => 'required',
            "from_date" => 'bail|date|nullable|date_format:d-m-Y',
            "to_date" => 'bail|date|nullable|date_format:d-m-Y',
        ]);

        if (!empty($request->attachment)){
            $generated_new_name = '';
            $upload_path = public_path('assets/leave');
            $file_name = $request->attachment->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->attachment->move($upload_path, $generated_new_name);

            LeaveEmployee::query()->findOrFail($request->pivot_id)->update(['attachment_file' => $generated_new_name,]);
        }
        LeaveEmployee::query()->findOrFail($request->pivot_id)->update([
                'memo_no' => $request->memo_no,
                'memo_date' => $request->memo_date ? Carbon::parse($request->memo_date)->format('Y-m-d') : null,
                'from_date' => $request->from_date ? Carbon::parse($request->from_date)->format('Y-m-d') : null,
                'to_date' => $request->to_date ? Carbon::parse($request->to_date)->format('Y-m-d') : null,
                'duration' => $request->duration,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
        Leave::with('approvedEmployees')->findOrFail($request->leave_id);
        Toastr::success('Leave Employee information updated.');
        return redirect()->route('leave.index');
    }
}
