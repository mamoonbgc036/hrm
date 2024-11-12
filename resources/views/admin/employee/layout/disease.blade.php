<form action="{{ route('employee-disease') }}" method="post">
    @csrf
    <div class="add-disease">
        <div class="add-more-disease">
            <div class="row">
                <div class="col-md-11">
                    <div class="disease" style="border:1px solid #009788; padding : 15px; margin:10px">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="job_position">Select Disease</label>
                                    <select name="disease[]" class="form-control" id="">
                                        @if($diseases && $diseases->count() > 0)
                                            <option value="">Select Disease</option>
                                            @foreach ($diseases as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No disease Available, Please create one</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="disease_name">Disease Title</label>
                                    <input class="form-control" id="disease_name" type="text" name="disease_name[]" value="{{ old('disease_name') }}">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="disease_description">Description</label>
                                    <textarea class="form-control" id="disease_description" type="text" rows="3" cols="10" name="disease_description[]"  value="{{ old('disease_description') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-disease" style="margin:10px">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!--  hidden template -->
    <div class="add-more-disease-template d-none">
        <div class="add-more-disease">
            <div class="row">
                <div class="col-md-11">
                    <div class="disease" style="border:1px solid #009788; padding : 15px; margin:10px">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="disease">Select Disease</label>
                                    <select name="disease[]" class="form-control">
                                        <option value="">Select Disease</option>
                                        @foreach ($diseases as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="disease_name">Disease Title</label>
                                    <input class="form-control" type="text" name="disease_name[]">
                                </div>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm" for="disease_description">Description</label>
                                    <textarea class="form-control" rows="3" cols="10" name="disease_description[]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-disease" style="margin:10px">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!--  hidden template end -->
    <div class="d-flex justify-content-between" style="margin:10px">
        <button type="button" id="add-disease" class="btn btn-secondary">Add Another disease</button>
    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Finish</button>
        </div>
    </div>
</form>
