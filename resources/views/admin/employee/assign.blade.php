@extends('layouts.app')
@section('title','Assign Employee')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Assign Employee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <span class="card-title">Employee Info</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="" style="width:100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>OLD PIN</th>
                                <th>NEW PIN</th>
                                <th>Designation</th>
                                <th>Office/Station</th>
                                <th>Date of Join</th>
                                <th>Batch No</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$employee->name ?? ''}}</td>
                                <td>{{$employee->pin_no ?? ''}}</td>
                                <td>{{$employee->new_pin ?? ''}}</td>
                                <td>{{$employee->designation->en_name ?? ''}}</td>
                                <td>{{$employee->jobStation->name ?? ''}}</td>
                                <td>{{\Carbon\Carbon::parse($employee->join_date ??'')->format('d-m-Y')}}</td>
                                <td>{{$employee->batch_no? $employee->batch_no.'-'.$employee->batch_no_ext : ''}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="vue_app">
        <div class="col-md-12">
            <div class="card mb-3 bg-secondary">
                <div class="card-header text-white">
                    Choose Assign Category
                </div>
                <div class="card-body">
                    <select class="form-control text-uppercase" v-model="category" name="category">
                        <option value="">Select Category</option>
                        {{--<option value="Award">Award</option>
                        <option value="Achievement">Achievement</option>--}}
                        @can('Leave give/assign')
                            <option value="Leave">Leave</option>
                        @endcan
                        {{--<option value="Punishment">Punishment</option>--}}
                        @can('Job history create')
                            <option value="Posting Record">Job History</option>
                        @endcan
                        @can('Abroad training give/assign')
                            <option value="Foreign Training">Abroad Training</option>
                        @endcan
                        @can('Inland training give/assign')
                            <option value="Local Training">Inland Training</option>
                        @endcan
                        @can('Inhouse training give/assign')
                            <option value="Inhouse Training">Inhouse Training</option>
                        @endcan

                    </select>
                </div>
            </div>
        </div>

        {{----------- leaves -----------}}
        <div class="col-md-12" v-if="category === 'Leave'">
            <form class="form" method="POST" enctype="multipart/form-data" action="{{route('add-leaves-to-employee-store')}}">
                @csrf
                <div class="card mb-3" v-for="(row,index) in leave_inputs">
                    <div class="card-header bg-info text-white">
                        <span class="card-title float-left" style="font-size: x-large;">Leave Info @{{index+1}}</span>
                        <button type="button" class="btn btn-danger float-right" @click="removeLeave(index)"><i class="fa fa-close fa-lg"></i>Remove</button>
                    </div>
                    <div class="card-body">

                        <input class="form-control" id="employee_id" type="hidden" name="employee_id" value="{{$employee->id}}">

                        <div class="row">

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="leave.id">Leave</label>
                                    <select class="form-control text-uppercase" :name="'leaves['+index+'][id]'">
                                        <option value="">Select Leave</option>
                                        <option v-for="leave in leaves" :value="leave.id">@{{leave.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                    <input class="form-control demoDate from_date" :name="'leaves['+index+'][from_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input class="form-control demoDate to_date" :name="'leaves['+index+'][to_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="memo_date">Memo Date</label>
                                    <input class="form-control demoDate memo_date" :name="'leaves['+index+'][memo_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label" for="memo_no">Memo No</label>
                                    <input class="form-control" type="text" :name="'leaves['+index+'][memo_no]'" value="{{ old('memo_no') }}">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label" for="attachment">Attachment</label>
                                    <input class="form-control" :name="'leaves['+index+'][attachment]'" type="file">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label" for="duration">Duration </label>
                                    <input class="form-control duration" readonly type="text" :name="'leaves['+index+'][duration]'" value="{{ old('duration') }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                    <textarea class="form-control" rows="2" :name="'leaves['+index+'][description]'"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button type="button" class="btn btn-info float-end" @click.prevent="addMoreLeave">Add More Leave</button>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </div>

        {{----------- posting records -----------}}
        <div class="col-md-12" v-if="category === 'Posting Record'">
            <form class="form" method="POST" enctype="multipart/form-data" action="{{route('add-posting-records-to-employee')}}">
                @csrf
                <div class="card mb-3" v-for="(row,index) in posting_record_inputs">
                    <div class="card-header bg-info text-white">
                        <span class="card-title float-left" style="font-size: x-large;">Posting Record Info @{{index+1}}</span>
                        <button type="button" class="btn btn-danger float-right" @click="removePostingRecord(index)"><i class="fa fa-close fa-lg"></i>Remove</button>
                    </div>
                    <div class="card-body">

                        <input class="form-control" type="hidden" name="employee_id" value="{{$employee->id}}">

                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="grade.id">Grade</label>
                                    <select class="form-control " :name="'posting['+index+'][grade_id]'">
                                        <option value="">Select Grade</option>
                                        <option v-for="grade in grades" :value="grade.id">@{{grade.grade}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="designation.id">Designation</label>
                                    <select class="form-control " :name="'posting['+index+'][designation_id]'">
                                        <option value="">Select Designation</option>
                                        <option v-for="designation in designations" :value="designation.id">@{{designation.en_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="station.id">Office/Station</label>
                                    <select class="form-control select2vue" :name="'posting['+index+'][station_id]'">
                                        <option value="">Select Office/Station</option>
                                        <option v-for="station in stations" :value="station.id">[@{{station.code}}] @{{station.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="type">Posting Type</label>
                                    <select class="form-control " :name="'posting['+index+'][type]'">
                                        <option value="">Select Type</option>
                                        <option v-for="(type,index) in posting_types" :value="index">@{{type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                    <input class="form-control demoDate from_date" :name="'posting['+index+'][from_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input class="form-control demoDate to_date" :name="'posting['+index+'][to_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label" for="duration">Duration </label>
                                    <input class="form-control duration" readonly type="text" :name="'posting['+index+'][duration]'" value="{{ old('duration') }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label" for="attachment">Attachment</label>
                                    <input class="form-control" :name="'posting['+index+'][attachment]'" type="file">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                    <textarea class="form-control" rows="2" :name="'posting['+index+'][description]'"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button type="button" class="btn btn-info float-end" @click.prevent="addMorePostingRecord">Add More Posting Record</button>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </div>

        {{----------- foreign-trainings -----------}}
        <div class="col-md-12" v-if="category === 'Foreign Training'">
            <form class="form" method="POST" action="{{route('add-foreign-trainings-to-employee')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3" v-for="(row,index) in foreign_training_inputs">
                    <div class="card-header bg-info text-white">
                        <span class="card-title float-left" style="font-size: x-large;">Abroad Training Info @{{index+1}}</span>
                        <button type="button" class="btn btn-danger float-right" @click="removeForeignTraining(index)"><i class="fa fa-close fa-lg"></i>Remove</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input class="form-control" type="hidden" name="employee_id" value="{{$employee->id}}">

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="foreign_training.id">Abroad Training</label>
                                    <select class="form-control text-uppercase" :name="'foreign_training['+index+'][id]'">
                                        <option value="">Select Abroad Training</option>
                                        <option v-for="foreign_training in foreign_trainings" :value="foreign_training.id">@{{foreign_training.course_title}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="memo_date">Memo Date</label>
                                    <input class="form-control demoDate" :name="'foreign_training['+index+'][memo_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('memo_date')}}">
                                    <span class="text-danger" v-if="errors.memo_date">@{{ errors.memo_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                    <input class="form-control demoDate from_date" :name="'foreign_training['+index+'][from_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('from_date')}}">
                                    <span class="text-danger" v-if="errors.from_date">@{{ errors.from_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input class="form-control demoDate to_date" :name="'foreign_training['+index+'][to_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('to_date')}}">
                                    <span class="text-danger" v-if="errors.to_date">@{{ errors.to_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="memo_number">Memo Number</label>
                                    <input class="form-control" id="memo_number" type="text" :name="'foreign_training['+index+'][memo_number]'" value="{{ old('memo_number') }}">
                                    <span class="text-danger" v-if="errors.memo_number">@{{ errors.memo_number[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="duration">Duration</label>
                                    <input class="form-control duration" readonly type="text" :name="'foreign_training['+index+'][duration]'" value="{{ old('duration') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="country_id">Country</label>
                                    <select class="form-control text-uppercase" :name="'foreign_training['+index+'][country_id]'">
                                        <option value="" disabled selected> Select Country </option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{old('country_id')==$country->id?'selected':''}}>{{$country->name}}</option>
                                        @endforeach()
                                    </select>
                                    <span class="text-danger" v-if="errors.country_id">@{{ errors.country_id[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="venue">Venue</label>
                                    <input class="form-control" id="venue" type="text" :name="'foreign_training['+index+'][venue]'" value="{{ old('venue') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="result">Result</label>
                                    <select :name="'foreign_training['+index+'][result]'" id="result" class="form-control">
                                        <option value="PASS" selected>PASS</option>
                                        <option value="FAIL">FAIL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description" :name="'foreign_training['+index+'][description]'"> {{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button type="button" class="btn btn-info float-end" @click.prevent="addMoreForeignTraining">Add More Abroad Training</button>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </div>

        {{----------- local-trainings -----------}}
        <div class="col-md-12" v-if="category === 'Local Training'">
            <form class="form" method="POST" action="{{route('add-local-trainings-to-employee')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3" v-for="(row,index) in local_training_inputs">
                    <div class="card-header bg-info text-white">
                        <span class="card-title float-left" style="font-size: x-large;">Inland Training Info @{{index+1}}</span>
                        <button type="button" class="btn btn-danger float-right" @click="removeLocalTraining(index)"><i class="fa fa-close fa-lg"></i>Remove</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input class="form-control" type="hidden" name="employee_id" value="{{$employee->id}}">

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="">
                                    <label class="col-form-label col-form-label-sm" for="local_training.id">Inland Training</label>
                                    <select class="form-control text-uppercase" :name="'local_training['+index+'][id]'">
                                        <option value="">Select Inland Training</option>
                                        <option v-for="local_training in local_trainings" :value="local_training.id">@{{local_training.course_title}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="memo_date">Memo Date</label>
                                    <input class="form-control demoDate" :name="'local_training['+index+'][memo_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('memo_date')}}">
                                    <span class="text-danger" v-if="errors.memo_date">@{{ errors.memo_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                    <input class="form-control demoDate from_date" :name="'local_training['+index+'][from_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('from_date')}}">
                                    <span class="text-danger" v-if="errors.from_date">@{{ errors.from_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input class="form-control demoDate to_date" :name="'local_training['+index+'][to_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('to_date')}}">
                                    <span class="text-danger" v-if="errors.to_date">@{{ errors.to_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="memo_number">Memo Number</label>
                                    <input class="form-control" id="memo_number" type="text" :name="'local_training['+index+'][memo_number]'" value="{{ old('memo_number') }}">
                                    <span class="text-danger" v-if="errors.memo_number">@{{ errors.memo_number[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="duration">Duration</label>
                                    <input class="form-control duration" readonly type="text" :name="'local_training['+index+'][duration]'" value="{{ old('duration') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="country_id">Country</label>
                                    <input type="text" class="form-control" value="Bangladesh" readonly>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="course_coordinator">Course Coordinator</label>
                                    <input class="form-control" id="course_coordinator" type="text" :name="'local_training['+index+'][venue]'" value="{{ old('course_coordinator') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="course_coordinator">Venue</label>
                                    <input class="form-control" id="course_coordinator" type="text" :name="'local_training['+index+'][course_coordinator]'" value="{{ old('course_coordinator') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="result">Result</label>
                                    <select :name="'local_training['+index+'][result]'" id="result" class="form-control">
                                        <option value="PASS" selected>PASS</option>
                                        <option value="FAIL">FAIL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description" :name="'local_training['+index+'][description]'"> {{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button type="button" class="btn btn-info float-end" @click.prevent="addMoreLocalTraining">Add More Inland Training</button>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </div>

        {{----------- inhouse-trainings -----------}}
        <div class="col-md-12" v-if="category === 'Inhouse Training'">
                <form class="form" method="POST" action="{{route('add-inhouse-trainings-to-employee')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-3" v-for="(row,index) in inhouse_training_inputs">
                        <div class="card-header bg-info text-white">
                            <span class="card-title float-left" style="font-size: x-large;">Inhouse Training Info @{{index+1}}</span>
                            <button type="button" class="btn btn-danger float-right" @click="removeInhouseTraining(index)"><i class="fa fa-close fa-lg"></i>Remove</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input class="form-control" type="hidden" name="employee_id" value="{{$employee->id}}">

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="">
                                        <label class="col-form-label col-form-label-sm" for="inhouse_training.id">Inhouse Training</label>
                                        <select class="form-control text-uppercase" :name="'inhouse_training['+index+'][id]'">
                                            <option value="">Select Inhouse Training</option>
                                            <option v-for="inhouse_training in inhouse_trainings" :value="inhouse_training.id">@{{inhouse_training.course_title}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="memo_date">Memo Date</label>
                                        <input class="form-control demoDate" :name="'inhouse_training['+index+'][memo_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('memo_date')}}">
                                        <span class="text-danger" v-if="errors.memo_date">@{{ errors.memo_date[0] }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                        <input class="form-control demoDate from_date" :name="'inhouse_training['+index+'][from_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('from_date')}}">
                                        <span class="text-danger" v-if="errors.from_date">@{{ errors.from_date[0] }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                        <input class="form-control demoDate to_date" :name="'inhouse_training['+index+'][to_date]'" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('to_date')}}">
                                        <span class="text-danger" v-if="errors.to_date">@{{ errors.to_date[0] }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="memo_number">Memo Number</label>
                                        <input class="form-control" id="memo_number" type="text" :name="'inhouse_training['+index+'][memo_number]'" value="{{ old('memo_number') }}">
                                        <span class="text-danger" v-if="errors.memo_number">@{{ errors.memo_number[0] }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="duration">Duration</label>
                                        <input class="form-control duration" readonly type="text" :name="'inhouse_training['+index+'][duration]'" value="{{ old('duration') }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="country_id">Country</label>
                                        <input type="text" class="form-control" value="Bangladesh" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="course_coordinator">Course Coordinator</label>
                                        <input class="form-control" id="course_coordinator" type="text" :name="'inhouse_training['+index+'][course_coordinator]'" value="{{ old('course_coordinator') }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="venue">Venue</label>
                                        <input class="form-control" id="venue" type="text" :name="'inhouse_training['+index+'][venue]'" value="{{ old('venue') }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="result">Result</label>
                                        <select :name="'inhouse_training['+index+'][result]'" id="result" class="form-control">
                                            <option value="PASS" selected>PASS</option>
                                            <option value="FAIL">FAIL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                        <textarea class="form-control" rows="3" id="description" :name="'inhouse_training['+index+'][description]'"> {{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                        <button type="button" class="btn btn-info float-end" @click.prevent="addMoreInhouseTraining">Add More Inhouse Training</button>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-8 mt-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>
            </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    category: '',
                    id: '',
                    leaves: {!! $leaves !!},
                    foreign_trainings: {!! $foreign_trainings !!},
                    local_trainings: {!! $local_trainings !!},
                    inhouse_trainings: {!! $inhouse_trainings !!},
                    grades: {!! $grades !!},
                    designations: {!! $designations !!},
                    stations: {!! $stations !!},
                    posting_types: {!! $posting_types !!},
                    leave_inputs: [{}],
                    posting_record_inputs: [{}],
                    foreign_training_inputs: [{}],
                    local_training_inputs: [{}],
                    inhouse_training_inputs: [{}],
                    errors:[],
                },
                methods: {
                    addMoreLeave() {
                        this.leave_inputs.push(1);
                    },
                    addMorePostingRecord() {
                        this.posting_record_inputs.push(1);
                    },
                    addMoreForeignTraining() {
                        this.foreign_training_inputs.push(1);
                    },
                    addMoreLocalTraining() {
                        this.local_training_inputs.push(1);
                    },
                    addMoreInhouseTraining() {
                        this.inhouse_training_inputs.push(1);
                    },
                    removeLeave(row) {
                        this.leave_inputs.splice(this.leave_inputs.indexOf(row), 1);
                    },
                    removePostingRecord(index) {
                        this.posting_record_inputs.splice(this.posting_record_inputs.indexOf(index), 1);
                    },
                    removeForeignTraining(index) {
                        this.foreign_training_inputs.splice(this.foreign_training_inputs.indexOf(index), 1);
                    },
                    removeLocalTraining(index) {
                        this.local_training_inputs.splice(this.local_training_inputs.indexOf(index), 1);
                    },
                    removeInhouseTraining(index) {
                        this.inhouse_training_inputs.splice(this.inhouse_training_inputs.indexOf(index), 1);
                    },
                    valid() {

                    },

                },
                mounted() {
                    $('.select2vue').select2();
                    $('.from_date').on('keyup',function () {
                        var from_date = moment($(this).val(), 'DD-MM-YYYY');
                        var to_date = moment($(this).parent().parent().next().find('.to_date').val(), 'DD-MM-YYYY');

                        if (from_date.isValid() && to_date.isValid()) {
                            var duration = moment.duration(to_date.diff(from_date)).add(1, 'days');
                            if (duration.years() === 0 && duration.months() === 0){
                                output = duration.days() +' days';
                            }else if(duration.years() === 0 && duration.months() !== 0){
                                output = duration.months() + ' months ' + duration.days() +' days';
                            }else{
                                output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days()+' days';
                            }
                            $(this).parent().parent().next().next().next().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().next().find('.duration').val(output);
                        } else {
                            console.log('Invalid date(s).')
                        }
                    })

                    $('.to_date').on('keyup',function () {
                        var from_date = moment($(this).parent().parent().prev().find('.from_date').val(), 'DD-MM-YYYY');
                        var to_date = moment($(this).val(), 'DD-MM-YYYY');

                        if (from_date.isValid() && to_date.isValid()) {
                            var duration = moment.duration(to_date.diff(from_date)).add(1, 'days');
                            if (duration.years() === 0 && duration.months() === 0){
                                output = duration.days() +' days';
                            }else if(duration.years() === 0 && duration.months() !== 0){
                                output = duration.months() + ' months ' + duration.days() +' days';
                            }else{
                                output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days()+' days';
                            }
                            $(this).parent().parent().next().next().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().find('.duration').val(output);
                        } else {
                            console.log('Invalid date(s).')
                        }
                    })

                    $('.demoDate').on('keyup',function () {
                        let time = $(this).val()

                        //Get all elements with class "demoDate"
                        for (var i = 0; i < time.length; i++) { //Loop trough elements
                            var reg = /[0-9]/;
                            if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-"; //Add colon if string length > 2 and string is a number
                            if (this.value.length == 5  && reg.test(this.value)) this.value = this.value + "-"; //Add colon if string length > 2 and string is a number
                            // if (this.value.length ==3) this.value = this.value.substr(0, this.value.length - 1); //Delete the last digit if string length > 5
                        }
                    })
                },
                updated() {
                    $('.select2vue').select2();
                    $('.from_date').on('keyup',function () {
                        var from_date = moment($(this).val(), 'DD-MM-YYYY');
                        var to_date = moment($(this).parent().parent().next().find('.to_date').val(), 'DD-MM-YYYY');

                        if (from_date.isValid() && to_date.isValid()) {
                            var duration = moment.duration(to_date.diff(from_date)).add(1, 'days');
                            if (duration.years() === 0 && duration.months() === 0){
                                output = duration.days() +' days';
                            }else if(duration.years() === 0 && duration.months() !== 0){
                                output = duration.months() + ' months ' + duration.days() +' days';
                            }else{
                                output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days()+' days';
                            }
                            $(this).parent().parent().next().next().next().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().next().find('.duration').val(output);
                        } else {
                            console.log('Invalid date(s).')
                        }
                    })

                    $('.to_date').on('keyup',function () {
                        var from_date = moment($(this).parent().parent().prev().find('.from_date').val(), 'DD-MM-YYYY');
                        var to_date = moment($(this).val(), 'DD-MM-YYYY');

                        if (from_date.isValid() && to_date.isValid()) {
                            var duration = moment.duration(to_date.diff(from_date)).add(1, 'days');
                            if (duration.years() === 0 && duration.months() === 0){
                                output = duration.days() +' days';
                            }else if(duration.years() === 0 && duration.months() !== 0){
                                output = duration.months() + ' months ' + duration.days() +' days';
                            }else{
                                output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days()+' days';
                            }
                            $(this).parent().parent().next().next().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().next().find('.duration').val(output);
                            $(this).parent().parent().next().find('.duration').val(output);
                        } else {
                            console.log('Invalid date(s).')
                        }
                    })

                    $('.demoDate').on('keyup',function () {
                        let time = $(this).val()

                        //Get all elements with class "demoDate"
                        for (var i = 0; i < time.length; i++) { //Loop trough elements
                            var reg = /[0-9]/;
                            if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-"; //Add colon if string length > 2 and string is a number
                            if (this.value.length == 5  && reg.test(this.value)) this.value = this.value + "-"; //Add colon if string length > 2 and string is a number
                            // if (this.value.length ==3) this.value = this.value.substr(0, this.value.length - 1); //Delete the last digit if string length > 5
                        }
                    })
                },
            });
        });

        $(document).on('submit', '.form', function (event) {
            event.preventDefault();

            var formData = new FormData(this);
            $('input').next().remove('.ajax-error');
            $('select').next().remove('.ajax-error');

            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
            });

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                enctype: 'multipart/form-data',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,

                success: function (response) {
                    console.log(response)
                    window.location.href = response.url;
                },
                error: function (xhr) {
                    var errors = Object.entries(xhr.responseJSON.errors);

                    for(error of errors){
                        const splited = error[0].split(".");
                        const error_formatted = '\''+splited[0]+'['+splited[1]+']['+splited[2]+']'+'\'';

                        const input = $('input[name=' + error_formatted + ']');
                        input.addClass('is-invalid')
                        input.after(
                            '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                        );

                        const select = $('select[name=' + error_formatted + ']');
                        select.addClass('is-invalid')
                        select.after(
                            '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                        );

                        toastr.error(error[1], {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                }
            });
        });

    </script>
@endpush
