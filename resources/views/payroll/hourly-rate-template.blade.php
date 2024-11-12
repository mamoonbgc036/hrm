@extends('layouts.app')
@section('title', 'Hourly Rate')
@section('content')
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="https://ziscoerp.com/admin/payroll/hourly_rate">Hourly Rate List</a>
                    </li>
                    <li class=""><a href="https://ziscoerp.com/admin/payroll/create_hourlyrate">Set Hourly Grade</a>
                    </li>
                </ul>
                <div class="tab-content bg-white">
                    <!-- ************** general *************-->
                    <div class="tab-pane active" id="manage">
                        <div id="DataTables_wrapper" class="dataTables_wrapper form-inline no-footer">
                            <div class="dataTables_length" id="DataTables_length"><label><select name="DataTables_length"
                                        aria-controls="DataTables" class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select></label></div>
                            <div class="dt-buttons"><a class="dt-button buttons-print btn btn-danger btn-xs mr"
                                    tabindex="0" aria-controls="DataTables"><span><i class="fa fa-print">
                                        </i></span></a><a class="dt-button buttons-print btn btn-success mr btn-xs"
                                    tabindex="0" aria-controls="DataTables"><span><i class="fa fa-print"> </i>
                                        &nbsp;selected</span></a><a
                                    class="dt-button buttons-excel buttons-html5 btn btn-purple mr btn-xs" tabindex="0"
                                    aria-controls="DataTables"><span><i class="fa fa-file-excel-o"> </i></span></a><a
                                    class="dt-button buttons-csv buttons-html5 btn btn-primary mr btn-xs" tabindex="0"
                                    aria-controls="DataTables"><span><i class="fa fa-file-excel-o"> </i></span></a><a
                                    class="dt-button buttons-pdf buttons-html5 btn btn-info mr btn-xs" tabindex="0"
                                    aria-controls="DataTables"><span><i class="fa fa-file-pdf-o"> </i></span></a><a
                                    class="dt-button btn btn-xs btn-default custom-bulk-button" tabindex="0"
                                    aria-controls="DataTables"><span>Bulk Delete</span></a></div>
                            <div id="DataTables_filter" class="dataTables_filter"><label>Search all columns:<input
                                        type="search" class="form-control input-sm" placeholder=""
                                        aria-controls="DataTables"></label></div>
                            <div id="DataTables_processing" class="dataTables_processing" style="display: none;">
                                Processing...</div>
                            <table class="table table-striped DataTables  dataTable no-footer dtr-inline" id="DataTables"
                                cellspacing="0" width="100%" role="grid" aria-describedby="DataTables_info"
                                style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="col-sm-1 sorting" tabindex="0" aria-controls="DataTables"
                                            rowspan="1" colspan="1" style="width: 121px;"
                                            aria-label="SL: activate to sort column ascending">SL</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1"
                                            colspan="1" style="width: 627px;"
                                            aria-label="Hourly Grade: activate to sort column ascending">Hourly Grade</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1"
                                            colspan="1" style="width: 569px;"
                                            aria-label="Hourly Rate: activate to sort column ascending">Hourly Rate</th>
                                        <th class="col-sm-2 sorting" tabindex="0" aria-controls="DataTables"
                                            rowspan="1" colspan="1" style="width: 257px;"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr id="table_0" role="row" class="odd">
                                        <td tabindex="0">1</td>
                                        <td>Hourly C</td>
                                        <td>$ 50,00</td>
                                        <td><a href="https://ziscoerp.com/admin/payroll/create_hourlyrate/3"
                                                class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                                                data-placement="top"><i class="fa fa-pencil-square-o"></i></a> <strong
                                                data-toggle="tooltip" data-placement="top" style="cursor:pointer"
                                                class="" title="Delete" data-fade-out-on-success="#table_0"
                                                data-act="ajax-request"
                                                data-action-url="https://ziscoerp.com/admin/payroll/delete_hourly_rate/3"><i
                                                    class="btn btn-xs btn-danger fa fa-trash-o"></i></strong> </td>
                                    </tr>
                                    <tr id="table_1" role="row" class="even">
                                        <td tabindex="0">2</td>
                                        <td>Hourly B</td>
                                        <td>$ 75,00</td>
                                        <td><a href="https://ziscoerp.com/admin/payroll/create_hourlyrate/2"
                                                class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                                                data-placement="top"><i class="fa fa-pencil-square-o"></i></a> <strong
                                                data-toggle="tooltip" data-placement="top" style="cursor:pointer"
                                                class="" title="Delete" data-fade-out-on-success="#table_1"
                                                data-act="ajax-request"
                                                data-action-url="https://ziscoerp.com/admin/payroll/delete_hourly_rate/2"><i
                                                    class="btn btn-xs btn-danger fa fa-trash-o"></i></strong> </td>
                                    </tr>
                                    <tr id="table_2" role="row" class="odd">
                                        <td tabindex="0">3</td>
                                        <td>Hourly A</td>
                                        <td>$ 25,00</td>
                                        <td><a href="https://ziscoerp.com/admin/payroll/create_hourlyrate/1"
                                                class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                                                data-placement="top"><i class="fa fa-pencil-square-o"></i></a> <strong
                                                data-toggle="tooltip" data-placement="top" style="cursor:pointer"
                                                class="" title="Delete" data-fade-out-on-success="#table_2"
                                                data-act="ajax-request"
                                                data-action-url="https://ziscoerp.com/admin/payroll/delete_hourly_rate/1"><i
                                                    class="btn btn-xs btn-danger fa fa-trash-o"></i></strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="dataTables_info" id="DataTables_info" role="status" aria-live="polite">Showing
                                1 to 3 of 3 Entries</div>
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous disabled" aria-controls="DataTables"
                                        tabindex="0" id="DataTables_previous"><a href="#">Previous</a></li>
                                    <li class="paginate_button active" aria-controls="DataTables" tabindex="0"><a
                                            href="#">1</a></li>
                                    <li class="paginate_button next disabled" aria-controls="DataTables" tabindex="0"
                                        id="DataTables_next"><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container mt-5">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="hourlyRateTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if (!@$editMode) active @endif" id="all-hourly-rate-tab" data-toggle="tab"
                    href="#all-hourly-rate" role="tab" aria-controls="all-hourly-rate" aria-selected="true">All Hourly
                    Rate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (@$editMode) active @endif" id="set-hourly-rate-tab"
                    data-toggle="tab" href="#set-hourly-rate" role="tab" aria-controls="set-hourly-rate"
                    aria-selected="false">
                    @if (@$editMode)
                        Update Hourly
                        Rate
                    @else
                        Set Hourly Rate
                    @endif
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="hourlyRateTabContent">
            <!-- All Hourly Rate Tab -->
            <div class="tab-pane fade @if (!@$editMode) show active @endif" id="all-hourly-rate"
                role="tabpanel" aria-labelledby="all-hourly-rate-tab">
                <div class="mt-3">
                    <h4>All Hourly Rate</h4>
                    <table class="table table-bordered" id="hourlyRateTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Hourly Grade</th>
                                <th>Hourly Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>$20</td>
                                <td><a href="https://ziscoerp.com/admin/payroll/create_hourlyrate/3"
                                        class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                                        data-placement="top"><i class="fa fa-pencil-square-o"></i></a> <strong
                                        data-toggle="tooltip" data-placement="top" style="cursor:pointer" class=""
                                        title="Delete" data-fade-out-on-success="#table_0" data-act="ajax-request"
                                        data-action-url="https://ziscoerp.com/admin/payroll/delete_hourly_rate/3"><i
                                            class="btn btn-xs btn-danger fa fa-trash-o"></i></strong> </td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>$25</td>
                                <td>
                                    <a href="https://ziscoerp.com/admin/payroll/create_hourlyrate/3"
                                        class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"
                                        data-placement="top"><i class="fa fa-pencil-square-o"></i></a> <strong
                                        data-toggle="tooltip" data-placement="top" style="cursor:pointer" class=""
                                        title="Delete" data-fade-out-on-success="#table_0" data-act="ajax-request"
                                        data-action-url="https://ziscoerp.com/admin/payroll/delete_hourly_rate/3"><i
                                            class="btn btn-xs btn-danger fa fa-trash-o"></i></strong>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody> --}}
                    </table>
                </div>
            </div>

            <!-- Set Hourly Rate Tab -->
            <div class="tab-pane @if (@$editMode) show active @endif fade" id="set-hourly-rate"
                role="tabpanel" aria-labelledby="set-hourly-rate-tab">
                <div class="mt-3">
                    @if (!@$editMode)
                        <h4>Set Hourly Rate</h4>
                        <form action="{{ route('hourly.rates.store') }}" method="POST">
                            @csrf
                        @else
                            <h4>Update Hourly Rate</h4>
                            <form action="{{ route('hourly.rate.update', $hourRate->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="employeeName">Hourly Grade</label>
                        <input type="text" name="grade" value="{{ @$hourRate->grade }}" class="form-control"
                            id="employeeName" placeholder="Grade">
                    </div>
                    <div class="form-group">
                        <label for="hourlyRate">Hourly Rate</label>
                        <input type="number" name="basic_salary" value="{{ @$hourRate->basic_salary }}"
                            class="form-control" id="hourlyRate" placeholder="Rate">
                    </div>
                    <button type="submit" class="btn btn-primary">Set Rate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#hourlyRateTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('payroll.hourly-rate') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'basic_salary',
                        name: 'basic_salary'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
@endsection
