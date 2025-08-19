@extends('admin.layouts.app')

@section('title', 'Quản lý hoàn tiền')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-undo-alt mr-2"></i>
                            Danh sách yêu cầu hoàn tiền
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="refreshTable()">
                                <i class="fas fa-sync-alt"></i> Làm mới
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-control" id="statusFilter">
                                <option value="">Tất cả trạng thái</option>
                                <option value="pending">Đang xử lý</option>
                                <option value="success">Thành công</option>
                                <option value="failed">Thất bại</option>
                                <option value="cancelled">Đã hủy</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="gatewayFilter">
                                <option value="">Tất cả gateway</option>
                                <option value="vnpay">VNPAY</option>
                                <option value="momo">MOMO</option>
                                <option value="manual">Thủ công</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dateFilter" placeholder="Lọc theo ngày">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" onclick="applyFilters()">
                                <i class="fas fa-filter"></i> Lọc
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="clearFilters()">
                                <i class="fas fa-times"></i> Xóa lọc
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="refundsTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Gateway</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($refunds as $refund)
                                <tr data-status="{{ $refund->status }}" data-gateway="{{ $refund->gateway }}" data-date="{{ $refund->created_at->format('Y-m-d') }}">
                                    <td>{{ $refund->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $refund->order_id) }}" target="_blank" class="text-primary font-weight-bold">
                                            {{ $refund->order->order_code }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-2">
                                                @if($refund->order->user && $refund->order->user->avatar)
                                                    <img src="{{ asset('storage/' . $refund->order->user->avatar) }}" 
                                                         class="rounded-circle" width="32" height="32" alt="Avatar">
                                                @else
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                                         style="width: 32px; height: 32px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $refund->order->user->name ?? 'N/A' }}</div>
                                                <small class="text-muted">{{ $refund->order->user->email ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $refund->gateway === 'vnpay' ? 'primary' : ($refund->gateway === 'momo' ? 'pink' : 'secondary') }}">
                                            <i class="fas fa-{{ $refund->gateway === 'vnpay' ? 'credit-card' : ($refund->gateway === 'momo' ? 'mobile-alt' : 'hand-paper') }} mr-1"></i>
                                            {{ strtoupper($refund->gateway) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success">
                                            {{ number_format($refund->amount) }}₫
                                        </span>
                                    </td>
                                    <td>
                                        @switch($refund->status)
                                            @case('pending')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock mr-1"></i>Đang xử lý
                                                </span>
                                                @break
                                            @case('success')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check mr-1"></i>Thành công
                                                </span>
                                                @break
                                            @case('failed')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times mr-1"></i>Thất bại
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-ban mr-1"></i>Đã hủy
                                                </span>
                                                @break
                                            @default
                                                <span class="badge badge-info">
                                                    <i class="fas fa-info mr-1"></i>{{ $refund->status }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <div class="font-weight-bold">{{ $refund->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ $refund->created_at->format('H:i:s') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.refunds.show', $refund->id) }}" 
                                               class="btn btn-sm btn-info" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($refund->status === 'pending')
                                                <button type="button" 
                                                        class="btn btn-sm btn-success mark-success-btn"
                                                        data-refund-id="{{ $refund->id }}"
                                                        title="Đánh dấu thành công">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger mark-failed-btn"
                                                        data-refund-id="{{ $refund->id }}"
                                                        title="Đánh dấu thất bại">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif

                                            @if($refund->status === 'failed')
                                                <button type="button" 
                                                        class="btn btn-sm btn-warning retry-refund-btn"
                                                        data-refund-id="{{ $refund->id }}"
                                                        title="Thử lại hoàn tiền">
                                                    <i class="fas fa-redo"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <p>Không có yêu cầu hoàn tiền nào</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Hiển thị {{ $refunds->firstItem() ?? 0 }} - {{ $refunds->lastItem() ?? 0 }} 
                            trong tổng số {{ $refunds->total() }} bản ghi
                        </div>
                        <div>
                            {{ $refunds->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal xác nhận -->
<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
                    Xác nhận
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Hủy
                </button>
                <button type="button" class="btn btn-primary" id="confirmBtn">
                    <i class="fas fa-check mr-1"></i>Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal chi tiết -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle text-info mr-2"></i>
                    Chi tiết hoàn tiền
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-sm img {
    object-fit: cover;
}
.badge {
    font-size: 0.75rem;
}
.btn-group .btn {
    margin-right: 2px;
}
.table th {
    background-color: #f8f9fa;
    border-top: none;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Mark as success
    $('.mark-success-btn').click(function() {
        const refundId = $(this).data('refund-id');
        $('#confirmMessage').html('<i class="fas fa-check-circle text-success mr-2"></i>Bạn có chắc chắn muốn đánh dấu hoàn tiền này thành công?');
        $('#confirmBtn').removeClass('btn-danger btn-warning').addClass('btn-success').html('<i class="fas fa-check mr-1"></i>Đánh dấu thành công');
        $('#confirmBtn').off('click').on('click', function() {
            markRefundStatus(refundId, 'success');
        });
        $('#confirmModal').modal('show');
    });

    // Mark as failed
    $('.mark-failed-btn').click(function() {
        const refundId = $(this).data('refund-id');
        $('#confirmMessage').html('<i class="fas fa-times-circle text-danger mr-2"></i>Bạn có chắc chắn muốn đánh dấu hoàn tiền này thất bại?');
        $('#confirmBtn').removeClass('btn-success btn-warning').addClass('btn-danger').html('<i class="fas fa-times mr-1"></i>Đánh dấu thất bại');
        $('#confirmBtn').off('click').on('click', function() {
            markRefundStatus(refundId, 'failed');
        });
        $('#confirmModal').modal('show');
    });

    // Retry refund
    $('.retry-refund-btn').click(function() {
        const refundId = $(this).data('refund-id');
        $('#confirmMessage').html('<i class="fas fa-redo text-warning mr-2"></i>Bạn có chắc chắn muốn thử lại hoàn tiền này?');
        $('#confirmBtn').removeClass('btn-success btn-danger').addClass('btn-warning').html('<i class="fas fa-redo mr-1"></i>Thử lại');
        $('#confirmBtn').off('click').on('click', function() {
            retryRefund(refundId);
        });
        $('#confirmModal').modal('show');
    });

    function markRefundStatus(refundId, status) {
        const url = status === 'success' 
            ? `/admin/refunds/${refundId}/mark-success`
            : `/admin/refunds/${refundId}/mark-failed`;

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('#confirmBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Đang xử lý...');
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                toastr.error(response?.message || 'Có lỗi xảy ra khi xử lý yêu cầu');
            },
            complete: function() {
                $('#confirmBtn').prop('disabled', false);
                $('#confirmModal').modal('hide');
            }
        });
    }

    function retryRefund(refundId) {
        $.ajax({
            url: `/admin/refunds/${refundId}/retry`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('#confirmBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Đang xử lý...');
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                toastr.error(response?.message || 'Có lỗi xảy ra khi thử lại hoàn tiền');
            },
            complete: function() {
                $('#confirmBtn').prop('disabled', false);
                $('#confirmModal').modal('hide');
            }
        });
    }

    // Filter functions
    window.applyFilters = function() {
        const status = $('#statusFilter').val();
        const gateway = $('#gatewayFilter').val();
        const date = $('#dateFilter').val();

        $('#refundsTable tbody tr').each(function() {
            let show = true;
            const $row = $(this);

            if (status && $row.data('status') !== status) show = false;
            if (gateway && $row.data('gateway') !== gateway) show = false;
            if (date && $row.data('date') !== date) show = false;

            $row.toggle(show);
        });
    };

    window.clearFilters = function() {
        $('#statusFilter').val('');
        $('#gatewayFilter').val('');
        $('#dateFilter').val('');
        $('#refundsTable tbody tr').show();
    };

    window.refreshTable = function() {
        location.reload();
    };

    // Auto-apply filters on change
    $('#statusFilter, #gatewayFilter, #dateFilter').change(function() {
        applyFilters();
    });
});
</script>
@endpush
