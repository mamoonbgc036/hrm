@extends('layouts.app')
@section('title','Deleted Districts')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Districts</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-trash " aria-hidden="true"></i> Deleted Districts</h4>
                </div>
                <div class="btn-group float-right">
                    @can('District create')
                        <a href="{{route('district.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New District</a>
                    @endcan
                    @can('District list')
                        <a href="{{route('district.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i> All Districts</a>
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
                                    <th>Division</th>
                                    <th>URL</th>
                                    <th class="text-center" style="width:15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deleted_districts as $district)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$district->name}}</td>
                                        <td>{{$district->bn_name}}</td>
                                        <td>{{$district->division->name ?? ''}}</td>
                                        <td>{{$district->url}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('District restore')
                                                    <a href="{{route('district.restore', $district->id) }}" class="btn btn-sm btn-primary"
                                                       data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                                @endcan
                                                @can('District permanent delete')
                                                    <form id="trash" method="POST" action="{{ route('district.permanent-delete',$district->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button  data-name="{{ $district->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
