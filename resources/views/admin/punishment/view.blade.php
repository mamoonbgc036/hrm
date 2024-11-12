@extends('layouts.app')
@section('title','View Punishment')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>View Punishment</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <span class="card-title">Punishment Info</span>
                    <a class="btn btn-danger btn-sm icon-btn float-right" href="{{route('punishment.index')}}"><i class="fa fa-list"></i>See List</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>PUNISHMENT NAME</th>
                                    <th>DATE OF CREATION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$punishment->name}}</td>
                                    <td>{{$punishment->created_at ? \Carbon\Carbon::parse($punishment->created_at)->format('d-m-Y h:i:s A') : ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="vue_app">
                {{--search employees--}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Employees</span>
                    </div>

                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-uppercase" id="sampleTable2" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Employee</th>
                                        <th>Old PIN</th>
                                        <th>New PIN</th>
                                        <th>Punishment</th>
                                        <th>Date of Punishment</th>
                                        <th class="text-center" style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // DataTable
            $('#sampleTable2').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ route('punishment.show',$punishment->id) }}',
                columns:[
                    {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                    {data:"employee_name", name:'employee_name'},
                    {data:"employee.pin_no", name:'employee.pin_no'},
                    {data:"employee.new_pin", name:'employee.new_pin'},
                    {data:"punishment_name", name:'punishment_name'},
                    {data:"date_of_punishment", name:'date_of_punishment'},
                    {data:"action",searchable:false, orderable:false},
                ],

                "dom": 'C<"clear my-2"><"row"B><"top d-flex justify-content-between"lipf>t<"bottom d-flex justify-content-between"lipf>',
                responsive: true,
                buttons: [
                    {
                        extend: 'colvis',
                        collectionLayout: 'fixed two-column',
                        postfixButtons: ['colvisRestore']
                    },
                    {
                        extend: 'colvisGroup',
                        text: 'Show all',
                        show: ':hidden'
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'selectAll',
                    'selectNone',
                ],
                language: {
                    buttons: {
                        colvis: 'Show/Hide Columns',
                    }
                },
                columnDefs: [
                    {
                        "targets": [],
                        "visible": false
                    },
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }
                ],
                select: {
                    style: 'multi',
                },
            });
        });
    </script>
@endpush
