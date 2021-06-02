<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Magic-trip - Premium site template for travel agencies, hotels and restaurant listing.">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
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
                    <form action="{{ route('customer.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box_cart">
                            <div class="message">
                                <h1>@lang('message.register')</h1>
                                <p>@lang('message.have_acc') <a href="#0">@lang('message.login')</a></p>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="form_title">
                                <h3><strong>1</strong>@lang('message.per_inf')</h3>
                                <p>
                                @lang('message.list_per_inf')
                                </p>
                            </div>
                            <div class="step">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="avatar-upload">
                                        <label for="avatar" class="w-100" style="border: 5px solid #fff; border-radius: 50%; box-shadow: 0 0 5px #646464c7; cursor: pointer">
                                            <img src="{{ asset('img/anh-dai-dien.jpg') }}" width="140px" height="140px" class="rounded-circle" id="avatar-image" />
                                        </label>
                                        <input type="file" class="form-control-file mb-2" id="avatar"
                                               placeholder="Ảnh đại diện" name="avatar" hidden/>
                                    </div>
                                    <h6 class="mt-2 mb-2">@lang('message.avatar')</h6>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">@lang('message.fullname')<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="passwordInput">@lang('message.password') <span class="text-danger">*</span></label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control" name="password" id="passwordInput"
                                                       value="{{ old('password') }}" placeholder="Mật khẩu" required />
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <a href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">@lang('message.phone') <span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">@lang('message.confirm_pass')</label>
                                            <div class="input-group" id="show_hide_confirm_password">
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password') }}" placeholder="Nhập lại mật khẩu" required />
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <a href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--End step -->
                            <div class="form_title">
                                <h3><strong>2</strong>@lang('message.address')</h3>
                                <p>
                                    Địa chỉ liên hệ trực tiếp
                                </p>
                            </div>
                            <div class="step">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ thường trú</label>
                                            <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control">
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
                                                    <option @if(old('province_id') == $item->id)
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
                                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
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
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        } else if($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });

    $("#show_hide_confirm_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_confirm_password input').attr("type") == "text") {
            $('#show_hide_confirm_password input').attr('type', 'password');
            $('#show_hide_confirm_password i').addClass( "fa-eye-slash" );
            $('#show_hide_confirm_password i').removeClass( "fa-eye" );
        } else if($('#show_hide_confirm_password input').attr("type") == "password") {
            $('#show_hide_confirm_password input').attr('type', 'text');
            $('#show_hide_confirm_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_confirm_password i').addClass( "fa-eye" );
        }
    });

    $('#avatar').change(function (e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar-image')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            }

            reader.readAsDataURL(e.currentTarget.files[0]);
        }
    });

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

    $(function () {
        var district = {{ old('district_id') ?? "1" }};
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
</body>

