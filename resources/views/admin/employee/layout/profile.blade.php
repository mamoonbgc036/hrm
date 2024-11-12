                <h3>Profile Picture and Signature</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Check if 'employee_id' exists in the session --}}
                                @if (Session::has('employee_id'))
                                    <input type="hidden" name="employee_id" id="employee_id"
                                        value="{{ Session::get('employee_id') }}">
                                @else
                                    {{-- <p>No Employee ID found in the session.</p> --}}
                                @endif
                                <label class="col-form-label col-form-label-sm" for="img_url">Profile
                                    Picture</label>
                                <input type="file" style="border: unset;" id="img_url" class="edit_employee_image"
                                    content="content" name="img_url" type="file" accept="image/*">
                                <p class="text-danger uppercase fs-14">Profile Picture size should be
                                    20KB-200KB</p>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label col-form-label-sm" for="img_url">Preview Profile
                                    Picture</label><br>
                                <img style="height: 200px;width: 200px; border: 3px solid #adb5bd;border-radius: 3%; "
                                    id="previewImg"
                                    src="{{ @$employee->img_url != null ? asset('profile_image/' . $employee->img_url) : asset('profile_image/dummy.jpg') }}"
                                    alt="Image Preview">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-form-label col-form-label-sm" for="signature_url">Signature</label>
                                <input style="border: unset;" id="signature_url" onchange="preview_signature()"
                                    name="signature_url" type="file" accept="image/*">
                                <span class="text-danger uppercase fs-14">Signature size should be 20KB-200KB</span>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label col-form-label-sm" for="signature_url">Preview
                                    Signature</label><br>
                                <img style="height: 200px;width: 200px; border: 3px solid #adb5bd;border-radius: 3%; "
                                    id="previewSignature" content="content"
                                    src="{{ @$employee->signature_url != null ? asset('signature/' . $employee->signature_url) : asset('profile_image/dummy.jpg') }}"
                                    alt="Image Preview">
                            </div>
                        </div>
                    </div>
                </div>
