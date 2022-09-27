<header class="header-top">
    <div class="container">
        @if(!empty(Session::get('userClient')))
            <div class="float-right login-header">
                <i class="fas fa-user"></i><a href="{{route('client.user.detail')}}"> {{Session::get('userClient')['name']}}</a>
                <span> | </span>
                <span><i class="fas fa-lock"></i><a href="{{route('client.user.logout')}}"> Đăng xuất</a></span>
            </div>
        @else
            <div class="float-right login-header">
                <i class="fas fa-user"></i><a href="{{route('client.user.get-register')}}"> Đăng ký</a>
                <span> | </span>
                <span><i class="fas fa-unlock"></i><a href="{{route('client.user.get-login')}}"> Đăng nhập</a></span>
            </div>
        @endif
    </div>
</header>
<section>
    <div class="container">
        <div class="header-main padding-0">
            <div class="row">
                <div class="col-sm-3 col-md-3 padding-0">
                    <a href="{{route('client.dashboard')}}">
                        <img class="logo-img" src="{{asset('img/logo.jpg')}}" alt="logo">
                    </a>
                </div>
                <div class="col-sm-12 col-md-6">
                    <form action="{{route('client.search')}}" method="get">
                        <input class="search-top" placeholder="Tìm kiếm" name="search" type="search"><button type="submit" style="color: white" class="fas fa-search button-top"></button>
                    </form>
                </div>
                <div class="col-md-3 row-top">
                    <div class="cart-shopping cart-contents">
                        <a class="cart-contents" href="#" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="shopping-number">
                                {{!empty(Session::get('carts')) ? count(Session::get('carts')) : 0}}
                            </span>
                        </a>
                    </div>
                    <div class="hot-line">
                        <img src="{{asset('themes/phucan/assets/img/icon-phone.png')}}">
                    </div>
                    <div class="phone">
                        <a href="#">Hot line: <span>0935.727.585</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0ca0dc; color: #fff">
                    <h6 class="modal-title" id="exampleModalLongTitle">Có {{!empty(Session::get('carts')) ? count(Session::get('carts')) : 0}} sản phẩm trong giỏ hàng</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(!empty(Session::get('carts')))
                        @foreach(Session::get('carts') as $key => $productCart)
                            <div class="col-md-12 modal-div-cart">
                                <div class="row">
                                    <div class="col-md-2 modal-top">
                                        <img src="{{asset('storage/'.$productCart->avatar1)}}">
                                    </div>
                                    <div class="col-md-8">
                                        <p class="modal-body-p1"><a class="modal-body-a" href="#">{{$productCart->name}}</a></p>
                                        <p class="modal-body-p2">{{$productCart->price_applied == 1 ? number_format($productCart->unit_price) : number_format($productCart->promotion_price)}} ₫ x {{$productCart->countCart}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="return removeCart({{$key}})" href="#"> <i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="price-total">
                                <div class="total">Tạm tính:
                                    <strong><span class="amount">{{number_format(Session::get('price'))}}&nbsp;<span class="amount">₫</span></span>
                                    </strong>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <a href="{{route('client.cart1')}}" class="col-md-12 btn btn-danger">Xem giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="border-top-bottom">
    <div class="container padding-0">
        <nav class="navbar navbar-expand-lg navbar-light padding-0 menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 10">
                <ul class="navbar-nav mr-auto menu-ul-level1">
                    @foreach($categories as $k => $category)
                        <li class="nav-item menu-li-level1" style="height: 43px">
                            <div class="dropdown">
                                <a class=  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    {{$category->name}}
                                </a>
                                <ul class="dropdown-menu menu-ul-level2" aria-labelledby="dropdownMenu2">
                                    @if(!empty($category['child1']))
                                        @foreach($category['child1'] as $key => $item)
                                            <li class="menu-li-level2">
                                                <a href="{{route('client.category1', ['category' => $category->link, 'category1' => $item->link])}}">
                                                    <b>{{$item->name}}</b>
                                                </a>
                                                <ul class="menu-ul-level3">
                                                    @if(!empty($item['child2']))
                                                        @foreach($item['child2'] as $key => $value)
                                                            <li class="menu-li-level3">
                                                                <a href="{{route('client.category2', ['category' => $category->link, 'category1' => $item->link, 'category2' => $value->link])}}">
                                                                    {{$value->name}}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
    @if(empty($isIndex))
        @if(!empty($isSearch))
            <nav aria-label="breadcrumb" style="background-color: #e9ecef; font-size: 0.875rem">
                <div class="container padding-0">
                    <ol class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="{{route('client.dashboard')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
                    </ol>
                </div>
            </nav>
        @endif
        @if(!empty($cart))
            <nav aria-label="breadcrumb" style="background-color: #e9ecef; font-size: 0.875rem">
                <div class="container padding-0">
                    <ol class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="{{route('client.dashboard')}}">Trang chủ</a></li>
                        @if(!empty($step1))
                            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                        @endif

                        @if(!empty($step2))
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('client.cart1')}}">Giỏ hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thông tin giao hàng</li>
                        @endif

                        @if(!empty($step3))
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('client.cart1')}}">Giỏ hàng</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('client.cart2')}}">Thông tin giao hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hình thức thanh toán</li>
                        @endif

                        @if(!empty($step4))
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('client.cart1')}}">Giỏ hàng</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('client.cart2')}}">Thông tin giao hàng</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('client.cart3')}}">Hình thức thanh toán</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hoàn tất</li>
                        @endif
                    </ol>
                </div>
            </nav>
        @endif
        @if(!empty($productCategoryTop))
            <nav aria-label="breadcrumb" style="background-color: #e9ecef; font-size: 0.875rem">
                <div class="container padding-0">
                    <ol class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="{{route('client.dashboard')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{route('client.category', $categoryPage['parent1']['link'])}}">{{$categoryPage['parent1']['name']}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('client.category1', [$categoryPage['parent1']['link'], $categoryPage['parent2']['link']])}}">{{$categoryPage['parent2']['name']}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('client.category2', [$categoryPage['parent1']['link'], $categoryPage['parent2']['link'], $categoryPage->link])}}">{{$categoryPage->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$productCategoryTop->name}}</li>
                    </ol>
                </div>
            </nav>
        @endif
        @if(empty($productCategoryTop) && empty($cart) && !empty($categoryPage))
            <nav aria-label="breadcrumb" style="background-color: #e9ecef; font-size: 0.875rem">
                <div class="container padding-0">
                    <ol class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="{{route('client.dashboard')}}">Trang chủ</a></li>
                        @if(!empty($categoryPage['parent1']))
                            <li class="breadcrumb-item"><a href="{{route('client.category', $categoryPage['parent1']['link'])}}">{{$categoryPage['parent1']['name']}}</a></li>
                            @if(!empty($categoryPage['parent2']))
                                <li class="breadcrumb-item"><a href="{{route('client.category1', [$categoryPage['parent1']['link'], $categoryPage['parent2']['link']])}}">{{$categoryPage['parent2']['name']}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$categoryPage->name}}</li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{$categoryPage->name}}</li>
                            @endif
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{$categoryPage->name}}</li>
                        @endif
                    </ol>
                </div>
            </nav>
        @endif
    @endif
</section>
