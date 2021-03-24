@extends('layouts.host.app')

@section('style')
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="{{ asset('admin/js/editor/summernote-bs4.css') }}">
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Điều phối</a>
        </li>
        <li class="breadcrumb-item active">Các địa điểm của Tour {{ session()->get('tour')->name ?? ' '}}</li>
    </ol>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Các địa điểm Tour du lịch {{ session()->get('tour')->name ?? ' '}}
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-success text-white mb-3 ml-3" data-toggle="modal" data-target="#infoModalCenter">
                Thêm địa điểm
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Địa điểm</th>
                        <th>Chỗ ở</th>
                        <th>Tiêu đề</th>
                        <th>Phương tiện chính</th>
                        <th>Ảnh thu nhỏ</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($infos as $item)
                        <tr>
                            <td>{{ $item->order_number }}</td>
                            <td>{{ $item->attraction->name }}</td>
                            <td>{{ $item->accommodation->name }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->vehicle }}</td>
                            <td><img src="{{ $item->thumbnail_url }}" width="100px"/></td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a class="btn btn-info text-white" data-toggle="modal" id="showInfoDetail"
                                       data-target="#showInfoModal" data-id="{{ $item->id }}">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-warning text-white" data-id="{{ $item->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" id="removeInfo"
                                            data-target="#removeInfoModal" data-id="{{ $item->id }}">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <h2 class="text-center mt-4 font-weight-lighter">
                                    Chưa có địa điểm hành trình
                                </h2>
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
    @include('host.tours.modals._add_tour_attraction_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/js/admin-datatables.js') }}"></script>
    <!-- WYSIWYG Editor -->
    <script src="{{ asset('admin/js/editor/summernote-bs4.min.js') }}"></script>
    <script>
        $('.editor').summernote({
            fontSizes: ['10', '14', '16', '18', '22'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
            placeholder: 'Mô tả thêm về địa điểm....',
            tabsize: 2,
            height: 240
        });

        $(function () {
           @if($infos->count() == 0)
            alert('Vui lòng thêm địa điểm cho Tours du lịch');
           @endif
        });

        $('.preview-image').change(function (e) {
            if (e.currentTarget.files && e.currentTarget.files[0]) {
                const reader = new FileReader();
                const imageTarget = e.currentTarget.dataset.target;
                reader.onload = function (e) {
                    $(imageTarget)
                        .attr('src', e.target.result)
                        .width(130)
                        .height('auto');
                }

                reader.readAsDataURL(e.currentTarget.files[0]);
            }
        });

        $('#info-thumbnail').change(function (e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#info-thumbnail-image')
                        .attr('src', e.target.result)
                        .width('100%')
                        .height(290);
                }

                reader.readAsDataURL(e.currentTarget.files[0]);
            }
        });

        $(document).on('click', '.create-tour-info', function () {
            var url = window.location.origin + '/host/tour-infos';
            var input = document.getElementById('info-thumbnail');
            const formData = new FormData();
            const fileField = input.files[0];

            formData.append('_token', '{!! csrf_token() !!}');
            formData.append('tour_id', $('#tour').val());
            formData.append('attraction_id', $('#tour-attraction').val());
            formData.append('accommodation_id', $('#tour-accommodation').val());
            formData.append('title', $('#tour-title').val());
            formData.append('vehicle', $('#vehicle-tour-info').val());
            formData.append('start_time', $('#start-time').val());
            formData.append('limit_time', $('#limit-time').val());
            formData.append('summary', $('#tour-info-summary').val());
            formData.append('order_number', $('#order-number').val());
            formData.append('thumbnail', fileField);

            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    alert('Thêm địa điểm thành công');
                    $('#infoModalCenter').modal('hide');
                    $('#tour').val('');
                    $('#tour-attraction').val('');
                    $('#tour-accommodation').val('');
                    $('#tour-title').val('');
                    $('#vehicle-tour-info').val('');
                    $('#start-time').val('');
                    $('#limit-time').val('');
                    $('#order-number').val('');
                    $('#tour-info-summary').html('');
                    location.reload();
                })
                .catch(error => {
                    alert('Thêm địa điểm thất bại');
                });
        });
    </script>
@endsection
