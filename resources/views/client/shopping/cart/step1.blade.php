@extends('client.master')
@section('css')
   <link href="{{asset('css/cart.css')}}" rel="stylesheet">
@endsection
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 padding-0 carttitle">
                    <i class="fas fa-shopping-cart fa-lg" style="margin-right: 15px"></i>Giỏ hàng của bạn ({{Session::get('total')}} Sản phẩm)
                    <table class="table" style="border-bottom: 0.1rem solid #e6e6e6">
                        <thead>
                        <tr>
                            <th width="60%">Sản phẩm</th>
                            <th width="12%">giá</th>
                            <th width="12%">Số lượng</th>
                            <th width="15%">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty(Session::get('carts')))
                            @foreach(Session::get('carts') as $key => $cart)
                                <tr>
                                    <th>
                                        <a href="#">
                                            <img class="cart-img" src="{{'storage/'. $cart->avatar1}}">
                                        </a>
                                        <div class="productDetail">
                                            <a class="cart-title-product" href="" style="display: flex; flex-direction: column">
                                                {{$cart->name}}
                                            </a>
                                            <a class="cart-remove-product" href="" onclick="return removeCart({{$key}})">
                                                <i class="fas fa-times-circle"></i> Bỏ sản phẩm
                                            </a>
                                        </div>
                                    </th>
                                    <td style="font-weight: bold; color: #000;">
                                        {{$cart->price_applied == 1 ? number_format($cart->unit_price) : number_format($cart->promotion_price)}}<span> ₫</span>
                                    </td>
                                    <td>{{$cart['countCart']}}</td>
                                    <td style="line-height: 30px; font-weight: bold; color: #0ca0dc;">
                                        {{number_format(intval($cart['countCart']) * ($cart->price_applied == 1 ? $cart->unit_price : $cart->promotion_price))}}<span class="amount"> ₫</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-secondary" href="{{route('client.dashboard')}}" style="margin-top: 147px"><i class="fas fa-long-arrow-alt-left"></i> Tiếp tục mua hàng</a>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tạm tính: </th>
                                            <td>{{Session::get('price')}}<span> ₫</span></td>
                                        </tr>
                                    </thead>
                                   <tbody>
                                       <tr>
                                           <th>Tổng: </th>
                                           <td style="color: #0ca0dc">{{Session::get('price')}}<span class="amount"> ₫</span></td>
                                       </tr>
                                   </tbody>
                                </table>
                                <a class="btn btn-primary" href="{{route('client.cart2')}}" style="float:right">Tiến hành thanh toán <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
