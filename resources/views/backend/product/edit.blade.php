@extends('backend.layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-dark"
                                href="{{ route('product.index') }}?page={{ request()->get('page') }}">
                                Sản Phẩm
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Chỉnh Sửa #{{ $product->product_id }}
                        </li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0">Cập Nhật Sản Phẩm</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('product.update', $product->product_id) }}?page={{ request()->get('page') }}"
                    method="POST" enctype="multipart/form-data" class="card shadow">
                    @csrf
                    @method('PUT')

                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Thông Tin Sản Phẩm</h5>
                    </div>

                    <div class="card-body p-4">
                        {{-- Name --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                value="{{ old('name', $product->name) }}" required />
                            @if ($errors->has('name'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            {{-- Price --}}
                            <div class="col-md-6 mb-4">
                                <label for="price" class="form-label fw-bold">Giá <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="{{ old('price', $product->price) }}" required step="0.01"
                                        min="0" />
                                </div>
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Category --}}
                            <div class="col-md-6 mb-4">
                                <label for="category_id" class="form-label fw-bold">Danh Mục <span
                                        class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('category_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Hình Ảnh</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
                            @if ($product->image)
                                <div class="mt-2 old-image">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image"
                                        class="img-thumbnail" style="max-height:200px;">
                                    <p class="text-muted">(Giữ nguyên nếu không chọn ảnh mới)</p>
                                </div>
                            @endif

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

                        <!-- featured -->
                        <div class="mb-4">
                            <label for="featured" class="form-label fw-bold">Nổi bật</label>
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input type="hidden" name="is_featured" value="0" />
                                <input type="checkbox" name="is_featured" id="featured" class="form-check-input"
                                    value="1" {{ old('is_featured', $product->is_featured ?? 0) ? 'checked' : '' }} />
                                <label for="featured" class="form-check-label">Nổi bật</label>
                            </div>
                            @if ($errors->has('is_featured'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('is_featured') }}
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
        document.getElementById("image").addEventListener("change", function() {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById("imagePreview");
                const oldImage = document.querySelector(".old-image");
                preview.src = URL.createObjectURL(file);
                preview.classList.remove("d-none");

                // Ẩn ảnh cũ nếu có
                if (oldImage) {
                    oldImage.classList.add("d-none");
                }
            }
        });
    </script>
@endpush
