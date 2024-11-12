<form id="journalInformationForm" method="post">
    @csrf

    <div id="journal" class="col-md-12 col-lg-12">
        @if (!$employee->getPublication->isEmpty())
            @foreach ($employee->getPublication as $pbl)
                {{-- <div class="card">
                    <div class="card-header bg-info text-white text-center"> --}}
                        <div class="form-check form-check-inline">
                            <h5>Journal/Publication</h5> &nbsp &nbsp
                            <input class="form-check-input " type="checkbox" id="if_journal">
                            <label class="form-check-label " for="if_journal">If Applicable</label>
                        </div>
                    {{-- </div>
                    <div class="card-body"> --}}
                        <fieldset id="fieldset_journal" disabled>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="title">Title</label>
                                        <input class="form-control" type="text" name="title[]"
                                            value="{{ $pbl->title }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm"
                                            for="weight">Publication/Publisher</label>
                                        <input class="form-control" type="text" name="publication[]"
                                            value="{{ $pbl->publication }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="weight">Publication
                                            Date</label>
                                        <input class="form-control" name="publication_date[]" type="date"
                                            placeholder="DD-MM-YYYY" autocomplete="off"
                                            value="{{ date('Y-m-d', strtotime($pbl->publication_date)) }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="weight">Author</label>
                                        <input class="form-control" type="text" name="author[]"
                                            value="{{ $pbl->author }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label col-form-label-sm" for="weight">Publication
                                            URL</label>
                                        <input class="form-control" type="text" name="publication_url[]"
                                            value="{{ $pbl->publication_url }}">
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    {{-- </div>
                </div> --}}
            @endforeach
        @else
            {{-- <div class="card">
                <div class="card-header bg-info text-white text-center"> --}}
                    <div class="form-check form-check-inline">
                        <h5>Journal/Publication</h5> &nbsp &nbsp
                        <input class="form-check-input " type="checkbox" id="if_journal">
                        <label class="form-check-label " for="if_journal">If Applicable</label>
                    </div>
                {{-- </div>
                <div class="card-body"> --}}
                    <fieldset id="fieldset_journal" disabled>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="title">Title</label>
                                    <input class="form-control" type="text" name="title[]" value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm"
                                        for="weight">Publication/Publisher</label>
                                    <input class="form-control" type="text" name="publication[]" value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="weight">Publication
                                        Date</label>
                                    <input class="form-control" name="publication_date[]" type="date"
                                        placeholder="DD-MM-YYYY" autocomplete="off" value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="weight">Author</label>
                                    <input class="form-control" type="text" name="author[]"
                                        value="{{ old('author') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="weight">Publication
                                        URL</label>
                                    <input class="form-control" type="text" name="publication_url[]"
                                        value="{{ old('publication_url') }}">
                                </div>
                            </div>
                        </div>

                    </fieldset>
                {{-- </div>
            </div> --}}
        @endif

        <div class="row" id="more_journals">

        </div>

        <div class="text-center">
            <button type="button" class="btn btn-sm btn-outline-primary mb-4" id="add_more_journal">Add
                More Journal/Publication</button>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm">Next</button>
        </div>
    </div>
</form>
