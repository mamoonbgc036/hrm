@extends('layouts.app')
@section('title','Deleted Departments')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-trash " aria-hidden="true"></i> Deleted Department</h4>
                </div>
                <div class="btn-group float-right">
                    @can('Department create')
                        <a href="{{route('department.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Department</a>
                    @endcan
                    @can('Department list')
                        <a href="{{route('department.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Department</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="text-center" style="width:15%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($departments as $department)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$department->name}}</td>
                                    <td>
                                        @if($department->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Department restore')
                                                <a class="btn btn-sm btn-primary" href="{{route('department.restore', $department->id)}}"
                                                   data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                            @endcan
                                            @can('Department permanent delete')
                                                <form id="trash" method="POST" action="{{route('department.permanent-delete',$department->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $department->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
    <!-- Data table plugin-->

    <script src="{{url(asset('assets/admin/js/plugins/jquery.dataTables.min.js'))}}"></script>
    <script src="{{url(asset('assets/admin/js/plugins/dataTables.bootstrap.min.js'))}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
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
