@extends('layouts.user.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
    <section class="hero_in tours_detail">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{ $tour->name }}</h1>
            </div>
            <span class="magnific-gallery">
                <a href="{{ asset('img/gallery/tour_list_1.jpg') }}" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">View photos</a>
                <a href="{{ asset('img/gallery/tour_list_2.jpg') }}" title="Photo title" data-effect="mfp-zoom-in"></a>
                <a href="{{ asset('img/gallery/tour_list_3.jpg') }}" title="Photo title" data-effect="mfp-zoom-in"></a>
            </span>
        </div>
    </section>
    <!--/hero_in-->

    <div class="bg_color_1">
        <nav class="secondary_nav sticky_horizontal">
            <div class="container">
                <ul class="clearfix">
                    <li><a href="#description" class="active">Mô tả</a></li>
                    <li><a href="#reviews">Đánh giá</a></li>
                    <li><a href="#sidebar">Đặt Tour</a></li>
                </ul>
            </div>
        </nav>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">
                    <section id="description">
                        <h2>Mô tả</h2>
                        <div class="tour-description">
                            {!! $tour->description !!}
                        </div>
                        <br/>
                        <h3>Instagram photos feed</h3>
                        <div id="instagram-feed" class="clearfix"></div>
                        <hr>

                        <h3>Chương trình <small>(60 minutes)</small></h3>
                        <p>
                            Iudico omnesque vis at, ius an laboramus adversarium. An eirmod doctus admodum est, vero numquam et mel, an duo modo error. No affert timeam mea, legimus ceteros his in. Aperiri honestatis sit at. Eos aeque fuisset ei, case denique eam ne. Augue invidunt has ad, ullum debitis mea ei, ne aliquip dignissim nec.
                        </p>
                        <ul class="cbp_tmtimeline">
                            @foreach($tour->infos as $item)
                                <li>
                                    <time class="cbp_tmtime" datetime="09:30"><span>{{ $item->limit_time }} min.</span><span>{{ $item->start_time }}</span>
                                    </time>
                                    <div class="cbp_tmicon">
                                        {{ $item->order_number }}
                                    </div>
                                    <div class="cbp_tmlabel">
                                        <div class="hidden-xs">
                                            <img src="{{ $item->thumbnail_url }}" alt="" class="rounded-circle thumb_visit">
                                        </div>
                                        <h4>{{ $item->title }}</h4>
                                        <p>
                                            {{ $item->summary }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <p>Mea appareat omittantur eloquentiam ad, nam ei quas <strong>oportere democritum</strong>. Prima causae admodum id est, ei timeam inimicus sed. Sit an meis aliquam, cetero inermis vel ut. An sit illum euismod facilisis, tamquam vulputate pertinacia eum at.</p>
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
                        <h3>Vị trí</h3>
                        <div id="map" class="map map_single add_bottom_30"></div>
                        <!-- End Map -->
                    </section>
                    <!-- /section -->

                    <section id="reviews">
                        <h2>Đánh giá</h2>
                        <div class="reviews-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div id="review_summary">
                                        <strong>{{ $average }}</strong>
                                        @if($average >= 9)
                                            <em>Tuyệt vời</em>
                                        @elseif($average >= 8)
                                            <em>Tốt</em>
                                        @elseif($average >= 5)
                                            <em>Khá tốt</em>
                                        @else
                                            <em>Bình thường</em>
                                        @endif
                                        <small>Dựa trên {{ $reviews->count() }} nhận xét</small>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                </div>
                            </div>
                            <!-- /row -->
                        </div>

                        <hr>

                        <div class="reviews-container">
                            @foreach($reviews as $item)
                                <!-- /review-box -->
                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="{{ $item->user ? $item->user->avatar_url : asset('img/anh-dai-dien.jpg') }}" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                @for($i = 1; $i <= round(($item->rate)/2); $i++)
                                                    <i class="icon-star voted"></i>
                                                @endfor
                                                @for($i = 1; $i <= 5-round(($item->rate)/2); $i++)
                                                    <i class="icon-star"></i>
                                                @endfor
                                            </div>
                                            <div class="rev-info">
                                                {{ $item->user ? $item->user->name : $item->customer_name }} {{ date("d-m-Y", strtotime($item->created_at)) }}:
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    {{ $item->content }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /review-box -->
                            @endforeach
                        </div>
                        <!-- /review-container -->
                    </section>
                    <!-- /section -->
                    <hr>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="add-review">
                            <h5>Để lại đánh giá</h5>
                            <form action="{{ route('reviews.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    @guest('customer')
                                    <div class="form-group col-md-6">
                                        <label for="customer_name">Họ và tên <span class="text-danger">*</span></label>
                                        <input type="text" name="customer_name" id="customer_name"
                                               value="{{ old('customer_name') }}" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email_review">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email_review"
                                               value="{{ old('email') }}" class="form-control" required>
                                    </div>
                                    @endguest
                                    <div class="form-group col-md-6">
                                        <label for="rating_review">Rating <span class="text-danger">*</span></label>
                                        <div class="custom-select-form">
                                            <select name="rate" id="rating_review" class="wide">
                                                <option value="1">1 (Chất lượng kém)</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5" selected>5 (Bình thường)</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8 (Tốt)</option>
                                                <option value="9">9</option>
                                                <option value="10">10 (Tuyệt vời)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" hidden>
                                        <label>Tour <span class="text-danger">*</span></label>
                                        <input type="hidden" name="tour_id" id="tour_review" value="{{ $tour->first()->id }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="review_content">Đánh giá</label>
                                        <textarea name="content" id="review_content" class="form-control" style="height:130px;">
                                            {{ old('content') }}
                                        </textarea>
                                    </div>
                                    <div class="form-group col-md-12 add_top_20">
                                        <input type="submit" value="Đánh giá" class="btn_1" id="submit-review">
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail booking">
                        <div class="price">
                            <h4>{{ number_format($tour->price, 0, '', ',') }} VND <small>/ 1 người</small></h4>
                            <div class="score">

                                <span>  @if($average >= 9)
                                            Tuyệt vời
                                        @elseif($average >= 8)
                                            Tốt
                                        @elseif($average >= 5)
                                            Khá tốt
                                        @else
                                            Bình thường
                                        @endif
                                        <em>{{ $reviews->count() }} đánh giá</em>
                                </span>
                                <strong>{{ $average }}</strong>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" hidden>
                                <label for="tour_id">Tour</label>
                                <input type="text" name="tour_id" id="tour_id" value="{{ $tour->id }}"/>
                            </div>
                            <div class="form-group" hidden>
                                <label for="tour_name">Tên Tour</label>
                                <input type="text" name="tour_name" id="tour_name" value="{{ $tour->tour_name }}"/>
                            </div>
                            <div class="form-group" hidden>
                                <label for="tour_name">Tên Tour</label>
                                <input type="text" name="tour_name" id="tour_name" value="{{ $tour->name }}"/>
                            </div>
                            <div class="form-group" hidden>
                                <label for="price">Giá</label>
                                <input type="text" name="price" id="price" value="{{ $tour->price }}"/>
                            </div>
                            <div class="form-group" hidden>
                                <label for="discount">Giảm giá</label>
                                <input type="text" name="discount" id="discount" value="{{ $tour->discount }}"/>
                            </div>
                            <div class="form-group" hidden>
                                <label for="thumbnail">Ảnh thu nhỏ</label>
                                <input type="text" name="thumbnail" id="thumbnail" value="{{ $tour->thumbnail }}"/>
                            </div>
                            <div class="form-group input-dates">
                                <input class="form-control" type="text" name="dates" id="dates" placeholder="Thời điểm hoàn hảo">
                                <label for="dates"><i class="icon_calendar"></i></label>
                            </div>
                            <div class="form-group input-dates">
                                <input type="text" class="form-control datetimepicker-input" placeholder="Ngày khởi hành"
                                       id="date_of_book" data-toggle="datetimepicker" name="date_of_book"
                                       value="{{ request()->get('date_of_book') }}" required/>
                                <label for="date_of_book"><i class="icon_calendar"></i></label>
                            </div>
                            <div class="panel-dropdown">
                                <a href="#">Số lượng <span class="qtyTotal">1</span></a>
                                <div class="panel-dropdown-content right">
                                    <div class="qtyButtons">
                                        <label for="number_of_slots">Số lượng</label>
                                        <input type="text" name="number_of_slots" id="number_of_slots" value="1" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn_1 full-width purchase">Thêm vào giỏ</button>
                            <a href="wishlist.html" class="btn_1 full-width outline wishlist"><i class="icon_heart"></i> Tour yêu thích</a>
                            <div class="text-center"><small>Không bị tính phí trong bước này</small></div>
                        </form>
                    </div>
                    <ul class="share-buttons">
                        <li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
                        <li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Tweet</a></li>
                        <li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
                    </ul>
                </aside>
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
    <script src="{{ asset('js/front/map_single_tour.js') }}"></script>
    <script src="{{ asset('js/front/infobox.js') }}"></script>
    <script src="{{ asset('js/front/jquery.instagramFeed.min.js') }}"></script>
    <script src="{{ asset('js/front/moment.min.js') }}"></script>
    <script src="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
    <!-- INSTAGRAM FEED  -->
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

