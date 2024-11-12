@extends('layouts.app')
@section('title','Edit Job History')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Job History</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            {{--<li class="breadcrumb-item"><a href="#">Blank Page</a></li>--}}
        </ul>
    </div>

    <div class="tile text-uppercase">
        <form action="{{route('posting-record.update',$postingRecord)}}" method="post">
            @csrf
            @method('PUT')
            <div class="tile-title-w-btn">
                <div class="float-left">
                    <h4><i class="fa fa-edit" aria-hidden="true"></i> Edit Job History</h4>
                </div>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('posting-record.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <hr>
            <div class="row">
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="select2">Grade <span class="text-danger">*</span></label>
                        <select class="form-control text-uppercase select2" id="grade_id" name="grade_id">
                            <option disabled selected hidden>Select Grade</option>
                            @foreach($grades as $grade)
                                <option value="{{$grade->id}}" {{$postingRecord->grade_id == $grade->id ? "selected" : ""}}>{{$grade->grade}}</option>
                            @endforeach()
                        </select>
                    </div>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Designation <span class="text-danger">*</span></label>
                        <select class="form-control text-uppercase select2" id="designation_id" name="designation_id" required>
                            <option disabled selected hidden>Select Designation</option>
                            @foreach($designations as $designation)
                                <option value="{{$designation->id}}" {{$postingRecord->designation_id ==
                                $designation->id ? "selected":""}}>{{$designation->en_name}}</option>
                            @endforeach()
                        </select>
                    </div>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="posting_station_id">Station<span class="text-danger">*</span></label>
                        <select class="form-control text-uppercase select2" id="station_id" name="station_id" required>
                            <option disabled selected hidden>Select Station</option>
                            @foreach($stations as $station)
                                <option value="{{$station->id}}" {{$postingRecord->station_id == $station->id ? "selected":""}}>{{'['.$station->code.'] '.$station->name}}</option>
                            @endforeach()
                        </select>
                    </div>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="type">Posting Type</label>
                        <select class="form-control demoSelect2 text-uppercase" name="type">
                            <option value="" disabled selected hidden>Select Type</option>
                            @foreach($posting_types as $key => $type)
                                <option value="{{$key}}" {{ $postingRecord->type == $key ? "selected" : "" }}>{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">From Date<span class="text-danger">*</span></label>
                        <input class="form-control demoDate" id="from_date" type="text"  name="from_date" required value="{{old('from_date',$postingRecord->from_date)}}" autocomplete="off" placeholder="DD-MM-YYYY">
                    </div>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">To Date<span class="text-danger">*</span></label>
                        <input class="form-control demoDate" id="to_date" type="text"  name="to_date" value="{{old('to_date',$postingRecord->to_date)}}" autocomplete="off" placeholder="DD-MM-YYYY">
                    </div>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Duration<span class="text-danger">*</span></label>
                        <input class="form-control" id="duration" type="text"  name="duration" required value="{{ App\Classes\DateTimeHelper::calculateDuration($postingRecord->from_date,$postingRecord->to_date) }}" readonly>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm">Description</label>
                        <textarea class="form-control"  id="" cols="30" rows="5"  name="description">{{$postingRecord->description}}</textarea>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary"  type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script>
        $('document').ready(function () {

            $(".select2").select2({});

            $('#from_date').change(function () {
                // alert("done");
                fetchDuration();
            });

            $('#to_date').change(function () {
                // alert("done");
                fetchDuration();
            });

            //fetch duration of date
            function fetchDuration() {
                var from_date = moment($('#from_date').val(), 'DD-MM-YYYY');
                var to_date = moment($('#to_date').val(), 'DD-MM-YYYY');
                //console.log($('#from-date').val())

                if (from_date.isValid() && to_date.isValid()) {
                    var duration = moment.duration(to_date.diff(from_date));

                    if(duration.years() < 2){
                        var year = duration.years() + ' year '
                    }
                    else {
                        var year = duration.years() + ' years '
                    }

                    if(duration.months() < 2){
                        var month = duration.months() + ' month '
                    }
                    else {
                        var month = duration.months() + ' months '
                    }
                    if(duration.days()+1 < 2){
                        var day = duration.days()+1 + ' day '
                    }
                    else {
                        var day = duration.days()+1 + ' days '
                    }

                    if (duration.years() == 0 && duration.months() == 0){
                        var output = day;
                    }
                    else if(duration.years() == 0 && duration.months() != 0){
                        var output =  month  +  day ;
                    }else{
                        var output = year +  month +  day;
                    }

                    $('#duration').val(output);
                } else if (from_date.isValid()){
                    // console.log(from_date)
                    to_date = moment()
                    var duration = moment.duration(to_date.diff(from_date));

                    if(duration.years() < 2){
                        var year = duration.years() + ' year '
                    }
                    else {
                        var year = duration.years() + ' years '
                    }

                    if(duration.months() < 2){
                        var month = duration.months() + ' month '
                    }
                    else {
                        var month = duration.months() + ' months '
                    }
                    if(duration.days()+1 < 2){
                        var day = duration.days()+1 + ' day '
                    }
                    else {
                        var day = duration.days()+1 + ' days '
                    }

                    if (duration.years() == 0 && duration.months() == 0){
                        var output = day;
                    }
                    else if(duration.years() == 0 && duration.months() != 0){
                        var output =  month  +  day ;
                    }else{
                        var output = year +  month +  day;
                    }

                    $('#duration').val(output);
                } else {
                    console.log('Invalid date(s).')
                }
            }
        });
    </script>
@endsection
