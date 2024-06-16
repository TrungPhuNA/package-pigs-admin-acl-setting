<form method="POST" action="{{ $route  ?? ''}}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên</label>
        <input type="text" name="name" placeholder="Tên " class="form-control" value="{{ old('name', $menu->name ?? "") }}">
        @error('name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Trạng thái</label>
        <select class="form-select" name="status" aria-label="Default select example">
            <option >Trạng thái</option>
            <option value="2" {{ ($menu->status ?? 0) == 2 ? "selected" : "" }}>Published</option>
            <option value="1" {{ ($menu->status ?? 0) == 1 ? "selected" : "" }}>Pending</option>
            <option value="-1" {{ ($menu->status ?? 0) == -1 ? "selected" : "" }}>Draft</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
