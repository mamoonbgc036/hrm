<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\HourRate;
use App\Models\Task;
use Illuminate\Http\Request;
use DataTables;

class TaskController extends Controller
{
    public function create()
    {
        $employees = Employee::all();
        $hourly_rates = HourRate::all();
        return view('hourly.task', compact('employees', 'hourly_rates'));
    }

    public function destroy($id)
    {
        $task_for_delete = Task::findOrFail($id);
        $task_for_delete->delete();
        return response()->json(['delete successfull', 200]);
    }

    public function update(Request $request, $id)
    {
        $task_for_update = Task::findOrFail($id);
        $task_for_update->update($request->except('_token'));
        return redirect()->route('task.all_task');
    }

    public function edit($id)
    {
        $task_for_edit = Task::findOrFail($id);
        $employees = Employee::all();
        $hourly_rates = HourRate::all();
        return view('hourly.task', compact('task_for_edit', 'employees', 'hourly_rates'));
    }

    public function start_stop($id)
    {
        $task = Task::findOrFail($id);
        $task_status_for_update = ($task->task_status == 'started' ? 'not started' : 'started');
        $task->update([
            'task_status' => $task_status_for_update
        ]);

        return response()->json(['task updated successfully', 200]);
    }

    public function all_task()
    {
        $tasks = Task::with('employee')->get();
        if (request()->ajax()) {
            return Datatables::of($tasks)
                ->addColumn('box', function () {
                    return '<input type="checkbox">';
                })->addColumn('category', function ($task) {
                    return $task->category_id == 1 ? 'Category One' : 'Category Two';
                })->addColumn('status', function ($task) {
                    return '<select name="" id="">
                                <option value="">Not Start</option>
                                <option value="">In Progress</option>
                                <option value="">Complete</option>
                                <option value="">Deferred</option>
                            </select>';
                })->addColumn('emp_name', function ($task) {
                    return $task->employee->name;
                })->addColumn('action', function ($task) {
                    $btn = '';
                    $btn .= '<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg></button>';
                    $btn .= '<a href=' . route('task.edit', $task->id) . ' class="btn btn-warning btn-sm mx-1"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg></a>';
                    $btn .= '<button class="btn btn-danger btn-sm mx-1 task_for_delete" data-id="' . $task->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg></button>';
                    $btn .= '<button class="btn ' . ($task->task_status == 'started' ? 'btn-success' : 'btn-danger') . ' btn-sm task_for_start_stop" data-id="' . $task->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                </svg></button>';
                    return $btn;
                })
                ->rawColumns(['box', 'status', 'action'])
                ->make(true);
        }
        return view('hourly.all-task', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create($request->except('_token'));
        return redirect()->route('task.all_task');
    }
}
