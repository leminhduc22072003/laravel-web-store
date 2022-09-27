@extends('layout.master')
@section('title')
    user
@endsection
@section('content_header_name')
    Tạo mới người dùng
@endsection
@section('content_header_active')
    Tạo mới người dùng
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.user.list')}}">
        Danh sách người dùng
    </a>
@endsection
@section('user', 'active')
@section('content')
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tạo mới người dùng</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.user.form.post')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên người dùng</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên người dùng" value="{{old('name')}}">
                        @error('name')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control" placeholder="Nhập tên đăng nhập" value="{{old('username')}}">
                        @error('username')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Nhập email" value="{{old('email')}}">
                        @error('email')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                        @error('password')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" placeholder="Nhập mã giới thiệu" value="{{old('phone')}}">
                        @error('phone')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nhóm</label>
                        <select class="form-control select2" name="group" style="width: 100%;">
                            @foreach(config('base.level_of_user') as $key => $value)
                                <option @if(old('group') == $key) {{"selected"}} @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('group')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Giới tính</label>
                        <select class="form-control select2" name="gender" style="width: 100%;">
                            @foreach(config('base.gender') as $key => $value)
                                <option @if(old('gender') == $key) {{"selected"}} @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('gender')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select class="form-control select2" name="active" style="width: 100%;">
                            @foreach(config('base.active') as $key => $value)
                                <option @if(old('active') == $key) {{"selected"}} @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('active')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh đại diện</label>
                        <input type='file' onchange="readURL(this);" name="avatar"/>
                        <br>
                        <img id="avatar" src="#" alt="avatar"/>
                        @error('avatar')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-primary float-left" href="{{route('admin.user.list')}}" style="margin-right: 5px">
                        Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
