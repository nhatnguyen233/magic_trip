<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Magic - Premium site template for travel agencies, hotels and restaurant listing.">
    <meta name="author" content="Ansonika">
    <title>MAGIC TRIP | Đại lý du lịch, khách sạn và danh sách nhà hàng.</title>

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

<body class="datepicker_mobile_full"><!-- Remove this class to disable datepicker full on mobile -->

<div id="page">

    @include('layouts.user.header')

    <main>
        @yield('content')
    </main>
    <!-- /main -->

    @include('layouts.user.footer')
</div>
<!-- page -->

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Đăng nhập</h3>
    </div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="sign-in-wrapper">
            <a href="{{ route('login.social', ['provider' => 'facebook']) }}" class="social_bt facebook">Đăng nhập với Facebook</a>
            <a href="{{ route('login.social', ['provider' => 'google']) }}" class="social_bt google">Đăng nhập với Google</a>
            <div class="divider"><span>Hoặc</span></div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                    <label class="container_check">Nhớ phiên đăng nhập
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Quên mật khẩu?</a></div>
            </div>
            <div class="text-center"><input type="submit" value="Đăng nhập" class="btn_1 full-width"></div>
            <div class="text-center">
                Bạn đã có tài khoản? <a href="{{ route('customer.register.form') }}">Đăng ký</a>
            </div>
            <div id="forgot_pw">
                <div class="form-group">
                    <label>Vui lòng xác nhận Email đăng nhập bên dưới</label>
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                    <i class="icon_mail_alt"></i>
                </div>
                <p>Bạn sẽ nhận được một email có chứa một liên kết cho phép bạn đặt lại mật khẩu của mình.</p>
                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
            </div>
        </div>
    </form>
    <!--form -->
</div>
<!-- /Sign In Popup -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="LogoutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LogoutModalLabel">Bạn đã sẵn sàng đăng xuất?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Chọn "Đăng xuất" nếu bạn đã sẵn sàng kết thúc phiên đăng nhập của mình.</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                <button class="btn btn-danger" type="submit">Đăng xuất</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="{{ asset('js/front/common_scripts.js') }}"></script>
<script src="{{ asset('js/front/main.js') }}"></script>
<script src="{{ asset('js/front/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/front/daterangepicker.js') }}"></script>
<script src="{{ asset('js/front/validate.js') }}"></script>
@yield('script')
<!-- DATEPICKER  -->
<script>
  $(function () {
    'use strict';
    @if(session()->has('error'))
        alert('Đăng nhập không thành công!');
    @endif
  });
</script>

<!-- INPUT QUANTITY  -->
<script src="{{ asset('js/front/input_qty.js') }}"></script>

</body>
</html>
