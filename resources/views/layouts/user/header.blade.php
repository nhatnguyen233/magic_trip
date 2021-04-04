<header class="header menu_fixed">
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->
    <div id="logo">
        <a href="/">
            <img src="{{ asset('img/logo.svg') }}" width="150" height="36" alt="" class="logo_normal">
            <img src="{{ asset('img/logo_sticky.svg') }}" width="150" height="36" alt="" class="logo_sticky">
        </a>
    </div>
    <ul id="top_menu">
        <li><a href="{{ route('cart.index') }}" class="cart-menu-btn" title="Cart"><strong>{{ session()->get('total_item_cart') }}</strong></a></li>
        <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>
        @guest('customer')
            <li><a href="#sign-in-dialog" id="sign-in" class="login" title="Đăng nhập">Đăng nhập</a></li>
        @endguest
        @auth('customer')
            <div class="btn-group">
                <button type="button" class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth('customer')->user()->name }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Tài khoản</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-fw fa-sign-out"></i>Đăng xuất</a>
                </div>
            </div>
        @endauth
    </ul>
    <!-- /top_menu -->
    <a href="#menu" class="btn_mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </a>
    <nav id="menu" class="main-menu">
        <ul>
            <li><span><a href="#0">Trang chủ</a></span>
                <ul>
                    <li><a href="/">Home Default</a></li>
                </ul>
            </li>
            <li><span><a href="#0">Tours</a></span>
                <ul>
                    <li>
                        <span><a href="#0">Tours Grid</a></span>
                        <ul>
                            <li><a href="tours-grid-isotope.html">Tours Grid Isotope</a></li>
                            <li><a href="tours-grid-sidebar.html">Tours Grid Sidebar</a></li>
                            <li><a href="tours-grid-sidebar-2.html">Tours Grid Sidebar 2</a></li>
                            <li><a href="tours-grid.html">Tours Grid Simple</a></li>
                        </ul>
                    </li>
                    <li>
                        <span><a href="#0">Tours List</a></span>
                        <ul>
                            <li><a href="tours-list-isotope.html">Tours List Isotope</a></li>
                            <li><a href="tours-list-sidebar.html">Tours List Sidebar</a></li>
                            <li><a href="tours-list-sidebar-2.html">Tours List Sidebar 2</a></li>
                            <li><a href="tours-list.html">Tours List Simple</a></li>
                        </ul>
                    </li>
                    <li><a href="tours-half-screen-map.html">Tours Half Screen Map</a></li>
                    <li><a href="tour-detail.html">Tour Detail</a></li>
                    <li><a href="detail-working-contact-form.html">Detail Contact Form <strong>New!</strong></a>
                    </li>
                    <li>
                        <span><a href="#0">Open Street Map</a></span>
                        <ul>
                            <li><a href="tours-half-screen-map-leaflet.html">Tours Half Screen Map</a></li>
                            <li><a href="tours-list-isotope-leaflet.html">Tours Grid Isotope</a></li>
                            <li><a href="tours-list-sidebar-leaflet.html">Tours Grid Sidebar</a></li>
                            <li><a href="tours-list-sidebar-2-leaflet.html">Tours Grid Sidebar 2</a></li>
                            <li><a href="tours-list-leaflet.html">Tours Grid Simple</a></li>
                            <li><a href="tours-list-isotope-leaflet.html">Tours List Isotope</a></li>
                            <li><a href="tours-list-sidebar-leaflet.html">Tours List Sidebar</a></li>
                            <li><a href="tours-list-sidebar-2-leaflet.html">Tours List Sidebar 2</a></li>
                            <li><a href="tours-list-leaflet.html">Tours List Simple</a></li>
                            <li><a href="tour-detail-leaflet.html">Tour Detail</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><span><a href="#0">Khách sạn</a></span>
                <ul>
                    <li>
                        <span><a href="#0">Hotel Grid</a></span>
                        <ul>
                            <li><a href="hotels-grid-isotope.html">Hotel Grid Isotope</a></li>
                            <li><a href="hotels-grid-sidebar.html">Hotel Grid Sidebar</a></li>
                            <li><a href="hotels-grid-sidebar-2.html">Hotel Grid Sidebar 2</a></li>
                            <li><a href="hotels-grid.html">Hotel Grid Simple</a></li>
                        </ul>
                    </li>
                    <li>
                        <span><a href="#0">Hotel List</a></span>
                        <ul>
                            <li><a href="hotels-list-isotope.html">Hotel List Isotope</a></li>
                            <li><a href="hotels-list-sidebar.html">Hotel List Sidebar</a></li>
                            <li><a href="hotels-list-sidebar-2.html">Hotel List Sidebar 2</a></li>
                            <li><a href="hotels-list.html">Hotel List Simple</a></li>
                        </ul>
                    </li>
                    <li><a href="hotels-half-screen-map.html">Hotel Half Screen Map</a></li>
                    <li><a href="hotel-detail.html">Hotel Detail</a></li>
                </ul>
            </li>
            <li><span><a href="#0">Eat &amp; Drink</a></span>
                <ul>
                    <li>
                        <span><a href="#0">Restaurant Grid</a></span>
                        <ul>
                            <li><a href="restaurants-grid-isotope.html">Restaurant Grid Isotope</a></li>
                            <li><a href="restaurants-grid-sidebar.html">Restaurant Grid Sidebar</a></li>
                            <li><a href="restaurants-grid-sidebar-2.html">Restaurant Grid Sidebar 2</a></li>
                            <li><a href="restaurants-grid.html">Restaurant Grid simple</a></li>
                        </ul>
                    </li>
                    <li>
                        <span><a href="#0">Restaurant List</a></span>
                        <ul>
                            <li><a href="restaurants-list-isotope.html">Restaurant List Isotope</a></li>
                            <li><a href="restaurants-list-sidebar.html">Restaurant List Sidebar</a></li>
                            <li><a href="restaurants-list-sidebar-2.html">Restaurant List Sidebar 2</a></li>
                            <li><a href="restaurants-list.html">Restaurant List Simple</a></li>
                        </ul>
                    </li>
                    <li><a href="restaurants-half-screen-map.html">Half Screen Map</a></li>
                    <li><a href="restaurant-detail.html">Restaurant Detail</a></li>
                </ul>
            </li>
            <li><span><a href="adventure.html">Cuộc phiêu lưu</a></span></li>
            <li><span><a href="#0">Pages</a></span>
                <ul>
                    <li><a href="about.html">About</a></li>
                    <li><a href="media-gallery.html">Media gallery</a></li>
                    <li><a href="help.html">Help Section</a></li>
                    <li><a href="faq.html">Faq Section</a></li>
                    <li><a href="wishlist.html">Wishlist page</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="bootstrap-modal.html">Bootstrap Modal <strong>New!</strong></a></li>
                    <li><a href="modal-version-2.html">Another Modal <strong>New!</strong></a></li>
                    <li><a href="pricing-tables-2.html">Pricing Tables 1 <strong>New!</strong></a></li>
                    <li><a href="pricing-tables-3.html">Pricing Tables 2 <strong>New!</strong></a></li>
                </ul>
            </li>
            <li><span><a href="#0">Thêm</a></span>
                <ul>
                    <li><a href="menu-options.html">Menu Position Options</a></li>
                    <li><a href="tour-detail-singlemonth-datepicker.html">Single month Datepicker</a></li>
                    <li><a href="404.html">404 Error page</a></li>
                    <li><a href="cart-1.html">Cart page 1</a></li>
                    <li><a href="cart-2.html">Cart page 2</a></li>
                    <li><a href="cart-3.html">Cart page 3</a></li>
                    <li><a href="pricing-tables.html">Responsive pricing tables</a></li>
                    <li><a href="coming_soon/index.html">Coming soon</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                    <li><a href="icon-pack-1.html">Icon pack 1</a></li>
                    <li><a href="icon-pack-2.html">Icon pack 2</a></li>
                    <li><a href="icon-pack-3.html">Icon pack 3</a></li>
                    <li><a href="icon-pack-4.html">Icon pack 4</a></li>
                    <li><a href="hamburgers.html">Animated Hamburgers</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!-- /header -->
