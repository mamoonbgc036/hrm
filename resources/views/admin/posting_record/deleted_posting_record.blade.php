@extends('layouts.app')
@section('title','Deleted Job Histories')
@section('content')
    <div class="app-title">
        <div>
            <h1 class=""><i class="fa fa-users " aria-hidden="true"></i> Deleted Job History</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class=""><i class="fa fa-trash " aria-hidden="true"></i> Deleted Job History</h4>
                </div>
                <div class="btn-group float-right">
                    @can('Job history list')
                        <a href="{{route('posting-record.index')}}" class="btn btn-info btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            All Job History</a>
                    @endcan
                    @can('Job history create')
                        <a href="{{route('posting-record.create')}}"
                           class="btn btn-primary btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add
                            New Job History</a>
                    @endcan
                    @can('Job history transfers button')
                        <a href="{{route('posting-record.transfers')}}"
                           class="btn btn-warning btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Transfers List"><i class="fa fa-random" aria-hidden="true"></i>Transfers</a>
                    @endcan
                    @can('Job history promotions button')
                        <a href="{{route('posting-record.promotions')}}"
                           class="btn btn-success btn-sm float-right mb-2 mr-1"
                           data-toggle="tooltip" title="Promotions List"><i class="fa fa-level-up"
                                                                            aria-hidden="true"></i> Promotions</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>EMPLOYEE NAME</th>
                                <th>DESIGNATION</th>
                                <th>STATION NAME</th>
                                <th>FROM</th>
                                <th>DESCRIPTION</th>
                                <th class="text-center" style="width:15%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($postingRecord as $index => $row)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->employee->name ?? '') }}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->designation->en_name ?? '') }}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->station->name ?? '') }}</td>
                                        <td>{{ $row->from_date??''}}</td>
                                        <td>{{ App\Classes\StringConversion::stringUpperArray($row->description ?? '') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('Job history restore')
                                                    <a class="btn btn-sm btn-primary" href="{{route('posting-record.restore', $row->id)}}"
                                                       data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                                @endcan
                                                @can('Job history permanent delete')
                                                    <form id="trash" method="POST" action="{{ route('posting-record.permanent-delete', $row->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{ $row->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                            data-toggle="tooltip" title="Permanently Delete"><i class="fa fa-lg fa-trash"></i></button>
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

