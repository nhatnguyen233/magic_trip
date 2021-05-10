@extends('layouts.user.app')

@section('content')
<section class="hero_in hotels">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>Khách sạn, nhà nghỉ, homestay</h1>
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
							<a href="hotels-list-sidebar.html"><i class="icon-th-list"></i></a>
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
			<div class="row">
				<aside class="col-lg-3" id="sidebar">
					<div id="filters_col">
						<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Lọc </a>
						<div class="collapse show" id="collapseFilters">
							<div class="filter_type">
								<h6>Quận/Huyện</h6>
								<ul>
									<li>
										<label class="container_check">Tất cả <small>(945)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check">Hà Nội <small>(45)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check">Đà Nẵng <small>(30)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check">TP. Hồ Chí Minh<small>(25)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
								</ul>
							</div>
							<div class="filter_type">
                                <h6>Distance</h6>
                                <input type="text" id="range" name="range" value="">
                            </div>
							<div class="filter_type">
								<h6>Star Category</h6>
								<ul>
									<li>
										<label class="container_check"><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small>(25)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check"><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small>(26)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check"><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small>(25)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
								</ul>
							</div>
							<div class="filter_type">
								<h6>Rating</h6>
								<ul>
									<li>
										<label class="container_check">Superb 9+ <small>(25)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check">Very Good 8+ <small>(26)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check">Good 7+ <small>(25)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
									<li>
										<label class="container_check">Pleasant 6+ <small>(12)</small>
								            <input type="checkbox">
								            <span class="checkmark"></span>
								        </label>
									</li>
								</ul>
							</div>
						</div>
						<!--/collapse -->
					</div>
					<!--/filters col-->
				</aside>
				<!-- /aside -->

				<div class="col-lg-9">
					<div class="isotope-wrapper">
						<div class="row">
                            @foreach($accommodations as $accommodation)
							<div class="col-md-6 isotope-item popular">
								<div class="box_grid">
									<figure>
										<a href="#0" class="wish_bt"></a>
										<a href="{{ route('accommodations.show', $accommodation->id) }}"><img src="{{ $accommodation->getAvatarUrlAttribute() }}" class="img-fluid" alt="" width="800" height="533"><div class="read_more"><span>Read more</span></div></a>
										<small>{{ $accommodation->district->name }}</small>
									</figure>
									<div class="wrapper">
										<div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
										<h3><a href="{{ route('accommodations.show', $accommodation->id) }}">{{ $accommodation->name }}</a></h3>
										<p>{!! $accommodation->description !!}</p>
										<span class="price">Từ <strong>{{ number_format($accommodation->lowest_price, 0, '', ',') }} VND</strong> / 1 người</span>
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

				<p class="text-center"><a href="#0" class="btn_1 rounded add_top_30">Tải thêm</a></p>
				</div>
				<!-- /col -->
			</div>
		</div>
		<!-- /bg_color_1 -->
@endsection

@section('script')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="{{ asset('js/front/map_single_tour.js') }}"></script>
    <script src="{{ asset('js/front/infobox.js') }}"></script>
    <script src="{{ asset('js/front/jquery.instagramFeed.min.js') }}"></script>
    <script src="{{ asset('js/front/moment.min.js') }}"></script>
    <script src="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function() {
            "use strict";
            $.instagramFeed({
                'username': 'thelouvremuseum',
                'container': "#instagram-feed",
                'display_profile': false,
                'display_biography': false,
                'display_gallery': true,
                'get_raw_json': false,
                'callback': null,
                'styling': true,
                'items': 12,
                'items_per_row': 6,
                'margin': 1
            });
        });

        $(function () {
            $('#date_of_book').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endsection
