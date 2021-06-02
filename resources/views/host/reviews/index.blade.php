@extends('layouts.host.app')

@section('style')
<link rel="stylesheet" href="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Các đánh giá</li>
    </ol>
    <div class="box_general">
    {!! Form::open(['route' => 'host.reviews.index', 'method' => 'GET']) !!}
    <div class="header_box">
        <h2 class="d-inline-block">Danh sách đánh giá</h2>
        <div class="filter">
            {!! Form::select('tour_name', $tourNames, $filters['tour_name'] ?? NULL, ['class' => 'selectbox', 'onchange' => 'this.form.submit()']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    <div class="list_general reviews">
        <ul>
            <li>
                @foreach($reviews as $review)
                <span>{{ date('d-m-Y H:i:s', strtotime($review->created_at)) }}</span>
                    <div class="rev-content">
                        <span class="rating">
                            @for($i = 1; $i <= round(($review->rate)/2); $i++)
                                <i class="fa fa-fw fa-star yellow"></i>
                            @endfor
                            @for($i = 1; $i <= 5-round(($review->rate)/2); $i++)
                                <i class="fa fa-fw fa-star"></i>
                            @endfor
                        </span>
                    </div>
                </span>

                <figure><img src="{{ $review->user ? $review->user->avatar_url : asset('img/anh-dai-dien.jpg') }}" alt=""></figure>
                <h4>{{ $review->customer_name }} <small>{{ !empty($review->user->name) ?  $review->user->name : ''}}</small></h4>
                <p>{{ $review->content }}</p>
				<p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Phản hồi</a></p>
                @endforeach
            </li>
        </ul>
        <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
    <!-- <div id="modal-reply" class="white-popup mfp-with-anim mfp-hide">
        <div class="small-dialog-header">
            <h3>Reply to review</h3>
        </div>
        <div class="message-reply margin-top-0">
            <div class="form-group">
                <textarea cols="40" rows="3" class="form-control"></textarea>
            </div>
            <button class="btn_1">Reply</button>
        </div>
    </div> -->
@endsection

@section('script')
<script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
<script src="{{ asset('js/front/moment.min.js') }}"></script>
<script src="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
@endsection
