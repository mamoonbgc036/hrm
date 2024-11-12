<form id="educationInfoForm" method="post">
    @csrf
    <div class="row">
        @if (Session::has('employee_id'))
            <input type="hidden" name="id" value="{{ Session::get('employee_id') }}">
        @else
        @endif
        <div id="jsc" class="col-md-6 col-lg-6 mb-2">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <h5>JSC or Equivalent Level</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="jsc_examination">Examination</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('jsc_examination') is-invalid @enderror"
                            id="jsc_examination" name="jsc_examination" style="width: 100%">
                            <option value="" selected>SELECT EXAM</option>
                            <option value="J.S.C" @if (old('jsc_examination') == 'J.S.C') selected @endif>J.S.C
                            </option>
                            <option value="J.D.C" @if (old('jsc_examination') == 'J.D.C') selected @endif>J.D.C
                            </option>
                            <option value="J.S.C Vocational" @if (old('jsc_examination') == 'J.S.C Vocational') selected @endif>
                                J.S.C VOCATIONAL</option>
                            <option value="J.S.C Equivalent" @if (old('jsc_examination') == 'J.S.C Equivalent') selected @endif>
                                J.S.C EQUIVALENT</option>
                            <option value="Class 8 Passed" @if (old('jsc_examination') == 'Class 8 Passed') selected @endif>
                                CLASS 8 PASSED</option>
                        </select>
                        @error('jsc_examination')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="jsc_board">Board</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('jsc_board') is-invalid @enderror"
                            id="jsc_board" name="jsc_board" style="width: 100%">
                            <option value="" selected>SELECT BOARD</option>
                            <option value="Dhaka" @if (old('jsc_board') == 'Dhaka') selected @endif>
                                DHAKA
                            </option>
                            <option value="Cumilla" @if (old('jsc_board') == 'Cumilla') selected @endif>
                                CUMILLA</option>
                            <option value="Rajshahi" @if (old('jsc_board') == 'Rajshahi') selected @endif>
                                RAJSHAHI</option>
                            <option value="Jashore" @if (old('jsc_board') == 'Jashore') selected @endif>
                                JASHORE</option>
                            <option value="Chittagong" @if (old('jsc_board') == 'Chittagong') selected @endif>
                                CHITTAGONG</option>
                            <option value="Barishal" @if (old('jsc_board') == 'Barishal') selected @endif>
                                BARISHAL</option>
                            <option value="Sylhet" @if (old('jsc_board') == 'Sylhet') selected @endif>
                                SYLHET</option>
                            <option value="Dinajpur" @if (old('jsc_board') == 'Dinajpur') selected @endif>
                                DINAJPUR</option>
                            <option value="Madrasah" @if (old('jsc_board') == 'Madrasah') selected @endif>
                                MADRASAH</option>
                            <option value="Mymensingh" @if (old('jsc_board') == 'Mymensingh') selected @endif>
                                MYMENSINGH</option>
                            <option value="Cambridge International - IGCE"
                                @if (old('jsc_board') == 'Cambridge International - IGCE') selected @endif>CAMBRIDGE INTERNATIONAL
                                - IGCE</option>
                            <option value="Edexcel International" @if (old('jsc_board') == 'Edexcel International') selected @endif>
                                EDEXCEL INTERNATIONAL
                            </option>
                            <option value="Bangladesh Technical Education Board (BTEB)"
                                @if (old('jsc_board') == 'Bangladesh Technical Education Board (BTEB)') selected @endif>BANGLADESH TECHNICAL
                                EDUCATION BOARD (BTEB)</option>
                            <option value="Others" @if (old('jsc_board') == 'Others') selected @endif>
                                OTHER</option>
                        </select>
                        @error('jsc_board')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="jsc_roll">Board
                            Roll</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('jsc_roll') is-invalid @enderror"
                            id="jsc_roll" type="text" name="jsc_roll" value="{{ old('jsc_roll') }}">
                        @error('jsc_roll')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="jsc_registration">Registration Number</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('jsc_registration') is-invalid @enderror"
                            id="jsc_registration" type="text" name="jsc_registration"
                            value="{{ old('jsc_registration') }}">
                        @error('jsc_registration')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="jsc_result">Result</label>
                        <select style="margin-top: auto; width: 100%"
                            class="form-control form-control-sm col-md-4 col-sm-4 @error('jsc_result') is-invalid @enderror"
                            id="jsc_result" name="jsc_result">
                            <option value="" selected>SELECT RESULT</option>
                            <option value="Pass" @if (old('jsc_result') == 'Pass') selected @endif>
                                PASS
                            </option>
                            <option value="4" @if (old('jsc_result') == '4') selected @endif>
                                GPA(OUT OF 4)</option>
                            <option value="5" @if (old('jsc_result') == '5') selected @endif>
                                GPA(OUT OF 5)</option>
                        </select>
                        @error('jsc_result')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div id="jsc_gpa_div"
                            class="jsc_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('jsc_gpa') is-invalid @enderror">
                            <input id="jsc_gpa" disabled name="jsc_gpa" type="text"
                                class="form-control form-control-sm @error('jsc_gpa') is-invalid @enderror"
                                value="{{ old('jsc_gpa') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">GPA</span>
                            </div>
                            @error('jsc_gpa')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="jsc_passing_year">Passing
                            Year</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('jsc_passing_year') is-invalid @enderror"
                            id="jsc_passing_year" name="jsc_passing_year" style="width: 100%">
                            <option value="" selected>SELECT YEAR</option>
                            @for ($i = date('Y'); $i >= 1960; $i--)
                                <option value="{{ $i }}" @if (old('jsc_passing_year') == $i) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        @error('jsc_passing_year')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="jsc_institute">School/College</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('jsc_institute') is-invalid @enderror"
                            id="jsc_institute" type="text" name="jsc_institute"
                            value="{{ old('jsc_institute') }}">
                        @error('jsc_institute')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div id="ssc" class="col-md-6 col-lg-6 mb-2">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <h5>SSC or Equivalent Level</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_examination">Examination</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_examination') is-invalid @enderror"
                            id="ssc_examination" name="ssc_examination" style="width: 100%">
                            <option value="">SELECT EXAM</option>
                            <option value="S.S.C" @if (old('ssc_examination') == 'S.S.C') selected @endif>
                                S.S.C</option>
                            <option value="Dakhil" @if (old('ssc_examination') == 'Dakhil') selected @endif>
                                DAKHIL</option>
                            <option value="S.S.C Vocational" @if (old('ssc_examination') == 'S.S.C Vocational') selected @endif>S.S.C
                                VOCATIONAL
                            </option>
                            <option value="O Level/Cambridge" @if (old('ssc_examination') == 'O Level/Cambridge') selected @endif>O
                                LEVEL/CAMBRIDGE
                            </option>
                            <option value="S.S.C Equivalent" @if (old('ssc_examination') == 'S.S.C Equivalent') selected @endif>S.S.C
                                EQUIVALENT
                            </option>
                        </select>
                        @error('ssc_examination')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_board">Board</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_board') is-invalid @enderror"
                            id="ssc_board" name="ssc_board" style="width: 100%">
                            <option value="" selected>SELECT BOARD</option>
                            <option value="Dhaka" @if (old('ssc_board') == 'Dhaka') selected @endif>
                                DHAKA</option>
                            <option value="Cumilla" @if (old('ssc_board') == 'Cumilla') selected @endif>
                                CUMILLA</option>
                            <option value="Rajshahi" @if (old('ssc_board') == 'Rajshahi') selected @endif>
                                RAJSHAHI</option>
                            <option value="Jashore" @if (old('ssc_board') == 'Jashore') selected @endif>
                                JASHORE</option>
                            <option value="Chittagong" @if (old('ssc_board') == 'Chittagong') selected @endif>
                                CHITTAGONG</option>
                            <option value="Barishal" @if (old('ssc_board') == 'Barishal') selected @endif>
                                BARISHAL</option>
                            <option value="Sylhet" @if (old('ssc_board') == 'Sylhet') selected @endif>
                                SYLHET</option>
                            <option value="Dinajpur" @if (old('ssc_board') == 'Dinajpur') selected @endif>
                                DINAJPUR</option>
                            <option value="Madrasah" @if (old('ssc_board') == 'Madrasah') selected @endif>
                                MADRASAH</option>
                            <option value="Mymensingh" @if (old('ssc_board') == 'Mymensingh') selected @endif>
                                MYMENSINGH</option>
                            <option value="Cambridge International - IGCE"
                                @if (old('ssc_board') == 'Cambridge International - IGCE') selected @endif>CAMBRIDGE INTERNATIONAL
                                - IGCE</option>
                            <option value="Edexcel International" @if (old('ssc_board') == 'Edexcel International') selected @endif>
                                EDEXCEL INTERNATIONAL
                            </option>
                            <option value="Bangladesh Technical Education Board (BTEB)"
                                @if (old('ssc_board') == 'Bangladesh Technical Education Board (BTEB)') selected @endif>BANGLADESH TECHNICAL
                                EDUCATION BOARD (BTEB)</option>
                            <option value="Others" @if (old('ssc_board') == 'Others') selected @endif>
                                OTHER</option>
                        </select>
                        @error('ssc_board')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="ssc_roll">Board
                            Roll</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('ssc_roll') is-invalid @enderror"
                            id="ssc_roll" type="text" name="ssc_roll" value="{{ old('ssc_roll') }}">
                        @error('ssc_roll')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_registration">Registration Number</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('ssc_registration') is-invalid @enderror"
                            id="ssc_registration" type="text" name="ssc_registration"
                            value="{{ old('ssc_registration') }}">
                        @error('ssc_registration')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_result">Result</label>
                        <select style="margin-top: auto; width: 100%"
                            class="form-control form-control-sm col-md-4 col-sm-4 @error('ssc_result') is-invalid @enderror"
                            id="ssc_result" name="ssc_result">
                            <option value="" selected>SELECT RESULT</option>
                            <option value="1ST DIVISION" @if (old('ssc_result') == '1ST DIVISION') selected @endif>
                                1ST DIVISION</option>
                            <option value="2ND DIVISION" @if (old('ssc_result') == '2ND DIVISION') selected @endif>
                                2ND DIVISION</option>
                            <option value="3RD DIVISION" @if (old('ssc_result') == '3RD DIVISION') selected @endif>
                                3RD DIVISION</option>
                            <option value="4" @if (old('ssc_result') == '4') selected @endif>
                                GPA(OUT OF 4)</option>
                            <option value="5" @if (old('ssc_result') == '5') selected @endif>
                                GPA(OUT OF 5)</option>
                        </select>

                        @error('ssc_result')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div id="ssc_gpa_div"
                            class="ssc_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('ssc_gpa') is-invalid @enderror">
                            <input id="ssc_gpa" disabled name="ssc_gpa" type="text"
                                class="form-control form-control-sm @error('ssc_gpa') is-invalid @enderror"
                                value="{{ old('ssc_gpa') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">GPA</span>
                            </div>
                            @error('ssc_gpa')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_subject">Group/Subject</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_subject') is-invalid @enderror"
                            id="ssc_subject" name="ssc_subject" style="width: 100%">
                            <option value="" selected>SELECT GROUP/SUBJECT</option>
                            @foreach ($ssc_subjects as $subject)
                                <option value="{{ $subject->name }}"
                                    @if (old('ssc_subject') == $subject->name) selected @endif>
                                    {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('ssc_subject')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_passing_year">Passing Year</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('ssc_passing_year') is-invalid @enderror"
                            id="ssc_passing_year" name="ssc_passing_year" style="width: 100%">
                            <option value="" selected>SELECT YEAR</option>
                            @for ($i = date('Y'); $i >= 1960; $i--)
                                <option value="{{ $i }}"
                                    @if (old('ssc_passing_year') == $i) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        @error('ssc_passing_year')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="ssc_institute">School/College</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('ssc_institute') is-invalid @enderror"
                            id="ssc_institute" type="text" name="ssc_institute"
                            value="{{ old('ssc_institute') }}">
                        @error('ssc_institute')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div id="hsc" class="col-md-6 col-lg-6 mb-2">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <h5>HSC or Equivalent Level</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_examination">Examination</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_examination') is-invalid @enderror"
                            id="hsc_examination" name="hsc_examination" style="width: 100%">
                            <option value="" selected>SELECT EXAM</option>
                            <option value="H.S.C" @if (old('hsc_examination') == 'H.S.C') selected @endif>
                                H.S.C</option>
                            <option value="Alim" @if (old('hsc_examination') == 'Alim') selected @endif>
                                ALIM
                            </option>
                            <option value="Business Management" @if (old('hsc_examination') == 'Business Management') selected @endif>
                                BUSINESS MANAGEMENT
                            </option>
                            <option value="Diploma Engineering" @if (old('hsc_examination') == 'Diploma Engineering') selected @endif>
                                DIPLOMA ENGINEERING
                            </option>
                            <option value="A Level/Sr. Cambridge" @if (old('hsc_examination') == 'A Level/Sr. Cambridge') selected @endif>A
                                LEVEL/SR. CAMBRIDGE
                            </option>
                            <option value="H.S.C Equivalent" @if (old('hsc_examination') == 'H.S.C Equivalent') selected @endif>H.S.C
                                EQUIVALENT
                            </option>
                            <option value="Diploma in Pharmacy" @if (old('hsc_examination') == 'Diploma in Pharmacy') selected @endif>
                                DIPLOMA IN PHARMACY
                            </option>
                        </select>
                        @error('hsc_examination')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_board">Board</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_board') is-invalid @enderror"
                            id="hsc_board" name="hsc_board" style="width: 100%">
                            <option value="" selected>SELECT BOARD</option>
                            <option value="Dhaka" @if (old('hsc_board') == 'Dhaka') selected @endif>
                                DHAKA</option>
                            <option value="Cumilla" @if (old('hsc_board') == 'Cumilla') selected @endif>
                                CUMILLA</option>
                            <option value="Rajshahi" @if (old('hsc_board') == 'Rajshahi') selected @endif>
                                RAJSHAHI</option>
                            <option value="Jashore" @if (old('hsc_board') == 'Jashore') selected @endif>
                                JASHORE</option>
                            <option value="Chittagong" @if (old('hsc_board') == 'Chittagong') selected @endif>
                                CHITTAGONG</option>
                            <option value="Barishal" @if (old('hsc_board') == 'Barishal') selected @endif>
                                BARISHAL</option>
                            <option value="Sylhet" @if (old('hsc_board') == 'Sylhet') selected @endif>
                                SYLHET</option>
                            <option value="Dinajpur" @if (old('hsc_board') == 'Dinajpur') selected @endif>
                                DINAJPUR</option>
                            <option value="Madrasah" @if (old('hsc_board') == 'Madrasah') selected @endif>
                                MADRASAH</option>
                            <option value="Mymensingh" @if (old('hsc_board') == 'Mymensingh') selected @endif>
                                MYMENSINGH</option>
                            <option value="Cambridge International - IGCE"
                                @if (old('hsc_board') == 'Cambridge International - IGCE') selected @endif>CAMBRIDGE INTERNATIONAL
                                - IGCE</option>
                            <option value="Edexcel International" @if (old('hsc_board') == 'Edexcel International') selected @endif>
                                EDEXCEL INTERNATIONAL
                            </option>
                            <option value="Bangladesh Technical Education Board (BTEB)"
                                @if (old('hsc_board') == 'Bangladesh Technical Education Board (BTEB)') selected @endif>BANGLADESH TECHNICAL
                                EDUCATION BOARD (BTEB)</option>
                            <option value="Others" @if (old('hsc_board') == 'Others') selected @endif>
                                OTHER</option>
                        </select>
                        @error('hsc_board')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4" for="hsc_roll">Board
                            Roll</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('hsc_roll') is-invalid @enderror"
                            id="hsc_roll" type="text" name="hsc_roll" value="{{ old('hsc_roll') }}">
                        @error('hsc_roll')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_registration">Registration Number</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('hsc_registration') is-invalid @enderror"
                            id="hsc_registration" type="text" name="hsc_registration"
                            value="{{ old('hsc_registration') }}">
                        @error('hsc_registration')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_result">Result</label>
                        <select style="margin-top: auto; width: 100%"
                            class="form-control form-control-sm col-md-4 col-sm-4 @error('hsc_result') is-invalid @enderror"
                            id="hsc_result" name="hsc_result">
                            <option value="" selected>SELECT RESULT</option>
                            <option value="1ST DIVISION" @if (old('hsc_result') == '1ST DIVISION') selected @endif>
                                1ST DIVISION</option>
                            <option value="2ND DIVISION" @if (old('hsc_result') == '2ND DIVISION') selected @endif>
                                2ND DIVISION</option>
                            <option value="3RD DIVISION" @if (old('hsc_result') == '3RD DIVISION') selected @endif>
                                3RD DIVISION</option>
                            <option value="4" @if (old('hsc_result') == '4') selected @endif>
                                GPA(OUT OF 4)</option>
                            <option value="5" @if (old('hsc_result') == '5') selected @endif>
                                GPA(OUT OF 5)</option>
                        </select>
                        @error('hsc_result')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div id="hsc_gpa_div"
                            class="hsc_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('hsc_gpa') is-invalid @enderror">
                            <input id="hsc_gpa" disabled name="hsc_gpa" type="text"
                                class="form-control form-control-sm @error('hsc_gpa') is-invalid @enderror"
                                value="{{ old('hsc_gpa') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">GPA</span>
                            </div>
                            @error('hsc_gpa')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_subject">Group/Subject</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_subject') is-invalid @enderror"
                            id="hsc_subject" name="hsc_subject" style="width: 100%">
                            <option value="" selected>SELECT GROUP/SUBJECT</option>
                            @foreach ($hsc_subjects as $subject)
                                <option value="{{ $subject->name }}"
                                    @if (old('hsc_subject') == $subject->name) selected @endif>
                                    {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('hsc_subject')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_passing_year">Passing Year</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('hsc_passing_year') is-invalid @enderror"
                            id="hsc_passing_year" name="hsc_passing_year" style="width: 100%">
                            <option value="" selected>SELECT YEAR</option>
                            @for ($i = date('Y'); $i >= 1960; $i--)
                                <option value="{{ $i }}"
                                    @if (old('hsc_passing_year') == $i) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        @error('hsc_passing_year')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="hsc_institute">School/College</label>
                        <input
                            class="form-control form-control-sm col-md-8 col-sm-8 @error('hsc_institute') is-invalid @enderror"
                            id="hsc_institute" type="text" name="hsc_institute"
                            value="{{ old('hsc_institute') }}">
                        @error('hsc_institute')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div id="graduation" class="col-md-6 col-lg-6 mb-2">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <h5>Graduation or Equivalent Level</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="graduation_examination">Examination</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_examination') is-invalid @enderror"
                            id="graduation_examination" name="graduation_examination" style="width: 100%">
                            <option value="">SELECT EXAM</option>
                            <option value="B.A" @if (old('graduation_examination') == 'B.A') selected @endif>
                                B.A</option>
                            <option value="B.S.S" @if (old('graduation_examination') == 'B.S.S') selected @endif>
                                B.S.S</option>
                            <option value="B.Sc(Engineering/Architecture)"
                                @if (old('graduation_examination') == 'B.Sc(Engineering/Architecture)') selected @endif>B.SC
                                (ENGINEERING/ARCHITECTURE)</option>
                            <option value="B.Sc(Agricultural Science)"
                                @if (old('graduation_examination') == 'B.Sc(Agricultural Science)') selected @endif>B.SC (AGRICULTURAL
                                SCIENCE)</option>
                            <option value="M.B.B.S./B.D.S" @if (old('graduation_examination') == 'M.B.B.S./B.D.S') selected @endif>
                                M.B.B.S./B.D.S</option>
                            <option value="B.COM" @if (old('graduation_examination') == 'B.COM') selected @endif>
                                B.COM</option>
                            <option value="B.B.A" @if (old('graduation_examination') == 'B.B.A') selected @endif>
                                B.B.A</option>
                            <option value="L.L.B" @if (old('graduation_examination') == 'L.L.B') selected @endif>
                                L.L.B</option>
                            <option value="Honors" @if (old('graduation_examination') == 'Honors') selected @endif>
                                Honors</option>
                            <option value="Pass Course" @if (old('graduation_examination') == 'Pass Course') selected @endif>
                                PASS COURSE</option>
                            <option value="Fazil" @if (old('graduation_examination') == 'Fazil') selected @endif>
                                Fazil</option>
                            <option value="Graduation/Honors Equivalent"
                                @if (old('graduation_examination') == 'Graduation/Honors Equivalent') selected @endif>GRADUATION/HONORS
                                EQUIVALENT</option>
                            <option value="Others" @if (old('graduation_examination') == 'Others') selected @endif>
                                Others</option>
                        </select>
                        @error('graduation_examination')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="graduation_course_duration">Course Duration</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_course_duration') is-invalid @enderror"
                            id="graduation_course_duration" name="graduation_course_duration" style="width: 100%">
                            <option value="" selected="selected">SELECT DURATION</option>
                            <option value="01 Year" @if (old('graduation_course_duration') == '01 Year') selected @endif>
                                01 YEAR</option>
                            <option value="02 Years" @if (old('graduation_course_duration') == '02 Years') selected @endif>
                                02 YEARS</option>
                            <option value="03 Years" @if (old('graduation_course_duration') == '03 Years') selected @endif>
                                03 YEARS</option>
                            <option value="04 Years" @if (old('graduation_course_duration') == '04 Years') selected @endif>
                                04 YEARS</option>
                            <option value="05 Years" @if (old('graduation_course_duration') == '05 Years') selected @endif>
                                05 YEARS</option>
                        </select>
                        @error('graduation_course_duration')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="graduation_result">Result</label>
                        <select style="margin-top: auto;width: 100%"
                            class="form-control form-control-sm col-md-4 col-sm-4 @error('graduation_result') is-invalid @enderror"
                            id="graduation_result" name="graduation_result">
                            <option value="" selected>SELECT RESULT</option>
                            <option value="1ST DIVISION" @if (old('graduation_result') == '1ST DIVISION') selected @endif>
                                1ST DIVISION</option>
                            <option value="2ND DIVISION" @if (old('graduation_result') == '2ND DIVISION') selected @endif>
                                2ND DIVISION</option>
                            <option value="3RD DIVISION" @if (old('graduation_result') == '3RD DIVISION') selected @endif>
                                3RD DIVISION</option>
                            <option value="4" @if (old('graduation_result') == '4') selected @endif>
                                GPA(OUT OF 4)</option>
                            <option value="5" @if (old('graduation_result') == '5') selected @endif>
                                GPA(OUT OF 5)</option>
                        </select>
                        @error('graduation_result')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div id="graduation_gpa_div"
                            class="graduation_gpa input-group input-group-sm form-control-sm col-md-4 col-sm-4 @error('graduation_gpa') is-invalid @enderror">
                            <input id="graduation_gpa" disabled name="graduation_gpa" type="text"
                                class="form-control form-control-sm @error('graduation_gpa') is-invalid @enderror"
                                value="{{ old('graduation_gpa') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">GPA</span>
                            </div>
                            @error('graduation_gpa')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="graduation_subject">Subject/Degree(MAJOR)</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_subject') is-invalid @enderror"
                            id="graduation_subject" name="graduation_subject" style="width: 100%">
                            <option value="" selected>SELECT SUBJECT/DEGREE(MAJOR)</option>
                            @foreach ($graduation_subjects as $subject)
                                <option value="{{ $subject->name }}"
                                    @if (old('graduation_subject') == $subject->name) selected @endif>
                                    {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('graduation_subject')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="graduation_passing_year">Passing Year</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_passing_year') is-invalid @enderror"
                            id="graduation_passing_year" name="graduation_passing_year" style="width: 100%">
                            <option value="" selected>SELECT YEAR</option>
                            @for ($i = date('Y'); $i >= 1960; $i--)
                                <option value="{{ $i }}"
                                    @if (old('graduation_passing_year') == $i) selected @endif>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        @error('graduation_passing_year')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-4 col-sm-4"
                            for="graduation_institute">College/University</label>
                        <select
                            class="form-control text-uppercase form-control-sm col-md-8 col-sm-8 @error('graduation_institute') is-invalid @enderror"
                            id="graduation_institute" onchange="other_institute(this.id)" name="graduation_institute"
                            style="width: 100%">
                            <option value="" selected="selected">SELECT INSTITUTE</option>
                            @foreach ($graduation_institutes as $institute)
                                <option value="{{ $institute->name }}"
                                    @if (old('graduation_institute') == $institute->name) selected @endif>
                                    {{ App\Classes\StringConversion::stringToUpper($institute->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('graduation_institute')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="new_institute_graduation_div" class="form-group row">

                    </div>

                </div>
            </div>
        </div>

        <div id="masters" class="col-md-12 col-lg-12 mb-2">
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <div class="form-check form-check-inline">
                        <h5>Masters or Equivalent Level</h5> &nbsp &nbsp
                        <input class="form-check-input " type="checkbox" id="if_masters">
                        <label class="form-check-label " for="if_masters">If Applicable</label>
                    </div>
                </div>
                <div class="card-body">
                    <fieldset id="fieldset_masters" disabled>
                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                for="masters_examination">Examination</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_examination') is-invalid @enderror"
                                id="masters_examination" name="masters_examination" style="width: 100%">
                                <option value="">SELECT EXAM</option>
                                <option value="M.A" @if (old('masters_examination') == 'M.A') selected @endif>
                                    M.A</option>
                                <option value="M.S.S" @if (old('masters_examination') == 'M.S.S') selected @endif>
                                    M.S.S</option>
                                <option value="M.Sc" @if (old('masters_examination') == 'M.Sc') selected @endif>
                                    M.Sc</option>
                                <option value="M.Com" @if (old('masters_examination') == 'M.Com') selected @endif>
                                    M.COM</option>
                                <option value="M.B.A" @if (old('masters_examination') == 'M.B.A') selected @endif>
                                    M.B.A</option>
                                <option value="L.L.M" @if (old('masters_examination') == 'L.L.M') selected @endif>
                                    L.L.M</option>
                                <option value="M.Phil" @if (old('masters_examination') == 'M.Phi') selected @endif>
                                    M.PHIL</option>
                                <option value="Kamil" @if (old('masters_examination') == 'Kamil') selected @endif>
                                    KAMIL</option>
                                <option value="Others" @if (old('masters_examination') == 'Others') selected @endif>
                                    OTHER</option>
                                <option value="Masters Equivalent"
                                    @if (old('masters_examination') == 'Masters Equivalent') selected @endif>MASTERS EQUIVALENT
                                </option>
                            </select>
                            @error('masters_examination')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                for="masters_course_duration">Course Duration</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_course_duration') is-invalid @enderror"
                                id="masters_course_duration" name="masters_course_duration" style="width: 100%">
                                <option value="" selected="selected">SELECT DURATION</option>
                                <option value="01 Year" @if (old('masters_course_duration') == '01 Year') selected @endif>
                                    01 YEAR</option>
                                <option value="02 Years" @if (old('masters_course_duration') == '02 Years') selected @endif>02 YEARS
                                </option>
                                <option value="03 Years" @if (old('masters_course_duration') == '03 Years') selected @endif>03 YEARS
                                </option>
                                <option value="04 Years" @if (old('masters_course_duration') == '04 Years') selected @endif>04 YEARS
                                </option>
                                <option value="05 Years" @if (old('masters_course_duration') == '05 Years') selected @endif>05 YEARS
                                </option>
                            </select>
                            @error('masters_course_duration')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                for="masters_institute">University/Institute</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_institute') is-invalid @enderror"
                                id="masters_institute" onchange="other_institute(this.id)" name="masters_institute"
                                style="width: 100%">
                                <option value="" selected="selected">SELECT INSTITUTE</option>
                                @foreach ($masters_institutes as $institute)
                                    <option value="{{ $institute->name }}"
                                        @if (old('masters_institute') == $institute->name) selected @endif>
                                        {{ App\Classes\StringConversion::stringToUpper($institute->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('masters_institute')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                for="masters_result">Result</label>
                            <select style="margin-top: 5px;width: 100%"
                                class="form-control form-control-sm col-md-2 col-sm-2 @error('masters_result') is-invalid @enderror"
                                id="masters_result" name="masters_result">
                                <option value="" selected>SELECT RESULT</option>
                                <option value="1ST DIVISION" @if (old('masters_result') == '1ST DIVISION') selected @endif>1ST
                                    DIVISION
                                </option>
                                <option value="2ND DIVISION" @if (old('masters_result') == '2ND DIVISION') selected @endif>2ND
                                    DIVISION
                                </option>
                                <option value="3RD DIVISION" @if (old('masters_result') == '3RD DIVISION') selected @endif>3RD
                                    DIVISION
                                </option>
                                <option value="4" @if (old('masters_result') == '4') selected @endif>
                                    GPA(OUT OF 4)
                                </option>
                                <option value="5" @if (old('masters_result') == '5') selected @endif>
                                    GPA(OUT OF 5)
                                </option>
                            </select>
                            @error('masters_result')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div id="masters_gpa_div"
                                class="masters_gpa input-group input-group-sm form-control-sm col-md-2 col-sm-2 @error('masters_gpa') is-invalid @enderror">
                                <input id="masters_gpa" disabled name="masters_gpa" type="text"
                                    class="form-control form-control-sm @error('masters_gpa') is-invalid @enderror"
                                    value="{{ old('masters_gpa') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">GPA</span>
                                </div>
                                @error('masters_gpa')
                                    <span class="invalid-feedback text-md-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="new_institute_masters_div" class="form-group row">

                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                for="masters_subject">Degree/Subject(Major)</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_subject') is-invalid @enderror"
                                id="masters_subject" name="masters_subject" style="width: 100%">
                                <option value="" selected>SELECT DEGREE/SUBJECT(Major)</option>
                                @foreach ($masters_subjects as $subject)
                                    <option value="{{ $subject->name }}"
                                        @if (old('masters_subject') == $subject->name) selected @endif>
                                        {{ App\Classes\StringConversion::stringToUpper($subject->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('masters_subject')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label class="col-form-label col-form-label-sm col-md-2 col-sm-2"
                                for="masters_passing_year">Passing Year</label>
                            <select
                                class="form-control text-uppercase form-control-sm col-md-4 col-sm-4 @error('masters_passing_year') is-invalid @enderror"
                                id="masters_passing_year" name="masters_passing_year" style="width: 100%">
                                <option value="" selected>SELECT YEAR</option>
                                @for ($i = date('Y'); $i >= 1960; $i--)
                                    <option value="{{ $i }}"
                                        @if (old('masters_passing_year') == $i) selected @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('masters_passing_year')
                                <span class="invalid-feedback text-md-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="more_educations">

    </div>

    <div class="text-center mt-2">
        <button type="button" class="btn btn-sm btn-outline-success mb-4" id="add_more_education">Add
            More Educational Qualification</button>
    </div>

    <div id="professional_experience" class="col-md-12 col-lg-12 pl-0 pr-0">
        <div class="card">
            <div class="card-header bg-info text-white text-center">
                <div class="form-check form-check-inline">
                    <h5>Professional/Other Experiences</h5> &nbsp &nbsp
                </div>
            </div>
            <div class="card-body">
                <fieldset id="fieldset_professional">
                    <div class="form-group row">
                        <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                            for="professional_designation">Designation/Post</label>
                        <input
                            class="form-control form-control-sm col-md-4 col-sm-4 mt-2 @error('professional_designation') is-invalid @enderror"
                            id="professional_designation" name="professional_designation[]" style="width: 100%"
                            value="{{ old('professional_designation') }}">
                        @error('professional_designation')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2"
                            for="professional_from_date">From</label>
                        <input type="date" class="form-control col-md-2 col-sm-2 mt-2" placeholder="DD-MM-YYYY"
                            name="professional_from_date[]">
                        <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2"
                            for="professional_to_date">To</label>
                        <input type="date" class="form-control col-md-2 col-sm-2 mt-2" placeholder="DD-MM-YYYY"
                            name="professional_to_date[]">
                        @error('professional_from_date')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('professional_to_date')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                            for="professional_organization">Organization Name</label>
                        <input
                            class="form-control form-control-sm col-md-4 col-sm-4 mt-2 @error('professional_organization') is-invalid @enderror"
                            id="professional_organization" name="professional_organization[]" style="width: 100%">
                        @error('professional_organization')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                            for="professional_duration">Duration</label>
                        <input
                            class="form-control form-control-sm col-md-4 col-sm-4 mt-2 @error('professional_duration') is-invalid @enderror"
                            id="professional_duration" name="professional_duration" style="width: 100%" readonly>
                        @error('professional_duration')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}

                        <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2"
                            for="professional_responsibilities">Responsibilities</label>
                        <textarea class="form-control form-control-sm col-md-4 col-sm-4 mt-2" name="professional_responsibilities"
                            id="professional_responsibilities" cols="5" rows="3"></textarea>
                        @error('professional_responsibilities')
                            <span class="invalid-feedback text-md-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="row" id="more_professionals">

        </div>

        <div class="text-center mt-2">
            <button type="button" class="btn btn-sm btn-outline-primary mb-4" id="add_more_professional">Add More
                Professional/Other Experience</button>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Next</button>
        </div>
    </div>
</form>
