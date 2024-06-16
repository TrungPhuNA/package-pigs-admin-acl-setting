@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <ol class="breadcrumb m-0 p-md-0">
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.dashboard') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.setting.index') }}">Setting</a></li>
        <li class="breadcrumb-item active">Email</li>
    </ol>
    <div class="mt-2 mb-2"></div>
    <div class="row">
        <div class="col-sm-10 offset-1">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Loại</label>
                                        <input type="text" required name="mail_driver" value="{{ $email->mail_driver ?? "" }}" class="form-control">
                                        @error('mail_driver')
                                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_driver') }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Cổng</label>
                                        <input type="text"  name="mail_port" value="{{ $email->mail_port ?? "" }}" class="form-control">
                                        @error('mail_port')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_port') }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Máy chủ</label>
                                    <input type="text"  name="mail_host" value="{{ $email->mail_host ?? "" }}" class="form-control">
                                    @error('mail_host')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_host') }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                                    <input type="text"  name="mail_username" value="{{ $email->mail_username ?? "" }}" class="form-control">
                                    @error('mail_username')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_username') }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="text"  name="mail_password" value="{{ $email->mail_password ?? "" }}" class="form-control">
                                    @error('mail_password')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_password') }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Tên miền</label>
                                    <input type="text"  name="mail_domain" value="{{ $email->mail_domain ?? "" }}" class="form-control">
                                    @error('mail_domain')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_domain') }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Người gửi</label>
                                    <input type="text"  name="mail_from_address" value="{{ $email->mail_from_address ?? "" }}" class="form-control">
                                    @error('mail_from_address')
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('mail_from_address') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
