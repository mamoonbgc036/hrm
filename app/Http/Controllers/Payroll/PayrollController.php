<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Grade;
use App\Models\Employee;
use App\Models\HourRate;
use App\Models\GradeType;
use App\Models\Department;
use App\Models\Salary_template;
use App\Models\SalaryHistory;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\Controller;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Storage;

class PayrollController extends Controller
{
    public function get_hourly_rate()
    {
        return view('payroll.hourly-rate-template');
    }

    public function allowance_deduction($grade_value)
    {
        // return response()->json($grade_value);
        $allowances_dedcutions_for_grade = Salary_template::with('allowances', 'deduction')->where('grade_id', $grade_value)->get();
        return response()->json($allowances_dedcutions_for_grade);
    }

    public function payment_update(Request $request, $id)
    {
        $employee_salary_history_update = SalaryHistory::where('employee_id', $id)->where('month_year', Storage::get('month_for_search'))->first();
        $request['status'] = 'paid';
        $employee_salary_history_update->update($request->except('update_for_date'));
        // dd($employee_salary_history_update);
        return redirect()->route('payroll.make-payment', $employee_salary_history_update->department_id);
    }

    public function make_payment($departmentId = null)
    {
        $employees = false;
        if (!is_null($departmentId)) {
            $employees = Employee::with([
                'gradeType',
                'monthly_grade',
                'salary_histories' => function ($query) {
                    $query->where('month_year', Storage::get('month_for_search'));  // Filter salary histories by month_year
                },
                'hourGrade'
            ])
                ->whereHas('salary_histories', function ($query) {
                    $query->where('month_year', Storage::get('month_for_search'));  // Ensure employees have salary history for the given month_year
                })
                ->where('department_id', $departmentId)
                ->get()
                ->map(function ($employee) {
                    if ($employee->grade_type_id == 1) {
                        unset($employee->monthly_grade);
                    } elseif ($employee->grade_type_id == 2) {
                        unset($employee->hourGrade);
                    }
                    $employee->grade_string = $employee->grade_type_id == 1 ? 'hourly' : 'monthly';
                    return $employee;
                });
        }
        $departments = Department::all();
        return view('payroll.make-payment', compact('departments', 'employees'));
    }

    public function payment_select($id)
    {
        $departments = Department::all();
        $employee = Employee::with('hourGrade', 'monthly_grade.allowances', 'monthly_grade.deduction')->findOrFail($id);

        if ($employee->grade_type_id == 1) {
            unset($employee->monthly_grade);
        } else {
            unset($employee->hourGrade);
        }
        $t_allowances = 0;
        $t_deduction = 0;
        $gross_salary = 0;
        if ($employee->monthly_grade) {
            $gross_salary = $employee->monthly_grade->basic_salary;
            if (!$employee->monthly_grade->allowances->isEmpty()) {
                foreach ($employee->monthly_grade->allowances as $allowances) {
                    $t_allowances += $allowances->allowance_value;
                }
            }
            if (!$employee->monthly_grade->deduction->isEmpty()) {
                foreach ($employee->monthly_grade->deduction as $deduct) {
                    $t_deduction += $deduct->deduction_value;
                }
            }
        }

        if (@$employee->hourGrade) {
            $gross_salary = $employee->hourGrade->basic_salary;
        }

        $data = [
            'employee_id' => $employee->id,
            'gross_salary' => $gross_salary + $t_allowances,
            'total_deduction' => $t_deduction,
            'total_allowance' => $t_allowances,
            'net_salary' => $gross_salary + $t_allowances - $t_deduction
        ];
        return view('payroll.select-payment', compact('departments', 'data'));
    }

    public function make_payment_details(Request $request)
    {
        $monthYear = Carbon::createFromFormat('m/Y', $request->date)->format('Y-m');
        // dd($request->departmentId);
        $formattedDate = Carbon::parse($monthYear)->format("F 'y");
        // Storage::delete(['month_for_search', 'month_for_show']);
        Storage::put('redirect_month', $request->date);
        Storage::put('month_for_search', $monthYear);
        Storage::put('month_for_show', $formattedDate);
        $check = SalaryHistory::where('department_id', $request->departmentId)
            ->where('month_year', $monthYear)
            ->get()->isEmpty();

        $data = [];

        $employee_for_salary_history = Employee::where('department_id', $request->departmentId)->get();

        if ($check) {
            foreach ($employee_for_salary_history as $employee_for_salary) {
                $data = [
                    'employee_id' => $employee_for_salary->id,
                    'department_id' => $employee_for_salary->department_id,
                    'month_year' => $monthYear,
                    'status' => 'unpaid',
                    'payment_method' => 'unselected',
                ];
                SalaryHistory::create($data);
            }
        }

        $departments = Department::all();
        $departmentId = $request->departmentId;
        // dd($departmentId);
        $employees = Employee::with([
            'gradeType',
            'monthly_grade',
            'salary_histories' => function ($query) use ($monthYear) {
                $query->where('month_year', $monthYear);
            },
            'hourGrade'
        ])
            // ->whereHas('salary_histories', function ($query) use ($monthYear) {
            //     $query->where('month_year', $monthYear);
            // })
            ->where('department_id', $request->departmentId)
            ->get()
            ->map(function ($employee) {
                if ($employee->grade_type_id == 1) {
                    unset($employee->monthly_grade);
                } elseif ($employee->grade_type_id == 2) {
                    unset($employee->hourGrade);
                }
                $employee->grade_string = $employee->grade_type_id == 1 ? 'hourly' : 'monthly';
                return $employee;
            });

        // logger($employees->toArray());
        return view('payroll.make-payment', compact('departments', 'employees', 'departmentId'));
    }

    public function get_manage_salary($id = null)
    {
        $employees = false;
        $departments = Department::all();
        return view('payroll.manage-salary', compact('employees', 'departments'));
    }


    public function search($id)
    {
        $employee = Employee::with(['department', 'hourGrade', 'jobGrade', 'designation', 'monthly_grade.deduction', 'monthly_grade.allowances'])->findOrFail($id);
        $allowance = '';
        $deduction = '';
        if (!empty($employee->monthly_grade)) {
            foreach ($employee->monthly_grade->deduction as $deduct) {
                $deduction .= ` <tr>
                  <th>` . $deduct->deduction_label . ` :</th>
                  <td id="h_rent">` . $deduct->deduction_value . `</td>
               </tr>`;
            }
        }
        if (!empty($employee->monthly_grade)) {
            foreach ($employee->monthly_grade->allowances as $facilites) {
                $allowance .= ` <tr>
                  <th>` . $facilites->allowance_label . ` :</th>
                  <td id="h_rent">` . $facilites->allowance_value . `</td>
               </tr>`;
            }
        }
        if (request()->ajax()) {
            $data = [
                'name' => $employee->name,
                'employee_id' => $employee->id,
                'department_name' => $employee->department->name,
                'designation_name' => $employee->designation->en_name,
                'joining_date' => $employee->created_at->format('d-m-y'),
                'grade_name' => @$employee->monthly_grade->grade_id ?? @$employee->hourGrade->grade,
                'basic_salary' => @$employee->monthly_grade->basic_salary ?? @$employee->hourGrade->basic_salary,
                'over_time' => @$employee->monthly_grade->overtime_salary,
                'allowence' => @$employee->monthly_grade->allowances,
                'deduction' => @$employee->monthly_grade->deduction
            ];
            return response()->json($data);
        } else {
            $html = view('pdf.monthly-salary-details', compact('employee'))->render();
            $pdf = new Mpdf();
            $pdf->WriteHTML($html);
            return $pdf->Output($employee->name . '_details.pdf', 'I');
            // return view('pdf.monthly-salary-details', compact('employee'));
        }
    }

    public function get_manage_a_salary(Request $request)
    {
        $employees = Employee::where('department_id', $request->departmentId)->with('gradeType')->get();
        $departmentId = $request->departmentId;

        $employees = $employees->each(function ($employee) {
            if ($employee->gradeType && $employee->gradeType->id == 1) {
                $employee->load('hourGrade', 'designation');
            } elseif ($employee->gradeType && $employee->gradeType->id == 2) {
                $employee->load('monthly_grade', 'designation');
            }
        });
        $monthly_grades = Salary_template::all();
        $hourly_grades = HourRate::all();
        $departments = Department::all();
        return view('payroll.manage-salary', compact('employees', 'monthly_grades', 'hourly_grades', 'departments', 'departmentId'));
    }

    public function manage_a_employee_payroll($id)
    {
        // catch employee from employee table with department
        $employes = Employee::with('department')->findOrFail($id);
        $employees = collect([$employes]);
        if ($employees[0]->gradeType && $employees[0]->gradeType->id == 1) {
            $employees[0]->load('hourGrade', 'designation');
        } elseif ($employees[0]->gradeType && $employees[0]->gradeType->id == 2) {
            $employees[0]->load('jobGrade', 'designation');
        }
        $employee_id = $employes->id;
        $departmentId = $employees[0]->department->id;
        $monthly_grades = Salary_template::all();
        $hourly_grades = HourRate::all();
        $departments = Department::all();
        return view('payroll.manage-salary', compact('employees', 'monthly_grades', 'hourly_grades', 'departments', 'departmentId', 'employee_id'));
    }

    public function update_department_salary(Request $request, $departmentId)
    {
        // dd($request->all());
        $hourlyGradeType = GradeType::where('name', 'Hourly')->first();
        $monthlyGradeType = GradeType::where('name', 'Monthly')->first();
        if ($request->employee_id != null) {
            $employees = Employee::findOrFail($request->employee_id);
            $employees = collect([$employees]);
        } else {
            $employees = Employee::where('department_id', $departmentId)->get();
        }
        foreach ($employees as $employee) {
            $gradeType = null;
            // dd($request->month_grade_id[$employee->id]);
            if (isset($request->hour_grade_id[$employee->id])) {
                $employee->hourGrade()->associate($request->hour_grade_id[$employee->id]);
                $gradeType = $hourlyGradeType->id;
            }
            if (isset($request->month_grade_id[$employee->id])) {
                $employee->jobGrade()->associate($request->month_grade_id[$employee->id]);
                $gradeType = $monthlyGradeType->id;
            }
            $employee->grade_type_id = $gradeType;
            $employee->save();
        }


        return redirect()->route('payroll.manage-salary');
    }


    public function employee_salary_list()
    {
        // Fetch all employees with conditional eager loading based on grade type
        $employees = Employee::with('gradeType')
            ->with([
                'hourGrade' => function ($query) {
                    // Load hourGrade only if the grade_type_id is 1 (Hourly Grade)
                    $query->whereHas('employee', function ($q) {
                        $q->where('grade_type_id', 1);
                    });
                }
            ])
            ->with([
                'monthly_grade' => function ($query) {
                    // Load monthlyGrade only if the grade_type_id is 2 (Monthly Grade)
                    $query->whereHas('employee', function ($q) {
                        $q->where('grade_type_id', 2);
                    });
                }
            ])
            ->get()
            ->map(function ($employee) {
                // Exclude the unnecessary relationship based on grade_type_id
                if ($employee->grade_type_id == 1) {
                    unset($employee->monthly_grade);
                    // $employee->honorarium = $employee->hourGrade->basic_salary;
                } elseif ($employee->grade_type_id == 2) {
                    unset($employee->hourGrade);
                }

                $employee->gradeTypeName = $employee->gradeType->name ?? 'N/A';
                $employee->honorarium = @$employee->monthly_grade->basic_salary ?? @$employee->hourGrade->basic_salary;
                $employee->overtime_salary = @$employee->monthly_grade->overtime_salary;
                return $employee;
            });

        // dd($employees);

        if (request()->ajax()) {
            return Datatables::of($employees)
                // ->addIndexColumn()
                ->addColumn('action', function ($employee) {
                    // You can define the action buttons or any other manipulation here
                    $button = '<a href="" data-id=' . $employee->id . ' class="text-danger employee_delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></a>';
                    $button .= '<a href="#" data-id=' . $employee->id . ' class="show_payroll p-2" data-toggle="modal" data-target="#exampleModalLong">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
  <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5z"/>
</svg>
</a>';

                    $button .= '<a href="' . route('payroll.manage-a-employee-payroll', $employee->id) . '" class="text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg></a>';
                    return $button;
                })
                ->make(true);
        }
        return view('payroll.employee-salary-list', compact('employees'));
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['success' => 'deleted successfully']);
    }


    public function generate_payslip($id)
    {
        $month_for_search = session('month_for_search');
        $data_for_payslip = Employee::with([
            'salary_histories' => function ($query) {
                $query->where('month_year', Storage::get('month_for_search'))->limit(1);
            },
            'designation',
            'department',
            'monthly_grade' => function ($query) {
                $query->with('allowances', 'deduction')->get();
            }
        ])->findOrFail($id);
        // dd($data_for_payslip);
        // logger($data_for_payslip->toArray());
        return view('payroll.generate-payslip', compact('data_for_payslip'));
    }

    public function payroll_summary()
    {
        return view('payroll.payroll-summary');
    }

    public function advance_salary()
    {
        return view('payroll.advance-salary');
    }

    public function provident_fund()
    {
        return view('payroll.provident-fund');
    }
}
