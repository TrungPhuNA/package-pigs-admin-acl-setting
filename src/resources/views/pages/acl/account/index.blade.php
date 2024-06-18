@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <ol class="breadcrumb m-0 p-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.dashboard') }}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.setting.index') }}">Setting</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
                <div class="mt-2 mb-2">
                    <form class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inlineFormInputName" class="visually-hidden">Name</label>
                            <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Name" />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Find</button>
                            <a href="{{ route('get.adm_acl_setting.user.create') }}" class="btn btn-success">Thêm mới</a>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users ?? [] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    {{--                            <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 50%" alt="">--}}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @foreach($item->roles ?? [] as $role)
                                        <span class="badge bg-danger">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="{{ $item->getStatus($item->status)['class'] ?? "badge bg-secondary" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('get.adm_acl_setting.user.update', $item->id) }}">Edit</a>
                                    <a href="javascript:;void(0)">|</a>
                                    <a href="{{ route('get.adm_acl_setting.user.delete', $item->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
