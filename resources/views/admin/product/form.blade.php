@extends('layout.master')
@section('product-open', 'menu-open')
@section('product-form', 'active')
@section('css')

@endsection
@section('title')
    product-form
@endsection
@section('content_header_name')
    Thêm sản phẩm
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.product.form.get')}}">
        Thêm sản phẩm
    </a>
@endsection
@section('content')
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa thông tin cán bộ quản lý</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.product.form.post')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã sản phẩm</label>
                        <input type="text" name="code" class="form-control" placeholder="Nhập mã sản phẩm" value="{{old('code')}}">
                        @error('code')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{old('name')}}">
                        @error('name')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link</label>
                        <input type="text" name="link" class="form-control" placeholder="Nhập link sản phẩm" value="{{old('link')}}">
                        @error('link')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Danh mục</label>
                        <select class="form-control select2" name="category_id" id="category" style="width: 100%;">
                            <option value="">Lựa chọn</option>
                            @foreach($categories as $k => $item)
                                <option value="{{$k}}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 1</label>
                        <input type='file' onchange="readURL(this);" name="avatar1"/>
                        <br>
                        <img id="avatar1" src="#" alt="avatar"/>
                        @error('avatar1')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 2</label>
                        <input type='file' onchange="readURL(this);" name="avatar2"/>
                        <br>
                        <img id="avatar2" src="#" alt="avatar"/>
                        @error('avatar2')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 3</label>
                        <input type='file' onchange="readURL(this);" name="avatar3"/>
                        <br>
                        <img id="avatar3" src="#" alt="avatar"/>
                        @error('avatar3')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 4</label>
                        <input type='file' onchange="readURL(this);" name="avatar4"/>
                        <br>
                        <img id="avatar4" src="#" alt="avatar"/>
                        @error('avatar4')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 5</label>
                        <input type='file' onchange="readURL(this);" name="avatar5"/>
                        <br>
                        <img id="avatar5" src="#" alt="avatar"/>
                        @error('avatar5')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 6</label>
                        <input type='file' onchange="readURL(this);" name="avatar6"/>
                        <br>
                        <img id="avatar6" src="#" alt="avatar"/>
                        @error('avatar6')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 7</label>
                        <input type='file' onchange="readURL(this);" name="avatar7"/>
                        <br>
                        <img id="avatar7" src="#" alt="avatar"/>
                        @error('avatar7')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh 8</label>
                        <input type='file' onchange="readURL(this);" name="avatar8"/>
                        <br>
                        <img id="avatar8" src="#" alt="avatar"/>
                        @error('avatar8')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chi tiết</label>
                        <textarea name="detail" id="editor1">{{old('detail')}}</textarea>
                        @error('detail')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quy cách</label>
                        <input type="text" class="form-control" name="procedure" placeholder="Nhập quy cách" value="{{old('procedure')}}">
                        @error('procedure')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bảo hành</label>
                        <input type="text" class="form-control" name="warranty" placeholder="vd 6 tháng, 1 năm" value="{{old('warranty')}}">
                        @error('warranty')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Đơn giá</label>
                        <input type="text" class="form-control" name="unit_price" placeholder="Nhập đơn giá" value="{{old('unit_price')}}">
                        @error('unit_price')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Giá khuyến mãi</label>
                        <input type="text" class="form-control" name="promotion_price" placeholder="Nhập giá khuyến mãi" value="{{old('promotion_price')}}">
                        @error('promotion_price')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Số lượng</label>
                        <input type="text" class="form-control" name="count" placeholder="Nhập số lượng" value="{{old('count')}}">
                        @error('count')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Active</label>
                        <br>
                        <input type="radio" id="status1" name="status" value="1">
                        <label for="status1">Có</label>
                        <input type="radio" id="status2" name="status" value="0">
                        <label for="status1">Không</label>
                        @error('status')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Giá áp dụng</label>
                        <br>
                        <input type="radio" id="status1" name="price_applied" value="1">
                        <label for="status1">Đơn giá</label>
                        <input type="radio" id="status2" name="price_applied" value="0">
                        <label for="status1">Giá khuyến mãi</label>
                        @error('price_applied')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tình trạng</label>
                        <br>
                        <input type="radio" id="status1" name="is_new" value="1">
                        <label for="status1">Mới</label>
                        <input type="radio" id="status2" name="is_new" value="0">
                        <label for="status1">Cũ</label>
                        @error('is_new')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('admin.product.list')}}">quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
    <script>
        CKEDITOR.replace('editor1', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        } );
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+input.name)
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
