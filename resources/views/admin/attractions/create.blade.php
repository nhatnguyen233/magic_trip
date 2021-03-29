@extends('layouts.admin.app')

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
            <a href="#">Địa điểm</a>
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
    <form action="{{ route('admin.attractions.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Thông tin cơ bản</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-attraction">Tên địa điểm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Hồ Đồng Đò"
                               name="name" id="name-attraction" value="{{ old('name') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title-attraction">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Hồ Đồng Đò yên bình, thơ mộng"
                               name="title" id="title-attraction" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category-attraction">Loại hình <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="category_id" id="category-attraction" required>
                                <option selected disabled>---- Chọn loại hình ----</option>
                                @foreach($categories as $item)
                                    <option @if(old('category_id') == $item->id)
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
                        <label for="latitude-attraction">Vĩ độ</label>
                        <input type="text" class="form-control" placeholder="13°19'43″N" name="latitude"
                               id="latitude-attraction" value="{{ old('latitude') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude-attraction">Kinh độ</label>
                        <input type="text" class="form-control" placeholder="15°W" name="longitude"
                               value="{{ old('longitude') }}" id="longitude-attraction" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="attraction-avatar">Ảnh chính <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="attraction-avatar"
                               placeholder="Ảnh avatar" required/>
                        <input type="text" id="attraction-avatar" name="avatar" hidden="true"/>
                        <img src="{{ asset('img/tour_1.jpg') }}" id="uploaded-attraction-avatar"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="attraction-thumbnail">Ảnh thu nhỏ <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="attraction-thumbnail"
                               placeholder="Ảnh thumbnail" required/>
                        <input type="text" id="attraction-thumbnail" name="thumbnail" hidden="true"/>
                        <img src="{{ asset('img/tour_1.jpg') }}" id="uploaded-attraction-thumbnail"/>
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
                           class="btn_1 red add-attraction-images mt-1">
                            <i class="fa fa-fw fa-plus-circle"></i>Thêm ảnh
                        </a>
                        <a title="Lược bớt" href="javascript:" onclick="clearFile(this)"
                           class="btn_1 gray remove-attraction-images mt-1">
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
                        <textarea name="description" class="editor" id="description" title="Mô tả thêm">
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
                        <label for="country-attraction">Chọn quốc gia <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="country_id" id="country-attraction">
                                <option value="1" selected>Viet Nam</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="province-attraction">Chọn Tỉnh/Thành <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="province_id" id="province-attraction" required>
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
                        <label for="district-attraction">Chọn Xã/Phường <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="district_id" id="district-attraction" required>
                                <option selected disabled>Chọn quận,huyện</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zipcode-attraction">Zip Code</label>
                        <input type="text" class="form-control" name="zipcode"
                               id="zipcode-attraction" value="{{ old('zipcode') }}" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address-attraction">Địa chỉ chi tiết</label>
                        <input type="text" class="form-control" name="address" id="address-attraction"
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
    @include('admin.attractions.modals._crop_avatar_modal')
    @include('admin.attractions.modals._crop_thumbnail_modal')
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/jquery-cropper.min.js') }}"></script>
    <!-- WYSIWYG Editor -->
    <script src="{{ asset('admin/js/editor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/attraction/create.js') }}"></script>
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

      $('#province-attraction').change(function () {
          var url = new URL('{{ route('api.districts.index') }}');
          var params = { province:$(this).val() };
          Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
          fetch(url)
              .then(response => response.json())
              .then(result => {
                  $('#district-attraction').children().remove().end();
                  result.data.forEach(function (data) {
                      $("#district-attraction").append('<option value="' + data.id + '">'+ data.name + '</option>');
                  });
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      });
    </script>
@endsection
