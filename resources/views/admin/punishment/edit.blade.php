@extends('layouts.app')
@section('title','Edit Punishment')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Punishment</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('punishment.update',$punishment)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Punishment</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('punishment.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="name">Punishment Name <span
                                class="text-danger">*</span> </label>
                        <input class="form-control" id="name" type="text" name="name" value="{{$punishment->name}}">
                    </div>
                </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('js')

@endsection
@push('script')
    <script>

    </script>
@endpush
