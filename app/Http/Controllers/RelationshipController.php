<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    public function index()
    {
        $contacts = Relationship::latest()->get();
        return view('admin.relationship.index',compact('contacts'));
    }

    public function create()
    {
        return view('admin.relationship.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|string|unique:relationships',
           //'description' => 'required'
        ]);

        Relationship::create([
           'name' => $request->name,
           'description' => $request->description,
        ]);

        Toastr::success('Relationship Created Successfully', 'Success');
        return redirect()->route('relationship.index');
    }

    public function edit($id)
    {
        $contact = Relationship::find($id);
        return view('admin.relationship.edit',compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|unique:relationships,name,'.$id,
            //'description' => 'required'
        ]);

        Relationship::where('id',$id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Toastr::success('Relationship Updated Successfully', 'Success');
        return redirect()->route('relationship.index');
    }

    public function destroy($id)
    {
        Relationship::find($id)->delete();
        Toastr::success('Relationship Deleted Successfully', 'Success');
        return redirect()->route('relationship.index');
    }
    public function getDeletedRelationship()
    {
        $relationships = Relationship::onlyTrashed()->get();
        return view('admin.relationship.deleted_relationship',compact('relationships'));
    }
    public function restore($id)
    {
        $relationship= Relationship::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Relationship Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('relationship.deleted');
    }
    public function permanentDelete($id)
    {
        $relationship = Relationship::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Relationship Permanently Deleted!.');
        return redirect()->route('relationship.deleted');
    }

}
