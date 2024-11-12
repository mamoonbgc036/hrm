<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .modal-content {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
        }

        .modal-body {
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-primary {
            color: #007bff;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            margin-bottom: 20px;
        }

        .col-md-6 {
            width: 50%;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .rounded-circle {
            border-radius: 50%;
        }

        .border {
            border: 1px solid #ddd;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-borderless th,
        .table-borderless td {
            border: none;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .border-primary {
            border-color: #007bff;
        }

        .border-success {
            border-color: #28a745;
        }

        .border-danger {
            border-color: #dc3545;
        }

        .border-info {
            border-color: #17a2b8;
        }

        .rounded {
            border-radius: 8px;
        }

        .p-3 {
            padding: 16px;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table-sm th,
        .table-sm td {
            padding: 4px;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-info {
            color: #17a2b8;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .mt-5 {
            margin-top: 40px;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center w-100">Employee Salary Details</h3>
            </div>
            <div class="modal-body">
                <h4 class="text-center text-primary font-weight-bold mb-4" id="name">{{ $employee->name }}</h4>
                <table class="row">
                    <tr>
                        <td>
                            <div class="col-md-6 text-center">
                                <img src="https://via.placeholder.com/150" alt="Employee Image"
                                    class="img-fluid rounded-circle border" style="width: 150px; height: 150px;">
                            </div>
                        </td>
                        <td>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th class="text-right">Emp ID :</th>
                                            <td id="emp_id">{{ $employee->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Department :</th>
                                            <td id="department">{{ $employee->department->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Designation :</th>
                                            <td id="designation">{{ $employee->designation->en_name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Joining Date :</th>
                                            <td id="joining">{{ $employee->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="border border-primary rounded p-3 mt-4">
                    <h4 class="text-center text-info">Salary Details</h4>
                    <hr>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="text-right">Salary Grade :</th>
                                <td id="grade">
                                    {{ $employee->jobGrade->grade ?? ($employee->hourGrade->grade ?? '') }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right">Basic Salary :</th>
                                <td id="salary">
                                    {{ @$employee->monthly_grade->basic_salary ?? @$employee->hourGrade->basic_salary }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right">Over Time :</th>
                                <td id="overtime">{{ @$employee->monthly_grade->overtime_salary }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @php
                    $t_allowance = 0;
                    $t_deduction = 0;
                @endphp

                <table class="row" style="width: 100%">
                    <tr>
                        <td class="border border-success rounded p-3">
                            <h5 class="text-center text-success">Allowance</h5>
                            <hr>
                            <table class="table table-sm table-bordered table-striped">
                                @foreach ($employee->monthly_grade->allowances as $facilites)
                                    @php
                                        $t_allowance += $facilites->allowance_value;
                                    @endphp
                                    <tr>
                                        <th>{{ $facilites->allowance_label }} :</th>
                                        <td>{{ $facilites->allowance_value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="text-end fw-bold">
                                Total Allowance: {{ $t_allowance }}
                            </div>
                        </td>
                        <td class="border border-danger rounded p-3">
                            <h5 class="text-center text-danger">Deductions</h5>
                            <hr>
                            <table class="table table-sm table-bordered table-striped">
                                @foreach ($employee->monthly_grade->deduction as $item)
                                    @php
                                        $t_deduction += $item->deduction_value;
                                    @endphp
                                    <tr>
                                        <th>{{ $item->deduction_label }} :</th>
                                        <td>{{ $item->deduction_value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="text-end fw-bold">
                                Total Deduction: {{ $t_deduction }}
                            </div>
                        </td>
                    </tr>
                    <!-- Allowance Section -->


                    <!-- Deductions Section -->
                </table>


                <div class="border border-info rounded p-3 mt-4">
                    <h5 class="text-center text-info">Total Salary Details</h5>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-right">Gross Salary :</th>
                            <td>{{ ($employee->monthly_grade->basic_salary ?? $employee->hourGrade->basic_salary) + $t_allowance }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Total Deduction :</th>
                            <td>{{ $t_deduction }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Net Salary :</th>
                            <td>{{ ($employee->monthly_grade->basic_salary ?? $employee->hourGrade->basic_salary) + $t_allowance - $t_deduction }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
