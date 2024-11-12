@extends('layouts.app')
@section('title','Assign Employee for Punishment')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> {{$punishment->name}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row" id="vue_app">
        <div class="col-md-12">
            <form method="POST" action="{{route('add-employee-to-punishment-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Data</span>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="complaint_description">Complaint Description</label>
                                    <input class="form-control my-1" v-model="form.complaint_description" id="complaint_description" type="text" name="complaint_description" value="{{ old('complaint_description') }}">
                                    <input type="file" id="hasFile1" @change.prevent="complaint_file_change" name="complaint_file"/>
                                    <span class="text-danger" v-if="errors.complaint_description">@{{ errors.complaint_description[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="departmental_case_memo_no_date_and_section">Departmental Case Memo No, Date & Section</label>
                                    <input class="form-control my-1" v-model="form.departmental_case_memo_no_date_and_section" id="departmental_case_memo_no_date_and_section" type="text" name="departmental_case_memo_no_date_and_section" value="{{ old('departmental_case_memo_no_date_and_section') }}">
                                    <input type="file" id="hasFile1" @change.prevent="departmental_case_file_change" name="departmental_case_file"/>
                                    <span class="text-danger" v-if="errors.departmental_case_memo_no_date_and_section">@{{ errors.departmental_case_memo_no_date_and_section[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="settlement_punishment_memo_date_and_description_of_punishment">Settlement /Punishment Memo, Dateand Description of Punishment</label>
                                    <input class="form-control my-1" v-model="form.settlement_punishment_memo_date_and_description_of_punishment" id="settlement_punishment_memo_date_and_description_of_punishment" type="text" name="settlement_punishment_memo_date_and_description_of_punishment" value="{{ old('settlement_punishment_memo_date_and_description_of_punishment') }}">
                                    <input type="file" id="hasFile1" @change.prevent="settlement_punishment_file_change" name="settlement_punishment_file"/>
                                    <span class="text-danger" v-if="errors.settlement_punishment_memo_date_and_description_of_punishment">@{{ errors.settlement_punishment_memo_date_and_description_of_punishment[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="appeal_and_disposal_order_along_with_the_secretary">Appeal and disposal order along with the Secretary</label>
                                    <input class="form-control my-1" v-model="form.appeal_and_disposal_order_along_with_the_secretary" id="appeal_and_disposal_order_along_with_the_secretary" type="text" name="appeal_and_disposal_order_along_with_the_secretary" value="{{ old('appeal_and_disposal_order_along_with_the_secretary') }}">
                                    <input type="file" id="hasFile1" @change.prevent="appeal_and_disposal_file_change" name="appeal_and_disposal_file"/>
                                    <span class="text-danger" v-if="errors.appeal_and_disposal_order_along_with_the_secretary">@{{ errors.appeal_and_disposal_order_along_with_the_secretary[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="case_no_and_judgment_of_the_administrative_tribunal">Case No. and Judgment of the Administrative Tribunal</label>
                                    <input class="form-control my-1" v-model="form.case_no_and_judgment_of_the_administrative_tribunal" id="case_no_and_judgment_of_the_administrative_tribunal" type="text" name="case_no_and_judgment_of_the_administrative_tribunal" value="{{ old('case_no_and_judgment_of_the_administrative_tribunal') }}">
                                    <input type="file" id="hasFile1" @change.prevent="case_no_and_judgment_file_change" name="case_no_and_judgment_file"/>
                                    <span class="text-danger" v-if="errors.case_no_and_judgment_of_the_administrative_tribunal">@{{ errors.case_no_and_judgment_of_the_administrative_tribunal[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="case_no_and_judgment_of_the_administrative_appeal_tribunal">Case No. and judgment of the Administrative Appeal Tribunal</label>
                                    <input class="form-control my-1" v-model="form.case_no_and_judgment_of_the_administrative_appeal_tribunal" id="case_no_and_judgment_of_the_administrative_appeal_tribunal" type="text" name="case_no_and_judgment_of_the_administrative_appeal_tribunal" value="{{ old('case_no_and_judgment_of_the_administrative_appeal_tribunal') }}">
                                    <input type="file" id="hasFile1" @change.prevent="case_no_administrative_file_change" name="case_no_administrative_file"/>
                                    <span class="text-danger" v-if="errors.case_no_and_judgment_of_the_administrative_appeal_tribunal">@{{ errors.case_no_and_judgment_of_the_administrative_appeal_tribunal[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="leave_to_memo_no_and_judgement">Leave to Memo No.and Judgement</label>
                                    <input class="form-control my-1" v-model="form.leave_to_memo_no_and_judgement" id="leave_to_memo_no_and_judgement" type="text" name="leave_to_memo_no_and_judgement" value="{{ old('leave_to_memo_no_and_judgement') }}">
                                    <input type="file" id="hasFile1" @change.prevent="leave_to_memo_file_change" name="leave_to_memo_file"/>
                                    <span class="text-danger" v-if="errors.leave_to_memo_no_and_judgement">@{{ errors.leave_to_memo_no_and_judgement[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="review_case_no_and_judgement">Review Case No. and Judgment</label>
                                    <input class="form-control my-1" v-model="form.review_case_no_and_judgement" id="review_case_no_and_judgement" type="text" name="review_case_no_and_judgement" value="{{ old('review_case_no_and_judgement') }}">
                                    <input type="file" id="hasFile1" @change.prevent="review_case_no_file_change" name="review_case_no_file"/>
                                    <span class="text-danger" v-if="errors.review_case_no_and_judgement">@{{ errors.review_case_no_and_judgement[0] }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="punishment_notice">Punishment Notice</label>
                                    <input class="form-control my-1" v-model="form.punishment_notice" id="punishment_notice" type="text" name="punishment_notice" value="{{ old('punishment_notice') }}">
                                    <input type="file" id="hasFile1" @change.prevent="punishment_notice_file_change" name="punishment_notice_file"/>
                                    <span class="text-danger" v-if="errors.punishment_notice">@{{ errors.punishment_notice[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="accused_reply">Accused Reply</label>
                                    <input class="form-control my-1" v-model="form.accused_reply" id="accused_reply" type="text" name="accused_reply" value="{{ old('accused_reply') }}">
                                    <input type="file" id="hasFile1" @change.prevent="accused_reply_file_change" name="accused_reply_file"/>
                                    <span class="text-danger" v-if="errors.accused_reply">@{{ errors.accused_reply[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="action_apply">Action</label>
                                    <input class="form-control my-1" v-model="form.action_apply" id="action_apply" type="text" name="action_apply" value="{{ old('action_apply') }}">
                                    <input type="file" id="hasFile1" @change.prevent="action_apply_file_change" name="action_apply_file"/>
                                    <span class="text-danger" v-if="errors.action_apply">@{{ errors.action_apply[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="disposal_verdict">Disposal Verdict</label>
                                    <input class="form-control my-1" v-model="form.disposal_verdict" id="disposal_verdict" type="text" name="disposal_verdict" value="{{ old('disposal_verdict') }}">
                                    <input type="file" id="hasFile1" @change.prevent="disposal_verdict_file_change" name="disposal_verdict_file"/>
                                    <span class="text-danger" v-if="errors.disposal_verdict">@{{ errors.disposal_verdict[0] }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="additional_notes">Additional Notes</label>
                                    <input class="form-control my-1" v-model="form.additional_notes" id="additional_notes" type="text" name="additional_notes" value="{{ old('additional_notes') }}">
                                    <input type="file" id="hasFile1" @change.prevent="additional_notes_file_change" name="additional_notes_file"/>
                                    <span class="text-danger" v-if="errors.additional_notes">@{{ errors.additional_notes[0] }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-sm-6 border">
                                <div class="form-group">
                                    <label class="col-form-label" for="comments">Comments</label>
                                    <input class="form-control my-1" v-model="form.comments" id="comments" type="text" name="comments" value="{{ old('comments') }}">
                                    <input type="file" id="hasFile1" @change.prevent="comments_file_change" name="comments_file"/>
                                    <span class="text-danger" v-if="errors.comments">@{{ errors.comments[0] }}</span>
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
                                <td><button type="button" @click.prevent="removeId(row.id)" class="btn btn-sm
                            btn-danger">Remove</button></td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" @click.prevent="formSubmit" class="btn btn-success">Submit</button>
                        {{--</form>--}}
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script>
        $(document).ready(function () {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    pin_no: '',
                    search_result: [],
                    punishment_employees_id: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    form: {
                        attachment:'',
                        punishment_id:'',
                        complaint_description:'',
                        departmental_case_memo_no_date_and_section:'',
                        settlement_punishment_memo_date_and_description_of_punishment:'',
                        appeal_and_disposal_order_along_with_the_secretary:'',
                        case_no_and_judgment_of_the_administrative_tribunal:'',
                        case_no_and_judgment_of_the_administrative_appeal_tribunal:'',
                        leave_to_memo_no_and_judgement:'',
                        review_case_no_and_judgement:'',
                        punishment_notice: '',
                        accused_reply: '',
                        action_apply: '',
                        disposal_verdict: '',
                        additional_notes: '',
                        comments:'',

                        complaint_file: '',
                        departmental_case_file: '',
                        settlement_punishment_file: '',
                        appeal_and_disposal_file: '',
                        case_no_and_judgment_file: '',
                        case_no_administrative_file: '',
                        leave_to_memo_file: '',
                        review_case_no_file: '',
                        punishment_notice_file: '',
                        accused_reply_file: '',
                        action_apply_file: '',
                        disposal_verdict_file: '',
                        additional_notes_file: '',
                        comments_file: '',

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
                            toastr.error('Already Selected.', {
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

                    complaint_file_change(e){
                        this.form.complaint_file = e.target.files[0];
                    },
                    departmental_case_file_change(e){
                        this.form.departmental_case_file = e.target.files[0];
                    },
                    settlement_punishment_file_change(e){
                        this.form.settlement_punishment_file = e.target.files[0];
                    },
                    appeal_and_disposal_file_change(e){
                        this.form.appeal_and_disposal_file = e.target.files[0];
                    },
                    case_no_and_judgment_file_change(e){
                        this.form.case_no_and_judgment_file = e.target.files[0];
                    },
                    case_no_administrative_file_change(e){
                        this.form.case_no_administrative_file = e.target.files[0];
                    },
                    leave_to_memo_file_change(e){
                        this.form.leave_to_memo_file = e.target.files[0];
                    },
                    review_case_no_file_change(e){
                        this.form.review_case_no_file = e.target.files[0];
                    },
                    punishment_notice_file_change(e){
                        this.form.punishment_notice_file = e.target.files[0];
                    },
                    accused_reply_file_change(e){
                        this.form.accused_reply_file = e.target.files[0];
                    },
                    action_apply_file_change(e){
                        this.form.action_apply_file = e.target.files[0];
                    },
                    disposal_verdict_file_change(e){
                        this.form.disposal_verdict_file = e.target.files[0];
                    },
                    additional_notes_file_change(e){
                        this.form.additional_notes_file = e.target.files[0];
                    },
                    comments_file_change(e){
                        this.form.comments_file = e.target.files[0];
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
                    formSubmit(){

                        if (this.form.complaint_description === ''){
                            toastr.error('Complaint Description can\'t be empty', {
                                closeButton: true,
                                progressBar: true,
                            });
                        } else {

                            let btn = event.currentTarget
                            btn.disabled = true

                            let formData = new FormData()
                            formData.append('file', this.form.attachment);
                            formData.append('punishment_id', '{{$punishment->id}}');
                            formData.append('complaint_description', this.form.complaint_description);
                            formData.append('departmental_case_memo_no_date_and_section', this.form.departmental_case_memo_no_date_and_section);
                            formData.append('settlement_punishment_memo_date_and_description_of_punishment', this.form.settlement_punishment_memo_date_and_description_of_punishment);
                            formData.append('appeal_and_disposal_order_along_with_the_secretary', this.form.appeal_and_disposal_order_along_with_the_secretary);
                            formData.append('case_no_and_judgment_of_the_administrative_tribunal', this.form.case_no_and_judgment_of_the_administrative_tribunal);
                            formData.append('case_no_and_judgment_of_the_administrative_appeal_tribunal', this.form.case_no_and_judgment_of_the_administrative_appeal_tribunal);
                            formData.append('leave_to_memo_no_and_judgement', this.form.leave_to_memo_no_and_judgement);
                            formData.append('review_case_no_and_judgement', this.form.review_case_no_and_judgement);
                            formData.append('punishment_notice', this.form.punishment_notice);
                            formData.append('accused_reply', this.form.accused_reply);
                            formData.append('action_apply', this.form.action_apply);
                            formData.append('disposal_verdict', this.form.disposal_verdict);
                            formData.append('additional_notes', this.form.additional_notes);
                            formData.append('comments', this.form.comments);

                            formData.append('complaint_file', this.form.complaint_file);
                            formData.append('departmental_case_file', this.form.departmental_case_file);
                            formData.append('settlement_punishment_file', this.form.settlement_punishment_file);
                            formData.append('appeal_and_disposal_file', this.form.appeal_and_disposal_file);
                            formData.append('case_no_and_judgment_file', this.form.case_no_and_judgment_file);
                            formData.append('case_no_administrative_file', this.form.case_no_administrative_file);
                            formData.append('leave_to_memo_file', this.form.leave_to_memo_file);
                            formData.append('review_case_no_file', this.form.review_case_no_file);
                            formData.append('punishment_notice_file', this.form.punishment_notice_file);
                            formData.append('accused_reply_file', this.form.accused_reply_file);
                            formData.append('action_apply_file', this.form.action_apply_file);
                            formData.append('disposal_verdict_file', this.form.disposal_verdict_file);
                            formData.append('additional_notes_file', this.form.additional_notes_file);
                            formData.append('comments_file', this.form.comments_file);

                            for (let i = 0; i < this.form.employees_ids.length; i++) {
                                formData.append('employees_ids[]', this.form.employees_ids[i]);
                            }
                            console.log(formData)
                            axios.post('/punishment/store-employee', formData)
                                .then((response) => {
                                    console.log(response.data)
                                    if (response.data === 'done') {
                                        toastr.success('Record added successfully', {
                                            closeButton: true,
                                            progressBar: true,
                                        });
                                        window.location = "{{route('punishment.index')}}"
                                    }
                                })
                                .catch((error) => {
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
                    axios.get('/punishment/get-employee-id',{
                        params: {
                            punishment_id: '{{$punishment->id}}'
                        }
                    }).then((response)=>{
                        this.punishment_employees_id = response.data
                    })
                }
            });
        });
    </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endpush
