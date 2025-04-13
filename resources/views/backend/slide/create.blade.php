@extends('backend.layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-dark"
                                href="{{ route('slide.index') }}?page={{ request()->get('page') }}">Slides</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm</li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">Tạo Slide Mới</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('slides.store') }}?page={{ request()->get('page') }}" method="POST"
                    enctype="multipart/form-data" class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Thông Tin Slide</h5>
                    </div>
                    <div class="card-body p-4">
                        @csrf

                        {{-- Tiêu đề --}}
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Tiêu đề <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg"
                                placeholder="Nhập tiêu đề" value="{{ old('title') }}" required />
                            @if ($errors->has('title'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" id="description" class="form-control" rows="4" maxlength="255"
                                placeholder="Nhập mô tả">{{ old('description') }}</textarea>

                            @if ($errors->has('description'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>

                        {{-- Link --}}
                        <div class="mb-4">
                            <label for="link" class="form-label fw-bold">Link chuyển hướng</label>
                            <input type="url" name="link" id="link" class="form-control"
                                placeholder="Nhập link (nếu có)" value="{{ old('link') }}" />
                            @if ($errors->has('link'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                        </div>

                        {{-- Hình ảnh --}}
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Hình ảnh <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                required />
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail d-none"
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
                        <a href="{{ route('slide.index') }}?page={{ request()->get('page') }}"
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

@push('scripts')
    <script>
        // Hiển thị preview ảnh khi chọn
        document.getElementById("image").addEventListener("change", function() {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById("imagePreview");
                preview.src = URL.createObjectURL(file);
                preview.classList.remove("d-none");
            }
        });
    </script>
@endpush
