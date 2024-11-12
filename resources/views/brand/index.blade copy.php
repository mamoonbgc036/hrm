@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
    <div class="container mt-5">
        <div class="row center">
            <div class="col-md-6">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="select_certificate background" style="font-weight: bold;">Login Page Background
                                Image</label>
                            <input class="form-control" type="file" name="background_image" id="login_back">
                        </div>
                        @error('background_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="ms-3">
                    <img id="login_bk_display" src="" alt="Image" style="max-width: 80%; visibility: hidden">
                </div>
            </div>
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
        });
    </script>
@endsection
