@extends('layouts.app')
@section('title','Deleted Achievements')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted achievement</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div>
                    <h4 class="float-left"><i class="fa fa-trash " aria-hidden="true"></i> Deleted achievement </h4>
                </div>
                <div class="btn-group float-right">
                    @can('Achievement create')
                        <a href="{{route('achievement.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New achievement</a>
                    @endcan
                    @can('Achievement list')
                        <a href="{{route('achievement.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All achievement</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Achievement Name</th>
                                <th>Date of Creation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($achievements as $achievement)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$achievement->achievement_name }}</td>
                                    <td>{{\Carbon\Carbon::parse($achievement->created_at ??'')->format('d-m-Y')}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('Achievement restore')
                                                <a class="btn btn-primary" href="{{route('achievement.restore', $achievement->id)}}"
                                                   data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                            @endcan
                                            @can('Achievement permanent delete')
                                                <form id="trash" method="POST" action="{{ route('achievement.permanent-delete',$achievement->id)}}" class="">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{$achievement->achievement_name}}" type="submit" class="btn btn-danger delete-confirm"
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

    </script>
@endpush

