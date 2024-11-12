<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\AwardEmployee;
use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::with('employees')->latest()->get();
        $awarded_employees = AwardEmployee::query()->with('employee','award')->where('status','active')->latest()->get();
        // dd($awarded_employees->get()->toArray());
        // if (\request()->ajax()){
        //     return DataTables::of($awarded_employees)
        //         ->addIndexColumn()
        //         ->addColumn('employee_name', function ($row){
        //             $route = route('employee.show',$row->employee->id);
        //             $name = $row->employee->name ?? '';
        //             $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
        //             return $employee;
        //         })
        //         ->addColumn('award_name', function ($row){
        //             $route = route('award.show',$row->award->id);
        //             $name = $row->award->award_name ?? '';
        //             $award = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Award Show">'.$name.'</a>';
        //             return $award;
        //         })
        //         ->filterColumn('memo_date', function ($query,$keyword){
        //             $data = explode('-',$keyword);
        //             if(count($data) == 2){
        //                 $keyword = $data[1].'-'.$data[0];
        //             }elseif (count($data) == 3){
        //                 $keyword = $data[2].'-'.$data[1].'-'.$data[0];
        //             }

        //             $query->where('memo_date','LIKE', "%{$keyword}%");
        //         })
        //         ->addColumn('action', function ($row){
        //             return view('admin.award.action-button', compact('row'));
        //         })
        //         ->rawColumns(['employee_name','award_name','action'])
        //         ->toJson();
        // }
        $awardedData = $awarded_employees->map(function($awarded_employees) {
            return [
                'pin_no' => $awarded_employees->employee->pin_no??null,
                'name' => $awarded_employees->employee->name??null,
                'date' => $awarded_employees->memo_date ? $awarded_employees->memo_date->format('Y-m-d') : '',
                'description' => $awarded_employees->description??null,
                'award_name' => $awarded_employees->award->award_name??null,
                'achievement_name' => $awarded_employees->award_name->achievement_name??null,
            ];
        });
        
        if (request()->ajax()) {
            if (request()->header('X-Requested-By') == 'DataTables' || (request()->has('draw') && request()->has('columns'))) {
                // This is a DataTables request
                return DataTables::of($awardedData)
                    ->addIndexColumn()
                    ->toJson();
            } else {
                // This is a normal AJAX request
                return response()->json(['message' => 'This is a normal AJAX request']);
            }
        }

        return view('admin.award.index',compact('awards','awarded_employees'));
    }

    public function create()
    {
        return view('admin.award.create');
    }

    public function store(Request $request)
    {
        $this->validate($request ,[
            'award_name' => 'required|unique:awards',
        ]);

        $award = new Award();
        $award->hr_award_number();
        $award->award_name = $request->award_name;
        $award->created_by_id = Auth::id();
        $award->created_by = Auth::user()->name;
        $award->save();

        Toastr::success('Award Created Successfully!.', 'Success');
        return redirect()->route('award.index');
    }

    public function show($id)
    {
        $award = Award::with('approvedEmployees')->findOrFail($id);
        $awarded_employees = AwardEmployee::query()
                                ->with('employee','award')
                                ->where('award_id',$id)
                                ->where('status','active')
                                ->latest();

        if (\request()->ajax()){
            return DataTables::of($awarded_employees)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row){
                    $route = route('employee.show',$row->employee->id);
                    $name = $row->employee->name ?? '';
                    $employee = '<a class="alert-link" href="'.$route.'" data-toggle="tooltip" title="Employee Show">'.$name.'</a>';
                    return $employee;
                })
                ->addColumn('award_name', function ($row){
                    $route = route('award.show',$row->award->id);
                    $name = $row->award->award_name ?? '';
                    $award = '<a class="text-success alert-link" href="'.$route.'" data-toggle="tooltip" title="Award Show">'.$name.'</a>';
                    return $award;
                })
                ->addColumn('date_of_award', function ($row){
                    return @$row->created_at ? \Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y h:i:s A') : '';
                })
                ->addColumn('action', function ($row){
                    return view('admin.award.action-button', compact('row'));
                })
                ->rawColumns(['employee_name','award_name','action'])
                ->toJson();
        }

        return view('admin.award.view',compact('award','awarded_employees'));
    }

    public function edit(Award $award)
    {
        return view('admin.award.edit',compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $request->validate([
            'award_name' => 'required|unique:awards,award_name,'.$award->id,
        ]);
        $award->award_name = $request->award_name;
        $award->last_updated_by_id = Auth::id();
        $award->last_updated_by = Auth::user()->name;
        $award->update();

        Toastr::success('Award Updated Successfully!.', 'Success');
        return redirect()->route('award.index');
    }

    public function destroy(Award $award)
    {
        $award->delete();
        \Toastr::success('Award Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('award.index');
    }

    public function getDeletedAward()
    {
        $awards = Award::onlyTrashed()->get();
        return view('admin.award.deleted_award',compact('awards'));
    }
    public function restore($id)
    {
        $award = Award::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Award Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('award.deleted');
    }
    public function permanentDelete($id)
    {
        $award = Award::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Award Permanently Deleted!.');
        return redirect()->route('award.deleted');
    }

    public function getAwardedEmployeeId()
    {
        $award_id = request()->award_id;
        $award = Award::findOrFail($award_id);
        $employees_id = $award->employees->pluck('id');
        return response()->json($employees_id);
    }

    public function selectEmployee($awardId)
    {
        $award = Award::findOrFail($awardId);
        return view('admin.award.select-employee', compact('award'));
    }

    public function setAward()
    {
        $award = Award::findOrFail(request('award_id'));
        $employee = Employee::findOrFail(request('employee_id'));
        $awards = Award::all();
        return view('admin.award.set-award', compact('award','employee','awards'));
    }

    public function addEmployeesToAward(Request $request){

        $request->validate([
            "memo_date" => 'nullable|date|date_format:d-m-Y',
            "date" => 'nullable|date|date_format:d-m-Y',

        ]);
        $generated_new_name = '';
        if ($request->file != null){
            $upload_path = public_path('assets/award');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->file->move($upload_path, $generated_new_name);
        }

        $memo_date = Carbon::parse($request->memo_date)->format('Y-m-d');
        $date = Carbon::parse($request->date)->format('Y-m-d');
        foreach ($request->employees_ids as $value) {
            DB::table('employee_awards')->insert([
                'employee_id' => $value,
                'award_id' => $request->award_id,
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

    public function pendingEmployeesToAward()
    {
        $pendingEmployeeAward = DB::table('employee_awards')
                                    ->join('employees','employee_awards.employee_id','=','employees.id')
                                    ->join('awards','employee_awards.award_id','=','awards.id')
                                    ->where('employee_awards.status','=','inactive')
                                    ->select('employee_awards.*','employees.name','employees.pin_no','employees.new_pin','awards.award_name')
                                    ->get();
        return view('admin.award.pending-employee-awards',compact('pendingEmployeeAward'));
    }

    public function approveDenyEmployeesToAward($awardId, $status)
    {
        if ($status == 'approve'){
            DB::table('employee_awards')->where('id',$awardId)->update(['status'=>'active']);
            Toastr::success('Employees Approved to award.');
        }elseif ($status == 'deny'){
            DB::table('employee_awards')->where('id',$awardId)->delete();
            Toastr::warning('Record Deleted.');
        }else{
            Toastr::error('Something went wrong!');
        }

        return back();
    }

    public function deleteAwardedEmployee($awardId,$employeeId)
    {
        Award::findOrFail($awardId)->employees()->detach($employeeId);
        Toastr::success('Employee deleted from award.');
        return back();
    }

    public function showAwardedEmployee($award_id,$employee_id)
    {
        $award = Award::findOrFail($award_id);
        $pivot = DB::table('employee_awards')
                        ->where('award_id',$award_id)
                        ->where('employee_id',$employee_id)
                        ->select('*')
                        ->first();
        return view('admin.award.show_awarded_employee', compact('pivot','award'));
    }

    public function editAwardedEmployee($award_id,$employee_id)
    {
        $award = Award::findOrFail($award_id);
        $pivot = DB::table('employee_awards')
                        ->where('award_id',$award_id)
                        ->where('employee_id',$employee_id)
                        ->select('*')
                        ->first();
        return view('admin.award.edit_awarded_employee', compact('pivot','award'));
    }

    function attachment_file()
    {
        $fileName = DB::table('employee_awards')
                        ->where('id',request()->id)->get()[0]->attachment_file;
        $filePath = public_path('assets/award/').$fileName;
        $headers = ['Content-Type: application/pdf'];
        return response()->download($filePath, $fileName, $headers);
    }

    public function updateAwardedEmployee(Request $request)
    {
        $request->validate([
            "memo_date" => 'nullable|date|date_format:d-m-Y',
            "date" => 'nullable|date|date_format:d-m-Y',
        ]);

        $generated_new_name = '';
        if (!empty($request->attachment)){
            $upload_path = public_path('assets/award');
            $file_name = $request->attachment->getClientOriginalName();
            $generated_new_name = time() . '_' . $file_name;
            $request->attachment->move($upload_path, $generated_new_name);

            AwardEmployee::query()->findOrFail($request->pivot_id)->update(['attachment_file' => $generated_new_name,]);
        }
        AwardEmployee::query()->findOrFail($request->pivot_id)->update([
            'memo_no' => $request->memo_no,
            'memo_date' => $request->memo_date ? Carbon::parse($request->memo_date)->format('Y-m-d') : null,
            'date' => $request->date ? Carbon::parse($request->date)->format('Y-m-d') : null,
            'issue_authorities' => $request->issue_authorities,
            'description' => $request->description,
            'updated_at' => now(),
        ]);
        Award::with('approvedEmployees')->findOrFail($request->award_id);
        Toastr::success('Awarded Employee information updated.');
        return redirect()->route('award.index');
    }
}
