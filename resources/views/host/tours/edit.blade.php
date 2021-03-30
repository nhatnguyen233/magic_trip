@extends('layouts.host.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="{{ asset('admin/js/editor/summernote-bs4.css') }}">
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Thông tin về Tour du lịch</a>
        </li>
        <li class="breadcrumb-item active">Sửa</li>
    </ol>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <form action="{{ route('host.tours.update', $tour->id) }}" method="post" enctype="multipart/form-data" class="container">
        @method('PUT')
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Thông tin chung tour du lịch</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-tour">Tên Tour<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Trở lại thanh xuân..."
                               name="name" id="name-tour" value="{{ $tour->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price-tour">Tổng chi phí <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="price"
                               id="price-tour" value="{{ $tour->price }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="vehicle-tour">Phương tiện chính <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Xe máy, ôtô, thuyền..."
                               name="vehicle" id="vehicle-tour" value="{{ $tour->vehicle }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total-time-tour">Tổng thời gian <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="total_time" placeholder="Đơn vị phút (60 phút)"
                               id="total-time-tour" value="{{ $tour->total_time }}" required>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="tour-avatar">Ảnh chính <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file preview-image" id="tour-avatar"
                                       data-target="#tour-avatar-image" placeholder="Ảnh avatar"
                                       name="avatar" />
                            </div>
                            <div>
                                <img src="{{ $tour->avatar_url }}" width="130px" id="tour-avatar-image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="tour-thumbnail">Ảnh thu nhỏ <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file preview-image" id="tour-thumbnail"
                                       data-target="#tour-thumbnail-image" placeholder="Ảnh thumbnail"
                                       name="thumbnail" />
                            </div>
                            <div>
                                <img src="{{ $tour->thumbnail_url }}" width="130px" id="tour-thumbnail-image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="editor" id="description" title="Mô tả thêm">
                            {!!  $tour->description !!}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_general-->
        <p>
            <button type="submit" class="btn_1 medium" @if(session()->has('tour')) disabled @endif>Save</button>
        </p>
    </form>
    <!-- Example DataTables Card-->
    <div class="card mb-3 container">
        <div class="card-header">
            <i class="fa fa-table"></i> Danh sách các địa điểm du lịch
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
                    @forelse($tour->infos as $item)
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
                                <h2 class="text-center mt-4 font-weight-lighter">Chưa có dữ liệu</h2>
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
    <script src="{{ asset('admin/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker.js') }}"></script>
    <!-- WYSIWYG Editor -->
    <script src="{{ asset('admin/js/editor/summernote-bs4.min.js') }}"></script>
    <script>
        $('.editor').summernote({
            fontSizes: ['10', '14'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']]
            ],
            placeholder: 'Mô tả thêm về địa điểm....',
            tabsize: 2,
            height: 250
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

        const cloneForm = (e) => {
            fileForm = $(".tour-attractions").attr('hidden', false);
            fileForm.insertBefore($(e));
        }

        function clearForm(e) {
            if ($('.tour-attractions').length > 1) {
                $(e).prev().prev('.tour-attractions').remove();
            }
        }

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

        $('input[name="price"]').keyup(function (e) {
            var x = numberWithCommas((e.target.value.toString()).replaceAll('.',''));
            $(this).val(x);
        });
    </script>
@endsection
