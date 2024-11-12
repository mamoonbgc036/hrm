@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
<div class="row">
    <div class="col-sm-12" data-spy="scroll" data-offset="0">
        <div class="panel panel-custom"><!-- *********     Employee Search Panel ***************** -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>Payroll Summary</strong>
                </div>
            </div>
            <form id="form" role="form" enctype="multipart/form-data" action="https://ziscoerp.com/admin/payroll/payroll_summary" method="post" class="form-horizontal form-groups-bordered">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Search Type <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <select required="" name="search_type" id="search_type" class="form-control ">
                                <option value="">Select Search Type</option>
                                <option value="employee">By Employee</option>

                                <option value="month">By Month</option>

                                <option value="period">By Period</option>

                                <option value="activities">All Activities</option>

                            </select>
                        </div>
                    </div>

                    <div class="by_employee" style="display: none">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Employee Name                                <span class="required"> *</span></label>

                            <div class="col-sm-5">
                                <select class="by_employee form-control select_box select2-hidden-accessible" style="width: 100%" name="user_id" tabindex="-1" aria-hidden="true">
                                    <option value="">Select Employee...</option>
                                                                                                                        <optgroup label="Software Development">
                                                                                                    <option value="1">MD Nayeem ( Application Developer )</option>
                                                                                                    <option value="2">Joe D. Martin ( Application Developer )</option>
                                                                                                    <option value="11">Orla Whitley ( Application Developer )</option>
                                                                                                                                            </optgroup>
                                                                                    <optgroup label="Sales">
                                                                                                    <option value="3">Jorge M. Bailey ( Marketing )</option>
                                                                                                    <option value="8">hrr ( Marketing )</option>
                                                                                                                                            </optgroup>
                                                                                    <optgroup label="HR">
                                                                                                    <option value="6">Darren C. Bryant ( Admin )</option>
                                                                                                                                            </optgroup>
                                                                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-user_id-is-container"><span class="select2-selection__rendered" id="select2-user_id-is-container" title="Select Employee...">Select Employee...</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="by_month" style="display: none">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Select Month <span class="required"> *</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" value="" class="form-control monthyear by_month" name="by_month" data-format="yyyy/mm/dd">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="fa fa-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="by_period" style="display: none">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Start Month <span class="required"> *</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" value="" class="by_period form-control monthyear" name="start_month" data-format="yyyy/mm/dd">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="fa fa-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">End Month <span class="required"> *</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" value="" class="by_period form-control monthyear" name="end_month" data-format="yyyy/mm/dd">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="fa fa-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="border-none">
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-5">
                            <button id="submit" type="submit" name="flag" value="1" class="btn btn-primary btn-block">Go                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- ******************** Employee Search Panel Ends ******************** -->
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#login_back').change(function() {
                $('#login_bk_display').css('visibility', 'visible');
                const file = $(this)[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#login_bk_display').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#company_logo').change(function() {
                $('#company_logo_display').css('visibility', 'visible');
                const file = $(this)[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#company_logo_display').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#login_bk_small').change(function() {
                $('#login_bk_small_display').css('visibility', 'visible');
                const file = $(this)[0].files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#login_bk_small_display').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
