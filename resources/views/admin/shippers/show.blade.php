@extends('admin.layout.admin')

@section('title', 'Chi Tiết Shipper')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Chi Tiết Shipper: {{ $shipper->name }}</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><a href="{{ route('admin.shippers.index') }}"><div class="text-tiny">Shipper</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Chi Tiết</div></li>
            </ul>
        </div>

        <!-- Thông tin shipper -->
        <div class="wg-box mb-5">
            <div class="flex items-center justify-between gap10 flex-wrap mb-4">
                <h5>Thông Tin Shipper</h5>
                <div class="flex gap10">
                    <a href="{{ route('admin.shippers.edit', $shipper) }}" class="tf-button style-1 w208">
                        <i class="icon-edit-3"></i> Chỉnh Sửa
                    </a>
                    <a href="{{ route('admin.shippers.index') }}" class="tf-button style-3 w208">
                        <i class="icon-arrow-left"></i> Quay Lại
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-card">
                        <h6>Thông Tin Cá Nhân</h6>
                        <div class="info-item">
                            <strong>Tên:</strong> {{ $shipper->name }}
                        </div>
                        <div class="info-item">
                            <strong>Email:</strong> {{ $shipper->email }}
                        </div>
                        <div class="info-item">
                            <strong>Số điện thoại:</strong> {{ $shipper->phone ?? 'Chưa có' }}
                        </div>
                        <div class="info-item">
                            <strong>Địa chỉ:</strong> {{ $shipper->address ?? 'Chưa có' }}
                        </div>
                        <div class="info-item">
                            <strong>Trạng thái:</strong>
                            @if($shipper->status === 'active')
                                <span class="badge bg-success">Hoạt Động</span>
                            @else
                                <span class="badge bg-warning">Tạm Ngưng</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h6>Thống Kê</h6>
                        <div class="stats-grid">
                            <div class="stat-item bg-primary">
                                <div class="stat-number">{{ $stats['total_orders'] }}</div>
                                <div class="stat-label">Tổng Đơn Hàng</div>
                            </div>
                            <div class="stat-item bg-warning">
                                <div class="stat-number">{{ $stats['assigned_orders'] }}</div>
                                <div class="stat-label">Đã Phân Công</div>
                            </div>
                            <div class="stat-item bg-info">
                                <div class="stat-number">{{ $stats['received_orders'] }}</div>
                                <div class="stat-label">Đã Nhận Hàng</div>
                            </div>
                            <div class="stat-item bg-warning">
                                <div class="stat-number">{{ $stats['in_delivery_orders'] }}</div>
                                <div class="stat-label">Đang Giao</div>
                            </div>
                            <div class="stat-item bg-success">
                                <div class="stat-number">{{ $stats['delivered_orders'] }}</div>
                                <div class="stat-label">Đã Giao</div>
                            </div>
                            <div class="stat-item bg-danger">
                                <div class="stat-number">{{ $stats['failed_orders'] }}</div>
                                <div class="stat-label">Thất Bại</div>
                            </div>
                        </div>
                        <div class="info-item mt-3">
                            <strong>Ngày tham gia:</strong> {{ $shipper->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="info-item">
                            <strong>Cập nhật cuối:</strong> {{ $shipper->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách đơn hàng -->
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap mb-4">
                <h5>Đơn Hàng Của Shipper ({{ $orders->total() }} đơn)</h5>
                <div class="flex gap10">
                    <select id="status-filter" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="shipped">Đang giao</option>
                        <option value="delivered">Đã giao</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                @if($orders->count() > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Mã Đơn Hàng</th>
                            <th>Khách Hàng</th>
                            <th>Địa Chỉ Giao Hàng</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Đặt</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr data-status="{{ $order->order_status }}">
                            <td>
                                <strong>{{ $order->order_code }}</strong>
                            </td>
                            <td>{{ $order->user->name ?? 'Khách hàng' }}</td>
                            <td>
                                <small>{{ Str::limit($order->shipping_address, 50) }}</small>
                            </td>
                            <td>
                                <strong>{{ number_format($order->total_amount) }} VNĐ</strong>
                            </td>
                                                         <td>
                                 @switch($order->order_status)
                                     @case('processing')
                                         <span class="badge bg-warning">Đang Xử Lý</span>
                                         @break
                                     @case('assigned')
                                         <span class="badge bg-primary">Đã Phân Công</span>
                                         @break
                                     @case('received')
                                         <span class="badge bg-info">Đã Nhận Hàng</span>
                                         @break
                                     @case('in_delivery')
                                         <span class="badge bg-warning">Đang Giao</span>
                                         @break
                                     @case('shipped')
                                         <span class="badge bg-info">Đã Gửi Hàng</span>
                                         @break
                                     @case('delivered')
                                         <span class="badge bg-success">Đã Giao</span>
                                         @break
                                     @case('failed')
                                         <span class="badge bg-danger">Giao Thất Bại</span>
                                         @break
                                     @case('cancelled')
                                         <span class="badge bg-danger">Đã Hủy</span>
                                         @break
                                     @case('returned')
                                         <span class="badge bg-warning">Đã Trả Hàng</span>
                                         @break
                                     @default
                                         <span class="badge bg-secondary">{{ ucfirst($order->order_status) }}</span>
                                 @endswitch
                                 
                                 <!-- Delivery Info -->
                                 @if(in_array($order->order_status, ['received', 'in_delivery', 'delivered', 'failed']))
                                 <div class="mt-2">
                                     @if($order->delivery_notes)
                                     <small class="text-muted d-block">
                                         <i class="icon-message-circle"></i> {{ Str::limit($order->delivery_notes, 50) }}
                                     </small>
                                     @endif
                                     @if($order->failure_reason)
                                     <small class="text-danger d-block">
                                         <i class="icon-alert-circle"></i> {{ Str::limit($order->failure_reason, 50) }}
                                     </small>
                                     @endif
                                     @if($order->delivery_images)
                                     <small class="text-info d-block">
                                         <i class="icon-image"></i> {{ count(is_array($order->delivery_images) ? $order->delivery_images : json_decode($order->delivery_images, true) ?? []) }} ảnh
                                     </small>
                                     @endif
                                 </div>
                                 @endif
                             </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="icon-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $orders->links() }}
                </div>
                @else
                <div class="text-center py-4">
                    <i class="icon-package" style="font-size: 48px; color: #ccc;"></i>
                    <h5 class="mt-3">Chưa có đơn hàng nào</h5>
                    <p class="text-muted">Shipper này chưa được gán đơn hàng nào.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('status-filter');
    const tableRows = document.querySelectorAll('tbody tr[data-status]');

    statusFilter.addEventListener('change', function() {
        const selectedStatus = this.value;
        
        tableRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            
            if (selectedStatus === '' || rowStatus === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>

<style>
.info-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    height: 100%;
}

.info-card h6 {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 8px;
}

.info-item {
    margin-bottom: 12px;
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.info-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.stat-item {
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    color: white;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.bg-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
}

.bg-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
}

.bg-info {
    background: linear-gradient(135deg, #17a2b8, #138496);
}

.bg-success {
    background: linear-gradient(135deg, #28a745, #1e7e34);
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.badge.bg-success {
    background-color: #28a745 !important;
    color: white;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #212529;
}

.badge.bg-info {
    background-color: #17a2b8 !important;
    color: white;
}

.badge.bg-danger {
    background-color: #dc3545 !important;
    color: white;
}

.badge.bg-secondary {
    background-color: #6c757d !important;
    color: white;
}

.form-select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    min-width: 150px;
}

.tf-button {
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.tf-button.w208 {
    min-width: 150px;
    justify-content: center;
}

.tf-button.style-1 {
    background: #007bff;
    color: white;
}

.tf-button.style-1:hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.tf-button.style-3 {
    background: #6c757d;
    color: white;
}

.tf-button.style-3:hover {
    background: #545b62;
    transform: translateY(-1px);
}

.btn {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 12px;
}

.btn-info {
    background: #17a2b8;
    color: white;
}

.btn-info:hover {
    background: #138496;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 12px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    text-align: left;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}
</style>
@endsection