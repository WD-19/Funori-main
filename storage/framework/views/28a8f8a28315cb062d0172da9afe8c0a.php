<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Edit Review</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="<?php echo e(route('admin.reviews.index')); ?>">
                            <div class="text-tiny">Reviews</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Edit Review</div>
                    </li>
                </ul>
            </div>
            <!-- form-edit-review -->
            <form class="form-edit-review" method="POST" action="<?php echo e(route('admin.reviews.update', $review->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="wg-box mb-30">
                    <fieldset>
                        <div class="body-title mb-10">User</div>
                        <input type="text" class="form-control" value="<?php echo e($review->user->full_name ?? 'Unknown'); ?>"
                            readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Product</div>
                        <input type="text" class="form-control" value="<?php echo e($review->product->name ?? 'Unknown'); ?>"
                            readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Order Code</div>
                        <?php
                            $orderId = $review->orderItem->order_id ?? null;
                            $order = $orders->firstWhere('id', $orderId);
                        ?>
                        <input type="text" class="form-control"
                            value="<?php echo e($order ? $order->order_code : $orderId ?? 'N/A'); ?>" readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Rating</div>
                        <div class="d-flex align-items-center">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= $review->rating): ?>
                                    <span style="color: orange; font-size: 22px;">&#9733;</span>
                                <?php else: ?>
                                    <span style="color: lightgray; font-size: 22px;">&#9733;</span>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <span class="ms-2 text-muted">(<?php echo e($review->rating); ?>)</span>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Comment</div>
                        <input type="text" name="comment" class="form-control" min="1" max="5"
                            value="<?php echo e(old('comment', $review->comment)); ?>" readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Status*</div>
                        <select name="status">
                            <option value="pending" <?php echo e($review->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="approved" <?php echo e($review->status == 'approved' ? 'selected' : ''); ?>>Approved</option>
                            <option value="rejected" <?php echo e($review->status == 'rejected' ? 'selected' : ''); ?>>Rejected
                            </option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Created At</div>
                        <input type="text" class="form-control" value="<?php echo e($review->created_at->format('d-m-Y H:i')); ?>"
                            readonly>
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Update Review</button>
                    <a href="<?php echo e(route('admin.reviews.index')); ?>" class="tf-button style-3 w380">Cancel</a>
                </div>
            </form>
            <!-- /form-edit-review -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/reviews/edit.blade.php ENDPATH**/ ?>