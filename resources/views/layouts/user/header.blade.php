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
            <li><a href="#sign-in-dialog" id="sign-in" class="login" title="Đăng nhập">@lang('message.login')</a></li>
        @endguest
        @auth('customer')
            <div class="btn-group">
                <button type="button" class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mobile-display-name">{{ auth('customer')->user()->name }}</span>
                </button>
                <div class="dropdown-menu">
                    <a class="mobile-hidden-name">
                        {{ auth('customer')->user()->name }}</a>
                    <a class="dropdown-item" href="{{ route('update-profile', auth('customer')->user()->id) }}">@lang('message.account')</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('book-tour.index') }}">
                        <i class="fab fa-first-order"></i>@lang('message.your_cart')</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-fw fa-sign-out"></i>@lang('message.logout')</a>
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
            <li><span><a href="/"> @lang('message.home')</a></span>
                <ul>
                    <li><a href="/">Home Default</a></li>
                </ul>
            </li>
            <li><span><a href="{{ route('tours.index') }}">@lang('message.tour')</a></span>
            </li>
            <li><span><a href="{{ route('accommodations.index') }}">@lang('message.hotel')</a></span>
            </li>
            <li><span><a href="#0">@lang('message.eat') &amp; @lang('message.drink')</a></span>
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
            <li><span><a href="adventure.html">@lang('message.adventure')</a></span></li>
            <li><span><a href="#0">@lang('message.page')</a></span>
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
            <li><span><a href="#0">@lang('message.extra')</a></span>
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
            <li><span><a href="#0"><img src="{{ (\Request::segment(2) == 'language/vi' ?  asset('img/american.png') : asset('img/vietnam.png')) }}" data-retina="true" alt="" width="45" height="25"></a></span>
                <ul>
                    <li><a href="{!! route('language.index', ['en']) !!}"><img src="{{ asset('img/american.png') }}" data-retina="true" alt="" width="45" height="25"></a></li>
                    <li><a href="{!! route('language.index', ['vi']) !!}"><img src="{{ asset('img/vietnam.png') }}" data-retina="true" alt="" width="45" height="25"></a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!-- /header -->
