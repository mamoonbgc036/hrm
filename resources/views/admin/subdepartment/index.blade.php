@extends('layouts.app')
@section('title','Sub-Departments')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Sub Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> All Sub-Department</h4>
                </div>
                <div>
                    @can('Sub department deleted button')
                        <a href="{{route('sub-department.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Deleted List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Sub Department</a>
                    @endcan
                    @can('Sub department create')
                        <a href="{{route('sub-department.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Sub Department</a>
                    @endcan
                </div>

                <div class="tile-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Department</th>
                                    <th>Sub Department</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subDepartments as $subDepartment)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$subDepartment->department->name}}</td>
                                        <td>{{$subDepartment->name}}</td>
                                        <td>{{--{{$subDepartment->status}}--}}
                                            @if($subDepartment->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Sub department edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('sub-department.edit',$subDepartment)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Sub department delete')
                                                    <form id="trash" method="POST"
                                                          action="{{ route('sub-department.destroy',$subDepartment->id)}}"
                                                          class="">
                                                        @csrf
                                                        @method('delete')

                                                        <button data-name="{{$subDepartment->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
@endsection
@section('js')
    <!-- Data table plugin-->


@endsection
@push('script')
    <!-- page script -->
    <script>

    </script>
@endpush
