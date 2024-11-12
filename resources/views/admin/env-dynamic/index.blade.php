@extends('layouts.app')
@section('title','Env Dynamic')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>Env Dynamic For Email</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Env Dynamic For Email</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('env-dynamic.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <input type="text" name="MAIL_DRIVER" placeholder="MAIL_DRIVER" id="key" class="form-control" value="{{ $default_values['MAIL_MAILER'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="MAIL_HOST" id="key" placeholder="MAIL_HOST" class="form-control" value="{{ $default_values['MAIL_HOST'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="MAIL_PORT" placeholder="MAIL_PORT" id="key" class="form-control" value="{{ $default_values['MAIL_PORT'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="MAIL_USERNAME" placeholder="MAIL_USERNAME" id="key" class="form-control" value="{{ $default_values['MAIL_USERNAME'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="MAIL_PASSWORD" placeholder="MAIL_PASSWORD" id="key" class="form-control" value="{{ $default_values['MAIL_PASSWORD'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="MAIL_ENCRYPTION" placeholder="MAIL_ENCRYPTION" id="key" class="form-control" value="{{ $default_values['MAIL_ENCRYPTION'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="MAIL_FROM_ADDRESS" placeholder="MAIL_FROM_ADDRESS" id="key" class="form-control" value="{{ $default_values['MAIL_FROM_ADDRESS']  }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" >জমা দিন</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
