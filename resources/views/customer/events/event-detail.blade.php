@extends('layouts.user.app')

@section('content')
		<section class="hero_in hotels_detail">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>{{ $event->title }}</h1>
				</div>
				<span class="magnific-gallery">
                    <a href="{{ $event->AvatarUrl }}" class="btn_photos"  data-effect="mfp-zoom-in">Album ảnh</a>
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
							<p>{!! $event->description !!}</p>
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
										<img src="{{ $event->getAvatarUrlAttribute() }}" class="img-fluid" alt="">
									</div>
								</div>
								<!-- /row -->
							</div>
							<hr>
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
