@extends('layouts.host.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Lập hóa đơn</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Danh sách đơn đặt Tour đã hoàn tất
        </div>
        <div class="card-body">
            <form action="{{ route('host.bills.index') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="username">Tên khách</label>
                        <input type="text" name="username" id="username" class="form-control form-control-lg"/>
                    </div>
                    <div class="col-md-4">
                        <label for="created_at">Thời gian</label>
                        <input type="text" name="created_at" id="created_at" class="form-control form-control-lg"/>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary text-white" type="submit" style="margin-top: 28px;">Lọc kết quả</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>
                            <center>Thông tin khách</center>
                        </th>
                        <th>
                            <center>Tour</center>
                        </th>
                        <th>
                            <center>Số tiền</center>
                        </th>
                        <th>
                            <center>Ngày thanh toán</center>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bills as $item)
                        <tr>
                            <td>
                                <center>
                                    Tên khách: {{ $item->user->name }}, <br>
                                    Số điện thoại: {{ $item->user->phone }}, <br>
                                    Địa chỉ: {{ $item->user->address }}
                                </center>
                            </td>
                            <td><center>{{ $item->bookTour->tour->name }}</center></td>
                            <td><center>{{ number_format($item->total_price, 0, '', ',') }}(đ)</center></td>
                            <td><center>{{ date('d-m-Y', strtotime($item->created_at)) }}</center></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <center>Chưa có đơn đặt Tour nào đã hoàn tất</center>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <a type="button" href="{{ route('host.bills.export', ['username'=>request()->get('username') ?? '', 'created_at' => request()->get('created_at') ?? '']) }}"
                   class="btn btn-info text-white float-right export-bill">
                    <i class="fa fa-download"></i> Export to PDF
                </a>
            </div>
            @if($bills->count() > 10)
            <div class="d-flex justify-content-center" style="margin-top: -35px">
                <div>{{ $bills->links() }}</div>
            </div>
            @endif
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    <!-- /tables-->
@endsection

@section('script')
    <script src="{{ asset('js/front/moment.min.js') }}"></script>
    <script src="{{ asset('daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(function () {
            $('input[name="created_at"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="created_at"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' > ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('input[name="created_at"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        })
    </script>
@endsection
