@extends('layouts.app')
@section('title','Punishments')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Punishment</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Punishment List</h4>
                </div>
                <div>
                    @can('Punishment deleted button')
                        <a href="{{route('punishment.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Show Deleted Punishments"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Punishments</a>
                    @endcan
                    @can('Punishment create')
                        <a href="{{route('punishment.create')}}" class="btn btn-primary btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Add New Punishment"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</a>
                    @endcan
                    @can('Punishment pending button')
                        <a href="{{route('pending-employee-to-punishment')}}" class="btn btn-info btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Show Pending Punishments"><i class="fa fa-arrow-right" aria-hidden="true"></i>Pending Punishments</a>
                    @endcan
                </div>

                <div class="tile-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>PUNISHMENT NAME</th>
                                <th>DATE OF CREATION</th>
                                <th class="text-center" style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($punishments as $row)
                                <tr>
                                    <td style="width: 10%">{{$loop->index+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i:s A') : ''}}</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            @can('Punishment show')
                                                <a class="btn btn-sm btn-success" href="{{route('punishment.show',$row) }}"
                                                   data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
                                            @endcan
                                            @can('Punishment give/assign')
                                                <a class="btn btn-sm btn-info" href="{{route('search-employee-for-punishment',$row->id) }}"
                                                   data-toggle="tooltip" title="Give Punishment"><i class="fa fa-lg fa-user-plus"></i></a>
                                            @endcan
                                            @can('Punishment edit')
                                                <a class="btn btn-sm btn-warning" href="{{route('punishment.edit',$row)}}"
                                                   data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                            @endcan
                                            @can('Edit history')
                                                @include('admin.partial.edit_history',['model' => Spatie\Activitylog\Models\Activity::query()
                                                    ->with('causer')
                                                    ->where('log_name','Punishment')
                                                    ->where('subject_id',$row->id)
                                                    ->where('description','updated')
                                                    ->get()])
                                            @endcan
                                            @can('Punishment delete')
                                                <form id="trash" method="POST" action="{{ route('punishment.destroy',$row->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{$row->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                        data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
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
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Employee Punishments List</h4>
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
                ajax: '{{ route('punishment.index') }}',
                columns:[
                    {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                    {data:"employee_name", name:'employee_name'},
                    {data:"employee.pin_no", name:'employee.pin_no'},
                    {data:"employee.new_pin", name:'employee.new_pin'},
                    {data:"punishment_name", name:'punishment_name'},
                    {data:"date_of_punishment", name:'date_of_punishment'},
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
                    {
                        extend: 'selected',
                        text: 'Bulk Delete',
                        action: function ( e, datatable, button, config ) {
                            let ids = []
                            datatable.rows( { selected: true } ).data().each(function (item, index) {
                                ids.push(item.id)
                            })

                            let model = '\\App\\Models\\PunishmentEmployee'

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
