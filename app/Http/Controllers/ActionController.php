<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::latest()->get();
        return view('admin.action.index', compact('actions'));
    }

    public function create()
    {
        return view('admin.action.create');
    }

    public function store(Request $request)
    {
        $request->all();

        $this->validate($request, [
            'name' => 'required|unique:actions',
        ]);

        $action = new Action();
        $action->name = $request->name;
        $action->created_by = Auth::id();
        $action->save();
        Toastr::success('Action Created Successfully!', 'Success');
        return redirect()->route('action.index');
    }

    public function show(Action $action)
    {
        //
    }

    public function edit(Action $action)
    {
        return view('admin.action.edit',compact('action'));
    }

    public function update(Request $request, Action $action)
    {
        $this->validate($request, [
            'name' => 'required|unique:actions,name,' . $action->id,
        ]);
        //  dd($request->all());

        $action->name = $request->name;
        $action->updated_by = Auth::id();
        $action->update();

        Toastr::success('Action Updated Successfully!', 'Success', ["progressBar" => true]);
        return redirect()->route('action.index');
    }

    public function destroy(Action $action)
    {
        $action->delete();
        Toastr::success('Action Deleted Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('action.index');
    }
}
