<form method="POST" action="{{ $route  ?? ''}}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên <span class="text-danger">(*)</span></label>
        <small class="char_counter" ><b class="current">{{ strlen($menu->name ?? "") }}</b> <b>/ 80</b></small>
        <input type="text" name="name" placeholder="Tên " class="form-control keypress-count" value="{{ old('name', $menu->name ?? "") }}">
        @error('name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Trạng thái</label>
        <select class="form-select" name="status" aria-label="Default select example">
            <option value="">Trạng thái</option>
            <option value="2" {{ ($menu->status ?? 0) == 2 ? "selected" : "" }}>Published</option>
            <option value="1" {{ ($menu->status ?? 0) == 1 ? "selected" : "" }}>Pending</option>
            <option value="-1" {{ ($menu->status ?? 0) == -1 ? "selected" : "" }}>Draft</option>
        </select>
        @error('status')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('status') }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
