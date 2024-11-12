<div class="row">
    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="station_name">SELECT BRANCH</label>
            <select required class="form-control text-uppercase demoSelect station_select" name="station_id"  id="police_station_id" style="width: 100%">
                <option value="" disabled>SELECT BRANCH</option>
                @foreach ($stations as $item)
                    <option value="{{ $item->id }}"
                        {{ $employee->station_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="division_id">Selected Zone</label>
            <input type="text" value="{{ @$employee->district->name }}" name="district_id" class="form-control zone"
                disabled>
            <input type="hidden" value="{{ @$employee->district->id }}" name="district_id"
                class="form-control zone_id">
        </div>
    </div>
    <div class="col-md-4 col-sm-4 text-uppercase">
        <div class="form-group text-uppercase">
            <label class="col-form-label col-form-label-sm" for="district_id">Selected Region</label>
            <input type="text" name="division_id" value="{{ @$employee->division->name }}"
                class="form-control region" disabled>
            <input type="hidden" name="division_id" value="{{ @$employee->division->id }}"
                class="form-control region_id">
        </div>
    </div>
    {{-- <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="division_id">Selected Zone</label>
            <input type="text" value="{{ $employee->district->name }}" name="district_id" class="form-control zone"
                disabled>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 text-uppercase">
        <div class="form-group text-uppercase">
            <label class="col-form-label col-form-label-sm" for="district_id">Selected Region</label>
            <input type="text" name="division_id" value="{{ $employee->division->name }}" class="form-control region"
                disabled>
        </div>
    </div> --}}
    {{-- <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="upazila_id">Station/Office
                Upazila/Thana <span class="text-danger">*</span></label>
            <input class="form-control" id="upazila_id" type="text" name="upazila_id" value="" disabled>
        </div>
    </div> --}}
    {{-- <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="attached_file">Attachment</label><br>
            <input style="border: unset;" id="attached_file" type="file" name="attached_file">
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="is_attached_to_station_or_office">IS
                ATTACHED TO STATION/OFFICE ?<span class="text-danger">*</span></label>
            <select class="form-control text-uppercase form-control-sm custom-select"
                id="is_attached_to_station_or_office" name="is_attached_to_station_or_office" style="width:100%;">
                <option selected>NO</option>
                <option>YES</option>
            </select>
        </div>
    </div> --}}
    <div class="col-md-4 col-sm-4">

    </div>
</div>

<div id="attached_station_or_office_div" style="display: none;">
    <h3>ATTACHED INFORMATION</h3>
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="attached_designation_id">Attached
                    Designation</label>
                <select class="form-control text-uppercase form-control-sm " id="attached_designation_id"
                    name="attached_designation_id" style="width: 100%">
                    <option value="" disabled selected>SELECT ATTACHED DESIGNATION</option>
                    @foreach ($designations as $value)
                        <option value="{{ $value->id }}"
                            {{ old('attached_designation_id') == $value->id ? 'selected' : '' }}>
                            {{ App\Classes\StringConversion::stringToUpper($value->en_name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="attached_police_station_id">Branch
                    Name</label>
                <select class="form-control text-uppercase demoSelect" name="attached_police_station_id"
                    id="attached_police_station_id" style="width: 100%">
                    <option value="" disabled selected>SELECT ATTACHED STATION/OFFICE</option>
                    @foreach ($stations as $value)
                        <option value="{{ $value->id }}"
                            {{ old('attached_police_station_id') == $value->id ? 'selected' : '' }}>
                            {{ App\Classes\StringConversion::stringToUpper(($value->code ? '[' . $value->code . '] ' : '') . $value->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="attached_division_id">Station/Office
                    Division <span class="text-danger">*</span></label>
                <input class="form-control" id="attached_division_id" type="text" name="attached_division_id"
                    value="" disabled>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 text-uppercase">
            <div class="form-group text-uppercase">
                <label class="col-form-label col-form-label-sm" for="attached_district_id">Station/Office
                    District <span class="text-danger">*</span></label>
                <input class="form-control" id="attached_district_id" type="text" name="attached_district_id"
                    value="" disabled>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="attached_upazila_id">Station/Office
                    Upazila/Thana <span class="text-danger">*</span></label>
                <input class="form-control" id="attached_upazila_id" type="text" name="attached_upazila_id"
                    value="" disabled>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="attached_attached_file">Attachment</label><br>
                <input style="border: unset;" id="attached_attached_file" type="file" name="attached_attached_file">
            </div>
        </div>
    </div>
</div>
{{-- //payroll --}}
@include('admin.employee.layout.edit.payroll')
{{-- about salary information --}}
<div class="col-12">
    <h5 class="mb-0 text-left text-bold">Configure Salary</h5>
    <hr>
</div>
<div class="row mt-1 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card" style="box-shadow: 12px 17px 13px 0 rgba(161, 161, 181, 0.2);">
            {{-- <div class="card-header d-flex justify-content-center"> --}}

            {{-- </div> --}}
            <div class="card-body">
                <label for="" class="d-block text-center">
                    Employment Type
                </label>

                <select name="is_contractual" required id="emp_type" class="demoSelect form-control"
                    style="width: 100%" onchange="handleChange(this.value)">
                    <option value="" selected>SELECT EMPLOYEE TYPE</option>
                    <option value="1" {{ $employee->is_contractual == 1 ? 'selected' : '' }}>Regular</option>
                    <option value="2" {{ $employee->is_contractual == 2 ? 'selected' : '' }}>contractual</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4" id="regular"
    style="{{ !empty($employee) && $employee->in_probation != null ? '' : 'display: none;' }}">
    <div class="col-12 mb-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <label for="" class="d-block">Select Grade</label>
                        <select required name="grade_id" id="s_grade_id" class="form-control" style="width: 100%;">
                            <option value="" selected>Select A Grade</option>
                            @foreach ($grades as $key => $value)
                                <option value="{{ $value }}"
                                    {{ old('grade_id', $employee->grade_id) == $value ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 my-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <label for="" class="d-block">Is in Probation Period?</label>
                            <select required name="in_probation" id="probation" class="form-control" style="width: 100%;" onchange="isProbation(this.value)">
                                <option value="" selected disabled>SELECT ONE</option>
                                <option value="Y" {{ $employee->in_probation == 'Y' ? 'selected' : '' }}>YES</option>
                                <option value="N" {{ $employee->in_probation == 'N' ? 'selected' : '' }}>NO</option>
                            </select>
                        </div>
                        <div class="col-12 my-2" style="{{ !empty($employee) && $employee->in_probation != null ? '' : 'display: none;' }}" id="probation_salary">
                            <label for="" class="d-block">Consolided Salary</label>
                            <input type="number" name="effective_salary" value="{{ old('effective_salary', $employee->effective_salary) }}" id="effective_basic_salary" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" id="salary_tab" style="{{ !empty($employee) && $employee->grade_id == '' ? 'display: none;' : '' }}">
        <div class="row d-flex justify-content-center my-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="">Basic Salary: </label>
                            </div>
                            <div class="col-3 d-flex justify-content-start">
                                <p id="basic_salary" class="mb-0">{{ $employee->monthly_grade->basic_salary??null }}</p>
                            </div>
                            <div class="col-3 d-flex justify-content-end">
                                <label for="">Over Time: </label>
                            </div>
                            <div class="col-3 d-flex justify-content-start">
                                <p id="overtime_salary" class="mb-0">{{ $employee->monthly_grade->overtime_salary??null }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4" id="allowance_tab">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Allowances</h5>
                    </div>
                    <div class="card-body" id="append_allowance">
                        @php 
                            $tAllowance = 0;
                        @endphp
                        @if($employee->monthly_grade && $employee->monthly_grade->allowances->count() > 0)
                            {{-- @if($employee->monthly_grade->allowances->count() > 0) --}}
                            @foreach($employee->monthly_grade->allowances as $allowance)
                            @php 
                                $tAllowance += $allowance->allowance_value;
                            @endphp
                                
                                    <div class="allowance_wrap" style="display: flex">
                                        <div class="col-4 d-flex justify-content-end">
                                            <label for="" class="allowance_label text-blod">{{ $allowance->allowance_label }} : </label>
                                        </div>
                                        <div class="col-8 d-flex justify-content-start">
                                            <p id="allowance_value" class="mb-0">{{ $allowance->allowance_value??null }} : </p>
                                        </div>
                                    </div>
                                
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Total Allowance</label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p class="mb-0" id="total_allowance">{{ $tAllowance }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-1" id="deduction_tab">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Deductions</h5>
                    </div>
                    <div class="card-body" id="append_deduction">
                        @php 
                            $tDeduction = 0;
                        @endphp
                        @if($employee->monthly_grade && $employee->monthly_grade->deduction->count() > 0)
                            @foreach($employee->monthly_grade->deduction as $deduction)
                                @php 
                                    $tDeduction += $deduction->deduction_value;
                                @endphp
                                <div class="">
                                    <div class="allowance_wrap" style="display: flex">
                                        <div class="col-6 justify-content-end">
                                            <label for="" class="deduction_label text-blod">{{ $deduction->deduction_label }} : </label>
                                        </div>
                                        <div class="col-6 justify-content-start">
                                            <p id="deduction_value" class="mb-0">{{ $deduction->deduction_value??null }} : </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Total Deduction</label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p class="mb-0" id="total_deduction">{{ $tDeduction }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row d-flex justify-content-center my-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Total Salary: </label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p id="total_salary" class="mb-0">{{ \App\Models\Employee::getTotalSal($employee) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row mt-4" id="contractual"
    style="{{ !empty($employee) && $employee->is_contractual == 2 ? '' : 'display: none;' }}">
    <div class="col-12">
        <label for="" class="d-block">Consolided Salary</label>
        <input type="number" value="{{ $employee->effective_salary }}" name="effective_salary_one" id="" class="form-control">
    </div>
</div>
