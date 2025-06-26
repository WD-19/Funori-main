<?php $__env->startSection('title', 'Danh sách đơn hàng'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <div>
                    <h3>Danh sách đơn hàng</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10 mt-2">
                        <li>
                            <a href="<?php echo e(route('admin.dashboard')); ?>">
                                <div class="text-tiny">Bảng điều khiển</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Danh sách đơn hàng</div>
                        </li>
                    </ul>
                </div>
                <form class="form-search flex gap9 items-end" method="get" action="<?php echo e(route('admin.orders.index')); ?>"
                    style="background:#f9fafb;padding:12px 18px;border-radius:10px;">
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Mã đơn/Khách</label>
                        <input type="text" placeholder="Nhập mã đơn hoặc tên khách..." name="q"
                            value="<?php echo e(request('q')); ?>" class="input-field" style="min-width:150px;">
                    </fieldset>
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Sản phẩm</label>
                        <input type="text" placeholder="Tên sản phẩm..." name="product" value="<?php echo e(request('product')); ?>"
                            class="input-field" style="min-width:120px;">
                    </fieldset>
                    <fieldset class="mb-0">
                        <label class="body-title mb-2 block">Trạng thái</label>
                        <select name="status" class="form-select" style="min-width:120px;">
                            <option value="">-- Tất cả --</option>
                            <option value="pending_confirmation" <?php if(request('status') == 'pending_confirmation'): ?> selected <?php endif; ?>>Chờ xử lý
                            </option>
                            <option value="processing" <?php if(request('status') == 'processing'): ?> selected <?php endif; ?>>Đang xử lý</option>
                            <option value="shipped" <?php if(request('status') == 'shipped'): ?> selected <?php endif; ?>>Đang giao hàng
                            </option>
                            <option value="delivered" <?php if(request('status') == 'delivered'): ?> selected <?php endif; ?>>Đã giao</option>
                            <option value="cancelled" <?php if(request('status') == 'cancelled'): ?> selected <?php endif; ?>>Đã hủy</option>
                            <option value="returned" <?php if(request('status') == 'returned'): ?> selected <?php endif; ?>>Đã trả hàng</option>

                        </select>
                    </fieldset>
                    <button class="btn btn-primary flex items-center gap-2 mt-6 px-2 py-1" type="submit"
                        style="font-size:12px; border-radius:6px;">
                        <i class="icon-search" style="font-size:14px;"></i>
                        <span>Tìm</span>
                    </button>

                </form>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="wg-table table-all-category mt-2">
                    <ul class="table-title flex mb-14" style="background:#f3f4f6; padding: 0 12px;">
                        <li style="width: 30px; text-align: center; flex-shrink: 0;">
                            <div class="body-title">STT</div>
                        </li>

                        <li style="min-width:120px; padding-left: 10px;">
                            <div class="body-title">Mã đơn</div>
                        </li>
                        <li style="min-width:100px; padding-left: 10px;">
                            <div class="body-title">Giá trị</div>
                        </li>
                        <li style="min-width:80px; padding-left: 10px;">
                            <div class="body-title">SL</div>
                        </li>
                        <li style="min-width:120px; padding-left: 10px;">
                            <div class="body-title">Thanh toán</div>
                        </li>
                        <li style="min-width:120px; padding-left: 10px;">
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li style="min-width:90px; padding-left: 10px;">
                            <div class="body-title">Theo dõi</div>
                        </li>
                        <li style="min-width:110px; padding-left: 10px;">
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="wg-product item-row"
                                style="display: flex; align-items:center; border-bottom:1px solid #eee; padding: 12px;">
                                <div class="body-text text-main-dark" style="width: 30px; text-align: center; flex-shrink: 0;">
                                    <?php echo e($orders->firstItem() + $loop->index); ?>

                                </div>

                                <div class="body-text text-main-dark" style="min-width:120px; padding-left: 10px;"><?php echo e($order->order_code); ?>

                                </div>
                                <div class="body-text text-main-dark" style="min-width:100px; padding-left: 10px;">
                                    <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>₫</div>
                                <div class="body-text text-main-dark" style="min-width:80px; padding-left: 10px;">
                                    <?php echo e($order->items->sum('quantity')); ?></div>
                                <div class="body-text text-main-dark" style="min-width:120px; padding-left: 10px;">
                                    <?php echo e(optional($order->paymentMethod)->name ?? ($order->payment_method ?? 'Không có')); ?>

                                </div>
                                <div style="min-width:120px; padding-left: 10px;">
                                    <?php if($order->order_status === 'delivered'): ?>
                                        <span class="block-available bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đã giao</span>
                                    <?php elseif($order->order_status === 'pending' || $order->order_status === 'pending_confirmation'): ?>
                                        <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Chờ
                                            xử lý</span>
                                    <?php elseif($order->order_status === 'pending_cancellation'): ?>
                                        <span class="block-pending fw-7"
                                            style="background:#ef4444;color:#fff;padding:2px 8px;border-radius:6px;">Chờ
                                            hủy</span>
                                    <?php elseif($order->order_status === 'cancelled'): ?>
                                        <span class="block-pending bg-1 fw-7"
                                            style="background:#f87171;padding:2px 8px;border-radius:6px;">Đã hủy</span>
                                    <?php elseif($order->order_status === 'processing'): ?>
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đang xử lý</span>
                                    <?php elseif($order->order_status === 'shipped'): ?>
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;">Đang giao hàng</span>
                                    <?php elseif($order->order_status === 'returned'): ?>
                                        <span class="block-pending bg-1 fw-7" style="padding:2px 8px;border-radius:6px;">Đã
                                            trả hàng</span>
                                    <?php else: ?>
                                        <span class="block-pending bg-1 fw-7"
                                            style="padding:2px 8px;border-radius:6px;"><?php echo e(ucfirst(str_replace('_', ' ', $order->order_status))); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div style="min-width:90px; padding-left: 10px;">
                                    <a href="<?php echo e(route('admin.orders.tracking', $order->id)); ?>" class="block-tracking bg-1"
                                        style="padding:2px 8px;border-radius:6px;">Theo dõi</a>
                                </div>
                                <div class="list-icon-function" style="padding-left: 10px;">
                                    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="item eye"
                                        title="View"><i class="icon-eye"></i></a>

                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <div class="body-text text-center py-4">Không tìm thấy đơn hàng nào.</div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị <?php echo e($orders->firstItem() ?? 0); ?> đến <?php echo e($orders->lastItem() ?? 0); ?> của
                        <?php echo e($orders->total()); ?> đơn hàng
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            <?php if($orders->onFirstPage()): ?>
                                <span><i class="icon-chevron-left"></i></span>
                            <?php else: ?>
                                <a href="<?php echo e($orders->previousPageUrl()); ?>"><i class="icon-chevron-left"></i></a>
                            <?php endif; ?>
                        </li>
                        <?php $__currentLoopData = $orders->getUrlRange(1, $orders->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="<?php echo e($page == $orders->currentPage() ? 'active' : ''); ?>">
                                <a href="<?php echo e($page == $orders->currentPage() ? 'javascript:void(0);' : $url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <?php if($orders->hasMorePages()): ?>
                                <a href="<?php echo e($orders->nextPageUrl()); ?>"><i class="icon-chevron-right"></i></a>
                            <?php else: ?>
                                <span><i class="icon-chevron-right"></i></span>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /order-list -->
        </div>
    </div>

    <!-- /order-list -->
    </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>