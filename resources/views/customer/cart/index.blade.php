@extends('layouts.user.app')

@section('content')
    <div class="hero_in cart_section">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">@lang('message.cart')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">@lang('message.book_tour')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.create') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">@lang('message.confirm')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('book-tour.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">@lang('message.payment')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#0" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">@lang('message.finish')</div>
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
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <table class="table table-striped cart-list">
                            <thead>
                            <tr>
                                <th>
                                    Tour
                                </th>
                                <th>
                                    @lang('message.departure_day')
                                </th>
                                <th>
                                    @lang('message.price')
                                </th>
                                <th>
                                    @lang('message.guest')
                                </th>
                                <th>
                                    @lang('message.delete')
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
                                        <span class="item_cart" title="{{ $item->tour_name }}">
                                            {{ \Illuminate\Support\Str::limit($item->tour_name,20, '...') }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ date("d-m-Y", strtotime($item->date_of_book)) }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->price, 0, '', ',') }}đ</strong>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="text" name="tour_id" value="{{ $item->tour_id }}" hidden/>
                                            <input type="text" name="date_of_book" value="{{ $item->date_of_book }}" hidden/>
                                            <div class="cart-panel-dropdown">
                                                <a href="#"><span class="qtyTotal qty-{{ $item->id }}">{{ $item->number_of_slots }}</span></a>
                                                <div class="cart-panel-dropdown-content right">
                                                    <div class="qtyButtons">
                                                        <label for="adults">@lang('message.adult')</label>
                                                        <div class="qtyDec"></div>
                                                        <input type="text" name="adults" id="adults" value="{{ $item->adults }}">
                                                        <div class="qtyInc"></div>
                                                    </div>
                                                    <div class="qtyButtons">
                                                        <label for="childrens">@lang('message.child')</label>
                                                        <div class="qtyDec"></div>
                                                        <input type="text" name="childrens" id="childrens" value="{{ $item->childrens }}">
                                                        <div class="qtyInc"></div>
                                                    </div>
                                                    <div class="d-flex justify-content-center mb-1">
                                                        <input type="submit" value="Cập nhật" class="btn btn-danger"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="options" style="width:5%; text-align:center;">
                                        <a href="#" data-toggle="modal" id="removeCart"
                                           data-target="#removeCartModal" data-id="{{ $item->id }}">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <h2 class="text-center mt-4 font-weight-lighter">
                                            @lang('message.empty_cart')
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
                                        <input type="text" name="coupon-code" value="" placeholder="Your coupon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn_1 outline">@lang('message.apply_coupon')</button>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right fix_mobile">
                                <button type="button" class="btn_1 outline" data-toggle="modal" id="removeAllCart"
                                        data-target="#removeAllCartModal"> @lang('message.delete_all')</button>
                            </div>
                        </div>
                        <!-- /cart-options -->
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail">
                        <div id="total_cart">
                        @lang('message.total') <span class="float-right">{{ number_format($total_price_all, 0, '', ',') }}đ</span>
                        </div>
                        <ul class="cart_details">
                            <li>Tour <span>{{ $carts->count() }}</span></li>
                            <li>@lang('message.total_order') <span>{{ $number_of_slots }}</span></li>
                        </ul>
                        @guest('customer')
                            <a href="#sign-in-dialog"  id="sign-in" title="Đăng nhập" class="btn_1 full-width purchase login">Đăng nhập</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">@lang('message.back')</span>
                            </a>
                            <div class="text-center"><small>Vui lòng đăng nhập để tiếp tục đặt tour du lịch</small></div>
                        @endguest
                        @auth('customer')
                            <a href="{{ route('book-tour.create') }}" class="btn_1 full-width purchase">Checkout</a>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                                <span style="font-weight: 600; font-size: 0.875rem">@lang('message.back')</span>
                            </a>
                            <div class="text-center"><small>@lang('message.no_charge')</small></div>
                        @endauth
                    </div>
                </aside>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
    @include('customer.cart.modals._remove_cart_modal')
    @include('customer.cart.modals._remove_all_cart_modal')
@endsection

@section('script')
    <script>
        $(document).on('click', '#removeCart', function () {
            var id = $(this).data('id');
            var url = window.location.origin + '/cart/' + id;
            $('#form-remove-cart').attr('action', url);
        });

        $(document).on('click', '#removeAllCart', function () {
            var url = window.location.origin + '/cart/delete-all';
            $('#form-remove-all-cart').attr('action', url);
        });

        $(function() {
            $(".qtyDec, .qtyInc").on("click", function() {

                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                var oldTotal = $button.parent().parent().prev().find(".qtyTotal").text();

                console.log(oldValue);
                console.log($(this).parent().parent().prev().find(".qtyTotal").text());
                if ($button.hasClass('qtyInc')) {
                    var newVal = parseFloat(oldValue) + 1;
                    var newTotalVal = parseFloat(oldTotal) + 1;
                } else {
                    // don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                        var newTotalVal = parseFloat(oldTotal) - 1;
                    } else {
                        newVal = 0;
                        newTotalVal = 0;
                    }
                }

                $button.parent().find("input").val(newVal);
                $button.parent().parent().prev().find(".qtyTotal").text(newTotalVal);
                $button.parent().parent().prev().find(".qtyTotal").addClass("rotate-x");
            });

            function removeAnimation() { $(".qtyTotal").removeClass("rotate-x"); }
            const counter = document.querySelector(".qtyTotal");
            counter.addEventListener("animationend", removeAnimation);
        });
    </script>
@endsection

