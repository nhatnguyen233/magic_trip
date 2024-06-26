@extends('layouts.user.app')

@section('content')
    <section class="hero_single version_2">
        <div class="wrapper">
            <div class="container">
                <h3>Đặt trước những trải nghiệm độc đáo</h3>
                <p>Khám phá các tour du lịch, khách sạn và nhà hàng được xếp hạng hàng đầu trên khắp thế giới</p>
                <form action="{{ route('tours.grid') }}" method="GET">
                    <div class="row no-gutters custom-search-input-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" name="address" type="text" placeholder="Địa chỉ, tỉnh, thành phố">
                                <i class="icon_pin_alt"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input class="form-control" type="text" name="dates" placeholder="Thời điểm mong muốn">
                                <i class="icon_calendar"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select class="wide" name="cat_id">
                                <option value="">Loại hình du lịch...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @if(request()->get('cat_id') == $category->id)  selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" class="btn_search" value="Tìm kiếm">
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
                                <div class="read_more"><span>Chi tiết</span></div>
                            </a>
                            <small>{{ $item->infos->first()->attraction->district->name }}</small>
                        </figure>
                        <div class="wrapper">
                            <h3><a href="{{ route('tours.show', $item->id) }}">{{ $item->name }}</a></h3>
                            <p>{!! \Illuminate\Support\Str::limit($item->description, 115, '...')  !!}</p>
                            <span class="price">Từ <strong>{{ number_format($item->price, 0, '', ',') }}đ</strong> / 1 người</span>
                        </div>
                        <ul>
                            <li><i class="icon_clock_alt"></i> {{ round(($item->total_time/24)) }} ngày</li>
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
        </div>
        <!-- /carousel -->
        <p class="btn_home_align"><a href="{{ route('tours.grid') }}" class="btn_1 rounded">Tất cả</a></p>
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
                                <div class="score"><strong>8.9</strong></div>
                                <img src="{{ $item->thumbnail_url }}" class="img-fluid" alt="">
                                <div class="info">
                                    <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i
                                            class="icon_star"></i><i class="icon_star"></i></div>
                                    <h3>{{ $item->name }}</h3>
                                </div>
                            </figure>
                        </a>
                    </div>
                @endforeach
                <!-- /grid_item -->
            </div>
            <!-- /row -->
            <a href="{{ route('accommodations.index') }}"><strong>Tất cả  ({{ $total_accommodations }}) <i
                            class="arrow_carrot-right"></i></strong></a>
        </section>
        <!-- /section -->

        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>Những địa điểm du lịch nổi bật</h2>
                <p>Các địa điểm vui chơi lí thú</p>
            </div>
            <div class="row">
                @foreach($attractions as $item)
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <a href="{{ route('attractions.show', $item->id) }}" class="grid_item">
                        <figure>
                            <div class="score"><strong>8.5</strong></div>
                            <img src="{{ $item->thumbnail_url }}" class="img-fluid" alt="">
                            <div class="info">
                                <h3>{{ $item->name }}</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- /row -->
            <a href="{{ route('attractions.index') }}"><strong>Tất cả ({{ $total_attractions }}) <i
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
                        <h3>Tận hưởng một chuyến du lịch tuyệt vời cùng chúng tôi</h3>
                        <p>Du lịch khiến một người trở nên khiêm tốn. Bạn sẽ nhận ra bạn chỉ chiếm được một nơi rất nhỏ bé trên thế giới này. </p>
                        <a href="#0" class="btn_1 rounded">Đọc thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/call_section-->
@endsection

@section('script')
    <!-- INPUT QUANTITY  -->
    <script>
        $(function () {
            'use strict';
            $('input[name="dates"]').daterangepicker({
                autoUpdateInput: false,
                minDate: new Date(),
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' > ' + picker.endDate.format('DD-MM-YYYY'));
            });
            $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
