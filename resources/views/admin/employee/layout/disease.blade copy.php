<h3>Disease Information</h3>
<hr>
<form action="{{ route('employee-disease') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                @if (Session::has('employee_id'))
                    <input type="hidden" name="employee_id" value="{{ Session::get('employee_id') }}">
                @else
                @endif
                <label class="col-form-label col-form-label-sm" for="e_contact_person_relation">Disease
                    Name</label>
                <select name="disease[0][disease_id]" id="disease_id" class="form-control"
                    onchange="getMultipleDisease(this)">
                    <option value="" disabled selected>SELECT DISEASES</option>
                    @foreach ($diseases as $disease)
                        <option value="{{ $disease->id }}">
                            {{ App\Classes\StringConversion::stringToUpper($disease->name) }}</option>
                    @endforeach
                </select>

            </div>
        </div>
    </div>
    {{-- new row for disease --}}
    <div id="disease_list"></div>

    <!-- Template for cloning -->
    <div class="row my-2" id="disease_template" style="display: none;">
        <div class="col-12">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px;">
                <div class="card-body">
                    <div class="col-12 my-1 d-flex justify-content-end">
                        <button class="btn btn-sm btn-danger d-flex justify-content-center align-items-center"
                            style="border-radius: 50%;" type="button" onclick="removeDisease(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-octagon" viewBox="0 0 16 16">
                                <path
                                    d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button>
                    </div>
                    <div class="col-12 my-1">
                        <label for="" class="d-block mb-0">Disease Title</label>
                        <input type="hidden" name="disease[0][disease_id]" value="">
                        <input type="text" name="disease[0][disease_name]" class="form-control">
                    </div>
                    <div class="col-12 my-2">
                        <label for="" class="d-block mb-0">Description</label>
                        <textarea class="form-control" rows="3" cols="10" name="disease[0][disease_description]"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- // --}}
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Finish</button>
        </div>
    </div>
</form>
