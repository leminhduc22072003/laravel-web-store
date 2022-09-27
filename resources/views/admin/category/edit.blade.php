@extends('layout.master')
@section('category-open', 'menu-open')
@section('title')
    category-form
@endsection
@section('content_header_name')
    Sửa danh mục
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.category.form.edit', $category->id)}}">
        Sửa danh mục
    </a>
@endsection
@section('content')
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa danh mục</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.category.form.update', $category->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã danh mục</label>
                        <input type="text" name="code" class="form-control" placeholder="Nhập mã danh mục" value="{{old('code') ? old('code') : $category->code}}">
                        @error('code')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="{{old('name') ? old('name') : $category->name}}">
                        @error('name')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link</label>
                        <input type="text" name="link" class="form-control" placeholder="Nhập link" value="{{old('link') ? old('link') : $category->link}}">
                        @error('link')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group" id="category">
                        <label for="exampleInputPassword1">Danh mục 1</label>
                        <select class="form-control select2" id="category1" name="parent_id_1" style="width: 100%;">
                            @if(empty($category->parent_id_1))
                                <option value="">Lựa chọn</option>
                            @endif
                            @foreach($categories1 as $k => $item)
                                <option
                                    @if($category->parent_id_1 == $item->id)
                                    {{"selected"}}
                                    @endif
                                    value="{{$item->id}}">{{$item->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id_1')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group" id="category">
                        <label for="exampleInputPassword1">Danh mục 2</label>
                        <select class="form-control select2" id="category2" name="parent_id_2" style="width: 100%;">
                            @if(empty($category->parent_id_2))
                                <option value="">Lựa chọn</option>
                            @else
                                @foreach($categories2 as $k => $item)
                                    <option
                                        @if($category->parent_id_2 == $item->id)
                                        {{"selected"}}
                                        @endif
                                        value="{{$item->id}}">{{$item->name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('parent_id_2')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('admin.category.list')}}">quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
    <script>
        $('#category1').on('change', function (e) {
            var cat_id = e.target.value;

            $.get('/admin/ajax-get-category-parent-2?cat_id=' + cat_id, function (data) {
                $('#category2').empty();
                $('#category2').append('<option value="">'+'lựa chọn'+'</option>');
                $.each(data, function (index, category2) {
                    $('#category2').append('<option value="'+category2.id+'">'+category2.name+'</option>');
                })
            })
        });
    </script>
@endsection
