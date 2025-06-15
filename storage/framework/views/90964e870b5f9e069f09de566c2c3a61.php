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
                    <textarea name="admin_note" id="admin_note" rows="2" class="form-control" style="border-radius:8px;min-height:44px;"><?php echo e(old('admin_note', $order->admin_note)); ?></textarea>
                </div>
                <div class="mb-20" id="cancel_reason_box" style="display: none;">
                    <label class="body-title mb-8" for="cancellation_reason">Lý do hủy</label>
                    <textarea name="cancellation_reason" id="cancellation_reason" rows="2" class="form-control" style="border-radius:8px;min-height:44px;"><?php echo e(old('cancellation_reason', $order->cancellation_reason)); ?></textarea>
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
            <?php
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
            ?>
            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($step['show']): ?>
                <tr>
                    <th style="width:120px;vertical-align:top;">Trạng thái</th>
                    <td><?php echo e($step['label']); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Ngày</th>
                    <td><?php echo e($step['at'] ? \Carbon\Carbon::parse($step['at'])->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') : '-'); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Giờ</th>
                    <td><?php echo e($step['at'] ? \Carbon\Carbon::parse($step['at'])->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') : '-'); ?></td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Mô tả</th>
                    <td><?php echo e($step['desc']); ?></td>
                </tr>
                <?php if($step['note']): ?>
                <tr>
                    <th style="vertical-align:top;">Ghi chú</th>
                    <td><?php echo e($step['note']); ?></td>
                </tr>
                <?php endif; ?>
                <tr><td colspan="2"><hr style="margin:8px 0;"></td></tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>
<div class="bottom-page">
    <div class="body-text">Bản quyền © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Thiết kế bởi Themesflat. Đã đăng ký bản quyền.</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/tracking.blade.php ENDPATH**/ ?>