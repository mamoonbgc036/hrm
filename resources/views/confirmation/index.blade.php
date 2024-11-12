@extends('layouts.app')
@section('title', 'Employee Confirmation')
@section('content')
    <div class="app-title">
        <div>
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    style="color: green; margin-right: 5px" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                </svg>Confirmation</h1>
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
                                    <label class="col-form-label col-form-label-sm" for="pin_no">Employee PIN No. Or
                                        Name</label>
                                    <input v-model="pin_no" @keyup="getEmployees" @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control" id="pin_no" type="text" autocomplete="off">
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-bordered text-uppercase" id="" style="width:100%;"
                            v-if="search_result.length > 0">
                            <thead>
                                <tr>
                                    {{-- -Pin, name, ,grade, designation,joining date,Tentitive date,Confirmation Up to Extend
                                    period, Actual Confirmation Date --}}
                                    <th>Pin</th>
                                    <th>Name</th>
                                    <th>Grade</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
                                    <th>Tentative Confirmation Date</th>
                                    <th>Extend Period</th>
                                    <th>Actual Confirmation Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{ row.pin_no }}</td>
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.monthly_grade != null ? row.monthly_grade.grade_id : '' }}</td>
                                    <td>@{{ row.designation != null ? row.designation.en_name : '' }}</td>
                                    <td>@{{ row.join_date }}</td>
                                    <td>@{{ row.tentative_confirmation_date }}</td>
                                    <td>@{{ row.extend_date != null ? row.extend_date : '' }}</td>
                                    <td class="actualConfirmationDate">@{{ row.actual_confirmation_date != null ? row.actual_confirmation_date : row.tentative_confirmation_date }}</td>
                                    <td><button type="button" @click="selectItem(row.id, row.is_confirmed, row.punishments)"
                                            class="btn btn-sm btn-success">@{{ row.is_confirmed != 'yes' ? 'Confirm' : 'Unconfirm' }}</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Confirmed Employee List</span>
                    </div>
                    <div class="card-body">
                        <div id="datatable-loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                            <img src="{{ asset('loader.gif') }}" alt="Loading..." />
                        </div>
                        <table class="table table-hover table-bordered text-uppercase" id="confirmationList" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>PIN</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Region</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
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
        $(document).ready(function() {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    index: '',
                    pin_no: '',
                    search_result: [],
                    punishmentTypes: [],
                    confirmed_employees: [],
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting: [],
                    confirmToggle: true,
                    confirmed_employees: [],
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
                    getEmployees() {
                        if (this.pin_no.length > 1) {
                            axios.get('/status-search', {
                                params: {
                                    pin_no: this.pin_no,
                                    status: 'confirmation'
                                }
                            }).then((response) => {
                                console.log(response.data['employees'][0],
                                    'test')
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
                    confirmed_employee_list() {
                        axios.get('/all-confirmed-employees')
                            .then(response => {
                                console.log(response.data.data);
                                this.confirmed_employees = response.data.data;
                            })
                    },
                    selectTheFirstFromSearchResult() {
                        this.selected_employees_id.push(this.search_result[0]['id'])
                    },
                    selectItem(id, confirm, punishments = false) {
                        // const data = JSON.stringify(punishments, null, 2);
                        let status = confirm != 'yes' ? 'Confirm' : 'Unconfirm';
                        if (Array.isArray(punishments) && punishments.length > 0) {
                            const lastObject = punishments.at(-1);
                            this.mesg = lastObject.name;
                            this.punish_id = lastObject.pivot.financial_punishment_type;
                            this.punish_type = this.punishmentTypes[this.punish_id];
                            this.show_cause = lastObject.pivot.show_cause === 1 ? 'Show Letter: Yes' : 'Show Letter: No';
                            this.txt = `
                                <h5 style="color:green">Punish Name: ${this.mesg}</h5>
                                <h6 style="color:red">Punish: ${this.punish_id === 0 ? this.show_cause : this.punish_type}</h6>
                                <p>Are you sure? You want to ${status} this employee!</p>
                            `;
                        } else {
                            this.txt = 'Are you sure? You want to ' + status + ' this employee!';
                        }
                        
                        Swal.fire({
                            title: status,
                            text: this.txt,
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Confirm',
                            confirmButtonColor: '#3085d6',
                        }).then(response => {
                            if (response.isConfirmed) {
                                axios.get(`/status-change`, {
                                        params: {
                                            id: id,
                                            status: 'confirmation'
                                        }
                                    }, {
                                        headers: {
                                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                        }
                                    })
                                    .then(response => {
                                        let text = response.data.actual_confirmation_date !='' ? response.data.actual_confirmation_date : response.data.confirmation_date
                                        $('.actualConfirmationDate').text(text);
                                        if (response.data.success != 'confirmed') {
                                            Swal.fire(
                                                'Unconfirmed',
                                                'The employee unconfirmed successfully',
                                                'success'
                                            )
                                        } else {
                                            Swal.fire(
                                                'Confirmed',
                                                'The employee confirmed successfully',
                                                'success'
                                            )
                                        }
                                        $('#confirmationList').DataTable().ajax.reload(null, false);
                                        this.getEmployees()
                                    })
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
                    this.confirmed_employee_list();
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
            let table = $('#confirmationList').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('confirmed_employees_list') }}',
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
                        data: "posting_station.name",
                        name: 'posting_station.name',
                        defaultContent: '',
                        render: function(data, type, row) {
                            return row.posting_station && row.posting_station.name ? row.posting_station.name : 'N/A';  // or ''
                        }
                    },
                    {
                        data: "posting_station.division.name",
                        name: "posting_station.division.name",
                    },
                    {
                        data: "designation.en_name",
                        name: 'designation.en_name',
                        defaultContent: ''
                    },
                    {
                        data: "join_date",
                        name: "join_date"
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
