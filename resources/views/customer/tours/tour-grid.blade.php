@extends('layouts.user.app')

@section('content')
    <section class="hero_in tours">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Danh sách tour du lịch</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="filters_listing sticky_horizontal">
        <div class="container">
            <ul class="clearfix">
                <li>
                    <div class="switch-field">
                        <input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*" class="selected">
                        <label for="all">Tất cả</label>
                        <input type="radio" id="popular" name="listing_filter" value="popular" data-filter=".popular">
                        <label for="popular">Ưu chuộng</label>
                        <input type="radio" id="latest" name="listing_filter" value="latest" data-filter=".latest">
                        <label for="latest">Mới nhất</label>
                    </div>
                </li>
                <li>
                    <div class="layout_view">
                        <a href="#0" class="active"><i class="icon-th"></i></a>
                        <a href="tours-list-isotope.html"><i class="icon-th-list"></i></a>
                    </div>
                </li>
                <li>
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">Xem bản đồ</a>
                </li>
            </ul>
        </div>
        <!-- /container -->
    </div>
    <!-- /filters -->

    <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div>
    <!-- End Map -->

    <div class="container margin_60_35">
        <div class="col-lg-12">
            <form action="" method="GET">
                <div class="row no-gutters custom-search-input-2 inner">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="description" value="{{ request()->get('description') }}" placeholder="Bạn đang tìm tour như nào...">
                            <i class="icon_search"></i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input class="form-control" type="text" name="address" value="{{ request()->get('address') }}" placeholder="Ở đâu">
                            <i class="icon_pin_alt"></i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <select class="wide" name="province_id">
                            <option value="">All</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}"
                                        @if(request()->get('province_id') == $province->id)  selected @endif>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="submit" class="btn_search" value="Tìm">
                    </div>
                </div>
            </form>
            <!-- /row -->
        </div>
        <!-- /custom-search-input-2 -->

        <div class="isotope-wrapper">
            <div class="row">
            @foreach($tours as $item)
                @php
                    $average = $item->reviews->count() > 0 ? round(array_sum($item->reviews->pluck('rate')->toArray())/$item->reviews->count(),1) : 0;
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="{{ route('tours.show', $item->id) }}"><img src="{{ $item->thumbnail_url }}" class="img-fluid" alt="" width="800" height="533"><div class="read_more"><span>Read more</span></div></a>
                            <small>Historic</small>
                        </figure>
                        <div class="wrapper">
                            <h3><a href="{{ route('tours.show', $item->id) }}">{{ $item->name }}</a></h3>
                            <p>{!! \Illuminate\Support\Str::limit($item->description, 60, '...')  !!}</p>
                            <span class="price">Từ <strong>{{ number_format($item->price) }}đ</strong> / 1 @lang('message.per')</span>
                        </div>
                        <ul>
                            <li><i class="icon_clock_alt"></i> 1h 30min</li>
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
            </div>
            <!-- /row -->
        </div>
        <!-- /isotope-wrapper -->

        <div class="d-flex justify-content-center">
            {{ $tours->links() }}
        </div>
    </div>
    <!-- /container -->

    <div class="bg_color_1">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-md-4">
                    <a href="#0" class="boxed_list">
                        <i class="pe-7s-help2"></i>
                        <h4>Cần hỗ trợ? Liên hệ chúng tôi</h4>
                        <p>Vui lòng liên hệ với chúng tôi để được tư vấn về tour du lịch</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#0" class="boxed_list">
                        <i class="pe-7s-wallet"></i>
                        <h4>Thanh toán</h4>
                        <p>Thanh toán đặt tour nhanh gọn, dễ dàng cả online và offline</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#0" class="boxed_list">
                        <i class="pe-7s-note2"></i>
                        <h4>Hủy chính sách</h4>
                        <p>Chính sách bao gồm những qui định cơ bản khi khách hàng đặt tour du lịch</p>
                    </a>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
<!--/main-->
@endsection

@section('script')
    <!-- Map -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="{{ asset('js/front/markerclusterer.js') }}"></script>
    <script src="{{ asset('js/front/map_tours.js') }}"></script>
    <script src="{{ asset('js/front/infobox.js') }}"></script>

    <!-- Masonry Filtering -->
    <script src="{{ asset('js/front/isotope.min.js') }}"></script>
    <script>
        // $(window).on('load', function(){
        //     var $container = $('.isotope-wrapper');
        //     $container.isotope({ itemSelector: '.isotope-item', layoutMode: 'masonry' });
        // });
        // $('.filters_listing').on( 'click', 'input', 'change', function(){
        //     var selector = $(this).attr('data-filter');
        //     $('.isotope-wrapper').isotope({ filter: selector });
        // });
    </script>
@endsection
