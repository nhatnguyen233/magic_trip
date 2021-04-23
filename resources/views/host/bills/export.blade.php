<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-3">Hóa đơn thống kê</h2>
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-outline-dark" href="{{ url()->previous() }}">Quay lại</a>
        <a class="btn btn-primary" href="{{ route('host.bills.export.pdf', ['username'=>request()->get('username') ?? '', 'created_at' => request()->get('created_at') ?? '']) }}">Export to PDF</a>
    </div>
    <table class="table table-bordered mb-3">
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
    <div class="d-flex justify-content-center">
        <h4>Tổng tiền: {{ number_format(array_sum($bills->pluck('total_price')->toArray()), 0, '', ',') }} VNĐ</h4>
    </div>
</div>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
