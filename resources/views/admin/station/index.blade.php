@extends('layouts.app')
@section('title','Offices/Stations')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Station</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Office/Station List</h4>
                </div>
                <div>
                    @can('Station deleted button')
                        <a href="{{route('station.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                            data-toggle="tooltip" title="Deleted List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Station</a>
                    @endcan
                    @can('Station create')
                        <a href="{{route('station.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                            data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add Station</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable2">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Office/Station Name</th>
                                    <th>Code</th>
                                    {{--<th>Zone</th>
                                    <th>Phone</th>--}}
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Upazila/Thana</th>
                                    <th>Category</th>
                                    <th class="text-center" style="width:12%;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Office/Station Name</th>
                                <th>Code</th>
                                {{--<th>Zone</th>
                                <th>Phone</th>--}}
                                <th>Division</th>
                                <th>District</th>
                                <th>Upazila/Thana</th>
                                <th>Category</th>
                                <th class="text-center" style="width:12%;">Action</th>
                            </tr>
                            </tfoot>
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
    <!-- page script -->
    <script>
        $(document).ready( function (){
            let table = null;

            // Setup - add a text input to each footer cell
            $('#sampleTable2 tfoot th').each( function () {
                let title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            table = $('#sampleTable2').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ route('station.index') }}',
                columns:[
                    {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                    {data:"name", name:'name'},
                    {data:"code", name:'code'},
                    /*{data:"area", name:'area'},
                    {data:"phone", name:'phone'},*/
                    {data:"division.name", name:'division.name'},
                    {data:"district.name", name:'district.name'},
                    {data:"upazila.name", name:'upazila.name'},
                    {data:"station_category", name:'station_category'},
                    {data:"action",searchable:false, orderable:false},
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
                /*"stateSave": true,
                "stateSaveParams": function (settings, data) {
                    let temp = {};
                    $('#sampleTable2 tfoot input').each(function() {
                        temp[ $(this).attr('placeholder') ] = this.value;
                    });
                    data.colsFilter = temp;
                },
                "stateLoadParams": function (settings, data) {
                    $.each(data.colsFilter, function(key, val) {
                        $('#sampleTable2 tfoot input[placeholder="'+key+'"]').val(val);
                    });
                }*/
            });

            // Apply the search
            table.columns().every( function () {
                let that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            });
        })
    </script>
@endpush
