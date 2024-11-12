<h3>EMERGENCY CONTACT</h3>
<hr>
<form id="contactInfoForm" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-sm btn-success" onclick="addEmergency()">Add
                More</button>
        </div>
    </div>
    <div class="row my-1" id="contact-container">
        <div class="col-12 my-1 cpycon" id="copy-contact">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm" for="e_contact_person_name">Emergency
                                    Contact Person Name</label>
                                <input class="form-control" id="e_contact_person_name" type="text"
                                    name="contact[0][e_contact_person_name]" value="{{ old('e_contact_person_name') }}">
                                @if (Session::has('employee_id'))
                                    <input type="hidden" name="contact[0][employee_id]"
                                        value="{{ Session::get('employee_id') }}">
                                @else
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm" for="e_contact_person_number">Emergency
                                    Contact Person Number</label>
                                <input class="form-control" id="e_contact_person_number" type="text"
                                    name="contact[0][e_contact_person_number]"
                                    value="{{ old('e_contact_person_number') }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm"
                                    for="e_contact_person_relation">Emergency
                                    Contact Person Relationship</label>
                                <select name="contact[0][e_contact_person_relation]" id="e_contact_person_relation"
                                    class="form-control">
                                    <option value="" disabled selected>SELECT RELATIONSHIP</option>
                                    @foreach ($relationship as $row)
                                        <option value="{{ $row->id }}">
                                            {{ App\Classes\StringConversion::stringToUpper($row->name) }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm" for="e_contact_person_name">Emergency
                                    Contact Person Email</label>
                                <input class="form-control" id="e_contact_person_name" type="text"
                                    name="contact[0][e_contact_person_email]"
                                    value="{{ old('e_contact_person_email') }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm" for="e_contact_person_address">Emergency
                                    Contact Person Address</label>
                                <textarea class="form-control" id="e_contact_person_address" name="contact[0][e_contact_person_address]"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn-sm btn-danger"
                                onclick="removeContact(this)">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Next</button>
        </div>
    </div>
</form>
