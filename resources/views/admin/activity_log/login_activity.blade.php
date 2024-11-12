@extends('layouts.app')
@section('title','Login Activity')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Login Activity</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Login Activity List</h4>
                </div>
                <div>
                    @can('Login activity clear button')
                        <a href="{{route('activity-log-clean-by-name')}}" class="btn btn-danger btn-sm float-right mb-2">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>Clear Log</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th >Type</th>
                                <th >Ip Address</th>
                                <th >User Agent</th>
                                <th >User Type</th>
                                <th >User Name</th>
                                <th >Status</th>
                                <th >Attempt</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($login_activity as $index=>$row)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $row->log_name }}</td>
                                    <td>{{ $row->getExtraProperty('login_ip') }}</td>
                                    <td>{{ $row->getExtraProperty('user_agent') }}</td>
                                    <td>{{ $row->causer ? $row->causer->getRoleNames()->first() : '' }}</td>
                                    <td>{{ $row->causer->name ?? ''}}</td>
                                    <td>
                                        <span class="badge {{$row->description=='Success'?'badge-success':'badge-danger'}}">{{ $row->description }}</span>
                                    </td>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
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
@endsection
@section('js')
    <!-- Data table plugin-->


@endsection
@push('script')


    <!-- page script -->

@endpush
