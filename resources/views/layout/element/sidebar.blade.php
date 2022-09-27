<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('img/nguyenthienduc-giainhat-a.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 16px">Quản trị Mộc Vũ Long</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset(Session::get('user')['avatar'] ? asset('storage/'.Session::get('user')['avatar']) : '#')}}" style="width: 60px; height: 60px" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.user.detail', Session::get('user')['id'])}}" class="d-block">{{Session::get('user')['name']}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item set-menu-width">
                    <a href="{{route('admin.dashboard')}}" class="nav-link @yield('chart')">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview @yield('category-open')">
                    <a href="#" class="nav-link @yield('category')">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Danh mục
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview set-menu-width">
                        <li class="nav-item">
                            <a href="{{route('admin.category.list')}}" class="nav-link @yield('category-list')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item set-menu-width">
                            <a href="{{route('admin.category.form.get')}}" class="nav-link @yield('category-form')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview @yield('product-open')">
                    <a href="#" class="nav-link @yield('product')">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Sản phẩm
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview set-menu-width">
                        <li class="nav-item">
                            <a href="{{route('admin.product.list')}}" class="nav-link @yield('product-list')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item set-menu-width">
                            <a href="{{route('admin.product.form.get')}}" class="nav-link @yield('product-form')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview @yield('order-open')">
                    <a href="#" class="nav-link @yield('order')">
                        <i class="nav-icon fas fa-list-ol"></i>
                        <p>
                            Đơn hàng
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview set-menu-width">
                        <li class="nav-item">
                            <a href="{{route('admin.order.list')}}" class="nav-link @yield('order-list')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview @yield('customer-open')">
                    <a href="#" class="nav-link @yield('customer')">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Khách hàng
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">1</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview set-menu-width">
                        <li class="nav-item">
                            <a href="{{route('admin.customer.list')}}" class="nav-link @yield('customer-list')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>

{{--                <li class="nav-item has-treeview @yield('statistical-open')">--}}
{{--                    <a href="#" class="nav-link @yield('statistical')">--}}
{{--                        <i class="nav-icon fas fa-chart-bar"></i>--}}
{{--                        <p>--}}
{{--                            Thống kê--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                            <span class="badge badge-info right">1</span>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview set-menu-width">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('admin.statistical.revenue.list')}}" class="nav-link @yield('statistical-revenue')">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Doanh thu</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <li class="nav-item has-treeview @yield('user-open')">
                    <a href="#" class="nav-link @yield('user')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Người dùng
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview set-menu-width">
                        <li class="nav-item">
                            <a href="{{route('admin.user.list')}}" class="nav-link @yield('user-list')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item set-menu-width">
                            <a href="{{route('admin.user.form.get')}}" class="nav-link @yield('user-form')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

{{--                <li class="nav-item has-treeview @yield('contact-open')">--}}
{{--                    <a href="#" class="nav-link @yield('contact')">--}}
{{--                        <i class="nav-icon fas fa-address-card"></i>--}}
{{--                        <p>--}}
{{--                            Liên hệ--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                            <span class="badge badge-info right">3</span>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview set-menu-width">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('admin.contact.showroom.list')}}" class="nav-link @yield('contact-showroom')">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Showroom</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item set-menu-width">--}}
{{--                            <a href="{{route('admin.contact.phone.list')}}" class="nav-link @yield('contact-phone')">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Điện thoại</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item set-menu-width">--}}
{{--                            <a href="{{route('admin.contact.social-network.list')}}" class="nav-link @yield('contact-social-network')">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Mạng xã hội</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
