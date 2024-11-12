<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();
        return view('admin.location.index', compact('locations'));
    }
    public function create()
    {
        return view('admin.location.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:locations',
            'status' => 'required',
        ]);
        //  dd($request->all());
        $location = new Location();
        $location->name = $request->name;
        $location->status = $request->status;
        $location->created_by = Auth::id();
        $location->save();
        Toastr::success('Location Created Successfully!.', 'Success');
        return redirect()->route('location.index');
    }
    public function show(Location $location)
    {
        //
    }
    public function edit(Location $location)
    {
        return view('admin.location.edit',compact('location'));
    }
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            'name' => 'required|unique:locations,name,' . $location->id,
            'status' => 'required',
        ]);
        //  dd($request->all());

        $location->name = $request->name;
        $location->status = $request->status;
        $location->updated_by = Auth::id();
        $location->update();

        Toastr::success('Location Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('location.index');
    }
    public function destroy(Location $location)
    {
        $location->delete();
        \Toastr::success('Location Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('location.index');
    }
    public function getDeletedLocation()
    {
        $locations = Location::onlyTrashed()->get();
        return view('admin.location.deleted_location',compact('locations'));
    }
    public function restore($id)
    {
        $location = Location::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Location Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('location.index');
    }

    public function permanentDelete($id)
    {
        $location = Location::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Location Permanently Deleted!.');
        return redirect()->route('location.deleted');
    }
}
