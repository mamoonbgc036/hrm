@extends('layouts.app')
@section('title','Achievements')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Achievement</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Achievement List</h4>
                </div>
                <div>
                    @can('Achievement deleted button')
                        <a href="{{route('achievement.deleted')}}" class="btn btn-danger btn-sm float-right mb-2" data-toggle="tooltip" title="Show Deleted Achievements"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Achievement</a>
                    @endcan
                    @can('Achievement create')
                        <a href="{{route('achievement.create')}}" class="btn btn-primary btn-sm float-right mb-2" data-toggle="tooltip" title="Add New Achievement"><i class="fa fa-plus" aria-hidden="true"></i>Add Achievement</a>
                    @endcan
                    @can('Achievement pending button')
                        <a href="{{route('pending-employee-to-achievement')}}" class="btn btn-info btn-sm float-right mb-2" data-toggle="tooltip" title="Show Pending Achievements"><i class="fa fa-arrow-right" aria-hidden="true"></i>Pending Achievement</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Achievement Name</th>
                                    <th>Date of Creation</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($achievements as $index=>$row)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$row->achievement_name ?? ''}}</td>
                                        <td>{{$row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i:s A') : ''}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Achievement show')
                                                    <a class="btn btn-sm btn-success" href="{{route('achievement.show',$row->id)}}" data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
                                                @endcan
                                                @can('Achievement give/assign')
                                                    <a class="btn btn-sm btn-info" href="{{route('search-employee-for-achievement',$row->id)}}" data-toggle="tooltip" title="Assign Employee"><i class="fa fa-lg fa-user-plus"></i></a>
                                                @endcan
                                                @can('Achievement edit')
                                                    <a class="btn btn-sm btn-warning" href="{{route('achievement.edit',$row)}}" data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Edit history')
                                                    @include('admin.partial.edit_history',['model' => Spatie\Activitylog\Models\Activity::query()
                                                        ->with('causer')
                                                        ->where('log_name','Achievement')
                                                        ->where('subject_id',$row->id)
                                                        ->where('description','updated')
                                                        ->get()])
                                                @endcan
                                                @can('Achievement delete')
                                                    <form method="POST" action="{{ route('achievement.destroy',$row->id)}}" class="">
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
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Achievement Employees List</h4>
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
                                    <th>Achievement</th>
                                    <th>Memo Date</th>
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
                ajax: '{{ route('achievement.index') }}',
                columns:[
                    {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                    {data:"employee_name", name:'employee_name'},
                    {data:"employee.pin_no", name:'employee.pin_no'},
                    {data:"employee.new_pin", name:'employee.new_pin'},
                    {data:"achievement_name", name:'achievement_name'},
                    {data:"memo_date", name:'memo_date'},
                    {data:"action",searchable:false, orderable:false},
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
                    {
                        extend: 'selected',
                        text: 'Bulk Delete',
                        action: function ( e, datatable, button, config ) {
                            let ids = []
                            datatable.rows( { selected: true } ).data().each(function (item, index) {
                                ids.push(item.id)
                            })

                            let model = '\\App\\Models\\AchievementEmployee'

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
                                        $.post("{{ route('bulk-delete') }}", {_token,model: model,ids: ids}, function(data){
                                            if(data.success){
                                                toastr.success(data.message,'Success',true)
                                                datatable.draw()
                                            } else {
                                                toastr.error(data.message,'Failed',true)
                                            }
                                        })
                                    }
                                });
                        }
                    },
                    'selectAll',
                    'selectNone',
                ],
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
