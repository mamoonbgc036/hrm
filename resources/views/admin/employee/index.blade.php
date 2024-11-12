@extends('layouts.app')
@section('title', 'Employees')
@section('content')
@push('styles')
<style>
    .search-inner{
        gap: 20px;
    }
    .date-inner{
        display: flex;
        gap: 3px;
        flex-basis: 33.33%;
    }
    .filter-by-status{
        flex-basis: 33.33%;
    }
    .filter-by-branch{
        flex-basis: 33.33%;
    }
    .date-inner.daterange{
        flex-basis: 100%;
    }
    .date-inner .daterange .between-date{
        width:250px !important;
        height:35px !important;
        font-weight: normal;
        text-transform: capitalize;
    }
    .date-inner .search-btn{
        background-color:green;
    }
    .date-inner .search-btn a{
        padding: 4px !important;
        color:#fff !important;
    }

</style>
@endpush
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Employee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="">
                <h4><i class="fa fa-list" aria-hidden="true"></i>Employee List</h4>
            </div>
        </div>
        <div class="col-md-6 pl-0">
            <div class="search-inner d-flex flex-gap-5">
                <div class="date-inner">
                    <div class="daterange">
                        <input type="text" id="daterange" name="between-date" class="form-control between-date" placeholder="select date" autocomplete="off">
                    </div>
                    <div class="search-btn">
                        <a href="#" id="searchByDateRange" class="btn"><strong>Search</strong></a>
                    </div>
                </div>
                <div class="filter-by-status">
                    <select id="filterDropdown" class="form-control select2">
                        <option value="" disabled selected>-- Select Status --</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="termination">Termination</option>
                        <option value="dismissed">Dismissed</option>
                        <option value="resignation">Resignation</option>
                    </select>
                </div>
                <div class="filter-by-branch">
                    <select id="filterBranch" class="form-control select2">
                        <option value="" disabled selected>-- Select Branch --</option>
                        @if($branchs->count() > 1)
                            @foreach($branchs as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
        </div>
        <div class="col-md-6 pl-0">
            @can('Employee create')
                <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm float-right mb-2 ml-1"
                    data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add
                    New</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="tile">
                <div class="tile-body" style="margin-top:10px">
                    <div class="table-responsive">
                        <div id="datatable-loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                            <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                        </div>
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable2">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">SL NO</th>
                                    <th>Pin No</th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>Salary</th>
                                    <th>Designation</th>
                                    <th>Branch</th>
                                    <th>Date of Join</th>
                                    <th>Date Of Birth</th>
                                    <th class="text-center" style="width: 10%;">Action</th>
                                </tr>
                                {{-- <tr>
                                    <th style="width: 10px;">SL NO</th>
                                    <th>Pin No</th>
                                    <th>Emp. Id</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Branch</th>
                                    <th>Grade</th>
                                    <th>Basic.S</th>
                                    <th>Gross.S</th>
                                    <th>Consolidated.S</th>
                                    <th>Age</th>
                                    <th>S. Age</th>
                                    <th>S.L.F.L.P</th>
                                    <th>C.B. Service Age</th>
                                    <th>Date of Join</th>
                                    <th class="text-center" style="width: 10%;">Action</th>
                                </tr> --}}
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
                    url: '{{ route('employee.index') }}',
                    data: function(d) {
                        d.filter = $('#filterDropdown').val();
                        d.daterange = $('#daterange').val();
                        d.branch = $('#filterBranch').val();
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
                        data: "pin_no",
                        name: 'pin_no',
                    },
                    {
                        data: "name",
                        name: 'name'
                    },
                    {
                        data: "f_name",
                        name: 'f_name'
                    },
                    {
                        data: "monthly_grade.basic_salary",
                        name: 'monthly_grade.basic_salary',
                        render: function(data, type, row) {
                            return data ? data : '';
                        }
                    },
                    {
                        data: "designation.en_name",
                        name: 'designation.en_name',
                        defaultContent: ''
                    },
                    {
                        data: "posting_station.name",
                        name: 'posting_station.name',
                        defaultContent: '',
                        /*searchable: false*/
                    },
                    {
                        data: "join_date",
                        name: "join_date"
                    },
                    {
                        data: "dob",
                        name: "dob"
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
                ],

                columnDefs: [
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

            $('#filterDropdown').change(function(e) {
                table.ajax.reload();
            });

            $('#searchByDateRange').click(function(e) {
                table.ajax.reload();
            });

            $('#filterBranch').change(function(e) {
                table.ajax.reload();
            });

            $('#daterange').daterangepicker({
                autoUpdateInput: <?= !empty($start_date) ? 'true' : 'false'?>,
                locale: {
                    format: 'MMMM D, YYYY'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            $('#daterange').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('M/d/YYYY') + ' - ' + picker.endDate.format('M/d/YYYY'));
            });

            $('#daterange').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

        })
    </script>
@endpush
