@extends('layouts.app')
@section('title','Edit Subject')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Subject</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('subject.update',$subject->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Subject</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('subject.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                               name="name" value="{{old('name',$subject->name)}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="type">Type</label>

                        <select class="form-control" id="type" name="type">
                            <option value="" disabled selected>Select Type</option>
                            <option value="JSC" {{$subject->type=='JSC' ? 'selected' : ''}}>JSC</option>
                            <option value="SSC" {{$subject->type=='SSC' ? 'selected' : ''}}>SSC</option>
                            <option value="HSC" {{$subject->type=='HSC' ? 'selected' : ''}}>HSC</option>
                            <option value="Graduation" {{$subject->type=='Graduation' ? 'selected' : ''}}>Graduation</option>
                            <option value="Masters" {{$subject->type=='Masters' ? 'selected' : ''}}>Masters</option>

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
    {{--<script type="text/javascript" src="{{url(asset('assets/admin/js/plugins/select2.min.js'))}}"></script>
    <script type="text/javascript">
        $('#demoSelect').select2();
    </script>--}}
@endsection
