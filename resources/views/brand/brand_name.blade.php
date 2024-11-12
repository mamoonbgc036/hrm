@extends('layouts.app')
@section('title', 'Brand Setting')
@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-3 text-warning">Company and Software Name</h3>
        <form action="{{ route('brand-name.update', 1) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="select_certificate background" style="font-weight: bold;">Company Name</label>
                        <input class="form-control" type="text" name="company_name" id="login_back">
                    </div>
                    @error('company_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="select_certificate background" style="font-weight: bold;">Software Name</label>
                        <input class="form-control" type="text" name="software_name" id="company_logo">
                    </div>
                    @error('software_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
