<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::latest()->get();
        return view('admin.disease.index', compact('diseases'));
    }
    public function create()
    {
        return view('admin.disease.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:diseases',
            'status' => 'required',
        ]);
        //  dd($request->all());
        $disease = new Disease();
        $disease->name = $request->name;
        $disease->status = $request->status;
        $disease->created_by = Auth::id();
        $disease->save();
        Toastr::success('Disease Created Successfully!.', 'Success');
        return redirect()->route('disease.index');
    }
    public function show(Disease $disease)
    {
        //
    }
    public function edit(Disease $disease)
    {
        return view('admin.disease.edit',compact('disease'));
    }
    public function update(Request $request, Disease $disease)
    {
        $this->validate($request, [
            'name' => 'required|unique:diseases,name,' . $disease->id,
            'status' => 'required',
        ]);
        //  dd($request->all());

        $disease->name = $request->name;
        $disease->status = $request->status;
        $disease->updated_by = Auth::id();
        $disease->update();

        Toastr::success('Disease Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('disease.index');
    }
    public function destroy(Disease $disease)
    {
        $disease->delete();
        \Toastr::success('Disease Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('disease.index');
    }
    public function getDeletedDisease()
    {
        $diseases = Disease::onlyTrashed()->get();
        return view('admin.disease.deleted_disease',compact('diseases'));
    }
    public function restore($id)
    {
        $disease = Disease::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Disease Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('disease.index');
    }

    public function permanentDelete($id)
    {
        $disease = Disease::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Disease Permanently Deleted!.');
        return redirect()->route('disease.deleted');
    }
}
