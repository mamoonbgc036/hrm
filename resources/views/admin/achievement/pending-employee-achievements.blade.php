@extends('layouts.app')
@section('title','Pending Employee Achievement')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Pending Employee Achievement</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Pending Achievement</h4>
                </div>
                <div>
                    @can('Achievement list')
                        <a href="{{route('achievement.index')}}" class="btn btn-info btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add achievement"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All achievement</a>
                    @endcan
                    @can('Achievement create')
                        <a href="{{route('achievement.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add achievement"><i class="fa fa-plus" aria-hidden="true"></i>Add achievement</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Achievement Name</th>
                                <th>Employee Name</th>
                                <th>Old PIN</th>
                                <th>New PIN</th>
                                <th>Date of Creation</th>
                                <th class="text-center" style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingEmployeeAchievement as $row)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>
                                        <a href="{{route('achievement.show',$row->achievement_id)}}" target="_blank">{{$row->achievement_name}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('employee.show',$row->employee_id)}}" target="_blank">{{$row->name}}</a>
                                    </td>
                                    <td>{{$row->pin_no}}</td>
                                    <td>{{$row->new_pin}}</td>
                                    <td>{{ $row->created_at != null ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y  h:i:s A'):'' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('Achievement approve')
                                                <a href="{{route('approve-deny-employee-to-achievement',[$row->id, 'approve'])}}" class="btn btn-success btn-sm"
                                                   data-toggle="tooltip" title="Approve achievement"><i class="fa fa-check">Approve</i></a>
                                            @endcan
                                            @can('Achievement deny')
                                                <a href="{{route('approve-deny-employee-to-achievement',[$row->id, 'deny'])}}" class="btn btn-danger btn-sm"
                                                   data-toggle="tooltip" title="Deny achievement"><i class="fa fa-times">Deny</i></a>
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
    <!-- Data table plugin-->

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

            let model = '\\App\\Models\\AchievementEmployee'

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

            let model = '\\App\\Models\\AchievementEmployee'

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
