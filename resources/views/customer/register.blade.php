@extends('layouts.user.app')

@section('content')

<body>
    <br />
    <br />
    <br />
    <br />
    <div class="container" style="background-color: #fc5b62;">
        <div class="bg_color_1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('customer.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box_cart">
                                <div class="message">
                                    <h1>Đăng ký tài khoản</h1>
                                    <p>Bạn đã có tài khoản? <a href="#0">Đăng nhập</a></p>
                                </div>
                                <div class="form_title">
                                    <h3><strong>1</strong>Thông tin cá nhân</h3>
                                    <p>
                                        Họ tên, địa chỉ, email, số điện thoại
                                    </p>
                                </div>
                                <div class="step">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" id="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" id="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="text" id="phone" name="phone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Confirm password</label>
                                                <input type="password" id="comfirm_password" name="comfirm_password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!--End step -->

                                <div class="form_title">
                                    <h3><strong>2</strong>Thanh toán Online</h3>
                                    <p>
                                        Thông tin thanh toán Online
                                    </p>
                                </div>
                                <div class="step">
                                    <div class="form-group">
                                        <label>Tên thẻ</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Số thẻ</label>
                                                <input type="text" id="card_number" name="card_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <img src="/img/cards_all.svg" alt="Cards" class="cards-payment">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Thời điểm hết hạn</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="MM">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="YY">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mã bảo mật</label>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
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
                                <hr>
                                <!--End step -->

                                <div class="form_title">
                                    <h3><strong>3</strong>Địa chỉ</h3>
                                    <p>
                                        Địa chỉ liên hệ trực tiếp
                                    </p>
                                </div>
                                <div class="box_general padding_bottom">
                                    <div class="header_box version_2">
                                    </div>
                                    <div class="box_general padding_bottom">
                                        <div class="header_box version_2">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country-attraction">Chọn quốc gia <span class="text-danger">*</span></label>
                                                    <div class="styled-select">
                                                        <select name="country_id" id="country-attraction">
                                                            <option value="1" selected>Viet Nam</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="province-attraction">Chọn Tỉnh/Thành <span class="text-danger">*</span></label>
                                                    <div class="styled-select">
                                                        <select name="province_id" id="province-attraction" required>
                                                            <option selected disabled>---- Chọn tỉnh/thành ----</option>
                                                            @foreach($provinces as $item)
                                                            <option @if(old('province_id')==$item->id)
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
                                        </div>
                                        <!-- /row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="district-attraction">Chọn Xã/Phường <span class="text-danger">*</span></label>
                                                    <div class="styled-select">
                                                        <select name="district_id" id="district-attraction" required>
                                                            <option selected disabled>Chọn quận,huyện</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="zipcode-attraction">Zip Code</label>
                                                    <input type="text" class="form-control" name="zipcode" id="zipcode-attraction" value="{{ old('zipcode') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="payment_id" id="payment_id" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /row-->
                                        <!-- /row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="address-attraction">Địa chỉ chi tiết</label>
                                                    <input type="text" class="form-control" name="address" id="address-attraction" placeholder="An Khánh, Hoài Đức, Hà Nội..." value="{{ old('address') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /row-->
                                    </div>
                                    <!-- /row-->
                                </div>
                                <div class="d-flex justify-content-center m-2">
                                    <button type="submit" class="btn btn-danger" value="Tạo tài khoản">Tạo tài khoản</button>
                                </div>
                                <hr>
                                <!--End step -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
    </div>
</body>
<script>
     $('#province-attraction').change(function () {
          var url = new URL('{{ route('api.districts.index') }}');
          var params = { province:$(this).val() };
          Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
          fetch(url)
            .then(response => response.json())
            .then(result => {
                $('#district-attraction').children().remove().end();
                result.data.forEach(function (data) {
                    $("#district-attraction").append('<option value="' + data.id + '">'+ data.name + '</option>');
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
@endsection
