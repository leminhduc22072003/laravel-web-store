@extends('client.master')
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="col-md-12">
                <h2 style="text-align: center">
                    Đăng ký
                </h2>
                <form action="{{route('client.user.post-register')}}" method="post" role="form">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tên đăng nhập</label>
                        <input class="form-control" name="username" value="{{old('username')}}" id="exampleFormControlInput1" placeholder="Tên đăng nhập">
                        @error('username')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" value="{{old('password')}}" id="exampleFormControlInput1" placeholder="Mật khẩu">
                        @error('password')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Họ và tên</label>
                        <input class="form-control" name="name" value="{{old('name')}}" id="exampleFormControlInput1" placeholder="Họ và tên">
                        @error('name')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Số điện thoại</label>
                        <input class="form-control" name="phone" value="{{old('phone')}}" id="exampleFormControlInput1" placeholder="Số điện thoại">
                        @error('phone')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Địa chỉ email</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" id="exampleFormControlInput1" placeholder="Địa chỉ email">
                        @error('email')
                        <p class="danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <a class="btn btn-secondary" href="{{route('client.dashboard')}}" style="float:left"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                    <button class="btn btn-primary" type="submit" style="float:right">Đăng ký <i class="fas fa-long-arrow-alt-right"></i></button>
                </form>
            </div>
        </div>
    </section>
@endsection
