@extends('admin.layout.admin')
@section('title', 'Theo dõi đơn hàng #' . $order->order_code)
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Theo dõi đơn hàng #{{ $order->order_code }}</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm">Bảng điều khiển</a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm">Đơn hàng</a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li class="text-sm">Theo dõi</li>
                <li><i class="icon-chevron-right"></i></li>
                <li class="text-sm">Đơn hàng #{{ $order->order_code }}</li>
            </ul>
        </div>

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            // Đơn đã trả hàng hoặc đã hủy thì không cho cập nhật nữa (Locked if returned or cancelled)
            $locked = in_array($order->order_status, ['returned', 'cancelled']);
            $transitions = \App\Models\Order::getAllowedStatusTransitions();
            $currentStatus = $order->order_status;
            $isPendingCancel = $order->order_status === 'pending_cancellation';
        @endphp

        <div class="wg-box mb-20" style="max-width: 600px; margin: 0 auto;">
            @if($isPendingCancel)
                <h5 class="mb-16" style="color:#ef4444;">Đơn hàng đang chờ hủy</h5>
                <div class="mb-16">
                    <div class="body-title mb-8">Lý do khách yêu cầu hủy:</div>
                    <div class="body-text" style="color:#ef4444;">{{ $order->cancellation_reason }}</div>
                </div>
                <form action="{{ route('admin.orders.processCancel', $order->id) }}" method="POST" class="form-cancel-request">
                    @csrf
                    <div class="mb-16">
                        <label class="body-title mb-8" for="admin_note_cancel">Ghi chú của quản trị viên (tùy chọn)</label>
                        <textarea name="admin_note_cancel" id="admin_note_cancel" rows="2" class="form-control" style="border-radius:8px;min-height:44px;"></textarea>
                    </div>
                    <div class="flex gap10">
                        <button class="tf-button w208" type="submit" name="action" value="approve" style="background:#ef4444;border:none;">Duyệt Hủy</button>
                        <button class="tf-button w208 style-2" type="submit" name="action" value="reject" style="background:#fbbf24;border:none;">Từ chối yêu cầu</button>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="tf-button w208 style-2" style="height:44px;">Quay lại</a>
                    </div>
                </form>
            @else
            <h5 class="mb-16">Cập nhật trạng thái đơn hàng</h5>
            @if($locked)
                <div class="alert alert-info mb-0">
                    Đơn hàng đã
                    @if($order->order_status == 'returned') trả hàng
                    @elseif($order->order_status == 'cancelled') hủy
                    @endif
                    , không thể cập nhật trạng thái.
                </div>
            @else
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="form-status-update">
                @csrf
                <div class="mb-20">
                    <label class="body-title mb-8" for="order_status">Trạng thái đơn hàng</label>
                    <div class="input-group">
                        @include('admin.orders._status', [
                            'order' => $order,
                            'transitions' => $transitions,
                            'currentStatus' => $currentStatus
                        ])
                    </div>
                </div>
                <div class="mb-20">
                    <label class="body-title mb-8" for="admin_note">Ghi chú của quản trị viên</label>
                    <textarea name="admin_note" id="admin_note" rows="2" class="form-control" style="border-radius:8px;min-height:44px;">{{ old('admin_note', $order->admin_note) }}</textarea>
                </div>
                <div class="mb-20" id="cancel_reason_box" style="display: none;">
                    <label class="body-title mb-8" for="cancellation_reason">Lý do hủy</label>
                    <textarea name="cancellation_reason" id="cancellation_reason" rows="2" class="form-control" style="border-radius:8px;min-height:44px;">{{ old('cancellation_reason', $order->cancellation_reason) }}</textarea>
                </div>
                <div class="flex gap10">
                    <button class="tf-button w208" type="submit" style="height:44px;">Cập nhật</button>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="tf-button w208" style="height:44px;">Quay lại</a>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function toggleCancelReason() {
                        var status = document.getElementById('order_status').value;
                        document.getElementById('cancel_reason_box').style.display = (status === 'cancelled') ? 'block' : 'none';
                    }
                    document.getElementById('order_status').addEventListener('change', toggleCancelReason);
                    toggleCancelReason();
                });
            </script>
            @endif
            @endif
        </div>

        <div class="wg-box mb-20">
            <div class="road-map flex gap10" style="justify-content:space-between;">
                <div class="road-map-item {{ in_array($order->order_status, ['pending_confirmation','processing','shipped','delivered','cancelled','returned']) ? 'active' : '' }}">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Chờ xử lý</h6>
                    <div class="body-text">
                        @if($order->ordered_at)
                            {{ \Carbon\Carbon::parse($order->ordered_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="road-map-item {{ in_array($order->order_status, ['processing','shipped','delivered','cancelled','returned']) ? 'active' : '' }}">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đang xử lý</h6>
                    <div class="body-text">
                        @if($order->processing_at)
                            {{ \Carbon\Carbon::parse($order->processing_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="road-map-item {{ in_array($order->order_status, ['shipped','delivered','cancelled','returned']) ? 'active' : '' }}">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đang giao hàng</h6>
                    <div class="body-text">
                        @if($order->shipped_at)
                            {{ \Carbon\Carbon::parse($order->shipped_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="road-map-item {{ in_array($order->order_status, ['delivered','returned']) ? 'active' : '' }}">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đã nhận hàng</h6>
                    <div class="body-text">
                        @if($order->delivered_at)
                            {{ \Carbon\Carbon::parse($order->delivered_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="road-map-item {{ $order->order_status == 'cancelled' ? 'active' : '' }}">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đã hủy</h6>
                    <div class="body-text">
                        @if($order->cancelled_at)
                            {{ \Carbon\Carbon::parse($order->cancelled_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div class="road-map-item {{ $order->order_status == 'returned' ? 'active' : '' }}">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đã trả hàng</h6>
                    <div class="body-text">
                        @if($order->returned_at)
                            {{ \Carbon\Carbon::parse($order->returned_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="wg-box mt-20">
            <div class="body-title mb-12">Lịch sử vận chuyển</div>
            <!-- Dùng div với class "table-responsive" và style="max-height: 400px;" -->
<div class="table-responsive" style="max-height: 400px;">
    <table class="table table-bordered" style="width:100%; border-collapse:collapse;">
        <tbody>
            @php
                $steps = [
                    [
                        'label' => 'Đặt hàng',
                        'at' => $order->ordered_at,
                        'desc' => 'Đơn hàng đã được đặt',
                        'note' => $order->customer_note,
                        'show' => true,
                    ],
                    [
                        'label' => 'Đang xử lý',
                        'at' => $order->processing_at,
                        'desc' => 'Đơn hàng đang được xử lý',
                        'note' => '',
                        'show' => $order->processing_at,
                    ],
                    [
                        'label' => 'Đã giao cho đơn vị vận chuyển',
                        'at' => $order->shipped_at,
                        'desc' => 'Đơn hàng đã được giao cho đơn vị vận chuyển',
                        'note' => '',
                        'show' => $order->shipped_at,
                    ],
                    [
                        'label' => 'Đã giao thành công',
                        'at' => $order->delivered_at,
                        'desc' => 'Đơn hàng đã giao thành công',
                        'note' => '',
                        'show' => $order->delivered_at,
                    ],
                    [
                        'label' => 'Đã hủy',
                        'at' => $order->cancelled_at,
                        'desc' => 'Đơn hàng đã bị hủy',
                        'note' => $order->cancellation_reason,
                        'show' => $order->cancelled_at,
                    ],
                    [
                        'label' => 'Đã trả hàng',
                        'at' => $order->returned_at,
                        'desc' => 'Đơn hàng đã trả hàng',
                        'note' => '',
                        'show' => $order->returned_at,
                    ],
                ];
            @endphp
            @foreach($steps as $step)
                @if($step['show'])
                <tr>
                    <th style="width:120px;vertical-align:top;">Trạng thái</th>
                    <td>{{ $step['label'] }}</td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Ngày</th>
                    <td>{{ $step['at'] ? \Carbon\Carbon::parse($step['at'])->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') : '-' }}</td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Giờ</th>
                    <td>{{ $step['at'] ? \Carbon\Carbon::parse($step['at'])->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') : '-' }}</td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Mô tả</th>
                    <td>{{ $step['desc'] }}</td>
                </tr>
                @if($step['note'])
                <tr>
                    <th style="vertical-align:top;">Ghi chú</th>
                    <td>{{ $step['note'] }}</td>
                </tr>
                @endif
                <tr><td colspan="2"><hr style="margin:8px 0;"></td></tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>
@endsection
