@extends('layouts.admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lí hosting chờ duyệt</a>
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
            <i class="fa fa-table"></i> Danh sách hosting chờ duyệt
        </div>
        <div class="card-body">
            <a href="{{ route('admin.hosts.index') }}" class="btn btn-success mb-3 ml-3">Danh sách đã kích hoạt</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ thường trú</th>
                        <th>Địa chỉ tạm trú</th>
                        <th>Mã zipcode</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listUnpproveHost as $host)
                        <tr>
                            <td><img src="{{ !empty($host->getAvatarUrlAttribute()) ? asset($host->getAvatarUrlAttribute()) : ''  }}" width="60px" height="60px" class="rounded-circle" id="avatar-image" /></td>
                            <td>{{ $host->name }}</td>
                            <td>{{ $host->email }}</td>
                            <td>{{ $host->phone }}</td>
                            <td>{{ $host->address }}</td>
                            <td>{{ !empty($host->FullAddress) ? $host->FullAddress : '' }}</td>
                            <td>{{ $host->postal_code }}</td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" id="removeHost"
                                        data-target="#removeHostModal" data-id="{{ $host->id }}">
                                        Reject
                                </button>   
                                @if ($host->status == \App\Enums\StatusHost::UNAPPROVE)
                                <a href="{{ route('admin.host.changeStatus', [$host->id, \App\Enums\StatusHost::APPROVE]) }}" class="btn btn-success pl-4 pr-4"> Xác thực</a>
                                @endif
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
    @include('admin.attractions.modals._remove_modal_host')
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script>
      $(document).on('click', '#removeHost', function () {
        var id = $(this).data('id');
        var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/admincp/host/' + id;
        $('#form-remove-host').attr('action', url);
      });
    </script>
@endsection
