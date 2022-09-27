@extends('layout.master')
@section('coupon-open', 'menu-open')
@section('css')

@endsection
@section('title')
    coupon-form
@endsection
@section('content_header_name')
    Sửa mã giảm giá
@endsection
@section('redirect_to_list')
    <a href="{{route('admin.coupon.form.edit')}}">
        Sửa mã giảm giá
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
            <form role="form" method="post" action="{{route('admin.personnel.product.form.update', $manager->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã cán bộ quản lý</label>
                        <input type="text" name="code" class="form-control" placeholder="Nhập mã cán bộ quản lý" value="{{old('code') ? old('code') : $manager->code}}">
                        @error('code')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên cán bộ quản lý" value="{{old('name') ? old('name') : $manager->name}}">
                        @error('name')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ảnh đại diện</label>
                        <input type='file' onchange="readURL(this);" name="avatar"/>
                        <br>
                        @if(isset($manager->avatar))
                            <img id="avatar" style="width: 100px; height: 200px" src="{{asset('storage/'.$manager->avatar)}}" alt="avatar"/>
                        @else
                            <img id="avatar" style="width: 100px; height: 200px" src="#" alt="avatar"/>
                        @endif
                        @error('avatar')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ngày sinh</label>
                        <input type="text" name="birthday" class="form-control" placeholder="Nhập ngày sinh" value="{{old('birthday') ? old('birthday') : $manager->birthday}}">
                        @error('birthday')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" value="{{old('phone') ? old('phone') : $manager->phone}}">
                        @error('phone')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Thư điện tử</label>
                        <input type="text" class="form-control" name="email" placeholder="Nhập thư điện tử" value="{{old('email') ? old('email') : $manager->email}}">
                        @error('email')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Giới tính</label>
                        <select class="form-control select2" name="gender" style="width: 100%;">
                            @foreach(config('base.gender') as $k => $item)
                                <option
                                    @if($manager->gender == $k)
                                    {{"selected"}}
                                    @endif
                                    value="{{$k}}">{{$item}}
                                </option>
                            @endforeach
                        </select>
                        @error('gender')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quận/ huyện</label>
                        <select class="form-control select2" name="district_id" id="district" style="width: 100%;">
                            @foreach($districts as $k => $item)
                                <option
                                    @if($manager->district_id == $k)
                                    {{"selected"}}
                                    @endif
                                    value="{{$k}}">{{$item}}
                                </option>
                            @endforeach
                        </select>
                        @error('district_id')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phường/ xã</label>
                        <select class="form-control select2" name="commune_id" id="commune" style="width: 100%;">
                            @foreach($communes as $k => $item)
                                <option
                                    @if($manager->commune_id == $k)
                                    {{"selected"}}
                                    @endif
                                    value="{{$k}}">{{$item}}
                                </option>
                            @endforeach
                        </select>
                        @error('commune_id')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{old('address') ? old('address') : $manager->address}}">
                        @error('address')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ngày vào làm việc</label>
                        <input type="text" class="form-control" name="day_and_year" placeholder="Nhập ngày vào làm việc" value="{{old('day_and_year') ? old('day_and_year') : $manager->day_and_year}}">
                        @error('day_and_year')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phân cấp trường học</label>
                        <select class="form-control select2" name="type_school" id="type_school" style="width: 100%;">
                            @foreach(config('base.type_of_school') as $k => $item)
                                <option
                                    @if($manager->type_school == $k)
                                    {{"selected"}}
                                    @endif
                                    value="{{$k}}">{{$item}}
                                </option>
                            @endforeach
                        </select>
                        @error('type_school')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Trường</label>
                        <select class="form-control select2" id="school" name="school_id" style="width: 100%;">
                            @foreach($schools as $k => $item)
                                <option
                                    @if($manager->school_id == $k)
                                    {{"selected"}}
                                    @endif
                                    value="{{$k}}">{{$item}}
                                </option>
                            @endforeach
                        </select>
                        @error('school_id')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Trình độ</label>
                        <select class="form-control select2" name="level" style="width: 100%;">
                            @foreach(config('base.level_of_teacher') as $k => $item)
                                <option
                                    @if($manager->level == $k)
                                    {{"selected"}}
                                    @endif
                                    value="{{$k}}">{{$item}}
                                </option>
                            @endforeach
                        </select>
                        @error('level')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('admin.personnel.product.list')}}">quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('js')
    <script>
        $('#district').on('change', function (e) {
            var cat_id = e.target.value;

            $.get('/ajax-get-commune?cat_id=' + cat_id, function (data) {
                $('#commune').empty();
                $.each(data, function (index, commune) {
                    $('#commune').append('<option value="'+commune.id+'">'+commune.name+'</option>');
                })
            })
        });

        $('#type_school').on('change', function (e) {
            var cat_id = e.target.value;

            $.get('/ajax-get-type-child-category?cat_id=' + cat_id, function (data) {
                $('#school').empty();
                $.each(data, function (index, value) {
                    $('#school').append('<option value="'+value.id+'">'+value.name+'</option>');
                })
            })
        });
    </script>
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
@endsection
