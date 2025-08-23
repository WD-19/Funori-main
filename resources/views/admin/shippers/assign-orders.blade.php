@extends('admin.layout.admin')

@section('title', 'Phân Chia Đơn Hàng')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <!-- Header -->
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
                <i class="icon-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="icon-alert-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="icon-info me-2"></i>
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-27">
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-card__icon bg-primary">
                        <i class="icon-package"></i>
                    </div>
                    <div class="stats-card__content">
                        <h3 class="stats-card__number">{{ $unassignedOrders->count() }}</h3>
                        <div class="stats-card__text">Đơn Chưa Phân Chia</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-card__icon bg-success">
                        <i class="icon-users"></i>
                    </div>
                    <div class="stats-card__content">
                        <h3 class="stats-card__number">{{ $activeShippers->count() }}</h3>
                        <div class="stats-card__text">Shipper Hoạt Động</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-card__icon bg-info">
                        <i class="icon-truck"></i>
                    </div>
                    <div class="stats-card__content">
                        <h3 class="stats-card__number">{{ $activeShippers->sum('orders_count') }}</h3>
                        <div class="stats-card__text">Đơn Đang Xử Lý</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-card__icon bg-warning">
                        <i class="icon-calculator"></i>
                    </div>
                    <div class="stats-card__content">
                        <h3 class="stats-card__number">{{ $activeShippers->count() > 0 ? round($unassignedOrders->count() / $activeShippers->count()) : 0 }}</h3>
                        <div class="stats-card__text">Đơn/Shipper (TB)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="action-bar mb-27">
            <div class="action-bar__header">
                <h5><i class="icon-zap me-2"></i>Hành Động Nhanh</h5>
            </div>
            <div class="action-bar__content">
                @if($unassignedOrders->count() > 0 && $activeShippers->count() > 0)
                <form action="{{ route('admin.shippers.auto-assign') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-lg" 
                            onclick="return confirm('Bạn có chắc chắn muốn tự động phân chia {{ $unassignedOrders->count() }} đơn hàng cho {{ $activeShippers->count() }} shipper?')">
                        <i class="icon-zap me-2"></i>Phân Chia Tự Động
                    </button>
                </form>
                @endif
                <a class="btn btn-secondary btn-lg" href="{{ route('admin.shippers.index') }}">
                    <i class="icon-arrow-left me-2"></i>Quay Lại
                </a>
            </div>
        </div>

        <!-- Shipper Status Grid -->
        @if($activeShippers->count() > 0)
        <div class="shipper-grid mb-27">
            <div class="shipper-grid__header">
                <h5><i class="icon-users me-2"></i>Trạng Thái Shipper</h5>
            </div>
            <div class="shipper-grid__content">
                <div class="row">
                    @foreach($activeShippers as $shipper)
                    <div class="col-lg-4 col-md-6 mb-20">
                        <div class="shipper-card {{ $shipper->orders_count >= 5 ? 'shipper-card--busy' : 'shipper-card--available' }}">
                            <div class="shipper-card__avatar">
                                <div class="shipper-card__avatar-icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="shipper-card__status-indicator {{ $shipper->orders_count >= 5 ? 'status-busy' : 'status-available' }}"></div>
                            </div>
                            <div class="shipper-card__info">
                                <h6 class="shipper-card__name">{{ $shipper->name }}</h6>
                                <div class="shipper-card__email">{{ $shipper->email }}</div>
                                <div class="shipper-card__workload">
                                    <span class="workload-badge {{ $shipper->orders_count >= 5 ? 'workload-busy' : 'workload-normal' }}">
                                        {{ $shipper->orders_count }} đơn đang xử lý
                                    </span>
                                    @if($shipper->orders_count >= 5)
                                    <span class="workload-warning">
                                        <i class="icon-alert-triangle me-1"></i>Quá tải
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Orders Assignment Table -->
        @if($unassignedOrders->count() > 0)
        <div class="orders-table">
            <div class="orders-table__header">
                <h5><i class="icon-list me-2"></i>Đơn Hàng Chưa Phân Chia ({{ $unassignedOrders->count() }} đơn)</h5>
            </div>
            
            <form action="{{ route('admin.shippers.process-assign') }}" method="POST" id="assign-form">
                @csrf
                <input type="hidden" name="debug" value="1">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">
                                    <input type="checkbox" id="select-all" class="form-check-input">
                                </th>
                                <th style="width: 150px;">Mã Đơn</th>
                                <th style="width: 200px;">Khách Hàng</th>
                                <th style="width: 300px;">Địa Chỉ Giao Hàng</th>
                                <th style="width: 120px;" class="text-end">Tổng Tiền</th>
                                <th style="width: 120px;" class="text-center">Trạng Thái</th>
                                <th style="width: 250px;">Phân Chia Cho Shipper</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unassignedOrders as $order)
                            <tr class="order-row">
                                <td class="text-center">
                                    <input type="checkbox" name="assignments[{{ $order->id }}][order_id]" 
                                           value="{{ $order->id }}" class="form-check-input order-checkbox">
                                </td>
                                <td>
                                    <div class="order-code">
                                        <span class="order-code__number">#{{ $order->order_code }}</span>
                                        <div class="order-code__date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <div class="customer-info__name">{{ $order->customer_name ?? 'N/A' }}</div>
                                        <div class="customer-info__phone">{{ $order->customer_phone ?? 'N/A' }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="shipping-address" title="{{ $order->shipping_address }}">
                                        {{ Str::limit($order->shipping_address, 80) }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="order-amount">
                                        {{ number_format($order->total_amount, 0, ',', '.') }}₫
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusConfig = [
                                            'pending_confirmation' => ['class' => 'warning', 'text' => 'Chờ xác nhận', 'icon' => 'icon-clock'],
                                            'confirmed' => ['class' => 'info', 'text' => 'Đã xác nhận', 'icon' => 'icon-check'],
                                            'processing' => ['class' => 'primary', 'text' => 'Đang xử lý', 'icon' => 'icon-settings'],
                                        ];
                                        $config = $statusConfig[$order->order_status] ?? ['class' => 'secondary', 'text' => $order->order_status, 'icon' => 'icon-circle'];
                                    @endphp
                                    <span class="status-badge status-badge--{{ $config['class'] }}">
                                        <i class="{{ $config['icon'] }} me-1"></i>
                                        {{ $config['text'] }}
                                    </span>
                                </td>
                                <td>
                                    <select name="assignments[{{ $order->id }}][shipper_id]" 
                                            class="form-select shipper-select">
                                        <option value="">-- Chọn shipper --</option>
                                        @foreach($activeShippers as $shipper)
                                        <option value="{{ $shipper->id }}" 
                                                class="{{ $shipper->orders_count >= 5 ? 'option-busy' : 'option-available' }}">
                                            {{ $shipper->name }} 
                                            ({{ $shipper->orders_count }} đơn - 
                                            @if($shipper->orders_count >= 5)
                                                <span class="text-warning">Bận</span>
                                            @elseif($shipper->orders_count >= 3)
                                                <span class="text-info">Vừa</span>
                                            @else
                                                <span class="text-success">Rảnh</span>
                                            @endif
                                            )
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Action Bar -->
                <div class="action-bar action-bar--bottom">
                    <div class="action-bar__content">
                                        <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary btn-lg" id="assign-btn" disabled>
                        <i class="icon-check-circle me-2"></i>Phân Chia Đã Chọn
                    </button>
                    <span class="selection-info" id="selection-info">0 đơn được chọn</span>
                </div>
                        <div class="action-bar__help">
                            <i class="icon-info-circle me-2"></i>
                            <strong>Hướng dẫn:</strong> Chọn đơn hàng và shipper, sau đó click "Phân Chia Đã Chọn"
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state__icon">
                <i class="icon-check-circle"></i>
            </div>
            <h5>Không có đơn hàng nào cần phân chia!</h5>
            <p>Tất cả đơn hàng đã được phân chia cho shipper.</p>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                <i class="icon-arrow-left me-2"></i>Xem Danh Sách Đơn Hàng
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Simple JavaScript for basic functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const orderCheckboxes = document.querySelectorAll('.order-checkbox');
    const assignBtn = document.getElementById('assign-btn');
    const selectionInfo = document.getElementById('selection-info');

    // Select all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            orderCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectionInfo();
        });
    }

    // Individual checkbox change
    orderCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectionInfo();
            updateSelectAllState();
        });
    });

    function updateSelectionInfo() {
        const checkedCount = document.querySelectorAll('.order-checkbox:checked').length;
        selectionInfo.textContent = `${checkedCount} đơn được chọn`;
        assignBtn.disabled = checkedCount === 0;
    }

    function updateSelectAllState() {
        const checkedCount = document.querySelectorAll('.order-checkbox:checked').length;
        const totalCount = orderCheckboxes.length;
        
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = checkedCount === totalCount;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < totalCount;
        }
    }

    // Bỏ hết validation phức tạp - chỉ để form submit đơn giản
    console.log('✅ JavaScript loaded successfully');
    console.log('✅ Form will submit without complex validation');
});
</script>

<!-- Modern CSS Styling -->
<style>
/* Stats Cards */
.stats-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.stats-card__icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    flex-shrink: 0;
}

.stats-card__number {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 8px 0;
}

.stats-card__text {
    font-size: 14px;
    color: #666;
    margin: 0;
}

/* Action Bar */
.action-bar {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.action-bar__header {
    margin-bottom: 20px;
}

.action-bar__header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.action-bar__content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

.action-bar__help {
    color: #666;
    font-size: 14px;
}

/* Shipper Grid */
.shipper-grid {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.shipper-grid__header {
    margin-bottom: 24px;
}

.shipper-grid__header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.shipper-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

.shipper-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.shipper-card--busy {
    border-color: #ffc107;
    background: #fff8e1;
}

.shipper-card--available {
    border-color: #28a745;
    background: #f1f8e9;
}

.shipper-card__avatar {
    position: relative;
    flex-shrink: 0;
}

.shipper-card__avatar-icon {
    width: 50px;
    height: 50px;
    background: #007bff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
}

.shipper-card__status-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid white;
}

.status-available {
    background: #28a745;
}

.status-busy {
    background: #ffc107;
}

.shipper-card__info {
    flex-grow: 1;
}

.shipper-card__name {
    margin: 0 0 4px 0;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.shipper-card__email {
    font-size: 13px;
    color: #666;
    margin-bottom: 8px;
}

.shipper-card__workload {
    display: flex;
    align-items: center;
    gap: 8px;
}

.workload-badge {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
}

.workload-normal {
    background: #d4edda;
    color: #155724;
}

.workload-busy {
    background: #fff3cd;
    color: #856404;
}

.workload-warning {
    color: #ffc107;
    font-size: 12px;
}

/* Orders Table */
.orders-table {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.orders-table__header {
    margin-bottom: 24px;
}

.orders-table__header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
}

.table {
    margin: 0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

.table thead th {
    background: #f8f9fa;
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 0.5px;
    color: #666;
    padding: 16px 12px;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

.table tbody td {
    border: none;
    padding: 16px 12px;
    vertical-align: middle;
}

/* Order Row Elements */
.order-code__number {
    font-weight: 600;
    color: #007bff;
    font-size: 14px;
}

.order-code__date {
    font-size: 12px;
    color: #666;
    margin-top: 4px;
}

.customer-info__name {
    font-weight: 500;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.customer-info__phone {
    font-size: 12px;
    color: #666;
}

.shipping-address {
    font-size: 13px;
    color: #666;
    line-height: 1.4;
}

.order-amount {
    font-weight: 600;
    color: #28a745;
    font-size: 14px;
}

/* Status Badges */
.status-badge {
    padding: 10px 2px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge--warning {
    background: #fff3cd;
    color: #856404;
}

.status-badge--info {
    background: #d1ecf1;
    color: #0c5460;
}

.status-badge--primary {
    background: #cce7ff;
    color: #004085;
}

.status-badge--success {
    background: #d4edda;
    color: #155724;
}

/* Shipper Select */
.shipper-select {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    padding: 8px 12px;
    font-size: 13px;
    transition: all 0.2s ease;
}

.shipper-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.shipper-select option.option-busy {
    background-color: #fff3cd;
    color: #856404;
}

.shipper-select option.option-available {
    background-color: #d4edda;
    color: #155724;
}

/* Form Elements */
.form-check-input {
    width: 18px;
    height: 18px;
    border-radius: 4px;
    border: 2px solid #dee2e6;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 12px 24px;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-lg {
    padding: 14px 28px;
    font-size: 16px;
}

/* Selection Info */
.selection-info {
    background: #e3f2fd;
    color: #1976d2;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 14px;
}

/* Empty State */
.empty-state {
    background: white;
    border-radius: 16px;
    padding: 60px 24px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.empty-state__icon {
    font-size: 64px;
    color: #28a745;
    margin-bottom: 24px;
}

.empty-state h5 {
    margin: 0 0 16px 0;
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
}

.empty-state p {
    margin: 0 0 24px 0;
    color: #666;
    font-size: 16px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-card {
        padding: 20px;
    }
    
    .stats-card__icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .stats-card__number {
        font-size: 24px;
    }
    
    .action-bar__content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .table-responsive {
        border-radius: 12px;
    }
    
    .table thead th {
        font-size: 10px;
        padding: 12px 8px;
    }
    
    .table tbody td {
        padding: 12px 8px;
        font-size: 13px;
    }
    
    .shipper-card {
        padding: 16px;
    }
    
    .shipper-card__avatar-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}

/* Alert Improvements */
.alert {
    border-radius: 12px;
    border: none;
    padding: 16px 20px;
    margin-bottom: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
}

/* Loading State */
.btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn:disabled:hover {
    transform: none;
    box-shadow: none;
}
</style>
@endsection