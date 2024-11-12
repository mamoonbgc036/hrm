@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-custom">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>Employee Salary Details</strong>
                    </div>
                </div>

                <!-- Table -->
                <div id="DataTables_wrapper" class="dataTables_wrapper form-inline no-footer">
                    <div class="dt-buttons"><a class="dt-button buttons-print btn btn-danger btn-xs mr" tabindex="0"
                            aria-controls="DataTables"><span><i class="fa fa-print"> </i></span></a><a
                            class="dt-button buttons-print btn btn-success mr btn-xs" tabindex="0"
                            aria-controls="DataTables"><span><i class="fa fa-print"> </i> &nbsp;selected</span></a><a
                            class="dt-button buttons-excel buttons-html5 btn btn-purple mr btn-xs" tabindex="0"
                            aria-controls="DataTables"><span><i class="fa fa-file-excel-o"> </i></span></a><a
                            class="dt-button buttons-csv buttons-html5 btn btn-primary mr btn-xs" tabindex="0"
                            aria-controls="DataTables"><span><i class="fa fa-file-excel-o"> </i></span></a><a
                            class="dt-button buttons-pdf buttons-html5 btn btn-info mr btn-xs" tabindex="0"
                            aria-controls="DataTables"><span><i class="fa fa-file-pdf-o"> </i></span></a><a
                            class="dt-button btn btn-xs btn-default custom-bulk-button" tabindex="0"
                            aria-controls="DataTables"><span>Bulk Delete</span></a></div>
                    <div id="DataTables_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                    <table class="table table-striped DataTables  dataTable no-footer dtr-inline" id="DataTables"
                        cellspacing="0" width="100%" role="grid" aria-describedby="DataTables_info"
                        style="width: 100%;">
                        <thead id="">
                            <tr role="row">
                                <th class="col-sm-1 sorting" tabindex="0" aria-controls="DataTables" rowspan="1"
                                    colspan="1" style="width: 122px;"
                                    aria-label="EMP ID: activate to sort column ascending">EMP ID</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1"
                                    style="width: 351px;" aria-label="Name: activate to sort column ascending">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1"
                                    style="width: 369px;" aria-label="Salary Type: activate to sort column ascending">
                                    Salary
                                    Type</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1"
                                    style="width: 347px;" aria-label="Basic Salary: activate to sort column ascending">
                                    Basic
                                    Salary</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1"
                                    style="width: 388px;"
                                    aria-label="Overtime                    (Per Hour)
: activate to sort column ascending">
                                    Overtime <small>(Per Hour)</small>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1"
                                    style="width: 388px;"
                                    aria-label="Overtime                    (Per Hour)
: activate to sort column ascending">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($employees as $item)
                                <tr id="table_0" role="row" class="odd">
                                    <td tabindex="0">{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td> <small>{{ $item->gradeType->name }}</small></td>
                                    <td>$
                                        {{ @$item->monthly_grade ? @$item->monthly_grade->basic_salary : @$item->hourGrade->basic_salary }}
                                        <small></small>
                                    </td>
                                    <td>{{ @$item->monthly_grade->overtime_salary }}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content print" style="width: 120%">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Employee Salary Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="getPrint()"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-printer-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                                <path
                                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            </svg></span>
                    </button>
                    <a class="link px-2 mx-2" href="" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z" />
                            <path fill-rule="evenodd"
                                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103" />
                        </svg></a>
                </div>
                <div class="modal-body">
                    <h4 class="text-center" id="name"></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" alt="">
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <th>Emp Id :</th>
                                    <td id="emp_id"></td>
                                </tr>
                                <tr>
                                    <th>Department :</th>
                                    <td id="department"></td>
                                </tr>
                                <tr>
                                    <th>Designation :</th>
                                    <td id="designation"></td>
                                </tr>
                                <tr>
                                    <th>Joining Date :</th>
                                    <td id="joining"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div>
                        <div class="border border-dark p-2 m-2">
                            <h4>Salary Details</h4>
                            <hr>
                            <table>
                                <tr>
                                    <th>Salary Grade :</th>
                                    <td id="grade"></td>
                                </tr>
                                <tr>
                                    <th>Basic Salary :</th>
                                    <td id="salary"></td>
                                </tr>
                                <tr>
                                    <th>Over Time :</th>
                                    <td id="overtime"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="row border border-dark p-2 m-2">
                            <div class="col-md-6">
                                <h5>Allowance</h5>
                                <hr>
                                <table class="allowance">

                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Deductions</h5>
                                <hr>
                                <table class="deduction">

                                </table>
                            </div>
                        </div>
                        <div class="border border-dark p-2 m-2">
                            <h5>Total Salary Details</h5>
                            <hr>
                            <table class="salary_details">
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function getPrint() {
            let original = document.body.innerHTML;
            let content = document.querySelector('.print').innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = original;
            $('.modal-backdrop').remove();
            $('#exampleModalLong').modal('hide').modal('show');
        }
        $(document).on('click', '.show_payroll', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = '{{ route('employee-payrol-search', ':id') }}';
            url = url.replace(':id', id);
            $('.link').attr('href', url);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response, 'test');
                    $('#name').text(response.name);
                    $('#emp_id').text(response.employee_id);
                    $('#department').text(response.department_name);
                    $('#designation').text(response.designation_name);
                    $('#joining').text(response.joining_date);
                    $('#grade').text(response.grade_name);
                    $('#salary').text(response.basic_salary);
                    $('#overtime').text(response.over_time);
                    let allowance = '';
                    let t_allowance = 0;
                    let deduction = '';
                    let t_deduction = 0;
                    if (Array.isArray(response.allowence)) {
                        response.allowence.forEach(function(item, index) {
                            allowance += `<tr>
                                        <th>${item.allowance_label} :</th>
                                        <td id="h_rent">${item.allowance_value}</td>
                                    </tr>`;
                            t_allowance += parseInt(item.allowance_value);
                        });
                    } else {
                        allowance += `<tr>
        <td colspan="5" style="text-align: center;">There is no allowance</td>
    </tr>`
                    }

                    $('.allowance tr').remove();
                    $('.allowance').append(allowance);

                    if (Array.isArray(response.deduction)) {
                        response.deduction.forEach(function(item, index) {
                            deduction += `<tr>
                                        <th>${item.deduction_label} :</th>
                                        <td id="h_rent">${item.deduction_value}</td>
                                    </tr>`;
                            t_deduction += parseInt(item.deduction_value);
                        })
                    } else {
                        deduction += `<tr>
        <td colspan="5" style="text-align: center;">There is no deduction</td>
    </tr>`
                    }
                    $('.deduction tr').remove();
                    $('.deduction').append(deduction);
                    let g_salary = parseInt(response.basic_salary) + t_allowance;
                    let n_salary = g_salary - t_deduction;
                    $('.salary_details tr').remove();
                    $('.salary_details').append(`
                         <tr>
                                    <th>Gross Salary :</th>
                                    <td>${g_salary}</td>
                                </tr>
                                <tr>
                                    <th>Total Deduction :</th>
                                    <td>${t_deduction}</td>
                                </tr>
                                <tr>
                                    <th>Net Salary :</th>
                                    <td>${n_salary}</td>
                                </tr>
                    `);
                }
            })
        })
        $(document).on('click', '.employee_delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = "{{ route('employee.delete', ':id') }}";
            url = url.replace(':id', id);
            Swal.fire({
                title: "Are you sure?",
                text: "The action can't be undone",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, Delete it!",
                confirmButtonColor: '#3085d6'
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(respones) {
                            Swal.fire('Deleted!', 'Employee has been deleted', 'success');
                            $('.dataTable').DataTable().ajax.reload();
                        }
                    });
                }
            })
        })
        $(document).ready(function() {

            $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('payroll.salary-list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'gradeTypeName',
                        name: 'gradeTypeName'
                    },
                    {
                        data: 'honorarium',
                        name: 'honorarium'
                    },
                    {
                        data: 'overtime_salary',
                        name: 'overtime_salary'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            })
            $('#login_back').change(function() {
                $('#login_bk_display').css('visibility', 'visible');
                const file = $(this)[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#login_bk_display').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#company_logo').change(function() {
                $('#company_logo_display').css('visibility', 'visible');
                const file = $(this)[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#company_logo_display').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#login_bk_small').change(function() {
                $('#login_bk_small_display').css('visibility', 'visible');
                const file = $(this)[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#login_bk_small_display').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
