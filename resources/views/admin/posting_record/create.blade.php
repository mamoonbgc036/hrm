@extends('layouts.app')
@section('title','Add Job History')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Create Job History</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div id="vue_app">

                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Search Employee</span>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="col-form-label col-form-label-sm" for="pin_no">Employee PIN No.</label>
                                    <input v-model="pin_no" @keyup="getEmployees" @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control" id="pin_no" type="text" autocomplete="off">
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;" v-if="search_result.length > 0">
                            <thead>
                                <tr>
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
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{row.name}}</td>
                                    <td>@{{row.pin_no}}</td>
                                    <td>@{{row.new_pin}}</td>
                                    <td>@{{row.f_name}}</td>
                                    <td>@{{row.m_name}}</td>
                                    <td>@{{row.join_date}}</td>
                                    <td>@{{row.batch_no ? row.batch_no+'-'+row.batch_no_ext : ''}}</td>
                                    <td><button type="button" @click="selectItem(row.id)" class="btn btn-sm btn-success">Select</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>

                <div class="card" v-if="selected_employees_id.length > 0">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Selected Employees</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posting-record.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <div v-for="(row, index) in selected_employees_info.slice().reverse()">
                                    <input type="hidden" :name="'posting['+index+'][employee_id]'" class="form-control input-sm" v-bind:value="row.id">
                                    <div  class="border border-secondary mb-6 p-3 my-2">
                                        <div class="col-sm-12">
                                            <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                                        </div>
                                        <div class="col-sm-12 text-right">
                                            <button type="button" class="btn btn-danger btn-sm" @click="removeId(row.id)"> X </button>
                                        </div>
                                        <div class="row" >
                                            <div class="col-sm-12 col-md-1">
                                                <label for="mobil_oil" class="form-label">OLD PIN</label>
                                                <div class="form-group">
                                                    @{{row.pin_no}}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-1">
                                                <label for="mobil_oil" class="form-label">NEW PIN</label>
                                                <div class="form-group">
                                                    @{{row.new_pin}}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <label for="mobil_oil" class="form-label">Grade</label>
                                                <div class="form-group">
                                                    <select class="form-control demoSelect2 text-uppercase" :name="'posting['+index+'][grade_id]'">
                                                        <option value="" disabled selected hidden>Select Grade</option>
                                                        @foreach($grades as $grade)
                                                            <option value="{{$grade->id}}">{{$grade->grade}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <label for="mobil_oil" class="form-label">Designation</label>
                                                <div class="form-group">
                                                    <select class="form-control text-uppercase" :name="'posting['+index+'][designation_id]'" required>
                                                        <option value="" disabled selected hidden>Select Designation</option>
                                                        @foreach($designations as $designation)
                                                            <option value="{{$designation->id}}">{{$designation->en_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <label for="mobil_oil" class="form-label">Office/Station</label>
                                                <div class="form-group">
                                                    <select class="form-control demoSelect2 text-uppercase" :name="'posting['+index+'][station_id]'" required>
                                                        <option value="" disabled selected hidden>Select Station</option>
                                                        @foreach($stations as $station)
                                                            <option value="{{$station->id}}">{{'['.$station->code.'] '.$station->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <label for="mobil_oil" class="form-label">Posting Type</label>
                                                <div class="form-group">
                                                    <select class="form-control demoSelect2 text-uppercase" :name="'posting['+index+'][type]'">--}}
                                                        <option value="" disabled selected hidden>Select Type</option>
                                                        @foreach($posting_types as $key => $type)
                                                            <option value="{{$key}}">{{$type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <label for="mobil_oil" class="form-label">From Date</label>
                                                <div class="form-group">
                                                    <input class="form-control demoDate" v-model="date.from_date[index]" @change="duration(date.from_date[index], date.to_date[index], date.duration[index], index)" :id="'from_date'+index+''" type="text" :name="'posting['+index+'][from_date]'" placeholder="DD-MM-YYYY" required autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <label for="mobil_oil" class="form-label">To Date</label>
                                                <div class="form-group">
                                                    <input class="form-control demoDate" v-model="date.to_date[index]" @change="duration(date.from_date[index], date.to_date[index], date.duration[index], index)" :id="'to_date'+index+''" type="text" :name="'posting['+index+'][to_date]'" placeholder="DD-MM-YYYY" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <label for="mobil_oil" class="form-label">Duration</label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" v-model="date.duration[index]" :name="'posting['+index+'][duration]'" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <label for="mobil_oil" class="form-label">Attachment</label>
                                                <div class="form-group">
                                                    <input class="form-control" type="file" :name="'posting['+index+'][attachment]'">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <label for="mobil_oil" class="form-label">Description</label>
                                                <div class="form-group">
                                                    <textarea class="form-control text-uppercase" rows="2" :name="'posting['+index+'][description]'"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>



{{--                            <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;">--}}
{{--                                <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <th width="4%">OLD PIN</th>--}}
{{--                                        <th width="4%">NEW PIN</th>--}}
{{--                                        <th width="7%">Grade</th>--}}
{{--                                        <th width="7%">Designation</th>--}}
{{--                                        <th width="7%">Office/Station</th>--}}
{{--                                        <th width="7%">Posting Type</th>--}}
{{--                                        <th width="11%">From Date</th>--}}
{{--                                        <th width="11%">To Date</th>--}}
{{--                                        <th width="13%">Duration</th>--}}
{{--                                        <th width="8%">Attachment</th>--}}
{{--                                        <th width="12%">Description</th>--}}
{{--                                        <th width="8%">Action</th>--}}
{{--                                    </tr>--}}
{{--                                    <tr v-for="(row, index) in selected_employees_info.slice().reverse()">--}}
{{--                                        <input type="hidden" :name="'posting['+index+'][employee_id]'" class="form-control input-sm" v-bind:value="row.id">--}}
{{--                                        <td>@{{row.pin_no}}</td>--}}
{{--                                        <td>@{{row.new_pin}}</td>--}}
{{--                                        <td>--}}
{{--                                            <select class="form-control demoSelect2 text-uppercase" :name="'posting['+index+'][grade_id]'">--}}
{{--                                                <option value="" disabled selected hidden>Select Grade</option>--}}
{{--                                                @foreach($grades as $grade)--}}
{{--                                                    <option value="{{$grade->id}}">{{$grade->grade}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <select class="form-control text-uppercase" :name="'posting['+index+'][designation_id]'" required>--}}
{{--                                                <option value="" disabled selected hidden>Select Designation</option>--}}
{{--                                                @foreach($designations as $designation)--}}
{{--                                                    <option value="{{$designation->id}}">{{$designation->en_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <select class="form-control demoSelect2 text-uppercase" :name="'posting['+index+'][station_id]'" required>--}}
{{--                                                <option value="" disabled selected hidden>Select Station</option>--}}
{{--                                                @foreach($stations as $station)--}}
{{--                                                    <option value="{{$station->id}}">{{'['.$station->code.'] '.$station->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <select class="form-control demoSelect2 text-uppercase" :name="'posting['+index+'][type]'">--}}
{{--                                                <option value="" disabled selected hidden>Select Type</option>--}}
{{--                                                @foreach($posting_types as $key => $type)--}}
{{--                                                    <option value="{{$key}}">{{$type}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control demoDate" v-model="date.from_date[index]" @change="duration(date.from_date[index], date.to_date[index], date.duration[index], index)" :id="'from_date'+index+''" type="text" :name="'posting['+index+'][from_date]'" placeholder="DD-MM-YYYY" required autocomplete="off">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control demoDate" v-model="date.to_date[index]" @change="duration(date.from_date[index], date.to_date[index], date.duration[index], index)" :id="'to_date'+index+''" type="text" :name="'posting['+index+'][to_date]'" placeholder="DD-MM-YYYY" autocomplete="off">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control" type="text" v-model="date.duration[index]" :name="'posting['+index+'][duration]'" readonly>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control" type="file" :name="'posting['+index+'][attachment]'">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <textarea class="form-control text-uppercase" rows="3" :name="'posting['+index+'][description]'"></textarea>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

{{--                                    <tr>--}}
{{--                                        <th>From Date</th>--}}
{{--                                        <th>To Date</th>--}}
{{--                                        <th>Duration</th>--}}
{{--                                        <th>Attachment</th>--}}
{{--                                        <th>Description</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control demoDate" v-model="date.from_date[index]" @change="duration(date.from_date[index], date.to_date[index], date.duration[index], index)" :id="'from_date'+index+''" type="text" :name="'posting['+index+'][from_date]'" placeholder="DD-MM-YYYY" required autocomplete="off">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control demoDate" v-model="date.to_date[index]" @change="duration(date.from_date[index], date.to_date[index], date.duration[index], index)" :id="'to_date'+index+''" type="text" :name="'posting['+index+'][to_date]'" placeholder="DD-MM-YYYY" autocomplete="off">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control" type="text" v-model="date.duration[index]" :name="'posting['+index+'][duration]'" readonly>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input class="form-control" type="file" :name="'posting['+index+'][attachment]'">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <textarea class="form-control text-uppercase" rows="3" :name="'posting['+index+'][description]'"></textarea>--}}
{{--                                        </td>--}}
{{--                                        <td><button type="button" @click="removeId(row.id)" class="btn btn-sm btn-danger">Remove</button></td>--}}
{{--                                    </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    index: '',
                    pin_no: '',
                    search_result: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting:[],

                    no_search_result:false,
                    date:{
                        from_date:[],
                        to_date:[],
                        duration:[],
                    }
                },
                methods: {
                    getEmployees(){
                        if (this.pin_no.length > 3){
                            axios.get('/search-employee',{
                                params: {
                                    pin_no: this.pin_no,
                                }
                            }).then((response)=>{
                                this.search_result = response.data.employees
                            }).catch(function (error) {
                                console.log(error);
                            })
                        }else{
                            this.search_result = []
                            this.no_search_result = true
                        }
                    },
                    selectTheFirstFromSearchResult(){
                        this.selected_employees_id.push(this.search_result[0]['id'])
                    },
                    selectItem(id){
                        if(this.selected_employees_id.includes(id))
                        {
                            toastr.error('Already Selected.', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }else{
                            this.selected_employees_id.push(id);
                        }
                    },
                    removeId(id){
                        /* -------- all working solutions -------- */
                        this.selected_employees_id.pop(id);
                        // this.$delete(this.selected_employees_id, index)
                        // this.selected_employees_id.splice(this.selected_employees_id.indexOf(row), 1);
                    },
                    getEmployeeInfo(){
                        axios.get('/get-employees-info',{
                            params: {
                                ids: this.selected_employees_id
                            }
                        }).then((response)=>{
                            this.selected_employees_info = response.data.employeesInfo
                        })
                    },
                    select(){
                        // --------- auto colon in datepicker ---------
                        var time = document.getElementsByClassName('demoDate'); //Get all elements with class "time"
                        for (var i = 0; i < time.length; i++) { //Loop trough elements
                            time[i].addEventListener('keyup', function (e) {; //Add event listener to every element
                                var reg = /[0-9]/;
                                if (this.value.length == 2 && reg.test(this.value)) this.value = this.value + "-";
                                if (this.value.length == 5  && reg.test(this.value)) this.value = this.value + "-";
                            });
                        };
                        // ---------- auto colon in datepicker ---------
                    },
                    duration(from_date, to_date, duration, index){
                        axios.get('{{ route('fetch-duration2') }}',{
                            params: {
                                from_date: from_date,
                                to_date: to_date,
                            }
                        }).then((response)=>{
                            this.date.duration.push('');
                            this.date.duration[index] = response.data.output
                        }).catch((error)=>{
                            console.log(error)
                        })
                    },
                },
                watch: {
                    selected_employees_id: function(){
                        this.getEmployeeInfo();
                    },
                },
                mounted: function (){
                    this.select();
                    $('.demoSelect2').select2();
                },
                updated: function (){
                    this.select();
                    $('.demoSelect2').select2();
                },

            });

        });
    </script>
@endpush
