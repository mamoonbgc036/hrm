@extends('layouts.app')
@section('title','Admin Activity')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Admin Activity</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Admin Activity List</h4>
                </div>
                <div>
                    @can('Admin activity clear button')
                        <a href="{{route('activity-log-clean-by-name')}}" class="btn btn-danger btn-sm float-right mb-2">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>Clear Log</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable2" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Date</th>
                                    <th>User Type</th>
                                    <th>Username</th>
                                    <th>Module</th>
                                    <th>Type</th>
                                    <th style="width: 10%">Action</th>
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
@endsection

@section('js')

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // DataTable
            $('#sampleTable2').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ route('admin-activity') }}',
                columns: [
                    {data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "date", name: 'date'},
                    {data: "user_type", name: 'user_type', defaultContent: ''},
                    {data: "causer.name", name: 'causer.name', defaultContent: ''},
                    {data: "log_name", name: 'log_name', defaultContent: ''},
                    {data: "type", name: 'type', defaultContent: '', searchable: false},
                    {data: "action", searchable: false, orderable: false},
                ],

                "dom": 'C<"clear"><"row"B><"top d-flex justify-content-between"lipf>t<"bottom d-flex justify-content-between"lipf>',
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
                    // selector: 'td:first-child'
                },
            });
        })
    </script>
@endpush
