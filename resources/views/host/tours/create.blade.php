@extends('layouts.host.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet">
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="{{ asset('admin/js/editor/summernote-bs4.css') }}">
    <style>
        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        img {
            display: block;
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Thông tin về Tour du lịch</a>
        </li>
        <li class="breadcrumb-item active">Thêm</li>
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
    <form action="{{ route('host.tours.store') }}" method="post" enctype="multipart/form-data" class="container">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Thông tin chung</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-tour">Tên Tour<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Trở lại thanh xuân..."
                               name="name" id="name-tour" value="{{ session()->get('tour')->name ?? old('name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price-tour">Chi phí <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control" name="price"
                                   id="price-tour" value="{{ session()->get('tour')->price ?? old('price') }}" required>
                            <span>&nbsp;(VNĐ)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="vehicle-tour">Phương tiện chính <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Xe máy, ôtô, thuyền..."
                               name="vehicle" id="vehicle-tour" value="{{ session()->get('tour')->vehicle ?? old('vehicle') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total-time-tour">Tổng thời gian <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="total_time" placeholder="1, 2, 3 giờ"
                               id="total-time-tour" value="{{ session()->get('tour')->total_time ?? old('total_time') }}" required>
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
                                <img src="{{ session()->get('tour')->avatar_url ?? asset('img/tour_1.jpg') }}" width="130px" id="tour-avatar-image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="tour-thumbnail">Ảnh thu nhỏ <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="tour-thumbnail" placeholder="Ảnh thumbnail" />
                                <input type="text" class="form-control-file" id="tour-thumbnail"
                                       placeholder="Ảnh thumbnail" name="thumbnail" hidden="true"/>
                            </div>
                            <div>
                                <img src="{{ session()->get('tour')->thumbnail_url ?? asset('img/tour_1.jpg') }}" width="130px" id="tour-thumbnail-image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="editor" id="description" title="Mô tả thêm">
                            {!! session()->get('tour')->description ?? old('description') !!}
                        </textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chương trình</label>
                        <textarea name="program" class="editor" id="program" title="Các chương trình trong chuyến du lịch">
                            {!! session()->get('tour')->program ?? old('program') !!}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_general-->
        <p>
            <button type="submit" class="btn_1 medium" @if(session()->has('tour')) disabled @endif>Tạo</button>
            <a title="Hủy bỏ" href="{{ url()->previous() }}" class="btn_1 medium gray">
                Hủy bỏ
            </a>
        </p>
    </form>
    @include('host.tours.modals._crop_thumbnail_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/jquery-cropper.min.js') }}"></script>
    <!-- WYSIWYG Editor -->
    <script src="{{ asset('admin/js/editor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/tour/create.js') }}"></script>
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
            tabsize: 1,
            height: 150
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

        $('input[name="price"]').keyup(function (e) {
            var x = numberWithCommas((e.target.value.toString()).replaceAll('.',''));
            $(this).val(x);
        });
    </script>
@endsection
