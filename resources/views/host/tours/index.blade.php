@extends('layouts.host.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Các tour du lịch</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Danh sách các Tour
        </div>
        <div class="card-body">
            <a href="{{ route('host.tours.create') }}" class="btn btn-success mb-3 ml-3">Thêm tours</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên tour</th>
                        <th>Tổng chi phí</th>
                        <th>Tổng thời gian</th>
                        <th>Phương tiện chính</th>
                        <th>Lộ trình</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tours as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->total_price }}</td>
                            <td>{{ $item->total_time }}</td>
                            <td>{{ $item->vehicle }}</td>
                            <td>{{ $item->infos }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('host.tours.edit', $item->id) }}"
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
{{--    @include('host.tours.modals._remove_category_modal')--}}
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
@endsection