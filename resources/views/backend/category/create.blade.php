@extends('backend.layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark"
                                href="{{ route('category.index') }}?page={{ request()->get('page') }}">Danh Mục</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm</li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">Tạo Danh Mục Mới</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('category.store') }}?page={{ request()->get('page') }}" method="POST"
                    enctype="multipart/form-data" class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Thông Tin Danh Mục</h5>
                    </div>
                    <div class="card-body p-4">
                        @csrf

                        <!-- name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                required placeholder="Nhập tên danh mục" value="{{ old('name') }}" />
                            @if ($errors->has('name'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>

                        <!-- image -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Hình Ảnh</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Image preview" class="img-thumbnail d-none"
                                    style="max-height: 200px;">
                            </div>
                            @if ($errors->has('image'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between">
                        <a href="{{ route('category.index') }}?page={{ request()->get('page') }}"
                            class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Quay Lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
