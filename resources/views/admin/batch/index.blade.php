@extends('layouts.app')
@section('title','Batches')
@section('content')
    <div class="app-title">
        <div>
            <h1 class="text"><i class="fa fa-users " aria-hidden="true"></i> Batch</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="float-left">
                    <h4 class="text"><i class="fa fa-list " aria-hidden="true"></i> All Batches</h4>
                </div>
                <div class="btn-group float-right">
                    <a href="{{route('batch.create')}}" class="btn btn-primary btn-sm mb-2" data-toggle="tooltip" title="Add New"><i class="fa
                    fa-plus-square-o" aria-hidden="true"></i>Add New Batch</a>
                    </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Name</th>
                                <th class="text-center" style="width:15%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($batches as $batch)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$batch->name}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="{{route('batch.edit',$batch)}}"><i class="fa fa-lg fa-edit"></i></a>
                                            {{--<form id="trash" method="POST" action="{{ route('batch.destroy',$batch->id)}}" class="">
                                                @csrf
                                                @method('delete')
                                               <button data-name="{{ $batch->name }}" type="submit" class="btn btn-danger delete-confirm"><i class="fa fa-lg fa-trash"></i></button>
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
