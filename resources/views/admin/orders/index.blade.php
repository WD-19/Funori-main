@extends('admin.layout.admin')
@section('title', 'Danh sách đơn hàng')
@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <div>
                    <h3>Danh sách đơn hàng</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10 mt-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Bảng điều khiển</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Danh sách đơn hàng</div>
                        </li>
                    </ul>
                </div>
                {{-- Nút bật bộ lọc --}}
                {{-- <div class="mb-3">
                    <button type="button" onclick="toggleOrderFilter()"
                        class="btn btn-outline-primary flex items-center gap-1 px-3 py-1 rounded-md"
                        style="color: #f59e0b; border: 1px solid #f59e0b; hover: border-color: #f59e0b; background-color: #fff;">
                        <i class="icon-filter"></i>
                        <span>Lọc đơn hàng</span>
                    </button>
                </div> --}}
                {{-- FORM LỌC - Ẩn mặc định --}}

                <div id="order-filter-form" class="hidden">
                    <form method="get" action="{{ route('admin.orders.index') }}" class="flex flex-wrap gap-4 items-end">
                        <!-- Tìm kiếm -->
                        <div class="form-group" style="min-width:220px;">
                            <label class="body-title" for="q">Tìm kiếm</label>
                            <input type="text" id="q" name="q" value="{{ request('q') }}"
                                placeholder="Mã đơn, tên khách, SĐT..." class="input-field"
                                style="height:40px; font-size:15px;">
                        </div>
                        <!-- Trạng thái --> 
                        <div class="form-group" style="margin-left:32px;">
                            <label class="body-title" for="status">Trạng thái</label>
                            <select id="status" name="status" class="form-select" style="min-width:200px; height:44px;">
                                <option value="">-- Tất cả --</option>
                                <option value="pending_confirmation" @selected(request('status') == 'pending_confirmation')>Chờ xử lý</option>
                                <option value="processing" @selected(request('status') == 'processing')>Đang xử lý</option>
                                <option value="shipped" @selected(request('status') == 'shipped')>Đang giao hàng</option>
                                <option value="delivered" @selected(request('status') == 'delivered')>Đã giao</option>
                                <option value="cancelled" @selected(request('status') == 'cancelled')>Đã hủy</option>
                                <option value="returned" @selected(request('status') == 'returned')>Đã trả hàng</option>
                            </select>
                        </div>
                        <!-- Vận chuyển -->
                        <div class="form-group shipping-group">
                            <label class="body-title" for="shipping_method_id">Vận chuyển</label>
                            <select id="shipping_method_id" name="shipping_method_id" class="form-select shipping-select"
                                style="height:44px; min-width:200px;">
                                <option value="">-- Tất cả --</option>
                                <option value="1" @selected(request('shipping_method_id') == '1')>Giao hàng tiêu chuẩn</option>
                                <option value="2" @selected(request('shipping_method_id') == '2')>Giao hàng nhanh</option>
                                <option value="3" @selected(request('shipping_method_id') == '3')>Nhận tại cửa hàng</option>
                            </select>
                        </div>
                        <!-- Ngày đặt hàng từ -->
                        <div class="form-group">
                            <label class="body-title" for="start_date">Từ ngày</label>
                            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                                class="input-field" style="min-width:160px; height:40px; font-size:15px;"onchange="validateDateRange()">
                        </div>
                        <!-- Ngày đặt hàng đến -->
                        <div class="form-group">
                            <label class="body-title" for="end_date">Đến ngày</label>
                            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                                class="input-field" style="min-width:160px; height:40px; font-size:15px;"onchange="validateDateRange()">
                        </div>
                        <!-- Nút tìm kiếm và đặt lại -->
                        <div class="form-group icon-group"
                            style="margin-left:auto; flex-direction: row; align-items: flex-end; gap: 12px; padding-bottom:4px;">
                            <button type="submit" class="btn-search"
                                style="margin-bottom:0; min-width:110px; font-size:15px; height:40px;">
                                <i class="fa fa-search"></i> Tìm
                            </button>
                            <a href="{{ route('admin.orders.index') }}" class="btn-reset"
                                style="margin-bottom:0; min-width:110px; font-size:13px; height:40px;">
                                <i class="fa fa-refresh"></i> Đặt lại
                            </a>
                        </div>
                    </form>
                </div>

                {{-- SCRIPT --}}
                {{-- <script>
                    function toggleOrderFilter() {
                        const filter = document.getElementById('order-filter-form');
                        filter.classList.toggle('hidden');
                    }
                </script> --}}
            </div>
            <div class="wg-box">
                <div class="wg-table table-all-category mt-2">
                    <ul class="table-title flex gap10 mb-14" style="background:#f3f4f6; padding: 10px 12px;">
                        <li style="width: 30px; text-align: center; flex-shrink: 0;">
                            <div class="body-title">STT</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Mã đơn</div>
                        </li>

                        <li style="min-width: 100px; padding-left: 10px;">
                            <div class="body-title">Giá trị</div>
                        </li>

                        <li style="min-width: 180px; padding-left: 10px;">
                            <div class="body-title">Khách hàng</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Ngày đặt</div>
                        </li>

                        {{-- <li style="min-width: 100px; padding-left: 10px;">
                            <div class="body-title">Hình thức</div>
                        </li> --}}

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Vận chuyển</div>
                        </li>

                        <li style="min-width: 140px; padding-left: 10px;">
                            <div class="body-title">🚛 Shipper</div>
                        </li>

                        <li style="min-width: 120px; padding-left: 10px;">
                            <div class="body-title">Trạng thái</div>
                        </li>

                        <li style="min-width: 50px; padding-left: 10px;">
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>

                    <ul class="flex flex-column">
                        @forelse($orders as $order)
                            <li class="wg-product item-row "
                                style="display: flex; align-items:center; border-bottom:1px solid #eee; padding: 12px;">
                                <div class="body-text text-main-dark"
                                    style="width: 30px; text-align: center; flex-shrink: 0;">
                                    {{ $orders->firstItem() + $loop->index }}
                                </div>
                                <div class="body-text text-main-dark" style="min-width:120px; padding-left: 10px;">
                                    {{ $order->order_code }}
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 100px; padding-left: 10px;">
                                    {{ number_format($order->total_amount, 0, ',', '.') }}₫
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 180px; padding-left: 10px;">
                                    <div>{{ $order->buyer_name ?? $order->shipping_name }}</div>
                                    <div class="text-xs" style="color: #2563eb; font-weight: 500;">
                                        {{ $order->buyer_phone ?? $order->shipping_phone }}
                                    </div>
                                    @if ($order->buyer_name && $order->shipping_name && $order->buyer_name != $order->shipping_name)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Ship to: {{ $order->shipping_name }}
                                            (<span
                                                style="color: #2563eb; font-weight: 500;">{{ $order->shipping_phone }}</span>)
                                        </div>
                                    @endif
                                </div>
                                <div class="body-text text-main-dark" style="min-width: 120px; padding-left: 10px;">
                                    {{ optional($order->created_at)->format('d/m/Y H:i') }}
                                </div>
                                {{-- <div class="body-text text-main-dark" style="min-width: 100px; padding-left: 10px;">
                                    {{ optional($order->paymentMethod)->name ?? 'Không có' }}
                                </div> --}}
                                <div class="body-text text-main-dark" style="min-width: 120px; padding-left: 10px;">
                                    {{ optional($order->shippingMethod)->name ?? 'Không có' }}
                                </div>
                                
                                <!-- Cột Shipper -->
                                <div class="body-text text-main-dark" style="min-width: 140px; padding-left: 10px;">
                                    @if($order->shipper)
                                        <div class="flex items-center gap-2">
                                            <div style="width:24px;height:24px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:10px;">
                                                {{ strtoupper(substr($order->shipper->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="text-sm fw-6">{{ $order->shipper->name }}</div>
                                                <div class="text-xs" style="color: {{ $order->shipper->status === 'active' ? '#22C55E' : '#F59E0B' }};">
                                                    {{ $order->shipper->status === 'active' ? 'Hoạt động' : 'Tạm ngưng' }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <div style="color: #F59E0B; font-size: 20px;">📦</div>
                                            <div class="text-xs" style="color: #92400E;">Chưa gán</div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div style="min-width:120px; padding-left: 10px;">
                                    @if ($order->order_status === 'delivered')
                                        <span class="block-available bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã giao</span>
                                    @elseif($order->order_status === 'pending' || $order->order_status === 'pending_confirmation')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Chờ
                                            xử lý</span>
                                    @elseif($order->order_status === 'pending_cancellation')
                                        <span class="block-pending fw-7"
                                            style="background:#ef4444;color:#fff;padding:2px 8px;border-radius:6px;">Chờ
                                            hủy</span>
                                    @elseif($order->order_status === 'cancelled')
                                        <span class="block-pending bg-1 fw-7"
                                            style="background:#f87171;padding:2px 8px;border-radius:6px;">Đã hủy</span>
                                    @elseif($order->order_status === 'processing')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đang xử lý</span>
                                    @elseif($order->order_status === 'shipped')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã gửi hàng</span>
                                    @elseif($order->order_status === 'assigned')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã phân công</span>
                                    @elseif($order->order_status === 'received')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã nhận hàng</span>
                                    @elseif($order->order_status === 'in_delivery')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đang giao</span>
                                    @elseif($order->order_status === 'failed')
                                        <span class="block-pending fw-7"
                                            style="background:#ef4444;color:#fff;padding:2px 8px;border-radius:6px;">Giao thất bại</span>
                                    @elseif($order->order_status === 'returned')
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã
                                            trả hàng</span>
                                    @else
                                        <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">
                                            {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                                        </span>
                                    @endif
                                    
                                    <!-- Delivery Info -->
                                                                        @if(in_array($order->order_status, ['received', 'in_delivery', 'delivered', 'failed']))
                                    <div class="mt-2">
                                        @if($order->delivery_images)
                                        <small class="text-info d-block">
                                            <i class="icon-image"></i> {{ count(is_array($order->delivery_images) ? $order->delivery_images : json_decode($order->delivery_images, true) ?? []) }} ảnh
                                        </small>
                                        @endif
                                        <button onclick="openDeliveryModal('{{ $order->id }}')" class="btn btn-sm btn-info mt-2">
                                            <i class="icon-eye"></i> Xem chi tiết
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <div class="list-icon-function justify-content-center" style="padding-left: 10px;">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="item eye"
                                        title="View"><i class="icon-eye"></i></a>
                                </div>
                            </li>

                        @empty

                            <li>
                                <div class="body-text text-center py-4">Không tìm thấy đơn hàng nào.</div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $orders->firstItem() ?? 0 }} đến {{ $orders->lastItem() ?? 0 }} của
                        {{ $orders->total() }} đơn hàng
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            @if ($orders->onFirstPage())
                                <span><i class="icon-chevron-left"></i></span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                            @endif
                        </li>
                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            <li class="{{ $page == $orders->currentPage() ? 'active' : '' }}">
                                <a
                                    href="{{ $page == $orders->currentPage() ? 'javascript:void(0);' : $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li>
                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
                            @else
                                <span><i class="icon-chevron-right"></i></span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
    function validateDateRange() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        const start = new Date(startDateInput.value);
        const end = new Date(endDateInput.value);

        if (startDateInput.value && endDateInput.value && end < start) {
            alert('Ngày đến không được nhỏ hơn ngày bắt đầu.');
            endDateInput.value = startDateInput.value; // Reset về ngày bắt đầu
        }
    }
</script>
    <style>
        #order-filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-end;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 100%;
            min-width: 100%;
            box-sizing: border-box;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            min-width: 200px;
            flex: 1;
            max-width: 300px;
            justify-content: center;
        }

        .body-title {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 15px;
            color: #374151;
        }

        .input-field,
        .form-select {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            width: 100%;
            height: 40px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .input-field:focus,
        .form-select:focus {
            border-color: #f59e0b;
            outline: none;
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.5);
        }

        .btn-search,
        .btn-reset {
            height: 40px;
            padding: 0 20px;
            border-radius: 6px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 15px;
            justify-content: center;
            min-width: 110px;
        }

        .btn-search {
            background-color: #f59e0b;
            color: #fff;
            border: none;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-search:hover {
            background-color: #fbbf24;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-reset {
            background-color: #fff;
            color: #374151;
            border: 1px solid #ccc;
            transition: background-color 0.3s, border-color 0.3s;
            font-size: 16px;
        }

        .btn-reset:hover {
            background-color: #f9fafb;
            border-color: #999;
        }

        .form-group.icon-group {
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            min-width: unset;
            max-width: unset;
            margin-bottom: 0;
            gap: 12px;
            padding-bottom: 4px;
        }

        .form-group.shipping-group {
            max-width: 260px;
            min-width: 200px;
        }

        .form-select.shipping-select {
            min-width: 200px !important;
            max-width: 260px !important;
        }
    </style>
<!-- Simple Delivery Modal -->
<div id="deliveryModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border-radius: 10px; min-width: 500px; max-width: 800px; max-height: 80vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <h3 style="margin: 0; font-size: 18px; font-weight: bold;">Thông tin giao hàng</h3>
            <button onclick="closeDeliveryModal()" style="background: none; border: none; font-size: 20px; cursor: pointer; color: #666;">&times;</button>
        </div>
        <div id="deliveryModalContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
function openDeliveryModal(orderId) {
    // Show modal
    document.getElementById('deliveryModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
    document.getElementById('deliveryModalContent').innerHTML = '<div style="text-align: center; padding: 20px;"><p>Đang tải...</p></div>';
    
    // Fetch delivery info
    fetch(`/admin/orders/${orderId}/delivery-info`)
        .then(response => response.json())
        .then(data => {
            let content = `<h4 style="margin-bottom: 15px;">Đơn hàng: ${data.order_code}</h4>`;
            
            // Delivery Timestamps
            content += `<div style="margin-bottom: 20px;"><h5 style="margin-bottom: 10px; color: #333;">Thời gian cập nhật:</h5>`;
            
            if (data.received_at) {
                content += `<p style="margin: 5px 0; padding: 8px; background: #f0f9ff; border-left: 3px solid #3b82f6;"><strong>Đã nhận hàng:</strong> ${data.received_at}</p>`;
            }
            
            if (data.in_delivery_at) {
                content += `<p style="margin: 5px 0; padding: 8px; background: #f0f9ff; border-left: 3px solid #3b82f6;"><strong>Bắt đầu giao:</strong> ${data.in_delivery_at}</p>`;
            }
            
            if (data.delivered_at) {
                content += `<p style="margin: 5px 0; padding: 8px; background: #f0fff4; border-left: 3px solid #10b981;"><strong>Giao thành công:</strong> ${data.delivered_at}</p>`;
            }
            
            if (data.failed_at) {
                content += `<p style="margin: 5px 0; padding: 8px; background: #fef2f2; border-left: 3px solid #ef4444;"><strong>Giao thất bại:</strong> ${data.failed_at}</p>`;
            }
            
            content += '</div>';
            
            // Delivery Notes
            if (data.delivery_notes) {
                content += `<div style="margin-bottom: 20px;"><h5 style="margin-bottom: 10px; color: #333;">Ghi chú giao hàng:</h5><p style="padding: 10px; background: #f0f9ff; border-left: 3px solid #3b82f6;">${data.delivery_notes}</p></div>`;
            }
            
            // Failure Reason
            if (data.failure_reason) {
                content += `<div style="margin-bottom: 20px;"><h5 style="margin-bottom: 10px; color: #333;">Lý do thất bại:</h5><p style="padding: 10px; background: #fef2f2; border-left: 3px solid #ef4444; color: #dc2626;">${data.failure_reason}</p></div>`;
            }
            
            // Delivery Images
            if (data.delivery_images) {
                content += `<div style="margin-bottom: 20px;"><h5 style="margin-bottom: 10px; color: #333;">Ảnh giao hàng:</h5>`;
                
                const images = Array.isArray(data.delivery_images) ? data.delivery_images : JSON.parse(data.delivery_images);
                images.forEach((image, index) => {
                    content += `<div style="margin: 10px 0;"><img src="${image}" alt="Delivery Image" style="max-width: 100%; height: 200px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;"><p style="text-align: center; margin-top: 5px; font-size: 12px; color: #666;">Ảnh ${index + 1}</p></div>`;
                });
                
                content += '</div>';
            }
            
            document.getElementById('deliveryModalContent').innerHTML = content;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('deliveryModalContent').innerHTML = '<div style="text-align: center; padding: 20px; color: red;"><p>Lỗi khi tải thông tin</p></div>';
        });
}

function closeDeliveryModal() {
    document.getElementById('deliveryModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('deliveryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeliveryModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeliveryModal();
    }
});
</script>

@endsection
