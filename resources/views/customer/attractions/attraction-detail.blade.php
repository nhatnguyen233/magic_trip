@extends('layouts.user.app')

@section('content')
		<section class="hero_in hotels_detail">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>{{ $attraction->name }}</h1>
				</div>
				<span class="magnific-gallery">
                    <a href="{{ $attraction->avatar_url }}" class="btn_photos"  data-effect="mfp-zoom-in">Album ảnh</a>
                    @foreach($attraction->images as $image)
                        <a href="{{ $image }}" title="Photo title" data-effect="mfp-zoom-in"></a>
                    @endforeach
				</span>
			</div>
		</section>

		<div class="bg_color_1">
			<nav class="secondary_nav sticky_horizontal">
				<div class="container">
					<ul class="clearfix">
						<li><a href="#description" class="active">Mô tả</a></li>
						<li><a href="#reviews">Đánh giá</a></li>
						<li><a href="#sidebar">Booking</a></li>
					</ul>
				</div>
			</nav>
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-12">
						<section id="description">
							<h2>Mô tả</h2>
							<p>{!! $attraction->description !!}</p>
							<div class="row">
								<div class="col-lg-6">
									<ul class="bullets">
										<li>Dolorem mediocritatem</li>
										<li>Mea appareat</li>
										<li>Prima causae</li>
										<li>Singulis indoctum</li>
									</ul>
								</div>
								<div class="col-lg-6">
									<ul class="bullets">
										<li>Timeam inimicus</li>
										<li>Oportere democritum</li>
										<li>Cetero inermis</li>
										<li>Pertinacia eum</li>
									</ul>
								</div>
							</div>
							<!-- /row -->
							<hr>
							<h3>Instagram photos feed</h3>
							<div id="instagram-feed-hotel" class="clearfix"></div>
							<hr>
							<div class="room_type first">
								<div class="row">
									<div class="col-md-4">
										<img src="{{ $attraction->getThumbnailUrlAttribute() }}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<h4>Single Room</h4>
										<p>Sit an meis aliquam, cetero inermis vel ut. An sit illum euismod facilisis, tamquam vulputate pertinacia eum at.</p>
										<ul class="hotel_facilities">
											<li><img src="img/hotel_facilites_icon_2.svg" alt="">Single Bed</li>
											<li><img src="img/hotel_facilites_icon_4.svg" alt="">Free Wifi</li>
											<li><img src="img/hotel_facilites_icon_5.svg" alt="">Shower</li>
											<li><img src="img/hotel_facilites_icon_7.svg" alt="">Air Condition</li>
											<li><img src="img/hotel_facilites_icon_8.svg" alt="">Hairdryer</li>
										</ul>
									</div>
                                    <address><b>Địa chỉ:</b> {{ $attraction->getFullAddressAttribute() }}</address>
								</div>
								<!-- /row -->
							</div>
							<hr>
							<h3>Location</h3>
							<div id="map" class="map map_single add_bottom_30"></div>
							<!-- End Map -->
						</section>
					</div>
				</div>
			</div>
		</div>
	</main>
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
