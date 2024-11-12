<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    public function all()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function index()
    {
        $departments = Department::latest()->get();
        return view('admin.department.index', compact('departments'));
    }
    public function create()
    {
        return view('admin.department.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments',
            'status' => 'required',
        ]);
      //  dd($request->all());
        $department = new Department();
        $department->name = $request->name;
        $department->bn_name = $request->bn_name;
        $department->bn_name = $request->bn_name;
        $department->status = $request->status;
        $department->created_by = Auth::id();
        $department->save();
        Toastr::success('Department Created Successfully!.', 'Success');
        return redirect()->route('department.index');
    }
    public function show(Department $department)
    {
        //
    }
    public function edit(Department $department)
    {
        return view('admin.department.edit',compact('department'));
    }
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments,name,' . $department->id,
            'status' => 'required',
        ]);
        //  dd($request->all());

        $department->name = $request->name;
        $department->bn_name = $request->bn_name;
        $department->status = $request->status;
        $department->updated_by = Auth::id();
        $department->update();

        Toastr::success('Department Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('department.index');
    }
    public function destroy(Department $department)
    {
        $department->delete();
        \Toastr::success('Department Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('department.index');
    }
    public function getDeletedDepartment()
    {
        $departments = Department::onlyTrashed()->get();
        return view('admin.department.deleted_department',compact('departments'));
    }
    public function restore($id)
    {
        $department = Department::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Department Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('department.index');
    }

    public function permanentDelete($id)
    {
        $department = Department::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Department Permanently Deleted!.');
        return redirect()->route('department.deleted');
    }
}
