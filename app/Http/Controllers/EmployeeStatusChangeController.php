<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeStatusChangeController extends Controller
{
    public function search()
    {
        // Current branch, zone, region, Designation (1st line)
        $allFinancialPunishmentTypes = financialPunishmentType()->toArray();
        $search_key = Request()->pin_no;
        $status = Request()->status;
        if (!empty($search_key) && $status == 'confirmation') {
            $employees = Employee::with('designation', 'monthly_grade', 'punishments')->where('pin_no', 'like', "%$search_key%")->orWhere('name', 'like', "%$search_key%")->limit(25)->get();
            $designations = Designation::all();
        } else if (!empty($search_key) && $status == 'redesignation') {
            $employees = Employee::with('designation', 'monthly_grade')->where('pin_no', 'like', "%$search_key%")->orWhere('name', 'like', "%$search_key%")->limit(25)->get();
            $designations = Designation::all();
        } else if (!empty($search_key) && $status == 'promotion') {
            // -pin, name, Designation, Joining date, Present salary, Grade, New Designation, New Grade, new Salary
            $employees = Employee::with('designation', 'monthly_grade', 'punishments')->where('pin_no', 'like', "%$search_key%")->limit(25)->get();
            $designations = Designation::all();
        } else if (!empty($search_key) && $status == 'case') {
            $employees = Employee::with('designation')->where('pin_no', 'like', "%$search_key%")->limit(25)->get();
        } else {
            $employees = null;
        }
        return response()->json([
            'employees' => $employees,
            'designations' => @$designations,
            'punishmentTypes' => $allFinancialPunishmentTypes,
        ]);
    }

    public function confirm()
    {
        $employee_for_update = Employee::findOrFail(request()->input('id'));
        if (request()->status == 'confirmation') {
            if ($employee_for_update->is_confirmed != 'yes') {
                $employee_for_update->update(['is_confirmed' => 'yes', 'actual_confirmation_date' => Carbon::now()->toDateString()]);
                return response()->json(
                    [
                        'success' => 'confirmed',
                        'actual_confirmation_date' => Carbon::parse($employee_for_update->actual_confirmation_date)->format('d/m/Y'),
                        'confirmation_date' => $employee_for_update->confirmation_date
                    ]
                );
            }
            $employee_for_update->update(['is_confirmed' => null, 'actual_confirmation_date' => '']);
            return response()->json(
                [
                    'success' => 'unconfirmed',
                    'actual_confirmation_date' => $employee_for_update->actual_confirmation_date,
                    'confirmation_date' => $employee_for_update->confirmation_date
                ]
            );
        } else if (request()->status == 'redesignation') {
            $employee_for_update->update(['designation_id' => request()->input('redesignation_id')]);
            return response()->json([
                'success' => true,
                'message' => 'employee designation updated successfully'
            ]);
        }
    }
}
