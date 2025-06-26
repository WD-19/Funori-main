<?php $__env->startSection('title', 'Theo dõi đơn hàng #' . $order->order_code); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Theo dõi đơn hàng #<?php echo e($order->order_code); ?></h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm">Bảng điều khiển</a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm">Đơn hàng</a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li class="text-sm">Theo dõi</li>
                <li><i class="icon-chevron-right"></i></li>
                <li class="text-sm">Đơn hàng #<?php echo e($order->order_code); ?></li>
            </ul>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php
            // Đơn đã trả hàng hoặc đã hủy thì không cho cập nhật nữa (Locked if returned or cancelled)
            $locked = in_array($order->order_status, ['returned', 'cancelled']);
            $transitions = \App\Models\Order::getAllowedStatusTransitions();
            $currentStatus = $order->order_status;
            $isPendingCancel = $order->order_status === 'pending_cancellation';
        ?>

        <div class="wg-box mb-20" style="max-width: 600px; margin: 0 auto;">
            <?php if($isPendingCancel): ?>
                <h5 class="mb-16" style="color:#ef4444;">Đơn hàng đang chờ hủy</h5>
                <div class="mb-16">
                    <div class="body-title mb-8">Lý do khách yêu cầu hủy:</div>
                    <div class="body-text" style="color:#ef4444;"><?php echo e($order->cancellation_reason); ?></div>
                </div>
                <form action="<?php echo e(route('admin.orders.processCancel', $order->id)); ?>" method="POST" class="form-cancel-request">
                    <?php echo csrf_field(); ?>
                    <div class="mb-16">
                        <label class="body-title mb-8" for="admin_note_cancel">Ghi chú của quản trị viên (tùy chọn)</label>
                        <textarea name="admin_note_cancel" id="admin_note_cancel" rows="2" class="form-control" style="border-radius:8px;min-height:44px;"></textarea>
                    </div>
                    <div class="flex gap10">
                        <button class="tf-button w208" type="submit" name="action" value="approve" style="background:#ef4444;border:none;">Duyệt Hủy</button>
                        <button class="tf-button w208 style-2" type="submit" name="action" value="reject" style="background:#fbbf24;border:none;">Từ chối yêu cầu</button>
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="tf-button w208 style-2" style="height:44px;">Quay lại</a>
                    </div>
                </form>
            <?php else: ?>
            <h5 class="mb-16">Cập nhật trạng thái đơn hàng</h5>
            <?php if($locked): ?>
                <div class="alert alert-info mb-0">
                    Đơn hàng đã
                    <?php if($order->order_status == 'returned'): ?> trả hàng
                    <?php elseif($order->order_status == 'cancelled'): ?> hủy
                    <?php endif; ?>
                    , không thể cập nhật trạng thái.
                </div>
            <?php else: ?>
            <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST" class="form-status-update">
                <?php echo csrf_field(); ?>
                <div class="mb-20">
                    <label class="body-title mb-8" for="order_status">Trạng thái đơn hàng</label>
                    <div class="input-group">
                        <?php echo $__env->make('admin.orders._status', [
                            'order' => $order,
                            'transitions' => $transitions,
                            'currentStatus' => $currentStatus
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                <div class="mb-20">
                    <label class="body-title mb-8" for="admin_note">Ghi chú của quản trị viên</label>
                    <textarea name="admin_note" id="admin_note" rows="2" class="form-control" style="border-radius:8px;min-height:44px; font-size:16px;"><?php echo e(old('admin_note')); ?></textarea>
                </div>
                <div class="mb-20" id="cancel_reason_box" style="display: none;">
                    <label class="body-title mb-8" for="cancellation_reason">Lý do hủy</label>
                    <textarea name="cancellation_reason" id="cancellation_reason" rows="2" class="form-control" style="border-radius:8px;min-height:44px;font-size:16px;"><?php echo e(old('cancellation_reason', $order->cancellation_reason)); ?></textarea>
                </div>
                <div class="flex gap10">
                    <button class="tf-button w208" type="submit" style="height:44px;">Cập nhật</button>
                    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="tf-button w208" style="height:44px;">Quay lại</a>
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
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="wg-box mb-20">
            <div class="road-map flex gap10" style="justify-content:space-between;">
                <div class="road-map-item <?php echo e(in_array($order->order_status, ['pending_confirmation','processing','shipped','delivered','cancelled','returned']) ? 'active' : ''); ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Chờ xử lý</h6>
                    <div class="body-text">
                        <?php if($order->ordered_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($order->ordered_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>
                <div class="road-map-item <?php echo e(in_array($order->order_status, ['processing','shipped','delivered','cancelled','returned']) ? 'active' : ''); ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đang xử lý</h6>
                    <div class="body-text">
                        <?php if($order->processing_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($order->processing_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>
                <div class="road-map-item <?php echo e(in_array($order->order_status, ['shipped','delivered','cancelled','returned']) ? 'active' : ''); ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đang giao hàng</h6>
                    <div class="body-text">
                        <?php if($order->shipped_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($order->shipped_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>
                <div class="road-map-item <?php echo e(in_array($order->order_status, ['delivered','returned']) ? 'active' : ''); ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đã nhận hàng</h6>
                    <div class="body-text">
                        <?php if($order->delivered_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($order->delivered_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>
                <div class="road-map-item <?php echo e($order->order_status == 'cancelled' ? 'active' : ''); ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đã hủy</h6>
                    <div class="body-text">
                        <?php if($order->cancelled_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($order->cancelled_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>
                <div class="road-map-item <?php echo e($order->order_status == 'returned' ? 'active' : ''); ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6>Đã trả hàng</h6>
                    <div class="body-text">
                        <?php if($order->returned_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($order->returned_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y, h:i A')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $order->status_histories->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $statusLabel = [
                                'pending_confirmation' => 'Đặt hàng',
                                'processing' => 'Đang xử lý',
                                'shipped' => 'Đã giao cho đơn vị vận chuyển',
                                'delivered' => 'Đã giao thành công',
                                'cancelled' => 'Đã hủy',
                                'returned' => 'Đã trả hàng',
                                'pending_cancellation' => 'Đang chờ hủy',
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
                        ?>
                <tr>
                    <th style="width:120px;vertical-align:top;">Trạng thái</th>
                    <td><?php echo e($statusLabel[$history->status] ?? $history->status); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Ngày</th>
                    <td><?php echo e($history->created_at ? \Carbon\Carbon::parse($history->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') : '-'); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Giờ</th>
                    <td><?php echo e($history->created_at ? \Carbon\Carbon::parse($history->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') : '-'); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Mô tả</th>
                    <td><?php echo e($statusDesc[$history->status] ?? 'Cập nhật trạng thái'); ?></td>
                </tr>
                
                <?php if($history->status == 'pending_confirmation' && !empty($order->customer_note)): ?>
                <tr>
                    <th style="vertical-align:top;">Ghi chú khách hàng</th>
                    <td><?php echo e($order->customer_note); ?></td>
                </tr>
                <?php endif; ?>
                
                <?php if($history->status == 'cancelled' && !empty($order->cancellation_reason)): ?>
                <tr>
                    <th style="vertical-align:top;">Lý do hủy</th>
                    <td><?php echo e($order->cancellation_reason); ?></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($history->admin_note)): ?>
                <tr>
                    <th style="vertical-align:top;">Ghi chú quản trị</th>
                    <td><?php echo e($history->admin_note); ?></td>
                </tr>
                <?php endif; ?>
                <tr><td colspan="2"><hr style="margin:8px 0;"></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="2">Chưa có lịch sử trạng thái nào.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/tracking.blade.php ENDPATH**/ ?>