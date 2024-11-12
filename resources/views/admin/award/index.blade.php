@extends('layouts.app')
@section('title','Awards')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> AWARD</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Award List</h4>
                </div>
                {{-- <div>
                    @can('Award deleted button')
                        <a href="{{route('award.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Show Deleted Awards"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Awards</a>
                    @endcan
                    @can('Award create')
                        <a href="{{route('award.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New Award"><i class="fa fa-plus" aria-hidden="true"></i>Add Award</a>
                    @endcan
                    @can('Award pending button')
                        <a href="{{route('pending-employee-to-award')}}" class="btn btn-info btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Show Pending Awards"><i class="fa fa-arrow-right" aria-hidden="true"></i>Pending Awards</a>
                    @endcan
                </div> --}}
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Award Name</th>
                                    <th>Date of Creation</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($awards as $index=>$row)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$row->award_name ?? ''}}</td>
                                        <td>{{$row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i:s A') : ''}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Award show')
                                                    <a class="btn btn-sm btn-success" href="{{route('award.show',$row->id)}}" data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
                                                @endcan
                                                @can('Award give/assign')
                                                    <a class="btn btn-sm btn-info" href="{{route('search-employee-for-award',$row->id)}}" data-toggle="tooltip" title="Assign Employee"><i class="fa fa-lg fa-user-plus"></i></a>
                                                @endcan
                                                @can('Award edit')
                                                    <a class="btn btn-sm btn-warning" href="{{route('award.edit',$row)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Edit history')
                                                    @include('admin.partial.edit_history',['model' => Spatie\Activitylog\Models\Activity::query()
                                                        ->with('causer')
                                                        ->where('log_name','Award')
                                                        ->where('subject_id',$row->id)
                                                        ->where('description','updated')
                                                        ->get()])
                                                @endcan
                                                @can('Award delete')
                                                    <form method="POST" action="{{ route('award.destroy',$row->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{$row->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm" data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Awarded Employees List</h4>
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable2" style="width:100%;">
                            {{-- <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Employee</th>
                                    <th>Old PIN</th>
                                    <th>New PIN</th>
                                    <th>Award</th>
                                    <th>Memo Date</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead> --}}
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Pin NO.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Award Name</th>
                                    <th>Achievement Name</th>
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

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // DataTable
            $('#sampleTable2').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ route('award.index') }}',
                // columns:[
                //     {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                //     {data:"employee_name", name:'employee_name'},
                //     {data:"employee.pin_no", name:'employee.pin_no'},
                //     {data:"employee.new_pin", name:'employee.new_pin'},
                //     {data:"award_name", name:'award_name'},
                //     {data:"memo_date", name:'memo_date'},
                //     {data:"action",searchable:false, orderable:false},
                // ],

                columns: [
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "pin_no",
                        name: 'pin_no',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.pin_no ? row.pin_no : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "name",
                        name: 'name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.name ? row.name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "date",
                        name: 'date',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.date ? row.date : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "description",
                        name: 'description',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.description ? row.description : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "award_name",
                        name: 'award_name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.award_name ? row.award_name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "achievement_name",
                        name: 'achievement_name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.achievement_name ? row.achievement_name : 'N/A';  // or ''
                        }
                    },
                ],

                "dom": '<"top"f>t<"bottom"lip>',
                "dom": '<"top"lfr>t<"bottom"ip>',
                "dom": '<"top"Blfr>t<"bottom"ip>',
                responsive: true,
                buttons: [
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
                ],
            });
        });
    </script>
@endpush
