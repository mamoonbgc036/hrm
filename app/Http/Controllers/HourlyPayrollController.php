<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Brand;
use App\Models\HourRate;
use Illuminate\Http\Request;

class HourlyPayrollController extends Controller
{
    public function get_hourly_rate()
    {
        $data = HourRate::get();
        if (request()->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('hourly.rates.edit', $data->id) . '"
                    class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                    data-placement="top"><i class="fa fa-pencil-square-o"></i></a> ';
                    $btn .= '<form action="' . route('hourly.rate.delete', $data->id) . '" method="POST" style="display:inline;">
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
        return view('payroll.hourly-rate-template', compact('data'));
    }
    public function store_hourly(Request $request)
    {
        $data = $request->validate([
            'grade' => ['required'],
            'basic_salary' => ['required', 'numeric']
        ]);

        HourRate::create($data);
        return back();
    }

    public function edit_hourly_rate($hourRate)
    {
        $hourRate = HourRate::findOrFail($hourRate);
        $editMode = true;
        return view('payroll.hourly-rate-template', compact('hourRate', 'editMode'));
    }

    public function update(Request $request, $id)
    {

        $brand_for_update = HourRate::findOrFail($id);
        $brand_for_update->update($request->all());
        return redirect()->route('payroll.hourly-rate');
    }

    public function destroy($id)
    {
        $hourly_rate_for_delete = HourRate::findOrFail($id);
        $hourly_rate_for_delete->delete();
        return redirect()->route('payroll.hourly-rate');
    }
}
