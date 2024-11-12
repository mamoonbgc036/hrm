@extends('layouts.app')
@section('title', 'Employee Punishment')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Staff Court Case</h1>
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
                                    <label class="col-form-label col-form-label-sm" for="pin_no">Employee PIN No. or
                                        Name</label>
                                    <input v-model="pin_no" @keyup="getEmployees"
                                        @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control"
                                        id="pin_no" type="text" autocomplete="off">
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;"
                            v-if="search_result.length > 0">
                            <thead>
                                {{-- name, Designation, Disciplinary Action --}}
                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.designation.en_name }}</td>
                                    <td><button type="button" @click="selectItem(row.name, row.id)"
                                            class="btn btn-sm btn-success">File A Case</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>
                <div class="card" v-if="create">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Staff Court Case Form:</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('staff.case') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="employee_id" v-model="form.employee_id">
                            <div class="mt-3">
                                <div class="row">
                                    <!-- Employee Name -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="employee_name" class="form-label">Employee Name</label>
                                        <div class="form-group">
                                            <input type="text" name="employee_name" class="form-control"
                                                v-model="form.employee_name">
                                        </div>
                                    </div>
                                    <!-- Reason -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="reason" class="form-label">Reason</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="reason" v-model="form.reason" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <!-- Court or Thana -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="is_court_thana" class="form-label">Court or Thana</label>
                                        <div class="form-group">
                                            <select class="form-control" name="is_court_thana"
                                                v-model="form.is_court_thana">
                                                <option value="" disabled selected>Select</option>
                                                <option value="Thana">Thana</option>
                                                <option value="Court">Court</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Conditionally show this section based on the value of is_court_thana -->
                                    <div class="col-sm-12 col-md-3 thanaCourt"
                                        v-show="form.is_court_thana === 'Thana' || form.is_court_thana === 'Court'">
                                        <label for="name" class="form-label">@{{ form.is_court_thana }} Name</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" v-model="form.name">
                                        </div>
                                    </div>

                                    <!-- Suspension Date -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="suspension_date" class="form-label">Suspension Date</label>
                                        <div class="form-group">
                                            <input type="date" name="suspension_date" class="form-control"
                                                v-model="form.suspension_date">
                                        </div>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <div class="form-group">
                                            <input type="text" name="remarks" class="form-control"
                                                v-model="form.remarks">
                                        </div>
                                    </div>

                                    <!-- Attoshat Amount -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="attoshat_amount" class="form-label">Attoshat Amount</label>
                                        <div class="form-group">
                                            <input type="text" name="attoshat_amount" class="form-control"
                                                v-model="form.attoshat_amount">
                                        </div>
                                    </div>

                                    <!-- Amount Due -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="amount_due" class="form-label">Amount Due</label>
                                        <div class="form-group">
                                            <input type="text" name="amount_due" class="form-control"
                                                v-model="form.amount_due">
                                        </div>
                                    </div>

                                    <!-- Filling Date -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="filling_date" class="form-label">Filling Date</label>
                                        <div class="form-group">
                                            <input type="date" name="filling_date" class="form-control"
                                                v-model="form.filling_date">
                                        </div>
                                    </div>

                                    <!-- Advocate Name -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="advocate" class="form-label">Advocate Name</label>
                                        <div class="form-group">
                                            <input type="text" name="advocate" class="form-control"
                                                v-model="form.advocate">
                                        </div>
                                    </div>

                                    <!-- Advocate Chamber -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="advocate_chamber" class="form-label">Advocate Chamber</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="advocate_chamber" v-model="form.advocate_chamber" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <!-- Advocate Phone -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="advocate_phone" class="form-label">Advocate Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="advocate_phone" class="form-control"
                                                v-model="form.advocate_phone">
                                        </div>
                                    </div>

                                    <!-- Dealing Employee Name -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="dealing_employee" class="form-label">Dealing Employee Name</label>
                                        <div class="form-group">
                                            <input type="text" name="dealing_employee" class="form-control"
                                                v-model="form.dealing_employee">
                                        </div>
                                    </div>

                                    <!-- Dealing Employee Phone -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="dealing_employee_phone" class="form-label">Dealing Employee
                                            Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="dealing_employee_phone" class="form-control"
                                                v-model="form.dealing_employee_phone">
                                        </div>
                                    </div>

                                    <!-- Dealing Employee Pin -->
                                    <div class="col-sm-12 col-md-3">
                                        <label for="dealing_employee_pin" class="form-label">Dealing Employee Pin</label>
                                        <div class="form-group">
                                            <input type="text" name="dealing_employee_pin" class="form-control"
                                                v-model="form.dealing_employee_pin">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card" v-if="editCase">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Staff Court Case Edit Form:</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('staff.case.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="employee_id" v-model="form.employee_id">
                            <input type="hidden" name="caseId" v-model="caseId">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="employee_name" class="form-label">Employee Name</label>
                                        <div class="form-group">
                                            <input type="text" name="employee_name" class="form-control"
                                                v-model="form.employee_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="reason" class="form-label">Reason</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="reason" v-model="form.reason" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="is_court_thana" class="form-label">Courtss or Thana</label>
                                        <div class="form-group">
                                            <select class="form-control" name="is_court_thana"
                                                v-model="form.is_court_thana">
                                                <option value="" disabled>Select</option>
                                                <option value="Thana">Thana
                                                </option>
                                                <option value="Court" selected>Court
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 thanaCourt"
                                        v-show="form.is_court_thana === 'Thana' || form.is_court_thana === 'Court'">
                                        <label for="name" class="form-label">@{{ form.is_court_thana }} Name</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                v-model="form.name">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="suspension_date" class="form-label">Suspension Date</label>
                                        <div class="form-group">
                                            <input type="date" name="suspension_date" class="form-control"
                                                v-model="form.suspension_date">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <div class="form-group">
                                            <input type="text" name="remarks" class="form-control"
                                                v-model="form.remarks">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="attoshat_amount" class="form-label">Attoshat Amount</label>
                                        <div class="form-group">
                                            <input type="text" name="attoshat_amount" class="form-control"
                                                v-model="form.attoshat_amount">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="amount_due" class="form-label">Amount Due</label>
                                        <div class="form-group">
                                            <input type="text" name="amount_due" class="form-control"
                                                v-model="form.amount_due">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="filling_date" class="form-label">Filling Date</label>
                                        <div class="form-group">
                                            <input type="date" name="filling_date" class="form-control"
                                                v-model="form.filling_date">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="advocate" class="form-label">Advocate Name</label>
                                        <div class="form-group">
                                            <input type="text" name="advocate" class="form-control"
                                                v-model="form.advocate">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="advocate_chamber" class="form-label">Advocate Chamber</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="advocate_chamber" v-model="form.advocate_chamber" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="advocate_phone" class="form-label">Advocate Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="advocate_phone" class="form-control"
                                                v-model="form.advocate_phone">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="dealing_employee" class="form-label">Dealing Employee Name</label>
                                        <div class="form-group">
                                            <input type="text" name="dealing_employee" class="form-control"
                                                v-model="form.dealing_employee">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="dealing_employee_phone" class="form-label">Dealing Employee
                                            Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="dealing_employee_phone" class="form-control"
                                                v-model="form.dealing_employee_phone">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <label for="dealing_employee_pin" class="form-label">Dealing Employee Pin</label>
                                        <div class="form-group">
                                            <input type="text" name="dealing_employee_pin" class="form-control"
                                                v-model="form.dealing_employee_pin">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <span class="card-title">Staff Court Case List</span>
                </div>
                <div class="card-body">
                    <div id="datatable-loader"
                        style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                        <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                    </div>
                    <table class="table table-hover table-bordered" id="puishmentList" style="width:100%;">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Reason</th>
                                <th>Suspension Date</th>
                                <th>Attoshat Amount</th>
                                <th>Amount Due</th>
                                <th>Filling Date</th>
                                <th>Advocate Name</th>
                                <th>Advocate Phone</th>
                                <th>Responsible Employee</th>
                                <th>Responsible Employee Phone</th>
                                <th>Responsible Employee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- Additional styling for Bootstrap (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script>
        $(document).on('change', '#action_type', function() {
            let action_id = $(this).val();
            if (action_id == 6) {
                $('.tentative').css('display', 'block');
                $('.extended').css('display', 'block');
            } else {
                $('.tentative').css('display', 'none');
                $('.extended').css('display', 'none');
            }
            if (action_id == 7) {
                $('.finance_type').css('display', 'block');
            } else {
                $('.finance_type').css('display', 'none');
            }
            if (action_id == 3) {
                $('.show_cause').css('display', 'block');
            } else {
                $('.show_cause').css('display', 'none');
            }
        })
        $(document).on('change', '#financial_puhishment_type', function() {
            let financial_puhishment_type = $(this).val();
            if (financial_puhishment_type == 1) {
                $('.fine_amount').css('display', 'block');
            } else {
                $('.fine_amount').css('display', 'none');
            }
        })
    </script>
    <script>
        {{-- `employee_id`, `reason`, `suspension_date`, `remarks`, `attoshat_amount`, `amount_due`, `filling_date`, `advocate`, `advocate_chamber`, `advocate_phone`, `dealing_employee`, `dealing_employee_phone`, `dealing_employee_pin`, `is_court_thana`, `name`, --}}
        document.addEventListener('DOMContentLoaded', function() {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    index: '',
                    create: false,
                    editCase: false,
                    pin_no: '',
                    search_result: '',
                    caseId: '',
                    form: {
                        employee_id: '',
                        employee_name: '',
                        reason: '',
                        suspension_date: '',
                        remarks: '',
                        attoshat_amount: '',
                        amount_due: '',
                        filling_date: '',
                        advocate: '',
                        advocate_chamber: '',
                        advocate_phone: '',
                        dealing_employee: '',
                        dealing_employee_phone: '',
                        dealing_employee_pin: '',
                        is_court_thana: '',
                        name: '',
                    },
                    no_search_result: false,
                    date: {
                        from_date: [],
                        to_date: [],
                        duration: [],
                    },

                },
                methods: {
                    get_punishment_list() {
                        axios.get('/all-punishment')
                            .then(res => {
                                // console.log(res.data);
                                this.actions = res.data;
                            })
                    },
                    get_finance_punishment_type() {
                        axios.get('/financial-punish-types')
                            .then(res => {
                                // console.log(res.data);
                                this.financial_punish_types = res.data;
                            })
                    },
                    deleteCase(form) {
                        Swal.fire({
                            title: `Are you sure you want to delete the case`,
                            text: "This action cannot be undone.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "Cancel",
                            dangerMode: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    },

                    get_specific_employee_punishments() {
                        axios.get('/a-employee-punishments', {
                                params: {
                                    employee_id: this.pin_no,
                                }
                            })
                            .then(res => {
                                this.tentativeDate = res.data.tentative_date;
                                this.extend_date = res.data.extend_date;
                                this.punishments = res.data.punishments;
                            })
                    },
                    edit(id) {
                        this.caseId = id;
                        axios.get(`/staff-case-edit/${id}`)
                            .then(response => {
                                console.log(response.data);
                                this.editCase = true;
                                this.form = response.data;
                            });
                    },
                    getEmployees() {
                        if (this.pin_no.length > 3) {
                            axios.get('/status-search', {
                                params: {
                                    pin_no: this.pin_no,
                                    status: 'case',
                                }
                            }).then((response) => {
                                this.search_result = response.data.employees
                                console.log(response.data.employees, 'log');
                            }).catch(function(error) {
                                console.log(error);
                            })
                        } else {
                            this.search_result = []
                            this.no_search_result = true
                        }
                    },
                    selectTheFirstFromSearchResult() {
                        this.selected_employees_id.push(this.search_result[0]['id'])
                    },
                    selectItem(name, id) {
                        this.create = true;
                        this.form.employee_name = name;
                        this.form.employee_id = id;
                    },
                    removeId(id) {
                        /* -------- all working solutions -------- */
                        this.selected_employees_id.pop(id);
                    },
                    getEmployeeInfo() {
                        axios.get('/get-employees-info', {
                            params: {
                                ids: this.selected_employees_id
                            }
                        }).then((response) => {
                            this.selected_employees_info = response.data.employeesInfo
                        })
                    },
                    select() {
                        // --------- auto colon in datepicker ---------
                        var time = document.getElementsByClassName(
                            'demoDate'); //Get all elements with class "time"
                        for (var i = 0; i < time.length; i++) { //Loop trough elements
                            time[i].addEventListener('keyup', function(e) {
                                ; //Add event listener to every element
                                var reg = /[0-9]/;
                                if (this.value.length == 2 && reg.test(this.value)) this.value =
                                    this.value + "-";
                                if (this.value.length == 5 && reg.test(this.value)) this.value =
                                    this.value + "-";
                            });
                        };
                        // ---------- auto colon in datepicker ---------
                    },
                    duration(from_date, to_date, duration, index) {
                        axios.get('{{ route('fetch-duration2') }}', {
                            params: {
                                from_date: from_date,
                                to_date: to_date,
                            }
                        }).then((response) => {
                            this.date.duration.push('');
                            this.date.duration[index] = response.data.output
                        }).catch((error) => {
                            console.log(error)
                        })
                    },
                },
                watch: {
                    selected_employees_id: function() {
                        this.getEmployeeInfo();
                    },
                },
                mounted: function() {
                    const self = this;
                    // Listen for clicks on delete buttons within the DataTable
                    $(document).on('click', '.delete-button', function() {
                        const form = $(this).closest('form');
                        self.deleteCase(form); // Call the Vue method with the ID
                    });

                    $(document).on('click', '.edit-button', function() {
                        const id = $(this).data('id');
                        self.edit(id); // Call the Vue method with the ID
                    });
                    this.select();
                    $('.demoSelect2').select2();
                    // this.get_punishment_list();
                },
                updated: function() {
                    this.select();
                    $('.demoSelect2').select2();
                },

            });
        });
        $(document).ready(function() {
            let table = $('#puishmentList').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('staff.case') }}',
                    data: function(d) {
                        d.filter = $('#filterDropdown').val();
                    },
                    beforeSend: function() {
                        $('#datatable-loader').show();
                    },
                    complete: function() {
                        $('#datatable-loader').hide();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "employee.name",
                        name: 'employee.name',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "reason",
                        name: 'reason',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "suspension_date",
                        name: 'suspension_date',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "attoshat_amount",
                        name: 'attoshat_amount',
                        render: function(data, type, row) {
                            return data !== null ? data : 'N/A';
                        }
                    },
                    {
                        data: "amount_due",
                        name: 'amount_due',
                        render: function(data, type, row) {
                            return data !== null ? data : 'N/A';
                        }
                    },
                    {
                        data: "filling_date",
                        name: 'filling_date',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "advocate",
                        name: 'advocate',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "advocate_phone",
                        name: 'advocate_phone',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "dealing_employee",
                        name: 'dealing_employee',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "dealing_employee_phone",
                        name: 'dealing_employee_phone',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "name",
                        name: 'name',
                        render: function(data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: "action",
                        name: 'action'
                    },
                ],

                "dom": '<"top"f>t<"bottom"lip>',
                "dom": '<"top"lfr>t<"bottom"ip>',
                "dom": '<"top"Blfr>t<"bottom"ip>',
                "dom": '<"top"Bfl>t<"bottom"ip>',
                responsive: true,
                buttons: [{
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],

            });
        })
    </script>
@endpush
