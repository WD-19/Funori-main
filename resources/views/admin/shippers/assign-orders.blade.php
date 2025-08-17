@extends('admin.layout.admin')

@section('title', 'Phân Chia Đơn Hàng')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Phân Chia Đơn Hàng Cho Shipper</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><a href="{{ route('admin.shippers.index') }}"><div class="text-tiny">Shipper</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Phân Chia Đơn Hàng</div></li>
            </ul>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-27">
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-item__content">
                        <h3 class="counter-item__number">{{ $unassignedOrders->count() }}</h3>
                        <div class="counter-item__text">Đơn Chưa Phân Chia</div>
                    </div>
                    <div class="counter-item__icon">
                        <i class="icon-package"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-item__content">
                        <h3 class="counter-item__number">{{ $activeShippers->count() }}</h3>
                        <div class="counter-item__text">Shipper Hoạt Động</div>
                    </div>
                    <div class="counter-item__icon">
                        <i class="icon-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-item__content">
                        <h3 class="counter-item__number">{{ $activeShippers->sum('orders_count') }}</h3>
                        <div class="counter-item__text">Đơn Đang Xử Lý</div>
                    </div>
                    <div class="counter-item__icon">
                        <i class="icon-truck"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-item__content">
                        <h3 class="counter-item__number">{{ $activeShippers->count() > 0 ? round($unassignedOrders->count() / $activeShippers->count()) : 0 }}</h3>
                        <div class="counter-item__text">Đơn/Shipper (TB)</div>
                    </div>
                    <div class="counter-item__icon">
                        <i class="icon-calculator"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="wg-box mb-27">
            <div class="flex items-center justify-between gap20 flex-wrap">
                <h5>Hành Động Nhanh</h5>
                <div class="flex gap10">
                    @if($unassignedOrders->count() > 0 && $activeShippers->count() > 0)
                    <form action="{{ route('admin.shippers.auto-assign') }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Bạn có chắc chắn muốn tự động phân chia {{ $unassignedOrders->count() }} đơn hàng cho {{ $activeShippers->count() }} shipper?')">
                        @csrf
                        <button type="submit" class="tf-button style-1 w208">
                            <i class="icon-zap"></i> Phân Chia Tự Động
                        </button>
                    </form>
                    @endif
                    <a class="tf-button style-3 w208" href="{{ route('admin.shippers.index') }}">
                        <i class="icon-arrow-left"></i> Quay Lại
                    </a>
                </div>
            </div>
        </div>

        <!-- Shipper Status -->
        @if($activeShippers->count() > 0)
        <div class="wg-box mb-27">
            <h5>Trạng Thái Shipper</h5>
            <div class="row">
                @foreach($activeShippers as $shipper)
                <div class="col-lg-4 col-md-6 mb-20">
                    <div class="wg-product item-row" style="border: 1px solid #e5e5e5; border-radius: 8px; padding: 15px;">
                        <div class="flex items-center gap15">
                            <div class="wg-product__image" style="width: 60px; height: 60px; border-radius: 50%; background: {{ $shipper->orders_count >= 5 ? '#ffc107' : '#28a745' }}; display: flex; align-items: center; justify-content: center;">
                                <i class="icon-user" style="color: white; font-size: 24px;"></i>
                            </div>
                            <div class="wg-product__content flex-grow">
                                <h6 class="name" style="margin: 0 0 5px 0; font-weight: 600;">{{ $shipper->name }}</h6>
                                <div class="text-tiny" style="color: #666; margin-bottom: 8px;">{{ $shipper->email }}</div>
                                <div class="flex items-center gap10">
                                    <span class="status-badge" style="background: {{ $shipper->orders_count >= 5 ? '#ffc107' : '#28a745' }}; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                        {{ $shipper->orders_count }} đơn đang xử lý
                                    </span>
                                    @if($shipper->orders_count >= 5)
                                    <span style="color: #ffc107; font-size: 12px;">
                                        <i class="icon-alert-triangle"></i> Quá tải
                                    </span>
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

        <!-- Orders Assignment -->
        @if($unassignedOrders->count() > 0)
        <div class="wg-box">
            <h5>Đơn Hàng Chưa Phân Chia ({{ $unassignedOrders->count() }} đơn)</h5>
            
            <form action="{{ route('admin.shippers.process-assign') }}" method="POST" id="assign-form">
                @csrf
                <div class="table-responsive">
                    <table class="table align-middle table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 60px;" class="text-center">
                                    <input type="checkbox" id="select-all" class="form-check-input">
                                </th>
                                <th style="width: 120px;">Mã Đơn</th>
                                <th style="width: 180px;">Khách Hàng</th>
                                <th style="width: 250px;">Địa Chỉ</th>
                                <th style="width: 120px;" class="text-end">Tổng Tiền</th>
                                <th style="width: 120px;" class="text-center">Trạng Thái</th>
                                <th style="width: 200px;">Phân Chia Cho</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unassignedOrders as $order)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="assignments[{{ $order->id }}][order_id]" 
                                           value="{{ $order->id }}" class="form-check-input order-checkbox">
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">#{{ $order->order_code }}</span>
                                    <br>
                                    <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-semibold">{{ $order->customer_name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $order->customer_phone ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted" title="{{ $order->shipping_address }}">
                                        {{ Str::limit($order->shipping_address, 60) }}
                                    </small>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-success">
                                        {{ number_format($order->total_amount, 0, ',', '.') }}₫
                                    </span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusConfig = [
                                            'pending_confirmation' => ['class' => 'warning', 'text' => 'Chờ xác nhận'],
                                            'confirmed' => ['class' => 'info', 'text' => 'Đã xác nhận'],
                                            'processing' => ['class' => 'primary', 'text' => 'Đang xử lý'],
                                        ];
                                        $config = $statusConfig[$order->order_status] ?? ['class' => 'secondary', 'text' => $order->order_status];
                                    @endphp
                                    <span class="badge bg-{{ $config['class'] }}">{{ $config['text'] }}</span>
                                </td>
                                <td>
                                    <select name="assignments[{{ $order->id }}][shipper_id]" 
                                            class="form-select form-select-sm shipper-select">
                                        <option value="">-- Chọn shipper --</option>
                                        @foreach($activeShippers as $shipper)
                                        <option value="{{ $shipper->id }}" 
                                                data-workload="{{ $shipper->orders_count }}"
                                                class="{{ $shipper->orders_count >= 5 ? 'text-warning' : 'text-success' }}">
                                            {{ $shipper->name }} 
                                            ({{ $shipper->orders_count }} đơn - {{ $shipper->orders_count >= 5 ? 'Bận' : ($shipper->orders_count >= 3 ? 'Vừa' : 'Rảnh') }})
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-4 p-3 bg-light rounded">
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary" id="assign-btn" disabled>
                            <i class="bi bi-check-circle me-2"></i>Phân Chia Đã Chọn
                        </button>
                        <span class="badge bg-info fs-6" id="selected-count">0 đơn được chọn</span>
                    </div>
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        Chọn đơn hàng và shipper, sau đó click "Phân Chia Đã Chọn"
                    </div>
                </div>
            </form>
        </div>
        @else
        <div class="wg-box">
            <div class="text-center py-40">
                <i class="icon-check-circle" style="font-size: 48px; color: #28a745; margin-bottom: 15px;"></i>
                <h5>Không có đơn hàng nào cần phân chia!</h5>
                <p class="text-tiny" style="color: #666;">Tất cả đơn hàng đã được phân chia cho shipper.</p>
                <a href="{{ route('admin.orders.index') }}" class="tf-button style-1 mt-15">
                    <i class="icon-arrow-left"></i> Xem Danh Sách Đơn Hàng
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.counter-item {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
}

.counter-item__number {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.counter-item__text {
    font-size: 14px;
    color: #666;
    margin-top: 5px;
}

.counter-item__icon {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #666;
}

.wg-box {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.alert {
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Table Improvements */
.table {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.table thead th {
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
    vertical-align: middle;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(0,123,255,0.05);
    transform: translateY(-1px);
}

.table tbody td {
    border-left: none;
    border-right: none;
    vertical-align: middle;
    padding: 12px 8px;
}

.form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

/* Status badge improvements */
.bg-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.bg-info {
    background-color: #17a2b8 !important;
}

.bg-primary {
    background-color: #007bff !important;
}

.bg-success {
    background-color: #28a745 !important;
}

/* Shipper select improvements */
.shipper-select option.text-warning {
    background-color: #fff3cd;
    color: #856404;
}

.shipper-select option.text-success {
    background-color: #d4edda;
    color: #155724;
}

/* Action bar improvements */
.bg-light {
    background-color: #f8f9fa !important;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .table-responsive {
        border-radius: 8px;
    }
    
    .d-flex.flex-wrap {
        flex-direction: column;
        align-items: stretch !important;
        gap: 1rem;
    }
    
    .table thead th {
        font-size: 11px;
        padding: 8px 4px;
    }
    
    .table tbody td {
        padding: 8px 4px;
        font-size: 13px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const orderCheckboxes = document.querySelectorAll('.order-checkbox');
    const assignBtn = document.getElementById('assign-btn');
    const selectedCount = document.getElementById('selected-count');

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        orderCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    // Individual checkbox change
    orderCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
            // Update select all checkbox
            const checkedCount = document.querySelectorAll('.order-checkbox:checked').length;
            selectAllCheckbox.checked = checkedCount === orderCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < orderCheckboxes.length;
        });
    });

    function updateSelectedCount() {
        const checkedCount = document.querySelectorAll('.order-checkbox:checked').length;
        selectedCount.textContent = `${checkedCount} đơn được chọn`;
        assignBtn.disabled = checkedCount === 0;
        
        // Update button text and style based on selection
        if (checkedCount > 0) {
            assignBtn.classList.remove('btn-secondary');
            assignBtn.classList.add('btn-primary');
            assignBtn.innerHTML = `<i class="bi bi-check-circle me-2"></i>Phân Chia ${checkedCount} Đơn Hàng`;
        } else {
            assignBtn.classList.remove('btn-primary');
            assignBtn.classList.add('btn-secondary');
            assignBtn.innerHTML = `<i class="bi bi-check-circle me-2"></i>Phân Chia Đã Chọn`;
        }
    }

    // Form validation and submission
    document.getElementById('assign-form').addEventListener('submit', function(e) {
        const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
        let hasShipperSelected = false;
        let invalidOrderIds = [];

        checkedBoxes.forEach(checkbox => {
            const orderId = checkbox.value;
            const shipperSelect = document.querySelector(`select[name="assignments[${orderId}][shipper_id]"]`);
            const orderCode = checkbox.closest('tr').querySelector('td:nth-child(2) span').textContent;
            
            if (shipperSelect && shipperSelect.value) {
                hasShipperSelected = true;
            } else {
                invalidOrderIds.push(orderCode);
            }
        });

        if (checkedBoxes.length === 0) {
            e.preventDefault();
            alert('⚠️ Vui lòng chọn ít nhất một đơn hàng để phân chia!');
            return;
        }

        if (!hasShipperSelected || invalidOrderIds.length > 0) {
            e.preventDefault();
            if (invalidOrderIds.length > 0) {
                alert(`⚠️ Vui lòng chọn shipper cho các đơn hàng sau:\n${invalidOrderIds.join(', ')}`);
            } else {
                alert('⚠️ Vui lòng chọn shipper cho ít nhất một đơn hàng!');
            }
            return;
        }

        // Confirmation dialog
        const confirmedCount = checkedBoxes.length;
        if (!confirm(`✅ Xác nhận phân chia ${confirmedCount} đơn hàng cho shipper đã chọn?`)) {
            e.preventDefault();
            return;
        }

        // Show loading state
        assignBtn.disabled = true;
        assignBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Đang xử lý...';
    });

    // Auto-select shipper functionality
    document.querySelectorAll('.order-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                const shipperSelect = this.closest('tr').querySelector('.shipper-select');
                if (shipperSelect && !shipperSelect.value) {
                    // Auto-select least busy shipper
                    const options = Array.from(shipperSelect.options);
                    const shipperOptions = options.slice(1); // Skip first empty option
                    if (shipperOptions.length > 0) {
                        const leastBusy = shipperOptions.reduce((min, option) => {
                            const workload = parseInt(option.dataset.workload || '0');
                            const minWorkload = parseInt(min.dataset.workload || '0');
                            return workload < minWorkload ? option : min;
                        });
                        shipperSelect.value = leastBusy.value;
                    }
                }
            }
        });
    });
});
</script>
@endsection