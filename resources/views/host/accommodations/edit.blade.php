@extends('layouts.host.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/date_picker.css') }}" rel="stylesheet">
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
            <a href="#">Nơi nghỉ ngơi</a>
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
    <form action="{{ route('host.accommodations.update', $accommodation->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-home"></i>Thông tin khách sạn, nhà nghỉ, homestay</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="category_id">Loại hình <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="category_id" id="category_id" required>
                                <option selected disabled>---- Chọn loại hình ----</option>
                                @foreach($categories as $item)
                                    <option @if($accommodation->category_id == $item->id)
                                            selected
                                            @endif
                                            value={{ $item->id }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-accommodation">Tên nơi nghỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Tên khách sạn, nhà nghỉ, homestay,..."
                               name="name" id="name-accommodation" value="{{ $accommodation->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone-accommodation">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone-accommodation"
                               value="{{ $accommodation->phone }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lowest-price-accommodation">Mức giá thấp nhất (1 đêm hoặc 1 ngày) <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control" name="lowest_price"
                                   id="lowest-price-accommodation" value="{{ $accommodation->lowest_price }}" required>
                            <span>&nbsp;(VNĐ)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="number-room-accommodation">Số lượng phòng <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="number_of_rooms"
                               id="number-room-accommodation" value="{{ $accommodation->number_of_rooms }}" required>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude-accommodation">Vĩ độ</label>
                        <input type="text" class="form-control" placeholder="13°19'43″N" name="latitude"
                               id="latitude-accommodation" value="{{ $accommodation->latitude }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude-accommodation">Kinh độ</label>
                        <input type="text" class="form-control" placeholder="15°W" name="longitude"
                               value="{{ $accommodation->longitude }}" id="longitude-accommodation" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="accommodation-avatar">Ảnh chính <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file preview-image" id="accommodation-avatar"
                                       data-target="#accommodation-avatar-image" placeholder="Ảnh avatar"
                                       name="avatar" />
                            </div>
                            <div>
                                <img src="{{ $accommodation->avatar_url ?? asset('img/tour_1.jpg') }}" width="130px" height="90px" id="accommodation-avatar-image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="accommodation-thumbnail">Ảnh thu nhỏ <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="accommodation-thumbnail"
                                       placeholder="Ảnh thumbnail" />
                                <input type="text" class="form-control-file" id="accommodation-thumbnail"
                                       placeholder="Ảnh thumbnail" name="thumbnail" value="{{ $accommodation->thumbnail }}" hidden="true" />
                            </div>
                            <div>
                                <img src="{{ $accommodation->thumbnail_url ?? asset('img/tour_1.jpg') }}" width="130px" height="90px" id="accommodation-thumbnail-image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ảnh album</label>
                        @if($accommodation->images)
                            <div class="row list-attraction-images">
                                @foreach($accommodation->images()->get() as $item)
                                    <div class="col-md-2 col-6">
                                        <img src="{{ $item->image_url }}" width="100%" height="100%" />
                                        <div class="row m-auto justify-content-center">
                                            <a class="btn btn-primary mt-1 text-white" data-toggle="modal"
                                               id="removeImage"
                                               data-target="#removeImageModal"
                                               data-id="{{ $item->id }}">
                                                Xóa</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="custom-file multi-file-images mt-5">
                            <label for="images" class="custom-file-label">Chọn ảnh</label>
                            <input type="file" name="images[]" class="custom-file-input images" id="images" />
                        </div>
                        <a title="Lược bớt" href="javascript:" onclick="clearFile(this)"
                           class="btn_1 gray remove-accommodation-images mt-1">
                            <i class="fa fa-fw fa-times-circle"></i>Lược bớt
                        </a>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="editor" id="description" phone="Mô tả thêm">
                            {{ $accommodation->description }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_general-->

        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-map-marker"></i>Địa chỉ</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country-accommodation">Chọn quốc gia <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="country_id" id="country-accommodation">
                                <option value="1" selected>Viet Nam</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="province-accommodation">Chọn Tỉnh/Thành <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="province_id" id="province-accommodation" required>
                                <option selected disabled>---- Chọn tỉnh/thành ----</option>
                                @foreach($provinces as $item)
                                    <option @if($accommodation->province_id == $item->id)
                                            selected
                                            @endif
                                            value={{ $item->id }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district-accommodation">Chọn Xã/Phường <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="district_id" id="district-accommodation" required>
                                <option selected disabled>Chọn quận,huyện</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address-accommodation">Địa chỉ chi tiết</label>
                        <input type="text" class="form-control" name="address" id="address-accommodation"
                               placeholder="An Khánh, Hoài Đức, Hà Nội..." value="{{ $accommodation->address }}" />
                    </div>
                </div>
            </div>
            <!-- /row-->
        </div>
        <p>
            <button type="submit" class="btn_1 medium">Save</button>
        </p>
    </form>
    @include('host.accommodations.modals._crop_thumbnail_modal')
    @include('host.accommodations.modals._remove_album_image_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/jquery-cropper.min.js') }}"></script>
    <!-- WYSIWYG Editor -->
    <script src="{{ asset('admin/js/editor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/accommodation/create.js') }}"></script>
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
            height: 200
        });

        $('#province-accommodation').change(function () {
            var url = new URL('{{ route('api.districts.index') }}');
            var params = { province:$(this).val() };
            Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    $('#district-accommodation').children().remove().end();
                    result.data.forEach(function (data) {
                        $("#district-accommodation").append('<option value="' + data.id + '">'+ data.name + '</option>');
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        $(function () {
            var district = {{ $accommodation->district_id ?? "1" }};
            var url = new URL('{{ route('api.districts.index') }}');
            var params = { province:$('#province-accommodation').val() };
            Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    $('#district-accommodation').children().remove().end();
                    result.data.forEach(function (data) {
                        if(district == parseInt(data.id)) {
                            $("#district-accommodation").append('<option value="' + district + '" selected>'+ data.name + '</option>');
                        } else {
                            $("#district-accommodation").append('<option value="' + data.id + '">'+ data.name + '</option>');
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        $(document).on('click', '#removeImage', function () {
            var id = $(this).data('id');
            var url = window.location.origin + '/host/accommodation-images/' + id;
            $('#form-remove-image').attr('action', url);
        });
    </script>
@endsection
