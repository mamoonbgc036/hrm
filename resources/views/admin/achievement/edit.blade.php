@extends('layouts.app')
@section('title','Edit Achievement')
@push('css')
    <style>
        label{
            font-size: 1em !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> achievement </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('achievement.update',$achievement->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit achievement </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('achievement.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="award_name">Achievement Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="award_name" type="text" name="achievement_name" value="{{old('achievement_name',$achievement->achievement_name)}}">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')

@endsection
