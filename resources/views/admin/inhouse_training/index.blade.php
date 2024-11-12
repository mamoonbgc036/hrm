@extends('layouts.app')
@section('title','Inhouse Trainings')
@section('content')

    <div class="app-title">
        <div>
            <h1> <i class="fa fa-users" aria-hidden="true"></i> Inhouse Training</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Inhouse Training</h4>
                </div>
                <div>
                    @can('Inhouse training deleted button')
                        <a href="{{route('inhouse-training.deleted')}}" class="btn btn-danger btn-sm float-right mb-2" data-toggle="tooltip" title="Deleted"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted inhouse Training</a>
                    @endcan
                    @can('Inhouse training create')
                        <a href="{{route('inhouse-training.create')}}" class="btn btn-primary btn-sm float-right mb-2 mr-1" data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New inhouse Training</a>
                    @endcan
                    @can('Inhouse training pending button')
                        <a href="{{route('pending-employees-to-inhouse-training')}}" class="btn btn-info btn-sm float-right mb-2 mr-1" data-toggle="tooltip" title="Pending"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Pending inhouse Training</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Date of Creation</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inhouse_trainings as $index=>$row)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$row->course_title ??''}}</td>
                                        <td>{{$row->course_code ??''}}</td>
                                        <td>{{$row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i:s A') : ''}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Inhouse training show')
                                                    <a class="btn btn-success btn-sm" href="{{route('inhouse-training.show',$row)}}"
                                                       data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
                                                @endcan
                                                @can('Inhouse training give/assign')
                                                    <a class="btn btn-info btn-sm" href="{{route('search-employee-for-i-training', $row->id)}}"
                                                       data-toggle="tooltip" title="Assign Employee"><i class="fa fa-lg fa-user-plus"></i></a>
                                                @endcan
                                                @can('Inhouse training edit')
                                                    <a class="btn btn-warning btn-sm" href="{{route('inhouse-training.edit',$row)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Edit history')
                                                    @include('admin.partial.edit_history',['model' => Spatie\Activitylog\Models\Activity::query()
                                                        ->with('causer')
                                                        ->where('log_name','Inhouse Training')
                                                        ->where('subject_id',$row->id)
                                                        ->where('description','updated')
                                                        ->get()])
                                                @endcan
                                                @can('Inhouse training delete')
                                                    <form id="trash" method="POST" action="{{ route('inhouse-training.destroy',$row->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{$row->name }}" type="submit" class="btn btn-danger delete-confirm"
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
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Inhouse-Trained Employees List</h4>
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
                                    <th>Inhouse-Training</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Duration</th>
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
                ajax: '{{ route('inhouse-training.index') }}',
                columns:[
                    {data:"DT_RowIndex",name:"DT_RowIndex", searchable:false, orderable:false},
                    {data:"employee_name", name:'employee_name'},
                    {data:"employee.pin_no", name:'employee.pin_no'},
                    {data:"employee.new_pin", name:'employee.new_pin'},
                    {data:"inhouse_training_name", name:'inhouse_training_name'},
                    {data:"from_date", name:'from_date'},
                    {data:"to_date", name:'to_date'},
                    {data:"duration", name:'duration'},
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

                            let model = '\\App\\Models\\InhouseTrainedEmployee'

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
