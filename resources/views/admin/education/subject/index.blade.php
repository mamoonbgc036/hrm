@extends('layouts.app')
@section('title','Subjects')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Subject</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-list " aria-hidden="true"></i> All Subjects</h4>
                </div>
                <div class="btn-group float-right">
                    @can('Subject create')
                        <a href="{{route('subject.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Subject</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th class="text-center" style="width:15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$subject->name}}</td>
                                        <td>{{$subject->type}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('Subject edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('subject.edit',$subject)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                {{--<form id="trash" method="POST" action="{{ route('subject.destroy',$subject->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                   <button data-name="{{ $subject->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
                                                           data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash"></i></button>
                                                </form>--}}
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


@endsection
@push('script')
    <!-- page script -->
    <script>

    </script>
@endpush
