@extends('layouts.app')
@section('title','Add Office/Station')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Station</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('station.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn">
                <h3 class="title"><i class="fa fa-plus fa-lg"></i> Create Office/Station </h3>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('station.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
           <hr>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Station Name
                            <span class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" id="inputSmall" type="text" name="name" value="{{old('name')}}"
                               required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Station Code</label>
                        <input class="form-control @error('code') is-invalid @enderror" id="inputSmall" type="text" name="code" value="{{old('code')}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Station Area</label>
                        <input class="form-control @error('area') is-invalid @enderror" id="inputSmall" type="text" name="area" value="{{old('area')}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Phone</label>
                        <input class="form-control" id="inputSmall" type="number"  name="phone"  value="{{old('phone')}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="division_id">Division <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="division_id" name="division_id"
                                data-placeholder="Select a state" required>
                            <option disabled selected hidden>Select One</option>
                            @foreach($divisions as $division)
                                <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach()
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="district_id">District <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="district_id" name="district_id" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="upazila_id">Upazila/Thana <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="upazila_id" name="upazila_id" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="station_category_id">Category</label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="station_category_id"
                                name="station_category_id" data-placeholder="Select a state" required>
                            <option disabled selected hidden>Select One</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach()
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
    <script>
        $('document').ready(function () {
            $('#division_id').change(function () {
                var id = $('#division_id').val();
                $.ajax({
                    url: '{{url('fetch-district')}}',
                    type: 'get',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        //console.log(data);
                        $('#district_id').html(data);
                    }
                });
            });

            $('#district_id').change(function () {
                var id = $('#district_id').val();
                $.ajax({
                    url: '{{url('fetch-thana')}}',
                    type: 'get',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        //console.log(data);
                        $('#upazila_id').html(data);
                    }
                });
            });

        });
    </script>
@endsection
