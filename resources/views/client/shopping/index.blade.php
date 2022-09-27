@extends('client.master')
@section('content')
<section class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 padding-0 banner1">
                <div class="banner-1-3">
                    <a href="{{route('client.category', 'phong-ngu')}}"><img src="{{asset('img/banner2.png')}}"></a>
                    <a href="{{route('client.category', 'phong-khach')}}"><img src="{{asset('img/banner3.png')}}"></a>
                    <a href="{{route('client.category', 'phong-tho')}}"><img src="{{asset('img/banner4.png')}}"></a>
                </div>
                <div class="banner-4">
                    <a href="{{route('client.category', 'phong-khach')}}"><img src="{{asset('img/banner1.png')}}"></a>
                </div>
                <div class="banner-5-7">
                    <a href="{{route('client.category', 'nha-bep')}}"><img src="{{asset('img/banner5.png')}}"></a>
                    <a href="{{route('client.category', 'noi-that-van-phong')}}"><img src="{{asset('img/banner6.png')}}"></a>
                    <a href="{{route('client.category', 'phong-ngu')}}"><img src="{{asset('img/banner7.png')}}"></a>
                </div>
            </div>
            <div class="col-sm-12 padding-0 banner2">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="{{route('client.category', 'phong-khach')}}">
                                <img class="d-block w-100" src="{{asset('img/banner1.png')}}" alt="First slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{route('client.category', 'phong-ngu')}}">
                                <img class="d-block w-100" src="{{asset('img/banner2.png')}}" alt="Second slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{route('client.category', 'phong-khach')}}">
                                <img class="d-block w-100" src="{{asset('img/banner3.png')}}" alt="Third slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{route('client.category', 'phong-tho')}}">
                                <img class="d-block w-100" src="{{asset('img/banner4.png')}}" alt="Second slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{route('client.category', 'phong-an')}}">
                                <img class="d-block w-100" src="{{asset('img/banner5.png')}}" alt="Third slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{route('client.category', 'noi-that-van-phong')}}">
                                <img class="d-block w-100" src="{{asset('img/banner6.png')}}" alt="Second slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{route('client.category', 'phong-ngu')}}">
                                <img class="d-block w-100" src="{{asset('img/banner7.png')}}" alt="Third slide">
                            </a>
                        </div>
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
            @foreach($categoriesProduct as $key => $category)
                <div class="col-md-12 padding-0 default-category-product">
                    <div class="row">
                        <div class="col-md-12 padding-0 category-product-top{{$key}}">
                            <div class="col-md-3 padding-0 category-product-top-main{{$key}}">
                                <h6><a class="category-product-top-a-h6" href="{{route('client.category', $category->link)}}">{{$category->name}} ></a></h6>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-left: 15px">
                            <div class="row" style="background-color: #f5f5f5">
                                <div class="col-md-3 padding-0">
                                    <a href="#">
                                        <div id="carouselExampleCaptions{{$key}}" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach($category['productForCategory'] as $k => $productCategory)
                                                    @if($k == 0)
                                                        <li data-target="#carouselExampleCaptions" data-slide-to="{{$k}}" class="active"></li>
                                                    @else
                                                        <li data-target="#carouselExampleCaptions" data-slide-to="{{$k}}"></li>
                                                    @endif
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach($category['productForCategory'] as $k => $productCategory)
                                                    @if($k == 0)
                                                        <div class="carousel-item active">
                                                            <img src="{{asset('storage/'.$productCategory->avatar1)}}" style="height: 250px" class="d-block w-100" alt="...">
                                                            <div class="carousel-caption d-none d-md-block">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="carousel-item">
                                                            <img src="{{asset('storage/'.$productCategory->avatar1)}}" style="height: 250px" class="d-block w-100" alt="...">
                                                            <div class="carousel-caption d-none d-md-block">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleCaptions{{$key}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleCaptions{{$key}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-9" style="padding-left: 15px">
                                    <div class="row">
                                        @foreach($category['child1'] as $child1)
                                            @foreach($child1['productForCategory1'] as $product)
                                                <div class="col-md-3 card card-style">
                                                    <a href="{{route('client.category1', ['category' => $category->link, 'category1' => $child1->link])}}">
                                                        <img style="min-height: 185px" src="{{asset('storage/'.$product['avatar1'])}}" class="card-img-top" alt="...">
                                                        <div class="card-body">
                                                            <p>{{$child1->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
