<?php
namespace App\Http\Controllers;
use App\Models\EducationalQualification;
use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EducationalQualificationController extends Controller
{
    public function index()
    {
        $educations = EducationalQualification::with('employee')->latest()->get();
        return view('admin.education_qualification.index',compact('educations'));
    }
    public function create()
    {
        $employees = Employee::all();
        return view('admin.education_qualification.create',compact('employees'));
    }
    public function store(Request $request)
    {
//        return $request->all();
        $this->validate($request ,[
//            'employee_id' => 'required',
            'degree'=>'required',
            'year' =>'required',
            'gpa'=>'required',
            'subject_name'=>'required',
            'board'=>'required',
        ]);

        /*dd($request->all());*/
        $educations = new EducationalQualification();
        $educations->fill($request->all());
        $educations->save();
        Toastr::success('Educational Qualification Created Successfully!.', 'Success');
        //return redirect()->route('educational-qualification.index');
        return redirect()->route('employee.edit',$request->employee_id);
    }


    public function edit(EducationalQualification $educationalQualification)
    {
         $employees = Employee::all();
         return view('admin.education_qualification.edit',compact('employees','educationalQualification'));
    }


    public function update(Request $request, EducationalQualification $educationalQualification)
    {
        $this->validate($request ,[
//            'employee_id' => 'required',
            'degree'=>'required',
            'year' =>'required',
            'gpa'=>'required',
            'subject_name'=>'required',
            'board'=>'required',
        ]);

        /*dd($request->all());*/
        $educationalQualification->fill($request->all());

        $educationalQualification->update();
        Toastr::success('Educational Qualification Updated Successfully!.', 'Success');
        return redirect()->route('educational-qualification.index');
    }

    public function destroy(EducationalQualification $educationalQualification)
    {
        $educationalQualification->delete();
        \Toastr::success('Educational Qualification Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('educational-qualification.index');
    }
    public function getDeletedEducationalQualification()
    {
        $educational_qualifications = EducationalQualification::onlyTrashed()->get();
        return view('admin.education_qualification.deleted_educational-qualification',compact('educational_qualifications'));
    }
    public function restore($id)
    {
        $educational_qualifications=EducationalQualification::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Educational Qualifications Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('educational-qualification.deleted');
    }
    public function permanentDelete($id)
    {
        $educational_qualifications= EducationalQualification::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Educational Qualifications Permanently Deleted!.');
        return redirect()->route('educational-qualification.deleted');
    }

    public function softDelete($id){
        EducationalQualification::findOrFail($id)->delete();
        \Toastr::success('Educational Qualification Deleted!.');
        return back();
    }
}
