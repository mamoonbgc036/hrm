<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SubDepartment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{

    public function index()
    {
        $subDepartments = SubDepartment::with('department')->orderBy('id', 'DESC')->get();
//        dd($subDepartments);
        return view('admin.subdepartment.index', compact('subDepartments'));
    }


    public function create()
    {
        $departments = Department::orderBy('id', 'DESC')->get();
        return view('admin.subdepartment.create',compact('departments'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'department_id'=>'required',
            'status' => 'required',
        ]);
//         dd($request->all());
        $subDepartment = new SubDepartment();
        $subDepartment->department_id = $request->department_id;
        $subDepartment->name = $request->name;
        $subDepartment->status = $request->status;
        $subDepartment->save();
        Toastr::success('Sub Department Created Successfully!.', 'Success');
        return redirect()->route('sub-department.index');
    }


    public function show(SubDepartment $subDepartment)
    {
        //
    }


    public function edit(SubDepartment $subDepartment)

    {

        $departments = Department::orderBy('id', 'DESC')->get();
        return view('admin.subdepartment.edit',compact('subDepartment','departments'));
    }


    public function update(Request $request, SubDepartment $subDepartment)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments,name,' . $subDepartment->id,
            'status' => 'required',
        ]);
        //  dd($request->all());

        $subDepartment->name = $request->name;
        $subDepartment->department_id = $request->department_id;
        $subDepartment->status = $request->status;
        $subDepartment->save();
        Toastr::success(' Sub Department Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('sub-department.index');
    }


    public function destroy(SubDepartment $subDepartment)
    {
        $subDepartment->delete();
        \Toastr::success('Sub Department Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('sub-department.index');
    }
    public function getDeletedSubDepartment()
    {
        $subDepartment = SubDepartment::onlyTrashed()->get();
        return view('admin.subdepartment.deleted_subdepartment',compact('subDepartment'));
    }
    public function restore($id)
    {
        $subDepartment = SubDepartment::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Sub-Department Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('sub-department.index');
    }
    public function permanentDelete($id)
    {
        $subDepartment = SubDepartment::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Sub-Department Permanently Deleted!.');
        return redirect()->route('sub-department.deleted');
    }
}
