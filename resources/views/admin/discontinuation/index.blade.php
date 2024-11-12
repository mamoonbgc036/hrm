@extends('layouts.app')
@section('title', 'Employee Discontinuation')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Employee Discontinuation</h1>
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
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="col-form-label col-form-label-sm" for="pin_no">Employee PIN No. or Name</label>
                                    <input v-model="pin_no" @keyup="getEmployees" @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control"
                                        id="pin_no" type="text" autocomplete="off">
                                </div>
                            </div>
                            <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;"
                                v-if="search_result.length > 0">
                                <thead>
                                    {{-- pin, name, designation, Grade, Discontinuation, --}}
                                    <tr>
                                        <th>Pin</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Grade</th>
                                        <th>Termination Type</th>
                                        <th>Effective Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, index) in search_result">
                                        <td>@{{ row.pin_no }}</td>
                                        <td>@{{ row.name }}</td>
                                        <td>@{{ row.designation.en_name }}</td>
                                        <td>@{{ row.monthly_grade ? row.monthly_grade.grade_id : null }}</td>
                                        <td>
                                            <select v-model="type" id="" class="form-control"
                                                name="termination_type">
                                                <option value="">Select a Type</option>
                                                <option :value="item.name" v-for="(item, index) in terminations">
                                                    @{{ item.name }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" v-model="effective_date" name="effective_date" class="form-control effective_date" id="" value="effective_date">
                                        </td>
                                        <td><button type="button" @click="selectItem(row.id)" class="btn btn-sm btn-success">Confirmed</button></td>
                                    </tr>
                                </tbody>
                            </table>    
                        </form>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>
                {{-- <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Employee Discontinuation Lists</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;"
                            v-if="discontinuations.length > 0">
                            <thead>
                                <tr>
                                    <th>Pin</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Grade</th>
                                    <th>Discontinuation Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in discontinuations">
                                    <td>@{{ row.pin_no }}</td>
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.designation.en_name }}</td>
                                    <td>@{{ row.monthly_grade.grade_id }}</td>
                                    <td>
                                        @{{ row.employee_out == null ? '' : row.employee_out.type }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div> --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Employee Discontinuation Lists</span>
                    </div>
                    <div class="card-body">
                        <div id="datatable-loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                            <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                        </div>
                        <table class="table table-hover table-bordered text-uppercase" id="discontinuationEmployeeList" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Pin</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Grade</th>
                                    <th>Discontinuation Type</th>
                                    <th>Effective Date</th>
                                </tr>
                            </thead>
                        </table>
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
        $(document).on('change', '#action_type', function() {
            let action_id = $(this).val();
            if (action_id == 2 || action_id == 6) {
                $('.month').css('display', 'block');
            } else {
                $('.month').css('display', 'none');
            }
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const routes = {
                employeeOutConfirmed: @json(route('employee.out.confirmed'))
            };
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    index: '',
                    pin_no: '',
                    search_result: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting: [],
                    type: '',
                    effective_date: '',
                    designations: [],
                    terminations: [],
                    discontinuations: [],
                    selected_division_id: '',
                    actions: [],
                    punishments: [],

                    no_search_result: false,
                    date: {
                        from_date: [],
                        to_date: [],
                        duration: [],
                    },
                    // formData: {
                    //     pin_no: '',
                    //     type: ''
                    // },
                    // submittedData: null
                },
                methods: {
                    // submitForm() {
                    //     axios.post(routes.employeeOutConfirmed, {
                    //         pin_no: this.formData.pin_no,
                    //         status: 'promotion'
                    //     })
                    //     .then(response => {
                    //         console.log('Data submitted successfully:', response.data);
                    //     })
                    //     .catch(error => {
                    //         console.error('There was an error!', error);
                    //     });
                    // },
                    get_termination_list() {
                        axios.get('/all-terminations')
                            .then(res => {
                                console.log(res.data);
                                this.terminations = res.data;
                            })
                    },

                    get_all_discontinued_employee() {
                        axios.get('/employee-out')
                            .then(res => {
                                console.log(res.data);
                                this.discontinuations = res.data.data;
                            });
                    },

                    get_specific_employee_punishments() {
                        axios.get('/a-employee-punishments', {
                                params: {
                                    employee_id: this.pin_no,
                                }
                            })
                            .then(res => {
                                this.punishments = res.data.punishments;
                            })
                    },
                    getEmployees() {
                        if (this.pin_no.length > 3) {
                            this.get_termination_list();
                            this.get_specific_employee_punishments();
                            axios.get('/status-search', {
                                params: {
                                    pin_no: this.pin_no,
                                    status: 'promotion',
                                }
                            }).then((response) => {
                                this.search_result = response.data.employees
                                console.log(this.search_result, 'change');
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
                    selectItem(id) {
                        axios.post('/employee-out-confirmed', {
                                params: {
                                    type: this.type,
                                    id: id,
                                    effective_date: this.effective_date
                                }
                            })
                            .then(response => {
                                this.get_all_discontinued_employee();
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Employee status updated successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                                $('#discontinuationEmployeeList').DataTable().ajax.reload(null, false);
                            })
                            .catch(error => {
                            // Optionally handle the error and display an error message
                            console.error('There was an error!', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to update employee status.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                            
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
                    this.get_all_discontinued_employee();
                    this.select();
                    $('.demoSelect2').select2();
                },
                updated: function() {
                    this.select();
                    $('.demoSelect2').select2();
                },

            });
        });

        $(document).ready(function(){
            let table = $('#discontinuationEmployeeList').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('employee.discontinuation.list') }}',
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
                columns: [
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "pin_no",
                        name: 'pin_no',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.pin_no ? row.pin_no : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "name",
                        name: 'name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.name ? row.name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "designation.en_name",
                        name: 'designation.en_name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.designation && row.designation.en_name ? row.designation.en_name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "monthly_grade.grade_id",
                        name: 'monthly_grade.grade_id',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.monthly_grade && row.monthly_grade.grade_id ? row.monthly_grade.grade_id : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "employee_out.type",
                        name: "employee_out.type",
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.employee_out && row.employee_out.type ? row.employee_out.type : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "employee_out.effective_date",
                        name: "employee_out.effective_date",
                        defaultContent: '',
                        render: function(data, effective_date, row) {
                            return row.employee_out && row.employee_out.effective_date ? row.employee_out.effective_date : 'N/A';  // or ''
                        }
                    },
                    
                ],
                "dom": '<"top"f>t<"bottom"lip>',
                "dom": '<"top"lfr>t<"bottom"ip>',
                "dom": '<"top"Blfr>t<"bottom"ip>',
                "dom": '<"top"Bfl>t<"bottom"ip>',
                responsive: true,
                buttons: [
                    {
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
