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
                <h2><i class="fa fa-file"></i>Thông tin chung tour du lịch</h2>
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
                        <label for="total-price-tour">Tổng chi phí <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="total_price"
                               id="total-price-tour" value="{{ session()->get('tour')->total_price ?? old('total_price') }}" required>
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
                        <input type="number" class="form-control" name="total_time" placeholder="Đơn vị phút (60 phút)"
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
                                <input type="file" class="form-control-file preview-image" id="tour-thumbnail"
                                       data-target="#tour-thumbnail-image" placeholder="Ảnh thumbnail"
                                       name="thumbnail" />
                            </div>
                            <div>
                                <img src="{{ session()->get('tour')->thumbnail_url ?? asset('img/tour_1.jpg') }}" width="130px" id="tour-thumbnail-image" />
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
                            {{ session()->get('tour')->description ?? old('description') }}
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
    <form action="{{ route('host.tours.store') }}" method="post" enctype="multipart/form-data" class="container">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-map-marker"></i>Địa điểm du lịch</h2>
            </div>
            <div class="tour-attractions mb-3">
                @if(session()->has('tour'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tour">Tour du lịch<span class="text-danger">*</span></label>
                            <div class="styled-select">
                                <select name="tour_id[]" id="tour">
                                    <option value={{ session()->get('tour')->id }}>
                                        {{ session()->get('tour')->name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="attraction-tour">Chọn địa điểm</label>
                            <div class="styled-select">
                                <select name="attraction_id[]" id="attraction-tour">
                                    <option selected disabled>---- Chọn địa điểm ----</option>
                                    @foreach($attractions as $item)
                                        <option @if(old('attraction_id') == $item->id)
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="province-tour">Chọn nơi nghỉ</label>
                            <div class="styled-select">
                                <select name="accommodation_id[]" id="province-tour" required>
                                    <option selected disabled>---- Chọn nơi nghỉ ----</option>
                                    @foreach($accommodations as $item)
                                        <option @if(old('accommodation_id') == $item->id)
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
                            <label for="title-tour">Tiêu đề hành trình</label>
                            <input type="text" class="form-control" name="title[]"
                                   id="title-tour" value="{{ old('title') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order-number-tour">Thứ tự hành trình</label>
                            <input type="number" class="form-control" name="order_number[]"
                                   id="order-number-tour" value="{{ old('order_number') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start-time-tour">Thời gian bắt đầu</label>
                            <input type="text" class="form-control" name="start_time[]"
                                   id="start-time-tour" value="{{ old('start_time') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="limit-time-tour">Khoảng thời gian</label>
                            <input type="number" class="form-control" name="limit_time[]"
                                   id="limit-time-tour" value="{{ old('limit_time') }}" />
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="summary-tour">Tóm tắt</label>
                            <textarea name="summary[]" class="editor" id="summary-tour" title="Mô tả thêm">
                            {{ old('summary') }}
                        </textarea>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <a title="Thêm hành trình" href="javascript:" onclick="cloneForm(this)"
               class="btn_1 red add-accommodation-images mt-1">
                <i class="fa fa-fw fa-plus-circle"></i>Thêm hành trình
            </a>
            <a title="Lược bớt" href="javascript:" onclick="clearForm(this)"
               class="btn_1 gray remove-tour-attractions mt-1">
                <i class="fa fa-fw fa-times-circle"></i>Lược bớt
            </a>
            <!-- /row-->
        </div>
        <p>
            <button type="submit" class="btn_1 medium">Save</button>
        </p>
    </form>
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker.js') }}"></script>
    <script>$('input.date-pick').datepicker();</script>
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
            height: 200
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

        const cloneForm = (e) => {
            fileForm = $(".tour-attractions").eq(0).clone();
            fileForm.insertBefore($(e));
        }

        function clearForm(e) {
            if ($('.tour-attractions').length > 1) {
                $(e).prev().prev('.tour-attractions').remove();
            }
        }
    </script>
@endsection
