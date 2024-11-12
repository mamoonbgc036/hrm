@extends('layouts.app')
@section('title','Edit Office')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Office</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('office.update',$office)}}" method="post">
            @csrf
            @method("put")
            <div class="tile-title-w-btn">
                <h4 class="title"> <i class="fa fa-edit fa-lg"></i> Edit Office</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('office.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="office_name"> Office Name</label>
                        <input class="form-control" id="office_name" type="text" name="office" value="{{old('office',$office->office)}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="status">Status</label>
                        <select class="form-control form-control-sm demoSelect" id="status"
                                name="status" data-placeholder="Select a state" required>
                            <option value="" disabled>Select All</option>
                            <option value="active" @if($office->status == 'active') selected @endif>Active
                            </option>
                            <option value="inactive" @if($office->status == 'inactive') selected @endif>Inactive
                            </option>
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


