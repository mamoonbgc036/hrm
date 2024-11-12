<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Welfare;
use Illuminate\Http\Request;

class WelfareController extends Controller
{
    public function create()
    {
        $welfares = Welfare::all();
        return view('welfare.create', compact('welfares'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);
        $welfare = new Welfare();
        $welfare->name = $request->name;
        $welfare->created_by = auth()->id();
        $welfare->save();
        return back();
    }
}
