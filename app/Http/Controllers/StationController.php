<?php

namespace App\Http\Controllers;

use App\Http\Requests\StationRequest;
use App\Library\StationInterface;
use App\Models\District;
use App\Models\Division;
use App\Models\Station;
use App\Models\StationCategory;
use App\Models\Upazila;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StationController extends Controller
{
    protected $stations;

    public function __construct(StationInterface $stations)
    {
        $this->stations = $stations;
    }

    public function index()
    {
        $stations = Station::with('division', 'district', 'upazila', 'stationCategory');

        if (\request()->ajax()) {
            return DataTables::of($stations)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('admin.station.action-button', compact('row'));
                })
                ->addColumn('division.name', function ($row) {
                    return $row->division->name ?? '';
                })
                ->addColumn('district_name', function ($row) {
                    return $row->district->name ?? '';
                })
                ->addColumn('upazila_name', function ($row) {
                    return $row->upazila->name ?? '';
                })
                ->addColumn('station_category', function ($row) {
                    return $row->stationCategory->name ?? '';
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.station.index');
    }

    public function create()
    {
        $categories = StationCategory::latest()->get();
        return view('admin.station.create', compact('categories'));
    }

    public function store(StationRequest $request)
    {
        $request->validated();
        $this->stations->store();
        Toastr::success('Station Created Successfully', 'Success');
        return redirect()->route('station.index');
    }

    public function edit(Station $station)
    {
        $station = $this->stations->edit($station);
        $categories = StationCategory::latest()->get();
        return view('admin.station.edit', compact('station', 'categories'));
    }

    public function update(Request $request, Station $station)
    {
        $this->validate($request, [
            'name' => 'required|unique:stations,name,' . $station->id,
            'code' => 'nullable|numeric|unique:stations,code,' . $station->id,
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ]);

        $this->stations->update($station);
        Toastr::success('Station updated successfully', 'Success');
        return redirect()->route('station.index');
    }

    public function destroy(Station $station)
    {
        $this->stations->destroy($station);
        Toastr::success('Station deleted successfully', 'Success');
        return redirect()->back();
    }
    public function getDeletedStation()
    {
        $station = Station::onlyTrashed()->get();
        return view('admin.station.deleted_station', compact('station'));
    }
    public function restore($id)
    {
        $station = Station::withTrashed()->findOrFail($id)->restore();

        \Toastr::success('Station Restore Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('station.deleted');
    }
    public function permanentDelete($id)
    {
        $station = Station::withTrashed()->findOrFail($id)->forceDelete();
        \Toastr::success('Station Permanently Deleted!.');
        return redirect()->route('station.deleted');
    }

    public function fetch_divisions(Request $request)
    {
        $divisions = Division::orderBy('name', 'ASC')->get();

        // $option = '';
        // foreach ($divisions as $row) {
        //     if($row->id == $request->id){
        //         $option =  $option.'<option selected value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
        //     } else{
        //         $option =  $option.'<option value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
        //     }
        // }
        return response()->json($divisions);
    }

    public function fetch_districts($division_id)
    {
        $districts = District::orderBy('name', 'ASC')->where('division_id', $division_id)->get();

        // $option = '';
        // foreach ($districts as $row) {
        //     if ($row->id == $request->id) {
        //         $option = $option . '<option selected value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
        //     } else {
        //         $option = $option . '<option value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
        //     }
        // }
        return response()->json($districts);
    }

    public function fetch_upazillas(Request $request)
    {
        $upazillas = Upazila::orderBy('name', 'ASC')->get();

        $option = '';
        foreach ($upazillas as $row) {
            if ($row->id == $request->id) {
                $option = $option . '<option selected value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
            } else {
                $option = $option . '<option value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
            }
        }
        return response()->json($upazillas);
    }

    public function fetch_district(Request $request)
    {
        $districts = District::where('division_id', $request->id)->orderBy('name', 'ASC')->get();

        $option = '<option selected disabled hidden value=""> Select one</option>';
        foreach ($districts as $row) {
            $option = $option . '<option value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
        }
        return response()->json($option);
    }

    public function fetch_thana(Request $request)
    {
        $upazilas = Upazila::where('district_id', $request->id)->orderBy('name', 'ASC')->get();

        // $option = '<option selected disabled hidden value=""> Select one</option>';
        // foreach ($upazilas as $row) {
        //     $option = $option . '<option value="' . $row->id . '">' . strtoupper($row->name) . '</option>';
        // }
        return response()->json($upazilas);
    }

    public function fetch_branch($district_id)
    {
        $branchs = Station::where('district_id', $district_id)->get();
        return response()->json($branchs);
    }

    public function fetch_division_district_thana(Request $request)
    {
        $station = Station::findOrFail($request->id);

        $data = [];
        $data['division'] = Division::findOrFail($station->division_id);
        $data['district'] = District::findOrFail($station->district_id);
        $data['upazila'] = Upazila::findOrFail($station->upazila_id);

        return response()->json($data);
    }
}
