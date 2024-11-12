<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstituteController extends Controller
{
    public function index()
    {
        $institutes = Institute::latest()->get();
        return view('admin.education.institute.index', compact('institutes'));
    }

    public function create()
    {
        return view('admin.education.institute.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:institutes',
            'type' => 'required',
        ]);
        //  dd($request->all());
        $institute = new Institute();
        $institute->name = $request->name;
        $institute->type = $request->type;
        $institute->created_by = Auth::id();
        $institute->save();
        Toastr::success('Institute Created Successfully!', 'Success');
        return redirect()->route('institute.index');
    }

    public function show(Institute $institute)
    {
        //
    }

    public function edit(Institute $institute)
    {
        return view('admin.education.institute.edit',compact('institute'));
    }

    public function update(Request $request, Institute $institute)
    {
        $this->validate($request, [
            'name' => 'required|unique:institutes,name,' . $institute->id,
            'type' => 'required',
        ]);
        //  dd($request->all());

        $institute->name = $request->name;
        $institute->type = $request->type;
        $institute->updated_by = Auth::id();
        $institute->update();

        Toastr::success('Institute Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('institute.index');
    }

    public function destroy(Institute $institute)
    {
        $institute->delete();
        \Toastr::success('Institute Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('institute.index');
    }
}
