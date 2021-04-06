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
    <form action="{{ route('admin.host.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Thông tin cơ bản</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name-attraction">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nguyễn Văn A"
                               name="name" id="name" value="{{ old('name') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title-attraction">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="abc@example.com"
                               name="email" id="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category-attraction">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" placeholder="*************"
                               name="password" id="password" value="{{ old('password') }}" required>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude-attraction">Điện thoại</label>
                        <input type="text" class="form-control" placeholder="00000000" name="phone"
                               id="phone" value="{{ old('phone') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude-attraction">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" placeholder="*************" name="password_confirmation"
                               value="{{ old('password') }}" id="password_confirmation" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="col-md-12">
                    <div class="form-group">
                    <label for="avatar" class="w-100" style="cursor: pointer">Avatar
                        <img src="{{ asset('img/anh-dai-dien.jpg') }}" id="avatar-image" />
                    </label>
                    <input type="file" class="form-control-file mb-2" id="avatar"
                            placeholder="Ảnh đại diện" name="avatar" hidden/>
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
                        <input type="text" class="form-control" name="postal_code"
                               id="zipcode-attraction" value="{{ old('postal_code') }}" />
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
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="role_id">Role <span class="text-danger">*</span></label>
                        <select type="hidden" name="role_id" id="role_id" class="form-control">
                            <option value="2" selected>Host</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="status" id="status"
                               placeholder="An Khánh, Hoài Đức, Hà Nội..." value="1" />  
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

      $('#avatar').change(function (e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar-image')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            }

            reader.readAsDataURL(e.currentTarget.files[0]);
        }
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
