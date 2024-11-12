<?php

namespace App\Http\Controllers;

use App\Models\SubLocation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubLocationController extends Controller
{
    public function index()
    {
        $subLocations = SubLocation::latest()->get();
        return view('admin.sub-location.index', compact('subLocations'));
    }
    public function create()
    {
        return view('admin.sub-location.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_locations',
            'status' => 'required',
        ]);
        //  dd($request->all());
        $subLocation = new SubLocation();
        $subLocation->name = $request->name;
        $subLocation->status = $request->status;
        $subLocation->created_by = Auth::id();
        $subLocation->save();
        Toastr::success('Sub-Location Created Successfully!.', 'Success');
        return redirect()->route('sub-location.index');
    }
    public function show(SubLocation $subLocation)
    {
        //
    }
    public function edit(SubLocation $subLocation)
    {
        return view('admin.sub-location.edit',compact('subLocation'));
    }
    public function update(Request $request, SubLocation $subLocation)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_locations,name,' . $subLocation->id,
            'status' => 'required',
        ]);
        //  dd($request->all());

        $subLocation->name = $request->name;
        $subLocation->status = $request->status;
        $subLocation->updated_by = Auth::id();
        $subLocation->update();

        Toastr::success('Sub-Location Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('sub-location.index');
    }
    public function destroy(SubLocation $subLocation)
    {
        $subLocation->delete();
        \Toastr::success('Sub-Location Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('sub-location.index');
    }
    public function getDeletedSubLocation()
    {
        $subLocation = SubLocation::onlyTrashed()->get();
        return view('admin.location.deleted_sub_location',compact('subLocation'));
    }
    public function restore($id)
    {
        $subLocation = SubLocation::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Sub-Location Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('sub-location.index');
    }

    public function permanentDelete($id)
    {
        $subLocation = SubLocation::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Sub-Location Permanently Deleted!.');
        return redirect()->route('sub-location.deleted');
    }
}
