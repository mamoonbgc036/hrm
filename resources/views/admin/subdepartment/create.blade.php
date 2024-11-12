@extends('layouts.app')
@section('title','Add Sub-Department')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Sub Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('sub-department.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-plus fa-lg"></i> Create Sub-Department </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('sub-department.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Department Name</label>
                        <select class="form-control demoSelect select2" id="department_id" name="department_id" required value="{{ old('department_id')}}">
                            <option disabled selected hidden>Select one</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}" >{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Sub Department Name</label>
                        <input class="form-control" id="inputSmall" type="text" name="name" value="{{old('name')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="demoSelect">Status</label>
                        <select class="form-control demoSelect select2" id="" name="status" required>
                            <option disabled selected hidden>Select One</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">

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
