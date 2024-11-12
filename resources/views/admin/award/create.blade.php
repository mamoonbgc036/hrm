@extends('layouts.app')
@section('title','Add Award')
@push('css')
    <style xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
        label {
            font-size: 1em !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Award </h1>
        </div>
    </div>
    <form action="{{route('award.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tile">
            <div class="tile-title-w-btn">
                <h4 class="title"> <i class="fa fa-plus" aria-hidden="true"></i> Create Award </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('award.index')}}"><i class="fa fa-list"></i>See List</a></p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="award_name">Award Name <i class="text-danger">*</i></label>
                        <input class="form-control" id="award_name" type="text" name="award_name" value="{{ old('award_name') }}" required>
                    </div>
                </div>
                {{--<div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="achievement_name">Achievement Name</label>
                        <input class="form-control" id="achievement_name" type="text" name="achievement_name" value="{{ old('achievement_name') }}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="memo_no">Memo No <i class="text-danger">*</i></label>
                        <input class="form-control" id="memo_no" type="text" name="memo_no" value="{{ old('memo_no') }}" required>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Date <i class="text-danger">*</i></label>
                        <input class="form-control demoDate" id="date" name="date" type="text" placeholder="DD-MM-YY" autocomplete="off" value="{{ old('date') }}" required>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Description</label>
                        <textarea class="form-control" id="" cols="30" rows="5" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>--}}

            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
        {{--assign employee to this award--}}
        {{--<div class="tile">
            <div id="vue_app">
                <div class="tile-title-w-btn">
                    <h3 class="title text-danger">If want's to assign Employee</h3>
                </div>
                <div class="card-body" style="padding: unset">
                    <div class="row">
                        --}}{{--<div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="form-group">
                                <label for="pin_no">PIN No</label>
                                <input type="number" id="pin_no" name="pin_no" v-model="field.pin_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label " for="employee_pn_number">Phone number</label>
                                <select class="form-control form-control-sm" id="employee_pn_no" name="employee_pn_no" v-model="field.employee_pn_no">
                                    <option value="" disabled selected>Select phone number</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->pn_no}}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>--}}{{--
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label " for="employee_pn_no">PIN NO.</label>
                                <select class="form-control form-control-sm demoSelect" id="employee_pn_no" name="employee_pn_no" v-model="field.employee_id">
                                    <option value="" disabled selected>Select employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->pn_no}}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <button class="btn btn-primary" type="button" @click="data_input" style="margin-top: 27px">Insert</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pin No</th>
                        <th>Employee Id</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(row, index) in items">
                        <td>
                            <input type="text"  :name="'trainers['+index+'][data_pin_no]'"
                                   class="form-control input-sm" v-bind:value="row.data_pin_no">
                        </td>
                        <td>
                            <input type="number" :name="'trainers['+index+'][date_employee_id]'"
                                   class="form-control input-sm" v-bind:value="row.date_employee_id">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" @click="delete_row(row)"><i
                                    class="fas fa-trash-alt">Remove</i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="col-md-12 col-sm-12">
                    <button class="btn btn-primary float-right" type="submit">Submit</button>
                </div>
                <br>
                <br>
            </div>
            --}}{{--<div class="tile-title-w-btn">
                <h3 class="title text-danger">If want's to assign Employee</h3>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="pinNumber" class="">PIN No.</label>
                        <input type="number" id="pinNumber" class="form-control" name="pin_number">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="pn_no" class="">Mobile No.</label>
                        <input type="number" id="pn_no" class="form-control" name="pn_no">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name" class="">Employee Name</label>
                        <input type="text" id="name" class="form-control" name="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-success" style="margin-top: 27px">Search</button>
                    --}}{{----}}{{--<div class="form-group">
                        <label for=""></label>

                    </div>--}}{{----}}{{--
                </div>
                --}}{{----}}{{--<div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="demoSelect">Employee</label>
                        <select class="form-control form-control-sm demoSelect" id="demoSelect" name="employee_id"
                                value="{{ old('employee_id') }}">
                            <option value="" disabled selected>Select employee</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}" }>{{$employee->name}}</option>
                            @endforeach()
                        </select>
                    </div>
                </div>--}}{{----}}{{--
                --}}{{----}}{{--<div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="attachment_file">Attachment File</label>
                        <input class="form-control" id="attachment_file" name="attachment_file" type="file"
                               autocomplete="off">
                    </div>
                </div>--}}{{----}}{{--
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>--}}{{--
        </div>--}}
    </form>
@endsection
@section('js')
    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script>
        $(document).ready(function () {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    field: {
                        pin_no: '',
                        employee_id: '',
                        employee_pn_no: '',
                    },
                    items: [],
                },
                methods: {
                    data_input() {
                        var vm = this;
                        if (!vm.field.pin_no) {
                            toastr.error('Please give PIN no!', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        } else if (!vm.field.employee_id) {
                            toastr.error('Please select employee!', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }else if (!vm.field.employee_pn_no) {
                            toastr.error('Please select employee phone number!', {
                                closeButton: true,
                                progressBar: true,
                            });
                        } else {
                            vm.items.push({
                                data_pin_no: vm.field.pin_no,
                                date_employee_id: vm.field.employee_id,
                            });
                        }
                        vm.field.pin_no = '';
                        vm.field.employee_id = '';
                        vm.field.employee_pn_no = '';
                    },
                    delete_row: function (row) {
                        this.items.splice(this.items.indexOf(row), 1);
                    },
                },
            });
        });
    </script>
@endsection
