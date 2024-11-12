<h3>Present Address</h3>
<hr>
<div class="row">
    <div class="col-md-6 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="pr_country_id">Country <span
                    class="text-danger">*</span></label>
            <select class="form-control text-uppercase" id="pr_country_id" name="present_country_id" style="width:100%;">
                <option disabled selected hidden>SELECT COUNTRY</option>
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
            <select class="form-control text-uppercase pa_division_id" id="pr_division_id" name="pr_division_id"
                style="width:100%;">
                <option value="" selected>SELECT DIVISION</option>
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
            <select class="form-control text-uppercase pa_district_id" id="pr_district_id" name="pr_district_id"
                style="width:100%;">
                <option value="" selected>SELECT DISTRICT</option>
            </select>
        </div>
    </div>
    <div class="col-md-6 col-sm-4">
        <div class="form-group">
            <label class="col-form-label" for="pr_upazila_id">Upazila/Thana <span class="text-danger">*</span></label>
            <select class="form-control text-uppercase station_select" id="pr_upazila_id" name="pr_upazila_id"
                style="width:100%;">
                <option value="" selected>SELECT UPAZILA/THANA</option>
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
            <label class="col-form-label col-form-label-sm" for="pr_area">Village/Road/Area/Block/Sector</label>
            <input class="form-control" id="pr_area" type="text" name="pr_area" value="{{ old('vi_ro_ar') }}">
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

<h3>Permanent Address</h3>
<hr>
<div class="col-md-4 col-sm-4 sameAsPresent">
    <div class="form-group" style="margin-top: 25px">
        <label class="col-form-label col-form-label-sm" for="sameAsPresent">Same as Present Address
            ?</label>
        {{-- name="sameAsPresent" --}}
        <input class="" type="checkbox" {{ old('sameAsPresent') ? 'checked' : '' }} id="sameAsPresent">
    </div>
</div>

<div class="row permanent-address">
    <div class="col-md-6 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="pa_country_id">Country <span
                    class="text-danger">*</span></label>
            <select class="form-control text-uppercase" id="pa_country_id" name="permanent_country_id"
                style="width:100%;">
                <option disabled selected hidden>SELECT COUNTRY</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ App\Classes\StringConversion::stringToUpper($country->name) }}</option>
                @endforeach()
            </select>
        </div>
    </div>
    <div class="col-md-6 col-sm-4">
        <div class="form-group">
            <label class="col-form-label" for="pa_division_id">Divisionss<span class="text-danger">*</span></label>
            <select class="form-control text-uppercase pa_division_id" id="pa_division_id" name="pa_division_id"
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
            <label class="col-form-label" for="pa_district_id">District <span class="text-danger">*</span></label>
            <select class="form-control text-uppercase" id="pa_district_id" name="pa_district_id"
                style="width:100%;">
                <option>SELECT DISTRICT</option>
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
            <select class="form-control text-uppercase" id="pa_upazila_id" name="pa_upazila_id" style="width:100%;">
                <option>SELECT UPAZILA/THANA</option>
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
            <label class="col-form-label col-form-label-sm" for="pa_area">Village/Road/Area/Block/Sector</label>
            <input class="form-control" id="pa_area" type="text" name="pa_area" value="{{ old('pa_area') }}">
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
