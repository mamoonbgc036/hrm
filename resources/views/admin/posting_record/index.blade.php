@extends('layouts.app')
@section('title', 'Job Histories')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Job History</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Job History</h4>
                </div>
                <div>
                    {{-- <a href="{{ route('posting-record.export') }}" class="btn btn-success btn-sm float-right"
                        data-toggle="tooltip" title="Export"><i class="fa fa-file-excel" aria-hidden="true"></i>Export
                        All</a>
                    @can('Job history deleted button')
                        <a href="{{ route('posting-record.deleted') }}" class="btn btn-danger btn-sm float-right"
                            data-toggle="tooltip" title="Deleted"><i class="fa fa-trash" aria-hidden="true"></i> Deleted Job
                            History</a>
                    @endcan
                    @can('Job history create')
                        <a href="{{ route('posting-record.create') }}" class="btn btn-primary btn-sm float-right"
                            data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New
                            Transfer</a>
                    @endcan --}}
                    {{-- @can('Job history transfers button')
                        <a href="{{ route('posting-recordss.transfers') }}" class="btn btn-warning btn-sm float-right"
                            data-toggle="tooltip" title="Transfers List"><i class="fa fa-random"
                                aria-hidden="true"></i>Transfers</a>
                    @endcan --}}
                    {{-- @can('Job history promotions button')
                        <a href="{{ route('posting-record.promotions') }}" class="btn btn-success btn-sm float-right"
                            data-toggle="tooltip" title="Promotions List"><i class="fa fa-level-up" aria-hidden="true"></i>
                            Promotions</a>
                    @endcan --}}
                </div>

                <div class="tile-body">

                    <div class="table-responsive">
                        <div id="datatable-loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                            <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable2">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>EMPLOYEE NAME</th>
                                    <th>PIN</th>
                                    <th>OFFICE/STATION NAME</th>
                                    <th>DESIGNATION</th>
                                    <th>FROM</th>
                                    <th>TO</th>
                                    <th>DURATION</th>
                                    <th>TYPE</th>
                                    <th class="text-center" style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Data table plugin-->


@endsection
@push('script')
    <!-- page script -->
    <script>
        $(document).ready(function() {
            let table = null;
            // DataTable
            table = $('#sampleTable2').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('posting-record.index') }}',
                    data: function(d) {
                    },
                    beforeSend: function() {
                        $('#datatable-loader').show();
                    },
                    complete: function() {
                        $('#datatable-loader').hide();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "employee.name",
                        name: 'employee.name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.employee && row.employee.name ? row.employee.name : 'N/A';
                        }
                    },
                    {
                        data: "employee.pin_no",
                        name: 'employee.pin_no',
                        render: function(data) {
                            return data ? data : '';
                        }
                    },
                    {
                        data: "station.name",
                        name: 'station.name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.station && row.station.name ? row.station.name : 'N/A';
                        }
                    },
                    {
                        data: "designation.en_name",
                        name: 'designation.en_name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.designation && row.designation.en_name ? row.designation.en_name : 'N/A';
                        }
                    },
                    {
                        data: "from",
                        name: 'from',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.from ? row.from : 'N/A';
                        }
                    },
                    {
                        data: "to",
                        name: 'to',
                        render: function(data) {
                            return data ? data : '';
                        }
                    },
                    {
                        data: "duration",
                        name: 'duration',
                        render: function(data) {
                            return data ? data : '';
                        }
                    },
                    {
                        data: "type",
                        name: 'type',
                        render: function(data) {
                            return data ? data : '';
                        }
                    },
                    {
                        data: "action",
                        searchable: false,
                        orderable: false
                    },
                ],

                "dom": '<"top"f>t<"bottom"lip>',
                "dom": '<"top"lfr>t<"bottom"ip>',
                "dom": '<"top"Blfr>t<"bottom"ip>',
                "dom": '<"top"Bfl>t<"bottom"ip>',
                responsive: true,
                buttons: [
                    'selectAll',
                    'selectNone',
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
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'selected',
                        text: 'Bulk Delete',
                        action: function(e, datatable, button, config) {
                            let ids = []
                            datatable.rows({
                                selected: true
                            }).data().each(function(item, index) {
                                ids.push(item.id)
                            })

                            let model = '\\App\\Models\\PostingRecord'

                            event.preventDefault();
                            swal({
                                    title: `Are you sure you want to delete all these selected data?`,
                                    text: "If you delete this, it will be gone forever.",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        let _token = "{{ csrf_token() }}";
                                        $.post("{{ route('bulk-delete') }}", {
                                            _token,
                                            model: model,
                                            ids: ids
                                        }, function(data) {
                                            if (data.success) {
                                                toastr.success(data.message, 'Success',
                                                    true)
                                                datatable.draw()
                                            } else {
                                                toastr.error(data.message, 'Failed',
                                                    true)
                                            }
                                        })
                                    }
                                });
                        }
                    },
                ],
                columnDefs: [{
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
                footerCallback: function(row, data, start, end, display) {
                    $(this.api().table().footer()).hide();
                }
            });

        });
    </script>
@endpush
