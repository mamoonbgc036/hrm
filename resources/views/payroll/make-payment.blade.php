@extends('layouts.app')
<style>
    .form-select,
    .btn-primary {
        height: 38px;
        /* Match the button's height */
    }

    .form-select {
        width: calc(100% + 100px);
        /* Increase width by double */
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Adjust gap between elements */
    }
</style>
@section('title', 'Make Payment')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('payroll.make-payment-details') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="department" class="form-label mb-0" style="flex: 0 0 auto;">Select Department <span
                                class="text-danger">*</span></label>
                        <select id="department" class="form-select" name="departmentId">
                            <option value="" selected disabled>Select Department</option>
                            @forelse ($departments as $item)
                                <option value="{{ $item->id }}"
                                    {{ @$departmentId && $departmentId == $item->id ? 'selected' : null }}>
                                    {{ $item->name }}</option>
                            @empty
                                <option value="">No Entry</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="datepicker" class="form-label mb-0" style="flex: 0 0 auto;">Select Date</label>
                        <input type="text" class="form-control" id="datepicker" name="date"
                            value="{{ @Storage::get('redirect_month') }}" placeholder="Choose Date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Go</button>
                </div>
            </div>
        </form>
    </div>


    {{-- EMP ID	Name	Salary Type	Basic Salary --}}

    @if ($employees)
        <div class="container mt-4">
            <h3 class="text text-success text-center">For The month of {{ Storage::get('month_for_show') }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Emp Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Salary Type</th>
                            <th scope="col">Basic Salary</th>
                            <th scope="col">Status</th>
                            <th scope="col">Method</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ @$employee->name }}</td>
                                <td>
                                    {{ @$employee->hourGrade->grade ?? @$employee->monthly_grade->grade_id }}({{ $employee->grade_string }})
                                </td>
                                <td>
                                    {{ @$employee->hourGrade->basic_salary ?? @$employee->monthly_grade->basic_salary }}
                                </td>
                                <td>{{ $employee->salary_histories->isEmpty() || $employee->salary_histories[0]->status == 'unpaid' ? 'Unpaid' : 'Paid' }}
                                </td>
                                <td>{{ $employee->salary_histories->isEmpty() || $employee->salary_histories[0]->status == 'unpaid' ? 'Unselected' : $employee->salary_histories[0]->payment_method }}
                                </td>
                                @if (@$employee->salary_histories[0]->status == 'paid')
                                    <td><a href="{{ route('payroll.generate-payslip', $employee->id) }}"
                                            class="text text-info">Generate
                                            Payslip</a></td>
                                @else
                                    <td><a href="{{ route('payroll.select-payment', $employee->id) }}"
                                            class="text text-danger">Make
                                            Payment</a></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">There is no employee</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Submit Button -->
            {{-- <div class="d-flex justify-content-end mt-1">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> --}}
        </div>
    @endif
@endsection
