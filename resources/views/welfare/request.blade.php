@extends('welfare.welfare-layout')
@section('title', 'Welfare Fund Request')
@section('welfare')
    <div class="container form-container">
        <div class="card form-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Welfare Request Form</h5>
                <form action="{{ route('welfare.request') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="contribution_type" class="form-label d-block">Employee Name</label>
                        <select class="form-select form-select-sm w-100" aria-label=".form-select-sm example"
                            name="employee_id" id="contribution_type" required>
                            <option value="monthly">Request From</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contribution_type" class="form-label d-block">Welfare Name</label>
                        <select class="form-select form-select-sm w-100" aria-label=".form-select-sm example"
                            name="welfare_id" id="contributor" required>
                            <option value="monthly">Select a Welfare Fund</option>
                            @foreach ($welfares as $welfare)
                                <option value="{{ $welfare->id }}">{{ $welfare->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount Requested</label>
                        <input type="number" class="form-control" name="amount" id="amount" step="0.01" required>
                        @error('amount')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="15"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
@endsection
