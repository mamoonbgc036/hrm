<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Grade;
use App\Models\Station;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\PostingRecord;

class TransferController extends Controller
{
    public function index()
    {
        $departments = Department::select('id','name')->where('status', 'active')->orderBy('name', 'ASC')->get();
        $designations = Designation::where('status', 'active')->orderBy('en_name', 'ASC')->get();
        $stations = Station::where('status', 'active')->orderBy('name', 'ASC')->get();
        $grades = Grade::where('status', 'active')->orderBy('grade', 'ASC')->get();
        $posting_types = collect(PostingRecord::posting_types());
        
        return view('transfer.index', compact('departments','stations', 'designations', 'grades', 'posting_types'));
    }
}
