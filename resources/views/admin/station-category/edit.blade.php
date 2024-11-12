@extends('layouts.app')
@section('title','Edit Office/Branch Category')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Office/Branch Category</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('station-category.update',$category->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Office/Branch Category</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('station-category.index')}}"><i class="fa fa-list"></i>See
                        List</a></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Branch Category Name</label>
                        <input class="form-control" id="inputSmall" type="text"  name="name" value="{{$category->name}}" required>
                    </div>
                    <button class="btn btn-primary float-right" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')

@endsection
