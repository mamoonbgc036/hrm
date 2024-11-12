<?php


namespace App\Repository;


use App\Http\Requests\StationRequest;
use App\Library\StationInterface;
use App\Models\Station;
use Brian2694\Toastr\Facades\Toastr;

class StationRepository implements StationInterface
{
    public function getAll()
    {
        return Station::active()->latest()->get();
    }

    public function store()
    {
        return Station::create([
           'name' => request()->name,
           'code' => request()->code,
           'area' => request()->area,
           'phone' => request()->phone,
           'station_category_id' => request()->station_category_id,
           'division_id' => request()->division_id,
           'district_id' => request()->district_id,
           'upazila_id' => request()->upazila_id,
        ]);
    }

    public function edit($station)
    {
        return $station;
    }

    public function update($station)
    {
        return $station->update([
            'name' => request()->name,
            'code' => request()->code,
            'area' => request()->area,
            'phone' => request()->phone,
            'station_category_id' => request()->station_category_id,
            'division_id' => request()->division_id,
            'district_id' => request()->district_id,
            'upazila_id' => request()->upazila_id,
        ]);
    }

    public function destroy($station)
    {
        $station->delete();
    }
}
