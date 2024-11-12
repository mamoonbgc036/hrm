@extends('layouts.app')
<style>
    body {
        background-color: #f8f9fa;
    }

    .payslip-card {
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .payslip-header {
        background-color: #f0f3f7;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .payslip-header h4 {
        margin: 0;
        font-weight: bold;
    }

    .details-section {
        padding: 20px;
    }

    .details-section p {
        margin-bottom: 5px;
    }

    .earnings-table {
        margin-top: 20px;
    }

    .table th {
        background-color: #e9ecef;
        font-weight: bold;
    }

    .total-details {
        background-color: #f0f3f7;
        padding: 20px;
        margin-top: 20px;
        border-radius: 10px;
    }

    .total-details h5 {
        margin-bottom: 15px;
    }

    .payslip-footer {
        padding: 20px;
        background-color: #f0f3f7;
        border-top: 1px solid #ddd;
    }

    .detials_inner {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap
    }

    .label_title {
        flex-basis: 50%;
        text-align-last: right;
        font-weight: 500;
    }

    .label_value {
        flex-basis: 50%;
        text-align-last: left;
        padding-left: 15px;
    }

    @media print {
        .payslip-card h4 {
            border-radius: 10px;
            color: #b42a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .details-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .details-section .col-md-6 {
            flex: 1;
            max-width: 48%;
        }
    }
</style>
@section('title', 'Make Payment')
@section('content')
    <div class="container mt-5">
        <button class="float-right" onclick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                <path
                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
            </svg></button>
        <div class="card payslip-card">
            <div class="payslip-header text-center">
                <h4>Payslip - Salary Month: {{ Storage::get('month_for_show') }}</h4>
                <p class="mb-0">POPI - Powerful HR, Accounting, CRM System</p>
            </div>
            <div class="row details-section">
                <div class="col-md-6 d-flex justify-content-center">
                    <div>
                        <p><strong>Employment ID: </strong> {{ $data_for_payslip->id }}</p>
                        <p><strong>Mobile: </strong>{{ $data_for_payslip->mobile_no }}</p>
                        <p><strong>Departments: </strong> {{ $data_for_payslip->department->name }}</p>
                        <p><strong>Payslip No: </strong> {{ $data_for_payslip->id }}</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <div>
                        <p><strong>Name: </strong> {{ $data_for_payslip->name }}</p>
                        <p><strong>Email: </strong> {{ $data_for_payslip->email }}</p>
                        <p><strong>Designation: </strong> {{ $data_for_payslip->designation->en_name }}</p>
                        <p><strong>Joining Date: </strong> {{ $data_for_payslip->joining_date ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-md-6">
                    @php
                        $basic = 0;
                        $tAllowance = 0;
                        $gross = 0;
                    @endphp
                    <h4>Allowance</h4>
                    <table class="table table-bordered m-2">
                        <tbody class="text-center">
                            @if ($data_for_payslip->monthly_grade && $data_for_payslip->monthly_grade->allowances->count() > 0)
                                @foreach ($data_for_payslip->monthly_grade->allowances as $allowance)
                                    @php
                                        $singleAllowance =
                                            ($data_for_payslip->monthly_grade->basic_salary / 100) *
                                            $allowance->allowance_percent;
                                        $tAllowance += $singleAllowance;
                                    @endphp
                                    <tr>
                                        <td>{{ $allowance->allowance_label }}</td>
                                        <td> {{ $singleAllowance }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Deduction</h4>
                    <table class="table table-bordered mr-2">
                        <tbody class="text-center">
                            @php
                                $tDeduction = 0;
                            @endphp
                            @if ($data_for_payslip->monthly_grade && $data_for_payslip->monthly_grade->deduction->count() > 0)
                                @foreach ($data_for_payslip->monthly_grade->deduction as $deduction)
                                    @php
                                        $tDeduction += $deduction->deduction_value;
                                    @endphp
                                    <tr>
                                        <td>{{ $deduction->deduction_label }}</td>
                                        <td>{{ $deduction->deduction_value ?? null }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($data_for_payslip->salary_histories && $data_for_payslip->salary_histories[0]->f_deduction != null)
                                @php
                                    $tDeduction += $data_for_payslip->salary_histories[0]->f_deduction;
                                @endphp
                                <tr>
                                    <td>Fine Deduction</td>
                                    <td>{{ $data_for_payslip->salary_histories[0]->f_deduction }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row details-section">
                <div class="col-md-12">
                    <div class="total-details text-center">
                        <div class="total-details">
                            <h5 class="text-primary">Total Details</h5>
                            <div class="detials_inner row">
                                <div class="section col-md-6 d-flex justify-content-center">
                                    @if ($data_for_payslip->monthly_grade && $data_for_payslip->monthly_grade->basic_salary)
                                        @php
                                            $basic = $data_for_payslip->monthly_grade->basic_salary;
                                        @endphp
                                    @endif
                                    <div>
                                        <div class="label_title d-flex justify-content-around">
                                            <p for="" class="allowance_label text-blod">Basic Salary :
                                            </p>
                                            <strong>{{ $basic }}</strong>
                                        </div>
                                        <div class="label_title d-flex justify-content-around">
                                            <p for="" class="allowance_label text-blod">Total Deduction :
                                            </p>
                                            <strong>{{ $tDeduction }}</strong>
                                        </div>
                                        <div class="label_title d-flex justify-content-around">
                                            <p for="" class="allowance_label text-blod">Total Allowance :
                                            </p>
                                            <strong>{{ $tAllowance }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="section col-md-6 d-flex justify-content-center">
                                    <div>
                                        <div class="label_title d-flex justify-content-around">
                                            <p for="" class="allowance_label text-blod">Gross Salary :
                                            </p>
                                            <strong>{{ $basic + $tAllowance - $tDeduction }} </strong>
                                        </div>
                                        <div class="label_title d-flex justify-content-around">
                                            <p for="" class="allowance_label text-blod">Net Salary :
                                            </p>
                                            <strong>{{ $basic + $tAllowance - $tDeduction }}</strong>
                                        </div>
                                        <div class="label_title d-flex justify-content-around">
                                            <p for="" class="allowance_label text-blod">Paid Amount :
                                            </p>
                                            <strong>{{ $basic + $tAllowance - $tDeduction }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payslip-footer text-center">
                <p class="mb-0">This is a computer-generated document and requires no signature.</p>
            </div>
        </div>
    </div>
@endsection
