<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HOST LOGIN</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/login.css') }}" rel="stylesheet"/>
    <style>
        .content-form-login {
            border: 1px dotted white;
            background-color: white;
        }
        .custom-button {
            background-color: blue;
            border-radius: 10px;
        }

        .text-color {
            color: blue;
        }
        .text-color-red{
            color:red;
        }
    </style>
</head>
<body>
<div class="row px-3 justify-content-center mt-4 mb-5 border-line"></div>
<div style="margin: 0 auto;" class="col-lg-4 content-form-login ml-10">
    <div style="margin: 0 auto; width:250px; margin-top: 50px" class="justify-content-center"><img src="{{ asset('img/logo_sticky.svg') }}"></div>
    <form action="{{ route('host.login') }}" method="POST">
        @csrf
            <div class="row px-3 justify-content-center mt-4 mb-5 border-line"></div>
            <div class="row px-3">
                <input class="mb-4" type="text" name="email" placeholder="Email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="row px-3">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group mt-3">
                <div class="row">
                    <div class="col-md-12 d-flex align-items-center flex-column">
                        <button type="submit" class="btn btn-blue text-center custom-button">Đăng nhập</button>
                        <p>
                            <small>
                                Bạn chưa có tài khoản?
                                <a class="text-color-red" href="{{ route('host.register.form') }}">Đăng ký</a>
                            </small>
                        </p>
                        <a href="#" class="font-weight-bold text-color mt-0">Quên mật khẩu?</a>
                    </div>
                </div>
            </div>
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
