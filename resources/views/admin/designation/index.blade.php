@extends('layouts.app')
@section('title','Designations')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Designation</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Designation List</h4>
                </div>
                <div>
                    @can('Designation deleted button')
                        <a href="{{route('designation.deleted')}}" class="btn btn-danger btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Deleted List"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Deleted Designation</a>
                    @endcan
                    @can('Designation create')
                        <a href="{{route('designation.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Designation</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">Sr</th>
                                <th>English Name</th>
                                <th>Bangla Name</th>
                                <th>Short Name</th>
                                <th>Status</th>
                                <th class="text-center" style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($designations as $index=>$designation)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$designation->en_name}}</td>
                                    <td>{{$designation->bn_name}}</td>
                                    <td>{{$designation->short_name}}</td>
                                    <td>{{$designation->status}}</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            @can('Designation edit')
                                                <a class="btn btn-sm btn-primary" href="{{route('designation.edit',$designation)}}"
                                                   data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                            @endcan
                                            @can('Designation delete')
                                                <form id="trash" method="POST" action="{{ route('designation.destroy',$designation->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $designation->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
