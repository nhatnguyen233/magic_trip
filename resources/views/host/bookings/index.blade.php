@extends('layouts.host.app')

@section('style')

@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Đặt Tour</li>
    </ol>
    @if ($errors->any())
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
    <div class="box_general">
        {!! Form::open(['route' => 'host.bookings.index', 'method' => 'GET']) !!}
        <div class="header_box">
            <h2 class="d-inline-block">Thống kê đặt Tour</h2>
            <div class="filter">
                {!! Form::select('status', $book_status_names, $filters['status'] ?? NULL, ['class' => 'selectbox', 'onchange' => 'this.form.submit()']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <div class="list_general">
            <ul>
                @forelse($bookings as $item)
                <li>
                    <figure><img src="{{ $item->tour->thumbnail_url }}" alt=""></figure>
                    <h4>{{ $item->tour->name }}
                        <i class="@if($item->status == \App\Enums\BookingStatus::PENDING)
                                        pending
                                  @elseif($item->status == \App\Enums\BookingStatus::APPROVED)
                                        approved
                                  @elseif($item->status == \App\Enums\BookingStatus::PAID)
                                        paid
                                  @elseif($item->status == \App\Enums\BookingStatus::FINISHED)
                                        finished
                                  @elseif($item->status == \App\Enums\BookingStatus::CANCELED)
                                        cancel
                                  @endif
                                ">
                            {{ $item->status_name }}
                        </i>
                    </h4>
                    <ul class="booking_list">
                        <li><strong>Ngày bắt đầu</strong> {{ date('d-m-y', strtotime($item->date_of_book)) }}</li>
                        <li><strong>Số lượng</strong> {{ $item->number_of_slots }} người</li>
                        <li><strong>Khách đặt</strong> {{ $item->user->name }}</li>
                        <li><strong>Số điện thoại</strong> {{ $item->user->phone }}</li>
                    </ul>
                    <p><a href="#0" class="btn_1 gray"><i class="fa fa-fw fa-envelope"></i> Gửi tin nhắn</a></p>
                    <ul class="buttons">
                        @if($item->status == \App\Enums\BookingStatus::PENDING)
                        <li>
                            <a data-toggle="modal" id="approveBooking" data-target="#approveModal"
                               class="btn_1 gray approve approve-booking"
                               data-action="{{ route('host.bookings.approve', $item->id) }}"
                               data-number-of-slots="{{ $item->number_of_slots }}"
                               data-date-of-book="{{ $item->date_of_book }}"
                               data-tour-id="{{ $item->tour_id }}"
                               data-id="{{ $item->id }}">
                                <i class="fa fa-fw fa-check-circle-o"></i> Chấp thuận
                            </a>
                        </li>
                        <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Từ chối</a></li>
                        @elseif($item->status == \App\Enums\BookingStatus::APPROVED)
                        <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Hủy chấp thuận</a></li>
                        @elseif($item->status == \App\Enums\BookingStatus::PAID)
                        <li>
                            <a data-toggle="modal" id="finishedConfirm" data-target="#finishedConfirmModal"
                               class="btn_1 gray approve finished-confirm"
                               data-action="{{ route('host.bookings.finished', $item->id) }}"
                               data-id="{{ $item->id }}">
                                <i class="fa fa-fw fa-check-circle-o"></i> Hoàn thành
                            </a>
                        </li>
                        @elseif($item->status == \App\Enums\BookingStatus::FINISHED)
                        <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Gửi mail</a></li>
                        @elseif($item->status == \App\Enums\BookingStatus::CANCELED)
                            <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Xóa</a></li>
                        @endif
                    </ul>
                </li>
                @empty
                <li>
                    <center>Chưa có lượt book nào</center>
                </li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $bookings->links() }}
    </div>
    @include('host.bookings.modals._approve_modal')
    @include('host.bookings.modals._finished_confirm_modal')
@endsection

@section('script')
    <script>
        $(document).on('click', '#approveBooking', function () {
            console.log($(this).attr('data-number-max-slots'));
            $('#form-approve').attr('action', $(this).attr('data-action'));
            $('#approveModal input[name=number_of_slots]').val($(this).attr('data-number-of-slots'));
            $('#approveModal input[name=date_of_book]').val($(this).attr('data-date-of-book'));
            $('#approveModal input[name=tour_id]').val($(this).attr('data-tour-id'));
        });

        $(document).on('click', '#finishedConfirm', function () {
            $('#form-finished-confirm').attr('action', $(this).attr('data-action'));
        });
    </script>
@endsection
