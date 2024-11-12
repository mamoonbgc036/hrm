@extends('layouts.app')
@section('title','Deleted Punishments')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Deleted Punishment</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-trash" aria-hidden="true"></i> Deleted Punishment List</h4>
                </div>
                <div>
                    @can('Punishment list')
                        <a href="{{route('punishment.index')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Punishments</a>
                    @endcan
                    @can('Punishment create')
                        <a href="{{route('punishment.create')}}" class="btn btn-info btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</a>
                    @endcan
                </div>

                <div class="tile-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>PUNISHMENT NAME</th>
                                <th>CREATED DATE OF CREATION</th>
                                <th class="text-center" style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @forelse($punishment as $row)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($row->created_at)->format('d-m-Y')}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-warning" href="{{route('punishment.deleted.show', $row->id) }}"
                                                   data-toggle="tooltip" title="Show"><i class="fa fa-lg fa-eye"></i></a>
                                                @can('Punishment restore')
                                                    <a class="btn btn-primary" href="{{route('punishment.restore', $row->id) }}"
                                                       data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                                @endcan
                                                @can('Punishment permanent delete')
                                                    <form id="trash" method="POST" action="{{ route('punishment.permanent-delete',$row->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{ $row->name }}" type="submit" class="btn btn-danger delete-confirm"
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

@endsection
@push('script')
    <!-- page script -->
    <script>
        $('.delete-confirm').click(function (event) {
            var form = $(this).closest("form");
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

