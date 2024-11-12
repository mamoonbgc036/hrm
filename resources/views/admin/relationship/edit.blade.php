@extends('layouts.app')
@section('title','Edit Relationship')
@push('css')
    <style>
        label{
            font-size: 1.2em !important;
        }
    </style>
@endpush
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Relationship</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('relationship.update',$contact->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Relationship</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('relationship.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="name">Person Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="name" type="text" name="name" value="{{old('name',$contact->name)}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="description">Description </label>
                        <input class="form-control" id="description" type="text" name="description" value="{{old
                        ('description',$contact->description)}}">
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
