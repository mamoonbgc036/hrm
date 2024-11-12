<div class="row">

    {{-- <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="grade_id">Grade Id</label>
            <select class="form-control text-uppercase demoSelect" name="grade_id" id="grade_id"
                style="width: 100%">
                <option value="" disabled selected>SELECT GRADE</option>
                @foreach ($grades as $value)
                    <option value="{{ $value->id }}"
                        {{ old('grade_id') == $value->id ? 'selected' : '' }}>
                        {{ App\Classes\StringConversion::stringToUpper($value->grade) }}</option>
                @endforeach
            </select>
        </div>
    </div> --}}
    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="station_name">SELECT BRANCH<span
                    class="text-danger">*</span></label>
            <select required class="form-control text-uppercase demoSelect station_select" name="station_id"
                id="police_station_id" style="width: 100%">
                <option value="" disabled selected>SELECT BRANCH</option>
                @foreach ($stations as $station)
                    <option value="{{ $station->id }}">{{ $station->name }}</option>
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
@include('admin.employee.layout.payroll')
{{-- about salary information --}}
{{-- <div class="row"> --}}
    <div class="col-12">
        <h5 class="mb-0 text-left text-bold">Configure Salary</h5>
        <hr>
    </div>
{{-- </div> --}}
<div class="row mt-1 d-flex justify-content-center">
    <div class="col-md-12">
        <div class="card" style="box-shadow: 12px 17px 13px 0 rgba(161, 161, 181, 0.2);">
            {{-- <div class="card-header d-flex justify-content-center"> --}}

            {{-- </div> --}}
            <div class="card-body">
                <label for="" class="d-block text-center"> Employment Type <span class="text-danger">*</span> </label>

                <select name="is_contractual" required id="emp_type" class="demoSelect form-control"
                    style="width: 100%" onchange="handleChange(this.value)" required>
                    <option value="" selected>SELECT EMPLOYEE TYPE</option>
                    <option value="1">Regular</option>
                    <option value="2">contractual</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4" id="regular" style="display: none;">
    <div class="col-12 mb-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <label for="" class="d-block">Select Grade</label>
                        <select required name="grade_id" id="s_grade_id" class="form-control" style="width: 100%;">
                            <option value="" selected>SELECT A GRADE</option>
                            @foreach ($grades as $key => $value)
                                <option value="{{ $value }}">
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
                            <select required name="in_probation" id="probation" class="form-control"
                                style="width: 100%;" onchange="isProbation(this.value)">
                                <option value="" selected disabled>SELECT ONE</option>
                                <option value="Y">YES
                                </option>
                                <option value="N">NO
                                </option>
                            </select>
                        </div>
                        <div class="col-12 my-2" style="display:none;" id="probation_salary">
                            <label for="" class="d-block">Consolided Salary</label>
                            <input type="number" name="effective_salary" id="effective_basic_salary"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" id="salary_tab">
        <div class="row d-flex justify-content-center my-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Basic Salary</label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p id="basic_salary" class="mb-0"></p>
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

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Total Allowance</label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p class="mb-0" id="total_allowance"></p>
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

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Total Deduction</label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p class="mb-0" id="total_deduction"></p>
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
                                <label for="">Total Salary</label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <p id="total_salary" class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row mt-4" id="contractual" style="display: none;">
    <div class="col-12">
        <label for="" class="d-block">Consolided Salary</label>
        <input type="number" name="effective_salary_one" id="" class="form-control">
    </div>
</div>
