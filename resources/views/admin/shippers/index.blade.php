@extends('admin.layout.admin')

@section('title', 'Quản Lý Shipper')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <a href="{{ route('admin.shippers.index') }}">
                <h3>Quản Lý Shipper</h3>
            </a>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Bảng điều khiển</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Quản lý shipper</div>
                </li>
            </ul>
        </div>

        <!-- Stats Cards -->
        <div class="wg-box mb-30">
            <div class="flex items-center justify-between gap20 flex-wrap">
                <div class="counter-item">
                    <div class="icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 35C28.2843 35 35 28.2843 35 20C35 11.7157 28.2843 5 20 5C11.7157 5 5 11.7157 5 20C5 28.2843 11.7157 35 20 35Z" fill="#22C55E" fill-opacity="0.1"/>
                            <path d="M20 30C25.5228 30 30 25.5228 30 20C30 14.4772 25.5228 10 20 10C14.4772 10 10 14.4772 10 20C10 25.5228 14.4772 30 20 30Z" fill="#22C55E"/>
                            <path d="M16 20L18.5 22.5L24 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="content">
                        <div class="number">{{ $shippers->where('status', 'active')->count() }}</div>
                        <div class="text">Shipper Hoạt Động</div>
                    </div>
                </div>
                <div class="counter-item">
                    <div class="icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 35C28.2843 35 35 28.2843 35 20C35 11.7157 28.2843 5 20 5C11.7157 5 5 11.7157 5 20C5 28.2843 11.7157 35 20 35Z" fill="#F59E0B" fill-opacity="0.1"/>
                            <path d="M20 30C25.5228 30 30 25.5228 30 20C30 14.4772 25.5228 10 20 10C14.4772 10 10 14.4772 10 20C10 25.5228 14.4772 30 20 30Z" fill="#F59E0B"/>
                            <path d="M20 15V20L23 23" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="content">
                        <div class="number">{{ $shippers->where('status', 'inactive')->count() }}</div>
                        <div class="text">Shipper Tạm Ngưng</div>
                    </div>
                </div>
                <div class="counter-item">
                    <div class="icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 35C28.2843 35 35 28.2843 35 20C35 11.7157 28.2843 5 20 5C11.7157 5 5 11.7157 5 20C5 28.2843 11.7157 35 20 35Z" fill="#3B82F6" fill-opacity="0.1"/>
                            <rect x="10" y="15" width="20" height="15" rx="2" fill="#3B82F6"/>
                            <path d="M15 20H25M15 25H25" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="content">
                        <div class="number">{{ $shippers->sum('orders_count') }}</div>
                        <div class="text">Tổng Đơn Hàng</div>
                    </div>
                </div>
                <div class="counter-item">
                    <div class="icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 35C28.2843 35 35 28.2843 35 20C35 11.7157 28.2843 5 20 5C11.7157 5 5 11.7157 5 20C5 28.2843 11.7157 35 20 35Z" fill="#EF4444" fill-opacity="0.1"/>
                            <path d="M20 30C25.5228 30 30 25.5228 30 20C30 14.4772 25.5228 10 20 10C14.4772 10 10 14.4772 10 20C10 25.5228 14.4772 30 20 30Z" fill="#EF4444"/>
                            <path d="M20 15V20M20 25H20.01" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="content">
                        <div class="number">{{ \App\Models\Order::whereNull('shipper_id')->whereIn('order_status', ['confirmed', 'pending'])->count() }}</div>
                        <div class="text">Đơn Chưa Phân Chia</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- all-shipper -->
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search" method="GET" action="{{ route('admin.shippers.index') }}">
                        <fieldset class="name">
                            <input type="text" placeholder="Tìm kiếm shipper..." class="" name="search" 
                                   value="{{ request('search') }}">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                    <form class="flex items-center" method="GET" action="{{ route('admin.shippers.index') }}" 
                          id="filterForm" style="margin-left: 10px;">
                        <select name="status" onchange="document.getElementById('filterForm').submit();">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm ngưng</option>
                        </select>
                    </form>
                </div>
                <div class="flex gap10">
                    <a class="tf-button style-1 w208" href="{{ route('admin.shippers.assign-orders') }}">
                        <i class="icon-truck"></i>Phân chia đơn hàng
                    </a>
                    <a class="tf-button style-1 w208" href="{{ route('admin.shippers.create') }}">
                        <i class="icon-plus"></i>Thêm shipper
                    </a>
                </div>
            </div>

            <div class="wg-table table-all-shipper" style="min-width: max-content;">
                @if(session('success'))
                    <div class="alert alert-success mb-20">
                        <i class="icon-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mb-20">
                        <i class="icon-alert-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <ul class="table-title flex gap20 mb-14">
                    <li style="flex: 0 0 60px;">
                        <div class="body-title">ID</div>
                    </li>
                    <li style="flex: 1; min-width: 220px;">
                        <div class="body-title">Thông tin shipper</div>
                    </li>
                    <li style="flex: 0 0 160px;">
                        <div class="body-title">Email</div>
                    </li>
                    <li style="flex: 0 0 120px;">
                        <div class="body-title">Điện thoại</div>
                    </li>
                    <li style="flex: 0 0 100px;">
                        <div class="body-title">Trạng thái</div>
                    </li>
                    <li style="flex: 0 0 120px;">
                        <div class="body-title">Hiệu suất</div>
                    </li>
                    <li style="flex: 0 0 120px;">
                        <div class="body-title">Hành động</div>
                    </li>
                </ul>

                <ul class="flex flex-column">
                    @forelse($shippers as $shipper)
                    <li class="wg-product item-row">
                        <div class="body-text" style="flex: 0 0 60px;">{{ $shipper->id }}</div>
                        
                        <div class="name" style="flex: 1; min-width: 220px;">
                            <div class="image">
                                <div style="width:38px;height:38px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:14px;">
                                    {{ strtoupper(substr($shipper->name, 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <div class="title">
                                    <a href="{{ route('admin.shippers.show', $shipper) }}" class="body-title-2">{{ $shipper->name }}</a>
                                </div>
                                <div class="text-tiny mt-3">Tham gia: {{ $shipper->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="body-text" style="flex: 0 0 160px;">
                            {{ Str::limit($shipper->email, 20) }}
                        </div>

                        <div class="body-text" style="flex: 0 0 120px;">
                            {{ $shipper->phone ?? 'Chưa có' }}
                        </div>

                        <div style="flex: 0 0 100px;">
                            <div class="block-tracking fw-7"
                                 style="color: {{ $shipper->status === 'active' ? '#22C55E' : '#F59E0B' }};">
                                {{ $shipper->status === 'active' ? 'Hoạt động' : 'Tạm ngưng' }}
                            </div>
                        </div>

                        <div style="flex: 0 0 120px;">
                            <div class="text-center">
                                <div class="body-text fw-7">{{ $shipper->orders_count }} đơn</div>
                                @php
                                    $workload = $shipper->orders_count;
                                    $color = $workload >= 5 ? '#EF4444' : ($workload >= 3 ? '#F59E0B' : '#22C55E');
                                    $text = $workload >= 5 ? 'Bận' : ($workload >= 3 ? 'Vừa' : 'Rảnh');
                                @endphp
                                <div class="text-tiny" style="color: {{ $color }}; font-weight: 600;">
                                    {{ $text }}
                                </div>
                            </div>
                        </div>

                        <div class="list-icon-function" style="flex: 0 0 120px;">
                            <div class="item eye">
                                <a style="color: #3B82F6;" href="{{ route('admin.shippers.show', $shipper) }}" title="Xem chi tiết">
                                    <i class="icon-eye"></i>
                                </a>
                            </div>
                            <div class="item edit">
                                <a href="{{ route('admin.shippers.edit', $shipper) }}" title="Chỉnh sửa">
                                    <i class="icon-edit-3" style="color: #F59E0B;"></i>
                                </a>
                            </div>
                            <div class="item trash">
                                <form action="{{ route('admin.shippers.destroy', $shipper) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa shipper này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #EF4444; cursor: pointer;" title="Xóa">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="wg-product item-row">
                        <div class="text-center" style="width: 100%; padding: 40px;">
                            <div class="icon mb-20">
                                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" style="margin: 0 auto;">
                                    <path d="M32 56C45.2548 56 56 45.2548 56 32C56 18.7452 45.2548 8 32 8C18.7452 8 8 18.7452 8 32C8 45.2548 18.7452 56 32 56Z" fill="#F3F4F6"/>
                                    <path d="M32 24V40M24 32H40" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h5 style="color: #6B7280; margin-bottom: 8px;">Chưa có shipper nào</h5>
                            <p style="color: #9CA3AF; margin-bottom: 20px;">Hãy thêm shipper đầu tiên để bắt đầu quản lý giao hàng</p>
                            <a href="{{ route('admin.shippers.create') }}" class="tf-button style-1">
                                <i class="icon-plus"></i>Thêm shipper đầu tiên
                            </a>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.counter-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    border: 1px solid #E5E7EB;
}

.counter-item .icon {
    flex-shrink: 0;
}

.counter-item .content .number {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
    line-height: 1;
    margin-bottom: 4px;
}

.counter-item .content .text {
    font-size: 14px;
    color: #6B7280;
    font-weight: 500;
}

.counter-box {
    text-align: center;
    padding: 8px 12px;
    background: #F8FAFC;
    border-radius: 8px;
    border: 1px solid #E2E8F0;
}

.counter-box .number {
    font-size: 18px;
    font-weight: 700;
    color: #334155;
    line-height: 1;
}

.counter-box .text-tiny {
    font-size: 11px;
    color: #64748B;
    margin-top: 2px;
}

.alert {
    padding: 12px 16px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
}

.alert-success {
    background: #DCFCE7;
    color: #166534;
    border: 1px solid #BBF7D0;
}

.alert-danger {
    background: #FEE2E2;
    color: #991B1B;
    border: 1px solid #FECACA;
}

.wg-product.item-row {
    border-bottom: 1px solid #F1F5F9;
    padding: 16px 0;
    display: flex;
    align-items: center;
    gap: 20px;
}

.wg-product.item-row:hover {
    background: #F8FAFC;
    border-radius: 8px;
    margin: 0 -16px;
    padding: 16px;
}

.name {
    display: flex;
    align-items: center;
    gap: 12px;
}

.name .image {
    flex-shrink: 0;
}

.status-badge {
    font-size: 11px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.list-icon-function {
    display: flex;
    gap: 8px;
}

.list-icon-function .item {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.list-icon-function .item:hover {
    background: #F1F5F9;
    transform: translateY(-1px);
}

.table-title {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 0;
    margin: 0;
}

.table-title li {
    display: flex;
    align-items: center;
    list-style: none;
}

.wg-table ul.flex.flex-column {
    padding: 0;
    margin: 0;
}

.wg-table ul.flex.flex-column li {
    list-style: none;
}

.body-text {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #374151;
}

.list-icon-function {
    display: flex;
    gap: 8px;
    justify-content: center;
}

@media (max-width: 768px) {
    .counter-item {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .wg-filter {
        flex-direction: column;
        gap: 10px;
    }
    
    .wg-filter form {
        margin-left: 0 !important;
    }
    
    .wg-table {
        overflow-x: auto;
    }
    
    .table-title,
    .wg-product.item-row {
        min-width: 800px;
    }
}
</style>
@endsection