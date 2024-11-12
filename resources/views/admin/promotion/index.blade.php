@extends('layouts.app')
@section('title', 'Employee Transfer')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Employee Promotion</h1>
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
                                    <label class="col-form-label col-form-label-sm" for="pin_no">Employee PIN No. or Name</label>
                                    <input v-model="pin_no" @keyup="getEmployees" @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control"
                                        id="pin_no" type="text" autocomplete="off">
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;" v-if="search_result.length > 0">
                            <thead>
                                {{-- -pin, name, Designation, Joining date, Present salary, Grade, New Designation, New Grade, new Salary --}}
                                <tr>
                                    <th>Pin</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
                                    <th>Present Salary</th>
                                    <th>Grade</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{ row.pin_no }}</td>
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.designation.en_name }}</td>
                                    <td>@{{ row.join_date }}</td>
                                    <td>@{{ row.monthly_grade.basic_salary }}</td>
                                    <td>@{{ row.monthly_grade.grade_id }}</td>
                                    <td><button type="button" @click="selectItem(row.id, row.punishments)" class="btn btn-sm btn-success">Promotion</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>

                <div class="card" v-if="selected_employees_id.length > 0">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Promotion To:</span>
                    </div>
                    <div class="card-body">
                        {{-- , New Designation, New Grade, new Salary  --}}
                        <form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <div v-for="(row, index) in selected_employees_info.slice().reverse()" class="row">
                                    <input type="hidden" name="type" class="form-control input-sm" value="promotion">
                                    <input type="hidden" name="employee_id" class="form-control input-sm"
                                        v-bind:value="row.id">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">Region</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase regionSelect"
                                                name="region_id" required>
                                                <option value="" disabled selected hidden>Select Region
                                                </option>
                                                <option :value="item.id" v-for="(item, index) in divisions">
                                                    @{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">Zone</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase zone" name="zone_id"
                                                required>
                                                <option value="disabled selected hidden">Select Zone
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">Branch</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase branch" name="branch_id"
                                                required>
                                                <option value="" disabled selected hidden>Select Branch
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">New Department</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase"
                                                name="promoted_department" required>
                                                <option value="" disabled selected hidden>Select department
                                                </option>
                                                <option :value="item.id" v-for="(item, index) in departments">
                                                    @{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">New Designation</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase"
                                                name="promoted_designation" required>
                                                <option value="" disabled selected hidden>Select designation
                                                </option>
                                                <option :value="item.id" v-for="(item, index) in designations">
                                                    @{{ item.en_name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">New Grade</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase grade"
                                                name="promoted_grade" required>
                                                <option value="" disabled selected hidden>Select grade
                                                </option>
                                                <option :value="item.grade_id" v-for="(item, index) in grades">
                                                    @{{ item.grade_id }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">New Salary</label>
                                        <div class="form-group">
                                            <input type="text" id="basic_salary" name="basic_salary" value=""
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="from_date" class="form-label">Effective Date</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-sm" id="from_date" name="from_date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Promotion Lists</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-uppercase" id="latestPromotionList" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Pin</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
                                    <th>Present Salary</th>
                                    <th>Grade</th>
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
<script>
    // $(document).ready(function() {
        $(document).on('change', '.regionSelect', function() {
            let divsion_id = $(this).val();
            let url = "{{ route('fetch_districts', ':division_id') }}".replace(':division_id',
                divsion_id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    let opt =
                        '<option value="" disabled selected hidden>Select Zone</option>';
                    $('.zone').empty();
                    $.each(data, function(index, item) {
                        opt += `<option value="${item.id}">${item.name}
                                        </option>`;
                    });
                    $('.zone').append(opt);
                }
            })
        })

        $(document).on('change', '.zone', function() {
            // alert('ok');
            let district_id = $(this).val();
            let url = "{{ route('fetch_branch', ':district_id') }}".replace(':district_id',
                district_id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    let opt =
                        '<option value="" disabled selected hidden>Select Branch</option>';
                    $('.branch').empty();
                    $.each(data, function(index, item) {
                        opt += `<option value="${item.id}">${item.name}
                                        </option>`;
                    });
                    $('.branch').append(opt);
                }
            })
        })
    // });
</script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script>
        $(document).on('change', '.grade', function() {
            let grade_id = $(this).val();
            let url = "{{ route('get_grade_salary', ':grade_id') }}".replace(':grade_id', grade_id);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#basic_salary').val(data.basic_salary);
                }
            });
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    index: '',
                    pin_no: '',
                    search_result: [],
                    punishmentTypes: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting: [],
                    departments: [],
                    designations: [],
                    grades: [],
                    selected_division_id: '',
                    districts: [],
                    divisions: [],
                    no_search_result: false,
                    date: {
                        from_date: [],
                        to_date: [],
                        duration: [],
                    },
                    mesg: '',
                    punish_id: '',
                    punish_name: '',
                    punish_type: '',
                    text: '',
                    show_cause: '',
                },
                methods: {
                    get_basic_salary() {
                        alert('ok');
                    },
                    getEmployees() {
                        if (this.pin_no.length > 3) {
                            axios.get('/status-search', {
                                params: {
                                    pin_no: this.pin_no,
                                    status: 'promotion',
                                }
                            }).then((response) => {
                                // console.log(response.data.employees[0].monthly_grade);
                                this.search_result = response.data.employees
                                this.punishmentTypes = response.data.punishmentTypes
                            }).catch(function(error) {
                                console.log(error);
                            })
                        } else {
                            this.search_result = []
                            this.no_search_result = true
                        }
                    },
                    getDivision() {
                        axios.get('/fetch-divisions')
                            .then(res => {
                                this.divisions = res.data;
                            })
                    },
                    onOptionSelected() {
                        axios.get('/fetch-districts', {
                                params: {
                                    division_id: this.selected_division_id
                                }
                            })
                            .then(res => {
                                console.log(res.data);
                                this.districts = res.data;
                            })
                    },
                    getDesignation() {
                        axios.get('/get-designations')
                            .then(res => {
                                console.log(res.data);
                                this.designations = res.data;
                            })
                    },
                    getDepartment() {
                        axios.get('/get-departments')
                            .then(res => {
                                console.log(res.data);
                                this.departments = res.data;
                            })
                    },
                    getGrade() {
                        axios.get('/get-grade')
                            .then(res => {
                                console.log(res.data[0]);
                                this.grades = res.data;
                            })
                    },
                    selectTheFirstFromSearchResult() {
                        this.selected_employees_id.push(this.search_result[0]['id'])
                    },
                    selectItem(id, punishments = false) {
                        this.getDivision();
                        this.getDepartment();
                        this.getDesignation();
                        this.getGrade();

                        if (this.selected_employees_id.includes(id)) {
                            toastr.error('Already Selected.', {
                                closeButton: true,
                                progressBar: true,
                            });
                        } else {
                            // this.selected_employees_id.push(id);
                        }
 
                        if (Array.isArray(punishments) && punishments.length > 0) {
                            const lastObject = punishments.at(-1);
                            this.mesg = lastObject.name;
                            this.punish_id = lastObject.pivot.financial_punishment_type;
                            this.show_cause = lastObject.pivot.show_cause === 1 ? 'Show Letter: Yes' : 'Show Letter: No';
                            this.punish_type = this.punishmentTypes[this.punish_id];
                            this.txt = `
                                <h5 style="color:green">Punish Name: ${this.mesg}</h5>
                                <h6 style="color:red">Punish: ${this.punish_id === 0 ? this.show_cause : this.punish_type}</h6>
                                <p>Are you sure? You want to Confirm this employee!</p>
                            `;
                        } else {
                            this.txt = 'Are you sure? You want to Confirm this employee!';
                        }
                        
                        Swal.fire({
                            title: status,
                            html: this.txt,
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Confirm',
                            confirmButtonColor: '#3085d6',
                        }).then(response => {
                            if (response.isConfirmed) {
                                this.selected_employees_id.push(id);
                            }
                        })
                    },
                    removeId(id) {
                        /* -------- all working solutions -------- */
                        this.selected_employees_id.pop(id);
                        // this.$delete(this.selected_employees_id, index)
                        // this.selected_employees_id.splice(this.selected_employees_id.indexOf(row), 1);
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
                    this.getDivision();
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
            let table = $('#latestPromotionList').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('employee.latest.promotion.list') }}',
                    data: function(d) {
                        d.filter = $('#filterDropdown').val();
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
                        data: "en_name",
                        name: 'en_name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.en_name ? row.en_name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "join_date",
                        name: 'join_date',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.join_date ? row.join_date : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "basic_salary",
                        name: 'basic_salary',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.basic_salary ? row.basic_salary : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "grade_id",
                        name: 'grade_id',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.grade_id ? row.grade_id : 'N/A';  // or ''
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
