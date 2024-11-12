@extends('layouts.app')
@section('title','Deleted Offices/Stations')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Station</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-trash " aria-hidden="true"></i> Deleted Station</h4>
                </div>
                <div class="btn-group float-right">
                    @can('Station create')
                        <a href="{{route('station.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Station</a>
                    @endcan
                    @can('Station list')
                        <a href="{{route('station.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Station</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Office/Station Name</th>
                                <th>Code</th>
                                <th>Zone</th>
                                <th>Phone</th>
                                <th>Division</th>
                                <th>District</th>
                                <th>Upazila/Thana</th>
                                <th>Category</th>
                                <th class="text-center" style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($station as $index=>$station)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$station->name ??''}}</td>
                                    <td>{{$station->code ??''}}</td>
                                    <td>{{$station->area ??''}}</td>
                                    <td>{{$station->phone ??''}}</td>
                                    <td>{{$station->division->name ??''}}</td>
                                    <td>{{$station->district->name ??''}}</td>
                                    <td>{{$station->upazila->name ??''}}</td>
                                    <td>{{$station->stationCategory->name ??''}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Station restore')
                                                <a class="btn btn-sm btn-primary" href="{{route('station.restore', $station->id)}}"
                                                   data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                            @endcan
                                            @can('Station permanent delete')
                                                <form id="trash" method="POST"
                                                      action="{{ route('station.permanent-delete',$station->id)}}"
                                                      class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $station->name }}" type="submit" class="btn btn-sm btn-danger delete-confirm"
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

@endpush


