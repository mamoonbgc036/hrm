@extends('layouts.app')
@section('title', 'Redesignation')
@section('content')

    <div class="app-title">
        <div>
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    style="color: green; margin-right: 5px" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                </svg>Redesignation</h1>
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
                                    <input v-model="pin_no" @keyup="getEmployees"
                                        @keypress.enter.prevent="selectTheFirstFromSearchResult" class="form-control"
                                        id="pin_no" type="text" autocomplete="off">
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-bordered text-uppercase"
                            :style="{ display: search_result.length > 0 ? 'table' : 'none', width: '100%' }"
                            style="display: none; width:100%">
                            <thead>
                                <tr>
                                    {{-- Pin,name, Presnt Designation, New Designation  --}}
                                    <th>Pin</th>
                                    <th>Name</th>
                                    <th>Present Designation</th>
                                    <th>New Designation</th>
                                    {{-- <th>Salary Increment</th>
                                    <th>Effective Date</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in search_result">
                                    <td>@{{ row.pin_no }}</td>
                                    <td>@{{ row.name }}</td>
                                    <td>@{{ row.designation.en_name }}</td>
                                    <td>
                                        <select name="redesignation_id" v-model="row.redesignation_id" id=""
                                            class="form-control">
                                            <option value="">Select new designation</option>
                                            <option v-for="(item, index) in designations" :key="index"
                                                :value="item.id">
                                                @{{ item.en_name }}</option>
                                        </select>
                                    </td>
                                    {{-- <td>
                                        <div class="col-12 row">
                                            <div class="col-md-6">
                                                <select name="" class="form-control" id="sal_temp_deduct_cat">
                                                    <option value="">Select an Option</option>
                                                    <option value="percent">Percent</option>
                                                    <option value="fixed">Fixed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="input-pad deduct-input" name="deduct[]"
                                                    required>
                                            </div>
                                        </div>
                                    </td> --}}
                                    {{-- <td>
                                        <input class="form-control" type="date" name="" id="">
                                    </td> --}}
                                    <td>
                                        <button type="button" @click="change(row.id, row.name, row.redesignation_id)"
                                            class="btn btn-sm btn-success">Change</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span v-if="search_result.length == 0 && pin_no.length > 1">No result found</span>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Redesignation Employee Lists</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-uppercase" id="redesignationLists">
                            <thead>
                                <tr>
                                    {{-- Pin,name, Presnt Designation, New Designation  --}}
                                    <th>SL.</th>
                                    <th>Pin NO.</th>
                                    <th>Name</th>
                                    <th>Present Designation</th>
                                    <th>New Designation</th>
                                    <th>Join Date</th>
                                    <th>Basic Salary</th>
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
                    selected_employees_id: [],
                    selected_employees_info: [],
                    posting: [],
                    designations: [],
                    redesignation_id: '',

                    no_search_result: false,
                    date: {
                        from_date: [],
                        to_date: [],
                        duration: [],
                    }
                },
                methods: {
                    getEmployees() {
                        if (this.pin_no.length > 3) {
                            axios.get('/status-search', {
                                params: {
                                    pin_no: this.pin_no,
                                    status: 'redesignation',
                                }
                            }).then((response) => {
                                console.log(response.data);
                                this.search_result = response.data.employees
                                this.designations = response.data.designations
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
                    change(id, name, redesignation) {

                        let txt = 'Are you sure? You want to change ' + name +
                            ' designation!';
                        Swal.fire({
                            title: 'Redesignation',
                            text: txt,
                            icon: 'question',
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Confirm',
                            confirmButtonColor: '#3085d6',
                        }).then(response => {
                            if (response.isConfirmed) {
                                axios.get(`status-change`, {
                                        params: {
                                            id: id,
                                            status: 'redesignation',
                                            redesignation_id: redesignation
                                        }
                                    }, {
                                        headers: {
                                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                        }
                                    })
                                    .then(response => {
                                        if (response.data.success == true) {
                                            Swal.fire(
                                                'Confirmed',
                                                '' + name +
                                                ' designation changed successfully',
                                                'success'
                                            )
                                        }
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
            let table = $('#redesignationLists').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ route('redesignation.lists') }}',
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
