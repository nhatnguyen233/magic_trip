@extends('layouts.admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lí Host</a>
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
            <i class="fa fa-table"></i> Danh sách Host
        </div>
        <div class="card-body">
            <a href="{{ route('admin.hosts.create') }}" class="btn btn-success mb-3 ml-3">Thêm Host</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Ngày thành lập</th>
                        <th>Chủ sở hữu</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hosts as $host)
                        <tr>
                            <td>{{ $host->host_name }}</td>
                            <td>{{ $host->description }}</td>
                            <td>{{ $host->host_mail}}</td>
                            <td>{{ $host->hotline }}</td>
                            <td>{{ $host->date_of_establish }}</td>
                            <td><a href="{{ route('admin.users.edit', $host->user_id) }}">{{ $host->user->name }}</a></td>
                            <td><img src="{{ $host->avatar_url }}" width="100px" height="100px" id="avatar-image" /></td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('admin.hosts.edit', $host->id) }}" class="btn btn-warning text-white" data-id="{{ $host->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeHost"
                                            data-target="#removeHostModal" data-id="{{ $host->id }}">
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
            var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/admincp/users/' + id;
            $('#form-remove-attraction').attr('action', url);
        });
    </script>
@endsection
