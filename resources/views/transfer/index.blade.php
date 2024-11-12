@extends('layouts.app')
@section('title', 'Employee Transfer')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Employee Transfer</h1>
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
                                {{-- Current branch, zone, region, Designation (1st line) --}}
                                <tr>
                                    <th>Name</th>
                                    <th>PIN</th>
                                    <th>Current Branch</th>
                                    <th>Zone</th>
                                    <th>Region</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.pin_no }}</td>
                                    <td>@{{ row.posting_station == null ? '' : row.posting_station.name }}</td>
                                    <td>@{{ row.posting_station == null ? '' : row.posting_station.district.name }}</td>
                                    <td>@{{ row.posting_station == null ? '' : row.posting_station.division.name }}</td>
                                    <td>@{{ row.department.name == null ? '' : row.department.name }}</td>
                                    <td>@{{ row.designation.en_name == null ? '' : row.designation.en_name }}</td>
                                    <td><button type="button" @click="selectItem(row.id)" class="btn btn-sm btn-success">Transfer</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>

                <div class="card" v-if="selected_employees_id.length > 0">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Transfer To:</span>
                    </div>
                    <div class="card-body">
                        {{-- Branch, Zone, Region, Designation, Effective Form  --}}
                        <form action="{{ route('posting-record.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <div v-for="(row, index) in selected_employees_info.slice().reverse()" class="row">
                                    <input type="hidden" name="employee_id" class="form-control input-sm"
                                        v-bind:value="row.id">
                                    <input type="hidden" name="type" class="form-control input-sm" value="transfer">
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
                                                <option value="" disabled selected hidden>Select Zone
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
                                        <label for="mobil_oil" class="form-label">Department</label>
                                        <div class="form-group">
                                            <select class="form-control text-uppercase select2" name="department_id" required>
                                                <option value="" disabled selected hidden>Select Department
                                                </option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">Designation</label>
                                        <div class="form-group">
                                            <select class="form-control text-uppercase select2" name="designation_id" required>
                                                <option value="" disabled selected hidden>Select Designation
                                                </option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->id }}">
                                                        {{ $designation->en_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">Effective From</label>
                                        <div class="form-group">
                                            <input type="date" name="effective_date" class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Latest Transfer History</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>PIN</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Region</th>
                                    <th>Designation</th>
                                    <th>Effective Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in posting_histories" :key="index">
                                    <td>@{{ item.employee != null ? item.employee.pin_no : '' }}</td>
                                    <td>@{{ item.employee != null ? item.employee.name : '' }}</td>
                                    <td>@{{ item.station != null ? item.station.name : '' }}</td>
                                    <td>@{{ item.station != null ? item.station.division.name : '' }}</td>
                                    <td>@{{ item.designation != null ? item.designation.en_name : '' }}</td>
                                    <td>@{{ item.from_date != null ? item.from_date : '' }}</td>
                                </tr>
                                <tr v-if="posting_histories.length === 0 && pin_no.length > 1">
                                    <td colspan="6">No result found</td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="totalPages > 1">
                            <button v-for="page in totalPages"
                                :style="currentPage === page ? 'background: black; padding: 10px;color:white;' :
                                    'background: gold; padding: 10px;color:white;'"
                                :key="page" @click="changePage(page)" :disabled="currentPage === page">
                                @{{ page }}
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <span class="card-title">Latest Transfer History List</span>
                </div>
                <div class="card-body">
                    <div id="datatable-loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                        <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                    </div>
                    <table class="table table-hover table-bordered text-uppercase" id="transferHistory">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>PIN</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Branch</th>
                                <th>Region</th>
                                <th>Designation</th>
                                <th>Effective Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
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
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    index: '',
                    pin_no: '',
                    search_result: [],
                    currentPage: 1, // Keep track of the current page
                    totalPages: 0,
                    posting_histories: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting: [],
                    divisions: [],
                    selected_division_id: '',
                    districts: [],

                    no_search_result: false,
                    date: {
                        from_date: [],
                        to_date: [],
                        duration: [],
                    }
                },
                methods: {
                    get_all_histories(page = 1) { // Accept page parameter, default to 1
                        axios.get(`/job-histories?page=${page}`)
                            .then(response => {
                                console.log(response.data);
                                this.posting_histories = response.data.data; // The paginated data
                                this.currentPage = response.data
                                    .current_page; // Update the current page
                                this.totalPages = response.data
                                    .last_page; // Update the total number of pages
                            });
                    },
                    changePage(page) {
                        this.get_all_histories(page); // Call get_all_histories with the selected page
                    },
                    getEmployees() {
                        if (this.pin_no.length > 1) {
                            axios.get('/search-employee', {
                                params: {
                                    pin_no: this.pin_no,
                                }
                            }).then((response) => {
                                console.log(response.data.employees[0], 'empl');
                                this.search_result = response.data.employees
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
                    selectTheFirstFromSearchResult() {
                        this.selected_employees_id.push(this.search_result[0]['id'])
                    },
                    selectItem(id) {
                        this.getDivision();
                        if (this.selected_employees_id.includes(id)) {
                            toastr.error('Already Selected.', {
                                closeButton: true,
                                progressBar: true,
                            });
                        } else {
                            this.selected_employees_id.push(id);
                        }
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
                    this.get_all_histories();
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
            let table = $('#transferHistory').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('job.histories.list') }}',
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
                        data: "employee.pin_no",
                        name: 'employee.pin_no',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.employee && row.employee.pin_no ? row.employee.pin_no : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "employee.name",
                        name: 'employee.name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.employee && row.employee.name ? row.employee.name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "department.name",
                        name: 'department.name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.department && row.department.name ? row.department.name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "station.name",
                        name: "station.name",
                    },
                    {
                        data: "station.division.name",
                        name: "station.division.name",
                        defaultContent: 'N/A',
                        render: function(data, type, row) {
                            return (row.station && row.station.division && row.station.division.name) 
                                ? row.station.division.name 
                                : 'N/A';
                        }
                    },
                    {
                        data: "designation.en_name",
                        name: 'designation.en_name',
                        defaultContent: ''
                    },
                    {
                        data: "from_date",
                        name: "from_date"
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
