@extends('layouts.host.app')

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
            <a href="#">Địa điểm</a>
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
    <form action="{{ route('host.attractions.update', ['attraction' => $attraction->id]) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Thông tin cơ bản</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title-attraction">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Hồ Đồng Đò yên bình, thơ mộng"
                               name="title" id="title-attraction" value="{{ $attraction->title }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-attraction">Tên địa điểm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Hồ Đồng Đò"
                               name="name" id="name-attraction" value="{{ $attraction->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category-attraction">Loại hình <span class="text-danger">*</span></label>
                        <div class="styled-select">
                            <select name="category_id" id="category-attraction" required>
                                <option selected disabled>---- Chọn loại hình ----</option>
                                @foreach($categories as $item)
                                    <option @if($attraction->category_id == $item->id)
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
                               id="latitude-attraction" value="{{ $attraction->latitude }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude-attraction">Kinh độ</label>
                        <input type="text" class="form-control" placeholder="15°W" name="longitude"
                               value="{{ $attraction->longitude }}" id="longitude-attraction" />
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="attraction-avatar">Ảnh chính <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file preview-image" id="attraction-avatar"
                                       data-target="#attraction-avatar-image" placeholder="Ảnh avatar"
                                       name="avatar" />
                            </div>
                            <div>
                                @if($attraction->avatar_url)
                                <img src="{{ $attraction->avatar_url }}" width="130px" id="attraction-avatar-image" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="attraction-thumbnail">Ảnh thu nhỏ <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file preview-image" id="attraction-thumbnail"
                                       data-target="#attraction-thumbnail-image" placeholder="Ảnh thumbnail"
                                       name="thumbnail" />
                            </div>
                            <div>
                                @if($attraction->thumbnail_url)
                                <img src="{{ $attraction->thumbnail_url }}" width="130px" id="attraction-thumbnail-image" />
                                @endif
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
                        @if($attraction->images)
                            <div class="row list-attraction-images">
                                @foreach($attraction->images()->get() as $item)
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
                            {{ $attraction->description }}
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
                                    <option @if($attraction->province_id == $item->id)
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
                               id="zipcode-attraction" value="{{ $attraction->zipcode }}" />
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
                               placeholder="An Khánh, Hoài Đức, Hà Nội..." value="{{ $attraction->address }}" />
                    </div>
                </div>
            </div>
            <!-- /row-->
        </div>
        <p>
            <button type="submit" class="btn_1 medium">Save</button>
        </p>
    </form>

    @include('host.attractions.modals._remove_image_modal')
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
        var district = {{ $attraction->district_id ?? "1" }};
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
        var url = window.location.origin + '/host/attraction-images/' + id;
        $('#form-remove-image').attr('action', url);
      });
    </script>
@endsection
