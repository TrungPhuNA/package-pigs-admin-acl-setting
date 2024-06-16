@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Common</h4>
            <div class="row">
                <div class="col-sm-4">
                    <div class="item-box d-flex border mb-3" style="padding: 10px;border-radius: 4px">
                        <div class="icon d-flex justify-content-center align-items-center" style="width: 40px;height: 40px;background-color: #f6f8fb;border-radius: 5px;margin-right: 5px">
                            <i class="uil-cog" style="font-size: 25px"></i>
                        </div>
                        <div class="content">
                            <h5 style="margin: 0"><a href="{{ route('get.adm_acl_setting.setting.general') }}">Cấu hình chung</a></h5>
                            <p style="margin: 0;margin-top: 5px">Cập nhật thông tin website</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="item-box d-flex border mb-3" style="padding: 10px;border-radius: 4px">
                        <div class="icon d-flex justify-content-center align-items-center" style="width: 40px;height: 40px;background-color: #f6f8fb;border-radius: 5px;margin-right: 5px">
                            <i class="uil-envelope-minus" style="font-size: 25px"></i>
                        </div>
                        <div class="content">
                            <h5 style="margin: 0"><a href="{{ route('get.adm_acl_setting.setting.general') }}">Cấu hình email</a></h5>
                            <p style="margin: 0;margin-top: 5px">Cấu hình các thông tin gủi email</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Hệ thống</h4>
            <div class="row">
                <div class="col-sm-4">
                    <div class="item-box d-flex border mb-3" style="padding: 10px;border-radius: 4px">
                        <div class="icon d-flex justify-content-center align-items-center" style="width: 40px;height: 40px;background-color: #f6f8fb;border-radius: 5px;margin-right: 5px">
                            <i class="uil-database" style="font-size: 25px"></i>
                        </div>
                        <div class="content">
                            <h5 style="margin: 0"><a href="{{ route('get.adm_acl_setting.user.index') }}">Users</a></h5>
                            <p style="margin: 0;margin-top: 5px">Thông tin tài khoản</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
