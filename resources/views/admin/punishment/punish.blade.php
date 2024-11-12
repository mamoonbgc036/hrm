@extends('layouts.app')
@section('title', 'Employee Punishment')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Employee Punishments</h1>
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
                                    <th>Disciplinary Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.designation.en_name }}</td>
                                    <td><button type="button" @click="selectItem(row.id)"
                                            class="btn btn-sm btn-success">Punished</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>
                <div class="card" v-if="selected_employees_id.length > 0">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Punishment Action:</span>
                    </div>
                    <div class="card-body">
                        {{-- , name, Designation, Disciplinary Action  --}}
                        <form action="{{ route('punishment.insert') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <div v-for="(row, index) in selected_employees_info.slice().reverse()" class="row">
                                    <input type="hidden" name="employee_id" class="form-control input-sm" v-bind:value="row.id">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="mobil_oil" class="form-label">Action Type</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2 text-uppercase" name="action_type" id="action_type" required>
                                                <option value="" disabled selected hidden>Select Action</option>
                                                <option :value="item.id" v-for="(item, index) in actions">@{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 tentative" style="display: none">
                                        <label for="tentative_date" class="form-label">Tentative Date</label>
                                        <div class="form-group">
                                            <input type="date" name="tentative_date" class="form-control tentative_date"  v-model="tentativeDate">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 extended" style="display: none">
                                        <label for="extend_date" class="form-label">Extended Date</label>
                                        <div class="form-group">
                                            <input type="date" name="extend_date" class="form-control extend_date"  v-model="extend_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="effective_date" class="form-label">Effective Date</label>
                                        <div class="form-group">
                                            <input type="date" name="effective_date" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 show_cause" style="display: none;">
                                        <div class="form-group mt-4">
                                            <label>
                                                <input type="checkbox" id="myCheckbox" name="show_cause" value="1">
                                                Show cause letter received ?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 finance_type" style="display: none;">
                                        <label for="financial_puhishment_type" class="form-label">Financial Punishment Type</label>
                                        <div class="form-group">
                                            <select class="form-control demoSelect2" name="financial_puhishment_type" id="financial_puhishment_type" style="width:250px">
                                                <option value="" disabled selected hidden>Select Type</option>
                                                <option :value="index" v-for="(item, index) in financial_punish_types">
                                                    @{{ item }}</option>
                                            </select>`
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 fine_amount" style="display: none;">
                                        <label for="fine_amount" class="form-label">Fine Amount</label>
                                        <div class="form-group">
                                            <input type="number" id="fine_amount" name="fine_amount" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="reasons" class="form-label">Reasons</label>
                                        <div class="form-group">
                                            <Textarea class="form-control" name="action_reason" rows="2" cols="2"></Textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <span class="card-title">Punishment List</span>
                </div>
                <div class="card-body">
                    <div id="datatable-loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                        <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                    </div>
                    <table class="table table-hover table-bordered" id="puishmentList" style="width:100%;">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Pin NO.</th>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Description</th>
                                <th>Punishment Active Date</th>
                                <th>Punishment Name</th>
                                <th>Offence</th>
                                <th>Show Cause</th>
                                <th>Financial Punishment Type</th>
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
        $(document).on('change','#financial_puhishment_type', function() {
            let financial_puhishment_type = $(this).val();
            if (financial_puhishment_type == 1) {
                $('.fine_amount').css('display', 'block');
            } else {
                $('.fine_amount').css('display', 'none');
            }
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
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting: [],
                    designations: [],
                    grades: [],
                    selected_division_id: '',
                    actions: [],
                    financial_punish_types: [],
                    punishments: [],
                    tentativeDate: '',
                    extend_date: '',

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
                    getEmployees() {
                        if (this.pin_no.length > 3) {
                            this.get_specific_employee_punishments();
                            axios.get('/status-search', {
                                params: {
                                    pin_no: this.pin_no,
                                    status: 'promotion',
                                }
                            }).then((response) => {
                                console.log(response.data.employees[0].monthly_grade);
                                this.search_result = response.data.employees
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
                        this.get_punishment_list();
                        this.get_finance_punishment_type();
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
        $(document).ready(function(){
            let table = $('#puishmentList').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('all.punishments.list') }}',
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
                        data: "duration",
                        name: 'duration',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.duration ? row.duration : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "description",
                        name: 'description',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.description ? row.description : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "date",
                        name: 'date',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.date ? row.date : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "punishment_title",
                        name: 'punishment_title',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.punishment_title ? row.punishment_title : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "offence",
                        name: 'offence',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.offence ? row.offence : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "show_cause",
                        name: 'show_cause',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.show_cause ? row.show_cause : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "financial_punishment_type",
                        name: 'financial_punishment_type',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row && row.financial_punishment_type ? row.financial_punishment_type : 'N/A';  // or ''
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
