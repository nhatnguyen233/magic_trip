@extends('layouts.admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lí tài khoản</a>
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
            <i class="fa fa-table"></i> Danh sách tài khoản
        </div>
        <div class="card-body">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3 ml-3">Thêm tài khoản</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ thường trú</th>
                        <th>Mã zipcode</th>
                        <th>Quyền</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listUsers as $user)
                        <tr>
                            <td><img src="{{ $user->avatar_url }}" width="60px" height="60px" class="rounded-circle" id="avatar-image" /></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->postal_code }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning text-white" data-id="{{ $user->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeAttraction"
                                            data-target="#removeAttractionModal" data-id="{{ $user->id }}">
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
