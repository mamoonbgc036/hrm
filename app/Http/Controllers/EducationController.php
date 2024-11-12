<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $education= Education::all();
        return view('admin.education.index',compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',

        ]);
        $education = new Education();
        $education->title = $request->title;
        $education->save();

        Toastr::success('Education Created Successfully','Success');
        return redirect()->route('education.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        return view('admin.education.edit',compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        $request->validate([
            'title' => 'required|unique:education,title,'.$education->id,
        ]);

        $education->title = $request->title;
        $education->update();

        Toastr::success('Education updated successfully','Success');
        return redirect()->route('education.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $education->delete();
        Toastr::success('Education deleted successfully','Success');
        return redirect()->back();
    }
    public function getDeletedEducation()
    {
        $education = Education::onlyTrashed()->get();
        return view('admin.education.deleted_education',compact('education'));
    }
    public function restore($id)
    {
        $education = Education::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Education Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('education.deleted');
    }
    public function permanentDelete($id)
    {
        $education = Education::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Education Permanently Deleted!.');
        return redirect()->route('education.deleted');
    }


}
