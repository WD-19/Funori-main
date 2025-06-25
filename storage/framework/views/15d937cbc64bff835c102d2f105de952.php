<?php
    $allStatuses = [
        'pending_confirmation' => 'Pending Confirmation',
<<<<<<< HEAD
        'processing' => 'đang xử lý',
        'shipped' => 'đang giao hàng',
        'delivered' => 'Đã nhận hàng',
        'cancelled' => 'Đã hủy đơn hàng',
        'returned' => 'Đã trả hàng',
    ];
?>

<?php
    $statuses = $transitions[$currentStatus] ?? [];

    // Nếu đang giao hàng thì loại bỏ trạng thái 'cancelled'
    if ($currentStatus === 'shipped') {
        // Giữ lại các trạng thái khác ngoài 'cancelled'
        $statuses = array_filter($statuses, function($status) {
            return $status !== 'cancelled';
        });
       
    }
?>

<?php if(empty($statuses)): ?>
    <div class="alert alert-info mb-0">Không thể chuyển tiếp trạng thái.</div>
<?php else: ?>
    <select name="order_status" id="order_status" class="form-select" style="height:44px; border-radius:8px;" required>
        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
=======
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
>>>>>>> c9d4f3a268865ac8e0d7ac4322e51f500868f71c
            <option value="<?php echo e($status); ?>" <?php if($order->order_status == $status): ?> selected <?php endif; ?>>
                <?php echo e($allStatuses[$status] ?? ucfirst($status)); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php endif; ?>
<<<<<<< HEAD

=======
>>>>>>> c9d4f3a268865ac8e0d7ac4322e51f500868f71c
<?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/_status.blade.php ENDPATH**/ ?>