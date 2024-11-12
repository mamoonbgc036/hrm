<form id="trainingInformation" method="post">
    @csrf
    <div class="container-fluid mt-5 p-0">
        @if (!$employee->getTraining->isEmpty())
            @foreach ($employee->getTraining as $egt)
                <div id="training-fields">
                    <div class="training-group mt-2 mb-2">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="border-area border border-warning p-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <input type="hidden" name="training[0][employee_id]" class="employee_id_input"
                                                value="{{ Session::get('employee_id') }}">
            
                                            <label for="course_title" class="form-label">Course Title:</label>
                                            <input type="text" name="training[0][course_title]" class="form-control"
                                                value="{{ $egt->course_title }}">
                                            @error('course_title.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="course_start_date" class="form-label">Course Start Date:</label>
                                            <input type="date" name="training[0][course_start_date]" class="form-control"
                                                value="{{ date('Y-m-d', strtotime($egt->course_start_date)) }}">
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="course_end_date" class="form-label">Course End Date:</label>
                                            <input type="date" name="training[0][course_end_date]" class="form-control"
                                                value="{{ date('Y-m-d', strtotime($egt->course_end_date)) }}">
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="course_description" class="form-label">Course
                                                Description:</label>
                                            <textarea name="training[0][course_description]" class="form-control" rows="3">{{ $egt->course_description }}</textarea>
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="training_type" class="form-label">Training Type:</label>
                                            <input type="text" name="training[0][training_type]" class="form-control"
                                                value="{{ $egt->training_type }}">
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="institute_name" class="form-label">Institute Name:</label>
                                            <input type="text" name="training[0][institute_name]" class="form-control"
                                                value="{{ $egt->institute_name }}">
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="institute_address" class="form-label">Institute Address:</label>
                                            <input type="text" name="training[0][institute_address]" class="form-control"
                                                value="{{ $egt->institute_address }}">
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="result" class="form-label">Result:</label>
                                            <input type="text" name="training[0][result]" class="form-control"
                                                value="{{ $egt->result }}">
                                            @error('course_start_date.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="year" class="form-label">Year:</label>
                                            <input type="number" name="training[0][year]" class="form-control"
                                                value="{{ $egt->year }}">
                                            @error('year.*')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm remove-training">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div id="training-fields">
                <div class="training-group mt-2 mb-2">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="border-area border border-warning p-3">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="hidden" name="training[0][employee_id]" class="employee_id_input"
                                            value="{{ Session::get('employee_id') }}">
        
                                        <label for="course_title" class="form-label">Course Title:</label>
                                        <input type="text" name="training[0][course_title]" class="form-control">
                                        @error('course_title.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="course_start_date" class="form-label">Course Start Date:</label>
                                        <input type="date" name="training[0][course_start_date]" class="form-control"
                                            value="">
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="course_end_date" class="form-label">Course End Date:</label>
                                        <input type="date" name="training[0][course_end_date]" class="form-control">
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="course_description" class="form-label">Course
                                            Description:</label>
                                        <textarea name="training[0][course_description]" class="form-control" rows="3"></textarea>
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="training_type" class="form-label">Training Type:</label>
                                        <input type="text" name="training[0][training_type]" class="form-control">
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="institute_name" class="form-label">Institute Name:</label>
                                        <input type="text" name="training[0][institute_name]" class="form-control">
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="institute_address" class="form-label">Institute Address:</label>
                                        <input type="text" name="training[0][institute_address]" class="form-control">
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="result" class="form-label">Result:</label>
                                        <input type="text" name="training[0][result]" class="form-control">
                                        @error('course_start_date.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="year" class="form-label">Year:</label>
                                        <input type="number" name="training[0][year]" class="form-control">
                                        @error('year.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-training">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- @endif --}}
        <div class="d-flex justify-content-between">
            <button type="button" id="add-training" class="btn btn-secondary">Add Another
                Training</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm">Next</button>
        </div>
    </div>
</form>
