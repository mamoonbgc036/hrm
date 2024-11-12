@extends('layouts.app')
@section('title','Edit Inland Training')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Inland Training</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('local-training.update',$localTraining)}}" method="post">
            @csrf
            @method('put')
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-edit fa-lg"></i> Edit Inland Training</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('local-training.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">


                <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label class="col-form-label " for="course_title">Course Name</label>
                        <input class="form-control" id="course_title" type="text" name="course_title" value="{{$localTraining->course_title}}" >
                    </div>
                </div>
                <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label class="col-form-label " for="course_code">Course Code</label>
                        <input class="form-control" id="course_code" type="text" name="course_code" value="{{$localTraining->course_code}}">
                    </div>
                </div>

                {{--
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="country">Country</label>
                        <input class="form-control" id="country" type="text" name="country" value="Bangladesh">
                    </div>
                </div>

                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="memo_number">Memo Number</label>
                        <input class="form-control" id="memo_number" type="text" name="memo_number" value="{{$localTraining->memo_number}}" >
                    </div>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="from_date">Start Date</label>
                        <input class="form-control demoDate" id="from_date" type="text" name="from_date" value="{{$localTraining->from_date}}" autocomplete="off">
                    </div>
                </div>

                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="to_date">End Date</label>
                        <input class="form-control demoDate" id="to_date" type="text" name="to_date" value="{{$localTraining->to_date}}" autocomplete="off">
                    </div>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="duration">Duration</label>
                        <input class="form-control" id="duration" type="text" name="duration" value="{{$localTraining->duration}}" >
                    </div>
                </div>

                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="memo_date">Memo Date</label>
                        <input class="form-control demoDate" id="memo_date" type="text" name="memo_date" value="{{$localTraining->memo_date}}" autocomplete="off">
                    </div>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="result">Result</label>
                        <input class="form-control" id="result" type="text" name="result" value="{{$localTraining->result}}" >
                    </div>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="course_coordinator">Course Coordinator</label>
                        <input class="form-control" id="course_coordinator" type="text" name="course_coordinator" value="{{$localTraining->course_coordinator}}" >
                    </div>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="venue">Venue</label>
                        <input class="form-control" id="venue" type="text" name="venue" value="{{$localTraining->venue}}" >
                    </div>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label class="col-form-label " for="location">Location</label>
                        <input class="form-control" id="location" type="text" name="location" value="{{$localTraining->location}}" >
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" rows="10" type="text" name="description">{!! $localTraining->description !!}</textarea>
                    </div>
                </div>
                --}}

                <div class="col-md-12 col-sm-12">
                    <button class="btn btn-primary float-right" type="submit">Update</button>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script>
        $('document').ready(function () {
            $('#to_date').change(function () {
                // alert("done");
                fetchDuration();
            });

            $('#from_date').change(function () {
                // alert("done");
                fetchDuration();
            });
            //fetch duration of date
            function fetchDuration() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                console.log(to_date);
                $.ajax({
                    url: '{{url('fetch-duration')}}',
                    type: 'get',
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    },
                    dataType: 'json',
                    success: function (data) {
                        //console.log(data.years);
                        //data.years + 'years ' + data.months + 'months ' + data.days+'days'
                        if (data.years == 0 && data.months == 0){
                            var output = data.days+' days';
                        }else if(data.years == 0 && data.months != 0){
                            var output = data.months + ' months ' + data.days+' days';
                        }else{
                            var output = data.years + ' years ' + data.months + ' months ' + data.days+' days';
                        }
                        $('#duration').val(output);
                    }
                });
            }
        });
    </script>
@endsection
