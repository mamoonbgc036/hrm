<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.village.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.village.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Village::create($request->except('_token'));
        return redirect()->route('village.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Village $village)
    {
        return view('admin.village.edit', compact('village'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Village $village)
    {
        $village->update($request->except('_token'));
        return redirect()->route('village.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Village $village)
    {
        $village->delete();
        return redirect()->route('village.index');
    }
}
