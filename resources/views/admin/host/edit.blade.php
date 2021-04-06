@extends('layouts.admin.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/date_picker.css') }}" rel="stylesheet">
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
    <form method="POST" action="{{ route('admin.host.update', $host) }}" enctype="multipart/form-data">
        @method('PUT')
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
                               name="name" id="name" value="{{ isset($host->name) ? $host->name : '' }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title-attraction">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="abc@example.com"
                               name="email" id="email" value="{{ isset($host->email) ? $host->email : '' }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category-attraction">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" placeholder="*************"
                               name="password" id="password" value="{{ isset($host->password) ? $host->password : '' }}" required>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude-attraction">Điện thoại</label>
                        <input type="text" class="form-control" placeholder="00000000" name="phone"
                               id="phone" value="{{ isset($host->phone) ? $host->phone : '' }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude-attraction">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" placeholder="*************" name="password_confirmation"
                               value="{{ isset($host->password) ? $host->password : '' }}" id="password_confirmation" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="col-md-12">
                    <div class="form-group">
                    <label for="avatar" class="w-100" style="cursor: pointer">Avatar
                        <img style="width: 400px;" src="{{ !empty($host->getAvatarUrlAttribute()) ? asset($host->getAvatarUrlAttribute()) : ''  }}" id="avatar-image" />
                    </label>
                    <input type="file" class="form-control-file mb-2" id="avatar"
                            placeholder="Ảnh đại diện" name="avatar" hidden/>
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
                                    <option @if($host->province_id == $item->id)
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
                            <option @if($host->district_id) selected @endif value={{ $host->district_id }}> {{ isset($host->district_id) ? $host->district->name : '' }} </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zipcode-attraction">Zip Code</label>
                        <input type="text" class="form-control" name="postal_code"
                               id="zipcode-attraction" value="{{ isset($host->postal_code) ? $host->postal_code : '' }}" />
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
                               placeholder="An Khánh, Hoài Đức, Hà Nội..." value="{{ isset($host->address) ? $host->address : '' }}" />
                    </div>
                </div>
            </div>
        </div>
        <p>
             <button style="margin-left: 30px" type="submit" class="btn_1 medium">Save</button>
        </p>
    </form>
    @include('admin.attractions.modals._crop_avatar_modal')
    @include('admin.attractions.modals._crop_thumbnail_modal')
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

        if ($(this)[0].files[0]) {
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL($(this)[0].files[0]);
        }
      });

      $(function () {
        var district = {{ $user->district_id ?? "1" }};
        var url = new URL('{{ route('api.districts.index') }}');
        var params = { province:$('#province-attraction').val() };
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
        fetch(url)
            .then(response => response.json())
            .then(result => {
              $('#district-attraction').children().remove().end();
              result.data.forEach(function (data) {
                if(district == parseInt(data.id)) {
                  $("#district-attraction").append('<option value="' + district + '" selected>'+ data.name + '</option>');
                } else {
                  $("#district-attraction").append('<option value="' + data.id + '">'+ data.name + '</option>');
                }
              });
            })
            .catch(error => {
              console.error('Error:', error);
            });
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

      function imageIsLoaded(e) {
        var picture = '<div class="col-md-2 col-6">' +
            '<img src="' + e.target.result + '" style="width:100%;height:100%;" id="attraction-images" />' +
            '</div>'
        $(".list-attraction-images").append(picture);
      }

      function clearFile(e) {
        if ($('.multi-file-images').length == 1) {
          $(e).prevAll('input').val("");
          $(e).prevAll('.custom-file-label').text("Chọn ảnh");
        } else {
          $(e).prev().prev('.multi-file-images').remove();
        }
      }

      $(document).on('click', '#removeImage', function () {
        var id = $(this).data('id');
        var url = window.location.origin + '/admincp/attraction-images/' + id;
        $('#form-remove-image').attr('action', url);
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

    </script>
@endsection
