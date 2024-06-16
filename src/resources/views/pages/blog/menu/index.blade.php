@extends('adm_acl_setting::layout.adm_acl_master')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh sách</h2>
        <a class="btn btn-sm btn-primary" href="{{ route('get.adm_acl_setting.tag.create') }}"><i></i> Thêm mới</a>
    </div>
    <div>
        <div class="row">
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Trạng Thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags ?? [] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="{{ \Pigs\AdminAclSetting\Enums\EnumsBlog::GET_TEXT_STATUS[$item->status]['class'] }}">{{ \Pigs\AdminAclSetting\Enums\EnumsBlog::GET_TEXT_STATUS[$item->status]['name'] }}</span>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('get.adm_acl_setting.menu.update', $item->id) }}">Edit</a>
                                    <a href="javascript:;void(0)">|</a>
                                    <a href="{{ route('get.adm_acl_setting.menu.delete', $item->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {!! $tags->appends($query ?? [])->links() !!}
                </div>
            </div>
            <div class="col-sm-4">
                @include('adm_acl_setting::pages.blog.menu.form',['route' => $route])
            </div>
        </div>
    </div>
@stop
