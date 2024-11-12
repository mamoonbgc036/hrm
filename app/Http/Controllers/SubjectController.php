<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->get();
        return view('admin.education.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.education.subject.create');
    }

    public function store(Request $request)
    {
        $request->all();

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->created_by = Auth::id();
        $subject->save();
        Toastr::success('Subject Created Successfully!', 'Success');
        return redirect()->route('subject.index');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $subject)
    {
        return view('admin.education.subject.edit',compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name' => 'required|unique:subjects,name,' . $subject->id,
            'type' => 'required',
        ]);
        //  dd($request->all());

        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->updated_by = Auth::id();
        $subject->update();

        Toastr::success('Subject Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('subject.index');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        \Toastr::success('Subject Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('subject.index');
    }
}
