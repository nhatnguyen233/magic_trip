@extends('layouts.user.app')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <section class="hero_in hotels">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>TOURS</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="filters_listing sticky_horizontal">
        <div class="container">
            <ul class="clearfix">
                <li>
                    <div class="switch-field">
                        <input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*"
                               class="selected">
                        <label for="all">All</label>
                        <input type="radio" id="popular" name="listing_filter" value="popular" data-filter=".popular">
                        <label for="popular">Popular</label>
                        <input type="radio" id="latest" name="listing_filter" value="latest" data-filter=".latest">
                        <label for="latest">Latest</label>
                    </div>
                </li>
                <li>
                    <div class="layout_view">
                        <a href="hotels-grid-isotope.html"><i class="icon-th"></i></a>
                        <a href="#0" class="active"><i class="icon-th-list"></i></a>
                    </div>
                </li>
                <li>
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"
                       aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on
                        map</a>
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
                @csrf
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
            @foreach($tours as $tour)
                @php
                    $average = $tour->reviews->count() > 0 ? round(array_sum($tour->reviews->pluck('rate')->toArray())/$tour->reviews->count(),1) : 0;
                @endphp
                <div class="box_list isotope-item latest">
                    <div class="row no-gutters">
                        <div class="col-lg-5">
                            <figure>
                                <small>Parirs Centre</small>
                                <a href="{{ route('tours.show', $tour->id) }}"><img src="{{ $tour->thumbnail_url }}"
                                                                                    class="img-fluid" alt="" width="800"
                                                                                    height="533">
                                    <div class="read_more"><span>Đọc thêm</span></div>
                                </a>
                            </figure>
                        </div>
                        <div class="col-lg-7">
                            <div class="wrapper">
                                <a href="#0" class="wish_bt"></a>
                                <div class="cat_star">
                                    @if($average >= 9)
                                        @for($i = 1; $i<=5; $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                    @elseif($average >= 8)
                                        @for($i = 1; $i<=4; $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                    @elseif($average >= 5)
                                        @for($i = 1; $i<=3; $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                    @elseif($average > 4)
                                        @for($i = 1; $i<=2; $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                    @elseif($average >= 2)
                                        <i class="icon_star"></i>
                                    @endif
                                    {{--                                <i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>--}}
                                </div>
                                <h3><a href="{{ route('tours.show', $tour->id) }}">{{ $tour->name }}</a></h3>
                                <p>{!! \Illuminate\Support\Str::limit($tour->description, 115, '...')  !!}</p>
                                <span
                                    class="price">Từ <strong>{{ number_format($tour->price) }}đ</strong> / 1 người</span>
                            </div>
                            <ul>
                                <li><i class="ti-eye"></i> 164 views</li>
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
                                        <em>{{ $tour->reviews->count() }} đánh giá</em>
                                        </span>
                                        <strong>{{ $average }}</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $tours->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Map -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="{{ asset('js/front/markerclusterer.js') }}"></script>
<script src="{{ asset('js/front/map_tours.js') }}"></script>
<script src="{{ asset('js/front/infobox.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>

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
