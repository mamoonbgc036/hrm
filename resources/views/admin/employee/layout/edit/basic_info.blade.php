<form method="POST" id="BasicInfo" enctype="multipart/form-data">
    @csrf
    {{-- <div class="row">
        <div class="col-md-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="nid_no">Employee ID <span class="text-danger">*</span></label>
                <input class="form-control" id="pin_no" type="text" name="pin_no" value="{{ $employee->pin_no }}">
                <input type="hidden" name="id" value="{{ Session::get('employee_id') ?? ($employee->id ?? '') }}">
                <p class="text text-danger" id="pin"></p>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="nid_no">Employee ID <span class="text-danger">*</span></label>
                <input class="form-control" id="pin_no" type="text" name="pin_no" value="{{ $employee->pin_no }}">
                <input type="hidden" name="id" value="{{ Session::get('employee_id') ?? ($employee->id ?? '') }}">
                <p class="text text-danger" id="pin"></p>
            </div>
        </div>
        @php
            $name = $employee->name;
            $firstName = explode(' ', $name)[0];
        @endphp
        <div class="col-md-4 col-sm-4 col-md-4 col-xl-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="first_name">First Name <span
                        class="text-danger">*</span></label>
                <input class="form-control @error('first_name') is-invalid @enderror" id="first_name" type="text"
                    name="first_name" value="{{ $firstName }}">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-md-4 col-xl-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="middle_name">Middle Name <span
                        class="text-danger">*</span></label>
                <input class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" type="text"
                    name="middle_name" value="{{ $employee->middle_name }}">
                @error('middle_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-md-4 col-xl-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="last_name">Last Name <span
                        class="text-danger">*</span></label>
                <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" type="text"
                    name="last_name" value="{{ $employee->last_name }}">
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
                    autocomplete="off" value="{{ date('Y-m-d', strtotime($employee->join_date)) }}">
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="tentative_date">Tentative Confirmation Date</label>
                <input class="form-control" id="confirmation_date" name="tentative_date" type="date"
                    placeholder="DD-MM-YYYY" autocomplete="off" value="{{ date('Y-m-d', strtotime($employee->tentative_date)) }}">
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
                <select class="form-control text-uppercase" name="department_id" id="department_id" style="width:100%;">
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{$employee->department_id == $department->id ? 'selected' : ''}}>
                            {{ $department->name }}</option>
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
                        <option @if ($employee->designation_id == $value->id) value="{{ $value->id }}" selected @endif
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
                <select class="form-control text-uppercase my_district_id" id="my_district_id" name="location_id"
                    style="width: 100%">
                    <option value="" disabled selected>SELECT LOCATION</option>
                    @foreach ($districts as $location)
                        <option value="{{ $location->id }}"
                            {{ old('location_id', $employee->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="sub_location_id">Sub-Location</label>
                <select class="form-control text-uppercase sub_location_id" id="sub_location_id" name="sub_location_id"
                    style="width: 100%">
                    <option value="" disabled selected>SELECT SUB-LOCATION</option>
                    @foreach ($upazillas as $item)
                        <option value="{{ $item->id }}"
                            {{ old('location_id', $employee->sub_location_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <div class="col-md-2 col-sm-4"> --}}
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
        {{-- </div> --}}

        <div class="col-4 col-sm-4 col-md-4 col-xl-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="f_name">Father's Name</label>
                <input class="form-control" id="f_name" type="text" name="f_name"
                    value="{{ $employee->f_name }}">
            </div>
        </div>



        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="m_name">Mother's Name</label>
                <input class="form-control" id="m_name" type="text" name="m_name"
                    value="{{ $employee->m_name }}">
            </div>
        </div>


        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="gender">Gender</label>
                <select class="form-control text-uppercase" name="gender" id="gender">
                    <option value="" disabled selected>SELECT ONE</option>
                    <option
                        @if ($employee->gender == 'Male') value="Male" selected {{ old('gender') == 'Male' ? 'selected' : '' }} @endif>
                        MALE</option>
                    <option
                        @if ($employee->gender == 'Female') value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }} selected @endif>
                        FEMALE
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
                    <option value="A+" {{ old('blood_group', $employee->blood_group) == 'A+' ? 'selected' : '' }}>
                        A+</option>
                    <option value="A-" {{ old('blood_group', $employee->blood_group) == 'A-' ? 'selected' : '' }}>
                        A-</option>
                    <option value="B+" {{ old('blood_group', $employee->blood_group) == 'B+' ? 'selected' : '' }}>
                        B+</option>
                    <option value="B-" {{ old('blood_group', $employee->blood_group) == 'B-' ? 'selected' : '' }}>
                        B-</option>
                    <option value="O+" {{ old('blood_group', $employee->blood_group) == 'O+' ? 'selected' : '' }}>
                        O+</option>
                    <option value="O-" {{ old('blood_group', $employee->blood_group) == 'O-' ? 'selected' : '' }}>
                        O-</option>
                    <option value="AB+"
                        {{ old('blood_group', $employee->blood_group) == 'AB+' ? 'selected' : '' }}>AB+
                    </option>
                    <option value="AB-"
                        {{ old('blood_group', $employee->blood_group) == 'AB-' ? 'selected' : '' }}>AB-
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="date_of_birth">Date of Birth</label>
                <input class="form-control demoDate" id="date_of_birth" name="dob" type="date"
                    placeholder="DD-MM-YYYY" value="{{ date('Y-m-d', strtotime($employee->dob)) }}">
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label" for="marital_status">Marital Status</label>
                <select class="form-control form-control" id="marital_status" name="marital_status">
                    <option value="">SELECT STATUS</option>
                    <option
                        @if ($employee->marital_status == 'single') value="single" selected {{ old('marital_status') == 'single' ? 'selected' : '' }} @endif>
                        SINGLE
                    </option>
                    <option
                        @if ($employee->marital_status == 'married') value="married" selected {{ old('marital_status') == 'married' ? 'selected' : '' }} @endif>
                        MARRIED
                    </option>
                    <option
                        @if ($employee->marital_status == 'separate') value="separate"  selected {{ old('marital_status') == 'separate' ? 'selected' : '' }} @endif>
                        SEPARATE</option>
                </select>
            </div>
        </div>

        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="religion">Religion</label>
                <select class="form-control text-uppercase" name="religion" id="religion">
                    <option value="" disabled selected>SELECT ONE</option>
                    <option value="Islam" {{ old('religion', $employee->religion) == 'Islam' ? 'selected' : '' }}>
                        Islam
                    </option>
                    <option value="Hinduism"
                        {{ old('religion', $employee->religion) == 'Hinduism' ? 'selected' : '' }}>
                        Hinduism
                    </option>
                    <option value="Buddhism"
                        {{ old('religion', $employee->religion) == 'Buddhism' ? 'selected' : '' }}>
                        Buddhism
                    </option>
                    <option value="Christianity"
                        {{ old('religion', $employee->religion) == 'Christianity' ? 'selected' : '' }}>
                        Christianity
                    </option>
                    <option value="Other Religion" {{ old('religion') == 'Other Religion' ? 'selected' : '' }}>
                        OTHER RELIGION</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="nationality">Nationality</label>
                <input class="form-control" id="nationality" type="text" name="nationality"
                    value="{{ $employee->nationality }}">
            </div>
        </div>

        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="birth_registration_no">Birth
                    Registration No</label>
                <input class="form-control" id="birth_certificate_no" type="text" name="birth_certificate_no"
                    value="{{ $employee->birth_certificate_no }}">
                <p class="text text-danger" id="birth"></p>
            </div>
        </div>

        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="email">Email</label>
                <input autocapitalize="none" class="form-control" id="email" type="email" name="email"
                    value="{{ $employee->email }}">
                <p class="text text-danger" id="mail"></p>
            </div>
        </div>

        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="mobile_no">Mobile Number</label>
                <input class="form-control" id="mobile_no" type="text" name="mobile_no"
                    value="{{ $employee->mobile_no }}">
                <p class="text text-danger" id="mobile"></p>
            </div>
        </div>

        <div class="col-4 col-sm-4 col-md-4 col-xl-4 col-lg-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="nid_no">NID No.</label>
                <input class="form-control" id="nid_no" type="text" name="nid_no"
                    value="{{ $employee->nid_no }}">
                <p class="text text-danger" id="nid"></p>
            </div>
        </div>
        @php
            $selectedSkills = $employee->speciliazes->pluck('name')->toArray();
        @endphp
        <div class="col-md-4">
            <label for="" class="d-block mb-0 mt-2 pb-1">Specialized In</label>
            <select name="specializeSkills[]" id="multi_select" class="select2 form-control" multiple>
                @foreach ($specialized_skills as $key => $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $selectedSkills) ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @include('admin.employee.layout.profile')
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm">Next</button>
        </div>
    </div>
</form>
