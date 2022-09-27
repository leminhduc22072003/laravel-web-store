@extends('client.master')
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav flex-column">
                        <a style="border-bottom: 1px solid #6e6e6e" class="nav-link" href="{{route('client.user.detail')}}">Thông tin tài khoản</a>
                        <a style="border-bottom: 1px solid #6e6e6e" class="nav-link active" href="{{route('client.user.check-order')}}">Thông tin đặt hàng</a>
                    </nav>
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $order)
                            @foreach($order['orderProduct'] as $k => $product)
                                <tr>
                                    <td>{{$product['product']['name']}}</td>
                                    <td>{{$product['count']}}</td>
                                    <td>{{number_format($product['product_price'])}} <span>₫</span></td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
