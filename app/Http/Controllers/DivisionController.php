<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index()
    {
        // Divisions data loaded from AppServiceProvider::boot method
        return view('admin.division.index');
    }

    public function create()
    {
        return view('admin.division.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bn_name' => 'required|unique:divisions',
            'name' => 'required|unique:divisions',
        ]);

        $division = new Division();
        $division->name = $request->name;
        $division->bn_name = $request->bn_name;
        $division->url = $request->url;
        $division->save();
        Toastr::success('Division Created Successfully!', 'Success');
        return redirect()->route('division.index');
    }

    public function show(Division $division)
    {
        //
    }

    public function edit(Division $division)
    {
        return view('admin.division.edit',compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $this->validate($request, [
            'bn_name' => 'required|unique:divisions,bn_name,' . $division->id,
            'name' => 'required|unique:divisions,name,' . $division->id,
        ]);

        $division->name = $request->name;
        $division->bn_name = $request->bn_name;
        $division->url = $request->url;
        $division->update();

        Toastr::success('Division Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('division.index');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        \Toastr::success('Division Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('division.index');
    }
    public function getDeletedDivision()
    {
        $deleted_divisions = Division::onlyTrashed()->get();
        return view('admin.division.deleted',compact('deleted_divisions'));
    }
    public function restore($id)
    {
        $division = Division::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Division Restored Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('division.index');
    }

    public function permanentDelete($id)
    {
        $division = Division::withTrashed()->findOrFail($id)->forceDelete();

        \Toastr::success('Division Permanently Deleted!');
        return redirect()->route('division.deleted');
    }
}
