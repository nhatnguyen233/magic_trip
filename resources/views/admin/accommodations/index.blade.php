@extends('layouts.admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Khách sạn, nhà nghỉ, homestay</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Danh sách nơi ở (Khách sạn, nhà nghỉ)
        </div>
        <div class="card-body">
            <a href="{{ route('admin.accommodations.create') }}" class="btn btn-success mb-3 ml-3">Thêm nơi nghỉ</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tên nơi ở</th>
                        <th>Liên hệ</th>
                        <th>Địa chỉ</th>
                        <th>Giá thấp nhất</th>
                        <th>Số Phòng</th>
                        <th>Ảnh chính</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accommodations as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->lowest_price }}</td>
                            <td>{{ $item->number_of_rooms }}</td>
                            <td><img src="{{ $item->avatar_url }}" width="100px"/></td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a class="btn btn-info text-white" data-toggle="modal" id="showAccommodationDetail"
                                       data-target="#showAccommodationModal" data-id="{{ $item->id }}">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.accommodations.edit', $item->id) }}" class="btn btn-warning text-white" data-id="{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeAccommodation"
                                            data-target="#removeAccommodationModal" data-id="{{ $item->id }}">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    <!-- /tables-->
{{--    @include('admin.accommodations.modals._show_detail_accommodation')--}}
{{--    @include('admin.accommodations.modals._remove_modal_accommodation')--}}
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script>
        {{--$(document).on('click', '#showAccommodationaccommodationDetail', function () {--}}
        {{--    var id = $(this).data('id');--}}
        {{--    var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/api/accommodations/' + id;--}}
        {{--    fetch(url)--}}
        {{--        .then(response => response.json())--}}
        {{--        .then(result => {--}}
        {{--            $('#accommodation-name').val(result.data.name);--}}
        {{--            $('#accommodation-address').val(result.data.address);--}}
        {{--            $('#accommodation-latitude').val(result.data.latitude);--}}
        {{--            $('#accommodation-longitude').val(result.data.longitude);--}}
        {{--            $('#accommodation-images').children().remove().end();--}}
        {{--            result.data.images.forEach(function (data) {--}}
        {{--                $("#accommodation-images").append('<div class="col-md-4">' +--}}
        {{--                    '<img src="'+ data + '" width="100%" height="100%"/>'--}}
        {{--                    +'</div>');--}}
        {{--            });--}}
        {{--            console.log('Data: ', result.data);--}}
        {{--        })--}}
        {{--        .catch(error => {--}}
        {{--            console.error('Error:', error);--}}
        {{--        });--}}
        {{--});--}}

        {{--$(document).on('click', '#removeAccommodation', function () {--}}
        {{--    var id = $(this).data('id');--}}
        {{--    var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/admincp/accommodations/' + id;--}}
        {{--    $('#form-remove-accommodation').attr('action', url);--}}
        {{--});--}}
    </script>
@endsection
