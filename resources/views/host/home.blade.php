@extends('layouts.host.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Bảng điều phối</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-envelope-open"></i>
                    </div>
                    <div class="mr-5"><h5>0 Tin nhắn!</h5></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="messages.html">
                    <span class="float-left">Chi tiết</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-star"></i>
                    </div>
                    <div class="mr-5"><h5>{{ $reviews->count() }} Đánh Giá!</h5></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="reviews.html">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-calendar-check-o"></i>
                    </div>
                    <div class="mr-5"><h5>{{ $bookings->count() }} Lượt Đặt Mới!</h5></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="bookings.html">
                    <span class="float-left">Chi tiết</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="mr-5"><h5>{{ $tours->count() }} Tour Mới!</h5></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="bookmarks.html">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
    </div>
    <!-- /cards -->
    <h2></h2>
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-bar-chart"></i>Thống kê</h2>
        </div>
        <canvas id="myAreaChart" width="100%" height="30" style="margin:45px 0 15px 0;"></canvas>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-charts.js') }}"></script>
@endsection
