@extends('layouts.admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Danh sách</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Các địa điểm du lịch
        </div>
        <div class="card-body">
            <a href="{{ route('admin.attractions.create') }}" class="btn btn-success mb-3 ml-3">Thêm địa điểm</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tên địa điểm</th>
                        <th>Tiêu đề</th>
                        <th>Loại hình</th>
                        <th>Mô tả</th>
                        <th>Tỉnh/Huyện</th>
                        <th>Ảnh chính</th>
                        <th>Ảnh phụ</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attractions as $item)
                        <tr>
                            <td>{{ ($item->name ? $item->name : '') }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ (!empty($item->category->name) ? $item->category->name : '') }}</td>
                            <td>{!! $item->description !!}</td>
                            <td>{{ $item->district->name }}, {{ $item->province->name }}</td>
                            <td><img src="{{ $item->avatar_url }}" width="100px"/></td>
                            <td><img src="{{ $item->thumbnail_url }}" width="100px"/></td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a class="btn btn-info text-white" data-toggle="modal" id="showAttractionDetail"
                                        data-target="#showAttractionModal" data-id="{{ $item->id }}">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.attractions.edit', $item->id) }}" class="btn btn-warning text-white" data-id="{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeAttraction"
                                            data-target="#removeAttractionModal" data-id="{{ $item->id }}">
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
    @include('admin.attractions.modals._show_detail_attraction')
    @include('admin.attractions.modals._remove_modal_attraction')
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script>
      $(document).on('click', '#showAttractionDetail', function () {
        var id = $(this).data('id');
        var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/api/attractions/' + id;
        fetch(url)
        .then(response => response.json())
        .then(result => {
          $('#attraction-name').val(result.data.name);
          $('#attraction-address').val(result.data.address);
          $('#attraction-latitude').val(result.data.latitude);
          $('#attraction-longitude').val(result.data.longitude);
          $('#attraction-images').children().remove().end();
          result.data.images.forEach(function (data) {
            $("#attraction-images").append('<div class="col-md-4">' +
                '<img src="'+ data + '" width="100%" height="100%"/>'
                +'</div>');
          });
          console.log('Data: ', result.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });

      $(document).on('click', '#removeAttraction', function () {
        var id = $(this).data('id');
        var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/admincp/attractions/' + id;
        $('#form-remove-attraction').attr('action', url);
      });
    </script>
@endsection
