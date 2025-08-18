@extends('admin.layout.admin')
@section('title', 'Theo dõi đơn hàng #' . $order->order_code)
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Theo dõi đơn hàng #{{ $order->order_code }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}">
                            <div class="text-tiny">Đơn hàng</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Theo dõi</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Đơn hàng #{{ $order->order_code }}</div>
                    </li>
                </ul>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
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

            <div class="wg-box mb-20 w-100">
                @if ($isPendingCancel)
                    <h5 class="mb-16" style="color:#ef4444;">Đơn hàng đang chờ hủy</h5>
                    <div class="mb-16">
                        <div class="body-title mb-8">Lý do khách yêu cầu hủy:</div>
                        <div class="body-text" style="color:#ef4444;">{{ $order->cancellation_reason }}</div>
                    </div>
                    <form action="{{ route('admin.orders.processCancel', $order->id) }}" method="POST"
                        class="form-cancel-request">
                        @csrf
                        <div class="mb-16">
                            <label class="body-title mb-8" for="admin_note_cancel">Ghi chú của quản trị viên (tùy
                                chọn)</label>
                            <textarea name="admin_note_cancel" id="admin_note_cancel" rows="2" class="form-control"
                                style="border-radius:8px;min-height:44px;"></textarea>
                        </div>
                        <div class="flex gap10">
                            <button class="tf-button w208" type="submit" name="action" value="approve"
                                style="background:#ef4444;border:none;">Duyệt Hủy</button>
                            <button class="tf-button w208 style-2" type="submit" name="action" value="reject"
                                style="background:#fbbf24;border:none;">Từ chối yêu cầu</button>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="tf-button w208 style-2"
                                style="height:44px;">Quay lại</a>
                        </div>
                    </form>
                @else
                    <h5 class="mb-16">Cập nhật trạng thái đơn hàng</h5>
                    @if ($locked)
                        <div class="alert alert-info mb-0">
                            Đơn hàng đã
                            @if ($order->order_status == 'returned')
                                trả hàng
                            @elseif($order->order_status == 'cancelled')
                                hủy
                            @endif
                            , không thể cập nhật trạng thái.
                        </div>
                    @else
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                            class="form-status-update">
                            @csrf
                            <div class="mb-20">
                                <label class="body-title mb-8" for="order_status">Trạng thái đơn hàng</label>
                                <div class="input-group">
                                    @include('admin.orders._status', [
                                        'order' => $order,
                                        'transitions' => $transitions,
                                        'currentStatus' => $currentStatus,
                                    ])
                                </div>
                            </div>
                            <div class="mb-20">
                                <label class="body-title mb-8" for="admin_note">Ghi chú của quản trị viên</label>
                                <textarea name="admin_note" id="admin_note" rows="2" class="form-control"
                                    style="border-radius:8px;min-height:44px; font-size:16px;">{{ old('admin_note') }}</textarea>
                            </div>
                            <div class="mb-20" id="cancel_reason_box" style="display: none;">
                                <label class="body-title mb-8" for="cancellation_reason">Lý do hủy</label>
                                <textarea name="cancellation_reason" id="cancellation_reason" rows="2" class="form-control"
                                    style="border-radius:8px;min-height:44px;font-size:16px;">{{ old('cancellation_reason', $order->cancellation_reason) }}</textarea>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <button type="submit" class="tf-button w-100 py-3 fs-5">
                                        <i class="bi bi-pencil-square me-1"></i> Cập nhật
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="tf-button style-3 w-100 py-3 fs-5">
                                        <i class="bi bi-list me-1"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                function toggleCancelReason() {
                                    var status = document.getElementById('order_status').value;
                                    document.getElementById('cancel_reason_box').style.display = (status === 'cancelled') ? 'block' :
                                        'none';
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
                    <div id="step-pending"
                        class="road-map-item {{ in_array($order->order_status, ['pending_confirmation', 'processing', 'shipped', 'delivered', 'cancelled', 'returned']) ? 'active' : '' }}">
                        <div class="icon"><i class="icon-check"></i></div>
                        <h6>Chờ xử lý</h6>
                        <div class="body-text">
                            <span id="time-ordered">
                                @if ($order->ordered_at)
                                    {{ \Carbon\Carbon::parse($order->ordered_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    <div id="step-processing"
                        class="road-map-item {{ in_array($order->order_status, ['processing', 'shipped', 'delivered', 'cancelled', 'returned']) ? 'active' : '' }}">
                        <div class="icon"><i class="icon-check"></i></div>
                        <h6>Đang xử lý</h6>
                        <div class="body-text">
                            <span id="time-processing">
                                @if ($order->processing_at)
                                    {{ \Carbon\Carbon::parse($order->processing_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    <div id="step-shipped"
                        class="road-map-item {{ in_array($order->order_status, ['shipped', 'delivered', 'cancelled', 'returned']) ? 'active' : '' }}">
                        <div class="icon"><i class="icon-check"></i></div>
                        <h6>Đang giao hàng</h6>
                        <div class="body-text">
                            <span id="time-shipped">
                                @if ($order->shipped_at)
                                    {{ \Carbon\Carbon::parse($order->shipped_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    <div id="step-delivered"
                        class="road-map-item {{ in_array($order->order_status, ['delivered', 'returned']) ? 'active' : '' }}">
                        <div class="icon"><i class="icon-check"></i></div>
                        <h6>Đã nhận hàng</h6>
                        <div class="body-text">
                            <span id="time-delivered">
                                @if ($order->delivered_at)
                                    {{ \Carbon\Carbon::parse($order->delivered_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    <div id="step-cancelled" class="road-map-item {{ $order->order_status == 'cancelled' ? 'active' : '' }}">
                        <div class="icon"><i class="icon-check"></i></div>
                        <h6>Đã hủy</h6>
                        <div class="body-text">
                            <span id="time-cancelled">
                                @if ($order->cancelled_at)
                                    {{ \Carbon\Carbon::parse($order->cancelled_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    <div id="step-returned" class="road-map-item {{ $order->order_status == 'returned' ? 'active' : '' }}">
                        <div class="icon"><i class="icon-check"></i></div>
                        <h6>Đã trả hàng</h6>
                        <div class="body-text">
                            <span id="time-returned">
                                @if ($order->returned_at)
                                    {{ \Carbon\Carbon::parse($order->returned_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wg-box mt-20">
               <div class="wg-box mt-20">
    <div class="body-title mb-12" style="font-size: 2rem; font-weight: bold;">Lịch sử vận chuyển</div>
    <div class="table-responsive" style="max-height: 400px;">
        <table class="table table-bordered align-middle" style="width:100%; border-collapse:collapse; background: #fff;">
            <thead style="background: #f3f4f6;">
                <tr>
                    <th style="min-width:140px; font-size: 1.3rem;">Thời gian</th>
                    <th style="min-width:140px; font-size: 1.3rem;">Trạng thái</th>
                    <th style="min-width:200px; font-size: 1.3rem;">Mô tả</th>
                    <th style="min-width:180px; font-size: 1.3rem;">Ghi chú</th>
                    <th style="min-width:120px; font-size: 1.3rem;">Hình ảnh</th>
                </tr>
            </thead>
            <tbody style="font-size: 1.25rem;">
                @forelse($order->status_histories->sortBy('created_at') as $history)
                    @php
                        $statusLabel = [
                            'pending_confirmation' => 'Đặt hàng',
                            'processing' => 'Đang xử lý',
                            'shipped' => 'Đã giao cho đơn vị vận chuyển',
                            'delivered' => 'Đã giao thành công',
                            'cancelled' => 'Đã hủy',
                            'returned' => 'Đã trả hàng',
                        ];
                        $statusDesc = [
                            'pending_confirmation' => 'Đơn hàng đã được đặt',
                            'processing' => 'Đơn hàng đang được xử lý',
                            'shipped' => 'Đơn hàng đã được giao cho đơn vị vận chuyển',
                            'delivered' => 'Đơn hàng đã giao thành công',
                            'cancelled' => 'Đơn hàng đã bị hủy',
                            'returned' => 'Đơn hàng đã trả hàng',
                            'pending_cancellation' => 'Khách hàng yêu cầu hủy đơn',
                        ];
                        $note = [];
                        if ($history->status == 'pending_confirmation' && !empty($order->customer_note)) {
                            $note[] = '<span class="text-muted">Ghi chú khách:</span> ' . e($order->customer_note);
                        }
                        if ($history->status == 'cancelled' && !empty($order->cancellation_reason)) {
                            $note[] = '<span class="text-danger">Lý do hủy:</span> ' . e($order->cancellation_reason);
                        }
                        if (!empty($history->admin_note)) {
                            $note[] = '<span class="text-primary">Quản trị:</span> ' . e($history->admin_note);
                        }
                    @endphp
                    <tr>
                        <td>
                            <div>
                                <span class="fw-bold" style="font-size: 1.25rem;">
                                    {{ $history->created_at ? \Carbon\Carbon::parse($history->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') : '-' }}
                                </span>
                            </div>
                            <div class="text-muted" style="font-size:1.1rem;">
                                {{ $history->created_at ? \Carbon\Carbon::parse($history->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i') : '-' }}
                            </div>
                        </td>
                        <td>
                            <span class="badge
                                @if($history->status == 'delivered') bg-success
                                @elseif($history->status == 'cancelled') bg-danger
                                @elseif($history->status == 'returned') bg-warning
                                @elseif($history->status == 'pending_cancellation') bg-secondary
                                @else bg-info @endif
                                " style="font-size:1.25rem; padding:8px 18px;">
                                {{ $statusLabel[$history->status] ?? $history->status }}
                            </span>
                        </td>
                        <td>
                            {{ $statusDesc[$history->status] ?? 'Cập nhật trạng thái' }}
                        </td>
                        <td>
                            @if(count($note))
                                {!! implode('<br>', $note) !!}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($history->image_path)
                                <img src="{{ asset('storage/' . $history->image_path) }}" 
                                     alt="Hình ảnh shipper" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                     onclick="openImageModal('{{ asset('storage/' . $history->image_path) }}')"
                                     title="Click để xem ảnh lớn">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><hr style="margin: 8px 0; border-top: 2px solid #e5e7eb;"></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted" style="font-size:1.25rem;">Chưa có lịch sử trạng thái nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.9);">
        <div style="position: relative; margin: auto; padding: 0; width: 90%; max-width: 700px; top: 50%; transform: translateY(-50%);">
            <span class="close" onclick="closeImageModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            <img id="modalImage" src="" style="width: 100%; height: auto; border-radius: 8px;">
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'block';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            var modal = document.getElementById('imageModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
    <!-- Realtime disabled -->
@endsection