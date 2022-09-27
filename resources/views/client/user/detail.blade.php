@extends('client.master')
@section('content')
    <section class="body-content">
        <div class="container">
           <div class="row">
               <div class="col-md-3">
                   <nav class="nav flex-column">
                       <a style="border-bottom: 1px solid #6e6e6e" class="nav-link active" href="{{route('client.user.detail')}}">Thông tin tài khoản</a>
                       <a style="border-bottom: 1px solid #6e6e6e" class="nav-link" href="{{route('client.user.check-order')}}">Thông tin đặt hàng</a>
                   </nav>
               </div>
               <div class="col-md-8">
                   <h2 style="text-align: center">
                       Thông tin tài khoản
                   </h2>
                   <form action="{{route('client.user.change-detail')}}" method="post" role="form">
                       @csrf
                       <div class="form-group">
                           <label for="exampleFormControlInput1">Họ và tên</label>
                           <input class="form-control" name="name" value="{{old('name') ? old('name') : Session::get('userClient')['name']}}" id="exampleFormControlInput1" placeholder="Họ và tên">
                           @error('name')
                           <p class="danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="exampleFormControlInput1">Mật khẩu</label>
                           <input class="form-control" type="password" name="password" id="exampleFormControlInput1" placeholder="Mật khẩu">
                           @error('name')
                           <p class="danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="exampleFormControlInput1">Số điện thoại</label>
                           <input class="form-control" name="phone" value="{{old('phone') ? old('phone') : Session::get('userClient')['phone']}}" id="exampleFormControlInput1" placeholder="Số điện thoại">
                           @error('phone')
                           <p class="danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="exampleFormControlInput1">Địa chỉ email</label>
                           <input type="email" class="form-control" name="email" value="{{old('email') ? old('email') : Session::get('userClient')['email']}}" id="exampleFormControlInput1" placeholder="Địa chỉ email">
                           @error('email')
                           <p class="danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <a class="btn btn-secondary" href="{{route('client.dashboard')}}" style="float:left"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                       <button class="btn btn-primary" type="submit" style="float:right">Tiến tục <i class="fas fa-long-arrow-alt-right"></i></button>
                   </form>
               </div>
           </div>
        </div>
    </section>
@endsection
