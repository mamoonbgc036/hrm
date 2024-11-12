<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function index()
    {
        // Upazilas data loaded from AppServiceProvider::boot method
        return view('admin.upazila.index');
    }

    public function create()
    {
        return view('admin.upazila.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'district_id' => 'required|integer',
            'bn_name' => 'required|unique:upazilas',
            'name' => 'required|unique:upazilas',
        ]);

        $upazila = new Upazila();
        $upazila->district_id = $request->district_id;
        $upazila->name = $request->name;
        $upazila->bn_name = $request->bn_name;
        $upazila->url = $request->url;
        $upazila->save();
        Toastr::success('Upazila Created Successfully!', 'Success');
        return redirect()->route('upazila.index');
    }

    public function show(Upazila $upazila)
    {
        //
    }

    public function edit(Upazila $upazila)
    {
        return view('admin.upazila.edit', compact('upazila'));
    }

    public function update(Request $request, Upazila $upazila)
    {
        $this->validate($request, [
            'district_id' => 'required|integer',
            'bn_name' => 'required|unique:upazilas,bn_name,' . $upazila->id,
            'name' => 'required|unique:upazilas,name,' . $upazila->id,
        ]);

        $upazila->district_id = $request->district_id;
        $upazila->name = $request->name;
        $upazila->bn_name = $request->bn_name;
        $upazila->url = $request->url;
        $upazila->update();

        Toastr::success('Upazila Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('upazila.index');
    }

    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        \Toastr::success('Upazila Deleted Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('upazila.index');
    }
    public function getDeletedUpazila()
    {
        $deleted_upazilas = Upazila::onlyTrashed()->get();
        return view('admin.upazila.deleted', compact('deleted_upazilas'));
    }
    public function restore($id)
    {
        $upazila = Upazila::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Upazila Restored Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('upazila.index');
    }

    public function permanentDelete($id)
    {
        $upazila = Upazila::withTrashed()->findOrFail($id)->forceDelete();

        \Toastr::success('Upazila Permanently Deleted!');
        return redirect()->route('upazila.deleted');
    }
}
