@extends('layouts.app')
@section('title','Edit Award')
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
            <h1><i class="fa fa-users" aria-hidden="true"></i> Award </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('award.update',$award->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Award </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('award.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="award_name">Award Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="award_name" type="text" name="award_name" value="{{old('award_name',$award->award_name)}}">
                    </div>
                </div>
                {{--<div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="achievement_name">Achievement Name</label>
                        <input class="form-control" id="achievement_name" type="text" name="achievement_name" value="{{ $award->achievement_name }}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="memo_no">Memo No <i class="text-danger">*</i></label>
                        <input class="form-control" id="memo_no" type="text" name="memo_no" value="{{ old('memo_no',$award->memo_no) }}" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Date <i class="text-danger">*</i></label>
                        <input class="form-control demoDate" id="date" name="date" type="text" placeholder="DD-MM-YY"
                               autocomplete="off" value="{{\Carbon\Carbon::parse($award->date ??'')->format('d-m-Y') }}">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Description</label>
                        <textarea class="form-control"  id="" cols="30" rows="5"  name="description" >{{$award->description }}</textarea>
                    </div>
                </div>--}}
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
