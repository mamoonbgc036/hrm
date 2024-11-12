@extends('layouts.app')
@section('title','Offices')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Office</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div>
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Office List</h4>
                </div>
                <div>
                    @can('Office deleted button')
                        <a href="{{route('office.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Deleted List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Office</a>
                    @endcan
                </div>
                <div>
                    @can('Office create')
                        <a href="{{route('office.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add Office</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">#</th>
                                    <th>Office Name</th>
                                    <th>Office Status</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($offices as $index=>$office)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$office->office ??''}}</td>
                                        <td>{{$office->status ??''}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Office edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('office.edit',$office)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Office delete')
                                                    <form id="trash" method="POST" action="{{ route('office.destroy',$office->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{$office->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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


