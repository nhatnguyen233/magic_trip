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

                    <div class="bs-wizard-step activ">
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
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <table class="table table-striped cart-list">
                            <thead>
                            <tr>
                                <th>
                                    Tour
                                </th>
                                <th>
                                    Ngày khởi hành
                                </th>
                                <th>
                                    Số lượng
                                </th>
                                <th>
                                    Tổng tiền
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                @if($orders->where('status', \App\Enums\BookingStatus::CANCELED)->count() > 0)
                                    <th>
                                        Xóa
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $item)
                                <tr>
                                    <td>
                                        <div class="thumb_cart">
                                            <img src="{{ $item->tour->thumbnail_url }}" alt="Image" style="height:  60px !important;">
                                        </div>
                                        <span class="item_cart">{{ $item->tour->tour_name }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ date("d-m-Y", strtotime($item->date_of_book)) }}</strong>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity" min="0" value="{{ $item->number_of_slots ?? 0 }}" style="width: 70px"/>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->total_price, 0, '', ',') }}đ</strong>
                                    </td>
                                    <td>
                                        <span class="@if($item->status == \App\Enums\BookingStatus::PENDING)
                                                        text-danger
                                                    @elseif($item->status == \App\Enums\BookingStatus::APPROVED)
                                                        text-primary
                                                    @elseif($item->status == \App\Enums\BookingStatus::CANCELED)
                                                        text-danger
                                                    @endif">
                                            {{ $item->status_name }}
                                        </span>
                                    </td>
                                    @if($orders->where('status', \App\Enums\BookingStatus::CANCELED)->count() > 0)
                                        <td>
                                            @if($item->status == \App\Enums\BookingStatus::CANCELED || $item->status == \App\Enums\BookingStatus::FINISHED)
                                                <a href="#" data-toggle="modal" id="removeBooking"
                                                   data-target="#removeBookingModal"
                                                   data-action="{{ route('book-tour.destroy', $item->id) }}"
                                                   data-id="{{ $item->id }}">
                                                    <i class="icon-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <h2 class="text-center mt-4 font-weight-lighter">
                                            Không có đơn nào cần xác nhận
                                        </h2>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail">
                        <div id="total_cart">
                            Tổng <span class="float-right">{{ number_format($total_price_all, 0, '', ',') }}đ</span>
                        </div>
                        <ul class="cart_details">
                            <li>Tour <span>{{ $orders->where('status', '<>', 4)->count() }}</span></li>
                            <li>Tổng người tham quan <span>{{ $number_of_slots }}</span></li>
                        </ul>
                        @guest('customer')
                            <a href="#sign-in-dialog"  id="sign-in" title="Đăng nhập" class="btn_1 full-width purchase login">Đăng nhập</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                            </a>
                            <div class="text-center"><small>Vui lòng đăng nhập để tiếp tục đặt tour du lịch</small></div>
                        @endguest
                        @auth('customer')
                            @if(($orders->where('status', 1)->count() > 0 || $orders->where('status', '<>', 4)->count()) && $orders->where('status', 0)->count() == 0)
                                <a href="{{ route('book-tour.order-payment') }}" class="btn_1 full-width purchase">Thanh toán</a>
                            @endif
                            <a href="#" class="btn_1 full-width chat">Nhắn tin</a>
                            <div class="text-center">
                                @if($orders->where('status', '>', 1)->count() == $orders->count())
                                    <small>Các Tour du lịch bạn đặt đã hoàn tất thanh toán</small>
                                @else
                                    <small>Vui lòng chờ chúng tôi xác nhận lại thông tin để tiến hành bước tiếp theo</small>
                                @endif
                            </div>
                        @endauth
                    </div>
                </aside>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
    @include('customer.book_tour.modals._remove_booking_modal')
@endsection

@section('script')
    <script>
        $(document).on('click', '#removeBooking', function () {
            $('#form-remove-booking').attr('action', $(this).attr('data-action'));
        });
    </script>
@endsection

