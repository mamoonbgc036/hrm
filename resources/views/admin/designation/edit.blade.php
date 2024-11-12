@extends('layouts.app')
@section('title','Edit Designation')
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
            <h1><i class="fa fa-users" aria-hidden="true"></i> Designation</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('designation.update',$designation->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Designation</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('designation.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">English Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="inputSmall" type="text" name="en_name" value="{{ $designation->en_name}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">বাংলা নাম</label>
                        <input class="form-control" id="inputSmall" type="text" name="bn_name" value="{{ $designation->bn_name}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Short Name</label>
                        <input class="form-control" id="inputSmall" type="text" name="short_name" value="{{ $designation->short_name}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="demoSelect">Status <i class="text-danger">*</i></label>
                        <select class="form-control form-control-sm demoSelect" id="demoSelect" name="status">
                            <option value="Active" {{$designation->status=='active' ? 'selected' : ''}}>Active</option>
                            <option value="Inactive" {{$designation->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                        </select>
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
