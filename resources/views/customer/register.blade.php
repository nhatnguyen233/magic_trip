<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Panagea - Premium site template for travel agencies, hotels and restaurant listing.">
    <meta name="author" content="Ansonika">
    <title>Panagea | Đại lý du lịch, khách sạn và danh sách nhà hàng.</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{ asset('img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{ asset('img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/vendors.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('css/front/custom.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div class="container">
        <div class="bg_color_1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="POST" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" id="firstname_booking" name="firstname_booking">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" class="form-control" id="lastname_booking" name="lastname_booking">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" id="email_booking" name="email_booking" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Confirm email</label>
                                                <input type="email" id="email_booking_2" name="email_booking_2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="text" id="telephone_booking" name="telephone_booking" class="form-control">
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
                                        <input type="text" class="form-control" id="name_card_bookign" name="name_card_bookign">
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
                                <div class="step">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="country">Quốc gia</label>
                                                <select name="country" class="form-control" id="country">
                                                    <option value="" selected>Chọn quốc gia</option>
                                                    <option value="Europe">Europe</option>
                                                    <option value="United states">United states</option>
                                                    <option value="South America">South America</option>
                                                    <option value="Oceania">Oceania</option>
                                                    <option value="Asia">Asia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Street line 1</label>
                                                <input type="text" id="street_1" name="street_1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Street line 2</label>
                                                <input type="text" id="street_2" name="street_2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" id="city_booking" name="city_booking" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" id="state_booking" name="state_booking" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Postal code</label>
                                                <input type="text" id="postal_code" name="postal_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--End row -->
                                </div>
                                <div class="d-flex justify-content-center m-2">
                                    <input type="submit" class="btn btn-danger" value="Tạo tài khoản">
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

