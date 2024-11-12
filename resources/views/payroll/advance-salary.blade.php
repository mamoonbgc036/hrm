@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
<div class="row">
    <div class="col-lg-12">
                                
<div class="panel panel-custom">
<div class="panel-heading">
<div class="panel-title">
<strong>Employee Salary Details</strong>
</div>
</div>

<!-- Table -->
<div id="DataTables_wrapper" class="dataTables_wrapper form-inline no-footer"><div class="dataTables_length" id="DataTables_length"><label><select name="DataTables_length" aria-controls="DataTables" class="form-control input-sm"><option value="10">10</option><option value="20">20</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div><div class="dt-buttons"><a class="dt-button buttons-print btn btn-danger btn-xs mr" tabindex="0" aria-controls="DataTables"><span><i class="fa fa-print"> </i></span></a><a class="dt-button buttons-print btn btn-success mr btn-xs" tabindex="0" aria-controls="DataTables"><span><i class="fa fa-print"> </i> &nbsp;selected</span></a><a class="dt-button buttons-excel buttons-html5 btn btn-purple mr btn-xs" tabindex="0" aria-controls="DataTables"><span><i class="fa fa-file-excel-o"> </i></span></a><a class="dt-button buttons-csv buttons-html5 btn btn-primary mr btn-xs" tabindex="0" aria-controls="DataTables"><span><i class="fa fa-file-excel-o"> </i></span></a><a class="dt-button buttons-pdf buttons-html5 btn btn-info mr btn-xs" tabindex="0" aria-controls="DataTables"><span><i class="fa fa-file-pdf-o"> </i></span></a><a class="dt-button btn btn-xs btn-default custom-bulk-button" tabindex="0" aria-controls="DataTables"><span>Bulk Delete</span></a></div><div id="DataTables_filter" class="dataTables_filter"><label>Search all columns:<input type="search" class="form-control input-sm" placeholder="" aria-controls="DataTables"></label></div><div id="DataTables_processing" class="dataTables_processing" style="display: none;">Processing...</div><table class="table table-striped DataTables  dataTable no-footer dtr-inline" id="DataTables" cellspacing="0" width="100%" role="grid" aria-describedby="DataTables_info" style="width: 100%;">
<thead>
<tr role="row"><th class="col-sm-1 sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1" style="width: 122px;" aria-label="EMP ID: activate to sort column ascending">EMP ID</th><th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1" style="width: 351px;" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1" style="width: 369px;" aria-label="Salary Type: activate to sort column ascending">Salary Type</th><th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1" style="width: 347px;" aria-label="Basic Salary: activate to sort column ascending">Basic Salary</th><th class="sorting" tabindex="0" aria-controls="DataTables" rowspan="1" colspan="1" style="width: 388px;" aria-label="Overtime                    (Per Hour)
: activate to sort column ascending">Overtime                    <small>(Per Hour)</small>
</th></tr>
</thead>
<tbody>


<tr id="table_0" role="row" class="odd"><td tabindex="0">Vel qui eligendi omn</td><td>Orla Whitley</td><td> <small>(Hourly)</small></td><td>$ 0,00 <small>(Per Hour)</small></td><td>0</td></tr><tr id="table_1" role="row" class="even"><td tabindex="0">EMP-99166</td><td><a data-toggle="modal" data-target="#myModal_lg" class="text-info" href="https://ziscoerp.com/admin/payroll/view_salary_details/1/6">Darren C. Bryant</a></td><td>Grades A <small>(Monthly)</small></td><td>$ 2.500,00</td><td>$ 15,00</td></tr><tr id="table_2" role="row" class="odd"><td tabindex="0">EMP-000017</td><td>Jorge M. Bailey</td><td>Hourly A <small>(Hourly)</small></td><td>$ 25,00 <small>(Per Hour)</small></td><td>0</td></tr><tr id="table_3" role="row" class="even"><td tabindex="0">EMP-44305</td><td>Joe D. Martin</td><td>Hourly A <small>(Hourly)</small></td><td>$ 25,00 <small>(Per Hour)</small></td><td>0</td></tr><tr id="table_4" role="row" class="odd"><td tabindex="0">EMP-856985</td><td>MD Nayeem</td><td>Hourly A <small>(Hourly)</small></td><td>$ 25,00 <small>(Per Hour)</small></td><td>0</td></tr></tbody>
</table><div class="dataTables_info" id="DataTables_info" role="status" aria-live="polite">Showing 1 to 5 of 5 Entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="DataTables" tabindex="0" id="DataTables_previous"><a href="#">Previous</a></li><li class="paginate_button active" aria-controls="DataTables" tabindex="0"><a href="#">1</a></li><li class="paginate_button next disabled" aria-controls="DataTables" tabindex="0" id="DataTables_next"><a href="#">Next</a></li></ul></div></div>
</div>                    </div>
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
