<?php $__env->startSection('title', 'Edit Order #' . $order->order_code); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap-20 mb-30">
            <h3 class="text-lg font-semibold">Edit Order #<?php echo e($order->order_code); ?></h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-tiny">Dashboard</a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><a href="<?php echo e(route('admin.orders.index')); ?>" class="text-tiny">Orders</a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li class="text-tiny">Edit Order</li>
            </ul>
        </div>

        <form action="<?php echo e(route('admin.orders.update', $order->id)); ?>" method="POST" class="wg-box mb-20" style="max-width: 700px;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Customer Name</label>
                    <input type="text" name="customer_name" value="<?php echo e(old('customer_name', $order->customer_name)); ?>" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Customer Email</label>
                    <input type="email" name="customer_email" value="<?php echo e(old('customer_email', $order->customer_email)); ?>" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Customer Phone</label>
                    <input type="text" name="customer_phone" value="<?php echo e(old('customer_phone', $order->customer_phone)); ?>" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Shipping Address</label>
                    <input type="text" name="shipping_address" value="<?php echo e(old('shipping_address', $order->shipping_address)); ?>" required class="input-field">
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Subtotal</label>
                    <input type="number" step="0.01" name="subtotal_amount" value="<?php echo e(old('subtotal_amount', $order->subtotal_amount)); ?>" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Shipping Fee</label>
                    <input type="number" step="0.01" name="shipping_fee" value="<?php echo e(old('shipping_fee', $order->shipping_fee)); ?>" required class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Discount</label>
                    <input type="number" step="0.01" name="discount_amount" value="<?php echo e(old('discount_amount', $order->discount_amount)); ?>" class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Tax</label>
                    <input type="number" step="0.01" name="tax_amount" value="<?php echo e(old('tax_amount', $order->tax_amount)); ?>" class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Total</label>
                    <input type="number" step="0.01" name="total_amount" value="<?php echo e(old('total_amount', $order->total_amount)); ?>" required class="input-field">
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Payment Method</label>
                    <select name="payment_method_id" required class="input-field">
                        <?php $__currentLoopData = \App\Models\PaymentMethod::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pm->id); ?>" <?php if($order->payment_method_id == $pm->id): ?> selected <?php endif; ?>><?php echo e($pm->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Payment Status</label>
                    <select name="payment_status" required class="input-field">
                        <option value="pending" <?php if($order->payment_status=='pending'): ?> selected <?php endif; ?>>Pending</option>
                        <option value="paid" <?php if($order->payment_status=='paid'): ?> selected <?php endif; ?>>Paid</option>
                        <option value="failed" <?php if($order->payment_status=='failed'): ?> selected <?php endif; ?>>Failed</option>
                        <option value="refunded" <?php if($order->payment_status=='refunded'): ?> selected <?php endif; ?>>Refunded</option>
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Shipping Method</label>
                    <select name="shipping_method_id" required class="input-field">
                        <?php $__currentLoopData = \App\Models\ShippingMethod::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sm->id); ?>" <?php if($order->shipping_method_id == $sm->id): ?> selected <?php endif; ?>><?php echo e($sm->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Order Status</label>
                    <select name="order_status" required class="input-field">
                        <option value="pending_confirmation" <?php if($order->order_status=='pending_confirmation'): ?> selected <?php endif; ?>>Pending Confirmation</option>
                        <option value="processing" <?php if($order->order_status=='processing'): ?> selected <?php endif; ?>>Processing</option>
                        <option value="shipped" <?php if($order->order_status=='shipped'): ?> selected <?php endif; ?>>Shipped</option>
                        <option value="delivered" <?php if($order->order_status=='delivered'): ?> selected <?php endif; ?>>Delivered</option>
                        <option value="cancelled" <?php if($order->order_status=='cancelled'): ?> selected <?php endif; ?>>Cancelled</option>
                        <option value="returned" <?php if($order->order_status=='returned'): ?> selected <?php endif; ?>>Returned</option>
                    </select>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Order Date</label>
                    <input type="datetime-local" name="ordered_at" value="<?php echo e(old('ordered_at', $order->ordered_at ? $order->ordered_at->format('Y-m-d\TH:i') : '')); ?>" class="input-field">
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Delivered At</label>
                    <input type="datetime-local" name="delivered_at" value="<?php echo e(old('delivered_at', $order->delivered_at ? $order->delivered_at->format('Y-m-d\TH:i') : '')); ?>" class="input-field">
                </fieldset>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Customer Note</label>
                    <textarea name="customer_note" rows="2" class="input-field"><?php echo e(old('customer_note', $order->customer_note)); ?></textarea>
                </fieldset>
                <fieldset class="mb-4">
                    <label class="body-title mb-2">Admin Note</label>
                    <textarea name="admin_note" rows="2" class="input-field"><?php echo e(old('admin_note', $order->admin_note)); ?></textarea>
                </fieldset>
            </div>

            <div class="flex justify-between mt-6">
                <button class="tf-button w-1/3" type="submit">Update Order</button>
                <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="tf-button w-1/3 style-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<div class="bottom-page">
    <div class="body-text">Copyright © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/orders/edit.blade.php ENDPATH**/ ?>