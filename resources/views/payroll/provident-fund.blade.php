@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
<div class="row">
    <div class="col-lg-12">
                                <!-- ************ Expense Report List start ************-->

<div class="row">
<div class="col-sm-3">
<form id="existing_customer" action="https://ziscoerp.com/admin/payroll/provident_fund" method="post">
<label for="field-1" class="control-label pull-left holiday-vertical"><strong>Year:</strong></label>
<div class="col-sm-8">
<input type="text" name="year" class="form-control years" value="2024" data-format="yyyy">
</div>
<button type="submit" data-toggle="tooltip" data-placement="top" title="" class="btn btn-purple pull-right" data-original-title="Search">
<i class="fa fa-search"></i></button>
</form>
</div>
</div>

<div id="advance_salary">
<div class="show_print" style="width: 100%; border-bottom: 2px solid black;margin-bottom: 20px;">
<table style="width: 100%; vertical-align: middle;">
<tbody><tr>
<td style="width: 50px; border: 0px;">
    <img style="width: 50px;height: 50px;margin-bottom: 5px;" src="https://ziscoerp.com/uploads/Zisco-ERP.png" alt="" class="img-circle">
</td>

<td style="border: 0px;">
    <p style="margin-left: 10px; font: 14px lighter;">ZiscoERP - Powerful HR, Accounting, CRM System</p>
</td>
</tr>
</tbody></table>
</div><!--            show when print start-->
<div class="row">
<div class="col-md-2 hidden-print"><!-- ************ Expense Report Month Start ************-->
<ul class="mt nav nav-pills nav-stacked navbar-custom-nav">
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#January">
            <i class="fa fa-fw fa-calendar"></i> January </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#February">
            <i class="fa fa-fw fa-calendar"></i> February </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#March">
            <i class="fa fa-fw fa-calendar"></i> March </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#April">
            <i class="fa fa-fw fa-calendar"></i> April </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#May">
            <i class="fa fa-fw fa-calendar"></i> May </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#June">
            <i class="fa fa-fw fa-calendar"></i> June </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#July">
            <i class="fa fa-fw fa-calendar"></i> July </a>
    </li>
                    <li class="active">
        <a aria-expanded="true" data-toggle="tab" href="#August">
            <i class="fa fa-fw fa-calendar"></i> August </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#September">
            <i class="fa fa-fw fa-calendar"></i> September </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#October">
            <i class="fa fa-fw fa-calendar"></i> October </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#November">
            <i class="fa fa-fw fa-calendar"></i> November </a>
    </li>
                    <li class="">
        <a aria-expanded="false" data-toggle="tab" href="#December">
            <i class="fa fa-fw fa-calendar"></i> December </a>
    </li>
            </ul>
</div><!-- ************ Expense Report Month End ************-->
<div class="col-md-10"><!-- ************ Expense Report Content Start ************-->
<div class="tab-content pl0">
                    <div id="January" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> January 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/1" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="February" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> February 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/2" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="March" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> March 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/3" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="April" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> April 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/4" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="May" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> May 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/5" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="June" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> June 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/6" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="July" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> July 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/7" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="August" class="tab-pane active">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> August 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/8" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="September" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> September 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/9" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="October" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> October 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/10" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="November" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> November 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/11" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
                    <div id="December" class="tab-pane ">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><i class="fa fa-calendar"></i> December 2024                                    </strong>
                    <div class="pull-right hidden-print">
                            <span class="hidden-print"><a href="https://ziscoerp.com/admin/payroll/provident_fund_pdf/2024/12" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"><span <i="" class="fa fa-file-pdf-o"></span></a></span>
                    </div>
                </div>

            </div>
            <!-- Table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                                                                                    <tr><td colspan="6">
                        <strong>Nothing to display here!</strong>
                    </td>
                                                </tr></tbody>
            </table>
        </div>
    </div>
            </div>
</div><!-- ************ Expense Report Content Start ************-->
</div><!-- ************ Expense Report List End ************-->

</div>
<script type="text/javascript">
function advance_salary(advance_salary) {
var printContents = document.getElementById(advance_salary).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}
</script>
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
