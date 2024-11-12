@extends('layouts.app')
@section('title','Add Relationship')
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
            <h1><i class="fa fa-users" aria-hidden="true"></i> Create Relationship</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('relationship.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn">
                <h3 class="title"><i class="fa fa-plus fa-lg"></i> Create Relationship</h3>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('relationship.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="name">Relationship Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="description">Description </label>
                        <input class="form-control" id="description" type="text" name="description" value="{{old('description')}}">
                    </div>
                </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('js')

@endsection
