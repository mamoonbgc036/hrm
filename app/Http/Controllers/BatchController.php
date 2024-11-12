<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::latest()->get();
        return view('admin.batch.index', compact('batches'));
    }

    public function create()
    {
        return view('admin.batch.create');
    }

    public function store(Request $request)
    {
        $request->all();

        $this->validate($request, [
            'name' => 'required|unique:batches',
        ]);

        $batch = new Batch();
        $batch->name = $request->name;
        $batch->created_by = Auth::id();
        $batch->save();
        Toastr::success('Batch Created Successfully!', 'Success');
        return redirect()->route('batch.index');
    }

    public function show(Batch $batch)
    {
        //
    }

    public function edit(Batch $batch)
    {
        return view('admin.batch.edit',compact('batch'));
    }

    public function update(Request $request, Batch $batch)
    {
        $this->validate($request, [
            'name' => 'required|unique:batches,name,' . $batch->id,
        ]);
        //  dd($request->all());

        $batch->name = $request->name;
        $batch->updated_by = Auth::id();
        $batch->update();

        Toastr::success('Batch Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('batch.index');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        Toastr::success('Batch Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('batch.index');
    }
}
