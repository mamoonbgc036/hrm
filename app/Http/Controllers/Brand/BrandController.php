<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\DynamicName;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Storage;

class BrandController extends Controller
{
    public function index()
    {
        return view('brand.index');
    }

    public function dynamic_name()
    {
        return view('brand.brand_name');
    }

    public function update_name(Request $request, $nameId)
    {
        $dataUpdate = DynamicName::where('id', $nameId)->get();
        if ($dataUpdate->isEmpty()) {
            DynamicName::create($request->all());
        } else {
            DynamicName::find($nameId)->update($request->all());
        }
        // check request for name
        return back();
    }

    public function update(Request $request, $brandId)
    {
        // Retrieve the brand model
        $brand = Brand::find($brandId);


        // Initialize variables
        $login_back = $brand->login_back;
        $company_logo = $brand->company_logo;
        $login_bk_small = $brand->login_bk_small;

        // Handle file uploads
        if ($request->hasFile('login_back')) {
            $login_back = $request->file('login_back')->store('branding', 'public');
        }

        if ($request->hasFile('company_logo')) {
            $company_logo = $request->file('company_logo')->store('branding', 'public');
        }

        if ($request->hasFile('login_bk_small')) {
            $login_bk_small = $request->file('login_bk_small')->store('branding', 'public');
        }

        // Update the brand model
        $brand->update([
            'login_back' => $login_back,
            'company_logo' => $company_logo,
            'login_bk_small' => $login_bk_small,
        ]);

        $branding_images = Brand::get()->first();

        Storage::put('icon', $branding_images->company_logo);

        // Provide feedback and redirect
        Toastr::success('Branding images updated successfully!', 'Success');
        return back();
    }

}
