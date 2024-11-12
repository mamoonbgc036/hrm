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
@section('title', 'Brand Setting')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('payroll.manage-a-salary') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if ($employees)
        <div class="container mt-4">
            <form action="{{ route('payroll.update.salary', $departmentId) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Hourly</th>
                                <th scope="col">Monthly</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ @$employee->designation->en_name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <input type="hidden" name="hourly_type_{{ $employee->id }}"
                                                class="form-check-input me-2" {{ $employee->hourGrade ? 'checked' : null }}>
                                            {{-- <select class="form-select form-select-sm" id="hour_grade_{{ $employee->id }}"
                                            name="hour_grade[]"> --}}
                                            <select class="form-select form-select-sm" id="hour_grade_{{ $employee->id }}"
                                                name="hour_grade_id[{{ $employee->id }}]">
                                                <option value="" selected disabled>Select Hourly Grade</option>
                                                @forelse ($hourly_grades as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $employee->hourGrade && $employee->hourGrade->id == $item->id ? 'selected' : null }}>
                                                        {{ $item->grade }}</option>
                                                @empty
                                                    <option value="">No Entry</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <input type="hidden" name="monthly_type_{{ $employee->id }}"
                                                class="form-check-input me-2" {{ $employee->jobGrade ? 'checked' : null }}>
                                            <input type="hidden" name="employee_id" value="{{ @$employee_id }}">
                                            <select class="form-select form-select-sm" id="month_grade_{{ $employee->id }}"
                                                name="month_grade_id[{{ $employee->id }}]">
                                                {{-- <select class="form-select form-select-sm" id="month_grade_{{ $employee->id }}"
                                            name="month_grade[]"> --}}
                                                <option value="" disabled selected>Select Monthly Grade</option>
                                                {{-- @dd($employee) --}}
                                                @forelse ($monthly_grades as $item)
                                                    <option value="{{ $item->grade_id }}"
                                                        {{ $employee->monthly_grade && $employee->monthly_grade->grade_id == $item->grade_id ? 'selected' : null }}>
                                                        {{ $item->grade_id }}</option>
                                                    {{-- <option value="{{ $item->id }}">{{ $item->grade_id }}</option> --}}
                                                @empty
                                                    <option value="">No Entry</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </td>
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
                <div class="d-flex justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (gettype($employees) != 'boolean')
                @foreach ($employees as $employee)
                    const hourSelect_{{ $employee->id }} = document.getElementById(
                        'hour_grade_{{ $employee->id }}');
                    const monthSelect_{{ $employee->id }} = document.getElementById(
                        'month_grade_{{ $employee->id }}');

                    // When hourly grade is changed
                    hourSelect_{{ $employee->id }}.addEventListener('change', function() {
                        monthSelect_{{ $employee->id }}.selectedIndex = 0; // Reset monthly select
                    });

                    // When monthly grade is changed
                    monthSelect_{{ $employee->id }}.addEventListener('change', function() {
                        hourSelect_{{ $employee->id }}.selectedIndex = 0; // Reset hourly select
                    });
                @endforeach
            @endif
        });
    </script>
@endsection
