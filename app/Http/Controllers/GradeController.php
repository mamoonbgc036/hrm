<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Salary_template;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function find($id)
    {
        $grade_specify_salary = Salary_template::where('grade_id', $id)->first();
        return response()->json($grade_specify_salary);
    }

    public function all()
    {
        $salaries = Salary_template::all();
        return response()->json($salaries);
    }
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grade.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.grade.create');
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
            'grade' => 'required|unique:grades,grade',
            'status' => 'required',
        ]);
        $grade = new Grade;
        $grade->grade = $request->grade;
        $grade->status = $request->status;
        $grade->save();

        Toastr::success('Grade Created Successfully', 'Success');
        return redirect()->route('grade.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view('admin.grade.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //return $request->all();
        $request->validate([
            'grade' => 'required|unique:grades,grade,' . $grade->id,
            'status' => 'required',
        ]);

        $grade->grade = $request->grade;
        $grade->status = $request->status;
        $grade->update();

        Toastr::success('grade updated successfully', 'Success');
        return redirect()->route('grade.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        Toastr::success('Grade deleted successfully', 'Success');
        return redirect()->back();
    }
    public function getDeletedGrade()
    {
        $grades = Grade::onlyTrashed()->get();
        return view('admin.grade.deleted_grade', compact('grades'));
    }
    public function restore($id)
    {
        $grade = Grade::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Grade Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('grade.deleted');
    }
    public function permanentDelete($id)
    {
        $grade = Grade::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Grade Permanently Deleted!.');
        return redirect()->route('grade.deleted');
    }
}
