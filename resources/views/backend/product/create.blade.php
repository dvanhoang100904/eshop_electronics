@extends('backend.layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark"
                                href="{{ route('product.index') }}?page={{ request()->get('page') }}">Sản Phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm</li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">Tạo Sản Phẩm Mới</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('product.store') }}?page={{ request()->get('page') }}" method="POST"
                    enctype="multipart/form-data" class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Thông Tin Sản Phẩm</h5>
                    </div>
                    <div class="card-body p-4">
                        @csrf

                        <!-- name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                required placeholder="Nhập tên sản phẩm" value="{{ old('name') }}" />
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

                        <div class="row">
                            <!-- price -->
                            <div class="col-md-6 mb-4">
                                <label for="price" class="form-label fw-bold">Giá <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="price" id="price" class="form-control" required
                                        placeholder="0.00" step="0.01" min="0" value="{{ old('price') }}" />
                                </div>
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>

                            <!-- category_id -->
                            <div class="col-md-6 mb-4">
                                <label for="category_id" class="form-label fw-bold">Danh Mục <span
                                        class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- featured -->
                            <div class="mb-4">
                                <label for="featured" class="form-label fw-bold">Nổi bật</label>
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input type="hidden" name="is_featured" value="0" />
                                    <input type="checkbox" name="is_featured" id="featured" class="form-check-input"
                                        value="1" {{ old('is_featured', 0) ? 'checked' : '' }} />
                                    <label for="featured" class="form-check-label">Nổi bật</label>
                                </div>
                                @if ($errors->has('is_featured'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('is_featured') }}
                                    </div>
                                @endif
                            </div>
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
                        <a href="{{ route('product.index') }}?page={{ request()->get('page') }}"
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
