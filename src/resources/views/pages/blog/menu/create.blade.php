@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Thêm mới</h2>
        <a href="{{ route('get.adm_acl_setting.tag.index') }}">Trở về</a>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('adm_acl_setting::pages.blog.tag.form')
        </div>
    </div>
@stop
