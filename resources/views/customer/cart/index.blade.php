@extends('layouts.user.app')

@section('content')
    <div class="hero_in cart_section">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">Giỏ</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Đặt tour</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.create') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Chờ xác nhận</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Thanh toán</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#0" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Hoàn thành</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#0" class="bs-wizard-dot"></a>
                    </div>
                </div>
                <!-- End bs-wizard -->
            </div>
        </div>
    </div>
    <!--/hero_in-->

    <div class="bg_color_1">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">
                    <div class="box_cart">
                        <table class="table table-striped cart-list">
                            <thead>
                            <tr>
                                <th>
                                    Tour
                                </th>
                                <th>
                                    Giá
                                </th>
                                <th>
                                    Số lượng
                                </th>
                                <th>
                                    Tổng tiền
                                </th>
                                <th>
                                    Xóa
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($carts as $item)
                                <tr>
                                    <td>
                                        <div class="thumb_cart">
                                            <img src="{{ $item->thumbnail_url }}" alt="Image" style="height:  60px !important;">
                                        </div>
                                        <span class="item_cart">{{ $item->tour_name }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->price, 0, '', ',') }} VND</strong>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity" min="0" value="{{ $item->quantity ?? 0 }}" style="width: 70px"/>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->total_price, 0, '', ',') }} VND</strong>
                                    </td>
                                    <td class="options" style="width:5%; text-align:center;">
                                        <a href="#"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <h2 class="text-center mt-4 font-weight-lighter">
                                            Giỏ trống
                                        </h2>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="cart-options clearfix">
                            <div class="float-left">
                                <div class="apply-coupon">
                                    <div class="form-group">
                                        <input type="text" name="coupon-code" value="" placeholder="Mã ưu đãi của bạn" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn_1 outline">Áp dụng mã</button>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right fix_mobile">
                                <a href="{{ url()->previous() }}" class="btn_1 outline">Quay lại</a>
                                <button type="button" class="btn_1 outline">Cập nhật</button>
                            </div>
                        </div>
                        <!-- /cart-options -->
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail">
                        <div id="total_cart">
                            Tổng <span class="float-right">{{ number_format($total_price_all, 0, '', ',') }} VND</span>
                        </div>
                        <ul class="cart_details">
                            <li>Từ ngày <span>{{ date('d-m-Y', strtotime($start_time_min)) }}</span></li>
                            <li>Tới ngày <span>{{ date('d-m-Y', strtotime($end_time_max)) }}</span></li>
                            <li>Tổng số lượng <span>{{ $total_quantity }}</span></li>
                        </ul>
                        @guest('customer')
                            <a href="#sign-in-dialog"  id="sign-in" title="Đăng nhập" class="btn_1 full-width purchase login">Đăng nhập</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                            </a>
                            <div class="text-center"><small>Vui lòng đăng nhập để tiếp tục đặt tour du lịch</small></div>
                        @endguest
                        @auth('customer')
                            <a href="{{ route('book-tour.create') }}" class="btn_1 full-width purchase">Checkout</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                            </a>
                            <div class="text-center"><small>Không bị tính phí trong bước này</small></div>
                        @endauth
                    </div>
                </aside>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
@endsection

@section('script')

@endsection

