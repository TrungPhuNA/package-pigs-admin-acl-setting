<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên</label>
        <input type="text" name="name" placeholder="Tên " class="form-control" value="{{ old('name', $role->name ?? "") }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Mô tả</label>
        <input type="text" name="description" placeholder="Mô tả " class="form-control" value="{{ old('description', $role->description ?? "") }}">
    </div>
    <div class="row">
        @foreach($permissions ?? [] as $item)
            <div class="form-group form-check col-sm-3">
                <div class="form-group form-check">
                    <label class="form-check-label" style="display: flex;justify-content: space-between" for="exampleCheck1">
                        <span>{{ $item->description }}</span>
                        <input type="checkbox" class="form-check-input" {{ in_array($item->id, $permissionActive) ? "checked" : "" }}  value="{{ $item->id }}" name="permissions[]">
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
