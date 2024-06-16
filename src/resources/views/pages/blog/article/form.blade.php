<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên</label>
                        <input type="text" name="name" placeholder="Tên " class="form-control" value="{{ old('name', $article->name ?? "") }}">
                        @error('name')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả</label>
                        <textarea class="form-control" rows="2" name="description" placeholder="Mô tả">{{ old('description', $article->description ?? "") }}</textarea>
                        @error('name')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nội dung</h5>
                    <textarea class="form-control" rows="2" name="content">{{ old('content', $article->content ?? "") }}</textarea>
                    @error('content')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('content') }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Publish</h5>
                    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Trạng thái</h5>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option >Trạng thái</option>
                        <option value="2" {{ ($article->status ?? 0) == 2 ? "selected" : "" }}>Published</option>
                        <option value="1" {{ ($article->status ?? 0) == 1 ? "selected" : "" }}>Pending</option>
                        <option value="-1" {{ ($article->status ?? 0) == -1 ? "selected" : "" }}>Draft</option>
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh mục</h5>
                    <select class="form-select" name="menu_id" aria-label="Default select example">
                        <option >Chọn danh mục</option>
                        @foreach($menus as $item)
                            <option value="{{ $item->id }}" {{ ($article->menu_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Từ khoá</h5>
                    <select class="form-select js-select2-multiple" name="tags[]"  aria-label="Default select example" multiple="multiple">
                        <label for="tag" class="form-label">Tags</label>
                        @foreach($tags as $item)
                            <option value="{{ $item->id }}" {{ in_array($item->id, $tagActive) ? "selected" : "" }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function (){
        $(document).ready(function() {
            $('.js-select2-multiple').select2();
        });
    })
</script>