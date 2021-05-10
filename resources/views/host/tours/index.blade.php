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
            <a href="{{ route('host.tours.create') }}" class="btn btn-primary mb-3 ml-3">Thêm tours</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên tour</th>
                        <th>Tổng chi phí</th>
                        <th>Tổng thời gian</th>
                        <th>Phương tiện chính</th>
                        <th>Ảnh thu nhỏ</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tours as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->price, 0, '', ',') }} (VNĐ)</td>
                            <td>{{ $item->total_time }}</td>
                            <td>{{ $item->vehicle }}</td>
                            <td><img src="{{ $item->thumbnail_url }}" width="100px"/></td>
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
   @include('host.tours.modals._remove_tour_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script>
        $(document).on('click', '#removeTour', function () {
          var id = $(this).data('id');
          var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/host/tours/' + id;
           $('#form-remove-tour').attr('action', url);
        });
    </script>
@endsection
