@extends('layouts.admin.app')

@section('style')
    <link href="{{ asset('admin/vendor/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Danh mục</a>
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
    <form action="{{ route('admin.categories.store') }}" method="post" class="container">
        @csrf
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-home"></i>Thêm danh mục</h2>
            </div>
            <!-- /row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name-category">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name"
                               id="name-category" value="{{ old('name') }}" required/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="type-category">Kiểu danh mục</label>
                        <div class="styled-select">
                            <select name="type" id="type-category" required>
                                <option selected disabled>Chọn kiểu</option>
                                @foreach(\App\Enums\CatType::asArray() as $type)
                                    <option value="{{ $type }}" {{ (old('type') == $type) ? 'selected' : '' }}>
                                        @if(\App\Enums\CatType::OTHER == $type)
                                            Khác
                                        @elseif(\App\Enums\CatType::COORDINATION == $type)
                                            Điều phối
                                        @elseif(\App\Enums\CatType::TOURISM == $type)
                                            Loại hình du lịch
                                        @elseif(\App\Enums\CatType::REST == $type)
                                            Loại nơi ở
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="parent-category">Danh mục cha</label>
                        <div class="styled-select">
                            <select name="parent_id" id="parent-category" required>
                                <option selected disabled>Chọn danh mục cha</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (old('parent_id') == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
@endsection
