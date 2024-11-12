<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EmployeeDataImport;
use Maatwebsite\Excel\Facades\Excel;

class DataImportController extends Controller
{

    public function importForm(){
        return view('admin.data_import.import_form');
    }
    public function dataImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new EmployeeDataImport, $request->file('file'));

        return back()->with('success', 'Employees imported successfully!');
    }
}
