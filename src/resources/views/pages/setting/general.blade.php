@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <ol class="breadcrumb m-0 p-md-0">
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.dashboard') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.setting.index') }}">Setting</a></li>
        <li class="breadcrumb-item active">General</li>
    </ol>
    <div class="mt-2 mb-2"></div>
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin chung</h5>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên website</label>
                            <input type="text" name="name" placeholder="Website bán hàng" class="form-control" value="{{ old('name', $setting->name ?? "") }}">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <textarea class="form-control" rows="2" name="introduce" placeholder="Mô tả ">{{ old('introduce', $setting->introduce ?? "") }}</textarea>
                            @error('introduce')
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('introduce') }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
            </form>

        </div>
    </div>
@stop
