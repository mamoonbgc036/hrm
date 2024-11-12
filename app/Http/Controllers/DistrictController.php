<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Station;
use App\Models\Upazila;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        // Districts data loaded from AppServiceProvider::boot method
        return view('admin.district.index');
    }

    public function get_district($id)
    {
        $districts = District::where('division_id', $id)->get();
        return response()->json($districts);
    }

    public function get_thana($id)
    {
        // $thanas = Upazila::where('district_id', $id)->get();
        $thanas = Station::with('district', 'division')->findOrFail($id);
        return response()->json($thanas);
    }

    public function all_thanas($id)
    {
        $thanas = Upazila::where('district_id', $id)->get();
        logger($thanas->toArray());
        return response()->json($thanas);
    }

    public function create()
    {
        return view('admin.district.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'division_id' => 'required|integer',
            'bn_name' => 'required|unique:districts',
            'name' => 'required|unique:districts',
        ]);

        $district = new District();
        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->bn_name = $request->bn_name;
        $district->url = $request->url;
        $district->save();
        Toastr::success('District Created Successfully!', 'Success');
        return redirect()->route('district.index');
    }

    public function show(District $district)
    {
        //
    }

    public function edit(District $district)
    {
        return view('admin.district.edit', compact('district'));
    }

    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'division_id' => 'required|integer',
            'bn_name' => 'required|unique:districts,bn_name,' . $district->id,
            'name' => 'required|unique:districts,name,' . $district->id,
        ]);

        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->bn_name = $request->bn_name;
        $district->url = $request->url;
        $district->update();

        Toastr::success('District Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('district.index');
    }

    public function destroy(District $district)
    {
        $district->delete();
        \Toastr::success('District Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('district.index');
    }
    public function getDeletedDistrict()
    {
        $deleted_districts = District::onlyTrashed()->get();
        return view('admin.district.deleted', compact('deleted_districts'));
    }
    public function restore($id)
    {
        $district = District::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('District Restored Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('district.index');
    }

    public function permanentDelete($id)
    {
        $district = District::withTrashed()->findOrFail($id)->forceDelete();

        \Toastr::success('District Permanently Deleted!');
        return redirect()->route('district.deleted');
    }
}
