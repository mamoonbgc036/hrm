<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AchievementEmployee;
use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::with('employees')->latest()->get();
        $achievement_employees = AchievementEmployee::query()->with('employee','achievement')->where('status','active')->latest();

        if (\request()->ajax()){
            return DataTables::of($achievement_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row){
                    $route = route('employee.show',$row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
                    return $employee;
                })
                ->addColumn('achievement_name', function ($row){
                    $route = route('achievement.show',$row->achievement->id);
                    $name = $row->achievement->achievement_name ?? '';
                    $achievement = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Award Show">'.$name.'</a>';
                    return $achievement;
                })
                ->filterColumn('memo_date', function ($query,$keyword){
                    $data = explode('-',$keyword);
                    if(count($data) == 2){
                        $keyword = $data[1].'-'.$data[0];
                    }elseif (count($data) == 3){
                        $keyword = $data[2].'-'.$data[1].'-'.$data[0];
                    }

                    $query->where('memo_date','LIKE', "%{$keyword}%");
                })
                ->addColumn('action', function ($row){
                    return view('admin.achievement.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','achievement_name','action'])
                ->toJson();
        }

        return view('admin.achievement.index',compact('achievements','achievement_employees'));
    }

    public function create()
    {
        return view('admin.achievement.create');
    }

    public function store(Request $request)
    {
        $this->validate($request ,[
            'achievement_name' => 'required|unique:achievements',
        ]);

        $achievement = new Achievement();
        $achievement->hr_achievement_number();
        $achievement->achievement_name = $request->achievement_name;
        $achievement->created_by_id = Auth::id();
        $achievement->created_by = Auth::user()->name;
        $achievement->hr_id;
        $achievement->save();

        Toastr::success('Achievement Created Successfully!.', 'Success');
        return redirect()->route('achievement.index');
    }

    public function show($id)
    {
        $achievement = Achievement::with('approvedEmployees')->findOrFail($id);
        $achievement_employees = AchievementEmployee::query()
                                    ->with('employee','achievement')
                                    ->where('achievement_id',$id)
                                    ->where('status','active')
                                    ->latest();

        if (\request()->ajax()){
            return DataTables::of($achievement_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row){
                    $route = route('employee.show',$row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
                    return $employee;
                })
                ->addColumn('achievement_name', function ($row){
                    $route = route('achievement.show',$row->achievement->id);
                    $name = $row->achievement->achievement_name ?? '';
                    $achievement = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Award Show">'.$name.'</a>';
                    return $achievement;
                })
                ->addColumn('date_of_achievement', function ($row){
                    return @$row->created_at ? \Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y h:i:s A') : '';
                })
                ->addColumn('action', function ($row){
                    return view('admin.achievement.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','achievement_name','action'])
                ->toJson();
        }

        return view('admin.achievement.view',compact('achievement','achievement_employees'));
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievement.edit',compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'achievement_name' => 'required|unique:achievements,achievement_name,'.$achievement->id,
        ]);
        $achievement->achievement_name = $request->achievement_name;
        $achievement->last_updated_by_id = Auth::id();
        $achievement->last_updated_by = Auth::user()->name;
        $achievement->update();

        Toastr::success('Achievement Updated Successfully!.', 'Success');
        return redirect()->route('achievement.index');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        \Toastr::success('Achievement Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('achievement.index');
    }

    public function getDeletedAchievement()
    {
        $achievements = Achievement::onlyTrashed()->get();
        return view('admin.achievement.deleted_achievement',compact('achievements'));
    }
    public function restore($id)
    {
        Achievement::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Achievement Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('achievement.deleted');
    }
    public function permanentDelete($id)
    {
        Achievement::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Achievement Permanently Deleted!.');
        return redirect()->route('achievement.deleted');
    }

    public function getAchievementEmployeeId()
    {
        $achievement_id = request()->achievement_id;
        $achievement = Achievement::findOrFail($achievement_id);
        $employees_id = $achievement->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($achievementId)
    {
        $achievement = Achievement::findOrFail($achievementId);
        return view('admin.achievement.select-employee', compact('achievement'));
    }

    public function setAchievement()
    {
        $achievement = Achievement::findOrFail(request('achievement_id'));
        $employee = Employee::findOrFail(request('employee_id'));
        $achievements = Achievement::all();
        return view('admin.achievement.set-achievement', compact('employee','achievements'));
    }

    public function addEmployeesToAchievement(Request $request){

        $request->validate([
            "memo_date" => 'nullable|date|date_format:d-m-Y',
            "date" => 'nullable|date|date_format:d-m-Y',

        ]);
        $generated_new_name = '';
        if ($request->file != null){
            $upload_path = public_path('assets/achievement');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->file->move($upload_path, $generated_new_name);
        }

        $memo_date = Carbon::parse($request->memo_date)->format('Y-m-d');
        $date = Carbon::parse($request->date)->format('Y-m-d');
        foreach ($request->employees_ids as $value) {
            AchievementEmployee::query()->insert([
                'employee_id' => $value,
                'achievement_id' => $request->achievement_id,
                'memo_no' => $request->memo_no,
                'memo_date' => $request->memo_date ? $memo_date : null,
                'date' => $request->date ? $date : null,
                'issue_authorities' => $request->issue_authorities,
                'description' => $request->description,
                'attachment_file' => $generated_new_name,
                'created_by_id' => Auth::id(),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return 'done';
    }

    public function pendingEmployeesToAchievement()
    {
        $pendingEmployeeAchievement = DB::table('achievement_employee')
            ->join('employees','achievement_employee.employee_id','=','employees.id')
            ->join('achievements','achievement_employee.achievement_id','=','achievements.id')
            ->where('achievement_employee.status','=','inactive')
            ->select('achievement_employee.*','employees.name','employees.pin_no','employees.new_pin','achievements.achievement_name')
            ->get();
        return view('admin.achievement.pending-employee-achievements',compact('pendingEmployeeAchievement'));
    }

    public function approveDenyEmployeesToAchievement($achievementId, $status)
    {
        if ($status == 'approve'){
            DB::table('achievement_employee')->where('id',$achievementId)->update(['status'=>'active']);
            Toastr::success('Employees Approved to achievement.');
        }elseif ($status == 'deny'){
            DB::table('achievement_employee')->where('id',$achievementId)->delete();
            Toastr::warning('Achievement denied.');
        }else{
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function deleteAchievementEmployee($achievementId,$employeeId)
    {
        Achievement::findOrFail($achievementId)->employees()->detach($employeeId);
        Toastr::success('Employee deleted from Achievement.');
        return back();
    }

    public function showAchievementEmployee($achievement_id,$employee_id)
    {
        $achievement = Achievement::findOrFail($achievement_id);
        $pivot = DB::table('achievement_employee')
            ->where('achievement_id',$achievement_id)
            ->where('employee_id',$employee_id)
            ->select('*')
            ->first();
        return view('admin.achievement.show_achievement_employee', compact('pivot','achievement'));
    }

    public function editAchievementEmployee($achievement_id,$employee_id)
    {
        $achievement = Achievement::findOrFail($achievement_id);
        $pivot = AchievementEmployee::query()
            ->where('achievement_id',$achievement_id)
            ->where('employee_id',$employee_id)
            ->select('*')
            ->first();
        return view('admin.achievement.edit_achievement_employee', compact('pivot','achievement'));
    }

    function attachment_file()
    {
        $fileName = AchievementEmployee::query()->findOrFail(request()->id)->get()[0]->attachment_file;
        $filePath = public_path('assets/achievement/').$fileName;
        $headers = ['Content-Type: application/pdf'];
        return response()->download($filePath, $fileName, $headers);
    }

    public function updateAchievementEmployee(Request $request)
    {
        $request->validate([
            "memo_date" => 'nullable|date|date_format:d-m-Y',
            "date" => 'nullable|date|date_format:d-m-Y',
        ]);

        $generated_new_name = '';
        if (!empty($request->attachment)){
            $upload_path = public_path('assets/achievement');
            $file_name = $request->attachment->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->attachment->move($upload_path, $generated_new_name);

            AchievementEmployee::query()
                ->findOrFail($request->pivot_id)
                ->update([
                    'attachment_file' => $generated_new_name,
                ]);
        }

        AchievementEmployee::query()
            ->findOrFail($request->pivot_id)
            ->update([
                'memo_no' => $request->memo_no,
                'memo_date' => $request->memo_date ? Carbon::parse($request->memo_date)->format('Y-m-d') : null,
                'date' => $request->date ? Carbon::parse($request->date)->format('Y-m-d') : null,
                'issue_authorities' => $request->issue_authorities,
                'description' => $request->description,
                'updated_at' => now(),
            ]);
        Achievement::with('approvedEmployees')->findOrFail($request->achievement_id);
        Toastr::success('Achievement given employee information updated.');
        return redirect()->route('achievement.index');
    }
}
