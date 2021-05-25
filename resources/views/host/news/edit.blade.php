@extends('layouts.host.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="{{ asset('admin/js/editor/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Thông tin về Tour du lịch</a>
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
    <form action="{{ route('host.news.update', $event->id) }}" method="post" enctype="multipart/form-data" class="container">
        @method('PUT')
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-file"></i>Tin tức</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Please enter title..."
                               name="title" id="title" value="{{ $event->title }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="author">Author<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Please enter author..."
                               name="author" id="author" value="{{ $event->author}}"  required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="tour-avatar">Ảnh chính <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file preview-image" id="tour-avatar"
                                       data-target="#tour-avatar-image" placeholder="Ảnh avatar"
                                       name="avatar" />
                            </div>
                            <div>
                                <img src="{{ $event->avatar_url }}" width="130px" id="tour-avatar-image" />
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
                            {!! session()->get('event')->description ?? old('description') !!}
                        </textarea>
                        {{ $event->description }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_general-->
        <p>
            <button type="submit" class="btn_1 medium" @if(session()->has('tour')) disabled @endif>Lưu</button>
            <a title="Quay lại" href="{{ url()->previous() }}" class="btn_1 medium gray">
                Quay lại
            </a>
        </p>
    </form>
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker.js') }}"></script>
    <!-- WYSIWYG Editor -->
    <script src="{{ asset('admin/js/editor/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/front/moment.min.js') }}"></script>
    <script src="{{ asset('tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
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
            height: 250
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
            fileForm = $(".tour-attractions").attr('hidden', false);
            fileForm.insertBefore($(e));
        }

        function clearForm(e) {
            if ($('.tour-attractions').length > 1) {
                $(e).prev().prev('.tour-attractions').remove();
            }
        }

        $('.edit-info').on('click', function () {
            $('#editInfoModalCenter form').attr('action', $(this).attr('data-action'));
            $('#editInfoModalCenter input[name=limit_time]').val($(this).attr('data-limit-time'));
            $('#editInfoModalCenter input[name=start_time]').val($(this).attr('data-start-time'));
            $('#editInfoModalCenter input[name=vehicle_info]').val($(this).attr('data-vehicle'));
            $('#editInfoModalCenter input[name=order_number]').val($(this).attr('data-order-number'));
            $('#editInfoModalCenter #tour-attraction-edit').val($(this).attr('data-attraction-id'));
            $('#editInfoModalCenter #tour-accommodation-edit').val($(this).attr('data-accommodation-id'));
        });

        $('.create-tour-info').on('click', function () {
            $('#infoModalCenter form').attr('action', $(this).attr('data-action'));
        });

        $('input[name="price"]').keyup(function (e) {
            var x = numberWithCommas((e.target.value.toString()).replaceAll('.',''));
            $(this).val(x);
        });

        $(function () {
            $('#start-time').datetimepicker({
                format: 'HH:mm',
                stepping: 15
            });
        });

        $(document).on('click', '#removeInfo', function () {
            var id = $(this).data('id');
            var url = '{{ Illuminate\Support\Facades\URL::to('/') }}' + '/host/tour-infos/' + id;
            $('#form-remove-tour-info').attr('action', url);
        });
    </script>
@endsection
