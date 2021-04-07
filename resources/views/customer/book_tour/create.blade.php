@extends('layouts.user.app')

@section('style')

@endsection

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

                    <div class="bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">Đặt Tour</div>
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
                        <div class="message">
                            <p>Bạn muốn thanh toán sau khi nhận được hàng? <a href="#0">Click here</a></p>
                        </div>
                        {{------------ Giỏ ------------}}
                        <div class="form_title mb-4">
                            <h3><strong>1</strong>Kiểm tra lại các Tour bạn muốn đặt</h3>
                            <p>
                                Danh sách các Tour có trong giỏ
                            </p>
                        </div>
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
                                        <input type="number" name="quantity" min="0" value="{{ $item->quantity ?? 0 }}" style="width: 70px" readonly/>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->total_price, 0, '', ',') }} VND</strong>
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
                        <hr>
                        @if($carts->count() > 0)
                        {{------------ Thông tin tài khoản khách ------------}}
                        <div class="form_title">
                            <h3><strong>2</strong>Thông tin cá nhân</h3>
                            <p>
                                Họ tên, địa chỉ, email, số điện thoại
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
                                            <label for="name">Họ và Tên <span class="text-danger">*</span></label>
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
                                            <label for="address">Địa chỉ thường trú</label>
                                            <input type="text" id="address" name="address" value="{{ auth('customer')->user()->address }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Điện thoại <span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   value="{{ auth('customer')->user()->phone }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="country">Quốc gia</label>
                                            <select name="country_id" class="form-control" id="country">
                                                <option value="1" selected>Việt Nam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="province">Tỉnh/Thành phố <span class="text-danger">*</span></label>
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
                                            <label for="district">Quận/Huyện <span class="text-danger">*</span></label>
                                            <select name="district_id" id="district" class="form-control" required>
                                                <option selected disabled>Chọn Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Mã bưu điện <span class="text-danger">*</span></label>
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
                            Tổng <span class="float-right">{{ number_format($total_price_all, 0, '', ',') }} VND</span>
                        </div>
                        <ul class="cart_details">
                            <li>Từ ngày <span>{{ date('d-m-Y', strtotime($start_time_min)) }}</span></li>
                            <li>Tới ngày <span>{{ date('d-m-Y', strtotime($end_time_max)) }}</span></li>
                            <li>Tổng số lượng <span>{{ $total_quantity }}</span></li>
                        </ul>
                        @if($carts->count() > 0)
                        <button type="button" class="btn_1 full-width purchase" data-toggle="modal" data-target="#orderModalCenter">
                            Đặt tour
                        </button>
                        @endif
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">
                            <span style="font-weight: 600; font-size: 0.875rem">Quay lại</span>
                        </a>
                        <div class="text-center"><small>Không bị tính phí trong bước này</small></div>
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
                    window.location.href = window.location.origin + '/book-tour';
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

