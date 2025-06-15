<?php
    $allStatuses = [
        'pending_confirmation' => 'Pending Confirmation',
        'processing' => 'Processing',
        'shipped' => 'Shipped',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled',
        'returned' => 'Returned',
    ];
?>

<?php if(empty($transitions[$currentStatus])): ?>
    <div class="alert alert-info mb-0">Không thể chuyển tiếp trạng thái.</div>
<?php else: ?>
    <select name="order_status" id="order_status" class="form-select" style="height:44px; border-radius:8px;" required>
        <?php $__currentLoopData = $transitions[$currentStatus]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($status); ?>" <?php if($order->order_status == $status): ?> selected <?php endif; ?>>
                <?php echo e($allStatuses[$status] ?? ucfirst($status)); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/orders/_status.blade.php ENDPATH**/ ?>