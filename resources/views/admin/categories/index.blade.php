@extends('layouts.admin.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Các danh mục</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Danh sách danh mục
        </div>
        <div class="card-body">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3 ml-3">Thêm danh mục</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Loại danh mục</th>
                        <th>Danh mục cha</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if(isset($item->type))
                                    {{ $item->type_name }}
                                @endif
                            </td>
                            <td>
                                @if($item->parent_id)
                                    <a href="{{ route('admin.categories.show', $item->parent_id) }}">
                                        {{ $item->parent_name }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('admin.categories.edit', $item->id) }}"
                                       class="btn btn-warning text-white" data-id="{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeCategory"
                                            data-target="#removeCategoryModal" data-id="{{ $item->id }}">
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
    @include('admin.categories.modals._remove_category_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <script>
        $(document).on('click', '#removeCategory', function () {
            var id = $(this).data('id');
            var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/admincp/categories/' + id;
            $('#form-remove-category').attr('action', url);
        });
    </script>
@endsection
