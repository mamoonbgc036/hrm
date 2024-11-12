@extends('layouts.app')
@section('title','Grades')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Grade</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> All Grade</h4>
                </div>
                <div>
                    @can('Grade deleted button')
                        <a href="{{route('grade.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Deleted List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Grade</a>
                    @endcan
                </div>
                <div>
                    @can('Grade create')
                        <a href="{{route('grade.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add Grade</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Grade Name</th>
                                    <th>Grade Status</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                                </thead>
                            <tbody>
                                @forelse($grades as $index=>$grade)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$grade->grade ??''}}</td>
                                        <td>{{$grade->status ??''}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Grade edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('grade.edit',$grade)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Grade delete')
                                                    <form id="trash" method="POST" action="{{ route('grade.destroy',$grade->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{$grade->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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

    </script>
@endpush

