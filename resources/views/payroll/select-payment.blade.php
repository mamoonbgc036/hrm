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
                        <input type="text" class="form-control" id="datepicker" name="date" placeholder="Choose Date">
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
    {{-- gross_salary	varchar(255)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	5	t_allowanc	varchar(255)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	6	t_deduction	varchar(255)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	7	o_deduction	varchar(255)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	8	o_allowanc	varchar(255)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	9	month_year	varchar(255)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	10	comment	text	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	11	status	varchar(255)	utf8mb4_unicode_ci		No	unpaid			Change Change	Drop Drop	
	12	payment_method --}}
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Payment For <span class="text-danger">{{ Storage::get('month_for_show') }}</span>
                </h5>
                <form action="{{ route('payment.payment-update', $data['employee_id']) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div>
                        <input type="text" type="hidden" style="display: none" name="update_for_date"
                            value="{{ Storage::get('month_for_search') }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="gross-salary" class="form-label">Gross Salary</label>
                            <input type="text" class="form-control" id="gross-salary" name="gross_salary"
                                value="{{ $data['gross_salary'] }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="total-deduction" class="form-label">Total Deduction</label>
                            <input type="text" class="form-control" name="t_deduction" id="total-deduction"
                                value="{{ $data['total_deduction'] }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="total-deduction" class="form-label">Fine Deduction</label>
                            <input type="text" class="form-control" name="f_deduction" id="total-deduction"
                                value="{{ @$data['f_deduction'] }}">
                        </div>
                        <div class="col-md-4">
                            <label for="net-salary" class="form-label">Net Salary</label>
                            <input type="text" class="form-control" name="net_salary" id="net-salary"
                                value="{{ $data['net_salary'] }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="payment-method" class="form-label">Payment Method <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="payment-method" name="payment_method" style="width: 100%"
                                required>
                                <option selected>Select Payment Method</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="select-account" class="form-label">Select Accounts</label>
                            <select class="form-select" style="width:100%" id="select-account">
                                <option value="hdfc" selected>hdfc</option>
                                <option value="icici">icici</option>
                            </select>
                            <a href="#" class="text-primary mt-1 d-block">+ Add new</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" name="comment" id="comments" rows="2"></textarea>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="deduct-account">
                                <label class="form-check-label" for="deduct-account">Deduct From Account</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
