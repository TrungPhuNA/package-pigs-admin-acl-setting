@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <h2>Thông tin website</h2>
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                @csrf
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
                <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
            </form>

        </div>
    </div>
@stop
