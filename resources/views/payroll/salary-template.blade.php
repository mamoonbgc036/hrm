@extends('layouts.app')
@section('title', 'Brand Setting')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12">
                        <button id="salaryTemp" class="btn btn-md btn-info" onclick="salaryTemp()">Salary Template
                            List</button> <button id="setTemp" class="btn btn-md btn-info" onclick="setSalaryTemp()">Set
                            Salary Template</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12" id="fortemp"
                            style="{{ @$turn ? 'padding-top:1rem; overflow:auto;' : 'display: none;' }}">
                            <table class="table-full" id="dtable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Salary Grades</th>
                                        <th>Basic Salary</th>
                                        <th>Overtime <small>(Per Hour)</small></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($template != null)
                                        @foreach ($template as $tem)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    {{ $tem->grade_id }}

                                                </td>
                                                <td>{{ $tem->basic_salary }}
                                                </td>

                                                <td>{{ $tem->overtime_salary }}</td>
                                                <td>
                                                    <a href="{{ route('salary_temp.edit', $tem->id) }}" class="btn btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('salary_temp.delete', $tem->id) }}"
                                                        class="btn btn-sm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" fill="currentColor"
                                                                class="bi bi-trash3" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                            </svg></button>
                                                    </form>
                                                </td>
                                            </tr>

                                            @php
                                                $i = $i + 1;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12" id="settemp" style="{{ true ? 'display: block;' : 'display: none;' }}">
                            <form action="{{ route('salary_temp.set') }}" method="post">
                                @csrf
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-8 "
                                        style="background-color: rgb(8, 135, 118);color:rgb(231, 237, 235);padding:0.25rem;border-radius:4px;">
                                        <h5 class="text-center" style="margin-bottom:0;">Set Salary Template</h5>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-8 p-4 ">
                                        {{-- <form action="" method="post"> --}}
                                        <div class="row my-2">
                                            <div class="col-4 d-flex justify-content-end">
                                                <label for="" class="input-label">Salary Grades<sup
                                                        style="color: red;">*</sup>

                                                </label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" placeholder="ex: g-12"
                                                    name="grade_id" title="Please enter a valid grade in the format g-12"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4 d-flex justify-content-end">
                                                <label for="" class="input-label">Basic Salary <sup
                                                        style="color: red;">*</sup>

                                                </label>
                                            </div>
                                            <div class="col-8">
                                                <input type="number" name="basic_salary" class="input-pad " id="salary"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4 d-flex justify-content-end">
                                                <label for="" class="input-label">Overtime Rate <small>( Per
                                                        Hour)</small></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="overtime_salary" id=""
                                                    class="input-pad " required>
                                            </div>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                                {{-- allowances and deduction --}}
                                <div class="row d-flex justify-content-around ">
                                    <div class="col-md-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-12"
                                                        style="background-color: rgb(8, 135, 118);color:rgb(231, 237, 235);padding:0.25rem;border-radius:4px;">
                                                        <h6 class="text-center" style="margin-bottom:0;">Salary Allowance
                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 py-2 d-flex justify-content-end">
                                                        <button type="button" id="add-field-btn"
                                                            class="btn btn-md btn-info">Add
                                                            Another Field</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-2" id="input-container">
                                                    <div class="col-12 mb-1">
                                                        <label for="" class="mb-0 d-block">Allowance
                                                            Name</label>
                                                        <input type="text" name="allowance_name[]" id=""
                                                            class="input-pad" value="" required>
                                                    </div>
                                                    <div class="col-12"><label for=""
                                                            class="mb-0 d-block">Percentage</label></div>
                                                    <div class="col-10 row">
                                                        <div class="col-md-4">
                                                            <select name="allowance_type[]" class="form-control"
                                                                id="sal_temp_allow_cat">
                                                                <option value="percent">Percent</option>
                                                                <option value="fixed">Fixed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" class="input-pad allowance-input"
                                                                name="allowance[]" required>
                                                        </div>
                                                        <div class="col-md-4 allow_field"></div>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-end  align-items-center">
                                                        <button type="button"
                                                            class="remove-field-btn btn btn-md btn-danger "
                                                            style="border:none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="">Total Allowance: </label>

                                                    </div>
                                                    <div class="col-6">
                                                        <p class="allowance-display"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- deduction --}}
                                    <div class="col-md-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-12"
                                                        style="background-color: rgb(8, 135, 118);color:rgb(231, 237, 235);padding:0.25rem;border-radius:4px;">
                                                        <h6 class="text-center" style="margin-bottom:0;">Salary Deduction
                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 py-2 d-flex justify-content-end">
                                                        <button type="button" id="add-field-btn1"
                                                            class="btn btn-md btn-info">Add
                                                            Another Field</button>
                                                    </div>
                                                </div>
                                                {{-- <div class="row mt-2 " id="input-container1">
                                                    <div class="col-12 mb-1">
                                                        <label for="" class="mb-0 d-block">Deduction Name</label>
                                                        <input type="text" name="deduction_name[]" id=""
                                                            class="input-pad deduct-name" value="" required>
                                                    </div>
                                                    <div class="col-12"><label for=""
                                                            class="mb-0 d-block">Percentage</label></div>
                                                    <div class="col-10 row">
                                                        <div class="col-md-4">
                                                            <select name="type[]" class="form-control"
                                                                id="sal_temp_deduct_cat">
                                                                <option value="percent">Percent</option>
                                                                <option value="fixed">Fixed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" class="input-pad deduct-input"
                                                                name="deduct[]" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p class="single_deduct"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-end  align-items-center ">
                                                        <button class="remove-field-btn1 btn btn-md btn-danger "
                                                            style="border:none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div> --}}
                                                <div class="row mt-2 " id="deduction-container">
                                                    <div class="col-12 mb-1">
                                                        <label for="" class="mb-0 d-block">Deduction Name</label>
                                                        <input type="text" name="deduction_name[]" id=""
                                                            class="input-pad deduct-name" value="" required>
                                                    </div>
                                                    <div class="col-12"><label for=""
                                                            class="mb-0 d-block">Percentage</label></div>
                                                    <div class="col-10 row">
                                                        <div class="col-md-4">
                                                            <select name="type[]" class="form-control"
                                                                id="sal_temp_deduct_cat">
                                                                <option value="percent">Percent</option>
                                                                <option value="fixed">Fixed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" class="input-pad deduct-input"
                                                                name="deduct[]" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p class="single_deduct"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-end  align-items-center ">
                                                        <button type="button"
                                                            class="remove-field-btn1 btn btn-md btn-danger "
                                                            style="border:none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="">Total Deduction: </label>

                                                    </div>
                                                    <div class="col-6">
                                                        <p class="deduct-display"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-center mt-2">

                                    <div class="col-md-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-12"
                                                        style="background-color: rgb(8, 135, 118);color:rgb(231, 237, 235);padding:0.25rem;border-radius:4px;">
                                                        <h6 class="text-center" style="margin-bottom:0;">Total Salary
                                                            Details</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">


                                                    <div class="col-md-12 py-2" style="overflow: auto;">
                                                        <table class="table table-bordered table-full">
                                                            <thead>
                                                                <tr>
                                                                    <td style="width:200px;">Gross Salary :</td>
                                                                    <td>
                                                                        <p class="gross_salary"></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total Deduction :</td>
                                                                    <td>
                                                                        <p class="deduct-display"></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Net Salary :</td>
                                                                    <td>
                                                                        <p class="total_salary"></p>
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- // --}}
                                <div class="row d-flex justify-content-end">

                                    <div class="col-md-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Set Template</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let tag = 1;
        document.getElementById('add-field-btn').addEventListener('click', function() {
            // Get the container where the inputs are stored
            var container = document.getElementById('input-container');
            // Clone the first input element
            var newField = container.cloneNode(true);
            newField.id = `input-container-${tag}`;
            tag++
            // Optional: Clear the input value of the cloned element
            newField.querySelector('input').value = '';
            newField.querySelector('.allowance-input').value = '';
            // var allowField = newField.querySelector('.allow_field');
            newField.querySelector('.allow_field').innerHTML = '';
            // allowField.innerHTML = '';
            // Append the cloned element to the container's parent
            container.parentNode.appendChild(newField);
            // Attach the remove event listener to the new remove button
            attachRemoveEventForAllowance(newField.querySelector('.remove-field-btn'));
        });

        // function attachRemoveEvent(button) {
        //     button.addEventListener('click', function(e) {
        //         console.log($(this));
        //         e.preventDefault();
        //         button.closest('.row').remove();
        //         sal_allowance($(this));
        //     });
        // }

        function sal_allowance(ele) {
            let sum = 0;
            let f_num = 0;
            let deductionSum = 0;
            let salary = parseFloat($('#salary').val());
            let check = ele.closest('.row').find('#sal_temp_allow_cat').val();
            let actual_value = parseFloat(ele.val());
            if (check == 'percent') {
                let single_all = (salary / 100) * actual_value;
                ele.closest('.row').find('.allow_field').text(single_all);
                $('.allowance-input').each(function() {
                    let toggle = $(this).closest('.row').find('#sal_temp_allow_cat').val();
                    if (toggle == 'percent' && $(this).val() != '' && $(this).val() != '0') {
                        let num = parseFloat($(this).closest('.row').find('.allow_field')
                            .text());
                        console.log(num, 'ok420');
                        sum += num;
                    } else {
                        f_num = parseFloat($(this).val());
                        console.log(f_num, 'else');
                        sum += f_num;
                    }
                });
            } else {
                ele.closest('.row').find('.allow_field').text('');
                $('.allowance-input').each(function() {
                    let atoggle = $(this).closest('.row').find('#sal_temp_allow_cat').val();
                    if (atoggle == 'percent' && $(this).val() != '' && $(this).val() != '0') {
                        let per = $(this).closest('.row').find('.allow_field')
                            .text();
                        let num = parseFloat(per);
                        sum += num;
                        console.log(per, 'check');
                    }
                    if ($(this).val() != '' && atoggle == 'fixed') {
                        f_num = parseFloat($(this).val());
                    }
                    sum += f_num;
                    console.log(sum, 'ok321');
                });
            }

            $('.allowance-display').text(`${sum}`);
            $('.gross_salary').text(sum + salary);

            let grossSalary = parseFloat($('.gross_salary').text()) || 0;

            if ($('.deduct-display:first').text().trim() === '') {
                console.log('enter');
            } else {
                deductionSum = parseFloat($('.deduct-display:first').text());
            }
            $('.total_salary').text(grossSalary - deductionSum);
        }

        function deduct(ele) {
            let sum = 0;
            let f_num = 0;
            let salary = parseFloat($('#salary').val());
            let check = ele.closest('.row').find('#sal_temp_deduct_cat').val();
            if (check == 'percent') {
                let val = parseFloat(ele.val());
                let aval = (salary / 100) * val;
                console.log(aval, 'deduct');
                ele.closest('.row').find('.single_deduct').text(aval);
                $('.deduct-input').each(function() {
                    let turn = $(this).closest('.row').find('#sal_temp_deduct_cat').val();
                    if (turn == 'percent' && $(this).val() != '' && $(this).val() != '0') {
                        let per = $(this).closest('.row').find('.single_deduct')
                            .text();
                        let num = parseFloat(per);
                        sum += num;
                    }

                    if ($(this).val() != '' && turn == 'fixed') {
                        f_num = parseFloat($(this).val());
                        sum += f_num;
                    }

                    console.log(turn, 'test420');


                })
            } else {
                $(ele).closest('.row').find('.single_deduct').text('');
                $('.deduct-input').each(function() {
                    let turn = $(this).closest('.row').find('#sal_temp_deduct_cat').val();
                    if (turn == 'percent' && $(this).val() != '' && $(this).val() != '0') {
                        let per = $(this).closest('.row').find('.single_deduct')
                            .text();
                        let num = parseFloat(per);
                        sum += num;
                    }
                    if ($(this).val() != '' && turn == 'fixed') {
                        f_num = parseFloat($(this).val());
                        sum += f_num;
                    }

                })
            }

            $('.deduct-display').text(sum);
            let acDeduct = parseFloat($('.deduct-display:first').text());
            let gross = parseFloat($('.gross_salary').text());
            console.log(acDeduct, gross);
            $('.total_salary').text(gross - acDeduct);
        }

        function attachRemoveEvent(button) {
            button.addEventListener('click', function(e) {
                // Remove the field's container
                e.preventDefault();
                button.closest('.row').remove();
                deduct($(this));
            });
        }

        function attachRemoveEventForAllowance(button) {
            button.addEventListener('click', function(e) {
                // Remove the field's container
                e.preventDefault();
                button.closest('.row').remove();
                sal_allowance($(this));
            });
        }

        $(document).ready(function() {

            $(document).on('input', '.allowance-input', function() {
                sal_allowance($(this));
            });
            document.querySelectorAll('.remove-field-btn').forEach(function(button) {
                attachRemoveEventForAllowance(button);
            });

            $(document).on('input', '.deduct-input', function() {
                deduct($(this));
            });

            document.querySelectorAll('.remove-field-btn1').forEach(function(button) {
                attachRemoveEvent(button);
            });
        });
        $(document).ready(function() {
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
    {{-- to create tabs for salarty temp and list --}}
    <script>
        function salaryTemp() {
            document.getElementById("fortemp").style.display = "block";
            document.getElementById("settemp").style.display = "none";
        }

        function setSalaryTemp() {
            document.getElementById("fortemp").style.display = "none";
            document.getElementById("settemp").style.display = "block";
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#dtable').DataTable({
                // You can add DataTables options here
            });
        });
    </script>

    <script>
        // document.getElementById('add-field-btn1').addEventListener('click', function() {
        //     // Get the container where the inputs are stored
        //     var container = document.getElementById('input-container1');

        //     // Clone the first input element
        //     var newField = container.cloneNode(true);

        //     // Optional: Clear the input value of the cloned element
        //     newField.querySelector('input').value = '';

        //     newField.querySelector('.deduct-name').value = '';

        //     newField.querySelector('.deduct-input').value = '';

        //     newField.querySelector('.single_deduct').innerHTML = '';

        //     // Append the cloned element to the container's parent
        //     container.parentNode.appendChild(newField);
        //     // Attach the remove event listener to the new remove button
        //     attachRemoveEvent(newField.querySelector('.remove-field-btn1'));
        // });
        document.getElementById('add-field-btn1').addEventListener('click', function() {
            // Get the container where the inputs are stored
            var container = document.getElementById('deduction-container');
            // Clone the first input element
            var newField = container.cloneNode(true);
            // Optional: Clear the input value of the cloned element
            newField.querySelector('input').value = '';
            newField.querySelector('.deduct-name').value = '';
            newField.querySelector('.deduct-input').value = '';
            newField.querySelector('.single_deduct').innerHTML = '';
            // Append the cloned element to the container's parent
            container.parentNode.appendChild(newField);
            // Attach the remove event listener to the new remove button
            attachRemoveEvent(newField.querySelector('.remove-field-btn1'));
        });
        // Attach the remove event listener to existing remove buttons
    </script>
@endsection
