<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\HourRate;
use App\Models\Specialized;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SpecializedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Specialized::get();
        if (request()->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('specialized.edit', $data->id) . '"
                    class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                    data-placement="top"><i class="fa fa-pencil-square-o"></i></a> ';
                    $btn .= '<form action="' . route('specialized.destroy', $data->id) . '" method="POST" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-xs btn-danger" title="Delete" data-toggle="tooltip" data-placement="top" onclick="return confirm(\'Are you sure?\')">
                    <i class="fa fa-trash-o"></i>
                </button>
             </form>';
                    return $btn;
                })
                ->make(true);
        }
        return view('specialized.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Specialized::create($request->except('_token'));
        Toastr::success('Skill created successfully!', 'Success');
        return redirect()->route('specialized.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialized $specialized)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialized $specialized)
    {
        $editMode = true;
        return view('specialized.index', compact('specialized', 'editMode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialized $specialized)
    {
        $specialized->update($request->except('_token'));
        Toastr::success('Skill updated successfully!', 'Success');
        return redirect()->route('specialized.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialized $specialized)
    {
        $specialized->delete();
        Toastr::success('Skill deleted successfully!', 'Success');
        return redirect()->route('specialized.index');
    }
}
