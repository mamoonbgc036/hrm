<div class="tab-content">
    <div id="general" class="tab-pane fade in active">
        <h3>General Information</h3>
        <hr>
        <div class="row">
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="first_name">First Name <span
                            class="text-danger">*</span></label>
                    <input class="form-control @error('first_name') is-invalid @enderror" id="first_name" type="text"
                        name="first_name" value="{{ old('first_name') }}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="middle_name">Middle Name <span
                            class="text-danger">*</span></label>
                    <input class="form-control @error('middle_name') is-invalid @enderror" id="middle_name"
                        type="text" name="middle_name" value="{{ old('middle_name') }}">
                    @error('middle_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="last_name">Last Name <span
                            class="text-danger">*</span></label>
                    <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" type="text"
                        name="last_name" value="{{ old('last_name') }}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="join_date">Joining Date</label>
                    <input class="form-control" id="join_date" name="join_date" type="date" placeholder="DD-MM-YYYY"
                        autocomplete="off" value="{{ old('join_date') }}">
                </div>
            </div>

            {{-- <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="organization_id" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="department">Department</label>
                    <select class="form-control text-uppercase" name="department_id" id="department_id"
                        style="width:100%;">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="designation_id">Designation</label>
                    <select class="form-control text-uppercase " id="designation_id" name="designation_id"
                        style="width: 100%">
                        <option value="" disabled selected>SELECT DESIGNATION</option>
                        @foreach ($designations as $value)
                            <option value="{{ $value->id }}"
                                {{ old('designation_id') == $value->id ? 'selected' : '' }}>
                                {{ $value->en_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="location_id">Location</label>
                    <select class="form-control text-uppercase " id="location_id" name="location_id"
                        style="width: 100%">
                        <option value="" disabled selected>SELECT Location</option>
                        @foreach ($locations as $value)
                            <option value="{{ $value->id }}"
                                {{ old('location_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="sub_location_id">Sub-Location</label>
                    <select class="form-control text-uppercase " id="sub_location_id" name="sub_location_id"
                        style="width: 100%">
                        <option value="" disabled selected>SELECT Sub-Location</option>
                        @foreach ($subLocations as $value)
                            <option value="{{ $value->id }}"
                                {{ old('sub_location_id') == $value->id ? 'selected' : '' }}>
                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                {{-- <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="ot_eligibility">Is Auto Approved
                        Leave</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_male"
                                name="is_auto_approved_leave" value="Yes"
                                {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_male">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_female"
                                name="is_auto_approved_leave" value="No"
                                {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_female">No</label>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="f_name">Father's Name</label>
                    <input class="form-control" id="f_name" type="text" name="f_name"
                        value="{{ old('f_name') }}">
                </div>
            </div>



            <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="m_name">Mother's Name</label>
                    <input class="form-control" id="m_name" type="text" name="m_name"
                        value="{{ old('m_name') }}">
                </div>
            </div>


            <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="gender">Gender</label>
                    <select class="form-control text-uppercase" name="gender" id="gender">
                        <option value="" disabled selected>SELECT ONE</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>MALE</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>FEMALE
                        </option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>OTHER</option>
                    </select>
                </div>
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
                <div class="form-group">

                    <label class="col-form-label col-form-label-sm" for="blood_group">Blood Group</label>
                    <select class="form-control text-uppercase" id="blood_group" name="blood_group">
                        <option value="" disabled selected>SELECT ONE</option>
                        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+
                        </option>
                        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="date_of_birth">Date of Birth</label>
                    <input class="form-control demoDate" id="date_of_birth" name="date_of_birth" type="dob"
                        placeholder="DD-MM-YYYY" value="{{ old('date_of_birth') }}">
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label" for="marital_status">Marital Status</label>
                    <select class="form-control form-control" id="marital_status" name="marital_status">
                        <option value="">SELECT STATUS</option>
                        <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>
                            SINGLE
                        </option>
                        <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>
                            MARRIED
                        </option>
                        <option value="separate" {{ old('marital_status') == 'separate' ? 'selected' : '' }}>
                            SEPARATE</option>
                    </select>
                </div>
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="religion">Religion</label>
                    <select class="form-control text-uppercase" name="religion" id="religion">
                        <option value="" disabled selected>SELECT ONE</option>
                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>ISLAM
                        </option>
                        <option value="Hinduism" {{ old('religion') == 'Hinduism' ? 'selected' : '' }}>
                            HINDUISM
                        </option>
                        <option value="Buddhism" {{ old('religion') == 'Buddhism' ? 'selected' : '' }}>
                            BUDDHISM
                        </option>
                        <option value="Christianity" {{ old('religion') == 'Christianity' ? 'selected' : '' }}>
                            CHRISTIANITY</option>
                        <option value="Other Religion" {{ old('religion') == 'Other Religion' ? 'selected' : '' }}>
                            OTHER RELIGION</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="nationality">Nationality</label>
                    <input class="form-control" id="nationality" type="text" name="nationality"
                        value="{{ old('nationality') }}">
                </div>
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="birth_registration_no">Birth
                        Registration No</label>
                    <input class="form-control" id="birth_certificate_no" type="text" name="birth_certificate_no"
                        value="{{ old('birth_certificate_no') }}">
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="email">Email</label>
                    <input autocapitalize="none" class="form-control" id="email" type="email" name="email"
                        value="{{ old('email') }}">
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="mobile_no">Mobile Number</label>
                    <input class="form-control" id="mobile_no" type="text" name="mobile_no"
                        value="{{ old('mobile_no') }}">
                </div>
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="nid_no">NID No.</label>
                    <input class="form-control" id="nid_no" type="text" name="nid_no"
                        value="{{ old('nid_no') }}">
                </div>
            </div>


        </div>
    </div>
    <div id="payroll" class="tab-pane fade in active">
        <h3>Payroll Information</h3>
        <hr>
        <div class="row">
            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="ot_eligibility">OT
                        Eligibility</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_male" name="ot_eligibility"
                                value="Yes" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_male">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_female" name="ot_eligibility"
                                value="No" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_female">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="ot_eligibility">PF
                        Eligibility</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_male" name="pf_eligibility"
                                value="Yes" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_male">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_female" name="pf_eligibility"
                                value="No" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_female">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="ot_eligibility">Gratuity
                        Eligibility</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_male" name="gt_eligibility"
                                value="Yes" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_male">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_female" name="ot_eligibility"
                                value="No" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_female">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="ot_eligibility">Pension
                        Eligibility</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_male" name="pen_eligibility"
                                value="Yes" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_male">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="gender_female" name="ot_eligibility"
                                value="No" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_female">No</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="job_assign" class="tab-pane fade">
        <h3>Working Station</h3>
        <hr>
        <div class="row">

            <div class="col-md-4 col-sm-4">
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
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="station_name">Branch
                        Name</label>
                    <select class="form-control text-uppercase demoSelect" name="police_station_id"
                        id="police_station_id" style="width: 100%">
                        <option value="" disabled selected>SELECT Branch</option>
                        @foreach ($stations as $value)
                            <option value="{{ $value->id }}"
                                {{ old('police_station_id') == $value->id ? 'selected' : '' }}>
                                {{ App\Classes\StringConversion::stringToUpper(($value->code ? '[' . $value->code . '] ' : '') . $value->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="division_id">Station/Office
                        Division
                        <span class="text-danger">*</span></label>
                    <input class="form-control" id="division_id" type="text" name="division_id" value=""
                        disabled>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 text-uppercase">
                <div class="form-group text-uppercase">
                    <label class="col-form-label col-form-label-sm" for="district_id">Station/Office
                        District
                        <span class="text-danger">*</span></label>
                    <input class="form-control" id="district_id" type="text" name="district_id" value=""
                        disabled>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="upazila_id">Station/Office
                        Upazila/Thana <span class="text-danger">*</span></label>
                    <input class="form-control" id="upazila_id" type="text" name="upazila_id" value=""
                        disabled>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
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
                        id="is_attached_to_station_or_office" name="is_attached_to_station_or_office"
                        style="width:100%;">
                        <option selected>NO</option>
                        <option>YES</option>
                    </select>
                </div>
            </div>
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
                        <input class="form-control" id="attached_division_id" type="text"
                            name="attached_division_id" value="" disabled>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 text-uppercase">
                    <div class="form-group text-uppercase">
                        <label class="col-form-label col-form-label-sm" for="attached_district_id">Station/Office
                            District <span class="text-danger">*</span></label>
                        <input class="form-control" id="attached_district_id" type="text"
                            name="attached_district_id" value="" disabled>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="attached_upazila_id">Station/Office
                            Upazila/Thana <span class="text-danger">*</span></label>
                        <input class="form-control" id="attached_upazila_id" type="text"
                            name="attached_upazila_id" value="" disabled>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm"
                            for="attached_attached_file">Attachment</label><br>
                        <input style="border: unset;" id="attached_attached_file" type="file"
                            name="attached_attached_file">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="present_address" class="tab-pane fade">
        <h3>Present Address</h3>
        <hr>
        <div class="row">
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pr_country_id">Country <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pr_country_id" name="present_country_id"
                        style="width:100%;">
                        <option disabled selected hidden>SELECT Conuntry</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($country->name) }}</option>
                        @endforeach()
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pr_division_id">Division <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pr_division_id" name="pr_division_id"
                        style="width:100%;">
                        <option disabled selected hidden>SELECT DIVISION</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($division->name) }}</option>
                        @endforeach()
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pr_district_id">District <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pr_district_id" name="pr_district_id"
                        style="width:100%;">
                        <option>SELECT District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($district->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="pr_upazila_id">Upazila/Thana <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pr_upazila_id" name="pr_upazila_id"
                        style="width:100%;">
                        <option>SELECT Upazila/Thana</option>
                        @foreach ($upazillas as $upazilla)
                            <option value="{{ $upazilla->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($upazilla->name) }}</option>
                        @endforeach()
                    </select>

                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="pr_post_office">Post Office</label>
                    <input class="form-control" id="pr_post_office" type="text" name="pr_post_office"
                        value="{{ old('pr_post_office') }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pr_postal_code">Postal Code</label>
                    <input class="form-control" id="pr_postal_code" type="text" name="pr_postal_code"
                        value="{{ old('pr_postal_code') }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm"
                        for="pr_area">Village/Road/Area/Block/Sector</label>
                    <input class="form-control" id="pr_area" type="text" name="pr_area"
                        value="{{ old('vi_ro_ar') }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pr_u_c_c_w">Union/City
                        Corporation/Ward</label>
                    <input class="form-control" id="pr_u_c_c_w" type="text" name="pr_u_c_c_w"
                        value="{{ old('pr_u_c_c_w') }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pr_house_no">House/Holding
                        No</label>
                    <input class="form-control" id="pr_house_no" type="text" name="pr_house_no"
                        value="{{ old('pr_house_no') }}">
                </div>
            </div>
        </div>

        <h3>PERMANENT ADDRESS</h3>
        <hr>
        <div class="col-md-4 col-sm-4 sameAsPresent">
            <div class="form-group" style="margin-top: 25px">
                <label class="col-form-label col-form-label-sm" for="sameAsPresent">Same as Present Address
                    ?</label>
                <input class="" name="sameAsPresent" type="checkbox"
                    {{ old('sameAsPresent') ? 'checked' : '' }} id="sameAsPresent">
            </div>
        </div>

        <div class="row permanent-address">
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pa_country_id">Country <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pa_country_id" name="permanent_country_id"
                        style="width:100%;">
                        <option disabled selected hidden>SELECT Conuntry</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($country->name) }}</option>
                        @endforeach()
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="pa_division_id">Division <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pa_division_id" name="pa_division_id"
                        style="width:100%;">
                        <option disabled selected hidden>SELECT ONE</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($division->name) }}</option>
                        @endforeach()
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="pa_district_id">District <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pa_district_id" name="pa_district_id"
                        style="width:100%;">
                        <option>SELECT District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($district->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pa_upazila_id">Upazila/Thana <span
                            class="text-danger">*</span></label>
                    <select class="form-control text-uppercase" id="pa_upazila_id" name="pa_upazila_id"
                        style="width:100%;">
                        <option>SELECT Upazila/Thana</option>
                        @foreach ($upazillas as $upazilla)
                            <option value="{{ $upazilla->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($upazilla->name) }}</option>
                        @endforeach()
                    </select>

                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pa_post_office">Post Office</label>
                    <input class="form-control" id="pa_post_office" type="text" name="pa_post_office"
                        value="{{ old('pa_post_office') }}">

                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pa_postal_code">Postal Code</label>
                    <input class="form-control" id="pa_postal_code" type="text" name="pa_postal_code"
                        value="{{ old('pa_postal_code') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm"
                        for="pa_area">Village/Road/Area/Block/Sector</label>
                    <input class="form-control" id="pa_area" type="text" name="pa_area"
                        value="{{ old('pa_area') }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pa_u_c_c_w">Union/City
                        Corporation/Ward</label>
                    <input class="form-control" id="pa_u_c_c_w" type="text" name="pa_u_c_c_w"
                        value="{{ old('pa_u_c_c_w') }}">
                </div>
            </div>
            <div class="col-md-6 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="pa_house_no">House/Holding
                        No.</label>
                    <input class="form-control" id="pa_house_no" type="text" name="pa_house_no"
                        value="{{ old('pa_house_no') }}">
                </div>
            </div>
        </div>
    </div>
    <div id="profile_picture" class="tab-pane fade">
        <h3>Profile Picture and Signature</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="img_url">Profile Picture</label>
                <input style="border: unset;" id="img_url" content="content" onchange="previewFile()"
                    name="img_url" type="file" accept="image/*">
                <span class="text-danger uppercase fs-14">Profile Picture size should be 20KB-200KB</span>
            </div>
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="img_url">Preview Profile
                    Picture</label><br>
                <img style="height: 200px;width: 200px; border: 3px solid #adb5bd;border-radius: 3%; " id="previewImg"
                    src="{{ asset('assets/employee/default-user.png') }}" alt="Image Preview">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="signature_url">Signature</label>
                <input style="border: unset;" id="signature_url" onchange="preview_signature()" name="signature_url"
                    type="file" accept="image/*">
                <span class="text-danger uppercase fs-14">Signature size should be 20KB-200KB</span>
            </div>
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="signature_url">Preview
                    Signature</label><br>
                <img style="height: 200px;width: 200px; border: 3px solid #adb5bd;border-radius: 3%; "
                    id="previewSignature" content="content" src="{{ asset('assets/employee/signature.png') }}"
                    alt="Image Preview">
            </div>
        </div>
    </div>
    <div id="personal" class="tab-pane fade">
        <h3>Family & Other Info</h3>
        <hr>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm"
                        for="e_contact_person_relation">Relationship</label>
                    <select name="relationship" id="relationship" class="form-control">
                        <option value="" selected>SELECT RELATIONSHIP</option>
                        @foreach ($relationship as $row)
                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="relation_name"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="relation_occupation"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="relation_contact"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_dob">Date of Birth</label>
                    <input class="form-control" id="dob" type="date" name="relation_dob"
                        value="{{ old('relation_dob') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="text-center" style="background-color: #009788; color:#f8ffff">Gurantor One</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="relation_name"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="organization_id" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="relation_occupation"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="relation_contact"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="text-center" style="background-color: #009788; color:#f8ffff">Gurantor Two</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="relation_name"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="organization_id" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="relation_occupation"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="relation_contact"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="text-center" style="background-color: #009788; color:#f8ffff">Referee One</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="relation_name"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="organization_id" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="relation_occupation"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="relation_contact"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="text-center" style="background-color: #009788; color:#f8ffff">Referee Two</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="relation_name"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="organization_id" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="relation_occupation"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="relation_contact"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="tab-pane fade">
        <h3>EMERGENCY CONTACT</h3>
        <hr>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="e_contact_person_name">Emergency
                        Contact Person Name</label>
                    <input class="form-control" id="e_contact_person_name" type="text"
                        name="e_contact_person_name" value="{{ old('e_contact_person_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="e_contact_person_number">Emergency
                        Contact Person Number</label>
                    <input class="form-control" id="e_contact_person_number" type="text"
                        name="e_contact_person_number" value="{{ old('e_contact_person_number') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="e_contact_person_relation">Emergency
                        Contact Person Relationship</label>
                    <select name="e_contact_person_relation" id="e_contact_person_relation" class="form-control">
                        <option value="" disabled selected>SELECT RELATIONSHIP</option>
                        @foreach ($relationship as $row)
                            <option value="{{ $row->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($row->name) }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="e_contact_person_name">Emergency
                        Contact Person Email</label>
                    <input class="form-control" id="e_contact_person_name" type="text"
                        name="e_contact_person_email" value="{{ old('e_contact_person_email') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="e_contact_person_address">Emergency
                        Contact Person Address</label>
                    <textarea class="form-control" id="e_contact_person_address" name="e_contact_person_address"></textarea>
                </div>
            </div>
        </div>


    </div>
    <div id="education" class="tab-pane fade">
        <br>
        <h3>Educational Qualifications</h3>
        <hr>
        <div class="row">
            <div id="jsc" class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <h5>JSC or Equivalent Level</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="jsc_examination">Examination</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('jsc_examination') is-invalid @enderror"
                                id="jsc_examination" name="jsc_examination" style="width: 100%">
                                <option value="" selected>SELECT EXAM</option>
                                <option value="J.S.C" @if (old('jsc_examination') == 'J.S.C') selected @endif>J.S.C
                                </option>
                                <option value="J.D.C" @if (old('jsc_examination') == 'J.D.C') selected @endif>J.D.C
                                </option>
                                <option value="J.S.C Vocational" @if (old('jsc_examination') == 'J.S.C Vocational') selected @endif>
                                    J.S.C VOCATIONAL</option>
                                <option value="J.S.C Equivalent" @if (old('jsc_examination') == 'J.S.C Equivalent') selected @endif>
                                    J.S.C EQUIVALENT</option>
                                <option value="Class 8 Passed" @if (old('jsc_examination') == 'Class 8 Passed') selected @endif>CLASS
                                    8 PASSED</option>
                            </select>
                            @error('jsc_examination')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="jsc_board">Board</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('jsc_board') is-invalid @enderror"
                                id="jsc_board" name="jsc_board" style="width: 100%">
                                <option value="" selected>SELECT BOARD</option>
                                <option value="Dhaka" @if (old('jsc_board') == 'Dhaka') selected @endif>
                                    DHAKA
                                </option>
                                <option value="Cumilla" @if (old('jsc_board') == 'Cumilla') selected @endif>
                                    CUMILLA</option>
                                <option value="Rajshahi" @if (old('jsc_board') == 'Rajshahi') selected @endif>
                                    RAJSHAHI</option>
                                <option value="Jashore" @if (old('jsc_board') == 'Jashore') selected @endif>
                                    JASHORE</option>
                                <option value="Chittagong" @if (old('jsc_board') == 'Chittagong') selected @endif>
                                    CHITTAGONG</option>
                                <option value="Barishal" @if (old('jsc_board') == 'Barishal') selected @endif>
                                    BARISHAL</option>
                                <option value="Sylhet" @if (old('jsc_board') == 'Sylhet') selected @endif>
                                    SYLHET</option>
                                <option value="Dinajpur" @if (old('jsc_board') == 'Dinajpur') selected @endif>
                                    DINAJPUR</option>
                                <option value="Madrasah" @if (old('jsc_board') == 'Madrasah') selected @endif>
                                    MADRASAH</option>
                                <option value="Mymensingh" @if (old('jsc_board') == 'Mymensingh') selected @endif>
                                    MYMENSINGH</option>
                                <option value="Cambridge International - IGCE"
                                    @if (old('jsc_board') == 'Cambridge International - IGCE') selected @endif>CAMBRIDGE INTERNATIONAL
                                    - IGCE</option>
                                <option value="Edexcel International"
                                    @if (old('jsc_board') == 'Edexcel International') selected @endif>EDEXCEL INTERNATIONAL
                                </option>
                                <option value="Bangladesh Technical Education Board (BTEB)"
                                    @if (old('jsc_board') == 'Bangladesh Technical Education Board (BTEB)') selected @endif>BANGLADESH TECHNICAL
                                    EDUCATION BOARD (BTEB)</option>
                                <option value="Others" @if (old('jsc_board') == 'Others') selected @endif>
                                    OTHER</option>
                            </select>
                            @error('jsc_board')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="jsc_roll">Board
                                Roll</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('jsc_roll') is-invalid @enderror"
                                id="jsc_roll" type="text" name="jsc_roll" value="{{ old('jsc_roll') }}">
                            @error('jsc_roll')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="jsc_registration">Registration Number</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('jsc_registration') is-invalid @enderror"
                                id="jsc_registration" type="text" name="jsc_registration"
                                value="{{ old('jsc_registration') }}">
                            @error('jsc_registration')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="jsc_result">Result</label>
                            <select style="margin-top: auto; width: 100%"
                                class="form-control form-control-sm col-md-4 col-sm-4 @error('jsc_result') is-invalid @enderror"
                                id="jsc_result" name="jsc_result">
                                <option value="" selected>SELECT RESULT</option>
                                <option value="Pass" @if (old('jsc_result') == 'Pass') selected @endif>
                                    PASS
                                </option>
                                <option value="4" @if (old('jsc_result') == '4') selected @endif>
                                    GPA(OUT OF 4)</option>
                                <option value="5" @if (old('jsc_result') == '5') selected @endif>
                                    GPA(OUT OF 5)</option>
                            </select>
                            @error('jsc_result')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div id="jsc_gpa_div"
                                class="jsc_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('jsc_gpa') is-invalid @enderror">
                                <input id="jsc_gpa" disabled name="jsc_gpa" type="text"
                                    class="form-control form-control-sm @error('jsc_gpa') is-invalid @enderror"
                                    value="{{ old('jsc_gpa') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">GPA</span>
                                </div>
                                @error('jsc_gpa')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="jsc_passing_year">Passing Year</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('jsc_passing_year') is-invalid @enderror"
                                id="jsc_passing_year" name="jsc_passing_year" style="width: 100%">
                                <option value="" selected>SELECT YEAR</option>
                                @for ($i = date('Y'); $i >= 1960; $i--)
                                    <option value="{{ $i }}"
                                        @if (old('jsc_passing_year') == $i) selected @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('jsc_passing_year')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="jsc_institute">School/College</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('jsc_institute') is-invalid @enderror"
                                id="jsc_institute" type="text" name="jsc_institute"
                                value="{{ old('jsc_institute') }}">
                            @error('jsc_institute')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div id="ssc" class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <h5>SSC or Equivalent Level</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_examination">Examination</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_examination') is-invalid @enderror"
                                id="ssc_examination" name="ssc_examination" style="width: 100%">
                                <option value="">SELECT EXAM</option>
                                <option value="S.S.C" @if (old('ssc_examination') == 'S.S.C') selected @endif>
                                    S.S.C</option>
                                <option value="Dakhil" @if (old('ssc_examination') == 'Dakhil') selected @endif>
                                    DAKHIL</option>
                                <option value="S.S.C Vocational" @if (old('ssc_examination') == 'S.S.C Vocational') selected @endif>
                                    S.S.C VOCATIONAL
                                </option>
                                <option value="O Level/Cambridge" @if (old('ssc_examination') == 'O Level/Cambridge') selected @endif>
                                    O LEVEL/CAMBRIDGE
                                </option>
                                <option value="S.S.C Equivalent" @if (old('ssc_examination') == 'S.S.C Equivalent') selected @endif>
                                    S.S.C EQUIVALENT
                                </option>
                            </select>
                            @error('ssc_examination')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">

                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_board">Board</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_board') is-invalid @enderror"
                                id="ssc_board" name="ssc_board" style="width: 100%">
                                <option value="" selected>SELECT BOARD</option>
                                <option value="Dhaka" @if (old('ssc_board') == 'Dhaka') selected @endif>
                                    DHAKA</option>
                                <option value="Cumilla" @if (old('ssc_board') == 'Cumilla') selected @endif>
                                    CUMILLA</option>
                                <option value="Rajshahi" @if (old('ssc_board') == 'Rajshahi') selected @endif>
                                    RAJSHAHI</option>
                                <option value="Jashore" @if (old('ssc_board') == 'Jashore') selected @endif>
                                    JASHORE</option>
                                <option value="Chittagong" @if (old('ssc_board') == 'Chittagong') selected @endif>
                                    CHITTAGONG</option>
                                <option value="Barishal" @if (old('ssc_board') == 'Barishal') selected @endif>
                                    BARISHAL</option>
                                <option value="Sylhet" @if (old('ssc_board') == 'Sylhet') selected @endif>
                                    SYLHET</option>
                                <option value="Dinajpur" @if (old('ssc_board') == 'Dinajpur') selected @endif>
                                    DINAJPUR</option>
                                <option value="Madrasah" @if (old('ssc_board') == 'Madrasah') selected @endif>
                                    MADRASAH</option>
                                <option value="Mymensingh" @if (old('ssc_board') == 'Mymensingh') selected @endif>
                                    MYMENSINGH</option>
                                <option value="Cambridge International - IGCE"
                                    @if (old('ssc_board') == 'Cambridge International - IGCE') selected @endif>CAMBRIDGE INTERNATIONAL
                                    - IGCE</option>
                                <option value="Edexcel International"
                                    @if (old('ssc_board') == 'Edexcel International') selected @endif>EDEXCEL INTERNATIONAL
                                </option>
                                <option value="Bangladesh Technical Education Board (BTEB)"
                                    @if (old('ssc_board') == 'Bangladesh Technical Education Board (BTEB)') selected @endif>BANGLADESH TECHNICAL
                                    EDUCATION BOARD (BTEB)</option>
                                <option value="Others" @if (old('ssc_board') == 'Others') selected @endif>
                                    OTHER</option>
                            </select>
                            @error('ssc_board')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="ssc_roll">Board
                                Roll</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('ssc_roll') is-invalid @enderror"
                                id="ssc_roll" type="text" name="ssc_roll" value="{{ old('ssc_roll') }}">
                            @error('ssc_roll')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_registration">Registration Number</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('ssc_registration') is-invalid @enderror"
                                id="ssc_registration" type="text" name="ssc_registration"
                                value="{{ old('ssc_registration') }}">
                            @error('ssc_registration')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_result">Result</label>
                            <select style="margin-top: auto; width: 100%"
                                class="form-control form-control-sm col-md-4 col-sm-4 @error('ssc_result') is-invalid @enderror"
                                id="ssc_result" name="ssc_result">
                                <option value="" selected>SELECT RESULT</option>
                                <option value="1ST DIVISION" @if (old('ssc_result') == '1ST DIVISION') selected @endif>1ST
                                    DIVISION</option>
                                <option value="2ND DIVISION" @if (old('ssc_result') == '2ND DIVISION') selected @endif>2ND
                                    DIVISION</option>
                                <option value="3RD DIVISION" @if (old('ssc_result') == '3RD DIVISION') selected @endif>3RD
                                    DIVISION</option>
                                <option value="4" @if (old('ssc_result') == '4') selected @endif>
                                    GPA(OUT OF 4)</option>
                                <option value="5" @if (old('ssc_result') == '5') selected @endif>
                                    GPA(OUT OF 5)</option>
                            </select>

                            @error('ssc_result')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div id="ssc_gpa_div"
                                class="ssc_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('ssc_gpa') is-invalid @enderror">
                                <input id="ssc_gpa" disabled name="ssc_gpa" type="text"
                                    class="form-control form-control-sm @error('ssc_gpa') is-invalid @enderror"
                                    value="{{ old('ssc_gpa') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">GPA</span>
                                </div>
                                @error('ssc_gpa')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_subject">Group/Subject</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_subject') is-invalid @enderror"
                                id="ssc_subject" name="ssc_subject" style="width: 100%">
                                <option value="" selected>SELECT GROUP/SUBJECT</option>
                                @foreach ($ssc_subjects as $subject)
                                    <option value="{{ $subject->name }}"
                                        @if (old('ssc_subject') == $subject->name) selected @endif>
                                        {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ssc_subject')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_passing_year">Passing Year</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_passing_year') is-invalid @enderror"
                                id="ssc_passing_year" name="ssc_passing_year" style="width: 100%">
                                <option value="" selected>SELECT YEAR</option>
                                @for ($i = date('Y'); $i >= 1960; $i--)
                                    <option value="{{ $i }}"
                                        @if (old('ssc_passing_year') == $i) selected @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('ssc_passing_year')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="ssc_institute">School/College</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('ssc_institute') is-invalid @enderror"
                                id="ssc_institute" type="text" name="ssc_institute"
                                value="{{ old('ssc_institute') }}">
                            @error('ssc_institute')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div id="hsc" class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <h5>HSC or Equivalent Level</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_examination">Examination</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_examination') is-invalid @enderror"
                                id="hsc_examination" name="hsc_examination" style="width: 100%">
                                <option value="" selected>SELECT EXAM</option>
                                <option value="H.S.C" @if (old('hsc_examination') == 'H.S.C') selected @endif>
                                    H.S.C</option>
                                <option value="Alim" @if (old('hsc_examination') == 'Alim') selected @endif>
                                    ALIM
                                </option>
                                <option value="Business Management"
                                    @if (old('hsc_examination') == 'Business Management') selected @endif>BUSINESS MANAGEMENT
                                </option>
                                <option value="Diploma Engineering"
                                    @if (old('hsc_examination') == 'Diploma Engineering') selected @endif>DIPLOMA ENGINEERING
                                </option>
                                <option value="A Level/Sr. Cambridge"
                                    @if (old('hsc_examination') == 'A Level/Sr. Cambridge') selected @endif>A LEVEL/SR. CAMBRIDGE
                                </option>
                                <option value="H.S.C Equivalent" @if (old('hsc_examination') == 'H.S.C Equivalent') selected @endif>
                                    H.S.C EQUIVALENT
                                </option>
                                <option value="Diploma in Pharmacy"
                                    @if (old('hsc_examination') == 'Diploma in Pharmacy') selected @endif>DIPLOMA IN PHARMACY
                                </option>
                            </select>
                            @error('hsc_examination')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_board">Board</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_board') is-invalid @enderror"
                                id="hsc_board" name="hsc_board" style="width: 100%">
                                <option value="" selected>SELECT BOARD</option>
                                <option value="Dhaka" @if (old('hsc_board') == 'Dhaka') selected @endif>
                                    DHAKA</option>
                                <option value="Cumilla" @if (old('hsc_board') == 'Cumilla') selected @endif>
                                    CUMILLA</option>
                                <option value="Rajshahi" @if (old('hsc_board') == 'Rajshahi') selected @endif>
                                    RAJSHAHI</option>
                                <option value="Jashore" @if (old('hsc_board') == 'Jashore') selected @endif>
                                    JASHORE</option>
                                <option value="Chittagong" @if (old('hsc_board') == 'Chittagong') selected @endif>
                                    CHITTAGONG</option>
                                <option value="Barishal" @if (old('hsc_board') == 'Barishal') selected @endif>
                                    BARISHAL</option>
                                <option value="Sylhet" @if (old('hsc_board') == 'Sylhet') selected @endif>
                                    SYLHET</option>
                                <option value="Dinajpur" @if (old('hsc_board') == 'Dinajpur') selected @endif>
                                    DINAJPUR</option>
                                <option value="Madrasah" @if (old('hsc_board') == 'Madrasah') selected @endif>
                                    MADRASAH</option>
                                <option value="Mymensingh" @if (old('hsc_board') == 'Mymensingh') selected @endif>
                                    MYMENSINGH</option>
                                <option value="Cambridge International - IGCE"
                                    @if (old('hsc_board') == 'Cambridge International - IGCE') selected @endif>CAMBRIDGE INTERNATIONAL
                                    - IGCE</option>
                                <option value="Edexcel International"
                                    @if (old('hsc_board') == 'Edexcel International') selected @endif>EDEXCEL INTERNATIONAL
                                </option>
                                <option value="Bangladesh Technical Education Board (BTEB)"
                                    @if (old('hsc_board') == 'Bangladesh Technical Education Board (BTEB)') selected @endif>BANGLADESH TECHNICAL
                                    EDUCATION BOARD (BTEB)</option>
                                <option value="Others" @if (old('hsc_board') == 'Others') selected @endif>
                                    OTHER</option>
                            </select>
                            @error('hsc_board')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="hsc_roll">Board
                                Roll</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('hsc_roll') is-invalid @enderror"
                                id="hsc_roll" type="text" name="hsc_roll" value="{{ old('hsc_roll') }}">
                            @error('hsc_roll')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_registration">Registration Number</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('hsc_registration') is-invalid @enderror"
                                id="hsc_registration" type="text" name="hsc_registration"
                                value="{{ old('hsc_registration') }}">
                            @error('hsc_registration')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_result">Result</label>
                            <select style="margin-top: auto; width: 100%"
                                class="form-control form-control-sm col-md-4 col-sm-4 @error('hsc_result') is-invalid @enderror"
                                id="hsc_result" name="hsc_result">
                                <option value="" selected>SELECT RESULT</option>
                                <option value="1ST DIVISION" @if (old('hsc_result') == '1ST DIVISION') selected @endif>1ST
                                    DIVISION</option>
                                <option value="2ND DIVISION" @if (old('hsc_result') == '2ND DIVISION') selected @endif>2ND
                                    DIVISION</option>
                                <option value="3RD DIVISION" @if (old('hsc_result') == '3RD DIVISION') selected @endif>3RD
                                    DIVISION</option>
                                <option value="4" @if (old('hsc_result') == '4') selected @endif>
                                    GPA(OUT OF 4)</option>
                                <option value="5" @if (old('hsc_result') == '5') selected @endif>
                                    GPA(OUT OF 5)</option>
                            </select>
                            @error('hsc_result')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div id="hsc_gpa_div"
                                class="hsc_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('hsc_gpa') is-invalid @enderror">
                                <input id="hsc_gpa" disabled name="hsc_gpa" type="text"
                                    class="form-control form-control-sm @error('hsc_gpa') is-invalid @enderror"
                                    value="{{ old('hsc_gpa') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">GPA</span>
                                </div>
                                @error('hsc_gpa')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_subject">Group/Subject</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_subject') is-invalid @enderror"
                                id="hsc_subject" name="hsc_subject" style="width: 100%">
                                <option value="" selected>SELECT GROUP/SUBJECT</option>
                                @foreach ($hsc_subjects as $subject)
                                    <option value="{{ $subject->name }}"
                                        @if (old('hsc_subject') == $subject->name) selected @endif>
                                        {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hsc_subject')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_passing_year">Passing Year</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_passing_year') is-invalid @enderror"
                                id="hsc_passing_year" name="hsc_passing_year" style="width: 100%">
                                <option value="" selected>SELECT YEAR</option>
                                @for ($i = date('Y'); $i >= 1960; $i--)
                                    <option value="{{ $i }}"
                                        @if (old('hsc_passing_year') == $i) selected @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('hsc_passing_year')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="hsc_institute">School/College</label>
                            <input
                                class="form-control form-control-sm col-md-8 col-sm-8 @error('hsc_institute') is-invalid @enderror"
                                id="hsc_institute" type="text" name="hsc_institute"
                                value="{{ old('hsc_institute') }}">
                            @error('hsc_institute')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div id="graduation" class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <h5>Graduation or Equivalent Level</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="graduation_examination">Examination</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_examination') is-invalid @enderror"
                                id="graduation_examination" name="graduation_examination" style="width: 100%">
                                <option value="">SELECT EXAM</option>
                                <option value="B.A" @if (old('graduation_examination') == 'B.A') selected @endif>
                                    B.A</option>
                                <option value="B.S.S" @if (old('graduation_examination') == 'B.S.S') selected @endif>
                                    B.S.S</option>
                                <option value="B.Sc(Engineering/Architecture)"
                                    @if (old('graduation_examination') == 'B.Sc(Engineering/Architecture)') selected @endif>B.SC
                                    (ENGINEERING/ARCHITECTURE)</option>
                                <option value="B.Sc(Agricultural Science)"
                                    @if (old('graduation_examination') == 'B.Sc(Agricultural Science)') selected @endif>B.SC (AGRICULTURAL
                                    SCIENCE)</option>
                                <option value="M.B.B.S./B.D.S" @if (old('graduation_examination') == 'M.B.B.S./B.D.S') selected @endif>
                                    M.B.B.S./B.D.S</option>
                                <option value="B.COM" @if (old('graduation_examination') == 'B.COM') selected @endif>
                                    B.COM</option>
                                <option value="B.B.A" @if (old('graduation_examination') == 'B.B.A') selected @endif>
                                    B.B.A</option>
                                <option value="L.L.B" @if (old('graduation_examination') == 'L.L.B') selected @endif>
                                    L.L.B</option>
                                <option value="Honors" @if (old('graduation_examination') == 'Honors') selected @endif>
                                    Honors</option>
                                <option value="Pass Course" @if (old('graduation_examination') == 'Pass Course') selected @endif>PASS
                                    COURSE</option>
                                <option value="Fazil" @if (old('graduation_examination') == 'Fazil') selected @endif>
                                    Fazil</option>
                                <option value="Graduation/Honors Equivalent"
                                    @if (old('graduation_examination') == 'Graduation/Honors Equivalent') selected @endif>GRADUATION/HONORS
                                    EQUIVALENT</option>
                                <option value="Others" @if (old('graduation_examination') == 'Others') selected @endif>
                                    Others</option>
                            </select>
                            @error('graduation_examination')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="graduation_course_duration">Course Duration</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_course_duration') is-invalid @enderror"
                                id="graduation_course_duration" name="graduation_course_duration"
                                style="width: 100%">
                                <option value="" selected="selected">SELECT DURATION</option>
                                <option value="01 Year" @if (old('graduation_course_duration') == '01 Year') selected @endif>
                                    01 YEAR</option>
                                <option value="02 Years" @if (old('graduation_course_duration') == '02 Years') selected @endif>
                                    02 YEARS</option>
                                <option value="03 Years" @if (old('graduation_course_duration') == '03 Years') selected @endif>
                                    03 YEARS</option>
                                <option value="04 Years" @if (old('graduation_course_duration') == '04 Years') selected @endif>
                                    04 YEARS</option>
                                <option value="05 Years" @if (old('graduation_course_duration') == '05 Years') selected @endif>
                                    05 YEARS</option>
                            </select>
                            @error('graduation_course_duration')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="graduation_result">Result</label>
                            <select style="margin-top: auto;width: 100%"
                                class="form-control form-control-sm col-md-4 col-sm-4 @error('graduation_result') is-invalid @enderror"
                                id="graduation_result" name="graduation_result">
                                <option value="" selected>SELECT RESULT</option>
                                <option value="1ST DIVISION" @if (old('graduation_result') == '1ST DIVISION') selected @endif>1ST
                                    DIVISION</option>
                                <option value="2ND DIVISION" @if (old('graduation_result') == '2ND DIVISION') selected @endif>2ND
                                    DIVISION</option>
                                <option value="3RD DIVISION" @if (old('graduation_result') == '3RD DIVISION') selected @endif>3RD
                                    DIVISION</option>
                                <option value="4" @if (old('graduation_result') == '4') selected @endif>
                                    GPA(OUT OF 4)</option>
                                <option value="5" @if (old('graduation_result') == '5') selected @endif>
                                    GPA(OUT OF 5)</option>
                            </select>
                            @error('graduation_result')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div id="graduation_gpa_div"
                                class="graduation_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('graduation_gpa') is-invalid @enderror">
                                <input id="graduation_gpa" disabled name="graduation_gpa" type="text"
                                    class="form-control form-control-sm @error('graduation_gpa') is-invalid @enderror"
                                    value="{{ old('graduation_gpa') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">GPA</span>
                                </div>
                                @error('graduation_gpa')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="graduation_subject">Subject/Degree</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_subject') is-invalid @enderror"
                                id="graduation_subject" name="graduation_subject" style="width: 100%">
                                <option value="" selected>SELECT SUBJECT/DEGREE</option>
                                @foreach ($graduation_subjects as $subject)
                                    <option value="{{ $subject->name }}"
                                        @if (old('graduation_subject') == $subject->name) selected @endif>
                                        {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('graduation_subject')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="graduation_passing_year">Passing Year</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_passing_year') is-invalid @enderror"
                                id="graduation_passing_year" name="graduation_passing_year" style="width: 100%">
                                <option value="" selected>SELECT YEAR</option>
                                @for ($i = date('Y'); $i >= 1960; $i--)
                                    <option value="{{ $i }}"
                                        @if (old('graduation_passing_year') == $i) selected @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('graduation_passing_year')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                                for="graduation_institute">College/University</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_institute') is-invalid @enderror"
                                id="graduation_institute" onchange="other_institute(this.id)"
                                name="graduation_institute" style="width: 100%">
                                <option value="" selected="selected">SELECT INSTITUTE</option>
                                @foreach ($graduation_institutes as $institute)
                                    <option value="{{ $institute->name }}"
                                        @if (old('graduation_institute') == $institute->name) selected @endif>
                                        {{ App\Classes\StringConversion::stringToUpper($institute->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('graduation_institute')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div id="new_institute_graduation_div" class="form-group row">

                        </div>

                    </div>
                </div>
            </div>

            <div id="masters" class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        <div class="form-check form-check-inline">
                            <h5>Masters or Equivalent Level</h5> &nbsp &nbsp
                            <input class="form-check-input " type="checkbox" id="if_masters">
                            <label class="form-check-label " for="if_masters">If Applicable</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <fieldset id="fieldset_masters" disabled>
                            <div class="form-group row">
                                <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                    for="masters_examination">Examination</label>
                                <select
                                    class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_examination') is-invalid @enderror"
                                    id="masters_examination" name="masters_examination" style="width: 100%">
                                    <option value="">SELECT EXAM</option>
                                    <option value="M.A" @if (old('masters_examination') == 'M.A') selected @endif>M.A
                                    </option>
                                    <option value="M.S.S" @if (old('masters_examination') == 'M.S.S') selected @endif>M.S.S
                                    </option>
                                    <option value="M.Sc" @if (old('masters_examination') == 'M.Sc') selected @endif>M.Sc
                                    </option>
                                    <option value="M.Com" @if (old('masters_examination') == 'M.Com') selected @endif>M.COM
                                    </option>
                                    <option value="M.B.A" @if (old('masters_examination') == 'M.B.A') selected @endif>M.B.A
                                    </option>
                                    <option value="L.L.M" @if (old('masters_examination') == 'L.L.M') selected @endif>L.L.M
                                    </option>
                                    <option value="M.Phil" @if (old('masters_examination') == 'M.Phi') selected @endif>
                                        M.PHIL</option>
                                    <option value="Kamil" @if (old('masters_examination') == 'Kamil') selected @endif>KAMIL
                                    </option>
                                    <option value="Others" @if (old('masters_examination') == 'Others') selected @endif>OTHER
                                    </option>
                                    <option value="Masters Equivalent"
                                        @if (old('masters_examination') == 'Masters Equivalent') selected @endif>MASTERS EQUIVALENT
                                    </option>
                                </select>
                                @error('masters_examination')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                    for="masters_course_duration">Course Duration</label>
                                <select
                                    class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_course_duration') is-invalid @enderror"
                                    id="masters_course_duration" name="masters_course_duration"
                                    style="width: 100%">
                                    <option value="" selected="selected">SELECT DURATION</option>
                                    <option value="01 Year" @if (old('masters_course_duration') == '01 Year') selected @endif>01
                                        YEAR</option>
                                    <option value="02 Years" @if (old('masters_course_duration') == '02 Years') selected @endif>02
                                        YEARS</option>
                                    <option value="03 Years" @if (old('masters_course_duration') == '03 Years') selected @endif>03
                                        YEARS</option>
                                    <option value="04 Years" @if (old('masters_course_duration') == '04 Years') selected @endif>04
                                        YEARS</option>
                                    <option value="05 Years" @if (old('masters_course_duration') == '05 Years') selected @endif>05
                                        YEARS</option>
                                </select>
                                @error('masters_course_duration')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                    for="masters_institute">University/Institute</label>
                                <select
                                    class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_institute') is-invalid @enderror"
                                    id="masters_institute" onchange="other_institute(this.id)"
                                    name="masters_institute" style="width: 100%">
                                    <option value="" selected="selected">SELECT INSTITUTE</option>
                                    @foreach ($masters_institutes as $institute)
                                        <option value="{{ $institute->name }}"
                                            @if (old('masters_institute') == $institute->name) selected @endif>
                                            {{ App\Classes\StringConversion::stringToUpper($institute->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('masters_institute')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                    for="masters_result">Result</label>
                                <select style="margin-top: 5px;width: 100%"
                                    class="form-control form-control-sm col-md-2 col-sm-2 @error('masters_result') is-invalid @enderror"
                                    id="masters_result" name="masters_result">
                                    <option value="" selected>SELECT RESULT</option>
                                    <option value="1ST DIVISION"
                                        @if (old('masters_result') == '1ST DIVISION') selected @endif>1ST DIVISION
                                    </option>
                                    <option value="2ND DIVISION"
                                        @if (old('masters_result') == '2ND DIVISION') selected @endif>2ND DIVISION
                                    </option>
                                    <option value="3RD DIVISION"
                                        @if (old('masters_result') == '3RD DIVISION') selected @endif>3RD DIVISION
                                    </option>
                                    <option value="4" @if (old('masters_result') == '4') selected @endif>
                                        GPA(OUT OF 4)
                                    </option>
                                    <option value="5" @if (old('masters_result') == '5') selected @endif>
                                        GPA(OUT OF 5)
                                    </option>
                                </select>
                                @error('masters_result')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div id="masters_gpa_div"
                                    class="masters_gpa input-group input-group-sm form-control-sm col-md-2 col-sm-2 @error('masters_gpa') is-invalid @enderror">
                                    <input id="masters_gpa" disabled name="masters_gpa" type="text"
                                        class="form-control form-control-sm @error('masters_gpa') is-invalid @enderror"
                                        value="{{ old('masters_gpa') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">GPA</span>
                                    </div>
                                    @error('masters_gpa')
                                        <span class="invalid-feedback text-md-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="new_institute_masters_div" class="form-group row">

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                    for="masters_subject">Degree/Subject</label>
                                <select
                                    class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_subject') is-invalid @enderror"
                                    id="masters_subject" name="masters_subject" style="width: 100%">
                                    <option value="" selected>SELECT DEGREE/SUBJECT</option>
                                    @foreach ($masters_subjects as $subject)
                                        <option value="{{ $subject->name }}"
                                            @if (old('masters_subject') == $subject->name) selected @endif>
                                            {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('masters_subject')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                    for="masters_passing_year">Passing Year</label>
                                <select
                                    class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_passing_year') is-invalid @enderror"
                                    id="masters_passing_year" name="masters_passing_year" style="width: 100%">
                                    <option value="" selected>SELECT YEAR</option>
                                    @for ($i = date('Y'); $i >= 1960; $i--)
                                        <option value="{{ $i }}"
                                            @if (old('masters_passing_year') == $i) selected @endif>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('masters_passing_year')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="more_educations">

        </div>

        <div class="text-center">
            <button type="button" class="btn btn-sm btn-outline-success mb-4" id="add_more_education">Add
                More Educational Qualification</button>
        </div>

        <div id="professional_experience" class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <div class="form-check form-check-inline">
                        <h5>Professional/Other Experiences</h5> &nbsp &nbsp
                        <input class="form-check-input " type="checkbox" id="if_professional">
                        <label class="form-check-label " for="if_professional">If Applicable (Please fill-up
                            the latest experience first)</label>
                    </div>
                </div>
                <div class="card-body">
                    <fieldset id="fieldset_professional" disabled>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                                for="professional_designation">Designation/Post</label>
                            <input
                                class="form-control form-control-sm col-md-4 col-sm-4 mt-2 @error('professional_designation') is-invalid @enderror"
                                id="professional_designation" name="professional_designation" style="width: 100%"
                                value="{{ old('professional_designation') }}">
                            @error('professional_designation')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2"
                                for="professional_from_date">From</label>
                            <input type="text" class="form-control demoDate col-md-2 col-sm-2 mt-2"
                                placeholder="DD-MM-YYYY" id="professional_from_date"
                                name="professional_from_date">
                            <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2"
                                for="professional_to_date">To</label>
                            <input type="text" class="form-control demoDate col-md-2 col-sm-2 mt-2"
                                placeholder="DD-MM-YYYY" id="professional_to_date" name="professional_to_date">
                            @error('professional_from_date')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('professional_to_date')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                                for="professional_organization">Organization Name</label>
                            <input
                                class="form-control form-control-sm col-md-4 col-sm-4 mt-2 @error('professional_organization') is-invalid @enderror"
                                id="professional_organization" name="professional_organization"
                                style="width: 100%">
                            @error('professional_organization')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                                for="professional_duration">Duration</label>
                            <input
                                class="form-control form-control-sm col-md-4 col-sm-4 mt-2 @error('professional_duration') is-invalid @enderror"
                                id="professional_duration" name="professional_duration" style="width: 100%"
                                readonly>
                            @error('professional_duration')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                                for="professional_responsibilities">Responsibilities</label>
                            <textarea class="form-control form-control-sm col-md-4 col-sm-4 mt-2" name="professional_responsibilities"
                                id="professional_responsibilities" cols="5" rows="3"></textarea>
                            @error('professional_responsibilities')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="row" id="more_professionals">

            </div>

            <div class="text-center">
                <button type="button" class="btn btn-sm btn-outline-primary mb-4" id="add_more_professional">Add
                    More Professional/Other Experience</button>
            </div>

        </div>

    </div>

    <div id="journal" class="tab-pane fade">
        <h3>Journal/Publications</h3>
        <hr>
        <div id="journal" class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <div class="form-check form-check-inline">
                        <h5>Journal/Publication</h5> &nbsp &nbsp
                        <input class="form-check-input " type="checkbox" id="if_journal">
                        <label class="form-check-label " for="if_journal">If Applicable</label>
                    </div>
                </div>
                <div class="card-body">
                    <fieldset id="fieldset_journal" disabled>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="title">Title</label>
                                    <input class="form-control" type="text" name="journal[0][title]"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm"
                                        for="weight">Publication/Publisher</label>
                                    <input class="form-control" type="text" name="journal[0][publication]"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="weight">Publication
                                        Date</label>
                                    <input class="form-control demoDate" name="journal[0][publication_date]"
                                        type="text" placeholder="DD-MM-YYYY" autocomplete="off"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="weight">Author</label>
                                    <input class="form-control" type="text" name="journal[0][author]"
                                        value="{{ old('author') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="weight">Publication
                                        URL</label>
                                    <input class="form-control" type="text" name="journal[0][publication_url]"
                                        value="{{ old('publication_url') }}">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="row" id="more_journals">

            </div>

            <div class="text-center">
                <button type="button" class="btn btn-sm btn-outline-primary mb-4" id="add_more_journal">Add More
                    Journal/Publication</button>
            </div>

        </div>

    </div>

    {{-- <div id="profile_picture" class="tab-pane fade">
        <h3>Profile Picture and Signature</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="img_url" >Profile Picture</label>
                <input style="border: unset;" id="img_url" content="content" onchange="previewFile()" name="img_url" type="file" accept="image/*">
                <span class="text-danger uppercase fs-14" >Profile Picture size should be 20KB-200KB</span>
            </div>
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="img_url">Preview Profile Picture</label><br>
                <img style="height: 200px;width: 200px; border: 3px solid #adb5bd;border-radius: 3%; " id="previewImg" src="{{asset('assets/employee/default-user.png')}}" alt="Image Preview">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="signature_url" >Signature</label>
                <input style="border: unset;" id="signature_url" onchange="preview_signature()" name="signature_url" type="file" accept="image/*">
                <span class="text-danger uppercase fs-14" >Signature size should be 20KB-200KB</span>
            </div>
            <div class="col-md-4">
                <label class="col-form-label col-form-label-sm" for="signature_url">Preview Signature</label><br>
                <img style="height: 200px;width: 200px; border: 3px solid #adb5bd;border-radius: 3%; " id="previewSignature" content="content" src="{{asset('assets/employee/signature.png')}}" alt="Image Preview">
            </div>
        </div>
    </div> --}}
    <div id="nominee" class="tab-pane fade">
        <hr>
        <h6 class="font-weight-semibold">Add Nominee</h6>
        <div v-for="(row,index) in nominee_inputs" class="mb-1">
            <div class="border border-secondary rounded">
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm"
                        @click="removeId(index)">X</button>
                </div>
                <div class="row mb-1 p-2">
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="mobil_oil" class="form-label">Nominee Name</label>
                        <div class="form-group">
                            <input class="{{ $error_class }} form-control" :name="'nominees[' + index + '][name]'"
                                type="text">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="mobil_oil" class="form-label">Relationship</label>
                        <div class="form-group">
                            <select :name="'nominees[' + index + '][relationship]'" id="relationship"
                                class="form-control text-uppercase">
                                <option value="" disabled selected>SELECT RELATIONSHIP</option>
                                @foreach ($relationship as $row)
                                    <option value="{{ $row->id }}">
                                        {{ App\Classes\StringConversion::stringToUpper($row->name) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="mobil_oil" class="form-label">Date of Birth</label>
                        <div class="form-group">
                            <input class="{{ $error_class }} form-control" :name="'nominees[' + index + '][dob]'"
                                type="date">
                            @if ($errors->has('dob'))
                                <p class="text-danger">{{ $errors->first('dob') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="nid_no" class="form-label">NID/Birth Registration No</label>
                        <div class="form-group">
                            <input class="{{ $error_class }} form-control"
                                :name="'nominees[' + index + '][nid_no]'" type="text">
                            @if ($errors->has('nid_no'))
                                <p class="text-danger">{{ $errors->first('nid_no') }}</p>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-sm-12 col-md-2">
                        @php /** @var string $errors */
                        $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="percentage" class="form-label">Percentage(%)</label>
                        <div class="form-group">
                            <input v-model="percentage[index]" @change="valid(index)" :name="'nominees['+index+'][percentage]'" class="{{$error_class}} form-control" id="percentage" type="text" >
                            @if ($errors->has('percentage'))
                                <p class="text-danger">{{$errors->first('percentage')}}</p>
                            @endif
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="permanent_address" class="form-label">Address</label>
                        <div class="form-group">
                            <textarea rows="3" cols="3" :name="'nominees[' + index + '][permanent_address]'"
                                class="{{ $error_class }} form-control"></textarea>
                            @if ($errors->has('permanent_address'))
                                <p class="text-danger">{{ $errors->first('permanent_address') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="picture" class="text-center form-label">Nominee Picture</label>
                        <div class="form-group">
                            <input style="border: unset;" :name="'nominees[' + index + '][picture]'"
                                class="nominee_picture_url" onchange="previewNomineePicture(this)" type="file"
                                accept="image/*">
                            <span class="text-danger">Picture size should be 20-200px</span>
                            <img style="height: 100px;width: 100px; border: 2px solid #adb5bd;border-radius: 3%;"
                                src="{{ asset('assets/employee/default-user.png') }}"
                                class="preview_nominee_picture" alt="Nominee Picture Preview">
                            @if ($errors->has('picture'))
                                <p class="text-danger">{{ $errors->first('picture') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                        <label for="signature" class="text-center form-label">Nominee Signature</label>
                        <div class="form-group">
                            <input style="border: unset;" :name="'nominees[' + index + '][signature]'"
                                class="nominee_signature_url" onchange="previewNomineePicture(this)"
                                type="file" accept="image/*">
                            <span class="text-danger">Picture size should be 20-200px</span>
                            <img style="height: 100px;width: 100px; border: 2px solid #adb5bd;border-radius: 3%;"
                                src="{{ asset('assets/employee/default-user.png') }}"
                                class="preview_nominee_signature" alt="Nominee Signature Preview">
                            @if ($errors->has('signature'))
                                <p class="text-danger">{{ $errors->first('signature') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-right">
            <button class="btn btn-info" @click.prevent="addMoreNominee">
                <i class="fa fa-plus-circle"></i>
                Add More
            </button>
        </div>
    </div>

    <div id="disease" class="tab-pane fade">
        <h3>Disease Information</h3>
        <hr>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="e_contact_person_relation">Disease
                        Name</label>
                    <select name="disease_id" id="disease_id" class="form-control">
                        <option value="" disabled selected>SELECT Disease</option>
                        @foreach ($diseases as $disease)
                            <option value="{{ $disease->id }}">
                                {{ App\Classes\StringConversion::stringToUpper($disease->name) }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
    </div>
    <div id="training" class="tab-pane fade">
        <div class="container mt-5">
            <h4 class="text-center text-info">Training Information</h4>
            @if (old('course_title'))
                @foreach (old('course_title') as $index => $title)
                    <div class="training-group">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="course_title" class="form-label">Course Title:</label>
                                <input type="text" name="course_title[]" class="form-control"
                                    value="{{ old('course_title' . $index) }}">
                                @error('course_title.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="course_start_date" class="form-label">Course Start Date:</label>
                                <input type="date" name="course_start_date[]" class="form-control"
                                    value="{{ old('course_start_date' . $index) }}">
                                @error('course_start_date.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="course_end_date" class="form-label">Course End Date:</label>
                                <input type="date" name="course_end_date[]" class="form-control"
                                    value="{{ old('course_end_date' . $index) }}">
                                @error('course_end_date.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="course_description" class="form-label">Course
                                    Description:</label>
                                <textarea name="course_description[]" class="form-control" rows="3"
                                    value="{{ old('course_description' . $index) }}"></textarea>
                                @error('course_description.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="training_type" class="form-label">Training Type:</label>
                                <input type="text" name="training_type[]"
                                    value="{{ old('training_type' . $index) }}" class="form-control">
                                @error('training_type.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="institute_name" class="form-label">Institute Name:</label>
                                <input type="text" name="institute_name[]" class="form-control"
                                    value="{{ old('institute_name' . $index) }}">
                                @error('institute_name.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="institute_address" class="form-label">Institute Address:</label>
                                <input type="text" name="institute_address[]" class="form-control"
                                    value="{{ old('institute_address' . $index) }}">
                                @error('institute_address.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="result" class="form-label">Result:</label>
                                <input type="text" name="result[]" class="form-control"
                                    value="{{ old('result' . $index) }}">
                                @error('result' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="year" class="form-label">Year:</label>
                                <input type="number" name="year[]" value="{{ old('year' . $index) }}"
                                    class="form-control">
                                @error('year.' . $index)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div id="training-fields">
                    <div class="training-group">
                        <button type="button" class="btn btn-danger btn-sm remove-training">Delete</button>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="course_title" class="form-label">Course Title:</label>
                                <input type="text" name="course_title[]" class="form-control">
                                @error('course_title.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="course_start_date" class="form-label">Course Start Date:</label>
                                <input type="date" name="course_start_date[]" class="form-control">
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="course_end_date" class="form-label">Course End Date:</label>
                                <input type="date" name="course_end_date[]" class="form-control">
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="course_description" class="form-label">Course
                                    Description:</label>
                                <textarea name="course_description[]" class="form-control" rows="3"></textarea>
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="training_type" class="form-label">Training Type:</label>
                                <input type="text" name="training_type[]" class="form-control">
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="institute_name" class="form-label">Institute Name:</label>
                                <input type="text" name="institute_name[]" class="form-control">
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="institute_address" class="form-label">Institute Address:</label>
                                <input type="text" name="institute_address[]" class="form-control">
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="result" class="form-label">Result:</label>
                                <input type="text" name="result[]" class="form-control">
                                @error('course_start_date.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="year" class="form-label">Year:</label>
                                <input type="number" name="year[]" class="form-control">
                                @error('year.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <button type="button" id="add-training" class="btn btn-secondary">Add Another
                    Training</button>
            </div>
        </div>
    </div>

    <div id="experience" class="tab-pane fade">
        <h3>Experience Information</h3>
        <hr>
        <div class="row">
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="company_name">Company Name</label>
                    <input class="form-control" id="company_name" type="text" name="company_name"
                        value="{{ old('company_name') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="job_position">Job Position</label>
                    <select name="" class="form-control" id="">
                        <option value="">Field Supervisor</option>
                        <option value="">Account Officer</option>
                        <option value="">Project Manager</option>
                        <option value="">Branch Manager</option>
                    </select>
                    <button type="button" class="btn btn-warning" id="add_job_position" data-toggle="modal"
                        data-target="#exampleModalCenter" class="bg-warning">add
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="company_location">Company
                        Location</label>
                    <input class="form-control" id="company_location" type="text" name="company_location"
                        value="{{ old('company_location') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="project_name">Project Name</label>
                    <input class="form-control" id="project_name" type="text" name="project_name"
                        value="{{ old('project_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="from_date">From Date</label>
                    <input class="form-control" id="from_date" name="from_date" type="date"
                        placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('from_date') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                    <input class="form-control" id="to_date" name="to_date" type="date"
                        placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('to_date') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="job_responsibility">Job
                        Responsibility</label>
                    <textarea class="form-control" id="job_responsibility" type="text" name="job_responsibility"
                        rows="5"></textarea>
                </div>
            </div>


        </div>
    </div>
</div>
@can('Employee create')
    <div class="tile-footer">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
@endcan
</form>
{{-- Experience job position form --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('experience.job.position') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Job Position</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End of the experience job position form --}}
</div>
@endsection

@push('script')
<script>
    $('#add_job_position').click(function(e) {
        // e.preventDefault();
    })
    document.getElementById('marital_status').addEventListener('change', function() {
        console.log('okkk')
        var spouseInfo = document.getElementById('spouse_info');
        if (this.value === 'married') {
            spouseInfo.style.display = 'block';
        } else {
            spouseInfo.style.display = 'none';
        }
    });

    $(document).ready(function() {
        $('#add-training').on('click', function() {
            var newTraining = $('.training-group:first').clone();
            newTraining.find('input, textarea').val('');
            $('#training-fields').append(newTraining);
        });

        // Remove training section
        $(document).on('click', '.remove-training', function() {
            if ($('.training-group').length > 1) {
                $(this).closest('.training-group').remove();
            } else {
                alert("At least one training section is required.");
            }
        });
    });
</script>
<script>
    $('document').ready(function() {
        // nominee----------
        let vm1 = new Vue({
            el: '#nominee',
            data: {
                nominee_inputs: [],
                percentage: [],
            },
            methods: {
                addMoreNominee() {
                    this.nominee_inputs.push(1);
                },
                removeId(index) {
                    this.nominee_inputs.splice(this.nominee_inputs.indexOf(index), 1);
                },
                valid(index) {
                    alert(index)
                    let sum = 0
                    this.nominee_inputs.forEach(function(nominee) {
                        sum += (parseInt(nominee.percentage));
                        console.log(sum)
                    });
                    if (sum > 100) {
                        // this.nominee_inputs[index].percentage = sum-100; //---NOT WORKING AS EXPECTED---//
                        toastr.error(
                            'Total sum of percentages can\'t be more than 100%, Currently you are trying to give ' +
                            sum + '%!', {
                                closeButton: true,
                                progressBar: true,
                            });
                    }
                    if (this.nominee_inputs[index].percentage < 0) {
                        this.nominee_inputs[index].percentage = 0
                        toastr.error('Percentage must be greater than 0', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                }
            },
        });

        //multiple spouse add
        let vue = new Vue({
            el: '#vue_personal',
            data: {
                marital_status: '',
                districts: {!! $districts !!},
                spouse_inputs: [{
                    name: '',
                    tin: '',
                    profession: '',
                    district: '',
                    total_child: '',
                    picture: '',
                }],
            },
            methods: {
                addMoreSpouse() {
                    this.spouse_inputs.push({
                        name: '',
                        tin: '',
                        profession: '',
                        district: '',
                        total_child: '',
                        picture: '',
                    });
                },
                removeId(row) {
                    this.spouse_inputs.splice(this.spouse_inputs.indexOf(row), 1);
                },
            },
            mounted: function() {

            }
        });

        $('#dob').change(function() {
            fetchAge();

            var birth_date = moment($('#dob').val(), 'DD-MM-YYYY');
            var duration = moment(birth_date.add(59, 'y')).format('DD-MM-YYYY');
            $('#lpr_date').val(duration);
        });

        //fetch duration of date
        function fetchAge() {
            var birth_date = moment($('#dob').val(), 'DD-MM-YYYY');
            var today_date = moment();

            if (birth_date.isValid() && today_date.isValid()) {
                var duration = moment.duration(today_date.diff(birth_date));
                if (duration.years() === 0 && duration.months() === 0) {
                    output = duration.days() + ' days';
                } else if (duration.years() === 0 && duration.months() !== 0) {
                    output = duration.months() + ' months ' + duration.days() + ' days';
                } else {
                    output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days() +
                        ' days';
                }
                $('#age').val(output);
            } else {
                console.log('Invalid date(s).')
            }
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('lastTab1', $(this).attr('href'));
        });

        let lastTab = localStorage.getItem('lastTab1');
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }

        //if present address same as permanent address
        $('#sameAsPresent').change(function() {
            let checkBox = $(this).prop("checked");
            if (checkBox === true) {
                let pr_country_id = $('#pr_country_id').val();
                $('#pa_country_id').val(pr_country_id)

                let pr_division_id = $('#pr_division_id').val();
                $('#pa_division_id').val(pr_division_id)

                let pr_district_id = $('#pr_district_id').val();
                $('#pa_district_id').val(pr_district_id)

                let pr_upazila_id = $('#pr_upazila_id').val();
                $('#pa_upazila_id').val(pr_upazila_id)

                let pr_post_office = $('#pr_post_office').val();
                $('#pa_post_office').val(pr_post_office);

                let pr_postal_code = $('#pr_postal_code').val();
                $('#pa_postal_code').val(pr_postal_code);

                let pr_area = $('#pr_area').val();
                $('#pa_area').val(pr_area);

                let pr_u_c_c_w = $('#pr_u_c_c_w').val();
                $('#pa_u_c_c_w').val(pr_u_c_c_w);

                let pr_house_no = $('#pr_house_no').val();
                $('#pa_house_no').val(pr_house_no);

            }
        });

        $('#is_attached_to_station_or_office').change(function() {
            let select = $('#is_attached_to_station_or_office').val();
            if (select === 'YES') {
                $('#attached_station_or_office_div').show();
            } else {
                $('#attached_station_or_office_div').hide();
            }
        });

        $('#division_id').change(function() {
            let id = $('#division_id').val();
            $.ajax({
                url: '{{ url('fetch-district') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#district_id').html(data);
                }
            });
        });

        $('#district_id').change(function() {
            let id = $('#district_id').val();
            $.ajax({
                url: '{{ url('fetch-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#upazila_id').html(data);
                }
            });
        });

        $('#attached_division_id').change(function() {
            let id = $('#attached_division_id').val();
            $.ajax({
                url: '{{ url('fetch-district') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#attached_district_id').html(data);
                }
            });
        });

        $('#attached_district_id').change(function() {
            let id = $('#attached_district_id').val();
            $.ajax({
                url: '{{ url('fetch-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#attached_upazila_id').html(data);
                }
            });
        });

        $('#police_station_id').change(function() {
            let id = $('#police_station_id').val();
            $.ajax({
                url: '{{ route('fetch-division-district-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#division_id').val(data.division.name);
                    $('#district_id').val(data.district.name);
                    $('#upazila_id').val(data.upazila.name);
                }
            });
        });

        $('#attached_police_station_id').change(function() {
            let id = $('#attached_police_station_id').val();
            $.ajax({
                url: '{{ route('fetch-division-district-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#attached_division_id').val(data.division.name);
                    $('#attached_district_id').val(data.district.name);
                    $('#attached_upazila_id').val(data.upazila.name);
                }
            });
        });

    });
</script>
<script>
    //image preview
    function previewFile() {
        // alert('profile')
        let file = $("#img_url").get(0).files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function() {
                $("#previewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
    //signature preview
    function preview_signature() {
        // alert('signature')
        let file = $("#signature_url").get(0).files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function() {
                $("#previewSignature").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    //signature preview
    function previewNomineePicture(input) {

        let file = input.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function() {
                $(input).parent().children('.preview_nominee_picture').attr('src', reader.result)
            }

            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    $(document).ready(function() {

        $('#masters_result').change(function() {
            let value = $('#masters_result').val()
            document.getElementById("masters_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#graduation_result').change(function() {
            let value = $('#graduation_result').val()
            document.getElementById("graduation_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#hsc_result').change(function() {
            let value = $('#hsc_result').val()
            document.getElementById("hsc_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#ssc_result').change(function() {
            let value = $('#ssc_result').val()
            document.getElementById("ssc_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#jsc_result').change(function() {
            let value = $('#jsc_result').val()
            document.getElementById("jsc_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#if_masters').change(function() {
            if (this.checked) {
                $('#fieldset_masters').prop('disabled', false);
            } else {
                $('#fieldset_masters').prop('disabled', true);
            }
        });

    });

    $(document).ready(function() {
        let i = 0;
        $('#add_more_education').click(function() {
            i++;
            $('#more_educations').append('<div id="more_education' + i +
                '" class="col-md-12 col-lg-12 more_education' + i + '">' +
                '<div class="text-center"> <button type="button" class="btn btn-sm btn-outline-warning mt-4" id="' +
                i +
                '" onclick="remove_more_education(this.id)">Remove More Educational Qualification - ' +
                i + ' </button></div> ' +
                '<div class="card"> ' +
                '<div class="card-header bg-info text-white text-center"> <h5>More Educational Qualifications ' +
                i + '</h5> </div> ' +
                '<div class="card-body"> <div class="form-group row"> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][examination]">Examination</label> <input id="more_education[' + i +
                '][examination]" name="more_education[' + i +
                '][examination]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][duration]">Course Duration</label> <input id="more_education[' + i +
                '][duration]" name="more_education[' + i +
                '][duration]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][institute]">University/Institute</label> <input id="more_education[' + i +
                '][institute]" name="more_education[' + i +
                '][institute]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i +
                '][result]">Result</label> <select  class="form-control form-control-sm col-md-2 col-sm-2" id="' +
                i + '" onchange="get_more_id(' + i + ')" name="more_education[' + i +
                '][result]" style="width: 100%"> <option value="" selected>SELECT RESULT</option> <option value="1ST DIVISION">1ST DIVISION</option> <option value="2ND DIVISION">2ND DIVISION</option> <option value="3RD DIVISION">3RD DIVISION</option> <option value="4">GPA(OUT OF 4)</option> <option value="5">GPA(OUT OF 5)</option> </select> ' +
                '<div id="more_gpa_div' + i + '" class="more_gpa' + i +
                ' input-group input-group-sm form-control-sm col-md-2 col-sm-2"> <input id="gpa' +
                i + '" disabled name="more_education[' + i +
                '][gpa]" type="text" class="form-control form-control-sm" value=""> <div class="input-group-append"> <span class="input-group-text">GPA</span> </div> </div> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][subject]">Degree/Subject</label> <input id="more_education[' + i +
                '][subject]" name="more_education[' + i +
                '][subject]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i +
                '][passing_year]">Passing Year</label> <input class="form-control form-control-sm col-md-4 col-sm-4" id="more_education[' +
                i + '][passing_year]" name="more_education[' + i +
                '][passing_year]" style="width: 100%"> </div> </div> </div> </div>')

        });

        $('#add_more_professional').click(function() {
            // alert(i)
            i++;
            $('#more_professionals').append('<div id="more_professional' + i +
                '" class="col-md-12 col-lg-12 more_professional' + i +
                '"> <div class="text-center"> <button type="button" class="btn btn-sm btn-outline-warning mt-4" id="' +
                i +
                '" onclick="remove_more_professional(this.id)">Remove More Professional Experiences - ' +
                i +
                ' </button> </div> <div class="card"> <div class="card-header bg-info text-white text-center"> <h5>More Professional Experiences ' +
                i +
                '</h5> </div> <div class="card-body"> <div class="form-group row"> <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2" for="professional_designation' +
                i +
                '">Designation/Post</label> <input class="form-control form-control-sm col-md-4 col-sm-4 mt-2" id="professional[' +
                i + '][designation]" name="professional[' + i +
                '][designation]" style="width: 100%"> <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2" for="professional[' +
                i +
                '][from_date]">From</label> <input type="text" class="form-control demoDate col-md-2 col-sm-2 mt-2" placeholder="DD-MM-YYYY" id="professional[' +
                i + '][from_date]" name="professional[' + i +
                '][from_date]" > <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2" for="professional[' +
                i +
                '][to_date]">To</label> <input type="text" class="form-control demoDate col-md-2 col-sm-2 mt-2" placeholder="DD-MM-YYYY" id="professional[' +
                i + '][to_date]" name="professional[' + i +
                '][to_date]" > <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2" for="professional[' +
                i +
                '][organization]">Organization Name</label> <input class="form-control form-control-sm col-md-4 col-sm-4 mt-2" id="professional[' +
                i + '][organization]" name="professional[' + i +
                '][organization]" style="width: 100%"> <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2" for="professional[' +
                i +
                '][responsibilities]">Responsibilities</label> <textarea class="form-control form-control-sm col-md-4 col-sm-4 mt-2" name="professional[' +
                i + '][responsibilities]" id="professional[' + i +
                '][responsibilities]" cols="5" rows="3"></textarea> </div> </div> </div> </div>')
        });

        $('#professional_from_date').on('change keyup paste', function() {
            // difference date
            let from_date = $('#professional_from_date').val();
            let to_date = $('#professional_to_date').val();

            $.ajax({
                url: '{{ url('fetch-duration2') }}',
                type: 'get',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.output);
                    $('#professional_duration').val(data.output);
                }
            });
        });

        $('#professional_to_date').on('change keyup paste', function() {
            // difference date
            let from_date = $('#professional_from_date').val();
            let to_date = $('#professional_to_date').val();

            $.ajax({
                url: '{{ url('fetch-duration2') }}',
                type: 'get',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.output);
                    $('#professional_duration').val(data.output);
                }
            });
        });

    });

    function remove_more_education(id) {
        // alert(id)
        let className = 'more_education' + id;
        $("div").remove("." + className);
    }

    $(document).ready(function() {
        $('.demoSelect').select2();
    });

    function other_institute(id) {
        value = $('#' + id).val()
        let type = id.split("_")[0]
        // alert(type)
        if (type == 'graduation') {
            if (value == 'Others') {
                $('#new_institute_graduation_div').append(
                    '<input id="graduation_new_institute_input" name="graduation_new_institute" type="text" class="form-control form-control-sm col-8" value="">' +
                    '<button id="graduation_new_institute" type="button" onclick="add_institute(this.id)" class="btn btn-outline-info btn-sm col-4">Add New Institute</button>'
                )
            } else {
                $('#graduation_new_institute_input').remove()
                $('#graduation_new_institute').remove()
            }
        } else if (type == 'masters') {
            if (value == 'Others') {
                $('#new_institute_masters_div').append(
                    '<input id="masters_new_institute_input" name="masters_new_institute" type="text" class="form-control form-control-sm col-4" value="">' +
                    '<button id="masters_new_institute" type="button" onclick="add_institute(this.id)" class="btn btn-outline-info btn-sm col-2">Add New Institute</button>'
                )
            } else {
                $('#masters_new_institute_input').remove()
                $('#masters_new_institute').remove()
            }
        }
    }

    function add_institute(id) {
        let type = id.split("_")[0]
        // alert(type)
        if (type == 'graduation') {
            value = $('#graduation_new_institute_input').val().toUpperCase()
            $('#graduation_institute').append('<option value="' + value + '" selected>' + value + '</option>')
        } else if (type == 'masters') {
            value = $('#masters_new_institute_input').val().toUpperCase()
            $('#masters_institute').append('<option value="' + value + '" selected>' + value + '</option>')
        }
    }

    function remove_more_professional(id) {
        // alert(id)
        let className = 'more_professional' + id;
        $("div").remove("." + className);
    }

    function get_more_id(id) {
        let value = $('[name ="more_education[' + id + '][result]"]').val()
        console.log(id)
        document.getElementById('gpa' + id).disabled = !(value >= 4 && value <= 5);
    }

    $(document).ready(function() {
        $('#if_professional').change(function() {
            if (this.checked) {
                $('#fieldset_professional').prop('disabled', false);
                // $('#if_presently_working').prop('disabled', false);
            } else {
                $('#fieldset_professional').prop('disabled', true);
                // $('#if_presently_working').prop('disabled', true);
            }
        });
    });

    $(document).ready(function() {
        $('#if_journal').change(function() {
            if (this.checked) {
                $('#fieldset_journal').prop('disabled', false);
                // $('#if_presently_working').prop('disabled', false);
            } else {
                $('#fieldset_journal').prop('disabled', true);
                // $('#if_presently_working').prop('disabled', true);
            }
        });

        $('#add_more_journal').click(function() {
            // alert(i)
            i++;
            $('#more_journals').append('<div class="col-md-12 col-lg-12 more_journal' + i +
                ' "> <div class="text-center"> <button type="button" class="btn btn-sm btn-outline-warning mt-4" id="' +
                i + '" onclick="remove_more_journal(this.id)">Remove More Journal/Publication - ' +
                i +
                ' </button></div> <div class="card"> <div class="card-header bg-info text-white text-center"> <div class="form-check form-check-inline"> <h5>More Journal/Publication ' +
                i +
                '</h5> &nbsp &nbsp </div> </div> <div class="card-body"> <div class="row"> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][title]">Title</label> <input class="form-control" type="text" name="journal[' +
                i +
                '][title]" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][publication]">Publication/Publisher</label> <input class="form-control" type="text" name="journal[' +
                i +
                '][publication]" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][publication_date]">Publication Date</label> <input class="form-control demoDate" id="lpr_date" name="journal[' +
                i +
                '][publication_date]" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][author]">Author</label> <input class="form-control" type="text" name="journal[' +
                i +
                '][author]" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][publication_url]">Publication URL</label> <input class="form-control" type="text" name="journal[' +
                i +
                '][publication_url]" value=""> </div> </div> </div> </div> </div> <div class="row" id="more_journals"> </div> </div>'
            );
        });

    });

    function remove_more_journal(id) {
        // alert(id)
        let className = 'more_journal' + id;
        $("div").remove("." + className);
    }
</script>
@endpush
