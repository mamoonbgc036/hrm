@extends('layouts.app')
@section('title', 'View Employee')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Employee Details</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="img-fluid img-circle"
                            src="{{ !empty($employee->img_url) ? asset('profile_image/' . $employee->img_url) : asset('assets/employee/default-user.jpg') }}"
                            alt="Employee picture"
                            style="border: 3px solid #adb5bd;margin: 0 auto; padding: 3px;width: 100px; height:100px; border-radius: 50%;">
                    </div>
                    <h3 class="profile-username text-center">
                        {{ App\Classes\StringConversion::stringToUpper($employee->name) }}</h3>
                    <p class="text-muted text-center">{{ $employee->designation->en_name ?? '' }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Date of Join</b> <a
                                class="float-right">{{ $employee->join_date != null ? \Carbon\Carbon::parse($employee->join_date)->format('d-m-Y') : '' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No</b> <a class="float-right">{{ $employee->mobile_no }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>PIN</b> <a class="float-right">{{ $employee->pin_no }}</a>
                        </li>
                    </ul>
                    {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary mt-4">
                <div class="card-header">
                    <span class="card-title">About Me</span>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong>Download PDS</strong>
                    <br>
                    <div class="btn-group">
                        @can('Employee pds button')
                            <a target="_blank" href="{{ route('long.pdf', $employee->id) }}"
                                class="btn btn-info btn-sm float-left m-1">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>Long PDS</a>
                            <a target="_blank" href="{{ route('short.pdf', $employee->id) }}"
                                class="btn btn-primary btn-sm float-left m-1">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>Short PDS</a>
                        @endcan
                    </div>
                    <hr>

                    <strong>Education</strong>
                    <p class="text-muted">
                        {{ $employee->highest_education->examination ?? '' }}
                    </p>
                    <hr>
                    <strong>Location</strong>
                    <p class="text-muted">{{ $employee->district->name }}</p>
                    <hr>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Information</a></li>
                        <li class="nav-item"><a class="nav-link" href="#work_station" data-toggle="tab">Working Station</a></li>
                        <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                        <li class="nav-item"><a class="nav-link" href="#education" data-toggle="tab">Education</a></li>
                        <li class="nav-item"><a class="nav-link" href="#experience" data-toggle="tab">Experience</a></li>
                        <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family & OtherInfo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#otherInfo" data-toggle="tab">Other Information</a></li>
                        <li class="nav-item"><a class="nav-link" href="#nominee" data-toggle="tab">Nominee</a></li>
                        <li class="nav-item"><a class="nav-link" href="#emergency_contact" data-toggle="tab">Emergency Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#trainingInfo" data-toggle="tab">Training Information</a></li>
                        <li class="nav-item"><a class="nav-link" href="#disease" data-toggle="tab">Disease Info.</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content border-0 p-0">
                        <div class="tab-pane active" id="information">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="card-title">General Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered view-data text-uppercase" id="">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $employee->name ?? '' }}
                                                </td>
                                                <th>Office/Station Name</th>
                                                <td>{{ $employee->posting_station->name ?? 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>PIN</th>
                                                <td>{{ $employee->pin_no }}</td>
                                                <th>Department</th>
                                                <td>{{ $employee->department->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Designation</th>
                                                <td>{{ $employee->designation->en_name ?? '' }}</td>
                                                <th>Location</th>
                                                <td>{{ $employee->division->name ?? '' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Join Date</th>
                                                <td>{{ $employee->join_date != null ? \Carbon\Carbon::parse($employee->join_date)->format('d-m-Y') : '' }}
                                                </td>
                                                <th>Tentative Confirmation Date</th>
                                                <td>
                                                    {{ $employee->join_date != null ? \Carbon\Carbon::parse($employee->tentative_date)->format('d-m-Y') : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $employee->gender ?? '' }}
                                                </td>

                                                <th>Blood Group</th>
                                                <td>
                                                    {{ $employee->blood_group??'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Father's Name</th>
                                                <td>{{ $employee->f_name??"N/A" }}
                                                </td>
                                                <th>Mother's Name</th>
                                                <td>{{ $employee->m_name??"N/A" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                                <td id="age">{{ $employee->dob }}</td>
                                                <th>DOB</th>
                                                <td id="dob">
                                                    {{ $employee->dob != null ? \Carbon\Carbon::parse($employee->dob)->format('d-m-Y') : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Marital Status</th>
                                                <td>{{ $employee->marital_status??"N/A" }}</td>
                                                <th>Religion</th>
                                                <td>{{ $employee->religion??"N/A" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nationality</th>
                                                <td>{{ $employee->nationality??"N/A" }}</td>
                                                <th>Birth Registration No.</th>
                                                <td>{{ $employee->birth_certificate_no??"N/A" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $employee->email??"N/A" }}</td>
                                                <th>NID No.</th>
                                                <td>{{ $employee->nid_no??"N/A" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Specialized In</th>
                                                <td>
                                                    @if($employee->speciliazes->count() > 0)
                                                        @foreach($employee->speciliazes as $spect)
                                                            <span>{{ $spect->specilizedSkill->name }}{{ $loop->last ? '' : ',' }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <th>Signature</th>
                                                <td>
                                                    <img class="img-fluid img-circle"
                                                        src="{{ !empty($employee->signature_url) ? asset('signature/' . $employee->signature_url) : asset('assets/employee/default-user.jpg') }}"
                                                        alt="Employee signature"
                                                        style="margin: 0 auto; padding: 3px;width: 100px; height:100px;">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="work_station">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover view-data table-bordered" id="">
                                        <tr>
                                            <th>Branch</th>
                                            <td>{{ $employee->posting_station->name??"N/A" }}</td>
                                            <th>Zone</th>
                                            <td>{{ $employee->district->name??"N/A" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Region</th>
                                            <td>{{ $employee->district->division->name??"N/A" }}</td>
                                            <th>OT Eligibility</th>
                                            <td>{{ $employee->ot_eligibility == 'Yes'? "Yes":'NO' }}</td>
                                        </tr>
                                        <tr>
                                            <th>PF Eligibility</th>
                                            <td>{{ $employee->pf_eligibility == 'Yes'? 'Yes':'NO' }}</td>
                                            <th>Gratuity Eligibility</th>
                                            <td>{{ $employee->gt_eligibility == 'Yes'? 'Yes':'NO' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pension Eligibility</th>
                                            <td>{{ $employee->pen_eligibility == 'Yes'? 'Yes':'NO' }}</td>
                                            <th>Confirmssss as</th>
                                            <td>{{ $employee->in_probation == 'Y'? 'Regular':'Probation' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Employment Type</th>
                                            <td>{{ $employee->is_contractual == 1 ? 'Regular':'Contractual' }}</td>
                                            <th>Grade</th>
                                            <td>{{ $employee->grade_id??'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <h6>Probation Period: <span style="color:green;font-weight:700">{{ $employee->in_probation == 'N' ? 'Yes':'NO' }}</span></h6>
                                @if($employee->in_probation == 'N')
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
                                                    @if($employee->monthly_grade->allowances && $employee->monthly_grade->allowances->count() > 0)
                                                        @foreach($employee->monthly_grade->allowances as $allowance)
                                                        @php 
                                                            $tAllowance += $allowance->allowance_value;
                                                        @endphp
                                                            
                                                                <div class="allowance_wrap" style="display: flex">
                                                                    <div class="col-4 d-flex justify-content-end">
                                                                        <label for="" class="allowance_label text-blod" style="text-transform:capitalize">{{ $allowance->allowance_label }} : </label>
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
                                                    @if($employee->monthly_grade->deduction && $employee->monthly_grade->deduction->count() > 0)
                                                    @foreach($employee->monthly_grade->deduction as $deduction)
                                                        @php 
                                                            $tDeduction += $deduction->deduction_value;
                                                        @endphp
                                                        <div class="">
                                                            <div class="allowance_wrap" style="display: flex">
                                                                <div class="col-6 justify-content-end">
                                                                    <label for="" class="deduction_label text-blod" style="text-transform:capitalize">{{ $deduction->deduction_label }} : </label>
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
                                @else
                                <div class="row mt-4" id="contractual">
                                    <div class="col-12">
                                        <h6 for="" class="d-block">Consolided Salary: </h6>
                                        <p id="total_salary" class="mb-0">{{ $employee->effective_salary??'N/A' }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane" id="address">
                            <h6 class="text-bold mt-2 mb-2">Present Address</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $employee->prCountry->name??'N/A' }}</td>
                                        <th>Division</th>
                                        <td>{{ $employee->prDivision->name??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $employee->prDistrict->name??'N/A' }}</td>
                                        <th>Upazila/Thana</th>
                                        <td>{{ $employee->prUpzila->name??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Post Office</th>
                                        <td>{{ $employee->pr_post_office??'N/A' }}</td>
                                        <th>Postal Code</th>
                                        <td>{{ $employee->pr_postal_code??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Village/Road/Area/Block/Sector</th>
                                        <td>{{ $employee->pr_area??'N/A' }}</td>
                                        <th>Union/City Corporation/Ward</th>
                                        <td>{{ $employee->pr_u_c_c_w??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>House/Holding No</th>
                                        <td>{{ $employee->pr_house_no??'N/A' }}</td>
                                        <th>Optional</th>
                                        <td>{{ 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <h6 class="text-bold mt-2 mb-2">Permanent Address</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $employee->prCountry->name??'N/A' }}</td>
                                        <th>Division</th>
                                        <td>{{ $employee->parmanentAddress->division->name??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $employee->parmanentAddress->district->name??'N/A' }}</td>
                                        <th>Upazila/Thana</th>
                                        <td>{{ $employee->parmanentAddress->upzila->name??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Post Office</th>
                                        <td>{{ $employee->pa_post_office??'N/A' }}</td>
                                        <th>Postal Code</th>
                                        <td>{{ $employee->pa_postal_code??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Village/Road/Area/Block/Sector</th>
                                        <td>{{ $employee->pa_area??'N/A' }}</td>
                                        <th>Union/City Corporation/Ward</th>
                                        <td>{{ $employee->pa_u_c_c_w??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>House/Holding No</th>
                                        <td>{{ $employee->pa_house_no??'N/A' }}</td>
                                        <th>Optional</th>
                                        <td>{{ 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="education">
                            <h6 class="text-bold mt-2 mb-2">JSC or Equivalent Level</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Examination</th>
                                        <td>{{ $employee->education_jsc->examination??'N/A' }}</td>
                                        <th>Board</th>
                                        <td>{{ $employee->education_jsc->board??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Board Roll</th>
                                        <td>{{ $employee->education_jsc->roll??'N/A' }}</td>
                                        <th>Result</th>
                                        <td>{{ $employee->education_jsc->result??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Passing Year</th>
                                        <td>{{ $employee->education_jsc->passing_year??'N/A' }}</td>
                                        <th>School/College</th>
                                        <td>{{ $employee->education_jsc->institute??'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <h6 class="mt-2 mb-2">SSC or Equivalent Level</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Examination</th>
                                        <td>{{ $employee->education_ssc->examination??'N/A' }}</td>
                                        <th>Board</th>
                                        <td>{{ $employee->education_ssc->board??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Board Roll</th>
                                        <td>{{ $employee->education_ssc->roll??'N/A' }}</td>
                                        <th>Result</th>
                                        <td>{{ $employee->education_ssc->result??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Passing Year</th>
                                        <td>{{ $employee->education_ssc->passing_year??'N/A' }}</td>
                                        <th>School/College</th>
                                        <td>{{ $employee->education_ssc->institute??'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <h6 class="text-bold mt-2 mb-2">HSC or Equivalent Level</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Examination</th>
                                        <td>{{ $employee->education_hsc->examination??'N/A' }}</td>
                                        <th>Board</th>
                                        <td>{{ $employee->education_hsc->board??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Board Roll</th>
                                        <td>{{ $employee->education_hsc->roll??'N/A' }}</td>
                                        <th>Result</th>
                                        <td>{{ $employee->education_hsc->result??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Passing Year</th>
                                        <td>{{ $employee->education_hsc->passing_year??'N/A' }}</td>
                                        <th>School/College</th>
                                        <td>{{ $employee->education_hsc->institute??'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <h6 class="mt-2 mb-2">Graduation or Equivalent Level</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Examination</th>
                                        <td>{{ $employee->education_graduation->examination??'N/A' }}</td>
                                        <th>Board</th>
                                        <td>{{ $employee->education_graduation->board??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Board Roll</th>
                                        <td>{{ $employee->education_graduation->roll??'N/A' }}</td>
                                        <th>Result</th>
                                        <td>{{ $employee->education_graduation->result??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Passing Year</th>
                                        <td>{{ $employee->education_graduation->passing_year??'N/A' }}</td>
                                        <th>School/College</th>
                                        <td>{{ $employee->education_graduation->institute??'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <h6 class="text-bold mt-2 mb-2">Masters or Equivalent Level</h6>
                            <div class="table-responsive">
                                <table class="table table-hover view-data table-bordered" id="">
                                    <tr>
                                        <th>Examination</th>
                                        <td>{{ $employee->education_masters->examination??'N/A' }}</td>
                                        <th>Board</th>
                                        <td>{{ $employee->education_masters->board??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Board Roll</th>
                                        <td>{{ $employee->education_masters->roll??'N/A' }}</td>
                                        <th>Result</th>
                                        <td>{{ $employee->education_masters->result??'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Passing Year</th>
                                        <td>{{ $employee->education_masters->passing_year??'N/A' }}</td>
                                        <th>School/College</th>
                                        <td>{{ $employee->education_masters->institute??'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            @if($employee->education_professional->count() > 0)
                                @foreach($employee->education_professional as $professional)
                                    <h6 class="text-bold mt-2 mb-2">Professional/Other Experiences {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Designation/Post</th>
                                                <td>{{ $professional->designation??'N/A' }}</td>
                                                <th>Organization Name</th>
                                                <td>{{ $professional->organization??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Responsibilities</th>
                                                <td>{{ $professional->responsibilities??'N/A' }}</td>
                                                <th>From & To</th>
                                                <td>{{ $professional->from_date??'N/A' }} To {{ $professional->to_date??'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Professional/Other Experiences</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>
                        <div class="tab-pane" id="experience">
                            @if($employee->education_professional->count() > 0)
                                @foreach($employee->experiences as $experience)
                                    <h6 class="text-bold mt-2 mb-2">Experience Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Company Name</th>
                                                <td>{{ $experience->company_name??'N/A' }}</td>
                                                <th>Job Position</th>
                                                <td>{{ $experience->experienceJobPosition->name??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Company Location</th>
                                                <td>{{ $experience->company_location??'N/A' }}</td>
                                                <th>Project Name</th>
                                                <td>{{ $experience->project_name??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Job Responsibility</th>
                                                <td>{{ $experience->job_responsibility??'N/A' }}</td>
                                                <th>From & To</th>
                                                <td>{{ $experience->from_date??'N/A' }} To {{ $experience->to_date??'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Experience Info</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>

                        <div class="tab-pane" id="family">
                            <!-- Gurantor Info start -->
                            @if($employee->RelationDetails->count() > 0)
                                @foreach($employee->RelationDetails as $RelationDetail)
                                    <h6 class="text-bold mt-2 mb-2">Relation Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Relationship</th>
                                                <td>{{ $RelationDetail->relationship??'N/A' }}</td>
                                                <th>Name</th>
                                                <td>{{ $RelationDetail->relation_name??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Occupation</th>
                                                <td>{{ $RelationDetail->relation_occupation??'N/A' }}</td>
                                                <th>Contact Info</th>
                                                <td>{{ $RelationDetail->relation_contact??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>{{ $RelationDetail->relation_dob??'N/A' }}</td>
                                                <th>Optional</th>
                                                <td>{{ 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Relation Info</h6>
                                <p>Data not Found</p>
                            @endif
                            <!-- Gurantor Info end -->
                            <!-- Gurantor Info start -->
                            @if($employee->GurantorDetails->count() > 0)
                                @foreach($employee->GurantorDetails as $GurantorDetail)
                                    <h6 class="text-bold mt-2 mb-2">Gurantor Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $GurantorDetail->gurantor_name??'N/A' }}</td>
                                                <th>Occupation</th>
                                                <td>{{ $GurantorDetail->gurantor_occupation??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact Info</th>
                                                <td>{{ $GurantorDetail->gurantor_contact??'N/A' }}</td>
                                                <th>Relation</th>
                                                <td>{{ $GurantorDetail->father??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Profile Picture</th>
                                                <td>
                                                    <img class="img-fluid img-circle"
                                                        src="{{ !empty($GurantorDetail->images) ? asset('guarantor_image/' . $GurantorDetail->images) : asset('assets/employee/default-user.jpg') }}"
                                                        alt="Employee signature"
                                                        style="margin: 0 auto; padding: 3px;width: 100px; height:100px;">
                                                </td>
                                                <th>Signature Upload</th>
                                                <td>
                                                    <img class="img-fluid img-circle"
                                                        src="{{ !empty($GurantorDetail->signature) ? asset('guarantor_signature/' . $GurantorDetail->signature) : asset('assets/employee/default-user.jpg') }}"
                                                        alt="Employee signature"
                                                        style="margin: 0 auto; padding: 3px;width: 100px; height:100px;">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Gurantor Info</h6>
                                <p>Data not Found</p>
                            @endif
                            <!-- Gurantor Info End -->
                            <!-- Referee Info start -->
                            @if($employee->RelationDetails->count() > 0)
                                @foreach($employee->RefereeDetails as $RefereeDetail)
                                    <h6 class="text-bold mt-2 mb-2">Referee Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $RefereeDetail->referee_name??'N/A' }}</td>
                                                <th>Organization</th>
                                                <td>{{ $RefereeDetail->referee_organization_id??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Occupation</th>
                                                <td>{{ $RefereeDetail->referee_occupation??'N/A' }}</td>
                                                <th>Contact Info</th>
                                                <td>{{ $RefereeDetail->referee_contact??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $RefereeDetail->email??'N/A' }}</td>
                                                <th>Optional</th>
                                                <td> {{ 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Referee Info</h6>
                                <p>Data not Found</p>
                            @endif
                            <!-- Referee Info end -->
                        </div>
                        <!-- Journal Info start -->
                        <div class="tab-pane" id="otherInfo">
                            @if($employee->journals->count() > 0)
                                @foreach($employee->journals as $journal)
                                    <h6 class="text-bold mt-2 mb-2">Journal Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Title</th>
                                                <td>{{ $journal->title??'N/A' }}</td>
                                                <th>Publication/Publisher</th>
                                                <td>{{ $journal->publication??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Publication Date</th>
                                                <td>{{ $journal->publication_date??'N/A' }}</td>
                                                <th>Author</th>
                                                <td>{{ $journal->author??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Publication URL</th>
                                                <td>{{ $journal->publication_url??'N/A' }}</td>
                                                <th>Optional</th>
                                                <td>{{ 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Journal Info</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>
                        <!-- Journal Info end -->
                        <!-- Nominee Info start -->
                        <div class="tab-pane" id="nominee">
                            @if($employee->nominees->count() > 0)
                                @foreach($employee->nominees as $nominee)
                                    <h6 class="text-bold mt-2 mb-2">Nominee Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Nominee Name</th>
                                                <td>{{ $nominee->name??'N/A' }}</td>
                                                <th>Relationship</th>
                                                <td>{{ $nominee->nomineeRelationship->name??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>{{ $nominee->dob??'N/A' }}</td>
                                                <th>NID/Birth Registration No</th>
                                                <td>{{ $nominee->author??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $nominee->permanent_address??'N/A' }}</td>
                                                <th>Percentage</th>
                                                <td>{{ $nominee->percentage??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Profile Picture</th>
                                                <td>
                                                    <img class="img-fluid img-circle"
                                                        src="{{ !empty($nominee->picture_url) ? asset('nominee_picture/' . $nominee->picture_url) : asset('assets/employee/default-user.jpg') }}"
                                                        alt="Employee signature"
                                                        style="margin: 0 auto; padding: 3px;width: 100px; height:100px;">
                                                </td>
                                                <th>Signature Upload</th>
                                                <td>
                                                    <img class="img-fluid img-circle"
                                                        src="{{ !empty($nominee->signature) ? asset('nominee_signature/' . $nominee->signature) : asset('assets/employee/default-user.jpg') }}"
                                                        alt="nominee signature"
                                                        style="margin: 0 auto; padding: 3px;width: 100px; height:100px;">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Nominee Info</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>
                        <!-- Nominee Info end -->
                        <!-- Emergency Info start -->
                        <div class="tab-pane" id="emergency_contact">
                            @if($employee->getContact->count() > 0)
                            {{-- {{ logger($employee->getContact->toArray()) }} --}}
                                @foreach($employee->getContact as $contact)
                                    <h6 class="text-bold mt-2 mb-2">Emergency Contact Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Emergency Contact Person Name</th>
                                                <td>{{ $contact->e_contact_person_name??'N/A' }}</td>
                                                <th>Emergency Contact Person Number</th>
                                                <td>{{ $contact->e_contact_person_number??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Emergency Contact Person Relationship</th>
                                                <td>{{ $contact->contactRelationship->name??'N/A' }}</td>
                                                <th>Emergency Contact Person Email</th>
                                                <td>{{ $contact->e_contact_person_email??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Emergency Contact Person Address</th>
                                                <td>{{ $contact->e_contact_person_address??'N/A' }}</td>
                                                <th>Optional</th>
                                                <td>{{ 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Emergency Contact Info</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>
                        <!-- Emergency Info end -->
                        <!-- Training Info start -->
                        <div class="tab-pane" id="trainingInfo">
                            @if($employee->getTraining->count() > 0)
                                @foreach($employee->getTraining as $training)
                                    <h6 class="text-bold mt-2 mb-2">Training Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Course Title</th>
                                                <td>{{ $training->course_title??'N/A' }}</td>
                                                <th>Course Description</th>
                                                <td>{{ $training->course_description??'N/A' }}</td>
                                                
                                            </tr>
                                            <tr>
                                                <th>Course Start Date</th>
                                                <td>{{ $training->course_start_date??'N/A' }}</td>
                                                <th>Course End Date</th>
                                                <td>{{ $training->course_end_date??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Training Type</th>
                                                <td>{{ $training->training_type??'N/A' }}</td>
                                                <th>Institute Name</th>
                                                <td>{{ $training->institute_name??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Institute Address</th>
                                                <td>{{ $training->institute_address??'N/A' }}</td>
                                                <th>Result</th>
                                                <td>{{ $training->result??'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>{{ $training->year??'N/A' }}</td>
                                                <th>Optional</th>
                                                <td>{{ 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Training Info</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>
                        <!-- Training Info end -->
                        <!-- Disease Info start -->
                        <div class="tab-pane" id="disease">
                            @if($employee->getDiseaseHist->count() > 0)
                                @foreach($employee->getDiseaseHist as $disease)
                                    <h6 class="text-bold mt-2 mb-2">Disease Info {{ $loop->index + 1 }}</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover view-data table-bordered" id="">
                                            <tr>
                                                <th>Disease Name</th>
                                                <td>{{ $disease->getDiseaseName->name??'N/A' }}</td>
                                                <th>Description</th>
                                                <td>{{ $disease->disease_description??'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="text-bold mt-2 mb-2">Disease Info</h6>
                                <p>Data not Found</p>
                            @endif
                        </div>
                        <!-- Disease Info end -->
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> View Attachment </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="viewAttachment" width="770px" height="660px">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('document').ready(function() {
            //fetch duration of date
            let birth_date = moment($('#dob').html(), 'DD-MM-YYYY');
            let lpr_date = moment($('#lpr').html(), 'DD-MM-YYYY');
            let to_date = moment();
            console.log('f: ' + birth_date + ' l: ' + lpr_date + ' t: ' + to_date)

            if (birth_date.isValid() && to_date.isValid()) {
                $('#age').html(calculate_difference(birth_date, to_date));
            } else {
                console.log('AGE: Invalid date(s).')
            }

            if (lpr_date.isValid() && to_date.isValid()) {
                $('#lpr').html(calculate_difference(to_date, lpr_date));
            } else {
                console.log('LPR: Invalid date(s).')
            }

            function calculate_difference(from, to) {

                let output = '';
                let duration = moment.duration(to.diff(from));
                if (duration.years() === 0 && duration.months() === 0) {
                    output = duration.days() + ' days';
                } else if (duration.years() === 0 && duration.months() !== 0) {
                    output = duration.months() + ' months ' + duration.days() + ' days';
                } else {
                    output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days() +
                        ' days';
                }
                console.log('from: ' + from + ' to: ' + to + ' output: ' + output);
                return output;
            }
        });

        //show file
        function getAttachment(getId) {
            if (getId == 1) {
                var source = $("#attachment-source1").val();
            } else if (getId == 2) {
                var source = $("#attachment-source2").val();
            } else if (getId == 3) {
                var source = $("#attachment-source3").val();
            } else if (getId == 4) {
                var source = $("#attachment-source4").val();
            } else if (getId == 5) {
                var source = $("#attachment-source5").val();
            } else if (getId == 6) {
                var source = $("#attachment-source6").val();
            } else if (getId == 7) {
                var source = $("#attachment-source7").val();
            } else if (getId == 8) {
                var source = $("#attachment-source8").val();
            } else if (getId == 9) {
                var source = $("#attachment-source9").val();
            } else if (getId == 10) {
                var source = $("#attachment-source10").val();
            } else if (getId == 11) {
                var source = $("#attachment-source11").val();
            } else if (getId == 12) {
                var source = $("#attachment-source12").val();
            } else if (getId == 13) {
                var source = $("#attachment-source13").val();
            } else if (getId == 14) {
                var source = $("#attachment-source14").val();
            }

            $('#viewAttachment').attr('src', source);
        }
    </script>
@endsection
