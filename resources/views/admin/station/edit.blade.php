@extends('layouts.app')
@section('title','Edit Office/Station')
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
        <form action="{{route('station.update',$station->id)}}" method="post">
            @csrf
            @method('put')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Office/Station </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('station.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Station Name</label>
                        <input class="form-control" id="inputSmall" type="text"  name="name" value="{{$station->name}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Station Code</label>
                        <input class="form-control" id="inputSmall" type="text"  name="code"  value="{{$station->code}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Office/Station Area</label>
                        <input class="form-control" id="inputSmall" type="text"  name="area"  value="{{$station->area}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Phone</label>
                        <input class="form-control" id="inputSmall" type="text"  name="phone"  value="{{$station->phone}}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="division_id">Division <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="division_id" name="division_id" data-placeholder="Select a state">
                            <option disabled selected hidden>Select One</option>
                            @foreach($divisions as $division)
                                <option value="{{$division->id}}" {{$division->id == $station->division_id ? 'selected' : ''}}>{{$division->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="district_id">District <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="district_id" name="district_id">
                            <option disabled selected hidden>Select One</option>
                            @foreach($districts as $district)
                                <option value="{{$district->id}}" {{$district->id == $station->district_id ? 'selected' : ''}}>{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="upazila_id">Upazila/Thana <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm demoSelect text-uppercase" id="upazila_id" name="upazila_id">
                            <option disabled selected hidden>Select One</option>
                            @foreach($upazilas as $upazila)
                                <option value="{{$upazila->id}}" {{$upazila->id == $station->upazila_id ? 'selected' : ''}}>{{$upazila->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="station_category_id">Category</label>
                        <select class="form-control form-control-sm demoSelect" id="station_category_id" name="station_category_id" data-placeholder="Select a state">
                            <option disabled selected hidden>Select One</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $station->station_category_id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
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
