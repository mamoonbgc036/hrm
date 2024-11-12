@extends('layouts.app')
@section('title','Pending Inhouse Trainings')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Pending Employee inhouse Trainings</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Pending inhouse Training </h4>
                </div>
                <div>
                    @can('Inhouse training list')
                        <a href="{{route('inhouse-training.index')}}" class="btn btn-info btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All inhouse Training</a>
                    @endcan
                    @can('Inhouse training create')
                        <a href="{{route('inhouse-training.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus" aria-hidden="true"></i>Add inhouse Training</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>inhouse Training Name</th>
                                    <th>Employee Name</th>
                                    <th>Old PIN</th>
                                    <th>New PIN</th>
                                    <th>Date of Creation</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingEmployeeToinhouseTrainings as $row)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td><a href="{{route('inhouse-training.show',$row->inhouse_training_id)}}" target="_blank">{{$row->course_title}}</a></td>
                                        <td><a href="{{route('employee.show',$row->employee_id)}}" target="_blank">{{$row->employee_name}}</a></td>
                                        <td>{{$row->pin_no}}</td>
                                        <td>{{$row->new_pin}}</td>
                                        <td>{{ $row->created_at != null ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y  h:i:s A'):'' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('Inhouse training approve')
                                                    <a href="{{route('approve-deny-employee-inhouse-training',[$row->id, 'approve'])}}" class="btn btn-sm btn-success btn-sm"
                                                       data-toggle="tooltip" title="Approve"><i class="fa fa-check">Approve</i></a>
                                                @endcan
                                                @can('Inhouse training deny')
                                                    <a href="{{route('approve-deny-employee-inhouse-training',[$row->id, 'deny'])}}" class="btn btn-sm btn-danger btn-sm"
                                                       data-toggle="tooltip" title="Deny"><i class="fa fa-times">Deny</i></a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
    <!-- page script -->
    @section('datatable-buttons')
        {
            text: 'Approve All',
            action: function ( e, datatable, button, config ) {
            let ids = []
            datatable.rows( { selected: true } ).data().each(function (item, index) {
                ids.push(item.id)
            })

            let model = '\\App\\Models\\InhouseTrainedEmployee'

            event.preventDefault();
            swal({
                title: `Are you sure you want to Approve All these selected data?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let _token = "{{ csrf_token() }}";
                        $.post("{{ route('approve-all') }}", {_token,model: model,ids: ids}, function(data){
                            if(data.success){
                                datatable.draw()
                                toastr.success(data.message,'Success',true)
                                location.reload();
                            } else {
                                toastr.error(data.message,'Failed',true)
                            }
                        })
                    }
                });
            }
        },
        {
            text: 'Deny All',
            action: function ( e, datatable, button, config ) {
            let ids = []
            datatable.rows( { selected: true } ).data().each(function (item, index) {
                ids.push(item.id)
            })

            let model = '\\App\\Models\\InhouseTrainedEmployee'

            event.preventDefault();
            swal({
                title: `Are you sure you want to Deny All these selected data?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let _token = "{{ csrf_token() }}";
                        $.post("{{ route('deny-all') }}", {_token,model: model,ids: ids}, function(data){
                            if(data.success){
                                datatable.draw()
                                toastr.success(data.message,'Success',true)
                                location.reload();
                            } else {
                                toastr.error(data.message,'Failed',true)
                            }
                        })
                    }
                });
            }
        },
    @endsection
@endpush
