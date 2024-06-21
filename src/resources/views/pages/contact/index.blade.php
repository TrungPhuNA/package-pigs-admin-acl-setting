@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <ol class="breadcrumb m-0 p-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.dashboard') }}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get.adm_acl_setting.contact.index') }}">Contact</a></li>
                    <li class="breadcrumb-item active">Index</li>
                </ol>
                <div class="mt-2 mb-2">
                    <form class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inlineFormInputName" class="visually-hidden">Name</label>
                            <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Name" />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Find</button>
                            <a href="{{ route('get.adm_acl_setting.article.create') }}" class="btn btn-success">Thêm mới</a>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts ?? [] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('get.adm_acl_setting.contact.delete', $item->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {!! $contacts->appends($query ?? [])->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop
