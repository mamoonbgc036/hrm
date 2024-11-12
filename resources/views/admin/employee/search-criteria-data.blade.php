<form id="form" action="javascript:{{--{{route('employee.search')}}--}}">
    @csrf
    <div class="row text-uppercase">
        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="name">Name</label>
                <input class="form-control" id="name" type="text" name="name" value="{{request('name')}}">
            </div>
        </div>

        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="pin_no">OLD PIN</label>
                <input class="form-control" id="pin_no" type="text" name="pin_no" value="{{request('pin_no')}}">
            </div>
        </div>

        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="new_pin">NEW PIN</label>
                <input class="form-control" id="new_pin" type="text" name="new_pin" value="{{request('new_pin')}}">
            </div>
        </div>

        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="mobile_no">Mobile Number</label>
                <input class="form-control" id="mobile_no" type="text" name="mobile_no" value="{{request('mobile_no')}}">
            </div>
        </div>

        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <div class="row">
                    <div class="col-5">
                        <label class="col-form-label col-form-label-sm" for="batch_no">Batch No</label>
                        <select id="" class="form-control @error('batch_no') is-invalid @enderror" name="batch_no" title="">
                            <option value="">CHOOSE ONE</option>
                            @foreach($batch as $value)
                                <option value="{{ $value->name }}" {{request('batch_no')==$value->name?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->name) }}</option>
                            @endforeach
                        </select>
                        @error('batch_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-7">
                        <label class="col-form-label col-form-label-sm" for="batch_no_ext">BATCH Extension</label>
                        <input type="text" class="form-control @error('batch_no_ext') is-invalid @enderror" name="batch_no_ext" value="{{request('batch_no_ext')}}" placeholder="Ex-40">
                        @error('batch_no_ext')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="station_name">Office/Station</label>
                <select class="form-control text-uppercase Select2" name="police_station_id" id="police_station_id">
                    <option value="">SELECT OFFICE/STATION</option>
                    @foreach($stations as $value)
                        <option value="{{$value->id}}" {{request('police_station_id')==$value->id?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->name) }} [{{$value->code}}]</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="station_code">Office/Station Code</label>
                <input class="form-control" id="station_code" type="text" name="station_code" value="{{request('station_code')}}">
                <input type="hidden" name="station_code_field" value="Station-code-police_station_id">
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="f_name">
            <label class="col-form-label col-form-label-sm" for="f_name">Father's Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="f_name_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="f_name" type="text" name="f_name" value="{{request('f_name')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('f_name')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="m_name">
            <label class="col-form-label col-form-label-sm" for="m_name">Mother's Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="m_name_select" style="font-size: larger" id="m_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="m_name" type="text" name="m_name" value="{{ request('m_name')}}" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('m_name')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="designation_id">
            <label class="col-form-label col-form-label-sm" for="designation_id">Designation</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="designation_id_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" id="designation_id" name="designation_id">
                    <option value="">SELECT DESIGNATION</option>
                    @foreach($designations as $value)
                        <option value="{{$value->id}}" {{request('designation_id')==$value->id?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->en_name) }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('designation_id')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="grade_id">
            <label class="col-form-label col-form-label-sm" for="grade_id">Grade ID</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="grade_id_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" id="grade_id" name="grade_id">
                    <option value="">SELECT GRADE</option>
                    @foreach($grades as $value)
                        <option value="{{$value->id}}" {{request('grade_id')==$value->id?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->grade) }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('grade_id')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="station_name">
            <label class="col-form-label col-form-label-sm" for="station_name">Office/Station Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="station_name_select" style="font-size: larger" id="station_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="station_name" type="text" name="station_name" value="{{ request('station_name')}}">
                <input type="hidden" name="station_name_field" value="Station-name-police_station_id">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('station_name')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="station_mobile">
            <label class="col-form-label col-form-label-sm" for="station_mobile">Office/Station Mobile</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="station_mobile_select" style="font-size: larger" id="station_mobile_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="station_mobile" type="text" name="station_mobile" value="{{ request('station_mobile')}}">
                <input type="hidden" name="station_mobile_field" value="Station-mobile-police_station_id">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('station_mobile')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="station_division">
            <label class="col-form-label col-form-label-sm" for="division_id">Office/Station Division</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="division_id_select" style="font-size: larger" id="division_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="division_id" id="division_id">
                    <option value="">SELECT DIVISION</option>
                    @foreach($divisions as $value)
                        <option value="{{$value->id}}" {{request('division_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('station_division')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="station_district">
            <label class="col-form-label col-form-label-sm" for="district_id">Office/Station District</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="district_id_select" style="font-size: larger" id="district_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="district_id" id="district_id">
                    <option value="">SELECT DISTRICT</option>
                    @foreach($districts as $value)
                        <option value="{{$value->id}}" {{request('district_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('station_district')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="station_thana">
            <label class="col-form-label col-form-label-sm" for="upazila_id">Office/Station Upazila/Thana</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="upazila_id_select" style="font-size: larger" id="upazila_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="upazila_id" id="upazila_id">
                    <option value="">SELECT UPAZILA/THANA</option>
                    @foreach($thanas as $value)
                        <option value="{{$value->id}}" {{request('upazila_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('station_thana')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="is_attached">
            <label class="col-form-label col-form-label-sm" for="is_attached_to_station_or_office">IS ATTACHED TO STATION/OFFICE</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="is_attached_to_station_or_office_select" style="font-size: larger" id="is_attached_to_station_or_office_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="is_attached_to_station_or_office" id="is_attached_to_station_or_office">
                    <option value="">SELECT ONE</option>
                    <option value="YES" {{request('is_attached_to_station_or_office')=='YES'?'selected':''}}>YES</option>
                    <option value="NO" {{request('is_attached_to_station_or_office')=='NO'?'selected':''}}>NO</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('is_attached')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="attached_designation_id">
            <label class="col-form-label col-form-label-sm" for="attached_designation_id">Attached Designation</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="attached_designation_id_select" style="font-size: larger" id="attached_designation_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" id="attached_designation_id" name="attached_designation_id">
                    <option value="">SELECT DESIGNATION</option>
                    @foreach($designations as $value)
                        <option value="{{$value->id}}" {{request('attached_designation_id')==$value->id?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->en_name) }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('attached_designation_id')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="attached_station_name">
            <label class="col-form-label col-form-label-sm" for="attached_station_name">Attached Office/Station Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="attached_station_name_select" style="font-size: larger" id="attached_station_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="attached_station_name" type="text" name="attached_station_name" value="{{ request('attached_station_name')}}">
                <input type="hidden" name="attached_station_name_field" value="Station-name-police_station_id">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('attached_station_name')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="attached_station_division">
            <label class="col-form-label col-form-label-sm" for="attached_division_id">Attached Office/Station Division</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="attached_division_id_select" style="font-size: larger" id="attached_division_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="attached_division_id" id="attached_division_id">
                    <option value="">SELECT DIVISION</option>
                    @foreach($divisions as $value)
                        <option value="{{$value->id}}" {{request('attached_division_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('attached_station_division')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="attached_station_district">
            <label class="col-form-label col-form-label-sm" for="attached_district_id">Attached Office/Station District</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="attached_district_id_select" style="font-size: larger" id="attached_district_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="attached_district_id" id="attached_district_id">
                    <option value="">SELECT DISTRICT</option>
                    @foreach($districts as $value)
                        <option value="{{$value->id}}" {{request('attached_district_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('attached_station_district')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="attached_station_thana">
            <label class="col-form-label col-form-label-sm" for="attached_upazila_id">Attached Office/Station Upazila</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="attached_upazila_id_select" style="font-size: larger" id="attached_upazila_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="attached_upazila_id" id="attached_upazila_id">
                    <option value="">SELECT UPAZILA/THANA</option>
                    @foreach($thanas as $value)
                        <option value="{{$value->id}}" {{request('attached_upazila_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('attached_station_thana')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="gpf_no">
            <label class="col-form-label col-form-label-sm" for="gpf_no">GPF No</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="gpf_no_select" style="font-size: larger" id="gpf_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="gpf_no" type="text" name="gpf_no" value="{{request('gpf_no')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('gpf_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="religion">
            <label class="col-form-label col-form-label-sm" for="religion">Religion</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="religion_select" style="font-size: larger" id="religion_select_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="religion" id="religion">
                    <option value="" >SELECT ONE</option>
                    <option value="Islam" {{request('religion')=='Islam'?'selected':''}}>ISLAM</option>
                    <option value="Hinduism" {{request('religion')=='Hinduism'?'selected':''}}>HINDUISM</option>
                    <option value="Buddhism" {{request('religion')=='Buddhism'?'selected':''}}>BUDDHISM</option>
                    <option value="Christianity" {{request('religion')=='Christianity'?'selected':''}}>CHRISTIANITY</option>
                    <option value="Other religions" {{request('religion')=='Other religions'?'selected':''}}>OTHER RELIGION</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('religion')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="quota">
            <label class="col-form-label col-form-label-sm" for="quota">Quota</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="quota_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="text-uppercase custom-select" name="quota" id="quota">
                    <option value="">SELECT QUOTA</option>
                    @foreach($quotas as $quota)
                        <option value="{{$quota->name}}" {{request('quota') ==$quota->name?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($quota->name) }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('quota')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="nid_no">
            <label class="col-form-label col-form-label-sm" for="nid_no">NID Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="nid_no_select" style="font-size: larger" id="nid_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="name" type="text" name="nid_no" value="{{request('nid_no')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('nid_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="blood_group">
            <label class="col-form-label col-form-label-sm" for="blood_group">Blood Group</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="blood_group_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select" id="blood_group" name="blood_group">
                    <option value="">SELECT BLOOD GROUP</option>
                    <option value="A+" {{request('blood_group')=='A+'?'selected':''}}>A+</option>
                    <option value="A-" {{request('blood_group')=='A-'?'selected':''}}>A-</option>
                    <option value="B+" {{request('blood_group')=='B+'?'selected':''}}>B+</option>
                    <option value="B-" {{request('blood_group')=='B-'?'selected':''}}>B-</option>
                    <option value="O+" {{request('blood_group')=='O+'?'selected':''}}>O+</option>
                    <option value="O-" {{request('blood_group')=='O-'?'selected':''}}>O-</option>
                    <option value="AB+" {{request('blood_group')=='AB+'?'selected':''}}>AB+</option>
                    <option value="AB-" {{request('blood_group')=='AB-'?'selected':''}}>AB-</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('blood_group')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="gender">
            <label class="col-form-label" for="gender">Gender</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="gender_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select" name="gender" id="gender">
                    <option value="">SELECT GENDER</option>
                    <option value="Male" {{request('gender')=='Male'?'selected':''}}>MALE</option>
                    <option value="Female" {{request('gender')=='Female'?'selected':''}}>FEMALE</option>
                    <option value="Other" {{request('gender')=='Other'?'selected':''}}>OTHER</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('gender')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="passport_no">
            <label class="col-form-label col-form-label-sm" for="passport_no">Passport No.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="passport_no_select" style="font-size: larger" id="passport_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="passport_no" type="text" name="passport_no" value="{{request('passport_no')}}" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('passport_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="marital_status">
            <label class="col-form-label col-form-label-sm" for="marital_status">Marital Status</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="marital_status_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase " id="marital_status" name="marital_status">
                    <option value="">SELECT STATUS</option>
                    <option value="single" {{request('marital_status')=='single'?'selected':''}}>SINGLE</option>
                    <option value="married" {{request('marital_status')=='married'?'selected':''}}>MARRIED</option>
                    <option value="separate" {{request('marital_status')=='separate'?'selected':''}}>SEPARATE</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('marital_status')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="id_card_no">
            <label class="col-form-label col-form-label-sm" for="card_no">Id Card Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="id_card_no_select" style="font-size: larger" id="id_card_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="id_card_no" type="text" name="id_card_no" value="{{request('id_card_no')}}" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('id_card_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="welfare_no">
            <label class="col-form-label col-form-label-sm" for="welfare_no">Welfare Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="welfare_no_select" style="font-size: larger" id="welfare_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="welfare_no" type="text" name="welfare_no" value="{{request('welfare_no')}}" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('welfare_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="womens_welfare_no">
            <label class="col-form-label col-form-label-sm" for="womens_welfare_no">Women's elfare Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="womens_welfare_no_select" style="font-size: larger" id="womens_welfare_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="womens_welfare_no" type="text" name="womens_welfare_no" value="{{request('womens_welfare_no')}}" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('womens_welfare_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="e_tin_no">
            <label class="col-form-label col-form-label-sm" for="e_tin_no">E-TIN Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="e_tin_no_select" style="font-size: larger" id="e_tin_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="e_tin_no" type="text" name="e_tin_no" value="{{request('e_tin_no')}}" >
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('e_tin_no')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="birth_district">
            <label class="col-form-label col-form-label-sm" for="birth_district">District of Birth</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="birth_district_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="birth_district" id="birth_district">
                    <option value="">SELECT DISTRICT</option>
                    @foreach($districts as $value)
                        <option value="{{$value->name}}" {{request('birth_district')==$value->name?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->name) }}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('birth_district')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="disability_code">
            <label class="col-form-label col-form-label-sm" for="disability_code">Disability Code</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="disability_code_select" style="font-size: larger" id="disability_code_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="disability_code" type="text" name="disability_code" value="{{request('disability_code')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('disability_code')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="age">
            <label class="col-form-label col-form-label-sm" for="age">Age</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="age_select" style="font-size: larger" id="age_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="age" type="text" placeholder="Enter year" name="age" value="{{request('age')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('age')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="birth_date">
            <label class="col-form-label col-form-label-sm" for="birth_date">Date of Birth</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="birth_date_select" style="font-size: larger" id="birth_date_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" name="birth_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{request('birth_date')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('birth_date')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="join_date">
            <label class="col-form-label col-form-label-sm" for="join_date">Date of Join</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="join_date_select" style="font-size: larger" id="join_date_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" name="join_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{request('join_date')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('join_date')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="lpr_date">
            <label class="col-form-label col-form-label-sm" for="lpr_date">Date of PRL</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="lpr_date_select" style="font-size: larger" id="lpr_date_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" name="lpr_date" type="text" placeholder="DD-MM-YYYY" autocomplete="off" value="{{request('lpr_date')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('lpr_date')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="spouse_name">
            <label class="col-form-label col-form-label-sm" for="spouse_name">Spouse Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="spouse_name_select" style="font-size: larger" id="spouse_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="spouse_name" type="text" name="spouse_name" value="{{request('spouse_name')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('spouse_name')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="spouse_tin">
            <label class="col-form-label col-form-label-sm" for="spouse_tin">Spouse TIN No</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="spouse_tin_select" style="font-size: larger" id="spouse_tin_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="spouse_tin" type="text" name="spouse_tin" value="{{request('spouse_tin')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('spouse_tin')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="spouse_profession">
            <label class="col-form-label col-form-label-sm" for="spouse_profession">Spouse Profession</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="spouse_profession_select" style="font-size: larger" id="spouse_profession_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="spouse_profession" type="text" name="spouse_profession" value="{{request('spouse_profession')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('spouse_profession')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="spouse_district">
            <label class="col-form-label col-form-label-sm" for="spouse_district">Spouse Home District</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="spouse_district_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="spouse_district" id="spouse_district">
                    <option value="">SELECT DISTRICT</option>
                    @foreach($districts as $value)
                        <option value="{{$value->name}}" {{request('spouse_district')==$value->name?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->name) }}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('spouse_district')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="spouse_child">
            <label class="col-form-label col-form-label-sm" for="spouse_total_child">Spouse Children</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="spouse_total_child_select" style="font-size: larger" id="spouse_total_child_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="spouse_total_child" type="text" name="spouse_total_child" value="{{request('spouse_total_child')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('spouse_child')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="home_contact">
            <label class="col-form-label col-form-label-sm" for="home_contact_number">Home Contact Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="home_contact_number_select" style="font-size: larger" id="home_contact_number_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="home_contact_number" type="text" name="home_contact_number" value="{{request('home_contact_number')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('home_contact')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="email">
            <label class="col-form-label col-form-label-sm" for="email">Email Address</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="email_select" style="font-size: larger" id="email_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="email" type="text" name="email" value="{{request('email')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('email')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="emergency_person_name">
            <label class="col-form-label col-form-label-sm" for="e_contact_person_name">Emergency Contact Person Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="e_contact_person_name_select" style="font-size: larger" id="e_contact_person_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="e_contact_person_name" type="text" name="e_contact_person_name" value="{{request('e_contact_person_name')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('emergency_person_name')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="emergency_person_number">
            <label class="col-form-label col-form-label-sm" for="e_contact_person_number">Emergency Contact Person Number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="e_contact_person_number_select" style="font-size: larger" id="e_contact_person_number_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="e_contact_person_number" type="text" name="e_contact_person_number" value="{{request('e_contact_person_number')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('emergency_person_number')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="emergency_person_relation">
            <label class="col-form-label col-form-label-sm" for="e_contact_person_relation">Emergency Contact Person Relation</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="e_contact_person_relation_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="e_contact_person_relation" id="e_contact_person_relation">
                    <option value="">SELECT RELATIONSHIP</option>
                    @foreach($relationships as $value)
                        <option value="{{$value->id}}" {{request('e_contact_person_relation')==$value->id?'selected':''}}>{{ App\Classes\StringConversion::stringToUpper($value->name) }}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('emergency_person_relation')">X</button>
                </div>
            </div>
        </div>

        {{---------PRESENT ADDRESS-------start---------}}
        <div class="col-md-3 col-sm-4" v-if="present_division">
            <label class="col-form-label col-form-label-sm" for="present_address_division_id">Present Address Division</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_division_id_select" style="font-size: larger" id="present_address_division_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="present_address_division_id" id="present_address_division_id">
                    <option value="">SELECT DIVISION</option>
                    @foreach($divisions as $value)
                        <option value="{{$value->id}}" {{request('present_address_division_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_division')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_district">
            <label class="col-form-label col-form-label-sm" for="present_address_district_id">Present Address District</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_district_id_select" style="font-size: larger" id="present_address_district_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="present_address_district_id" id="present_address_district_id">
                    <option value="">SELECT DISTRICT</option>
                    @foreach($districts as $value)
                        <option value="{{$value->id}}" {{request('present_address_district_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_district')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_thana">
            <label class="col-form-label col-form-label-sm" for="present_address_upazila_id">Present Address Upazila</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_upazila_id_select" style="font-size: larger" id="present_address_upazila_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="present_address_upazila_id" id="present_address_upazila_id">
                    <option value="">SELECT UPAZILA</option>
                    @foreach($thanas as $value)
                        <option value="{{$value->id}}" {{request('present_address_upazila_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_thana')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_post_office">
            <label class="col-form-label col-form-label-sm" for="present_address_post_office">Present Address Post Office</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_post_office_select" style="font-size: larger" id="present_address_post_office_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="present_address_post_office" type="text" name="present_address_post_office" value="{{request('present_address_post_office')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_post_office')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_postal_code">
            <label class="col-form-label col-form-label-sm" for="present_address_postal_code">Present Address Postal Code</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_postal_code_select" style="font-size: larger" id="present_address_postal_code_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="present_address_postal_code" type="text" name="present_address_postal_code" value="{{request('present_address_postal_code')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_address_postal_code')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_village">
            <label class="col-form-label col-form-label-sm" for="present_address_area">Present Address Village</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_area_select" style="font-size: larger" id="present_address_area_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="present_address_area" type="text" name="present_address_area" value="{{request('present_address_area')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_village')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_uccw">
            <label class="col-form-label col-form-label-sm" for="present_address_u_c_c_w">Present Address Union/{{--City-Corporation/--}}Ward</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_u_c_c_w_select" style="font-size: larger" id="present_address_u_c_c_w_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="present_address_u_c_c_w" type="text" name="present_address_u_c_c_w" value="{{request('present_address_u_c_c_w')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_uccw')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="present_house_no">
            <label class="col-form-label col-form-label-sm" for="present_address_house_no">Present Address House No</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="present_address_house_no_select" style="font-size: larger" id="present_address_house_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="present_address_house_no" type="text" name="present_address_house_no" value="{{request('present_address_house_no')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('present_house_no')">X</button>
                </div>
            </div>
        </div>
        {{---------PRESENT ADDRESS-------end---------}}

        {{---------PERMANENT ADDRESS-------start---------}}
        <div class="col-md-3 col-sm-4" v-if="permanent_division">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_division_id">Permanent Address Division</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_division_id_select" style="font-size: larger" id="parmanent_address_division_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="parmanent_address_division_id" id="parmanent_address_division_id">
                    <option value="">SELECT DIVISION</option>
                    @foreach($divisions as $value)
                        <option value="{{$value->id}}" {{request('parmanent_address_division_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_division')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_district">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_district_id">Permanent Address District</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_district_id_select" style="font-size: larger" id="parmanent_address_district_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="parmanent_address_district_id" id="parmanent_address_district_id">
                    <option value="">SELECT DISTRICT</option>
                    @foreach($districts as $value)
                        <option value="{{$value->id}}" {{request('parmanent_address_district_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_district')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_thana">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_upazila_id">Permanent Address Upazila</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_upazila_id_select" style="font-size: larger" id="parmanent_address_upazila_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="parmanent_address_upazila_id" id="parmanent_address_upazila_id">
                    <option value="">SELECT UPAZILA</option>
                    @foreach($thanas as $value)
                        <option value="{{$value->id}}" {{request('parmanent_address_upazila_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_thana')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_post_office">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_post_office">Permanent Address Post Office</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_post_office_select" style="font-size: larger" id="parmanent_address_post_office_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="parmanent_address_post_office" type="text" name="parmanent_address_post_office" value="{{request('parmanent_address_post_office')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_post_office')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_postal_code">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_postal_code">Permanent Address Postal Code</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_postal_code_select" style="font-size: larger" id="parmanent_address_postal_code_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="parmanent_address_postal_code" type="text" name="parmanent_address_postal_code" value="{{request('parmanent_address_postal_code')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_postal_code')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_village">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_area">Permanent Address Village</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_area_select" style="font-size: larger" id="parmanent_address_area_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="parmanent_address_area" type="text" name="parmanent_address_area" value="{{request('parmanent_address_area')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_village')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_uccw">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_u_c_c_w">Permanent Address Union/{{--City-Corporation/--}}Ward</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_u_c_c_w_select" style="font-size: larger" id="parmanent_address_u_c_c_w_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="parmanent_address_u_c_c_w" type="text" name="parmanent_address_u_c_c_w" value="{{request('parmanent_address_u_c_c_w')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_uccw')">X</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4" v-if="permanent_house_no">
            <label class="col-form-label col-form-label-sm" for="parmanent_address_house_no">Permanent Address House No</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="parmanent_address_house_no_select" style="font-size: larger" id="parmanent_address_house_no_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="parmanent_address_house_no" type="text" name="parmanent_address_house_no" value="{{request('parmanent_address_house_no')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('permanent_house_no')">X</button>
                </div>
            </div>
        </div>
        {{---------PERMANENT ADDRESS-------end---------}}

        <div class="col-md-3 col-sm-4" v-if="award">
            <label class="col-form-label col-form-label-sm" for="award_id">Awards</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="award_id_select" style="font-size: larger" id="award_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="award_id" id="award_id">
                    <option value="">SELECT AWARD</option>
                    @foreach($awards as $value)
                        <option value="{{$value->id}}" {{request('award_id')==$value->id?'selected':''}}>{{$value->award_name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('award')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="achievement">
            <label class="col-form-label col-form-label-sm" for="achievement_id">Achievements</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="achievement_id_select" style="font-size: larger" id="achievement_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="achievement_id" id="achievement_id">
                    <option value="">SELECT ACHIEVEMENT</option>
                    @foreach($achievements as $value)
                        <option value="{{$value->id}}" {{request('achievement_id')==$value->id?'selected':''}}>{{$value->achievement_name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('achievement')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="foreign_training">
            <label class="col-form-label col-form-label-sm" for="foreign_training_id">Abroad Training</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="foreign_training_id_select" style="font-size: larger" id="foreign_training_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="foreign_training_id" id="foreign_training_id">
                    <option value="">SELECT ABROAD TRAINING</option>
                    @foreach($foreign_trainings as $value)
                        <option value="{{$value->id}}" {{request('foreign_training_id')==$value->id?'selected':''}}>{{$value->course_title}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('foreign_training')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="local_training">
            <label class="col-form-label col-form-label-sm" for="local_training_id">Inland Training</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="local_training_id_select" style="font-size: larger" id="local_training_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="local_training_id" id="local_training_id">
                    <option value="">SELECT INLAND TRAINING</option>
                    @foreach($local_trainings as $value)
                        <option value="{{$value->id}}" {{request('local_training_id')==$value->id?'selected':''}}>{{$value->course_title}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('local_training')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="inhouse_training">
            <label class="col-form-label col-form-label-sm" for="inhouse_training_id">Inhouse Training</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="inhouse_training_id_select" style="font-size: larger" id="inhouse_training_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="inhouse_training_id" id="inhouse_training_id">
                    <option value="">SELECT INHOUSE TRAINING</option>
                    @foreach($inhouse_trainings as $value)
                        <option value="{{$value->id}}" {{request('inhouse_training_id')==$value->id?'selected':''}}>{{$value->course_title}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('inhouse_training')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="punishment">
            <label class="col-form-label col-form-label-sm" for="punishment_id">Punishment</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="punishment_id_select" style="font-size: larger" id="punishment_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="punishment_id" id="punishment_id">
                    <option value="">SELECT PUNISHMENT</option>
                    @foreach($punishments as $value)
                        <option value="{{$value->id}}" {{request('punishment_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('punishment')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="leave">
            <label class="col-form-label col-form-label-sm" for="leave_id">Leave</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="leave_id_select" style="font-size: larger" id="leave_id_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="leave_id" id="leave_id">
                    <option value="">SELECT LEAVE</option>
                    @foreach($leaves as $value)
                        <option value="{{$value->id}}" {{request('leave_id')==$value->id?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('leave')">X</button>
                </div>
            </div>
        </div>

        {{-------JSC-------start-------}}
        <div class="col-md-3 col-sm-4" v-if="jsc_examination">
            <label class="col-form-label col-form-label-sm" for="jsc_examination">JSC/Equivalent Exam</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="jsc_examination_select" style="font-size: larger" id="jsc_examination_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="jsc_examination" id="jsc_examination">
                    <option value="">SELECT JSC EXAM</option>
                    @foreach($jsc_examinations as $value)
                        <option value="{{$value->name}}" {{request('jsc_examination')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('jsc_examination')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="jsc_board">
            <label class="col-form-label col-form-label-sm" for="jsc_board">JSC Board</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="jsc_board_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="jsc_board" id="jsc_board">
                    <option value="">SELECT JSC BOARD</option>
                    @foreach($jsc_boards as $value)
                        <option value="{{$value->name}}" {{request('jsc_board')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('jsc_board')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="jsc_roll">
            <label class="col-form-label col-form-label-sm" for="jsc_roll">JSC Roll</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="jsc_roll_select" style="font-size: larger" id="jsc_roll_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="jsc_roll" type="text" name="jsc_roll" value="{{request('jsc_roll')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('jsc_roll')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="jsc_result">
            <label class="col-form-label col-form-label-sm" for="jsc_result">JSC Result</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="jsc_result_select" style="font-size: larger" id="jsc_result_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="jsc_result" type="text" name="jsc_result" value="{{request('jsc_result')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('jsc_result')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="jsc_institute">
            <label class="col-form-label col-form-label-sm" for="jsc_institute">JSC Institute</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="jsc_institute_select" style="font-size: larger" id="jsc_institute_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="jsc_institute" type="text" name="jsc_institute" value="{{request('jsc_institute')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('jsc_institute')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="jsc_passing_year">
            <label class="col-form-label col-form-label-sm" for="jsc_passing_year">JSC Passing Year</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="jsc_passing_year_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="jsc_passing_year" id="jsc_passing_year">
                    <option value="">SELECT JSC YEAR</option>
                    @for($i=date('Y'); $i>=1960; $i--)
                        <option value="{{$i}}" {{request('jsc_passing_year')==$i?'selected':''}}>{{$i}}</option>
                    @endfor()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('jsc_passing_year')">X</button>
                </div>
            </div>
        </div>
        {{-------JSC-------end-------}}

        {{-------SSC-------start-------}}
        <div class="col-md-3 col-sm-4" v-if="ssc_examination">
            <label class="col-form-label col-form-label-sm" for="ssc_examination">SSC/Equivalent Exam</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_examination_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="ssc_examination" id="ssc_examination">
                    <option value="">SELECT SSC EXAM</option>
                    @foreach($ssc_examinations as $value)
                        <option value="{{$value->name}}" {{request('ssc_examination')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_examination')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="ssc_board">
            <label class="col-form-label col-form-label-sm" for="ssc_board">SSC Board</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_board_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="ssc_board" id="ssc_board">
                    <option value="">SELECT SSC BOARD</option>
                    @foreach($ssc_boards as $value)
                        <option value="{{$value->name}}" {{request('ssc_board')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_board')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="ssc_roll">
            <label class="col-form-label col-form-label-sm" for="ssc_roll">SSC Roll</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_roll_select" style="font-size: larger" id="ssc_roll_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="ssc_roll" type="text" name="ssc_roll" value="{{request('ssc_roll')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_roll')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="ssc_result">
            <label class="col-form-label col-form-label-sm" for="ssc_result">SSC Result</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_result_select" style="font-size: larger" id="ssc_result_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="ssc_result" type="text" name="ssc_result" value="{{request('ssc_result')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_result')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="ssc_institute">
            <label class="col-form-label col-form-label-sm" for="ssc_institute">SSC Institute</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_institute_select" style="font-size: larger" id="ssc_institute_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="ssc_institute" type="text" name="ssc_institute" value="{{request('ssc_institute')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_institute')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="ssc_passing_year">
            <label class="col-form-label col-form-label-sm" for="ssc_passing_year">SSC Passing Year</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_passing_year_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="ssc_passing_year" id="ssc_passing_year">
                    <option value="">SELECT SSC YEAR</option>
                    @for($i=date('Y'); $i>=1960; $i--)
                        <option value="{{$i}}" {{request('ssc_passing_year')==$i?'selected':''}}>{{$i}}</option>
                    @endfor()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_passing_year')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="ssc_subject">
            <label class="col-form-label col-form-label-sm" for="ssc_subject">SSC Subject</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="ssc_subject_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="ssc_subject" id="ssc_subject">
                    <option value="">SELECT SSC SUBJECT</option>
                    @foreach($ssc_subjects as $value)
                        <option value="{{$value->name}}" {{request('ssc_subject')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('ssc_subject')">X</button>
                </div>
            </div>
        </div>
        {{-------SSC-------end-------}}

        {{-------HSC-------start-------}}
        <div class="col-md-3 col-sm-4" v-if="hsc_examination">
            <label class="col-form-label col-form-label-sm" for="hsc_examination">HSC/Equivalent Exam</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_examination_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="hsc_examination" id="hsc_examination">
                    <option value="">SELECT HSC EXAM</option>
                    @foreach($hsc_examinations as $value)
                        <option value="{{$value->name}}" {{request('hsc_examination')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_examination')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="hsc_board">
            <label class="col-form-label col-form-label-sm" for="hsc_board">HSC Board</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_board_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="hsc_board" id="hsc_board">
                    <option value="">SELECT HSC BOARD</option>
                    @foreach($hsc_boards as $value)
                        <option value="{{$value->name}}" {{request('hsc_board')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_board')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="hsc_roll">
            <label class="col-form-label col-form-label-sm" for="hsc_roll">HSC Roll</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_roll_select" style="font-size: larger" id="hsc_roll_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="hsc_roll" type="text" name="hsc_roll" value="{{request('hsc_roll')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_roll')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="hsc_result">
            <label class="col-form-label col-form-label-sm" for="hsc_result">HSC Result</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_result_select" style="font-size: larger" id="hsc_result_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="hsc_result" type="text" name="hsc_result" value="{{request('hsc_result')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_result')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="hsc_institute">
            <label class="col-form-label col-form-label-sm" for="hsc_institute">HSC Institute</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_institute_select" style="font-size: larger" id="hsc_institute_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="hsc_institute" type="text" name="hsc_institute" value="{{request('hsc_institute')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_institute')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="hsc_passing_year">
            <label class="col-form-label col-form-label-sm" for="hsc_passing_year">HSC Passing Year</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_passing_year_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="hsc_passing_year" id="hsc_passing_year">
                    <option value="">SELECT HSC YEAR</option>
                    @for($i=date('Y'); $i>=1960; $i--)
                        <option value="{{$i}}" {{request('hsc_passing_year')==$i?'selected':''}}>{{$i}}</option>
                    @endfor()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_passing_year')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="hsc_subject">
            <label class="col-form-label col-form-label-sm" for="hsc_subject">HSC Subject</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="hsc_subject_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="hsc_subject" id="hsc_subject">
                    <option value="">SELECT HSC SUBJECT</option>
                    @foreach($hsc_subjects as $value)
                        <option value="{{$value->name}}" {{request('hsc_subject')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('hsc_subject')">X</button>
                </div>
            </div>
        </div>
        {{-------HSC-------end-------}}

        {{-------Graduation-------start-------}}
        <div class="col-md-3 col-sm-4" v-if="graduation_examination">
            <label class="col-form-label col-form-label-sm" for="graduation_examination">Graduation/Equivalent Exam</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="graduation_examination_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="graduation_examination" id="graduation_examination">
                    <option value="">SELECT GRAD EXAM</option>
                    @foreach($graduation_examinations as $value)
                        <option value="{{$value->name}}" {{request('graduation_examination')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('graduation_examination')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="graduation_duration">
            <label class="col-form-label col-form-label-sm" for="graduation_duration">Graduation Duration</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="graduation_duration_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="graduation_duration" id="graduation_duration">
                    <option value="">SELECT DURATION</option>
                    <option value="01 Year" {{request('graduation_duration')=='01 Year'?'selected':''}}>01 YEAR</option>
                    <option value="02 Years" {{request('graduation_duration')=='02 Years'?'selected':''}}>02 YEARS</option>
                    <option value="03 Years" {{request('graduation_duration')=='03 Years'?'selected':''}}>03 YEARS</option>
                    <option value="04 Years" {{request('graduation_duration')=='04 Years'?'selected':''}}>04 YEARS</option>
                    <option value="05 Years" {{request('graduation_duration')=='05 Years'?'selected':''}}>05 YEARS</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('graduation_duration')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="graduation_result">
            <label class="col-form-label col-form-label-sm" for="graduation_result">Graduation Result</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="graduation_result_select" style="font-size: larger" id="graduation_result_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="graduation_result" type="text" name="graduation_result" value="{{request('graduation_result')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('graduation_result')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="graduation_institute">
            <label class="col-form-label col-form-label-sm" for="graduation_institute">Graduation Institute</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="graduation_institute_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="graduation_institute" id="graduation_institute">
                    <option value="">SELECT GRAD INSTITUTE</option>
                    @foreach($graduation_institutes as $value)
                        <option value="{{$value->name}}" {{request('graduation_institute')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('graduation_institute')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="graduation_passing_year">
            <label class="col-form-label col-form-label-sm" for="graduation_passing_year">Graduation Passing Year</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="graduation_passing_year_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="graduation_passing_year" id="graduation_passing_year">
                    <option value="">SELECT GRAD YEAR</option>
                    @for($i=date('Y'); $i>=1960; $i--)
                        <option value="{{$i}}" {{request('graduation_passing_year')==$i?'selected':''}}>{{$i}}</option>
                    @endfor()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('graduation_passing_year')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="graduation_subject">
            <label class="col-form-label col-form-label-sm" for="graduation_subject">Graduation Subject</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="graduation_subject_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="graduation_subject" id="graduation_subject">
                    <option value="">SELECT GRAD SUBJECT</option>
                    @foreach($graduation_subjects as $value)
                        <option value="{{$value->name}}" {{request('graduation_subject')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('graduation_subject')">X</button>
                </div>
            </div>
        </div>
        {{-------Graduation-------end-------}}

        {{-------Masters-------start-------}}
        <div class="col-md-3 col-sm-4" v-if="masters_examination">
            <label class="col-form-label col-form-label-sm" for="masters_examination">Masters/Equivalent Exam</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="masters_examination_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="masters_examination" id="masters_examination">
                    <option value="">SELECT MASTERS EXAM</option>
                    @foreach($masters_examinations as $value)
                        <option value="{{$value->name}}" {{request('masters_examination')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('masters_examination')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="masters_duration">
            <label class="col-form-label col-form-label-sm" for="masters_duration">Masters Duration</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="masters_duration_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="masters_duration" id="masters_duration">
                    <option value="">SELECT DURATION</option>
                    <option value="01 Year" {{request('masters_duration')=='01 Year'?'selected':''}}>01 YEAR</option>
                    <option value="02 Years" {{request('masters_duration')=='02 Years'?'selected':''}}>02 YEARS</option>
                    <option value="03 Years" {{request('masters_duration')=='03 Years'?'selected':''}}>03 YEARS</option>
                    <option value="04 Years" {{request('masters_duration')=='04 Years'?'selected':''}}>04 YEARS</option>
                    <option value="05 Years" {{request('masters_duration')=='05 Years'?'selected':''}}>05 YEARS</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('masters_duration')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="masters_result">
            <label class="col-form-label col-form-label-sm" for="masters_result">Masters Result</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="masters_result_select" style="font-size: larger" id="masters_result_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="masters_result" type="text" name="masters_result" value="{{request('masters_result')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('masters_result')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="masters_institute">
            <label class="col-form-label col-form-label-sm" for="masters_institute">Masters Institute</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="masters_institute_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="masters_institute" id="masters_institute">
                    <option value="">SELECT MASTERS INSTITUTE</option>
                    @foreach($masters_institutes as $value)
                        <option value="{{$value->name}}" {{request('masters_institute')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('masters_institute')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="masters_passing_year">
            <label class="col-form-label col-form-label-sm" for="masters_passing_year">Masters Passing Year</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="masters_passing_year_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="masters_passing_year" id="masters_passing_year">
                    <option value="">SELECT MASTERS YEAR</option>
                    @for($i=date('Y'); $i>=1960; $i--)
                        <option value="{{$i}}" {{request('masters_passing_year')==$i?'selected':''}}>{{$i}}</option>
                    @endfor()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('masters_passing_year')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="masters_subject">
            <label class="col-form-label col-form-label-sm" for="masters_subject">Masters Subject</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="masters_subject_select" style="font-size: larger" id="f_name_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <select class="custom-select text-uppercase" name="masters_subject" id="masters_subject">
                    <option value="">SELECT MASTERS SUBJECT</option>
                    @foreach($masters_subjects as $value)
                        <option value="{{$value->name}}" {{request('masters_subject')==$value->name?'selected':''}}>{{$value->name}}</option>
                    @endforeach()
                </select>
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('masters_subject')">X</button>
                </div>
            </div>
        </div>
        {{-------Masters-------end-------}}


        <div class="col-md-3 col-sm-4" v-if="professional_designation">
            <label class="col-form-label col-form-label-sm" for="professional_designation">Professional Designation</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="professional_designation_select" style="font-size: larger" id="professional_designation_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="professional_designation" type="text" name="professional_designation" value="{{request('professional_designation')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('professional_designation')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="professional_organization">
            <label class="col-form-label col-form-label-sm" for="professional_organization">Professional Organization</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="professional_organization_select" style="font-size: larger" id="professional_organization_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="professional_organization" type="text" name="professional_organization" value="{{request('professional_organization')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('professional_organization')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="professional_from_date">
            <label class="col-form-label col-form-label-sm" for="professional_from_date">Professional From Date</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="professional_from_date_select" style="font-size: larger" id="professional_from_date_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="professional_from_date" type="text" name="professional_from_date" value="{{request('professional_from_date')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('professional_from_date')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="professional_to_date">
            <label class="col-form-label col-form-label-sm" for="professional_to_date">Professional To Date</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="professional_to_date_select" style="font-size: larger" id="professional_to_date_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="professional_to_date" type="text" name="professional_to_date" value="{{request('professional_to_date')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('professional_to_date')">X</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-4" v-if="professional_responsibilities">
            <label class="col-form-label col-form-label-sm" for="professional_responsibilities">Professional Responsibilities</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="professional_responsibilities_select" style="font-size: larger" id="professional_responsibilities_select" class="bg-info custom-select form-control text-white font-weight-bolder">
                        <option style="font-size: x-large" value="==">=</option>
                        <option style="font-size: x-large" value="!=">≠</option>
                    </select>
                </div>
                <input class="form-control" id="professional_responsibilities" type="text" name="professional_responsibilities" value="{{request('professional_responsibilities')}}">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button" v-on:click="close('professional_responsibilities')">X</button>
                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-4">
            <div class="form-group">
                <label class="col-form-label col-form-label-sm" for="m_name">Dynamic Criteria</label>
                <select v-model="selectedColumn" class="form-control text-uppercase demoSelect3" name="dynamic_criteria" id="dynamic_criteria">
                    <option value="">SELECT ONE</option>
                    <option value="f_name">Father's Name</option>
                    <option value="m_name">Mother's Name</option>
                    <option value="designation">Designation</option>
                    <option value="grade">Grade ID</option>
                    <option value="station_name">Office/Station Name</option>
                    <option value="station_mobile">Office/Station Mobile</option>
                    <option value="station_division">Office/Station Division</option>
                    <option value="station_district">Office/Station District</option>
                    <option value="station_thana">Office/Station Upazila</option>
                    <option value="is_attached">IS ATTACHED TO STATION/OFFICE</option>
                    <option value="attached_designation_id">ATTACHED Designation</option>
                    <option value="attached_station_name">ATTACHED Office/Station Name</option>
                    <option value="attached_station_division">ATTACHED Office/Station Division</option>
                    <option value="attached_station_district">ATTACHED Office/Station District</option>
                    <option value="attached_station_thana">ATTACHED Office/Station Upazila</option>

                    <option value="gpf_no">GPF No</option>
                    <option value="religion">Religion</option>
                    <option value="quota">Quota</option>
                    <option value="nid_no">NID Number</option>
                    <option value="blood_group">Blood Group</option>
                    <option value="gender">Gender</option>
                    <option value="passport_no">Passport Number</option>
                    <option value="marital_status">Marital Status</option>
                    <option value="id_card_no">ID Card No</option>
                    <option value="welfare_no">Welfare No</option>
                    <option value="womens_welfare_no">Women's Welfare No</option>
                    <option value="e_tin_no">TIN No</option>
                    <option value="birth_district">District of Birth</option>
                    <option value="disability_code">Disability Code</option>
                    <option value="age">Age</option>
                    <option value="birth_date">Date of Birth</option>
                    <option value="join_date">Date of Join</option>
                    <option value="lpr_date">Date of PRL</option>

                    <option value="spouse_name">Spouse Name</option>
                    <option value="spouse_tin">Spouse TIN No</option>
                    <option value="spouse_profession">Spouse Profession</option>
                    <option value="spouse_district">Spouse Home District</option>
                    <option value="spouse_child">Spouse Children</option>

                    <option value="home_contact">Home Contact Number</option>
                    <option value="email">Email Address</option>
                    <option value="emergency_person_name">Emergency Contact Person Name</option>
                    <option value="emergency_person_number">Emergency Contact Person Number</option>
                    <option value="emergency_person_relation">Emergency Contact Person Relation</option>

                    <option value="present_division">Present Address Division</option>
                    <option value="present_district">Present Address District</option>
                    <option value="present_thana">Present Address Upazila</option>
                    <option value="present_post_office">Present Address Post Office</option>
                    <option value="present_postal_code">Present Address Postal Code</option>
                    <option value="present_village">Present Address Village</option>
                    <option value="present_uccw">Present Address Union/{{--City-Corporation/--}}Ward</option>
                    <option value="present_house_no">Present Address House No</option>

                    <option value="permanent_division">Permanent Address Division</option>
                    <option value="permanent_district">Permanent Address District</option>
                    <option value="permanent_thana">Permanent Address Upazila</option>
                    <option value="permanent_post_office">Permanent Address Post Office</option>
                    <option value="permanent_postal_code">Permanent Address Postal Code</option>
                    <option value="permanent_village">Permanent Address Village</option>
                    <option value="permanent_uccw">Permanent Address Union/{{--City-Corporation/--}}Ward</option>
                    <option value="permanent_house_no">Permanent Address House No</option>

                    <option value="award">Award</option>
                    <option value="achievement">Achievement</option>
                    <option value="foreign_training">Abroad Training</option>
                    <option value="local_training">Inland Training</option>
                    <option value="inhouse_training">Inhouse Training</option>
                    <option value="punishment">Punishment</option>
                    <option value="leave">Leave</option>

                    <option value="jsc_examination">JSC/Equivalent Exam</option>
                    <option value="jsc_board">JSC Board</option>
                    <option value="jsc_roll">JSC Roll</option>
                    <option value="jsc_result">JSC Result/GPA</option>
                    <option value="jsc_passing_year">JSC Passing Year</option>
                    <option value="jsc_institute">JSC Institute</option>

                    <option value="ssc_examination">SSC/Equivalent Exam</option>
                    <option value="ssc_board">SSC Board</option>
                    <option value="ssc_roll">SSC Roll</option>
                    <option value="ssc_result">SSC Result/GPA</option>
                    <option value="ssc_subject">SSC Subject</option>
                    <option value="ssc_passing_year">SSC Passing Year</option>
                    <option value="ssc_institute">SSC Institute</option>

                    <option value="hsc_examination">HSC/Equivalent Exam</option>
                    <option value="hsc_board">HSC Board</option>
                    <option value="hsc_roll">HSC Roll</option>
                    <option value="hsc_result">HSC Result/GPA</option>
                    <option value="hsc_subject">HSC Subject</option>
                    <option value="hsc_passing_year">HSC Passing Year</option>
                    <option value="hsc_institute">HSC Institute</option>

                    <option value="graduation_examination">Graduation/Equivalent Exam</option>
                    <option value="graduation_duration">Graduation Duration</option>
                    <option value="graduation_result">Graduation Result/GPA</option>
                    <option value="graduation_subject">Graduation Subject</option>
                    <option value="graduation_passing_year">Graduation Passing Year</option>
                    <option value="graduation_institute">Graduation Institute</option>

                    <option value="masters_examination">Masters/Equivalent Exam</option>
                    <option value="masters_duration">Masters Duration</option>
                    <option value="masters_institute">Masters Institute</option>
                    <option value="masters_result">Masters Result/GPA</option>
                    <option value="masters_subject">Masters Subject</option>
                    <option value="masters_passing_year">Masters Passing Year</option>

                    <option value="professional_designation">Professional Designation/Post</option>
                    <option value="professional_organization">Professional Organization</option>
                    <option value="professional_from_date">Professional From Date</option>
                    <option value="professional_to_date">Professional To Date</option>
                    {{--<option value="professional_duration">Professional Duration</option>--}}
                    <option value="professional_responsibilities">Professional Responsibilities</option>

                </select>
            </div>
        </div>

    </div>
    <div>
        <button type="submit" class="btn btn-success">Search</button>
        {{--<button id="export" type="button" class="btn btn-primary">Export</button>--}}
    </div>
</form>
