@extends('layouts.app')
@push('css')
    <style>
        .table thead th {
            background-color: #f8f9fa;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        .status-badge {
            padding: 0.5em 1em;
            border-radius: 20px;
        }

        .status-not-started {
            background-color: #00c3ff;
            color: white;
        }

        .status-in-progress {
            background-color: #ffa500;
            color: white;
        }

        .badge-overdue {
            background-color: #ff4d4d;
            color: white;
        }

        .action-btns .btn {
            margin: 0 0.2em;
        }
    </style>
@endpush
@section('title', 'Brand Setting')
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Task Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Name:</strong>
                            </div>
                            <div class="col-md-6">
                                TEST TASK
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Category:</strong>
                            </div>
                            <div class="col-md-6">
                                Category One
                            </div>
                        </div>
                        <!-- More task details here... -->

                        <!-- Timer Section -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <strong>Time Remaining:</strong>
                            </div>
                            <div class="col-md-6">
                                <span id="timer">05:40:30</span> <!-- Timer starts at 5:40:30 -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <div class="container mt-5">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('task.all_task') }}">All Tasks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task.create') }}">New Task</a>
            </li>
        </ul>
        <table class="table table-bordered table-hover datatable">
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox"></th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Assigned To</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <!-- Timer Script -->
    <script>
        // Set the timer duration (in seconds)
        let timerDuration = (5 * 3600) + (40 * 60) + 30; // 5 hours, 40 minutes, 30 seconds

        // Function to format time as HH:MM:SS
        function formatTime(seconds) {
            let hrs = Math.floor(seconds / 3600);
            let mins = Math.floor((seconds % 3600) / 60);
            let secs = seconds % 60;
            return `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        // Timer logic
        function startTimer() {

            const timerElement = document.getElementById('timer');
            const countdown = setInterval(function() {
                timerElement.textContent = formatTime(timerDuration);

                // Check if timer reaches zero
                if (timerDuration <= 0) {
                    clearInterval(countdown);
                }

                // Decrease time by 1 second
                timerDuration++;
            }, 1000);
        }

        // Start the timer when the modal is shown
        $('#exampleModal').on('shown.bs.modal', function() {
            startTimer();
        });
    </script>
    <script>
        $(document).on('click', '.task_for_start_stop', function(e) {
            e.preventDefault();
            let task_id = $(this).data('id');
            let url = "{{ route('task.start_stop', ':id') }}".replace(':id', task_id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.datatable').DataTable().ajax.reload();
                }
            })
        });
        $(document).on('click', '.task_for_delete', function(e) {
            e.preventDefault();
            let task_id = $(this).data('id');
            let url = "{{ route('task.delete', ':id') }}".replace(':id', task_id);
            Swal.fire({
                title: 'Are you sure?',
                text: 'If delete! its unrecoverable',
                confirmButtonText: 'Yes! delete it',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonColor: '#d33',
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('.datatable').DataTable().ajax.reload();
                        }
                    })
                }
            })
        });
        $(document).ready(function() {
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('task.all_task') }}",
                columns: [{
                        data: 'box',
                        name: 'box'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'emp_name',
                        name: 'emp_name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            })
        })
    </script>
@endsection
