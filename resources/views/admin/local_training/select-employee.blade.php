@extends('layouts.app')
@section('title','Assign Employee for Inland Training')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> {{$l_training->course_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row" id="vue_app">
        <div class="col-md-12">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Data</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" v-model="form.l_training_id">

                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="memo_date">Memo Date</label>
                                    <input v-model="form.memo_date" class="form-control demoDate" id="memo_date" name="memo_date" type="text"
                                           placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('memo_date')}}">
                                    <span class="text-danger" v-if="errors.memo_date">@{{ errors.memo_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                                    <input v-model="form.from_date" @keyup.prevent="getDuration" class="form-control demoDate2" id="from_date" name="from_date" type="text"
                                           placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('from_date')}}">
                                    <span class="text-danger" v-if="errors.from_date">@{{ errors.from_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input v-model="form.to_date" @keyup.prevent="getDuration" class="form-control demoDate3" id="to_date" name="to_date" type="text"
                                           placeholder="DD-MM-YYYY" autocomplete="off" value="{{old('to_date')}}">
                                    <span class="text-danger" v-if="errors.to_date">@{{ errors.to_date[0] }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="country_id">Country </label>
                                    <input type="text" v-model="form.country" class="form-control" value="Bangladesh" readonly>
                                    <span class="text-danger" v-if="errors.country">@{{ errors.country[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="venue">Venue</label>
                                    <input v-model="form.venue" class="form-control" id="venue" type="text" name="venue" value="{{ old('venue') }}">
                                    <span class="text-danger" v-if="errors.venue">@{{ errors.venue[0] }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="duration">Duration </label>
                                    <input v-model="form.duration" class="form-control" readonly id="duration" type="text" name="duration" value="{{ old('duration') }}">
                                    <span class="text-danger" v-if="errors.duration">@{{ errors.duration[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="memo_number">Memo Number</label>
                                    <input v-model="form.memo_number" class="form-control" id="memo_number" type="text" name="memo_number" value="{{ old('memo_number') }}">
                                    <span class="text-danger" v-if="errors.memo_number">@{{ errors.memo_number[0] }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="course_coordinator">Course Coordinator</label>
                                    <input v-model="form.course_coordinator" class="form-control" id="course_coordinator" type="text" name="course_coordinator" value="{{ old('course_coordinator') }}">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="description">Description</label>
                                    <textarea v-model="form.description" class="form-control" rows="3" id="description" name="description"> {{ old('description') }}</textarea>
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
                                    <td><button @click.prevent="selectItem(row.id)" class="btn btn-sm btn-success">Select</button></td>
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
                                    <th>Employee Name</th>
                                    <th>OLD PIN</th>
                                    <th>NEW PIN</th>
                                    <th>Designation</th>
                                    <th>Result</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in selected_employees_info">
                                    <td>@{{row.name}}</td>
                                    <td>@{{row.pin_no}}</td>
                                    <td>@{{row.new_pin}}</td>
                                    <td>@{{row.designation ? row.designation.en_name :''}}</td>
                                    <td>
                                        <select v-model="form.employees[index].result" name="result" id="result" class="form-control">
                                            <option value="PASS" selected>PASS</option>
                                            <option value="FAIL">FAIL</option>
                                        </select>
                                    </td>
                                    <td><button type="button" @click.prevent="removeId(row.id)" class="btn btn-sm btn-danger">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" @click.prevent="formSubmit" class="btn btn-success">Submit</button>
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
                    awarded_employees_id: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    form: {
                        l_training_id:'{{ $l_training->id }}',
                        country:'Bangladesh',
                        venue:'',
                        from_date:'',
                        to_date:'',
                        duration:'',
                        memo_number:'',
                        memo_date:'',
                        course_coordinator:'',
                        description:'',
                        employees: [],
                    },
                    errors:[],
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
                        this.form.employees.push({
                            id: this.search_result[0]['id'],
                            result: 'PASS'
                        });
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
                    selectItem(id){
                        if(this.selected_employees_id.includes(id)){
                            toastr.error('Already Selected.', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }else{
                            this.selected_employees_id.push(id);
                            this.form.employees.push({
                                id: id,
                                result: 'PASS'
                            });
                        }
                    },
                    removeId(id){
                        this.selected_employees_id.pop(id);
                        this.form.employees.pop(id);
                    },
                    formSubmit(){
                        let btn = event.currentTarget
                        btn.disabled = true

                        this.errors = []
                        axios.post('/local-training/store-employee',this.form )
                            .then((response)=>{
                                console.log(response.data)
                                if(response.data === 'done'){
                                    toastr.success('Record added successfully', {
                                        closeButton: true,
                                        progressBar: true,
                                    });
                                    window.location = "{{route('local-training.index')}}"
                                }
                            })
                            .catch((error)=>{
                                this.errors = error.response.data.errors

                                let listOfObjects = Object.keys(this.errors).map((key) => {
                                    toastr.error(this.errors[key], {
                                        closeButton: true,
                                        progressBar: true,
                                    });
                                    btn.disabled = false
                                })
                            })
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
                    // ---------- auto colon in datepicker -----------
                    let time = document.querySelectorAll(".demoDate, .demoDate2, .demoDate3"); //Get all elements with class "demoDate"
                    for (var i = 0; i < time.length; i++) { //Loop trough elements
                        time[i].addEventListener('keyup', function (e) { //Add event listener to every element
                            var reg = /[0-9]/;
                            if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-";
                            if (this.value.length == 5  && reg.test(this.value)) this.value = this.value + "-";
                        });
                    }
                    // ---------- auto colon in datepicker -----------
                }
            });

        });
    </script>
@endpush
