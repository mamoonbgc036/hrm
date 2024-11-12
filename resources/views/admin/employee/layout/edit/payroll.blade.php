<div class="row">
    <div class="col-md-2 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">OT Eligibility</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="ot_eligibility_yes" name="ot_eligibility"
                        value="Yes" @if ($employee->ot_eligibility == 'Yes') checked @endif>
                    <label class="form-check-label" for="ot_eligibility_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="ot_eligibility_no" name="ot_eligibility"
                        value="No" @if ($employee->ot_eligibility == 'No') checked @endif>
                    <label class="form-check-label" for="ot_eligibility_no">No</label>
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
                    <input class="form-check-input" type="radio" id="gender_male" name="pf_eligibility" value="Yes"
                        @if ($employee->pf_eligibility == 'Yes') checked @endif>
                    <label class="form-check-label" for="gender_male">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female" name="pf_eligibility"
                        value="No" @if ($employee->pf_eligibility == 'No') checked @endif>
                    <label class="form-check-label" for="gender_female">No</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">Gratuity Eligibility</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="gt_eligibility" value="Yes"
                        @if ($employee->gt_eligibility == 'Yes') checked @endif>
                    <label class="form-check-label" for="gender_male">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female" name="ot_eligibility"
                        value="No" @if ($employee->gt_eligibility == 'No') checked @endif>
                    <label class="form-check-label" for="gender_female">No</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">Pension Eligibility</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_male" name="pen_eligibility"
                        value="Yes" @if ($employee->pen_eligibility == 'Yes') checked @endif>
                    <label class="form-check-label" for="gender_male">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female" name="pen_eligibility"
                        value="No" @if ($employee->pen_eligibility == 'No') checked @endif>
                    <label class="form-check-label" for="gender_female">No</label>
                </div>
            </div>
        </div>
    </div>
    {{-- // confirmation --}}
    <div class="col-md-2 col-sm-4">
        <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="ot_eligibility">Confirmssss as</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="in_probation" value="Y"
                        @if ($employee->in_probation == 'Y') checked @endif>
                    <label class="form-check-label" for="gender_male">Regular</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender_female" name="in_probation" value="N"
                        @if ($employee->in_probation == 'N') checked @endif>
                    <label class="form-check-label" for="gender_female">Probation</label>
                </div>
            </div>
        </div>
    </div>
    {{-- // --}}
</div>
