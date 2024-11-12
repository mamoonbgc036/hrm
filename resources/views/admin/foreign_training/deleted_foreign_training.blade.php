@extends('layouts.app')
@section('title','Deleted Abroad Trainings')
@section('content')
<div class="app-title">
    <div>
        <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Abroad Training</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="float-left">
                <h4 class="text"><i class="fa fa-trash " aria-hidden="true"></i> Deleted Abroad Training</h4>
            </div>
            <div class="btn-group float-right">
                @can('Abroad training create')
                    <a href="{{route('foreign-training.create')}}" class="btn btn-primary btn-sm mb-2"
                       data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Abroad-Training</a>
                @endcan
                @can('Abroad training list')
                    <a href="{{route('foreign-training.index')}}" class="btn btn-info btn-sm mb-2"
                       data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Abroad-Training</a>
                @endcan
            </div>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                        <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            {{--<th>Country</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Duration</th>
                            <th>Memo No</th>
                            <th>Memo Date</th>
                            <th>Coordinator</th>
                            <th>Venue</th>--}}
                            <th class="text-center" style="width:10%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($foreign_trainings as $index=>$row)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$row->course_title ??''}}</td>
                            <td>{{$row->course_code ??''}}</td>
                            {{--<td>{{$row->country->name ??''}}</td>
                            <td>{{$row->from_date ??''}}</td>
                            <td>{{$row->to_date ??''}}</td>
                            <td>{{$row->duration ??''}}</td>
                            <td>{{$row->memo_number ??''}}</td>
                            <td>{{$row->memo_date ??''}}</td>
                            <td>{{$row->course_coordinator ??''}}</td>
                            <td>{{$row->venue ??''}}</td>--}}
                            <td class="text-center">
                                <div class="btn-group">
                                    @can('Abroad training restore')
                                        <a class="btn btn-sm btn-primary" href="{{route('foreign-training.restore', $row->id)}}"
                                           data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                    @endcan
                                    @can('Abroad training permanent delete')
                                        <form id="trash" method="POST" action="{{ route('foreign-training.permanent-delete',$row->id)}}" class="">
                                            @csrf
                                            @method('delete')
                                            <button data-name="{{ $row->course_title }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                data-toggle="tooltip" title="Permanent Delete"><i class="fa fa-lg fa-trash"></i></button>
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


