@extends('layouts.app')
@section('title','Assign Employee for Leave')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> {{$leave->name}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row" id="vue_app">
        <div class="col-md-12">
            <form method="POST" action="{{route('add-employee-to-leave-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Data</span>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                    <input class="form-control demoDate" v-model="form.from_date" @keyup.prevent="getDuration" required id="from_date" name="from_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger" v-if="errors.from_date">@{{ errors.from_date[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input class="form-control demoDate2" v-model="form.to_date" @keyup.prevent="getDuration" required id="to_date" name="to_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger" v-if="errors.to_date">@{{ errors.to_date[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="memo_date">Memo Date</label>
                                    <input class="form-control demoDate3" v-model="form.memo_date" id="memo_date" name="memo_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off">
                                    <span class="text-danger" v-if="errors.memo_date">@{{ errors.memo_date[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="memo_no">Memo No</label>
                                    <input class="form-control" v-model="form.memo_no" id="memo_no" type="text" name="memo_no" value="{{ old('memo_no') }}">
                                    <span class="text-danger" v-if="errors.memo_no">@{{ errors.memo_no[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="attachment">Attachment</label>
                                    <input @change="onFileChange" class="form-control" id="attachment" name="attachment" type="file">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="duration">Duration </label>
                                    <input class="form-control" v-model="form.duration" readonly id="duration" type="text" name="duration" value="{{ old('duration') }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                    <textarea class="form-control" v-model="form.description" rows="3" id="description" name="description"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{--search employees--}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Search Employee</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="col-form-label col-form-label-sm" for="pin_no">Employee PIN No.</label>
                                <input v-model="pin_no" @keyup="getEmployees" @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control" id="pin_no" type="search" autocomplete="off" placeholder="pin number">
                            </div>
                        </div>
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;">
                            <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>OLD PIN</th>
                                <th>NEW PIN</th>
                                <th>Designation</th>
                                <th>Station</th>
                                <th>Date of Join</th>
                                <th>Batch No</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(row, index) in search_result">
                                <td>@{{row.name}}</td>
                                <td>@{{row.pin_no}}</td>
                                <td>@{{row.new_pin}}</td>
                                <td>@{{row.designation ? row.designation.en_name :''}}</td>
                                <td>@{{row.job_station ? row.job_station.name : ''}}</td>
                                <td>@{{row.join_date}}</td>
                                <td>@{{row.batch_no ? row.batch_no+'-'+row.batch_no_ext : ''}}</td>
                                <td><button @click.prevent="selectItem(row.id)" class="btn btn-sm
                            btn-success">Select</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{--selected employee list--}}
                <div class="card" v-if="selected_employees_id.length > 0">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Selected Employees</span>
                    </div>
                    <div class="card-body" >
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Name</th>
                                <th>OLD PIN</th>
                                <th>NEW PIN</th>
                                <th>Father's Name</th>
                                <th>Mother's Name</th>
                                <th>Date of Join</th>
                                <th>Batch No</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(row, index) in selected_employees_info.slice().reverse()">
                                <input type="hidden" :name="'form.employees_ids['+index+']'" class="form-control input-sm" :value="row.id">
                                <td>@{{ index+1 }}</td>
                                <td>@{{row.name}}</td>
                                <td>@{{row.pin_no}}</td>
                                <td>@{{row.new_pin}}</td>
                                <td>@{{row.f_name}}</td>
                                <td>@{{row.m_name}}</td>
                                <td>@{{row.join_date}}</td>
                                <td>@{{row.batch_no ? row.batch_no+'-'+row.batch_no_ext : ''}}</td>
                                <td><button type="button" @click="removeId(row.id)" class="btn btn-sm
                            btn-danger">Remove</button></td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" @click.prevent="formSubmit($event)" class="btn btn-success">Submit</button>
                        {{--</form>--}}
                    </div>
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
                    pin_no: '',
                    search_result: [],
                    leave_employees_id: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    form: {
                        attachment:'',
                        leave_id:'',
                        memo_no:'',
                        memo_date:'',
                        from_date:'',
                        to_date:'',
                        duration:'',
                        description:'',
                        employees_ids:[],
                    },
                    errors:[]
                },
                methods: {
                    getEmployees(){
                        axios.get('/search-employee',{
                            params: {
                                pin_no: this.pin_no,
                            }
                        }).then((response)=>{
                            this.search_result = response.data.employees
                        }).catch(function (error) {
                            console.log(error);
                        })
                    },
                    selectTheFirstFromSearchResult(){
                        this.selected_employees_id.push(this.search_result[0]['id'])
                    },
                    selectItem(id){
                        if(this.selected_employees_id.includes(id)){
                            toastr.error('Already Selected!', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }else{
                            this.selected_employees_id.push(id);
                            this.form.employees_ids.push(id);
                        }
                    },
                    removeId(id){
                        this.selected_employees_id.pop(id);
                        this.form.employees_ids.pop(id);
                    },
                    onFileChange(e){
                        this.form.attachment = e.target.files[0];
                    },
                    getDuration(){
                        axios.get('/fetch-duration2',{
                            params: {
                                from_date: this.form.from_date,
                                to_date: this.form.to_date,
                            }
                        })
                        .then((response)=>{
                            console.log(response.data.output)
                            this.form.duration = response.data.output
                        })
                        .catch((errors)=>{
                            console.log(errors)
                        })
                    },
                    formSubmit: function(event){

                        if (this.form.from_date == ''){
                            toastr.error('From Date can\'t be empty', {
                                closeButton: true,
                                progressBar: true,
                            });
                        } else if(this.form.to_date == '') {
                            toastr.error('To Date can\'t be empty', {
                                closeButton: true,
                                progressBar: true,
                            });
                        } else {

                            let btn = event.currentTarget
                            btn.disabled = true

                            let formData = new FormData()
                            formData.append('file', this.form.attachment);
                            formData.append('leave_id', '{{$leave->id}}');
                            formData.append('memo_no', this.form.memo_no);
                            formData.append('memo_date', this.form.memo_date);
                            formData.append('from_date', this.form.from_date);
                            formData.append('to_date', this.form.to_date);
                            formData.append('duration', this.form.duration);
                            formData.append('description', this.form.description);

                            for (let i = 0; i < this.form.employees_ids.length; i++) {
                                formData.append('employees_ids[]', this.form.employees_ids[i]);
                            }

                            axios.post('/leave/store-employee',formData )
                            .then((response)=>{
                                console.log(response.data)
                                if(response.data === 'done'){
                                    toastr.success('Record added successfully', {
                                        closeButton: true,
                                        progressBar: true,
                                    });
                                    window.location = "{{route('leave.index')}}"
                                }
                            })
                            .catch((error)=>{
                                this.errors = error.response.data.errors
                                toastr.error('Something wrong!', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                console.log(this.errormessage);
                            })
                        }

                    }
                },
                watch: {
                    selected_employees_id: function(){
                        axios.get('/get-employees-info',{
                            params: {
                                ids: this.selected_employees_id
                            }
                        }).then((response)=>{
                            this.selected_employees_info = response.data.employeesInfo
                        })
                    }
                },
                mounted: function (){
                    axios.get('/leave/get-employee-id',{
                        params: {
                            leave_id: '{{$leave->id}}'
                        }
                    }).then((response)=>{
                        this.leave_employees_id = response.data
                    })

                    let time = document.querySelectorAll(".demoDate, .demoDate2, .demoDate3"); //Get all elements with class "demoDate"
                    for (var i = 0; i < time.length; i++) { //Loop trough elements
                        time[i].addEventListener('keyup', function (e) { //Add event listener to every element
                            var reg = /[0-9]/;
                            if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-";
                            if (this.value.length == 5  && reg.test(this.value)) this.value = this.value + "-";
                        });
                    }
                },
            });
        });
    </script>
@endpush
