@extends('layouts.app')
@section('title','Office/Station Categories')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Office/Branch Category</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4><i class="fa fa-list" aria-hidden="true"></i> Office/Branch Category List</h4>
                </div>
                <div>
                    @can('Station category create')
                        <a href="{{route('station-category.create')}}" class="btn btn-primary btn-sm float-right mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add Branch Category</a>
                    @endcan
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">ID</th>
                                    <th>Office/Branch Category Name</th>
                                    <th class="text-center" style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $index=>$category)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$category->name ??''}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('Station category edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('station-category.edit',$category)}}"
                                                       data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('Station category delete')
                                                    <form id="trash" method="POST"
                                                          action="{{ route('station-category.destroy',$category->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{$category->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
