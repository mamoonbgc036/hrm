@extends('layouts.app')
@section('title', 'Task Create')
@section('content')
    <div class="container mt-5">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('task.all_task') }}">All Tasks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task.create') }}">New Task</a>
            </li>
        </ul>
        @if (is_null(@$task_for_edit))
            <form action="{{ route('task.create') }}" method="POST">
            @else
                <form action="{{ route('task.update', $task_for_edit->id) }}" method="POST">
                    @method('PATCH')
        @endif
        @csrf
        <div class="row">
            <!-- Left Side -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="taskName" class="form-label">Task Name*</label>
                    <input type="text" name="name" class="form-control" value="{{ @$task_for_edit->name }}"
                        id="taskName" placeholder="Task Name">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Select Category</label>
                    <select class="form-select form-control" name="category_id" id="category">
                        <option selected>---Select---</option>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" name="start_date" value="{{ @$task_for_edit->start_date }}" class="form-control"
                        id="startDate">
                </div>

                <div class="mb-3">
                    <label for="dueDate" class="form-label">Due Date*</label>
                    <input type="date" name="due_date" value="{{ @$task_for_edit->due_date }}" class="form-control"
                        id="dueDate">
                </div>

                <!-- Assigned To -->
                <label class="form-label">Assigned To</label>
                <div class="mb-3">
                    <select class="form-select form-control" name="employee_id" id="taskStatus">
                        <option selected>Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ @$task_for_edit->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Task Description -->
                <div class="mb-3 mt-3">
                    <label for="taskDescription" class="form-label">Task Description</label>
                    <textarea class="form-control" name="description" id="taskDescription" rows="5">{{ @$task_for_edit->description }}</textarea>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="hourlyRate" class="form-label">Hourly Rate</label>
                    <select class="form-select form-control" name="hour_rate_id" id="taskStatus">
                        <option selected>Select Employee</option>
                        @foreach ($hourly_rates as $item)
                            <option value="{{ $item->id }}"
                                {{ @$task_for_edit->hour_rate_id == $item->id ? 'selected' : '' }}>{{ $item->HourlyRate }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="estimatedHour" class="form-label">Estimated Hour</label>
                    <input type="text" class="form-control" value="{{ @$task_for_edit->estimated_time }}"
                        name="estimated_time" id="estimatedHour" placeholder="Estimated Hour">
                </div>

                <div class="mb-3">
                    <label for="taskStatus" class="form-label">Task Status*</label>
                    <select class="form-select" name="task_status" id="taskStatus">
                        <option selected>Not Started</option>
                        <option value="1">In Progress</option>
                        <option value="2">Completed</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Billable*</label>
                    <select class="form-select bg-success text-white" name="billable" id="billable">
                        <option selected value="yes" {{ @$task_for_edit->billable == 'yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="no" {{ @$task_for_edit->billable == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <button type="submit"
                    class="btn btn-primary float-end">{{ is_null(@$task_for_edit) ? 'Save' : 'Update' }}</button>
            </div>
        </div>
        </form>
    </div>
@endsection
