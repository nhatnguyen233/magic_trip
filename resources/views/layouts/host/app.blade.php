<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Nhat Nguyen">
    <title>Host</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
          href="{{ asset('admin/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="{{ asset('admin/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{ asset('admin/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{ asset('admin/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{ asset('admin/css/admin.css') }}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Plugin styles -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Your custom styles -->
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body class="fixed-nav sticky-footer" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <!-- Header -->
@include('layouts.host.header')
<!-- /Header-->

    <!-- Sidebar -->
@include('layouts.host.sidebar')
<!-- /Sidebar-->
</nav>
<!-- /Navigation-->

<!-- Main Content -->
<div class="content-wrapper">
    <div class="container-fluid">
        @yield('content')
    </div>
    <!-- /.container-fluid-->
</div>
<!-- /Main Content -->

@include('layouts.host.footer')
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('host.logout') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn đã sẵn sàng đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" nếu bạn đã sẵn sàng kết thúc phiên đăng nhập của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                    <button class="btn btn-primary" type="submit">Đăng xuất</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugin JavaScript-->
<script src="{{ asset('admin/vendor/chart.js/Chart.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery.selectbox-0.2.js') }}"></script>
<script src="{{ asset('admin/vendor/retina-replace.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery.magnific-popup.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/admin.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<!-- Custom scripts for this page-->
@yield('script')
</body>
</html>
