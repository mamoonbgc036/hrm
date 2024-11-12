@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('brand.update', 1) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="select_certificate background" style="font-weight: bold;">Login Page Background
                            Image</label>
                        <input class="form-control" type="file" name="login_back" id="login_back">
                    </div>
                    @error('background_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="ms-3">
                        <img id="login_bk_display" src="" alt="Image" style="max-width: 80%; visibility: hidden">
                    </div>
                </div>
            </div>

            <div class="row center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="select_certificate background" style="font-weight: bold;">Company Logo</label>
                        <input class="form-control" type="file" name="company_logo" id="company_logo">
                    </div>
                    @error('background_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="ms-3 mt-3">
                        <img id="company_logo_display" src="" alt="Image"
                            style="max-width: 80%; visibility: hidden">
                    </div>
                </div>
            </div>
            <div class="row center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="select_certificate background" style="font-weight: bold;">Login Small Image</label>
                        <input class="form-control" type="file" name="login_bk_small" id="login_bk_small">
                    </div>
                    @error('background_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="ms-3 mt-3">
                        <img id="login_bk_small_display" src="" alt="Image"
                            style="max-width: 80%; visibility: hidden">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
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
