@extends('layouts.app')
@section('title','Deleted Awards')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Deleted Award</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div>
                    <h4 class="float-left"><i class="fa fa-trash " aria-hidden="true"></i> Deleted Award </h4>
                </div>
                <div class="btn-group float-right">
                    @can('Award create')
                        <a href="{{route('award.create')}}" class="btn btn-primary btn-sm mb-2"
                           data-toggle="tooltip" title="Add New"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Award</a>
                    @endcan
                    @can('Award list')
                        <a href="{{route('award.index')}}" class="btn btn-info btn-sm mb-2"
                           data-toggle="tooltip" title="Show All"><i class="fa fa-plus-square-o" aria-hidden="true"></i>All Awards</a>
                    @endcan
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-uppercase" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Award Name</th>
                                {{--<th>Award Id</th>
                                <th>Achievement Name</th>
                                <th>Memo No</th>
                                <th>Description</th>
                                <th>Memo Date</th>
                                <th>Date</th>--}}
                                <th>Date of Creation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($awards as $award)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$award->award_name }}</td>
                                        {{--<td>{{$award->hr_id }}</td>
                                        <td>{{$award->achievement_name }}</td>
                                        <td>{{$award->memo_no }}</td>
                                        <td>{{$award->description }}</td>
                                        <td>{{\Carbon\Carbon::parse($award->memo_date ??'')->format('d-m-Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($award->date ??'')->format('d-m-Y')}}</td>--}}
                                        <td>{{\Carbon\Carbon::parse($award->created_at ??'')->format('d-m-Y')}}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                @can('Award restore')
                                                    <a class="btn btn-primary" href="{{route('award.restore', $award->id)}}"
                                                       data-toggle="tooltip" title="Restore"><i class="fa fa-lg fa-check"></i></a>
                                                @endcan
                                                @can('Award permanent delete')
                                                    <form id="trash" method="POST" action="{{ route('award.permanent-delete',$award->id)}}" class="">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-name="{{$award->award_name}}" type="submit" class="btn btn-danger delete-confirm"
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

