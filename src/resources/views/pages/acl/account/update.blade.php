@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <ol class="breadcrumb m-0 p-md-0">
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.dashboard') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.setting.index') }}">Setting</a></li>
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.user.index') }}">User</a></li>
        <li class="breadcrumb-item active">Update</li>
    </ol>
    <div class="mt-2 mb-2"></div>

    <div class="row">
        <div class="col-md-12">
            @include('adm_acl_setting::pages.acl.account.form')
        </div>
    </div>
@stop
