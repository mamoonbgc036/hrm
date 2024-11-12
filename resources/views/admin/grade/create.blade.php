@extends('layouts.app')
@section('title','Add Grade')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Grade</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('grade.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-plus fa-lg"></i> Create Grade</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('grade.index')}}"><i class="fa fa-list"></i>See
                        List</a></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="grade_name">Grade Name</label>
                        <input class="form-control" id="grade_name" type="text"  name="grade"  value="{{old('grade')}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="status">Status</label>
{{--                        <input class="form-control" id="status" type="text"  name="status"  value="{{old('status')}}">--}}
                        <select class="form-control form-control-sm demoSelect" id="status"
                                name="status" data-placeholder="Select a state" required>
                            <option value="" disabled selected>Select All</option>
                            <option value="Active" {{old('status')=='Active'?'selected':''}}>Active</option>
                            <option value="Inactive" {{old('status')=='Inactive'?'selected':''}}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection

