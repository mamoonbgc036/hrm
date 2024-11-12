<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::latest()->get();
        return view('admin.organization.index', compact('organizations'));
    }
    public function create()
    {
        return view('admin.organization.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:organizations',
            'status' => 'required',
        ]);
        //  dd($request->all());
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->status = $request->status;
        $organization->created_by = Auth::id();
        $organization->save();
        Toastr::success('Organization Created Successfully!.', 'Success');
        return redirect()->route('organization.index');
    }
    public function show(Organization $organization)
    {
        //
    }
    public function edit(Organization $organization)
    {
        return view('admin.organization.edit',compact('organization'));
    }
    public function update(Request $request, Organization $organization)
    {
        $this->validate($request, [
            'name' => 'required|unique:organizations,name,' . $organization->id,
            'status' => 'required',
        ]);
        //  dd($request->all());

        $organization->name = $request->name;
        $organization->status = $request->status;
        $organization->updated_by = Auth::id();
        $organization->update();

        Toastr::success('Organization Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('organization.index');
    }
    public function destroy(Organization $organization)
    {
        $organization->delete();
        \Toastr::success('Organization Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('organization.index');
    }
    public function getDeletedOrganization()
    {
        $organizations = Organization::onlyTrashed()->get();
        return view('admin.organization.deleted_organization',compact('organizations'));
    }
    public function restore($id)
    {
        $organization = Organization::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Organization Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('organization.index');
    }

    public function permanentDelete($id)
    {
        $organization = Organization::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Organization Permanently Deleted!.');
        return redirect()->route('organization.deleted');
    }
}
