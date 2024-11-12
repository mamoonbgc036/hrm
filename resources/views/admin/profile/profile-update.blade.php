@extends('layouts.app')
@section('title','Profile Update')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile col-md-8 offset-md-2">
        <form action="{{route('profile.update',$user->id)}}" method="post">
            @csrf
            @method('put')
            <h3 class="title" style="text-align: center !important;">Edit Your Profile</h3>
            <hr>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Name</label>
                        <input class="form-control" id="inputSmall" type="text" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Email</label>
                        <input class="form-control" id="inputSmall" type="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Old Password</label>
                        <input class="form-control" id="inputSmall" type="password" name="old_password">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">New Password</label>
                        <input class="form-control" id="inputSmall" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Confirm Password</label>
                        <input class="form-control" id="inputSmall" type="password" name="password_confirmation">
                    </div>
                    <button class="btn btn-primary float float-right" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')

@endsection
