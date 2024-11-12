<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class OfficeController extends Controller
{

    public function index()
    {
        $offices= Office::all();
        return view('admin.office.index',compact('offices'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.office.create');
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
            'office' => 'required',
            'status' => 'required',
        ]);
        $office= new Office;
        $office->office = $request->office;
        $office->status = $request->status;
        $office->save();

        Toastr::success('Office Created Successfully','Success');
        return redirect()->route('office.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        return view('admin.office.edit',compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        //return $request->all();
        $request->validate([
            'office' => 'required|unique:offices,office,'.$office->id,
            'status' => 'required',
        ]);

        $office->office = $request->office;
        $office->status = $request->status;
        $office->update();

        Toastr::success('Office updated successfully','Success');
        return redirect()->route('office.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        Toastr::success('Office deleted successfully','Success');
        return redirect()->back();
    }
    public function getDeletedOffice()
    {
        $offices = Office::onlyTrashed()->get();
        return view('admin.office.deleted_office',compact('offices'));
    }
    public function restore($id)
    {
        $office = Office::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Office Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('office.deleted');
    }
    public function permanentDelete($id)
    {
        $office= Office::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Office Permanently Deleted!.');
        return redirect()->route('office.deleted');
    }
}
