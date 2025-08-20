@extends('admin.layouts.app')

@section('title', 'Quản lý hoàn tiền')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách yêu cầu hoàn tiền</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
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
                                <tr>
                                    <td>{{ $refund->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $refund->order_id) }}" target="_blank">
                                            {{ $refund->order->order_code }}
                                        </a>
                                    </td>
                                    <td>{{ $refund->order->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $refund->gateway === 'vnpay' ? 'primary' : ($refund->gateway === 'momo' ? 'pink' : 'secondary') }}">
                                            {{ strtoupper($refund->gateway) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($refund->amount) }}₫</td>
                                    <td>
                                        @switch($refund->status)
                                            @case('pending')
                                                <span class="badge badge-warning">Đang xử lý</span>
                                                @break
                                            @case('success')
                                                <span class="badge badge-success">Thành công</span>
                                                @break
                                            @case('failed')
                                                <span class="badge badge-danger">Thất bại</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge badge-secondary">Đã hủy</span>
                                                @break
                                            @default
                                                <span class="badge badge-info">{{ $refund->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $refund->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.refunds.show', $refund->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Chi tiết
                                            </a>
                                            
                                            @if($refund->status === 'pending')
                                                <button type="button" 
                                                        class="btn btn-sm btn-success mark-success-btn"
                                                        data-refund-id="{{ $refund->id }}">
                                                    <i class="fas fa-check"></i> Thành công
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger mark-failed-btn"
                                                        data-refund-id="{{ $refund->id }}">
                                                    <i class="fas fa-times"></i> Thất bại
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có yêu cầu hoàn tiền nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $refunds->links() }}
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
                <h5 class="modal-title">Xác nhận</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirmBtn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Mark as success
    $('.mark-success-btn').click(function() {
        const refundId = $(this).data('refund-id');
        $('#confirmMessage').text('Bạn có chắc chắn muốn đánh dấu hoàn tiền này thành công?');
        $('#confirmBtn').removeClass('btn-danger').addClass('btn-success').text('Đánh dấu thành công');
        $('#confirmBtn').off('click').on('click', function() {
            markRefundStatus(refundId, 'success');
        });
        $('#confirmModal').modal('show');
    });

    // Mark as failed
    $('.mark-failed-btn').click(function() {
        const refundId = $(this).data('refund-id');
        $('#confirmMessage').text('Bạn có chắc chắn muốn đánh dấu hoàn tiền này thất bại?');
        $('#confirmBtn').removeClass('btn-success').addClass('btn-danger').text('Đánh dấu thất bại');
        $('#confirmBtn').off('click').on('click', function() {
            markRefundStatus(refundId, 'failed');
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
            error: function() {
                toastr.error('Có lỗi xảy ra khi xử lý yêu cầu');
            }
        });

        $('#confirmModal').modal('hide');
    }
});
</script>
@endpush
