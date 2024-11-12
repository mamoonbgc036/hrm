<?php

namespace App\Http\Controllers;

use App\Models\ExperienceJobPosition;
use Illuminate\Http\Request;
use DataTables;

class ExperienceJobPostionController extends Controller
{
    public function index()
    {
        $data = ExperienceJobPosition::get();
        // Check if the request is an AJAX request
        if (request()->ajax()) {
            // Fetch paginated data

            // Return data for DataTables
            return Datatables::of($data)
                ->addIndexColumn() // Add index column
                ->addColumn('action', function ($data) {
                    // Define edit and delete buttons for each row
                    $btn = '<a href="' . route('job_position.edit', $data->id) . '" 
                        class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                        data-placement="top"><i class="fa fa-pencil-square-o"></i></a> ';

                    $btn .= '<form action="' . route('job_position.destroy', $data->id) . '" 
                        method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-xs btn-danger" title="Delete" 
                        data-toggle="tooltip" data-placement="top" 
                        onclick="return confirm(\'Are you sure?\')">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </form>';

                    return $btn;
                })
                ->rawColumns(['action']) // Allow HTML content in the 'action' column
                ->make(true);
        }

        // If not an AJAX request, return the regular view
        return view('position.index', compact('data'));
    }

    public function edit($id)
    {
        $editMode = true;
        $position = ExperienceJobPosition::find($id);
        return view('position.index', compact('position', 'editMode'));
    }

    public function update(Request $request, $id)
    {
        ExperienceJobPosition::findOrFail($id)->update($request->except('_token'));
        return redirect()->route('job_position');
    }

    public function store(Request $request)
    {
        $job_experience_position_data = $request->validate([
            'name' => ['required'],
        ]);

        ExperienceJobPosition::create($job_experience_position_data);
        return redirect()->back();
    }

    public function delete($id)
    {
        $position_to_delete = ExperienceJobPosition::findOrFail($id);
        $position_to_delete->delete();
        return back();
    }
}
