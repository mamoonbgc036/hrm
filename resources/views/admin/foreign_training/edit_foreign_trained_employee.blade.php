@extends('layouts.app')
@section('title','Edit Abroad Trained Employee')
@push('css')
    <style>
        label{
            font-size: 1em !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Edit Abroad Trained Employee </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">

        {{--{{ $pivot->id }}--}}
        <form action="{{route('update-foreign-trained-employee')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-graduation-cap fa-lg"></i>
                    <span>
                        <a class="text-success" href="{{route('foreign-training.show',$foreign_training->id)}}" data-toggle="tooltip" title="Leave Show">{{ $foreign_training->course_title }}
                        </a>
                    </span>
                    Details for
                    <span>
                        <a class="text-primary" href="{{route('employee.show',$pivot->employee_id)}}" data-toggle="tooltip" title="Employee Show">{{ \App\Models\Employee::find($pivot->employee_id)->name }}</a>
                    </span>
                </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('foreign-training.show',$foreign_training->id)}}"><i class="fa fa-backward"></i>Back To Abroad Training</a></p>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <input type="hidden" value="{{ $pivot->id }}" name="pivot_id">
                        <input type="hidden" value="{{ $foreign_training->id }}" name="foreign_training_id">
                        <label class="col-form-label" for="country_id">Country </label>
                        <select class="form-control text-uppercase" id="country_id" name="country_id">
                            <option value="" disabled selected> Select Country </option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{old('country_id',$pivot->country_id)==$country->id?'selected':''}}>{{$country->name}}</option>
                            @endforeach()
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="memo_number">Memo Number</label>
                        <input class="form-control" id="memo_number" type="text" name="memo_number" placeholder="memo number" value="{{ old('memo_number',$pivot->memo_number) }}">
                        @error('memo_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="memo_date">Memo Date</label>
                        <input class="form-control demoDate" id="memo_date" name="memo_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('memo_date',$pivot->memo_date ? \Carbon\Carbon::parse($pivot->memo_date)->format('d-m-Y') : '') }}">
                        @error('memo_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="from_date">From Date</label>
                        <input class="form-control demoDate" id="from_date" name="from_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('from_date',$pivot->from_date ? \Carbon\Carbon::parse($pivot->from_date)->format('d-m-Y') : '') }}">
                        @error('from_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="to_date">To Date</label>
                        <input class="form-control demoDate" id="to_date" name="to_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('to_date',$pivot->to_date ? \Carbon\Carbon::parse($pivot->to_date)->format('d-m-Y') : '') }}">
                        @error('to_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="duration">Duration </label>
                        <input class="form-control" readonly id="duration" type="text" name="duration" value="{{ old('duration',$pivot->duration) }}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="venue">Venue</label>
                        <input class="form-control" id="venue" name="venue" type="text" placeholder="issue authorities" autocomplete="off" value="{{ old('venue',$pivot->venue) }}">
                        @error('venue')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="result">Result </label>
                        <select class="form-control" id="result" name="result">
                            <option value="" disabled selected> Select Result </option>
                            <option value="PASS" @if($pivot->result == 'PASS') selected @endif>PASS</option>
                            <option value="FAIL" @if($pivot->result == 'FAIL') selected @endif>FAIL</option>
                        </select>
                        @error('result')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label" for="description">Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="DESCRIPTION">{{ old('description',$pivot->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
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
