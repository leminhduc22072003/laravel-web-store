@extends('client.master')
@section('css')
    <link href="{{asset('css/cart.css')}}" rel="stylesheet">
@endsection
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 padding-0">
                    <h3 class="cart2-title"><i style="margin-right: 10px" class="fas fa-map-marker-alt"></i> Địa chỉ nhận hàng</h3>
                    <form action="{{route('client.cart3')}}" method="post" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Họ và tên</label>
                            <input class="form-control" name="name" value="{{old('name') ? old('name') : Session::get('userClient')['name']}}" id="exampleFormControlInput1" placeholder="Họ và tên">
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
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Địa chỉ</label>
                            <input class="form-control" name="address" value="{{old('address')}}" id="exampleFormControlInput1" placeholder="Địa chỉ">
                            @error('address')
                            <p class="danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Lời nhắn</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="note" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." rows="3">{{old('note')}}</textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkCod" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán trực tiếp
                            </label>
                        </div>
                        <div class="form-check" style="margin-bottom: 20px">
                            <input class="form-check-input" type="radio" name="checkCod" id="exampleRadios2" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                                Thanh toán chuyển khoản
                            </label>
                        </div>
                        <a class="btn btn-secondary" href="{{route('client.dashboard')}}" style="float:left"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                        <button class="btn btn-primary" type="submit" style="float:right">Tiến tục <i class="fas fa-long-arrow-alt-right"></i></button>
                    </form>
                </div>
                <div class="col-md-4">
                    <h3 class="cart2-title"><i style="margin-right: 10px" class="fas fa-shopping-cart fa-lg"></i> Đơn hàng của bạn</h3>
                    <table class="table">
                        <tbody>
                        @foreach(Session::get('carts') as $key => $cart)
                            <tr>
                                <th>
                                    <img width="29%" style="float:left" src="{{asset('storage/'.$cart->avatar1)}}">
                                    <div class="cart2-name-product">
                                        {{$cart->name}}
                                    </div>
                                </th>
                                <td>
                                    <span style="font-size: 0.8125rem; font-weight: bold">{{number_format($cart->price_applied == 1 ? $cart->unit_price : $cart->promotion_price)}} <span> ₫</span></span>
                                    <div style="float:right; font-size: 0.875rem">
                                        x {{$cart->countCart}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Tạm tính</th>
                            <td class="padding-0" style="font-size: 0.875rem; color: #0ca0dc">{{number_format(Session::get('price'))}} <span> ₫</span></td>
                        </tr>
                        <tr>
                            <th>Tổng</th>
                            <td  class="padding-0" style="font-size: 0.9rem; color: red; font-weight: bold">{{number_format(Session::get('price'))}} <span> ₫</span></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
