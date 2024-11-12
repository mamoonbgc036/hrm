<?php

namespace App\Http\Controllers;

use App\Models\Quota;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Mpdf\Tag\Q;

class QuotaController extends Controller
{
    public function index()
    {
        $quota = Quota::latest()->get();
        return view('admin.quota.index', compact('quota'));
    }
    public function create()
    {
        return view('admin.quota.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:quotas',
            'status' => 'required',
        ]);
        //  dd($request->all());
        $quota = new Quota();
        $quota->name = $request->name;
        $quota->status = $request->status;
        $quota->save();

        Toastr::success('Quota Created Successfully!.', 'Success');
        return redirect()->route('quota.index');
    }
    public function show(Quota $quota)
    {
        //
    }
    public function edit($id)
    {
        $quota = Quota::find($id);
        return view('admin.quota.edit',compact('quota'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:quotas,name,' . $id,
            'status' => 'required',
        ]);
        //  dd($request->all());
        $quota = Quota::find($id);
        $quota->name = $request->name;
        $quota->status = $request->status;
        $quota->update();

        Toastr::success('Quota Updated Successfully!.', 'Success', ["progressBar" => true]);
        return redirect()->route('quota.index');
    }
    public function destroy($id)
    {
        $quota = Quota::find($id);
        $quota->delete();
        \Toastr::success('Quota Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('quota.index');
    }
    public function getDeletedQuota()
    {
        $quota = Quota::onlyTrashed()->get();
        return view('admin.quota.deleted_quota',compact('quota'));
    }
    public function restore($id)
    {
        $quota = Quota::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Quota Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('quota.index');
    }
    public function permanentDelete($id)
    {
        $quota = Quota::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Quota Permanently Deleted!.');
        return redirect()->route('quota.deleted');
    }
}
