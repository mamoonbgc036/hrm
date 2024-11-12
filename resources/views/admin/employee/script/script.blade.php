<script>
    // function show_allowance_dedcution_for_grade(grade_id) {
    //     // $('#salary_tab').css('display', 'block');
    //     $('#salary_tab').css('display', 'block');
    //     let url = "{{ route('allowance_deductions', ':grade_value') }}".replace(':grade_value', grade_id);
    //     $.ajax({
    //         url: url,
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(data) {
    //             console.log(data);
    //         }
    //     })
    // }
    $('#add_job_position').click(function(e) {
        // e.preventDefault();
    })

    // document.getElementById('marital_status').addEventListener('change', function() {
    //     console.log('okkk')
    //     var spouseInfo = document.getElementById('spouse_info');
    //     if (this.value === 'married') {
    //         spouseInfo.style.display = 'block';
    //     } else {
    //         spouseInfo.style.display = 'none';
    //     }
    // });

    $(document).on('change', '.pa_division_id, pr_division_id', function(e) {
        e.preventDefault();
        let element = $(this);
        let division_id = $(this).val();
        let url = '{{ route('get.districts', ':id') }}'.replace(':id', division_id);
        $.ajax({
            url: url,
            type: 'GET',
            // headers: {
            //     'X-CSRF-TOKEN': '{{ csrf_token() }}'
            // },
            success: function(data) {
                element.closest('.row').find('.pa_district_id, .pr_district_id').empty();
                let add = '<option value="" selected>Select a district</option>';
                $.each(data, function(index, item) {
                    add += `<option value="${item.id}">${item.name}</option>`;
                })
                element.closest('.row').find('.pa_district_id, .pr_district_id').append(add);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        })
    });

    $(document).on('change', '#police_station_id', function(e) {
        let station_id = $(this).val();
        let url = '{{ route('get-thanas', ':id') }}'.replace(':id', station_id);
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('.region').val(response.division.name);
                $('.zone').val(response.district.name);
                $('.region_id').val(response.division.id);
                $('.zone_id').val(response.district.id);
            }
        });
    })

    $(document).on('change', '.pa_district_id, .pr_district_id', function(e) {
        e.preventDefault();
        let district_id = $(this).val();
        let url = '{{ route('all-thanas', ':id') }}'.replace(':id', district_id);

        // Cache `this` to use it inside the success callback
        let element = $(this);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                console.log(data, 'thanas');
                element.closest('.row').find('.station_select, .pa_upazila_id, .pr_upazila_id')
                    .empty();
                let add = `<option value="" selected>Select Upazila/Thana</option>`;
                $.each(data, function(index, item) {
                    add += `<option value="${item.id}">${item.name}</option>`;
                });
                element.closest('.row').find('.station_select, .pa_upazila_id, .pr_upazila_id')
                    .append(add);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    });


    $(document).ready(function() {
        $('.addMoreNominee').click(function(e) {
            e.preventDefault();
            var dom_for_append = $('.dom_for_clone:first').clone();
            $('.dom_for_append').append(dom_for_append);
        })

        $(document).on('click', '.dom_remove_for_nominee', function(e) {
            e.preventDefault();
            if ($('.dom_for_clone').length > 1) {
                $(this).closest('.dom_for_clone').remove();
            } else {
                alert("At least one training section is required.");
            }
        });
        $('#add-experience').click(function() {
            var newExperience = $('.add-more-exper:first').clone();
            newExperience.find('input[type="text"], input[type="date"], textarea').val('');
            newExperience.find('select').prop('selectedIndex', 0);
            $('.add-experience').append(newExperience);
        });

        $(document).on('click', '.remove-experience', function(e) {
            e.preventDefault();
            if ($('.add-more-exper').length > 1) {
                $(this).closest('.add-more-exper').remove();
            } else {
                alert("At least one experience section is required.");
            }
        });

        $('#add-disease').click(function() { 
            // var newDisease = $('.add-more-disease:first').clone();
            var newDisease = $('.add-more-disease-template').clone().removeClass('add-more-disease-template d-none');
            newDisease.find('input[type="text"], input[type="date"], textarea').val('');
            newDisease.find('select').prop('selectedIndex', 0);
            // $('.add-disease').append(newDisease);
            $('.add-disease:last').after(newDisease);
        });

        $(document).on('click', '.remove-disease', function(e) {
            e.preventDefault();
            if ($('.add-more-disease').length > 1) {
                $(this).closest('.add-more-disease').remove();
            } else {
                alert("At least one disease section is required.");
            }
        });

        $('#add-training').on('click', function() {
            var newTraining = $('.training-group:first').clone();
            // Get the current number of training groups to determine the new index
            var index = $('#training-fields .training-group').length;

            // Update the name attributes for inputs in the cloned element to reflect the new index
            newTraining.find('input, textarea').each(function() {
                var name = $(this).attr('name');
                var newName = name.replace(/\[\d+\]/, '[' + index + ']');
                $(this).attr('name', newName);
            });
            newTraining.find('input, textarea').val('');
            // Find the hidden employee_id input in the cloned element and set its value
            var sessionEmployeeId = @json(Session::get('employee_id', Session::get('employee_id'))); // Pass employee_id to JavaScript
            newTraining.find('.employee_id_input').val(sessionEmployeeId);
            $('#training-fields').append(newTraining);
        });

        // Remove training section
        $(document).on('click', '.remove-training', function() {
            if ($('.training-group').length > 1) {
                $(this).closest('.training-group').remove();
            } else {
                alert("At least one training section is required.");
            }
        });
    });
</script>
<script>
    $('document').ready(function() {
        // nominee----------
        let vm1 = new Vue({
            el: '#nominee',
            data: {
                nominee_inputs: [],
                percentage: [],
            },
            methods: {
                addMoreNominee() {
                    this.nominee_inputs.push(1);
                },
                removeId(index) {
                    this.nominee_inputs.splice(this.nominee_inputs.indexOf(index), 1);
                },
                valid(index) {
                    alert(index)
                    let sum = 0
                    this.nominee_inputs.forEach(function(nominee) {
                        sum += (parseInt(nominee.percentage));
                        console.log(sum)
                    });
                    if (sum > 100) {
                        // this.nominee_inputs[index].percentage = sum-100; //---NOT WORKING AS EXPECTED---//
                        toastr.error(
                            'Total sum of percentages can\'t be more than 100%, Currently you are trying to give ' +
                            sum + '%!', {
                                closeButton: true,
                                progressBar: true,
                            });
                    }
                    if (this.nominee_inputs[index].percentage < 0) {
                        this.nominee_inputs[index].percentage = 0
                        toastr.error('Percentage must be greater than 0', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                }
            },
        });

        //multiple spouse add
        let vue = new Vue({
            el: '#vue_personal',
            data: {
                marital_status: '',
                districts: {!! $districts !!},
                spouse_inputs: [{
                    name: '',
                    tin: '',
                    profession: '',
                    district: '',
                    total_child: '',
                    picture: '',
                }],
            },
            methods: {
                addMoreSpouse() {
                    this.spouse_inputs.push({
                        name: '',
                        tin: '',
                        profession: '',
                        district: '',
                        total_child: '',
                        picture: '',
                    });
                },
                removeId(row) {
                    this.spouse_inputs.splice(this.spouse_inputs.indexOf(row), 1);
                },
            },
            mounted: function() {

            }
        });

        $('#dob').change(function() {
            fetchAge();

            var birth_date = moment($('#dob').val(), 'DD-MM-YYYY');
            var duration = moment(birth_date.add(59, 'y')).format('DD-MM-YYYY');
            $('#lpr_date').val(duration);
        });

        //fetch duration of date
        function fetchAge() {
            var birth_date = moment($('#dob').val(), 'DD-MM-YYYY');
            var today_date = moment();

            if (birth_date.isValid() && today_date.isValid()) {
                var duration = moment.duration(today_date.diff(birth_date));
                if (duration.years() === 0 && duration.months() === 0) {
                    output = duration.days() + ' days';
                } else if (duration.years() === 0 && duration.months() !== 0) {
                    output = duration.months() + ' months ' + duration.days() + ' days';
                } else {
                    output = duration.years() + ' years ' + duration.months() + ' months ' + duration.days() +
                        ' days';
                }
                $('#age').val(output);
            } else {
                console.log('Invalid date(s).')
            }
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            localStorage.setItem('lastTab1', $(this).attr('href'));
        });

        let lastTab = localStorage.getItem('lastTab1');
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }

        //if present address same as permanent address
        $('#sameAsPresent').change(function() {
            let checkBox = $(this).prop("checked");
            if (checkBox === true) {
                let pr_country_id = $('#pr_country_id').val();
                $('#pa_country_id').val(pr_country_id)

                let pr_division_id = $('#pr_division_id').val();
                $('#pa_division_id').val(pr_division_id)

                let pr_district_id = $('#pr_district_id').val();
                $('#pa_district_id').val(pr_district_id)

                let pr_upazila_id = $('#pr_upazila_id').val();
                $('#pa_upazila_id').val(pr_upazila_id)

                let pr_post_office = $('#pr_post_office').val();
                $('#pa_post_office').val(pr_post_office);

                let pr_postal_code = $('#pr_postal_code').val();
                $('#pa_postal_code').val(pr_postal_code);

                let pr_area = $('#pr_area').val();
                $('#pa_area').val(pr_area);

                let pr_u_c_c_w = $('#pr_u_c_c_w').val();
                $('#pa_u_c_c_w').val(pr_u_c_c_w);

                let pr_house_no = $('#pr_house_no').val();
                $('#pa_house_no').val(pr_house_no);

            }
        });

        $('#is_attached_to_station_or_office').change(function() {
            let select = $('#is_attached_to_station_or_office').val();
            if (select === 'YES') {
                $('#attached_station_or_office_div').show();
            } else {
                $('#attached_station_or_office_div').hide();
            }
        });

        $('#division_id').change(function() {
            let id = $('#division_id').val();
            $.ajax({
                url: '{{ url('fetch-district') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#district_id').html(data);
                }
            });
        });

        $('#district_id').change(function() {
            let id = $('#district_id').val();
            $.ajax({
                url: '{{ url('fetch-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#upazila_id').html(data);
                }
            });
        });

        $('#attached_division_id').change(function() {
            let id = $('#attached_division_id').val();
            $.ajax({
                url: '{{ url('fetch-district') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#attached_district_id').html(data);
                }
            });
        });

        $('#attached_district_id').change(function() {
            let id = $('#attached_district_id').val();
            $.ajax({
                url: '{{ url('fetch-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $('#attached_upazila_id').html(data);
                }
            });
        });

        $('#police_station_id').change(function() {
            let id = $('#police_station_id').val();
            $.ajax({
                url: '{{ route('fetch-division-district-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#division_id').val(data.division.name);
                    $('#district_id').val(data.district.name);
                    $('#upazila_id').val(data.upazila.name);
                }
            });
        });

        $('#attached_police_station_id').change(function() {
            let id = $('#attached_police_station_id').val();
            $.ajax({
                url: '{{ route('fetch-division-district-thana') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#attached_division_id').val(data.division.name);
                    $('#attached_district_id').val(data.district.name);
                    $('#attached_upazila_id').val(data.upazila.name);
                }
            });
        });

    });
</script>
<script>
    //image preview
    $(document).ready(function() {
        $('.guarantor_image').change(function() {
            var file = this.files[0];
            let app_image = $(this);

            // Ensure a file is selected
            if (file) {
                var reader = new FileReader();

                // On file load, display the preview
                reader.onload = function(e) {
                    app_image.closest('.row').find('.guarentor_image_preview').attr('src', e.target
                        .result);
                }

                // Read the image file
                reader.readAsDataURL(file);
            }
        });

        $('.guarantor_signature').change(function(e) {
            const handle = $(this);
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    handle.closest('.row').find('.guarentor_signature_preview').attr('src', e.target
                        .result)
                }
                reader.readAsDataURL(file);
            }
        })

        $('.guarantor_signature_two').change(function(e) {
            const file = this.files[0];
            const handle = $(this);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    handle.closest('.row').find('.guarentor_signature_two_preview').attr('src', e
                        .target.result);
                }
                reader.readAsDataURL(file);
            }
        })
        $('.edit_employee_image').change(function(e) {
            const handle = $(this);
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    handle.closest('.row').find('#previewImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });

    //signature preview
    function preview_signature() {
        // alert('signature')
        let file = $("#signature_url").get(0).files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function() {
                $("#previewSignature").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    $(document).on('change', '.nominee_signature_url', function() {
        let input = this;

        // Check if a file is selected
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            // When the file is read, set the result (base64 encoded image) to the img tag's src
            reader.onload = function(e) {
                // Find the closest sibling with class 'preview_nominee_signature' and set the src
                $(input).siblings('.preview_nominee_signature').attr('src', e.target.result);
            }

            // Read the selected image file as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    });

    $(document).on('change', '.nominee_picture_url', function() {
        let input = this;

        // Check if a file is selected
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            // When the file is read, set the result (base64 encoded image) to the img tag's src
            reader.onload = function(e) {
                // Find the closest sibling with class 'preview_nominee_picture' and set the src
                $(input).siblings('.preview_nominee_picture').attr('src', e.target.result);
            }

            // Read the selected image file as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    });



    //signature preview
    function previewNomineePicture(input) {

        let file = input.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function() {
                $(input).parent().children('.preview_nominee_picture').attr('src', reader.result)
            }

            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    $(document).ready(function() {

        $('#masters_result').change(function() {
            let value = $('#masters_result').val()
            document.getElementById("masters_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#graduation_result').change(function() {
            let value = $('#graduation_result').val()
            document.getElementById("graduation_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#hsc_result').change(function() {
            let value = $('#hsc_result').val()
            document.getElementById("hsc_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#ssc_result').change(function() {
            let value = $('#ssc_result').val()
            document.getElementById("ssc_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#jsc_result').change(function() {
            let value = $('#jsc_result').val()
            document.getElementById("jsc_gpa").disabled = !(value >= 4 && value <= 5);
        });

        $('#if_masters').change(function() {
            if (this.checked) {
                $('#fieldset_masters').prop('disabled', false);
            } else {
                $('#fieldset_masters').prop('disabled', true);
            }
        });

    });

    $(document).ready(function() {
        let i = 0;
        $('#add_more_education').click(function() {
            i++;
            $('#more_educations').append('<div id="more_education' + i +
                '" class="col-md-12 col-lg-12 more_education' + i + '">' +
                '<div class="text-center"> <button type="button" class="btn btn-sm btn-outline-warning mt-4" id="' +
                i +
                '" onclick="remove_more_education(this.id)">Remove More Educational Qualification - ' +
                i + ' </button></div> ' +
                '<div class="card"> ' +
                '<div class="card-header bg-info text-white text-center"> <h5>More Educational Qualifications ' +
                i + '</h5> </div> ' +
                '<div class="card-body"> <div class="form-group row"> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][examination]">Examination</label> <input id="more_education[' + i +
                '][examination]" name="more_education[' + i +
                '][examination]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][duration]">Course Duration</label> <input id="more_education[' + i +
                '][duration]" name="more_education[' + i +
                '][duration]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][institute]">University/Institute</label> <input id="more_education[' + i +
                '][institute]" name="more_education[' + i +
                '][institute]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i +
                '][result]">Result</label> <select  class="form-control form-control-sm col-md-2 col-sm-2" id="' +
                i + '" onchange="get_more_id(' + i + ')" name="more_education[' + i +
                '][result]" style="width: 100%"> <option value="" selected>SELECT RESULT</option> <option value="1ST DIVISION">1ST DIVISION</option> <option value="2ND DIVISION">2ND DIVISION</option> <option value="3RD DIVISION">3RD DIVISION</option> <option value="4">GPA(OUT OF 4)</option> <option value="5">GPA(OUT OF 5)</option> </select> ' +
                '<div id="more_gpa_div' + i + '" class="more_gpa' + i +
                ' input-group input-group-sm form-control-sm col-md-2 col-sm-2"> <input id="gpa' +
                i + '" disabled name="more_education[' + i +
                '][gpa]" type="text" class="form-control form-control-sm" value=""> <div class="input-group-append"> <span class="input-group-text">GPA</span> </div> </div> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i + '][subject]">Degree/Subject</label> <input id="more_education[' + i +
                '][subject]" name="more_education[' + i +
                '][subject]" type="text" class="form-control form-control-sm col-md-4 col-sm-4" value=""> ' +
                '<label class="col-form-label col-form-label-sm col-md-2 col-sm-2" for="more_education[' +
                i +
                '][passing_year]">Passing Year</label> <input class="form-control form-control-sm col-md-4 col-sm-4" id="more_education[' +
                i + '][passing_year]" name="more_education[' + i +
                '][passing_year]" style="width: 100%"> </div> </div> </div> </div>')

        });

        $('#add_more_professional').click(function() {
            // alert(i)
            i++;
            $('#more_professionals').append('<div id="more_professional' + i +
                '" class="col-md-12 col-lg-12 more_professional' + i +
                '"> <div class="text-center"> <button type="button" class="btn btn-sm btn-outline-warning mt-4" id="' +
                i +
                '" onclick="remove_more_professional(this.id)">Remove More Professional Experiences - ' +
                i +
                ' </button> </div> <div class="card"> <div class="card-header bg-info text-white text-center"> <h5>More Professional Experiences ' +
                i +
                '</h5> </div> <div class="card-body"> <div class="form-group row"> <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2" for="professional_designation' +
                i +
                '">Designation/Post</label> <input class="form-control form-control-sm col-md-4 col-sm-4 mt-2" id="professional[' +
                i + '][designation]" name="professional[' + i +
                '][designation]" style="width: 100%"> <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2" for="professional[' +
                i +
                '][from_date]">From</label> <input type="date" class="form-control demoDate col-md-2 col-sm-2 mt-2" placeholder="DD-MM-YYYY" id="professional[' +
                i + '][from_date]" name="professional[' + i +
                '][from_date]" > <label class="col-form-label col-form-label-sm col-md-1 col-sm-1 mt-2" for="professional[' +
                i +
                '][to_date]">To</label> <input type="date" class="form-control demoDate col-md-2 col-sm-2 mt-2" placeholder="DD-MM-YYYY" id="professional[' +
                i + '][to_date]" name="professional[' + i +
                '][to_date]" > <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2" for="professional[' +
                i +
                '][organization]">Organization Name</label> <input class="form-control form-control-sm col-md-4 col-sm-4 mt-2" id="professional[' +
                i + '][organization]" name="professional[' + i +
                '][organization]" style="width: 100%"> <label class="col-form-label col-form-label-sm col-md-2 col-sm-2 mt-2" for="professional[' +
                i +
                '][responsibilities]">Responsibilities</label> <textarea class="form-control form-control-sm col-md-4 col-sm-4 mt-2" name="professional[' +
                i + '][responsibilities]" id="professional[' + i +
                '][responsibilities]" cols="5" rows="3"></textarea> </div> </div> </div> </div>')
        });

        $('#professional_from_date').on('change keyup paste', function() {
            // difference date
            let from_date = $('#professional_from_date').val();
            let to_date = $('#professional_to_date').val();

            $.ajax({
                url: '{{ url('fetch-duration2') }}',
                type: 'get',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.output);
                    $('#professional_duration').val(data.output);
                }
            });
        });

        $('#professional_to_date').on('change keyup paste', function() {
            // difference date
            let from_date = $('#professional_from_date').val();
            let to_date = $('#professional_to_date').val();

            $.ajax({
                url: '{{ url('fetch-duration2') }}',
                type: 'get',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.output);
                    $('#professional_duration').val(data.output);
                }
            });
        });

    });

    function remove_more_education(id) {
        // alert(id)
        let className = 'more_education' + id;
        $("div").remove("." + className);
    }

    $(document).ready(function() {
        $('.demoSelect').select2();
    });

    function other_institute(id) {
        value = $('#' + id).val()
        let type = id.split("_")[0]
        // alert(type)
        if (type == 'graduation') {
            if (value == 'Others') {
                $('#new_institute_graduation_div').append(
                    '<input id="graduation_new_institute_input" name="graduation_new_institute" type="text" class="form-control form-control-sm col-8" value="">' +
                    '<button id="graduation_new_institute" type="button" onclick="add_institute(this.id)" class="btn btn-outline-info btn-sm col-4">Add New Institute</button>'
                )
            } else {
                $('#graduation_new_institute_input').remove()
                $('#graduation_new_institute').remove()
            }
        } else if (type == 'masters') {
            if (value == 'Others') {
                $('#new_institute_masters_div').append(
                    '<input id="masters_new_institute_input" name="masters_new_institute" type="text" class="form-control form-control-sm col-4" value="">' +
                    '<button id="masters_new_institute" type="button" onclick="add_institute(this.id)" class="btn btn-outline-info btn-sm col-2">Add New Institute</button>'
                )
            } else {
                $('#masters_new_institute_input').remove()
                $('#masters_new_institute').remove()
            }
        }
    }

    function add_institute(id) {
        let type = id.split("_")[0]
        // alert(type)
        if (type == 'graduation') {
            value = $('#graduation_new_institute_input').val().toUpperCase()
            $('#graduation_institute').append('<option value="' + value + '" selected>' + value + '</option>')
        } else if (type == 'masters') {
            value = $('#masters_new_institute_input').val().toUpperCase()
            $('#masters_institute').append('<option value="' + value + '" selected>' + value + '</option>')
        }
    }

    function remove_more_professional(id) {
        // alert(id)
        let className = 'more_professional' + id;
        $("div").remove("." + className);
    }

    function get_more_id(id) {
        let value = $('[name ="more_education[' + id + '][result]"]').val()
        console.log(id)
        document.getElementById('gpa' + id).disabled = !(value >= 4 && value <= 5);
    }

    $(document).ready(function() {
        $('#if_professional').change(function() {
            if (this.checked) {
                $('#fieldset_professional').prop('disabled', false);
                // $('#if_presently_working').prop('disabled', false);
            } else {
                $('#fieldset_professional').prop('disabled', true);
                // $('#if_presently_working').prop('disabled', true);
            }
        });
    });

    $(document).ready(function() {
        $('#if_journal').change(function() {
            if (this.checked) {
                $('#fieldset_journal').prop('disabled', false);
                // $('#if_presently_working').prop('disabled', false);
            } else {
                $('#fieldset_journal').prop('disabled', true);
                // $('#if_presently_working').prop('disabled', true);
            }
        });

        $('#add_more_journal').click(function() {
            // alert(i)
            i++;
            $('#more_journals').append('<div class="col-md-12 col-lg-12 more_journal' + i +
                ' "> <div class="text-center"> <button type="button" class="btn btn-sm btn-outline-warning mt-4" id="' +
                i + '" onclick="remove_more_journal(this.id)">Remove More Journal/Publication - ' +
                i +
                ' </button></div> <div class="card"> <div class="card-header bg-info text-white text-center"> <div class="form-check form-check-inline"> <h5>More Journal/Publication ' +
                i +
                '</h5> &nbsp &nbsp </div> </div> <div class="card-body"> <div class="row"> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][title]">Title</label> <input class="form-control" type="text" name="title[]" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][publication]">Publication/Publisher</label> <input class="form-control" type="text" name="publication[]" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][publication_date]">Publication Date</label> <input class="form-control demoDate" id="lpr_date" name="publication_date[]" type="date" placeholder="DD-MM-YYYY" autocomplete="off" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][author]">Author</label> <input class="form-control" type="text" name="author[]" value=""> </div> </div> <div class="col-md-4 col-sm-6"> <div class="form-group"> <label class="col-form-label col-form-label-sm" for="journal[' +
                i +
                '][publication_url]">Publication URL</label> <input class="form-control" type="text" name="publication_url[]" value=""> </div> </div> </div> </div> </div> <div class="row" id="more_journals"> </div> </div>'
            );
        });

    });

    function remove_more_journal(id) {
        // alert(id)
        let className = 'more_journal' + id;
        $("div").remove("." + className);
    }
</script>
{{-- // calculation of salary with allowance and deduction --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the select element

        var salarySelect = document.getElementById('s_grade_id');
        var effectiveBasicSalaryInput = document.getElementById('effective_basic_salary');

        // Check if the input element exists

        if (effectiveBasicSalaryInput) {

            effectiveBasicSalaryInput.addEventListener('input', function() {

                console.log('Effective Basic Salary:', effectiveBasicSalaryInput.value);
            });
        } else {
            console.log("effective salary not found");
        }
        var probation = document.getElementById("probation").value;

        if (salarySelect) {
            // Attach the onchange event listener
            salarySelect.addEventListener('change', function() {
                if ($('#probation').val() == 'Y' || $('#probation').val() == null) {
                    $('#salary_tab').css('display', 'none');
                } else {
                    $('#salary_tab').css('display', 'block');
                }

                // Get the selected value
                var selectedValue = salarySelect.value;

                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Configure it: GET-request for the URL /your-url?param=value
                xhr.open('GET', '/get-template/' + encodeURIComponent(selectedValue), true);

                // Set up a function to handle the response
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        //    calculate allowances
                        // Extract allowances
                        // Parse the response text into a JSON object
                        const response = JSON.parse(xhr.responseText);

                        // Extract allowances
                        const deductions = response.salary_template.deduction;
                        const allowances = response.salary_template.allowances;
                        // Clear previous allowances and deductions (if any)
                        document.getElementById('append_allowance').innerHTML = '';
                        document.getElementById('append_deduction').innerHTML = '';
                        // function for both allowance and deduction
                        function createRow(containerId, label, value) {
                            const row = document.createElement('div');
                            row.className = 'row';

                            // Create label column
                            const labelCol = document.createElement('div');
                            labelCol.className = 'col-6 d-flex justify-content-end';
                            labelCol.textContent = label;

                            // Create value column
                            const valueCol = document.createElement('div');
                            valueCol.className = 'col-6 d-flex justify-content-start';
                            valueCol.textContent = value;

                            // Append columns to row
                            row.appendChild(labelCol);
                            row.appendChild(valueCol);

                            // Append the row to the specified container
                            document.getElementById(containerId).appendChild(row);
                        }
                        // 
                        // Print all allowance values
                        allowances.forEach(allowance => {
                            // if(probation=="Y"){
                            //     var eff_allow=allowance.allowance_value/parseFloat(response.salary_template.basic_salary);
                            //     createRow('append_allowance', allowance.allowance_label,
                            //     eff_allow*parseFloat(effectiveBasicSalaryInput.value));
                            // }else if(probation=="N"){
                            createRow('append_allowance', allowance.allowance_label,
                                allowance.allowance_value);
                            // }

                        });
                        // Calculate the total sum of allowances
                        const totalAllowance = allowances.reduce((sum, allowance) => {
                            // if(probation=="Y"){
                            //     return sum + (parseFloat(allowance.allowance_value)/parseFloat(response.salary_template.basic_salary))*parseFloat(effectiveBasicSalaryInput.value); 
                            // }else if(probation=="N"){
                            return sum + parseFloat(allowance.allowance_value);
                            // }

                        }, 0);

                        // Print total allowance sum
                        document.getElementById("total_allowance").innerHTML = totalAllowance
                            .toFixed(2);
                        console.log('Total Allowance:', totalAllowance.toFixed(2));
                        // Print all deduction values
                        deductions.forEach(deduction => {
                            // console.log('deduction Value:', deduction.deduction_value);
                            createRow('append_deduction', deduction.deduction_label,
                                deduction.deduction_value);
                        });
                        // Calculate the total sum of allowances
                        const totaldeduction = deductions.reduce((sum, deduction) => {
                            return sum + parseFloat(deduction.deduction_value);
                        }, 0);

                        // Print total allowance sum
                        document.getElementById("total_deduction").innerHTML = totaldeduction
                            .toFixed(2);
                        console.log('Total deduction:', totaldeduction.toFixed(2));
                        // Extract and print basic salary
                        const basicSalary = parseFloat(response.salary_template.basic_salary);
                        document.getElementById("basic_salary").innerHTML = basicSalary;
                        console.log('Basic Salary:', basicSalary);

                        // Calculate the total salary including allowances
                        const totalSalary = (basicSalary + totalAllowance) - totaldeduction;
                        document.getElementById("total_salary").innerHTML = totalSalary.toFixed(2);
                        console.log('Total Salary (Basic + Allowances-deduction):', totalSalary
                            .toFixed(
                                2));

                        console.log(response);
                        // 
                        // console.log(xhr.responseText);
                    } else {
                        // Handle error
                        console.error('Request failed. Status:', xhr.status);
                    }
                };

                // Send the request
                xhr.send();
            });
        }
        // select employment type
        // Initialize employment type event listener

        const empTypeSelect = document.getElementById('emp_type');


    });
</script>
{{-- // --}}
{{-- //emploment type --}}
<script>
    function handleChange(value) {
        // console.log('Selected value:', value);
        if (value == 1) {
            document.getElementById("regular").style.display = "block";
            document.getElementById("contractual").style.display = "none";
            $('#salary_tab').css('display', 'none');
        } else if (value == 2) {
            document.getElementById("contractual").style.display = "block";
            document.getElementById("regular").style.display = "none";
        }
    }
</script>

{{-- // --}}
{{-- probation --}}
<script>
    window.onload = function() {
        var value = document.getElementById("probation").value;
        // console.log(value);
        isProbation(value);
    };
    function isProbation(value) {
        // console.log("Probation: " + value);
        if (value == "Y") {
            document.getElementById("probation_salary").style.display = "block";
            $('#salary_tab').css('display', 'none');
        } else {
            document.getElementById("probation_salary").style.display = "none";
            $('#salary_tab').css('display', 'block');
        }
    }
</script>

{{-- emergency contact part --}}
<script>
    // function addEmergency() {
    //     // Clone the element with ID 'copy-contact'
    //     let original = document.getElementById('copy-contact');
    //     let clone = original.cloneNode(true);

    //     // Reset input fields inside the cloned element
    //     clone.querySelectorAll('input, textarea, select').forEach(input => input.value = '');

    //     // Append the cloned element to the parent container
    //     document.getElementById('contact-container').appendChild(clone);
    // }
    function addEmergency() {
        // Clone the element with ID 'copy-contact'
        let original = document.getElementById('copy-contact');
        let clone = original.cloneNode(true);

        // Find the current number of contact groups to set the correct index for the new clone
        let contactGroups = document.querySelectorAll('#contact-container .cpycon');
        let newIndex = contactGroups.length; // This will be the new index for the cloned group

        // Update names and reset values inside the cloned element
        clone.querySelectorAll('input, textarea, select').forEach(input => {
            // Update the name attribute to the new index
            let name = input.getAttribute('name');
            if (name) {
                // Use regex to replace the index with the new index
                name = name.replace(/\[\d+\]/, `[${newIndex}]`);
                input.setAttribute('name', name);
            }
            // Clear input values for the cloned element
            input.value = '';
        });

        // Update IDs to avoid duplicates in the DOM
        clone.querySelectorAll('[id]').forEach(element => {
            let id = element.getAttribute('id');
            if (id) {
                element.setAttribute('id', id + '_' + newIndex);
            }
        });
        let hiddenEmployeeIdInput = clone.querySelector('input[name*="[employee_id]"]');
        if (hiddenEmployeeIdInput) {
            hiddenEmployeeIdInput.value = @json(Session::get('employee_id', 'null'));
        }
        // Append the cloned element to the parent container
        document.getElementById('contact-container').appendChild(clone);
    }
</script>
<script>
    function removeContact(button) {
        /// Find the closest div with the class 'contact-section' and remove it
        let contactSection = button.closest('.cpycon');

        // Ensure at least one contact remains
        if (document.querySelectorAll('.cpycon').length > 1) {
            contactSection.remove();
        } else {
            alert("At least one emergency contact is required.");
        }
    }
</script>
{{-- // --}}

{{-- add family members --}}
<script>
    function addFamilyCopy() {
        // Clone the element with ID 'copy-contact'
        let original = document.getElementById('familyCopy');
        let clone = original.cloneNode(true);

        // Reset input fields inside the cloned element
        clone.querySelectorAll('input, textarea, select').forEach(input => input.value = '');

        // Append the cloned element to the parent container
        document.getElementById('familyContainer').appendChild(clone);
    }
</script>
<script>
    function removeFamily(button) {
        /// Find the closest div with the class 'contact-section' and remove it
        let familySection = button.closest('.cpyfam');

        // Ensure at least one contact remains
        if (document.querySelectorAll('.cpyfam').length > 1) {
            familySection.remove();
        } else {
            alert("At least one family member is required.");
        }
    }
</script>
{{-- // --}}
{{-- //disease --}}
{{-- <script>
    function getMultipleDisease(selectElement) {
        // Get the selected option value and text
        const diseaseId = selectElement.value;
        const diseaseName = selectElement.options[selectElement.selectedIndex].text;

        // Clone the disease template
        const template = document.getElementById('disease_template');
        const clone = template.cloneNode(true);

        // Remove the 'id' attribute to avoid duplicates and make it visible
        clone.removeAttribute('id');
        clone.style.display = 'block';

        // Set the disease name in the cloned input field
        const diseaseNameInput = clone.querySelector('input[name="disease_name[]"]');
        diseaseNameInput.value = diseaseName;
        const diseaseIdInput = clone.querySelector('input[name="disease_id[]"]');
        diseaseIdInput.value = diseaseId;
        // Append the cloned element to the disease list container
        document.getElementById('disease_list').appendChild(clone);
    }
</script> --}}
<script>
    let diseaseIndex = 0; // Global index counter to keep track of the number of cloned elements

    function getMultipleDisease(selectElement) {
        // Get the selected option value and text
        const diseaseId = selectElement.value;
        const diseaseName = selectElement.options[selectElement.selectedIndex].text;

        // Clone the disease template
        const template = document.getElementById('disease_template');
        const clone = template.cloneNode(true);

        // Remove the 'id' attribute to avoid duplicates and make it visible
        clone.removeAttribute('id');
        clone.style.display = 'block';

        // Increment the index for unique names
        diseaseIndex++;

        // Set unique names and values for the cloned element
        const diseaseNameInput = clone.querySelector('input[name="disease[0][disease_name]"]');
        diseaseNameInput.name = `disease[${diseaseIndex}][disease_name]`;
        diseaseNameInput.value = diseaseName;

        const diseaseIdInput = clone.querySelector('input[name="disease[0][disease_id]"]');
        diseaseIdInput.name = `disease[${diseaseIndex}][disease_id]`;
        diseaseIdInput.value = diseaseId;

        const diseaseDescriptionTextarea = clone.querySelector('textarea[name="disease[0][disease_description]"]');
        diseaseDescriptionTextarea.name = `disease[${diseaseIndex}][disease_description]`;
        // Append the cloned element to the disease list container
        document.getElementById('disease_list').appendChild(clone);
    }

    function removeDisease(button) {
        // Remove the closest .training-group element
        button.closest('.row').remove();
    }
</script>

<script>
    function removeDisease(buttonElement) {
        // Remove the parent 'row' div of the clicked 'Remove' button
        const diseaseRow = buttonElement.closest('.row');
        diseaseRow.remove();
    }
</script>
{{-- // --}}
