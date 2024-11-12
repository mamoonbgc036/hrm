<?php

namespace App\Http\Controllers;

use App\Models\StationCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StationCategoryController extends Controller
{

    public function index()
    {
        $categories = StationCategory::latest()->get();
        return view('admin.station-category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.station-category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|unique:station_categories'
        ]);

        StationCategory::create([
           'name' => $request->name
        ]);

        Toastr::success('Station Category Created Successfully', 'Success');
        return redirect()->route('station-category.index');
    }

    public function edit($id)
    {
       $category = StationCategory::find($id);
       return view('admin.station-category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|unique:station_categories,name,'.$id
        ]);

        $stationCat = StationCategory::findOrFail($id);

        if($request->name == $stationCat->getOriginal('name')){
            Toastr::info('Nothing Changed.');
            return redirect()->route('station-category.index');
        }
        $stationCat->update([
            'name' => $request->name
        ]);

        Toastr::success('Station Category Updated Successfully', 'Success');
        return redirect()->route('station-category.index');
    }

    public function destroy($id)
    {
        StationCategory::find($id)->delete();
        Toastr::success('Station Category Deleted Successfully', 'Success');

        return redirect()->route('station-category.index');
    }
}
