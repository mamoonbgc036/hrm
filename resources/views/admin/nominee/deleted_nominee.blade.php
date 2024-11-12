@extends('layouts.app')
@section('title','Deleted Nominees')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Nominee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-trash " aria-hidden="true"></i> Deleted Nominee</h4>
                </div>
                <div class="btn-group float-right">
                    <a href="{{route('nominee.create')}}" class="btn btn-primary btn-sm mb-2"><i class="fa
                    fa-plus-square-o" aria-hidden="true"></i>Add New Nominee</a>
                    <a href="{{route('nominee.index')}}" class="btn btn-info btn-sm mb-2"><i
                            class="fa fa-plus-square-o" aria-hidden="true"></i>All Nominee</a>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Nominee</th>
                                <th>Relationship</th>
                                <th>Permanent Address</th>
                                <th>NID No</th>
                                <th>Percentage(%)</th>
                                <th class="text-center" style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($nominees as $nominee)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$nominee->employee->name ??''}}</td>
                                    <td>{{$nominee->name}}</td>
                                    <td>{{$nominee->relationships->name ?? ''}}</td>
                                    <td>{{$nominee->permanent_address}}</td>
                                    <td>{{$nominee->nid_no}}</td>
                                    <td>{{$nominee->percentage}}%</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="{{route('nominee.restore', $nominee->id)}}"><i class="fa fa-lg fa-check"></i></a>
                                            <form id="trash" method="POST"
                                                  action="{{ route('nominee.permanent-delete',$nominee->id)}}"
                                                  class="">
                                                @csrf
                                                @method('delete')
                                                <button data-name="{{ $nominee->name }}" type="submit " class="btn
                                                 btn-danger delete-confirm"><i class="fa fa-lg
                                                 fa-trash"></i></button>
                                            </form>
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

