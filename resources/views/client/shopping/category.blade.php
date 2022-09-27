@extends('client.master')
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row category-list">
                <h5 class="title-cate"><strong>{{$categoryPage->name}}</strong></h5>
                @if(!empty($categoryPage->parent_id_1) && empty($categoryPage->parent_id_2))
                    @foreach($categoryPage['child2'] as $item)
                        <div class="col-md-3 category-item">
                            <a href="{{route('client.category2', ['category' => $item['parent1']['link'],'category1' => $item['parent2']['link'],'category2' => $item['link']])}}">
                                @foreach($item['product'] as $k => $product)
                                    @if($k == 0)
                                        @if(!empty($product['avatar1']))
                                            <img style="height: 207px" src="{{asset('storage/'.$product['avatar1'])}}">
                                        @endif
                                        @break
                                    @endif
                                @endforeach
                                <h6 href="#">{{$item->name}}</h6>
                            </a>
                        </div>
                    @endforeach
                @elseif(!empty($categoryPage->parent_id_2))
                    @foreach($products as $item)
                        <div class="col-md-3 category-item">
                            <div class="row">
                                <a href="{{route('client.product', ['category' => $categoryPage['parent1']['link'],
                                        'category1' => $categoryPage['parent2']['link'],
                                        'category2' => $categoryPage['link'], 'product' => $item->link])}}">
                                    @for($i = 1; $i < 9; $i++)
                                        @if(!empty($item['avatar'.$i]))
                                            <img style="height: 207px; width: 90%; margin: 10px 10px 0 10px" src="{{asset('storage/'.$item['avatar'.$i])}}">
                                            @break
                                        @endif
                                    @endfor
                                    <h6 style="margin-bottom: 20px">{{$item->name}}</h6>
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
                <div class="col-md-12" style="float: right">
                    {{$products->links()}}
                </div>
                @else
                    @foreach($categoryPage['child1'] as $item)
                        <div class="col-md-3 category-item">
                            <a href="{{route('client.category1', ['category' => $categoryPage->link, 'category1' => $item->link])}}">
                               @foreach($item['child2'] as $value)
                                    @foreach($value['product'] as $k => $product)
                                        @if($k == 0)
                                           @if(!empty($product['avatar1']))
                                                <img style="height: 207px" src="{{asset('storage/'.$product['avatar1'])}}">
                                           @endif
                                           @break
                                        @endif
                                    @endforeach
                               @endforeach
                               <h6>{{$item->name}}</h6>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
