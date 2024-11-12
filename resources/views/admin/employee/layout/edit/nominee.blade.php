<hr>
<h6 class="font-weight-semibold">Add Nominee</h6>
<form id="nomineeInfoForm" method="post">
    @csrf
    <div class="mb-1 dom_for_append">
        @if (!$employee->getNominee->isEmpty())
            @foreach ($employee->getNominee as $egn)
                <div class="mt-2 mb-2 rounded dom_for_clone">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="wrap-inner border border-warning p-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                        <label for="mobil_oil" class="form-label">Nominee Name</label>
                                        <div class="form-group">
                                            <input class="{{ $error_class }} form-control" name="name[]" type="text"
                                                value="{{ $egn->name }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                        <label for="mobil_oil" class="form-label">Relationship</label>
                                        <div class="form-group">
                                            <select name="relationship[]" id="relationship" class="form-control text-uppercase">
                                                <option value="" disabled selected>SELECT RELATIONSHIP</option>
                                                @foreach ($relationship as $row)
                                                    <option value="{{ $row->id }}"
                                                        @if ($egn->relationship == $row->id) selected @endif>
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
                                            <input class="{{ $error_class }} form-control" name="dob[]" type="date"
                                                value="{{ date('Y-m-d', strtotime($egn->dob)) }}">
                                            @if ($errors->has('dob'))
                                                <p class="text-danger">{{ $errors->first('dob') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                        <label for="nid_no" class="form-label">NID/Birth Registration No</label>
                                        <div class="form-group">
                                            <input class="{{ $error_class }} form-control" name="nid_no[]" type="text"
                                                value="{{ $egn->nid_no }}">
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
                                        <input v-model="percentage[index]" @change="valid(index)" name="'nominees['+index+'][percentage]'" class="{{$error_class}} form-control" id="percentage" type="text" >
                                        @if ($errors->has('percentage'))
                                            <p class="text-danger">{{$errors->first('percentage')}}</p>
                                        @endif
                                    </div>
                                    </div> --}}
                                    <div class="col-sm-12 col-md-8">
                                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                        <label for="permanent_address" class="form-label">Address</label>
                                        <div class="form-group">
                                            <textarea rows="3" cols="3" name="permanent_address[]" class="{{ $error_class }} form-control">{{ $egn->permanent_address }}</textarea>
                                            @if ($errors->has('permanent_address'))
                                                <p class="text-danger">{{ $errors->first('permanent_address') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                        <label for="signature" class="text-center form-label">Percentage</label>
                                        <div class="form-group">
                                            <input type="text" name="percentage[]" value="{{ $egn->percentage }}" id=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                        <label for="picture" class="text-center form-label">Nominee Picture</label>
                                        <div class="form-group">
                                            <input style="border: unset;" name="picture[]" class="nominee_picture_url"
                                                type="file" accept="image/*">
                                            <h6 class="text-danger">Picture size should be 20-200px</h6>
                                            <img style="height: 100px;width: 100px; border: 2px solid #adb5bd;border-radius: 3%;"
                                                src="{{ @$egn->picture_url != null ? asset('nominee_picture/' . $egn->picture_url) : asset('profile_image/dummy.jpg') }}"
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
                                            <input style="border: unset;" name="signature[]" class="nominee_signature_url"
                                                type="file" accept="image/*">
                                            <h6 class="text-danger">Picture size should be 20-200px</h6>
                                            <img style="height: 100px;width: 100px; border: 2px solid #adb5bd;border-radius: 3%;"
                                                src="{{ @$egn->signature != null ? asset('nominee_signature/' . $egn->signature) : asset('profile_image/dummy.jpg') }}"
                                                class="preview_nominee_signature" alt="Nominee Signature Preview">
                                            @if ($errors->has('signature'))
                                                <p class="text-danger">{{ $errors->first('signature') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-danger dom_remove_for_nominee p-2 btn-sm">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mt-2 mb-2 rounded dom_for_clone">
                <div class="row">
                    <div class="col-md-11">
                        <div class="wrap-inner border border-warning p-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="mobil_oil" class="form-label">Nominee Name</label>
                                    <div class="form-group">
                                        <input class="{{ $error_class }} form-control" name="name[]" type="text">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="mobil_oil" class="form-label">Relationship</label>
                                    <div class="form-group">
                                        <select name="relationship[]" id="relationship" class="form-control text-uppercase">
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
                                        <input class="{{ $error_class }} form-control" name="dob[]" type="date">
                                        @if ($errors->has('dob'))
                                            <p class="text-danger">{{ $errors->first('dob') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="nid_no" class="form-label">NID/Birth Registration No</label>
                                    <div class="form-group">
                                        <input class="{{ $error_class }} form-control" name="nid_no[]" type="text">
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
                                        <input v-model="percentage[index]" @change="valid(index)" name="'nominees['+index+'][percentage]'" class="{{$error_class}} form-control" id="percentage" type="text" >
                                        @if ($errors->has('percentage'))
                                            <p class="text-danger">{{$errors->first('percentage')}}</p>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-sm-12 col-md-8">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="permanent_address" class="form-label">Address</label>
                                    <div class="form-group">
                                        <textarea rows="3" cols="3" name="permanent_address[]" class="{{ $error_class }} form-control"></textarea>
                                        @if ($errors->has('permanent_address'))
                                            <p class="text-danger">{{ $errors->first('permanent_address') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="signature" class="text-center form-label">Percentage</label>
                                    <div class="form-group">
                                        <input type="text" name="percentage[]" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="picture" class="text-center form-label">Nominee Picture</label>
                                    <div class="form-group">
                                        <input style="border: unset;" name="picture[]" class="nominee_picture_url"
                                            type="file" accept="image/*">
                                        <h6 class="text-danger">Picture size should be 20-200px</h6>
                                        <img style="height: 100px;width: 100px; border: 2px solid #adb5bd;border-radius: 3%;"
                                            src="{{ asset('assets/employee/default-user.png') }}" class="preview_nominee_picture"
                                            alt="Nominee Picture Preview">
                                        @if ($errors->has('picture'))
                                            <p class="text-danger">{{ $errors->first('picture') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    @php /** @var string $errors */ $error_class = $errors->has('mobil_oil') ? 'parsley-error ' : ''; @endphp
                                    <label for="signature" class="text-center form-label">Nominee Signature</label>
                                    <div class="form-group">
                                        <input style="border: unset;" name="signature[]" class="nominee_signature_url"
                                            type="file" accept="image/*">
                                        <h6 class="text-danger">Picture size should be 20-200px</h6>
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
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-danger dom_remove_for_nominee p-2 btn-sm">X</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-sm-12 text-left pl-0">
        <button class="btn btn-info p-2 addMoreNominee">
            <i class="fa fa-plus-circle"></i>
            Add More
        </button>
    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm">Next</button>
        </div>
    </div>
</form>
