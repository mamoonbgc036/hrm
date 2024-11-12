<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Nominee;
use App\Models\Relationship;
use App\Rules\NomineePercentage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class NomineeController extends Controller
{

    public function index()
    {
        $nominees = Nominee::with('employee','relationships')->latest()->get();
       // dd($nominees);
        return view('admin.nominee.index',compact('nominees'));
    }
    public function create()
    {
        //return \request('employee');
        $availablePercentage = Employee::find(request('employee'))->availableNomineePercentage();
        if ($availablePercentage <1){
            Toastr::warning('No percentage available!.', 'Warning',["closeButton" => "true", "progressBar" => "true"]);
            return back();
        }
        $relationship = Relationship::all();
        return view('admin.nominee.create',compact('relationship','availablePercentage'));
    }

    public function store(Request $request)
    {
        //return $request->all();
        $availablePercentage = Employee::find($request->employee_id)->availableNomineePercentage();

        $request->validate([
            'nominee.*.name' => ['required'],
            'nominee.*.percentage' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use($availablePercentage) {
                    if ($value > $availablePercentage) {
                        $fail('Available percentage '.$availablePercentage);
                    }
                },
            ],
        ]);
        //return $value['name'];
        foreach ($request->nominee as $value){
            $nominee = new Nominee();
            $nominee->employee_id = $request->employee_id;
            $nominee->name = $value['name'];
            $nominee->relationship_id = $value['relationship_id'];
            $nominee->nid_no = $value['nid_no'];
            $nominee->percentage = $value['percentage'];
            $nominee->permanent_address = $value['permanent_address'];
            $nominee->save();
        }




        Toastr::success('Nominee Created Successfully!.', 'Success',["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('employee.edit',$request->employee_id);
    }

    public function show(Nominee $nominee)
    {
        //
    }
    public function edit(Nominee $nominee)
    {
        $employees=Employee::all();
        $relationship=Relationship::all();
        return view('admin.nominee.edit',compact('nominee','employees','relationship'));
    }

    public function update(Request $request, Nominee $nominee)

    {
//        return $request->all();

        $this->validate($request, [
            'name' => 'required',
            'nid_no' => 'required',
            'percentage' => 'required',
            'permanent_address' => 'required',
        ]);

        $nominee->fill($request->all());
        $nominee->update();
        Toastr::success('Nominee Updated Successfully!.', 'Success',["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('nominee.index');
    }

    public function destroy(Nominee $nominee)
    {
         $nominee->delete();
        \Toastr::success('Nominee Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('nominee.index');
    }
    public function getDeletedNominee()
    {
        $nominees = Nominee::onlyTrashed()->get();
        return view('admin.nominee.deleted_nominee',compact('nominees'));
    }
    public function restore($id)
    {
        $nominee = Nominee::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Nominee Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('nominee.deleted');
    }
    public function permanentDelete($id)
    {
        $nominee = Nominee::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Nominee Permanently Deleted!.');
        return redirect()->route('nominee.deleted');
    }

    public function softDelete($id){
        Nominee::findOrFail($id)->delete();
        \Toastr::success('Nominee Deleted!.');
        return back();
    }
}
