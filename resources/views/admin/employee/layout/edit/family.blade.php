<form id="family_info_form" method="post">
    @csrf
    @if (Session::has('employee_id'))
        <input type="hidden" name="id" value="{{ Session::get('employee_id') }}">
    @else
    @endif
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-sm btn-success" onclick="addFamilyCopy()">Add
                more</button>
        </div>
    </div>
    @if (!$employee->RelationDetails->isEmpty())
        @foreach ($employee->RelationDetails as $key => $relation)
            <div class="row" id="familyContainer">
                <div class="col-12 cpyfam my-2" id="familyCopy">
                    <div class="card">
                        <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="row" id="copy_family">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm"
                                            for="e_contact_person_relation">Relationship</label>
                                        <select name="relationship[]" id="relationship" class="form-control">
                                            <option value="" selected>SELECT RELATIONSHIP</option>
                                            @foreach ($relationship as $row)
                                                <option value="{{ $row->name }}"
                                                    @if ($relation->relationship == $row->name) selected @endif>
                                                    {{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="name">Name</label>
                                        <input class="form-control" id="name" type="text" name="relation_name[]"
                                            value="{{ $relation->relation_name }}">
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm"
                                            for="occupation">Occupation</label>
                                        <input class="form-control" id="occupation" type="text"
                                            name="relation_occupation[]" value="{{ $relation->relation_occupation }}">
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact
                                            Info</label>
                                        <input class="form-control" id="spouse_contact" type="text"
                                            name="relation_contact[]" value="{{ $relation->relation_contact }}">
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="spouse_dob">Date of
                                            Birth</label>
                                        <input class="form-control" id="dob" type="date" name="relation_dob[]"
                                            value="{{ date('Y-m-d', strtotime($relation->relation_dob)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="background-color: #f8ffff;">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="removeFamily(this)">remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row my-1" id="familyContainer">
            <div class="col-12 cpyfam my-2" id="familyCopy">
                <div class="card">
                    <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="row" id="copy_family">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm"
                                        for="e_contact_person_relation">Relationship</label>
                                    <select name="relationship[]" id="relationship" class="form-control">
                                        <option value="" selected>SELECT RELATIONSHIP</option>
                                        @foreach ($relationship as $row)
                                            <option value="{{ $row->name }}">
                                                {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                                    <input class="form-control" id="name" type="text" name="relation_name[]"
                                        value="">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm"
                                        for="occupation">Occupation</label>
                                    <input class="form-control" id="occupation" type="text"
                                        name="relation_occupation[]" value="">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact
                                        Info</label>
                                    <input class="form-control" id="spouse_contact" type="text"
                                        name="relation_contact[]" value="">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="spouse_dob">Date of
                                        Birth</label>
                                    <input class="form-control" id="dob" type="date" name="relation_dob[]"
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #f8ffff;">
                        <div class="row">
                            <div class="col-12 p-0">
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="removeFamily(this)">remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (!$employee->GurantorDetails->isEmpty())
        @foreach ($employee->GurantorDetails as $key => $gurantor)
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center mt-2" style="background-color: #009788; color:#f8ffff">Gurantor
                        {{ $key + 1 }}</h5>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="gurantor_name[]"
                            value="{{ old('relation_name', @$gurantor->gurantor_name) }}">
                    </div>
                </div>
                {{-- <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                        <select class="form-control text-uppercase" name="gurantor_organization_id[]"
                            id="organization_id" style="width:100%;">
                            <option value="" selected>Select Organization</option>
                            @foreach ($organizations as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ @$gurantor->gurantor_organization_id == $value->id ? 'selected' : null }}>
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                        <input class="form-control" id="occupation" type="text" name="gurantor_occupation[]"
                            value="{{ old('relation_occupation', @$gurantor->gurantor_occupation) }}">
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                        <input class="form-control" id="spouse_contact" type="text" name="gurantor_contact[]"
                            value="{{ old('relation_contact', @$gurantor->gurantor_contact) }}">
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="spouse_contact">Relation</label>
                        <select name="garantor_relations[]" id="" class="form-control">
                            <option value="" selected>Select Relation</option>
                            <option value="father" {{ @$gurantor->relations == 'father' ? 'selected' : '' }}>
                                Father</option>
                            <option value="mother" {{ @$gurantor->relations == 'mother' ? 'selected' : '' }}>
                                Mother</option>
                            <option value="elder_brother"
                                {{ @$gurantor->relations == 'elder_brother' ? 'selected' : '' }}>Elder Brother
                            </option>
                            <option value="uncle" {{ @$gurantor->relations == 'uncle' ? 'selected' : '' }}>
                                Uncle</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label col-form-label-sm" for="guarantor_one_image">Profile
                                Picture</label>
                            <input type="file" style="border: unset;" class="guarantor_image" content="content"
                                name="guarantor_image[]" type="file" accept="image/*">
                            <p class="text-danger uppercase fs-14">Profile Picture size should be
                                20KB-200KB</p>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label col-form-label-sm" for="guarantor_image">Preview Profile
                                Picture</label><br>
                            <img src="{{ @$gurantor->images != null ? asset('guarantor_image/' . $gurantor->images) : asset('profile_image/dummy.jpg') }}"
                                style="height: 200px;width: 200px; border: 3px solid #adb5bd; border-radius: 3%;"
                                class="guarentor_image_preview" alt="Image Preview">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label col-form-label-sm" for="guarantor_signature[]">Signature
                                Upload</label>
                            <input type="file" style="border: unset;" class="guarantor_signature"
                                content="content" name="guarantor_signature[]" type="file" accept="image/*">
                            <p class="text-danger uppercase fs-14">Signature size should be
                                20KB-200KB</p>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label col-form-label-sm" for="guarantor_signature">Signature
                                Preview</label><br>
                            <img src="{{ @$gurantor->signature != null ? asset('guarantor_signature/' . $gurantor->signature) : asset('profile_image/dummy.jpg') }}"
                                style="height: 200px;width: 200px; border: 3px solid #adb5bd; border-radius: 3%;"
                                class="guarentor_signature_preview" alt="Image Preview">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12">
                <h5 class="text-center mt-2" style="background-color: #009788; color:#f8ffff">Gurantor One</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="gurantor_name[]"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            {{-- <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="gurantor_organization_id[]"
                        id="organization_id" style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="gurantor_occupation[]"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="gurantor_contact[]"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Relation</label>
                    <select name="garantor_relations[]" id="" class="form-control">
                        <option value="" selected>Select Relation</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="elder_brother">Elder Brother</option>
                        <option value="uncle">Uncle</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_image">Profile
                            Picture</label>
                        <input type="file" style="border: unset;" class="guarantor_image" content="content"
                            name="guarantor_image[]" type="file" accept="image/*">
                        <p class="text-danger uppercase fs-14">Profile Picture size should be
                            20KB-200KB</p>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_image">Preview Profile
                            Picture</label><br>
                        <img src="{{ asset('profile_image/dummy.jpg') }}"
                            style="height: 200px;width: 200px; border: 3px solid #adb5bd; border-radius: 3%;"
                            class="guarentor_image_preview" alt="Image Preview">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_signature">Signature
                            Upload</label>
                        <input type="file" style="border: unset;" class="guarantor_signature" content="content"
                            name="guarantor_signature[]" type="file" accept="image/*">
                        <p class="text-danger uppercase fs-14">Signature size should be
                            20KB-200KB</p>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_signature">Signature
                            Preview</label><br>
                        <img src="{{ asset('profile_image/dummy.jpg') }}"
                            style="height: 200px;width: 200px; border: 3px solid #adb5bd; border-radius: 3%;"
                            class="guarentor_signature_preview" alt="Image Preview">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="text-center mt-2" style="background-color: #009788; color:#f8ffff">Gurantor Two</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="gurantor_name[]"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            {{-- <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="gurantor_organization_id[]"
                        id="organization_id" style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="gurantor_occupation[]"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact
                        Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="gurantor_contact[]"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Relation</label>
                    <select name="garantor_relations[]" id="" class="form-control">
                        <option value="" selected>Select Relation</option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                        <option value="elder_brother">Elder Brother</option>
                        <option value="uncle">Uncle</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_image">Profile
                            Picture</label>
                        <input type="file" style="border: unset;" class="guarantor_image" content="content"
                            name="guarantor_image[]" type="file" accept="image/*">
                        <p class="text-danger uppercase fs-14">Profile Picture size should be
                            20KB-200KB</p>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_image">Preview Profile
                            Picture</label><br>
                        <img src="{{ asset('profile_image/dummy.jpg') }}"
                            style="height: 200px;width: 200px; border: 3px solid #adb5bd; border-radius: 3%;"
                            class="guarentor_image_preview" alt="Image Preview">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_signature_two">Signature
                            Upload</label>
                        <input type="file" style="border: unset;" class="guarantor_signature" content="content"
                            name="guarantor_signature[]" type="file" accept="image/*">
                        <p class="text-danger uppercase fs-14">Signature size should be
                            20KB-200KB</p>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label col-form-label-sm" for="guarantor_signature_two">Signature
                            Preview</label><br>
                        <img src="{{ asset('profile_image/dummy.jpg') }}"
                            style="height: 200px;width: 200px; border: 3px solid #adb5bd; border-radius: 3%;"
                            class="guarentor_signature_preview" alt="Image Preview">
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (!$employee->RefereeDetails->isEmpty())
        @foreach ($employee->RefereeDetails as $key => $item)
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center" style="background-color: #009788; color:#f8ffff">Referee
                        {{ $key + 1 }}</h5>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="referee_name[]"
                            value="{{ old('relation_name', $item->referee_name) }}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                        <select class="form-control text-uppercase" name="referee_organization_id[]"
                            id="organization_id" style="width:100%;">
                            <option value="" selected>Select Organization</option>
                            @foreach ($organizations as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ @$employee->referee_organization_id == $value->id ? 'selected' : '' }}>
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                        <input class="form-control" id="occupation" type="text" name="referee_occupation[]"
                            value="{{ old('relation_occupation', @$item->referee_occupation) }}">
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact
                            Info</label>
                        <input class="form-control" id="spouse_contact" type="text" name="referee_contact[]"
                            value="{{ old('relation_contact', @$item->referee_contact) }}">
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="spouse_contact">Email</label>
                        <input class="form-control" id="spouse_contact" type="text" name="referee_email[]"
                            value="{{ old('referee_email', @$item->email) }}">
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12">
                <h5 class="text-center mt-2" style="background-color: #009788; color:#f8ffff">Referee One</h5>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="referee_name[]"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="referee_organization_id[]" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="referee_occupation[]"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact
                        Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="referee_contact[]"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Email</label>
                    <input class="form-control" id="spouse_contact" type="text" name="referee_email[]"
                        value="{{ old('referee_email') }}">
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
                    <input class="form-control" id="name" type="text" name="referee_name[]"
                        value="{{ old('relation_name') }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="organization">Organization</label>
                    <select class="form-control text-uppercase" name="referee_organization_id[]" id="organization_id"
                        style="width:100%;">
                        <option value="" selected>Select Organization</option>
                        @foreach ($organizations as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="occupation">Occupation</label>
                    <input class="form-control" id="occupation" type="text" name="referee_occupation[]"
                        value="{{ old('relation_occupation') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Contact
                        Info</label>
                    <input class="form-control" id="spouse_contact" type="text" name="referee_contact[]"
                        value="{{ old('relation_contact') }}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm" for="spouse_contact">Email</label>
                    <input class="form-control" id="spouse_contact" type="text" name="referee_email[]"
                        value="{{ old('referee_email') }}">
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm">Next</button>
        </div>
    </div>
</form>
