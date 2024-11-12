@extends('layouts.app')
@section('title','Add Abroad Training')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Abroad Training</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('foreign-training.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-plus fa-lg"></i> Create Abroad Training</h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('foreign-training.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label class="col-form-label " for="course_title">Course Name</label>
                        <input class="form-control" id="course_title" type="text" name="course_title" value="{{old('course_title')}}" required>
                    </div>
                </div>
                <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label class="col-form-label " for="course_code">Course Code</label>
                        <input class="form-control" id="course_code" type="text" name="course_code" value="{{old('course_code')}}" >
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <button class="btn btn-primary float-right" type="submit">Submit</button>
                </div>
            </div>
            <hr>

        </form>
    </div>

@endsection
@section('js')
    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script>

        $('document').ready(function () {
            $('#to_date').change(function () {
                fetchDuration();
            });

            $('#from_date').change(function () {
                fetchDuration();
            });
            function fetchDuration() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                $.ajax({
                    url: '{{url('fetch-duration')}}',
                    type: 'get',
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    },
                    dataType: 'json',
                    success: function (data) {
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
