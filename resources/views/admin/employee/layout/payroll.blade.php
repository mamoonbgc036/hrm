<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">OT
                Eligibility</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="ot_eligibility" value="Yes"
                        {{ old('gender') == 'male' ? 'checked' : '' }}>
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

    <div class="col-md-3 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">PF
                Eligibility</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="pf_eligibility" value="Yes"
                        {{ old('gender') == 'male' ? 'checked' : '' }}>
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

    <div class="col-md-3 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">Gratuity
                Eligibility</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="gt_eligibility" value="Yes"
                        {{ old('gender') == 'male' ? 'checked' : '' }}>
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

    <div class="col-md-3 col-sm-4">
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
    {{-- // confirmation --}}
    {{-- <div class="col-md-2 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">Confirm as</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="in_probation"
                        value="Y">
                    <label class="form-check-label" for="gender_male">Regular</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female"
                        name="in_probation" value="N">
                    <label class="form-check-label" for="gender_female">Probation</label>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- // --}}
</div>
