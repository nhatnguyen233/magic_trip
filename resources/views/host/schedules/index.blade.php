@extends('layouts.host.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Thiết lịch cho Tour du lịch</li>
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
            <i class="fa fa-table"></i> Danh sách lịch
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-primary text-white mb-3 ml-3 create-schedule"
               data-action="{{ route('host.schedules.store') }}"
               data-toggle="modal" data-target="#createScheduleModal">Tạo lịch</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>
                            <center>Tour ID</center>
                        </th>
                        <th>
                            <center>Tên tour</center>
                        </th>
                        <th>
                            <center>Ảnh</center>
                        </th>
                        <th>
                            <center>Ngày bắt đầu</center>
                        </th>
                        <th>
                            <center>Số lượng tối đa</center>
                        </th>
                        <th>
                            <center>Thao tác</center>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($schedules as $item)
                    <tr>
                        <td><center>{{ $item->tour->id }}</center></td>
                        <td><center>{{ $item->tour->name }}</center></td>
                        <td><center><img src="{{ $item->tour->thumbnail_url }}" width="80px" height="80px"/></center></td>
                        <td><center>{{ date('d-m-Y', strtotime($item->departure_time)) }}</center></td>
                        <td><center>{{ $item->number_max_slots }}</center></td>
                        <td>
                            <center>
                                <div class="d-flex justify-content-around">
                                    <a data-toggle="modal" id="editSchedule" data-target="#editScheduleModal"
                                       class="btn btn-warning text-white edit-schedule"
                                       data-action="{{ route('host.schedules.update', $item->id) }}"
                                       data-id="{{ $item->id }}"
                                       data-departure-time="{{ date('d-m-Y', strtotime($item->departure_time)) }}"
                                       data-number-max-slots="{{ $item->number_max_slots }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeSchedule"
                                            data-target="#removeScheduleModal" data-id="{{ $item->id }}">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </div>
                            </center>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <center>Chưa có lịch tour nào được thiết lập</center>
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    <!-- /tables-->
    @include('host.schedules.modals._create_schedule_modal')
    @include('host.schedules.modals._update_schedule_modal')
    @include('host.schedules.modals._remove_schedule_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script src="{{ asset('js/front/moment.min.js') }}"></script>
    <script src="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('#create_departure_time').datetimepicker({
                format: 'DD-MM-YYYY',
            });

            $("#create_departure_time").on("change.datetimepicker", function (e) {
                $(this).datetimepicker('minDate', e.date);
            });

            $('#edit_departure_time').datetimepicker({
                format: 'DD-MM-YYYY',
            });

            $('.edit-schedule').on('click', function () {
                $('#editScheduleModal form').attr('action', $(this).attr('data-action'));
                $('#editScheduleModal input[name=departure_time]').val($(this).attr('data-departure-time'));
                $('#editScheduleModal input[name=number_max_slots]').val($(this).attr('data-number-max-slots'));
            });

            $('.create-schedule').on('click', function () {
                $('#createScheduleModal form').attr('action', $(this).attr('data-action'));
            });
        })

        $(document).on('click', '#removeSchedule', function () {
            var id = $(this).data('id');
            var url = window.location.origin + '/host/schedules/' + id;
            $('#form-remove-schedule').attr('action', url);
        });
    </script>
@endsection
