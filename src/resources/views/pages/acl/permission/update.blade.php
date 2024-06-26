@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <ol class="breadcrumb m-0 p-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.dashboard') }}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.setting.index') }}">Setting</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.permission.index') }}">Permission</a></li>
                    <li class="breadcrumb-item active">Update</li>
                </ol>
                <div class="mt-2 mb-2"></div>
                <div class="row">
                    <div class="col-md-8">
                        @include('adm_acl_setting::pages.acl.permission.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
