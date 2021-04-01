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
@include('customer.login')

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
    $('input[name="dates"]').daterangepicker({
      autoUpdateInput: false,
      minDate: new Date(),
      locale: {
        cancelLabel: 'Clear'
      }
    });
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
      $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
    });
    $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
      $(this).val('');
    });
  });
</script>

<!-- INPUT QUANTITY  -->
<script src="{{ asset('js/front/input_qty.js') }}"></script>

</body>
</html>
