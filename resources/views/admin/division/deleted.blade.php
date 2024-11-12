@extends('layouts.app')
@section('title','Deleted Divisions')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Divisions</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-trash " aria-hidden="true"></i>Deleted Divisions</h4>
                </div>
                <div class="btn-group float-right">
                    @can('Division create')
                        <a href="{{route('division.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Division</a>
                    @endcan
                    @can('Division list')
                        <a href="{{route('division.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Divisions</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Name</th>
                                    <th>Name (Bangla)</th>
                                    <th>URL</th>
                                    <th class="text-center" style="width:15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deleted_divisions as $division)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$division->name}}</td>
                                        <td>{{$division->bn_name}}</td>
                                        <td>{{$division->url}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('Division restore')
                                                    <a class="btn btn-sm btn-primary" href="{{route('division.restore', $division->id) }}"
                                                       data-toggle="tooltip" title="Restore" ><i class="fa fa-lg fa-check"></i></a>
                                                @endcan
                                                @can('Division permanent delete')
                                                    <form id="trash" method="POST" action="{{ route('division.permanent-delete',$division->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{ $division->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
