@extends('layouts.user.app')

@section('content')
    <section class="hero_single version_2">
        <div class="wrapper">
            <div class="container">
                <h3>@lang('message.header_title')</h3>
                <p>@lang('message.header_des')</p>
                <form action="{{ route('tours.grid') }}" method="GET">
                    <div class="row no-gutters custom-search-input-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input class="form-control" name="address" type="text" placeholder="Hotel, City...">
                                <i class="icon_pin_alt"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input class="form-control" type="text" name="dates" placeholder="When...">
                                <i class="icon_calendar"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select class="wide" name="cat_id">
                                <option value="">@lang('message.type')</option>
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
            <h2>@lang('message.popular_tour')</h2>
            <p>@lang('message.tour_des')</p>
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
                            <span class="price">From <strong>{{ number_format($item->price, 0, '', ',') }}đ</strong> / 1 @lang('message.per')</span>
                        </div>
                        <ul>
                            <li><i class="icon_clock_alt"></i> {{ round(($item->total_time/24)) }} @lang('message.day')</li>
                            <li>
                                <div class="score">
                                    <span>
                                        @if($average >= 9)
                                            @lang('message.great')
                                        @elseif($average >= 8)
                                            @lang('message.good')
                                        @elseif($average >= 5)
                                            @lang('message.average')
                                        @else
                                            @lang('message.bad')
                                        @endif
                                        <em>{{ $item->reviews->count() }} @lang('message.review')</em>
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
        </div>
        <!-- /carousel -->
        <p class="btn_home_align"><a href="{{ route('tours.grid') }}" class="btn_1 rounded">@lang('message.all')</a></p>
        <hr class="large">
    </div>
    <!-- /container -->

    <div class="container container-custom margin_30_95">
        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>@lang('message.popular_hotel')</h2>
                <p>@lang('message.hotel_des')</p>
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
            <a href="{{ route('accommodations.index') }}"><strong>@lang('message.all')  ({{ $accommodations->count() }}) <i
                            class="arrow_carrot-right"></i></strong></a>
        </section>
        <!-- /section -->

        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>@lang('message.popular_attraction')</h2>
                <p>@lang('message.attraction_des')</p>
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
            <a href="{{ route('attractions.index') }}"><strong>@lang('message.all') ({{ $attractions->count() }}) <i
                            class="arrow_carrot-right"></i></strong></a>
        </section>
        <!-- /section -->

        <div class="banner mb-0">
            <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div>
                    <small>@lang('message.adventure')</small>
                    <h3>@lang('message.curiosity')<br>@lang('message.experience')</h3>
                    <p>@lang('message.activity')</p>
                    <a href="adventure.html" class="btn_1">@lang('message.read_more')</a>
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
                <h3>@lang('message.news') &amp; @lang('message.event')</h3>
                <p>@lang('message.news_des')</p>
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
                        <h3>@lang('message.intro_title')</h3>
                        <p>@lang('message.intro_des')</p>
                        <a href="#0" class="btn_1 rounded">@lang('message.read_more')</a>
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
