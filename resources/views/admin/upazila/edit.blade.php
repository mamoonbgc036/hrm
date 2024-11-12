@extends('layouts.app')
@section('title', 'Edit Upazila/Thana')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Upazila</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{ route('upazila.update', $upazila->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i>Edit Upazila</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{ route('upazila.index') }}"><i
                            class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label" for="inputSmall">District</label>
                        <select class="form-control demoSelect" name="district_id" required>
                            <option value="" disabled selected>Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ $district->id == old('district_id', $upazila->district->id) ? 'selected' : '' }}>
                                    {{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="inputSmall" type="text"
                            name="name" value="{{ old('name', $upazila->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Name (Bangla)</label>
                        <input class="form-control @error('bn_name') is-invalid @enderror" id="inputSmall" type="text"
                            name="bn_name" value="{{ old('bn_name', $upazila->bn_name) }}">
                        @error('bn_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">URL</label>
                        <input class="form-control @error('url') is-invalid @enderror" id="inputSmall" type="text"
                            name="url" value="{{ old('url', $upazila->url) }}">
                        @error('url')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
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
    <script type="text/javascript" src="{{ url(asset('assets/admin/js/plugins/select2.min.js')) }}"></script>
    <script type="text/javascript">
        $('#demoSelect').select2();
    </script>
@endsection
