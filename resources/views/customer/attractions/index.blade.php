@extends('layouts.user.app')

@section('content')
    <section class="hero_in restaurants">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Địa điểm tham quan</h1>
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
                        <label for="popular">Phổ biến</label>
                        <input type="radio" id="latest" name="listing_filter" value="latest" data-filter=".latest">
                        <label for="latest">Mới nhất</label>
                    </div>
                </li>
                <li>
                    <div class="layout_view">
                        <a href="#0" class="active"><i class="icon-th"></i></a>
                        <a href="restaurants-list-isotope.html"><i class="icon-th-list"></i></a>
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
            <div class="row no-gutters custom-search-input-2 inner">
                <div class="col-lg-4">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Bạn muốn tìm kiếm địa điểm nào...">
                        <i class="icon_search"></i>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Ở đâu?">
                        <i class="icon_pin_alt"></i>
                    </div>
                </div>
                <div class="col-lg-3">
                    <select class="wide">
                        <option>Tất cả</option>
                        <option>Dã ngoại</option>
                        <option>Khám phá</option>
                        <option>Mạo hiểm</option>
                        <option>Vui chơi</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <input type="submit" class="btn_search" value="Tìm kiếm">
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /custom-search-input-2 -->

        <div class="isotope-wrapper">
            <div class="row">
                @foreach($attractions as $attraction)
                <div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
                    <div class="box_grid">
                        <figure>
                            <a href="#0" class="wish_bt"></a>
                            <a href="{{ route('attractions.show', $attraction->id) }}"><img src="{{ $attraction->thumbnail_url }}" class="img-fluid" alt="" width="800" height="533"><div class="read_more"><span>Đọc thêm</span></div></a>
                            <small>{{ $attraction->district->name }}</small>
                        </figure>
                        <div class="wrapper">
                            <h3><a href="{{ route('attractions.show', $attraction->id) }}">{{ $attraction->name }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit($attraction->title, 40, '...') }}</p>
                        </div>
                        <ul>
                            <li><i class="ti-eye"></i> 164 lượt xem</li>
                            <li><div class="score"><span>Tuyệt vời<em>350 đánh giá</em></span><strong>8.9</strong></div></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /isotope-wrapper -->

        <div class="d-flex justify-content-center">
            {{ $attractions->links() }}
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
