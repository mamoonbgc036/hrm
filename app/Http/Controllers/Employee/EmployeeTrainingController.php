<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeTrainingController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
    }
}
