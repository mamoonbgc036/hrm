@extends('layouts.app')
@section('title','View Admin Activity')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>View Admin Activity</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                {{--<div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Admin Activity List</h4>
                </div>--}}
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>Date</th>
                                <td>{{ \Carbon\Carbon::parse($activity_log->created_at)->format('d-m-Y h:i A') }}</td>
                                <th>User Type</th>
                                <td>{{ $activity_log->causer ? @$activity_log->causer->getRoleNames()->first() : '' }}</td>
                                <th>Username</th>
                                <td>{{ $activity_log->causer ? @$activity_log->causer->name : '' }}</td>
                            </tr>
                            <tr>
                                <th>Module</th>
                                <td>{{ $activity_log->log_name }}</td>
                                <th>Type</th>
                                <td>{{ $activity_log->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="card-title float-left">Activity</span>
                    @can('Admin activity revert all button')
                        <form action="{{ route('revert-all-admin-activity',$activity_log->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success float-right revert-confirm" data-name="All" data-old="old value">Revert All</button>
                        </form>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table table-hover table-bordered" id="" style="width:100%;">
                        <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Field Name</th>
                            @if($activity_log->description == 'created')
                                <th>New Value</th>
                            @elseif($activity_log->description == 'updated')
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th style="width: 10%">Action</th>
                            @elseif($activity_log->description == 'deleted')
                                <th>Value</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @if(@$activity_log->changes['attributes'])
                            @foreach($activity_log->changes['attributes'] as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key }}</td>
                                    @if($activity_log->description == 'created')
                                        <td>{{ $activity_log->changes['attributes'][$key] }}</td>
                                    @elseif($activity_log->description == 'updated')
                                        <td>
                                            @if(isset($activity_log->changes['old']))
                                                {{ $activity_log->changes['old'][$key] }}
                                            @endif
                                        </td>
                                        <td>{{ $activity_log->changes['attributes'][$key] }}</td>
                                        <td>
                                            <form action="{{ route('revert-admin-activity',$activity_log->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="field_name" value="{{ $key }}">
                                                <input type="hidden" name="old_value" value="{{ $activity_log->changes['old'][$key] }}">
                                                @can('Admin activity revert button')
                                                    <button type="submit" class="btn btn-sm btn-success revert-confirm" data-name="{{ $key }}" data-old="{{ $activity_log->changes['old'][$key] }}">Revert</button>
                                                @endcan
                                            </form>
                                        </td>
                                    @elseif($activity_log->description == 'deleted')
                                        <td>{{ $activity_log->changes['attributes'][$key] }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
@push('script')
    <script>
        $('.revert-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            var old = $(this).data("old");
            event.preventDefault();
            swal({
                title: `Are you sure you want to revert "${name}"?`,
                text: `If you revert this, it will be "${old}"`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush