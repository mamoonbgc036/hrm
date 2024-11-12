@extends('layouts.app')
@section('title','Districts')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Districts</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-list " aria-hidden="true"></i> All Districts</h4>
                </div>
                <div class="btn-group float-right">
                    @can('District create')
                        <a href="{{route('district.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New District</a>
                    @endcan
                    @can('District deleted button')
                        <a href="{{route('district.deleted')}}" class="btn btn-danger btn-sm mb-2"
                           data-toggle="tooltip" title="Show Deleted"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Deleted Districts</a>
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
                                @forelse($districts as $district)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$district->name}}</td>
                                        <td>{{$district->bn_name}}</td>
                                        <td>{{$district->division->name ?? ''}}</td>
                                        <td>{{$district->url}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('District edit')
                                                    <a class="btn btn-sm btn-primary" href="{{route('district.edit',$district)}}"
                                                       data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                                @endcan
                                                @can('District delete')
                                                    <form id="trash" method="POST" action="{{ route('district.destroy',$district->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                       <button data-name="{{ $district->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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
    <!-- Data table plugin-->


@endsection
@push('script')
    <!-- page script -->
    <script>

    </script>
@endpush
