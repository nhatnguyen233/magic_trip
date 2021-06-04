@extends('layouts.user.app')

@section('style')

@endsection

@section('content')
    <div class="hero_in cart_section">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">@lang('message.cart')</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step active">
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
                        <div class="message">
                            <p>@lang('message.pay_confirm') <a href="#0">Click here</a></p>
                        </div>
                        {{------------ Giỏ ------------}}
                        <div class="form_title mb-4">
                            <h3><strong>1</strong>@lang('message.check_tour')</h3>
                            <p>
                            @lang('message.list_tour')
                            </p>
                        </div>
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
                                @lang('message.total_price')
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
                                        <strong>{{ date("d-m-Y", strtotime($item->date_of_book)) }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->price, 0, '', ',') }}đ</strong>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity" min="0" value="{{ $item->number_of_slots ?? 0 }}" style="width: 70px" readonly/>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->total_price, 0, '', ',') }}đ</strong>
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
                        <hr>
                        @if($carts->count() > 0)
                        {{------------ Thông tin tài khoản khách ------------}}
                        <div class="form_title">
                            <h3><strong>2</strong>@lang('message.per_inf')</h3>
                            <p>
                            @lang('message.list_per_inf')
                            </p>
                        </div>
                        <form action="{{ route('user.update-profile', auth('customer')->id()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="step">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">@lang('message.fullname') <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ auth('customer')->user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" value="{{ auth('customer')->user()->email }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address">@lang('message.address')</label>
                                            <input type="text" id="address" name="address" value="{{ auth('customer')->user()->address }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">@lang('message.phone') <span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   value="{{ auth('customer')->user()->phone }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="country">@lang('message.country')</label>
                                            <select name="country_id" class="form-control" id="country">
                                                <option value="1" selected>Việt Nam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="province">@lang('message.city') <span class="text-danger">*</span></label>
                                            <select name="province_id" id="province" class="form-control" required>
                                                <option selected disabled>Chọn Tỉnh/Thành phố</option>
                                                @foreach($provinces as $item)
                                                    <option @if(auth('customer')->user()->province_id == $item->id)
                                                            selected
                                                            @endif
                                                            value={{ $item->id }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="district">@lang('message.district') <span class="text-danger">*</span></label>
                                            <select name="district_id" id="district" class="form-control" required>
                                                <option selected disabled>Chọn Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('message.zip_code') <span class="text-danger">*</span></label>
                                            <input type="text" id="postal_code" name="postal_code" value="{{ auth('customer')->user()->postal_code }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center m-2">
                                <input type="submit" class="btn btn-danger" value="Cập nhật tài khoản">
                            </div>
                        </form>
                        @endif
                        <hr>
                        <!--End step -->
                        <div id="policy">
                            <h5>Chính sách hủy</h5>
                            <p class="nomargin">Lorem ipsum dolor sit amet, vix <a href="#0">cu justo blandit deleniti</a>, discere omittantur consectetuer per eu. Percipit repudiare similique ad sed, vix ad decore nullam ornatus.</p>
                        </div>
                        <!--End step -->
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
                        @if($carts->count() > 0)
                        <button type="button" class="btn_1 full-width purchase" data-toggle="modal" data-target="#orderModalCenter">
                        @lang('message.book_tour')
                        </button>
                        @endif
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                            <span style="font-weight: 600; font-size: 0.875rem">@lang('message.back')</span>
                        </a>
                        <div class="text-center"><small>@lang('message.no_charge')</small></div>
                    </div>
                </aside>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
    @include('customer.book_tour.modals._payment_order_modal')
@endsection

@section('script')
    <script>
        $('#province').change(function () {
            var url = new URL('{{ route('api.districts.index') }}');
            var params = { province:$(this).val() };
            Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    $('#district').children().remove().end();
                    result.data.forEach(function (data) {
                        $("#district").append('<option value="' + data.id + '">'+ data.name + '</option>');
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        $('#order-tour').click(function () {
            var url = window.location.origin + '/book-tour';
            const formData = new FormData();
            formData.append('_token', '{!! csrf_token() !!}');
            formData.append('type', '0');
            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    alert('Đặt Tour thành công');
                    window.location.href = window.location.origin + '/book-tour/order-pending';
                })
                .catch(error => {
                    console.error(error);
                    alert('Đặt Tour thất bại');
                });
        });

        $(function () {
            var district = {{ auth('customer')->user()->district_id ?? "1" }};
            var url = new URL('{{ route('api.districts.index') }}');
            var params = { province:$('#province').val() };
            Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    $('#district').children().remove().end();
                    result.data.forEach(function (data) {
                        if(district == parseInt(data.id)) {
                            $("#district").append('<option value="' + district + '" selected>'+ data.name + '</option>');
                        } else {
                            $("#district").append('<option value="' + data.id + '">'+ data.name + '</option>');
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection

