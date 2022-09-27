@extends('client.master')
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row category-list">
                <h5 class="title-cate"><strong>Tìm kiếm: {{$search}}</strong></h5>
                @foreach($data as $item)
                    <div class="col-md-3 category-item">
                        <div class="row">
                            <a href="{{route('client.product', ['category' => $item['category']['link'],
                                    'category1' => $item['category1']['link'],
                                    'category2' => $item['category2']['link'], 'product' => $item->link])}}">
                                @for($i = 1; $i < 9; $i++)
                                    @if(!empty($item['avatar'.$i]))
                                        <img style="height: 207px; width: 90%; margin: 10px 10px 0 10px" src="{{asset('storage/'.$item['avatar'.$i])}}">
                                        @break
                                    @endif
                                @endfor
                                <h6 class="col-md-12" style="margin-bottom: 20px">{{$item->name}}</h6>
                                @if($item['price_applied'] == 1)
                                    <div class="col-md-8 float-left">
                                        <span class="unit_price">{{number_format($item['unit_price'])}} ₫</span>
                                    </div>
                                @else
                                    <div class="col-md-8 float-left">
                                        <span class="unit_price">{{number_format($item['promotion_price'])}} ₫</span>
                                        <br>
                                        <span class="promotion_price">{{number_format($item['unit_price'])}} ₫</span>
                                    </div>
                                    <div class="col-md-2 float-left sale-off">
                                        -{{round((($item['unit_price'] - $item['promotion_price']) / $item['unit_price']) * 100)}}%
                                    </div>
                                @endif
                                <a class="col-md-10 padding-0" style="border: 0.5px solid #333; margin: 20px 0 40px 15px; text-align: center; line-height: 30px; color: #333" href="#" onclick="return addCart({{$item->id}})">
                                    <i class="fa fa-shopping-cart" style="border-right: 0.5px solid #333; width: 30px; height: 30px; text-align: center; line-height: 30px; display: block; float:left; color: #0ca0dc"> </i>Mua hàng
                                </a>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="Page navigation example" style="float: right">
                {{ $data->links() }}
            </div>
{{--            <nav aria-label="Page navigation example">--}}
{{--                <ul class="pagination justify-content-center">--}}
{{--                    <li class="page-item disabled">--}}
{{--                        <a class="page-link" href="#" tabindex="-1">Previous</a>--}}
{{--                    </li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                    <li class="page-item">--}}
{{--                        <a class="page-link" href="#">Next</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
        </div>
    </section>
@endsection
