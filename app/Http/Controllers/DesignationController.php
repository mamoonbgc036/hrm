<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DesignationController extends Controller
{

    public function all()
    {
        $designations = Designation::all();
        return response()->json($designations);
    }

    public function index()
    {
        $designations = Designation::orderBy('id', 'DESC')->get();
        return view('admin.designation.index', compact('designations'));
    }


    public function create()
    {
        return view('admin.designation.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'en_name' => 'required|unique:designations',
            'bn_name' => 'nullable|unique:designations',
            'status' => 'required',
        ]);

        $designation = new Designation();
        $designation->fill(\request()->all());
        $designation->save();
        Toastr::success('Designation Created Successfully!.', 'Success');
        return redirect()->route('designation.index');
    }

    public function edit(Designation $designation)
    {
        return view('admin.designation.edit', compact('designation'));
    }


    public function update(Request $request, Designation $designation)
    {
        $this->validate($request, [
            'en_name' => 'required|unique:designations,en_name,' . $designation->id,
            'bn_name' => 'nullable|unique:designations,bn_name,' . $designation->id,
            'status' => 'required',
        ]);
        $designation->fill(\request()->all());
        $designation->update();
        Toastr::success('Designation Updated Successfully!.', 'Success');
        return redirect()->route('designation.index');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();
        \Toastr::success('Designation Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('designation.index');
    }
    public function getDeletedDesignation()
    {
        $designation = Designation::onlyTrashed()->get();
        return view('admin.designation.deleted_designation', compact('designation'));
    }
    public function restore($id)
    {
        $designation = Designation::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Designation Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('designation.index');
    }
    public function permanentDelete($id)
    {
        $designation = Quota::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Designation Permanently Deleted!.');
        return redirect()->route('designation.deleted');
    }
}
