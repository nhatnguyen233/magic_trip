@extends('layouts.host.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Lịch trình của Tour</a>
        </li>
        <li class="breadcrumb-item active">Lịch trình du lịch</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Lịch trình du lịch
        </div>
        <div class="card-body">
            <a href="{{ route('host.tours.create') }}" class="btn btn-success mb-3 ml-3">Thêm tours</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tên lịch trình</th>
                        <th>Tóm tắt</th>
                        <th>Địa điểm tham quan</th>
                        <th>Nơi nghỉ ngơi</th>
                        <th>Giờ bắt đầu</th>
                        <th>Khoảng thời gian</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tours as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->summary }}</td>
                            <td>{{ $item->attractions }}</td>
                            <td>{{ $item->accommodations }}</td>
                            <td>{{ $item->start_time }}</td>
                            <td>{{ $item->limit_time }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('admin.tours.edit', $item->id) }}"
                                       class="btn btn-warning text-white" data-id="{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeTour"
                                            data-target="#removeTourModal" data-id="{{ $item->id }}">
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
{{--    @include('admin.categories.modals._remove_category_modal')--}}
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
@endsection
