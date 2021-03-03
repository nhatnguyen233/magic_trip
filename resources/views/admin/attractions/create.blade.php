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
            <a href="#">Địa điểm</a>
        </li>
        <li class="breadcrumb-item active">Thêm</li>
    </ol>
    <form action="{{ route('admin.attractions.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Thông tin cơ bản</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" class="form-control" placeholder="Hồ Đồng Đò yên bình, thơ mộng" name="title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên đia điểm</label>
                        <input type="text" class="form-control" placeholder="Hồ Đồng Đò" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Loại hình</label>
                        <div class="styled-select">
                            <select name="category">
                                <option>Ẩm thực</option>
                                <option>Thơ mộng</option>
                                <option>Mạo hiểm</option>
                                <option>Đa dạng văn hóa</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Vĩ độ</label>
                        <input type="text" class="form-control" placeholder="13°19'43″N" name="latitude">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kinh độ</label>
                        <input type="text" class="form-control" placeholder="15°W" name="longitude">
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="attraction-avatar">Ảnh chính</label>
                        <input type="file" class="form-control-file" id="attraction-avatar" placeholder="Ảnh avatar" name="avatar"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="attraction-thumbnail">Ảnh thu nhỏ</label>
                        <input type="file" class="form-control-file" id="attraction-thumbnail" placeholder="Ảnh thumbnail" name="thumbnail"/>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ảnh album</label>
                        <div class="custom-file multi-file-images">
                            <input type="file" name="images[]" class="custom-file-input images" id="images">
                            <label for="images" class="custom-file-label">Chọn ảnh</label>
                        </div>
                        <a title="Thêm ảnh" href="javascript:" onclick="cloneFile(this)"
                           class="btn_1 gray add-attraction-images mt-1">
                            <i class="fa fa-fw fa-plus-circle"></i>Thêm ảnh
                        </a>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <div class="editor"></div>
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
                        <label>Chọn quốc gia</label>
                        <div class="styled-select">
                            <select name="country">
                                <option value="1">Viet Nam</option>
                                <option>Campuchia</option>
                                <option>ThaiLand</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chọn Tỉnh/Thành</label>
                        <div class="styled-select">
                            <select name="province">
                                <option value="1">Ha Noi</option>
                                <option>Phnom Penh</option>
                                <option>Bangkok</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chọn Xã/Phường</label>
                        <div class="styled-select">
                            <select name="district">
                                <option value="1">Ha Noi</option>
                                <option>Phnom Penh</option>
                                <option>Bangkok</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" name="zipcode">
                    </div>
                </div>
            </div>
            <!-- /row-->
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Địa chỉ chi tiết</label>
                        <input type="text" class="form-control" name="address" placeholder="An Khánh, Hoài Đức, Hà Nội...">
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
        placeholder: 'Write here your description....',
        tabsize: 2,
        height: 200
      });
    </script>
    <script>
        const cloneFile = (e) => {
          fileForm = $(".multi-file-images").eq(0).clone();
          fileForm.find('input').val("");
          fileForm.find('.custom-file-label').text("Chọn ảnh");
          fileForm.insertBefore($(e));
        }

        $(function(){
          $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
          });
        });
    </script>
@endsection