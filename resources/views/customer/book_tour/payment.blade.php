@extends('layouts.user.app')

@section('content')
    <div class="hero_in cart_section">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">Giỏ</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">Đặt tour</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.create') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">Chờ xác nhận</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step active">
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
                        @if($orders->count() > 0)
                        {{------------ Tài khoản thanh thánh ------------}}
                        <div class="form_title">
                            <h3><strong>&#163;</strong>Thanh toán Online</h3>
                            <p>
                                Thông tin thanh toán Online
                            </p>
                        </div>
                        <div class="step">
                            <div class="form-group">
                                <label for="card_name">Tên thẻ</label>
                                <input type="text" class="form-control" id="card_name" name="card_name">
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label for="card_number">Số thẻ <span class="text-danger">*</span></label>
                                        <input type="text" id="card_number" name="card_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <img src="/img/cards_all.svg" alt="Cards" class="cards-payment">
                                </div>
                                <div class="col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
                                    <div class="form-group mt-1">
                                        <label for="update_payment">Đặt làm mặc định</label>
                                        <input type="checkbox" id="update_payment" name="update_payment" class="ml-1"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Thời điểm hết hạn <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" name="expire_month" id="expire_month" required>
                                                    <option value="" selected>MM</option>
                                                    @for($i = 1; $i <=12; $i++)
                                                        <option value="{{ $i }}">{{ $i < 10 ? '0'.$i : $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" max="99" id="expire_year"
                                                       name="expire_year" class="form-control"
                                                       placeholder="YY" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã bảo mật <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV" required>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <img src="/img/icon_ccv.gif" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End row -->
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail">
                        <div id="total_cart">
                            Tổng <span class="float-right">{{ number_format($total_price_all, 0, '', ',') }}đ</span>
                        </div>
                        <ul class="cart_details">
                            <li>Tour <span>{{ $orders->count() }}</span></li>
                            <li>Tổng số lượng <span>{{ $number_of_slots }}</span></li>
                        </ul>
                        @guest('customer')
                            <a href="#sign-in-dialog"  id="sign-in" title="Đăng nhập" class="btn_1 full-width purchase login">Đăng nhập</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                            </a>
                            <div class="text-center"><small>Vui lòng đăng nhập để tiếp tục đặt tour du lịch</small></div>
                        @endguest
                        @auth('customer')
                            @if($orders->count() > 0)
                            <a data-toggle="modal" id="purchaseBooking" data-target="#paymentModal"
                               class="btn_1 full-width purchase purchase-booking"
                               data-action="{{ route('book-tour.payment') }}">
                                Thanh toán
                            </a>
{{--                            <a href="#" class="btn_1 full-width purchase">Thanh toán</a>--}}
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                            </a>
                            <div class="text-center"><small>Yêu cầu nhập vào thông tin thanh toán để hoàn tất</small></div>
                            @endif
                        @endauth
                    </div>
                </aside>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
    @include('customer.book_tour.modals._payment_modal')
@endsection

@section('script')
    <script>
        $(document).on('click', '#purchaseBooking', function () {
            $('#form-payment').attr('action', $(this).attr('data-action'));
        });
    </script>
@endsection

