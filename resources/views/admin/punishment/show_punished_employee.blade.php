@extends('layouts.app')
@section('title','View Punished Employee')
@push('css')
    <style>
        label{
            font-size: 1em !important;
        }
    </style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Show Punished Employee </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
            <div class="tile-title-w-btn">
                <h4 class="title"><i class="fa fa-joomla fa-lg"></i>
                    <span>
                        <a class="text-success" href="{{route('punishment.show',$punishment->id)}}" data-toggle="tooltip" title="Leave Show">{{ $punishment->name }}
                        </a>
                    </span>
                    Details for
                    <span>
                        <a class="text-primary" href="{{route('employee.show',$pivot->employee_id)}}" data-toggle="tooltip" title="Employee Show">{{ \App\Models\Employee::findOrFail($pivot->employee_id)->name }}</a>
                    </span>
                </h4>
                <p><a class="btn btn-primary btn-sm icon-btn" href="{{route('punishment.show',$punishment->id)}}"><i class="fa fa-backward"></i>Back To Punishment</a></p>
            </div>
            <div class="row">

                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <input type="hidden" value="{{ $pivot->id }}" name="pivot_id">
                        <input type="hidden" value="{{ $punishment->id }}" name="punishment_id">
                        <label class="col-form-label" for="complaint_description">Complaint Description</label>
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="complaint_description" type="text"  placeholder="Complaint Description" value="{{ old('complaint_description',$pivot->complaint_description) }}" readonly>
                                @error('complaint_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->complaint_file) }}"
                                       id="attachment-source1" />
                                @if($pivot->complaint_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('1')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="departmental_case_memo_no_date_and_section">Departmental Case Memo No, Date & Section</label>
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="departmental_case_memo_no_date_and_section" type="text"  placeholder="Departmental Case Memo No, Date & Section" value="{{ old('departmental_case_memo_no_date_and_section',$pivot->departmental_case_memo_no_date_and_section) }}" readonly>
                                @error('departmental_case_memo_no_date_and_section')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                </label>
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->departmental_case_file) }}" id="attachment-source2" />
                                @if($pivot->departmental_case_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('2')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="settlement_punishment_memo_date_and_description_of_punishment">Settlement /Punishment Memo, Dateand Description of Punishment</label>
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="settlement_punishment_memo_date_and_description_of_punishment" type="text"  placeholder="Settlement /Punishment Memo, Dateand Description of Punishment" value="{{ old('settlement_punishment_memo_date_and_description_of_punishment',$pivot->settlement_punishment_memo_date_and_description_of_punishment) }}" readonly>
                                @error('settlement_punishment_memo_date_and_description_of_punishment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                </label>
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->settlement_punishment_file) }}"
                                       id="attachment-source3" />
                                @if($pivot->settlement_punishment_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('3')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="appeal_and_disposal_order_along_with_the_secretary">Appeal and disposal order along with the Secretary</label>
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="appeal_and_disposal_order_along_with_the_secretary" type="text"  placeholder="Appeal and disposal order along with the Secretary" value="{{ old('appeal_and_disposal_order_along_with_the_secretary',$pivot->appeal_and_disposal_order_along_with_the_secretary) }}" readonly>
                                @error('appeal_and_disposal_order_along_with_the_secretary')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                </label>
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->appeal_and_disposal_file) }}"
                                       id="attachment-source4" />
                                @if($pivot->appeal_and_disposal_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('4')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="case_no_and_judgment_of_the_administrative_tribunal">Case No. and Judgment of the Administrative Tribunal</label>
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="case_no_and_judgment_of_the_administrative_tribunal" type="text"  placeholder="Case No. and Judgment of the Administrative Tribunal" value="{{ old('case_no_and_judgment_of_the_administrative_tribunal',$pivot->case_no_and_judgment_of_the_administrative_tribunal) }}" readonly>
                                @error('case_no_and_judgment_of_the_administrative_tribunal')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                </label>
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->case_no_and_judgment_file) }}"
                                       id="attachment-source5" />
                                @if($pivot->case_no_and_judgment_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('5')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="case_no_and_judgment_of_the_administrative_appeal_tribunal">Case No. and judgment of the Administrative Appeal Tribunal</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="case_no_and_judgment_of_the_administrative_appeal_tribunal" type="text"  placeholder="Case No. and judgment of the Administrative Appeal Tribunal" value="{{ old('case_no_and_judgment_of_the_administrative_appeal_tribunal',$pivot->case_no_and_judgment_of_the_administrative_appeal_tribunal) }}" readonly>
                                @error('case_no_and_judgment_of_the_administrative_appeal_tribunal')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                </label>
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->case_no_administrative_file) }}"
                                       id="attachment-source6" />
                                @if($pivot->case_no_administrative_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('6')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="leave_to_memo_no_and_judgement">Leave to Memo No.and Judgement</label>
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="leave_to_memo_no_and_judgement" type="text"  placeholder="Leave to Memo No.and Judgement" value="{{ old('leave_to_memo_no_and_judgement',$pivot->leave_to_memo_no_and_judgement) }}" readonly>
                                @error('leave_to_memo_no_and_judgement')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->leave_to_memo_file) }}"
                                       id="attachment-source7" />
                                @if($pivot->leave_to_memo_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('7')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="review_case_no_and_judgement">Review Case No. and Judgment</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="review_case_no_and_judgement" type="text"  placeholder="Review Case No. and Judgment" value="{{ old('review_case_no_and_judgement',$pivot->review_case_no_and_judgement) }}" readonly>
                                @error('review_case_no_and_judgement')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->review_case_no_file) }}"
                                       id="attachment-source8" />
                                @if($pivot->review_case_no_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('8')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="punishment_notice">Punishment Notice</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="punishment_notice" type="text"  placeholder="Punishment Notice" value="{{ old('punishment_notice',$pivot->punishment_notice) }}" readonly>
                                @error('punishment_notice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                </label>
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->punishment_notice_file) }}"
                                       id="attachment-source9" />
                                @if($pivot->punishment_notice)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('9')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="accused_reply">Accused Reply</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="accused_reply" type="text"  placeholder="Accused Reply" value="{{ old('accused_reply',$pivot->accused_reply) }}" readonly>
                                @error('accused_reply')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->accused_reply_file) }}"
                                       id="attachment-source10" />
                                @if($pivot->accused_reply_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('10')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="action_apply">Action</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="action_apply" type="text"  placeholder="Action" value="{{ old('action_apply',$pivot->action_apply) }}" readonly>
                                @error('action_apply')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->action_apply_file) }}"
                                       id="attachment-source11" />
                                @if($pivot->action_apply_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('11')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="disposal_verdict">Disposal Verdict</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="disposal_verdict" type="text"  placeholder="Disposal Verdict" value="{{ old('disposal_verdict',$pivot->disposal_verdict) }}" readonly>
                                @error('disposal_verdict')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->disposal_verdict_file) }}"
                                       id="attachment-source12" />
                                @if($pivot->disposal_verdict_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('12')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="additional_notes">Additional Notes</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="additional_notes" type="text"  placeholder="Additional Notes" value="{{ old('additional_notes',$pivot->additional_notes) }}" readonly>
                                @error('additional_notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->additional_notes_file) }}"
                                       id="attachment-source13" />
                                @if($pivot->additional_notes_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('13')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-sm-6 border">
                    <div class="form-group">
                        <label class="col-form-label" for="comments">Comments</label>

                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" id="comments" type="text"  placeholder="Comments" value="{{ old('comments',$pivot->comments) }}" readonly>
                                @error('comments')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" value="{{ asset('assets/punishment/attachments/'.$pivot->comments_file) }}"
                                       id="attachment-source14" />
                                @if($pivot->comments_file)
                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-lg" title="View" onclick="getAttachment('14')">
                                        <i class="fa fa-lg fa-eye"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                {{--<div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="complaint_description">Complaint Description</label>
                        <input disabled class="form-control" id="complaint_description" type="text" name="complaint_description" placeholder="Complaint Description" value="{{ old('complaint_description',$pivot->complaint_description) }}">
                        @error('complaint_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="departmental_case_memo_no_date_and_section">Departmental Case Memo No, Date & Section</label>
                        <input disabled class="form-control" id="departmental_case_memo_no_date_and_section" type="text" name="departmental_case_memo_no_date_and_section" placeholder="Departmental Case Memo No, Date & Section" value="{{ old('departmental_case_memo_no_date_and_section',$pivot->departmental_case_memo_no_date_and_section) }}">
                        @error('departmental_case_memo_no_date_and_section')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="settlement_punishment_memo_date_and_description_of_punishment">Settlement /Punishment Memo, Date and Description of Punishment</label>
                        <input disabled class="form-control" id="settlement_punishment_memo_date_and_description_of_punishment" type="text" name="settlement_punishment_memo_date_and_description_of_punishment" placeholder="Settlement /Punishment Memo, Dateand Description of Punishment" value="{{ old('settlement_punishment_memo_date_and_description_of_punishment',$pivot->settlement_punishment_memo_date_and_description_of_punishment) }}">
                        @error('settlement_punishment_memo_date_and_description_of_punishment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="appeal_and_disposal_order_along_with_the_secretary">Appeal and disposal order along with the Secretary</label>
                        <input disabled class="form-control" id="appeal_and_disposal_order_along_with_the_secretary" type="text" name="appeal_and_disposal_order_along_with_the_secretary" placeholder="Appeal and disposal order along with the Secretary" value="{{ old('appeal_and_disposal_order_along_with_the_secretary',$pivot->appeal_and_disposal_order_along_with_the_secretary) }}">
                        @error('appeal_and_disposal_order_along_with_the_secretary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="case_no_and_judgment_of_the_administrative_tribunal">Case No. and Judgment of the Administrative Tribunal</label>
                        <input disabled class="form-control" id="case_no_and_judgment_of_the_administrative_tribunal" type="text" name="case_no_and_judgment_of_the_administrative_tribunal" placeholder="Case No. and Judgment of the Administrative Tribunal" value="{{ old('case_no_and_judgment_of_the_administrative_tribunal',$pivot->case_no_and_judgment_of_the_administrative_tribunal) }}">
                        @error('case_no_and_judgment_of_the_administrative_tribunal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="case_no_and_judgment_of_the_administrative_appeal_tribunal">Case No. and judgment of the Administrative Appeal Tribunal</label>
                        <input disabled class="form-control" id="case_no_and_judgment_of_the_administrative_appeal_tribunal" type="text" name="case_no_and_judgment_of_the_administrative_appeal_tribunal" placeholder="Case No. and judgment of the Administrative Appeal Tribunal" value="{{ old('case_no_and_judgment_of_the_administrative_appeal_tribunal',$pivot->case_no_and_judgment_of_the_administrative_appeal_tribunal) }}">
                        @error('case_no_and_judgment_of_the_administrative_appeal_tribunal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="leave_to_memo_no_and_judgement">Leave to Memo No.and Judgement</label>
                        <input disabled class="form-control" id="leave_to_memo_no_and_judgement" type="text" name="leave_to_memo_no_and_judgement" placeholder="Leave to Memo No.and Judgement" value="{{ old('leave_to_memo_no_and_judgement',$pivot->leave_to_memo_no_and_judgement) }}">
                        @error('leave_to_memo_no_and_judgement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="review_case_no_and_judgement">Review Case No. and Judgment</label>
                        <input disabled class="form-control" id="review_case_no_and_judgement" type="text" name="review_case_no_and_judgement" placeholder="Review Case No. and Judgment" value="{{ old('review_case_no_and_judgement',$pivot->review_case_no_and_judgement) }}">
                        @error('review_case_no_and_judgement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="comments">Comments</label>
                        <input disabled class="form-control" id="comments" type="text" name="comments" placeholder="Comments" value="{{ old('comments',$pivot->comments) }}">
                        @error('comments')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>--}}

            </div>
    </div>

    <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Attachment </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="viewAttachment"  width="770px" height="660px" >
                    </iframe>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function getAttachment(getId){
            if(getId == 1){
                var source = $("#attachment-source1").val();
            }else if(getId == 2){
                var source = $("#attachment-source2").val();
            }else if(getId == 3){
                var source = $("#attachment-source3").val();
            }else if(getId == 4){
                var source = $("#attachment-source4").val();
            }else if(getId == 5){
                var source = $("#attachment-source5").val();
            }else if(getId == 6){
                var source = $("#attachment-source6").val();
            }else if(getId == 7){
                var source = $("#attachment-source7").val();
            }else if(getId == 8){
                var source = $("#attachment-source8").val();
            }else if(getId == 9){
                var source = $("#attachment-source9").val();
            }else if(getId == 10){
                var source = $("#attachment-source10").val();
            }else if(getId == 11){
                var source = $("#attachment-source11").val();
            }else if(getId == 12){
                var source = $("#attachment-source12").val();
            }else if(getId == 13){
                var source = $("#attachment-source13").val();
            }else if(getId == 14){
                var source = $("#attachment-source14").val();
            }

            $('#viewAttachment').attr('src',source);
        }
    </script>
@endsection
