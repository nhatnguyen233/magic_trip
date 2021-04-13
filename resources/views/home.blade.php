@extends('layouts.user.app')

@section('content')
    <section class="hero_single version_2">
        <div class="wrapper">
            <div class="container">
                <h3>Đặt trước những trải nghiệm độc đáo</h3>
                <p>Khám phá các tour du lịch, khách sạn và nhà hàng được xếp hạng hàng đầu trên khắp thế giới</p>
                <form>
                    <div class="row no-gutters custom-search-input-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Hotel, City...">
                                <i class="icon_pin_alt"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input class="form-control" type="text" name="dates" placeholder="When..">
                                <i class="icon_calendar"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="panel-dropdown">
                                <a href="#">Guests <span class="qtyTotal">1</span></a>
                                <div class="panel-dropdown-content">
                                    <!-- Quantity Buttons -->
                                    <div class="qtyButtons">
                                        <label>Adults</label>
                                        <input type="text" name="qtyInput" value="1">
                                    </div>
                                    <div class="qtyButtons">
                                        <label>Childrens</label>
                                        <input type="text" name="qtyInput" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" class="btn_search" value="Search">
                        </div>
                    </div>
                    <!-- /row -->
                </form>
            </div>
        </div>
    </section>
    <!-- /hero_single -->

    <div class="container container-custom margin_80_0">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>Những chuyến tham quan phổ biến của chúng tôi</h2>
            <p>Những chuyến tham quan kỳ thú, tràn đầy năng lượng giúp cuộc sống thêm sống động</p>
        </div>
        <div id="reccomended" class="owl-carousel owl-theme">
            @foreach($tours as $item)
                @php
                    $average = $item->reviews->count() > 0 ? round(array_sum($item->reviews->pluck('rate')->toArray())/$item->reviews->count(),1) : 0;
                @endphp
                <div class="item">
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="{{ route('tours.show', $item->id) }}"><img src="{{ $item->thumbnail_url }}" class="img-fluid" alt="" width="800"
                                                            height="533">
                                <div class="read_more"><span>Read more</span></div>
                            </a>
                            <small>Historic</small>
                        </figure>
                        <div class="wrapper">
                            <h3><a href="{{ route('tours.show', $item->id) }}">{{ $item->name }}</a></h3>
                            <p>{!! \Illuminate\Support\Str::limit($item->description, 115, '...')  !!}</p>
                            <span class="price">From <strong>{{ number_format($item->price, 0, '', ',') }}đ</strong> / 1 người</span>
                        </div>
                        <ul>
                            <li><i class="icon_clock_alt"></i> {{ ($item->total_time) }} giờ</li>
                            <li>
                                <div class="score">
                                    <span>
                                        @if($average >= 9)
                                            Tuyệt vời
                                        @elseif($average >= 8)
                                            Tốt
                                        @elseif($average >= 5)
                                            Khá tốt
                                        @else
                                            Bình thường
                                        @endif
                                        <em>{{ $item->reviews->count() }} đánh giá</em>
                                    </span>
                                    <strong>{{ $average }}</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
            <div class="item">
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="tour-detail.html"><img src="{{ asset('img/tour_1.jpg') }}" class="img-fluid" alt="" width="800"
                                                        height="533">
                            <div class="read_more"><span>Read more</span></div>
                        </a>
                        <small>Historic</small>
                    </figure>
                    <div class="wrapper">
                        <h3><a href="tour-detail.html">Arc Triomphe</a></h3>
                        <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                        <span class="price">From <strong>$54</strong> /per person</span>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> 1h 30min</li>
                        <li>
                            <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
            <div class="item">
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="tour-detail.html"><img src="{{ asset('img/tour_2.jpg') }}" class="img-fluid" alt="" width="800"
                                                        height="533">
                            <div class="read_more"><span>Read more</span></div>
                        </a>
                        <small>Churches</small>
                    </figure>
                    <div class="wrapper">
                        <h3><a href="tour-detail.html">Notredam</a></h3>
                        <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                        <span class="price">From <strong>$124</strong> /per person</span>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> 1h 30min</li>
                        <li>
                            <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
            <div class="item">
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="tour-detail.html"><img src="{{ asset('img/tour_3.jpg') }}" class="img-fluid" alt="" width="800"
                                                        height="533">
                            <div class="read_more"><span>Read more</span></div>
                        </a>
                        <small>Historic</small>
                    </figure>
                    <div class="wrapper">
                        <h3><a href="tour-detail.html">Versailles</a></h3>
                        <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                        <span class="price">From <strong>$25</strong> /per person</span>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> 1h 30min</li>
                        <li>
                            <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
            <div class="item">
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="tour-detail.html"><img src="{{ asset('img/tour_3.jpg') }}" class="img-fluid" alt="" width="800"
                                                        height="533">
                            <div class="read_more"><span>Read more</span></div>
                        </a>
                        <small>Historic</small>
                    </figure>
                    <div class="wrapper">
                        <h3><a href="tour-detail.html">Versailles</a></h3>
                        <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                        <span class="price">From <strong>$25</strong> /per person</span>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> 1h 30min</li>
                        <li>
                            <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
            <div class="item">
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="tour-detail.html"><img src="{{ asset('img/tour_4.jpg') }}" class="img-fluid" alt="" width="800"
                                                        height="533">
                            <div class="read_more"><span>Read more</span></div>
                        </a>
                        <small>Museum</small>
                    </figure>
                    <div class="wrapper">
                        <h3><a href="tour-detail.html">Pompidue Museum</a></h3>
                        <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                        <span class="price">From <strong>$45</strong> /per person</span>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> 2h 30min</li>
                        <li>
                            <div class="score"><span>Superb<em>350 Reviews</em></span><strong>9.0</strong></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
            <div class="item">
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="tour-detail.html"><img src="{{ asset('img/tour_5.jpg') }}" class="img-fluid" alt="" width="800"
                                                        height="533">
                            <div class="read_more"><span>Read more</span></div>
                        </a>
                        <small>Walking</small>
                    </figure>
                    <div class="wrapper">
                        <h3><a href="tour-detail.html">Tour Eiffel</a></h3>
                        <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
                        <span class="price">From <strong>$65</strong> /per person</span>
                    </div>
                    <ul>
                        <li><i class="icon_clock_alt"></i> 1h 30min</li>
                        <li>
                            <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.5</strong></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /item -->
        </div>
        <!-- /carousel -->
        <p class="btn_home_align"><a href="tours-grid-isotope.html" class="btn_1 rounded">Tất cả Tours</a></p>
        <hr class="large">
    </div>
    <!-- /container -->

    <div class="container container-custom margin_30_95">
        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>Những khách sạn và chỗ ở phổ biến</h2>
                <p>Các địa điểm vui chơi lí thú</p>
            </div>
            <div class="row">
                <!-- /grid_item -->
                @foreach($accommodations as $item)
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <a href="{{ route('accommodations.show', $item->id) }}" class="grid_item">
                            <figure>
                                <!-- <div class="score"><strong>8.9</strong></div> -->
                                <img src="{{ $item->thumbnail_url }}" class="img-fluid" alt="">
                                <div class="info">
                                    <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i
                                            class="icon_star"></i><i class="icon_star"></i></div>
                                    <h5><a href="{{ route('accommodations.show', $item->id) }}">{{ $item->name }}</a></h5>
                                </div>
                            </figure>
                        </a>
                    </div>
                @endforeach
                <!-- /grid_item -->
            </div>
            <!-- /row -->
            <a href="hotels-grid-isotope.html"><strong>View all ({{ $accommodations->count() }}) <i
                            class="arrow_carrot-right"></i></strong></a>
        </section>
        <!-- /section -->

        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>Những nhà hàng được ưa chuộng</h2>
                <p>Các địa điểm vui chơi lí thú</p>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <a href="restaurant-detail.html" class="grid_item">
                        <figure>
                            <div class="score"><strong>8.5</strong></div>
                            <img src="{{ asset('img/restaurant_1.jpg') }}" class="img-fluid" alt="">
                            <div class="info">
                                <h3>Da Alfredo</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /grid_item -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <a href="restaurant-detail.html" class="grid_item">
                        <figure>
                            <div class="score"><strong>7.9</strong></div>
                            <img src="{{ asset('img/restaurant_2.jpg') }}" class="img-fluid" alt="">
                            <div class="info">
                                <h3>Slow Food</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /grid_item -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <a href="restaurant-detail.html" class="grid_item">
                        <figure>
                            <div class="score"><strong>7.5</strong></div>
                            <img src="{{ asset('img/restaurant_3.jpg') }}" class="img-fluid" alt="">
                            <div class="info">
                                <h3>Bella Napoli</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /grid_item -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <a href="restaurant-detail.html" class="grid_item">
                        <figure>
                            <div class="score"><strong>9.0</strong></div>
                            <img src="{{ asset('img/restaurant_4.jpg') }}" class="img-fluid" alt="">
                            <div class="info">
                                <h3>Marcus</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /row -->
            <a href="restaurants-grid-isotope.html"><strong>View all (157) <i
                            class="arrow_carrot-right"></i></strong></a>
        </section>
        <!-- /section -->

        <div class="banner mb-0">
            <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div>
                    <small>Phiêu lưu</small>
                    <h3>Sự tò mò<br>Kinh nghiệm phiêu lưu</h3>
                    <p>Các hoạt động và chỗ ở</p>
                    <a href="adventure.html" class="btn_1">Đọc thêm</a>
                </div>
            </div>
            <!-- /wrapper -->
        </div>
        <!-- /banner -->

    </div>
    <!-- /container -->

    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h3>Tin tức và sự kiện</h3>
                <p>Các hoạt động, team building náo nhiệt</p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <a class="box_news" href="#0">
                        <figure><img src="{{ asset('img/news_home_1.jpg') }}" alt="">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>Mark Twain</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Pri oportere scribentur eu</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
                <div class="col-lg-6">
                    <a class="box_news" href="#0">
                        <figure><img src="{{ asset('img/news_home_2.jpg') }}" alt="">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>Jhon Doe</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Duo eius postea suscipit ad</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
                <div class="col-lg-6">
                    <a class="box_news" href="#0">
                        <figure><img src="{{ asset('img/news_home_3.jpg') }}" alt="">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>Luca Robinson</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Elitr mandamus cu has</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
                <div class="col-lg-6">
                    <a class="box_news" href="#0">
                        <figure><img src="{{ asset('img/news_home_4.jpg') }}" alt="">
                            <figcaption><strong>28</strong>Dec</figcaption>
                        </figure>
                        <ul>
                            <li>Paula Rodrigez</li>
                            <li>20.11.2017</li>
                        </ul>
                        <h4>Id est adhuc ignota delenit</h4>
                        <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                            ullum vidisse....</p>
                    </a>
                </div>
                <!-- /box_news -->
            </div>
            <!-- /row -->
            <p class="btn_home_align"><a href="blog.html" class="btn_1 rounded">View all news</a></p>
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->

    <div class="call_section">
        <div class="container clearfix">
            <div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
                <div class="block-reveal">
                    <div class="block-vertical"></div>
                    <div class="box_1">
                        <h3>Enjoy a GREAT travel with us</h3>
                        <p>Ius cu tamquam persequeris, eu veniam apeirian platonem qui, id aliquip voluptatibus pri.
                            Ei mea primis ornatus disputationi. Menandri erroribus cu per, duo solet congue ut. </p>
                        <a href="#0" class="btn_1 rounded">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/call_section-->
@endsection
