@extends('layouts.app')
@section('title','Roles')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Role</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div>
                    @can('Role create')
                        <a href="{{route('role.create')}}" class="btn btn-primary btn-sm float-right mb-2">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</a>
                    @endcan
                </div>

                <div class="tile-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Guard Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name}}</td>
                                        <td>{{ $row->guard_name}}</td>

                                        <td>
                                            <div class="btn-group">
                                                @can('Role edit')
                                                    <a href="{{ route('role.edit', $row) }}" class="btn btn-success btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </a>
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
    <script>

    </script>
@endpush
