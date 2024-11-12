@extends('layouts.app')
@section('title','Add Institute')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Institute</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>

        </ul>
    </div>
    <div class="tile">
        <form action="{{route('institute.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-plus fa-lg"></i> Create Institute</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('institute.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="name">Name<span style="font-size: 15px;" class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="type">Type<span style="font-size: 15px;" class="text-danger">*</span></label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old
                        ('type') }}">
                            <option value="" disabled selected>Select Type</option>
                            <option value="JSC">JSC</option>
                            <option value="SSC">SSC</option>
                            <option value="HSC">HSC</option>
                            <option value="Graduation">Graduation</option>
                            <option value="Masters">Masters</option>
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
@section('js')
    {{--<script type="text/javascript" src="{{url(asset('assets/admin/js/plugins/select2.min.js'))}}"></script>
    <script type="text/javascript">
        $('#demoSelect').select2();
    </script>--}}
@endsection
