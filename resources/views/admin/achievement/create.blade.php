@extends('layouts.app')
@section('title','Add Achievement')
@push('css')

@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Achievement </h1>
        </div>
    </div>
    <form action="{{route('achievement.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tile">
            <div class="tile-title-w-btn">
                <h4 class="title"> <i class="fa fa-plus" aria-hidden="true"></i> Create Achievement </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('achievement.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="achievement_name">Achievement Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="achievement_name" type="text" name="achievement_name" value="{{ old('achievement_name') }}" required>
                    </div>
                </div>

            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
@section('js')

@endsection
