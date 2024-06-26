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
                        <a href="{{ route('book-tour.order-pending') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">Thanh toán</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.order-payment') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step active">
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
                                <th>
                                    Xóa
                                </th>
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
                                                    @elseif($item->status == \App\Enums\BookingStatus::PAID)
                                                        text-info
                                                    @elseif($item->status == \App\Enums\BookingStatus::FINISHED)
                                                        text-success
                                                    @elseif($item->status == \App\Enums\BookingStatus::CANCELED)
                                                        text-danger
                                                    @endif">
                                            {{ $item->status_name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->status == \App\Enums\BookingStatus::CANCELED || $item->status == \App\Enums\BookingStatus::FINISHED || $item->status == \App\Enums\BookingStatus::PENDING)
                                        <a href="#" data-toggle="modal" id="removeBooking"
                                           data-target="#removeBookingModal"
                                           data-action="{{ route('book-tour.destroy', $item->id) }}"
                                           data-id="{{ $item->id }}">
                                            <i class="icon-trash"></i>
                                        </a>
                                        @endif
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
                    </div>
                </div>
                <!-- /col -->
                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail">
                        <div id="total_cart">
                            Tổng <span class="float-right">{{ number_format($total_price_all, 0, '', ',') }}đ</span>
                        </div>
                        <ul class="cart_details">
                            <li>Tổng người tham quan <span>{{ $number_of_slots }}</span></li>
                            <li>Tour đã đặt<span>{{ $orders->where('status', '>=', 1)->where('status', '<>', 4)->count() }}</span></li>
                            <li>Tour đã hủy <span>{{ $orders->where('status', 4)->count() }}</span></li>
                        </ul>
                        @guest('customer')
                            <a href="#sign-in-dialog"  id="sign-in" title="Đăng nhập" class="btn_1 full-width purchase login">Đăng nhập</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                            </a>
                            <div class="text-center"><small>Vui lòng đăng nhập để tiếp tục đặt tour du lịch</small></div>
                        @endguest
                        @auth('customer')
                            <a href="#" class="btn_1 full-width chat">Nhắn tin</a>
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

