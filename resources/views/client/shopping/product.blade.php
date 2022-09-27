@extends('client.master')
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row">
                <h5 class="title-cate" style="margin-bottom: 30px"><strong>{{$productCategoryTop->name}}</strong></h5>
                <div class="col-md-12" style="margin-bottom: 30px">
                   <div class="row">
                       <div class="col-md-6 padding-0">
                           <div class="col-sm-12 col-md-12 padding-left">
                               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                   <ol class="carousel-indicators">
                                       @for($i = 1; $i <= 8; $i++)
                                           @if($i == 1)
                                               <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                                           @else
                                               <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                                           @endif
                                       @endfor
                                   </ol>
                                   <div class="carousel-inner">
                                       @for($i = 1; $i <= 8; $i++)
                                           @if($i == 1)
                                               <div class="carousel-item active">
                                                   <img class="d-block w-100" src="{{asset('storage/'.$productCategoryTop['avatar'.$i])}}" style="width: 100%">
                                               </div>
                                           @else
                                               <div class="carousel-item">
                                                   <img class="d-block w-100" src="{{asset('storage/'.$productCategoryTop['avatar'.$i])}}" style="width: 100%">
                                               </div>
                                           @endif
                                       @endfor
                                   </div>
                                   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                       <span class="sr-only">Previous</span>
                                   </a>
                                   <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                       <span class="sr-only">Next</span>
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="col-sm-12 col-md-6 product-info">
                           <span style="font-weight: 600; margin-bottom: 5px; display: block; font-size: 0.875rem">Mã sản phẩm: {{$productCategoryTop->code}}</span>
                           <div class="reviews-content"><div class="star"></div><span itemprop="reviewCount" class="count">0</span> đánh giá</div>
                           <div class="description">
                               <span style="font-weight: 600; margin-bottom: 5px; display: block; font-size: 0.875rem">Quy cách: <span>{{$productCategoryTop->procedure}}</span></span>
                               <span style="font-weight: 600; margin-bottom: 5px; display: block; font-size: 0.875rem">Bảo hành: <span>{{$productCategoryTop->warranty}}</span></span>
                               <span style="font-weight: 600; margin-bottom: 5px; display: block; font-size: 0.875rem">Tình trạng: <span>Mới</span></span>
                           </div>
                           @if($productCategoryTop->price_applied == 1)
                               <p class="price-top">{{$productCategoryTop->unit_price}} ₫</p>
                           @else
                               <p class="price-top">{{$productCategoryTop->promotion_price}} ₫</p>
                               <p class="price-bottom">{{$productCategoryTop->unit_price}} ₫</p>
                           @endif
                           <button type="button" name="add-to-cart" onclick="addCart({{$productCategoryTop->id}})" class="single_add_to_cart_button button float-left">Mua hàng</button>
                       </div>
                   </div>
                </div>
                <div class="col-md-12 padding-0">
                    <div class="row">
                        <div class="col-sm-12 col-md-9">
                            <ul class="nav nav-tabs"><li class="description_tab active"> <a href="#tab-description" data-toggle="tab1">Thông tin chi tiết</a></li></ul>
                            <div class="tab-pane active" id="tab-description">
                                <h6 class="tab-pane-h2">Thông tin chi tiết</h6>
                                <?php
                                $str = $productCategoryTop->detail;
                                echo html_entity_decode($str);
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="box-slider-title"> <span>SẢN PHẨM CÙNG LOẠI</span></div>
                            <div class="resp-slider-container">
                                @foreach($categoryPage['product'] as $key => $productCate)
                                    <div class="col-md-12 padding-0 item-product">
                                        <img src="{{asset('storage/'.$productCate->avatar1)}}" style="width: 100%">
                                        <div class="item-content-product">
                                            <a href="#">{{$productCate->name}}</a>
                                            <div class="item-price">
                                                @if($productCate->price_applied == 1)
                                                    <a class="col-md-12 padding-0 item-cart" href="#" onclick="return addCart({{$productCate->id}})">
                                                        <i class="fa fa-shopping-cart item-icon-cart"> </i>Mua hàng
                                                    </a>
                                                    <p class="price-top-item">{{$productCate->unit_price}} ₫</p>
                                                @else
                                                    <a class="col-md-12 padding-0 item-cart" href="#"  onclick="return addCart({{$productCate->id}})">
                                                        <i class="fa fa-shopping-cart item-icon-cart"> </i>Mua hàng
                                                    </a>
                                                    <p class="price-bottom-item">{{$productCate->unit_price}} ₫</p>
                                                    <p class="price-top-item">{{$productCate->promotion_price}} ₫</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
