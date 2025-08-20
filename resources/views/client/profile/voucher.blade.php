@extends('client.profile.profile_base')
@section('page_title', 'Voucher của tôi')
@section('content_profile')
    <div class="profile-content-header">
        <h3>Voucher của bạn</h3>
    </div>

    <div class="voucher-container">
        @forelse($vouchers as $voucher)
            @php
                $endDate = $voucher->end_date ? \Carbon\Carbon::parse($voucher->end_date) : null;
                $isExpired = $endDate && $endDate->isPast();
                $isUsed = in_array($voucher->id, $usedVoucherIds);

                $statusClass = 'available';
                $statusText = 'Còn hiệu lực';
                $bannerClass = 'banner-available';

                if ($isExpired) {
                    $statusClass = 'expired';
                    $statusText = 'Hết hạn';
                    $bannerClass = 'banner-expired';
                } elseif ($isUsed) {
                    $statusClass = 'used';
                    $statusText = 'Đã dùng';
                    $bannerClass = 'banner-used';
                }

                $canUse = !$isExpired && !$isUsed;
            @endphp

            <div class="voucher-card {{ $statusClass }}">
                <div class="voucher-banner {{ $bannerClass }}">
                    <span class="discount-value">
                        @if ($voucher->discount_type == 'percentage')
                            {{ rtrim(rtrim($voucher->discount_value, '0'), '.') }}%
                        @else
                            {{ number_format($voucher->discount_value, 0, ',', '.') }}đ
                        @endif
                    </span>
                    <span class="voucher-type">GIẢM GIÁ</span>
                </div>
                <div class="voucher-details">
                    <div class="voucher-code-wrapper">
                        <span class="voucher-label">Mã:</span>
                        <strong class="voucher-code">{{ $voucher->code }}</strong>
                        <button class="copy-code-btn" data-code="{{ $voucher->code }}" title="Sao chép mã">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <p class="voucher-description">
                        Đơn tối thiểu {{ number_format($voucher->min_order_value ?? 0, 0, ',', '.') }}đ.
                        @if ($voucher->max_discount_value)
                            Giảm tối đa {{ number_format($voucher->max_discount_value, 0, ',', '.') }}đ.
                        @endif
                    </p>
                     <p class="voucher-scope">
                        @if ($voucher->brands->isNotEmpty())
                            <i class="fas fa-tag"></i> Áp dụng cho thương hiệu: {{ $voucher->brands->pluck('name')->join(', ') }}
                        @elseif($voucher->categories->isNotEmpty())
                           <i class="fas fa-tag"></i> Áp dụng cho danh mục: {{ $voucher->categories->pluck('name')->join(', ') }}
                        @else
                           <i class="fas fa-check-circle"></i> Áp dụng cho tất cả sản phẩm
                        @endif
                    </p>
                    <p class="voucher-expiry">
                        <i class="far fa-calendar-alt"></i> HSD:
                        @if ($endDate)
                            {{ $endDate->format('d/m/Y') }}
                        @else
                            Không giới hạn
                        @endif
                    </p>
                    <div class="voucher-actions">
                        @if ($canUse)
                            <a href="{{ route('client.view-cart') }}?voucher_code={{ $voucher->code }}" class="btn btn-primary btn-use-voucher">
                                Áp dụng ngay
                            </a>
                        @else
                             <span class="voucher-status-text {{ $statusClass }}">{{ $statusText }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-voucher-state">
                <img src="https://via.placeholder.com/150/f0f2f5?text=No+Voucher" alt="Không có voucher"
                    class="empty-voucher-img">
                <p>Bạn chưa có voucher nào.</p>
                <p>Hãy theo dõi các chương trình khuyến mãi của chúng tôi để nhận voucher mới!</p>
                <a href="{{ url('/promotions') }}" class="btn btn-primary">Xem khuyến mãi</a>
            </div>
        @endforelse
    </div>
@endsection
<style>
    /* --- Voucher Section Styles --- */
    .profile-content-header {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .profile-content-header h3 {
        margin: 0;
        font-size: 1.8em;
        color: #333;
        font-weight: 600;
    }

    .voucher-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    /* Base Voucher Card Styling */
    .voucher-card {
        display: flex;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        /* Đảm bảo mọi thứ bên trong card không tràn ra ngoài */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #e0e0e0;
    }

    .voucher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    /* Left Banner of Voucher Card */
    .voucher-banner {
        flex-shrink: 0;
        /* Không co lại */
        width: 136px;
        /* Tăng chiều rộng của phần banner */
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        /* Blue gradient */
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 8px 5px;
        position: relative;
        font-weight: bold;
        text-align: center;
    }

    /* Dotted separator effect */
    .voucher-banner::after {
        content: '';
        position: absolute;
        right: -10px;
        /* Vị trí ranh giới */
        top: 0;
        bottom: 0;
        width: 20px;
        background: radial-gradient(circle at 0 10px, transparent 10px, #f0f2f5 10px) 0 0 / 100% 20px repeat-y;
        filter: drop-shadow(0 0 1px rgba(0, 0, 0, 0.1));
        /* Tạo hiệu ứng bóng đổ nhẹ cho các chấm */
    }

    .voucher-banner .discount-value {
        font-size: 1.6em;
        line-height: 1;
        margin-bottom: 2px;
        word-break: break-word;
        text-align: center;
        max-width: 100%;
    }

    .voucher-banner .voucher-type {
        font-size: 0.7em;
        text-transform: uppercase;
        letter-spacing: 0.2px;
        opacity: 0.9;
        text-align: center;
    }

    /* Right Details of Voucher Card */
    .voucher-details {
        flex-grow: 1;
        /* Chiếm hết phần không gian còn lại */
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .voucher-details p {
        margin: 4px 0;
        color: #555;
        font-size: 0.9em;
    }

    .voucher-details .voucher-code-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .voucher-details .voucher-label {
        font-weight: 600;
        color: #333;
        margin-right: 8px;
    }

    .voucher-details .voucher-code {
        font-weight: bold;
        color: #e67e22;
        /* Orange color for code */
        background-color: #fffaf0;
        /* Light background for code */
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px dashed #f39c12;
        font-size: 1.1em;
    }

    .voucher-details .copy-code-btn {
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        font-size: 1.1em;
        margin-left: 10px;
        transition: color 0.2s ease;
    }

    .voucher-details .copy-code-btn:hover {
        color: #0056b3;
    }

    .voucher-details .voucher-description {
        font-size: 0.85em;
        color: #666;
        line-height: 1.4;
        margin-bottom: 12px;
    }

    .voucher-details .voucher-expiry {
        font-size: 0.8em;
        color: #777;
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .voucher-details .voucher-expiry i {
        margin-right: 8px;
        color: #999;
    }

    .voucher-details .voucher-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px dashed #eee;
    }

    .voucher-details .voucher-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85em;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
    }

    /* Status colors */
    .voucher-status.available {
        background-color: #28a745;
        /* Green */
    }

    .voucher-status.used {
        background-color: #6c757d;
        /* Gray */
    }

    .voucher-status.expired {
        background-color: #dc3545;
        /* Red */
    }

    .voucher-status-text {
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 20px;
        color: white;
    }
    .voucher-status-text.available {
        background-color: #28a745; /* Green */
    }
    .voucher-status-text.used {
        background-color: #6c757d; /* Gray */
    }
    .voucher-status-text.expired {
        background-color: #dc3545; /* Red */
    }

    .banner-available {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); /* Blue */
    }
    .banner-used {
        background: linear-gradient(135deg, #a0a0a0 0%, #707070 100%); /* Gray */
    }
    .banner-expired {
        background: linear-gradient(135deg, #d4a3a8 0%, #a3595f 100%); /* Red-ish */
    }

    .voucher-card.used .voucher-details,
    .voucher-card.expired .voucher-details {
        opacity: 0.7;
    }

    .voucher-scope i {
        margin-right: 5px;
        color: #555;
    }

    /* Button style */
    .btn-use-voucher {
        padding: 8px 16px;
        background-color: #007bff;
        /* Blue */
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9em;
        font-weight: 600;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .btn-use-voucher:hover:not(:disabled) {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .btn-use-voucher:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Styling for used/expired vouchers */
    .voucher-card.used .voucher-banner,
    .voucher-card.expired .voucher-banner {
        background: linear-gradient(135deg, #a0a0a0 0%, #707070 100%);
        /* Gray gradient */
    }

    .voucher-card.used .voucher-details,
    .voucher-card.expired .voucher-details {
        opacity: 0.7;
        /* Làm mờ các chi tiết */
    }

    /* Empty Voucher State */
    .empty-voucher-state {
        text-align: center;
        padding: 50px 20px;
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-top: 30px;
    }

    .empty-voucher-state .empty-voucher-img {
        max-width: 150px;
        height: auto;
        margin-bottom: 20px;
        opacity: 0.8;
    }

    .empty-voucher-state p {
        font-size: 1.1em;
        color: #555;
        margin-bottom: 10px;
    }

    .empty-voucher-state p:last-of-type {
        margin-bottom: 25px;
    }

    .empty-voucher-state .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }

    .empty-voucher-state .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .voucher-container {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            /* Giảm kích thước minmax */
        }
    }

    @media (max-width: 768px) {
        .voucher-container {
            grid-template-columns: 1fr;
            /* Một cột trên màn hình nhỏ hơn */
            padding: 0;
        }

        .voucher-card {
            flex-direction: column;
            /* Xếp chồng banner và details */
            text-align: center;
        }

        .voucher-banner {
            width: 100%;
            height: 70px;
            /* Giảm chiều cao cho banner trên mobile */
            flex-direction: row;
            /* Để banner ngang */
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        .voucher-banner .discount-value {
            font-size: 1.6em;
            margin-right: 10px;
            margin-bottom: 0;
        }

        .voucher-banner .voucher-type {
            font-size: 0.8em;
        }

        .voucher-banner::after {
            content: none;
            /* Bỏ hiệu ứng chấm */
        }

        .voucher-details {
            padding: 12px;
            align-items: center;
            /* Căn giữa nội dung */
            text-align: center;
        }

        .voucher-details .voucher-code-wrapper {
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }

        .voucher-details .voucher-code-wrapper .copy-code-btn {
            margin-left: 0;
            margin-top: 5px;
        }

        .voucher-details .voucher-expiry {
            justify-content: center;
        }

        .voucher-details .voucher-actions {
            flex-direction: column;
            gap: 15px;
        }

        .btn-use-voucher {
            width: 100%;
            /* Nút chiếm toàn bộ chiều rộng */
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.copy-code-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const code = this.getAttribute('data-code');
            // Sử dụng Clipboard API nếu có
            if (navigator.clipboard) {
                navigator.clipboard.writeText(code).then(() => {
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 1200);
                });
            } else {
                // Fallback cho trình duyệt cũ
                const tempInput = document.createElement('input');
                tempInput.value = code;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                this.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-copy"></i>';
                }, 1200);
            }
        });
    });
});
</script>
