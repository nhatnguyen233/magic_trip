@extends('layouts.admin.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/date_picker.css') }}" rel="stylesheet">
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="{{ asset('admin/js/editor/summernote-bs4.css') }}">
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
    <form action="{{ route('admin.accommodations.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-home"></i>Thông tin khách sạn, nhà nghỉ, homestay</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-accommodation">Tên nơi nghỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Tên khách sạn, nhà nghỉ, homestay,..."
                               name="name" id="name-accommodation" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone-accommodation">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone-accommodation"
                               value="{{ old('phone') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lowest-price-accommodation">Mức giá thấp nhất (1 đêm hoặc 1 ngày) <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control" name="lowest_price"
                                   id="lowest-price-accommodation" value="{{ old('lowest_price') }}" required>
                            <span>&nbsp;(VNĐ)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="number-room-accommodation">Số lượng phòng <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="number_of_rooms"
                               id="number-room-accommodation" value="{{ old('number_of_rooms') }}" required>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude-accommodation">Vĩ độ</label>
                        <input type="text" class="form-control" placeholder="13°19'43″N" name="latitude"
                               id="latitude-accommodation" value="{{ old('latitude') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude-accommodation">Kinh độ</label>
                        <input type="text" class="form-control" placeholder="15°W" name="longitude"
                               value="{{ old('longitude') }}" id="longitude-accommodation" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="accommodation-avatar">Ảnh chính <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="accommodation-avatar" placeholder="Ảnh avatar"
                               name="avatar" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="accommodation-thumbnail">Ảnh thu nhỏ <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="accommodation-thumbnail"
                               placeholder="Ảnh thumbnail" name="thumbnail" value="{{ old('thumbnail') }}" required/>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ảnh album</label>
                        <div class="custom-file multi-file-images">
                            <label for="images" class="custom-file-label">Chọn ảnh</label>
                            <input type="file" name="images[]" class="custom-file-input images" id="images" />
                        </div>
                        <a title="Thêm ảnh" href="javascript:" onclick="cloneFile(this)"
                           class="btn_1 red add-accommodation-images mt-1">
                            <i class="fa fa-fw fa-plus-circle"></i>Thêm ảnh
                        </a>
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
                            {{ old('description') }}
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
                                    <option @if(old('province_id') == $item->id)
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
                               placeholder="An Khánh, Hoài Đức, Hà Nội..." value="{{ old('address') }}" />
                    </div>
                </div>
            </div>
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

        $(document).on('change', '#images', function () {
            var i = $(this).prev('label').clone();
            var file = $(this)[0].files[0].name;
            $(this).prev('label').text(file);
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

        const cloneFile = (e) => {
            fileForm = $(".multi-file-images").eq(0).clone();
            fileForm.find('input').val("");
            fileForm.find('.custom-file-label').text("Chọn ảnh");
            fileForm.insertBefore($(e));
        }

        function clearFile(e) {
            if ($('.multi-file-images').length == 1) {
                $(e).prevAll('input').val("");
                $(e).prevAll('.custom-file-label').text("Chọn ảnh");
            } else {
                $(e).prev().prev('.multi-file-images').remove();
            }
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        }

        $('input[name="lowest_price"]').keyup(function (e) {
            var x = numberWithCommas((e.target.value.toString()).replaceAll('.',''));
            $(this).val(x);
        });
    </script>
@endsection
