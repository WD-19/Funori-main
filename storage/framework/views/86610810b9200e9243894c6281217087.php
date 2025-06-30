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
                        <div class="body-title mb-10">Người dùng</div>
                        <input type="text" class="form-control" value="<?php echo e($review->user->full_name ?? 'Không rõ'); ?>"
                            readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Sản phẩm</div>
                        <input type="text" class="form-control" value="<?php echo e($review->product->name ?? 'Không rõ'); ?>"
                            readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Mã đơn hàng</div>
                        <?php
                            $orderId = $review->orderItem->order_id ?? null;
                            $order = $orders->firstWhere('id', $orderId);
                        ?>
                        <input type="text" class="form-control"
                            value="<?php echo e($order ? $order->order_code : $orderId ?? 'N/A'); ?>" readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Đánh giá (sao)</div>
                        <input type="number" name="rating" class="form-control" min="1" max="5"
                            value="<?php echo e(old('rating', $review->rating)); ?>" readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Bình luận</div>
                        <input name="comment" type="text" class="form-control" value="<?php echo e(old('comment', $review->comment)); ?>" readonly></input>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Trạng thái*</div>
                        <select name="status">
                            <option value="pending" <?php echo e($review->status == 'pending' ? 'selected' : ''); ?>>Chờ duyệt
                            </option>
                            <option value="approved" <?php echo e($review->status == 'approved' ? 'selected' : ''); ?>>Đã duyệt
                            </option>
                            <option value="rejected" <?php echo e($review->status == 'rejected' ? 'selected' : ''); ?>>Từ chối
                            </option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Ngày tạo</div>
                        <input type="text" class="form-control" value="<?php echo e($review->created_at->format('d-m-Y H:i')); ?>"
                            readonly>
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Cập nhật đánh giá</button>
                    <a href="<?php echo e(route('admin.reviews.index')); ?>" class="tf-button style-3 w380">Hủy</a>
                </div>
            </form>
            <!-- /form-edit-review -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/reviews/edit.blade.php ENDPATH**/ ?>