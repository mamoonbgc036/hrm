@extends('welfare.welfare-layout')
@section('title', 'Fund Create')
@section('welfare')
    <div class="container form-container">
        <div class="card form-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Make a Contribution</h5>
                <form action="{{ route('welfare.contributions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="contribution_type" class="form-label d-block">Employee Name</label>
                        <select class="form-select form-select-sm w-100" aria-label=".form-select-sm example"
                            name="employee_id" id="contribution_type" required>
                            <option value="monthly">Select a Contributor</option>
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
                        <label for="amount" class="form-label">Contribution Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" step="0.01" required>
                        @error('amount')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contribution_date" class="form-label">Contribution Date</label>
                        <input type="date" class="form-control" name="contribution_date" id="contribution_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="contribution_type" class="form-label d-block">Contribution Type</label>
                        <select class="form-select form-select-sm w-100" name="type" id="contribution_type" required>
                            <option value="monthly">Monthly Contribution</option>
                            <option value="bonus">One-Time Bonus</option>
                            <option value="voluntary">Voluntary Contribution</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit Contribution</button>
                </form>
            </div>
        </div>
    </div>
@endsection
