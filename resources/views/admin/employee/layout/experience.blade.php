<form id="experience_info_form" method="post">
    @csrf
    @if (Session::has('employee_id'))
        <input type="hidden" name="id" value="{{ Session::get('employee_id') }}">
    @else
    @endif

    <div class="add-experience">
        <div class="add-more-exper">
            <div class="row">
                <div class="col-md-11">
                    <div class="experience" style="border:1px solid #009788; padding : 15px; margin:10px">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="company_name">Company
                                        Name</label>
                                    <input class="form-control" id="company_name" type="text" name="company_name[]"
                                        value="{{ old('company_name') }}">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="job_position">Job Position</label>
                                    <select name="job_position[]" class="form-control" id="">
                                        @if($experience_job_positions && $experience_job_positions->count() > 0)
                                            <option value="">select job position</option>
                                            @foreach ($experience_job_positions as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Job Position Available, Please create one</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="company_location">Company
                                        Location</label>
                                    <input class="form-control" id="company_location" type="text" name="company_location[]"
                                        value="{{ old('company_location') }}">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="project_name">Project
                                        Name</label>
                                    <input class="form-control" id="project_name" type="text" name="project_name[]"
                                        value="{{ old('project_name') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="from_date">From
                                        Date</label>
                                    <input class="form-control" id="from_date" name="from_date[]" type="date"
                                        placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('from_date') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="to_date">To Date</label>
                                    <input class="form-control" id="to_date" name="to_date[]" type="date"
                                        placeholder="DD-MM-YYYY" autocomplete="off" value="{{ old('to_date') }}">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="job_responsibility">Job
                                        Responsibility</label>
                                    <textarea class="form-control" id="job_responsibility" type="text" name="job_responsibility[]" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-experience" style="margin:10px">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between" style="margin:10px">
        <button type="button" id="add-experience" class="btn btn-secondary">Add Another Experience</button>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Next</button>
        </div>
    </div>
</form>
