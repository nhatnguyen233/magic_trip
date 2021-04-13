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
    <form method="POST" action="{{ route('admin.hosts.update', $host) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-map-marker"></i>Địa chỉ</h2>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="address">Tên công ty, tổ chức đối tác</label>
                        <input type="text" id="host_name" name="host_name" value="{{ isset($host->host_name) ? $host->host_name : '' }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date_of_establish">Ngày thành lập</label>
                        <input type="text" class="form-control datetimepicker-input" placeholder="Ngày thành lập"
                                id="date_of_establish" data-toggle="datetimepicker" name="date_of_establish"
                                value="{{ isset($host->date_of_establish) ? $host->date_of_establish : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="hotline">Hotline</label>
                        <input type="text" id="hotline" name="hotline" value="{{ isset($host->hotline) ? $host->hotline : '' }}" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="host_mail">Địa chỉ Mail</label>
                            <input type="text" id="host_mail" name="host_mail" value="{{ isset($host->host_mail) ? $host->host_mail : '' }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="editor" value="{{ isset($host->description) ? $host->description : '' }}" id="description" title="Mô tả thêm">
                    {{ isset($host->description) ? $host->description : '' }}
                    </textarea>
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
