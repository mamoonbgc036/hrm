@extends('layouts.app')
@section('title','Deleted Employees')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text-uppercase"><i class="fa fa-users " aria-hidden="true"></i>Deleted Employees</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="btn-group float-right">
                    @can('Employee create')
                        <a href="{{route('employee.create')}}" class="btn btn-primary btn-sm float-right mb-2 ml-1"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Employee</a>
                    @endcan
                    @can('Employee list')
                        <a href="{{route('employee.index')}}" class="btn btn-info btn-sm float-right mb-2 ml-1"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Employees</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Spouse Name</th>
                                <th>PIN</th>
                                <th class="text-center" style="width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->f_name}}</td>
                                    <td>{{$employee->m_name}}</td>
                                    <td>{{$employee->s_name}}</td>
                                    <td>{{$employee->pin_no}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Employee restore')
                                                <a class="btn btn-sm btn-primary" data-toggle="tooltip" title="Restore Employee" href="{{route('employee.restore', $employee->id) }}">
                                                    <i class="fa fa-lg fa-check"></i></a>
                                            @endcan
                                            @can('Employee permanent delete')
                                                <form id="trash" method="POST"
                                                      action="{{ route('employee.permanent-delete',$employee->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $employee->name }}" data-toggle="tooltip" title="Delete Permanently" type="submit" class="btn btn-sm btn-danger delete-confirm">
                                                        <i class="fa fa-lg fa-trash"></i></button>
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


