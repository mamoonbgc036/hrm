@extends('layouts.app')
@section('title','Deleted Sub Departments')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Sub Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-list " aria-hidden="true"></i> Deleted Sub-Department</h4>
                </div>
                <div class="btn-group float-right">
                    @can('Sub department create')
                        <a href="{{route('sub-department.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Sub-Department</a>
                    @endcan
                    @can('Sub department list')
                        <a href="{{route('sub-department.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Sub-Department</a>
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
                                <th class="text-center" style="width:15%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subDepartment as $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$value->department->name}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        @if($value->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Sub department restore')
                                                <a class="btn btn-primary" href="{{route('sub-department.restore',$value->id)}}"
                                                   data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                            @endcan
                                            @can('Sub department permanent delete')
                                                <form id="trash" method="POST" action="{{ route('sub-department.permanent-delete',$value->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $value->name }}" type="submit" class="btn btn-danger delete-confirm"
                                                            data-toggle="tooltip" title="Delete Permanently"><i class="fa fa-lg fa-trash"></i></button>
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

@endsection
@push('script')
    <!-- page script -->
    <script>
        $('.delete-confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete ${name}?`,
                text: "If you delete this, it will be gone forever.",
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
