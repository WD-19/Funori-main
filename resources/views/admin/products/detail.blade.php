@extends('admin.layout.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <style>
        .glass-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.92);
            border-radius: 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.10);
            padding: 2rem 1.2rem;
        }

        .img-preview {
            height: 370px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        .img-thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e3e3e3;
            transition: 0.2s;
            cursor: pointer;
        }

        .img-thumb:hover {
            border-color: #0d6efd;
            transform: scale(1.05);
        }

        .badge-modern {
            padding: 10px 22px;
            font-size: 1.25rem;
            /* To hơn */
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.2rem;
            font-size: 1.45rem;
            /* Tăng cỡ chữ */
            min-height: 44px;
        }

        .info-row span:first-child {
            font-weight: 600;
            color: #222;
            min-width: 90px;
            /* hoặc bỏ nếu muốn label co lại */
        }

        .info-row span:last-child {
            color: #444;
        }

        /* Biến thể sản phẩm */
        .variant-box {
            font-size: 1.22rem;
            /* To hơn */
            padding: 1.3rem 1.2rem;
            border-radius: 18px;
            background: #f8f9fa;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.07);
            min-height: 140px;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
        }

        .variant-box img {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            margin-right: 1.1rem;
            border: 1.5px solid #e3e3e3;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .variant-badge {
            background: #fff;
            border: 1px solid #dee2e6;
            color: #222;
            font-size: 1.12rem;
            border-radius: 16px;
            padding: 7px 16px;
            margin-bottom: 0.4rem;
            margin-right: 0.4rem;
            display: inline-block;
        }

        .variant-title {
            font-size: 1.22rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.7rem;
        }

        @media (max-width: 991px) {
            .img-preview {
                height: 180px;
            }

            .info-row {
                font-size: 1rem;
                min-height: 30px;
            }

            .variant-box {
                font-size: 0.97rem;
                padding: 0.7rem;
                min-height: 80px;
            }

            .variant-box img {
                width: 50px;
                height: 50px;
                margin-right: 0.7rem;
            }
        }
    </style>

    <div class="container-fluid py-4">
        <div class="glass-card w-100 mb-5">
            <div class="row align-items-stretch" style="min-height:400px;">
                <!-- Ảnh bên trái -->
                <div class="col-lg-5  mb-lg-0 d-flex flex-column justify-content-center">
                    @if ($product->images->count())
                        <div id="mainCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-4 overflow-hidden">
                                @foreach ($product->images as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($img->image_url) }}" class="d-block w-100 img-preview"
                                            alt="Ảnh">
                                    </div>
                                @endforeach
                            </div>
                            @if ($product->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap justify-content-start gap-3">
                            @foreach ($product->images as $img)
                                <img src="{{ asset($img->image_url) }}" class="img-thumb" alt="Ảnh phụ">
                            @endforeach
                        </div>
                    @else
                        <div class="bg-light text-muted py-5 rounded fs-4 text-center">Không có ảnh</div>
                    @endif
                </div>
                <!-- Thông tin bên phải -->
                <div class="col-lg-7 d-flex flex-column justify-content-between" style="height: 100%;">
                    <div>
                        <h3 class="fw-bold text-dark " style="font-size: 2rem;">{{ $product->name }}</h3>
                        <div class="d-flex flex-wrap gap-3 ">
                            <span
                                class="badge bg-primary badge-modern">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                            <span
                                class="badge bg-dark text-white badge-modern">{{ $product->brand->name ?? 'No Brand' }}</span>
                            <span
                                class="badge
                                @if ($product->status == 'published') bg-success
                                @elseif($product->status == 'draft') bg-warning text-dark
                                @elseif($product->status == 'archived') bg-secondary
                                @else bg-danger @endif badge-modern">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>
                        <div class="info-row"><span>Giá gốc:</span> <span
                                class="text-danger fw-bold fs-3">{{ number_format($product->regular_price, 0, ',', '.') }}
                                đ</span></div>
                        <div class="info-row"><span>Tổng kho:</span> <span
                                class="fw-bold">{{ $product->variants->sum('stock_quantity') }}</span></div>
                        <div class="info-row"><span>Slug:</span> <span class="text-muted">{{ $product->slug }}</span></div>
                        <div class="info-row"><span>Cập nhật:</span>
                            <span>{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mô tả -->
        <div class="glass-card w-100 mb-5">
            <h4 class="fw-bold text-dark mb-3">Mô tả sản phẩm</h4>
            <div class="fs-4">{!! nl2br(e($product->description)) !!}</div>
        </div>

        <!-- Biến thể sản phẩm -->
        @if (isset($product->variants) && count($product->variants))
            <div class="glass-card w-100">
                <h4 class="fw-bold text-dark ">Biến thể sản phẩm</h4>
                <div class="row g-4">
                    @foreach ($product->variants as $variant)
                        <div class="col-md-12 mb-3">
                            <div class="variant-box">
                                <div class="d-flex align-items-center">
                                    @if ($variant->image)
                                        <img src="{{ asset($variant->image->image_url) }}" alt="Ảnh biến thể">
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="variant-title mb-3">
                                            {{ $variant->size ? 'Kích thước: ' . $variant->size : 'Không có kích thước' }}
                                        </div>
                                        <div class="mb-3"><strong>Kho:</strong> {{ $variant->stock_quantity ?? '-' }}
                                        </div>
                                        <div class="text-danger fw-bold mb-3" style="font-size:1.5rem;">
                                            @php $gia = $product->regular_price + $variant->price_modifier; @endphp
                                            {{ number_format($gia, 0, ',', '.') }} đ
                                        </div>
                                        <div>
                                            @if (isset($variant->attributeValues) && count($variant->attributeValues))
                                                @foreach ($variant->attributeValues as $attrVal)
                                                    <span class="variant-badge">
                                                        {{ $attrVal->attribute->name }}: {{ $attrVal->value }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">Không có thuộc tính</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mb-2">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="tf-button w-100 py-3 fs-5">
                <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa
            </a>
        </div>
        <div class="col-md-6 mb-2">
            <a href="{{ route('admin.products.index') }}" class="tf-button style-3 w-100 py-3 fs-5">
                <i class="bi bi-list me-1"></i> Danh sách
            </a>
        </div>
    </div>
@endsection
