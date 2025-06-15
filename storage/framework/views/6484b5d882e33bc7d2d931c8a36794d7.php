<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách đánh giá</h3>
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
                        <a href="#">
                            <div class="text-tiny">Đánh giá</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh sách đánh giá</div>
                    </li>
                </ul>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm người dùng hoặc sản phẩm..." name="keyword"
                                    value="<?php echo e(request('keyword')); ?>">
                            </fieldset>
                            <fieldset>
                                <select name="status">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Chờ duyệt
                                    </option>
                                    <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>
                                        Đã duyệt</option>
                                    <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>
                                        Từ chối</option>
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="#">
                        
                        <i class="icon-file-text"></i>Xuất tất cả đánh giá
                    </a>
                </div>
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Mã đơn hàng</div>
                        </li>
                        <li>
                            <div class="body-title">Tên người dùng</div>
                        </li>
                        <li>
                            <div class="body-title">Tên sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">Đánh giá</div>
                        </li>
                        <li>
                            <div class="body-title">Bình luận</div>
                        </li>
                        <li>
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li>
                            <div class="body-title">Số lượng</div>
                        </li>
                        <li>
                            <div class="body-title">Thành tiền</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="wg-product item-row gap20">
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php
                                        $orderId = $value->orderItem->order_id ?? null;
                                        $order = $orders->firstWhere('id', $orderId);
                                    ?>
                                    <?php echo e($order ? $order->order_code : $orderId ?? 'N/A'); ?>

                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->user->full_name ? $value->user->full_name : $value->user->full_name ?? $value->user->id); ?>

                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->product ? $value->product->name : $value->product_name ?? $value->product_id); ?>

                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <span class="badge" style="background: #ffc107; color: #111; font-weight: bold;">
                                        ★ <?php echo e($value->rating ?? 'N/A'); ?>

                                    </span>
                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    (Xem chi tiết)
                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php
                                        $status = strtolower($value->status ?? '');
                                        $statusColor = match ($status) {
                                            'approved' => '#28a745',
                                            'pending' => '#ffc107',
                                            'rejected' => '#dc3545',
                                            default => '#6c757d',
                                        };
                                    ?>
                                    <span class="badge"
                                        style="background: <?php echo e($statusColor); ?>; color: #fff; font-weight: bold;">
                                        <?php echo e($value->status == 'approved' ? 'Đã duyệt' : ($value->status == 'pending' ? 'Chờ duyệt' : ($value->status == 'rejected' ? 'Từ chối' : 'Không rõ'))); ?>

                                    </span>
                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->orderItem->quantity ?? 'N/A'); ?>

                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e(isset($value->orderItem->subtotal) ? number_format($value->orderItem->subtotal, 2) : 'N/A'); ?>

                                </div>
                                
                                <div class="list-icon-function">
                                    <div class="list-icon-function">
                                        <div class="item eye" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal<?php echo e($value->id); ?>">
                                            <i class="icon-eye"></i>
                                        </div>
                                        <!-- Modal Quick View Review -->
                                        <div class="modal fade" id="quickViewModal<?php echo e($value->id); ?>" tabindex="-1"
                                            aria-labelledby="quickViewLabel<?php echo e($value->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content shadow-lg rounded-5 border-0"
                                                    style="font-size: 18px; border-radius: 32px;">
                                                    <div class="modal-header bg-gradient-primary text-white rounded-top-5"
                                                        style="background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%); border-top-left-radius: 32px; border-top-right-radius: 32px;">
                                                        <h3 class="modal-title fw-bold mb-0 text-light"
                                                            id="quickViewLabel<?php echo e($value->id); ?>">
                                                            <i class="fa-solid fa-star-half-stroke me-2"></i>Chi tiết đánh giá
                                                        </h3>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                    </div>
                                                    <div class="modal-body px-5 py-4"
                                                        style="background: #f8fafc; border-bottom-left-radius: 32px; border-bottom-right-radius: 32px;">
                                                        <div class="row gy-4">
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-barcode me-2 text-primary"></i>
                                                                <strong>Mã đơn hàng:</strong>
                                                                <span class="text-dark ms-1 fs-5">
                                                                    <?php
                                                                        $orderId = $value->orderItem->order_id ?? null;
                                                                        $order = $orders->firstWhere('id', $orderId);
                                                                    ?>
                                                                    <?php echo e($order ? $order->order_code : $orderId ?? 'N/A'); ?>

                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-user me-2 text-primary"></i>
                                                                <strong>Người dùng:</strong>
                                                                <span class="text-dark ms-1 fs-5"><?php echo e($value->user->full_name ?? 'Không rõ'); ?></span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-box-open me-2 text-primary"></i>
                                                                <strong>Sản phẩm:</strong>
                                                                <span class="text-dark ms-1 fs-5"><?php echo e($value->product->name ?? ($value->product_name ?? 'Không rõ')); ?></span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-sort-numeric-up me-2 text-primary"></i>
                                                                <strong>Số lượng:</strong>
                                                                <span class="text-dark ms-1 fs-5"><?php echo e($value->orderItem->quantity ?? 'N/A'); ?></span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-money-bill-wave me-2 text-primary"></i>
                                                                <strong>Thành tiền:</strong>
                                                                <span class="text-dark ms-1 fs-5">
                                                                    <?php echo e(isset($value->orderItem->subtotal) ? number_format($value->orderItem->subtotal, 2) : 'N/A'); ?>

                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-star text-warning me-2"></i>
                                                                <strong>Đánh giá:</strong>
                                                                <span class="ms-1">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <?php if($i <= $value->rating): ?>
                                                                            <i class="fa-solid fa-star text-warning fs-4"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa-regular fa-star text-warning fs-4"></i>
                                                                        <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                    <span class="text-muted fs-5">(<?php echo e($value->rating ?? 'N/A'); ?>)</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                <i class="fa-solid fa-comment-dots me-2 text-primary"></i>
                                                                <strong>Bình luận:</strong>
                                                                <div class="border rounded-4 p-4 bg-white text-secondary fst-italic mt-2 fs-5 shadow-sm">
                                                                    <?php echo e($value->comment ?? '(Không có bình luận)'); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-circle-info me-2 text-primary"></i>
                                                                <strong>Trạng thái:</strong>
                                                                <?php
                                                                    $status = strtolower($value->status ?? '');
                                                                    $statusColor = match ($status) {
                                                                        'approved' => '#28a745',
                                                                        'pending' => '#ffc107',
                                                                        'rejected' => '#dc3545',
                                                                        default => '#6c757d',
                                                                    };
                                                                    $statusText = match ($status) {
                                                                        'approved' => 'Đã duyệt',
                                                                        'pending' => 'Chờ duyệt',
                                                                        'rejected' => 'Từ chối',
                                                                        default => 'Không rõ',
                                                                    };
                                                                ?>
                                                                <span class="badge ms-2 fs-6"
                                                                    style="background: <?php echo e($statusColor); ?>; color: #fff; font-weight: bold; border-radius: 12px; padding: 8px 18px;">
                                                                    <?php echo e($statusText); ?>

                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <i class="fa-solid fa-calendar-days me-2 text-primary"></i>
                                                                <strong>Ngày tạo:</strong>
                                                                <span class="text-dark ms-1 fs-5"><?php echo e($value->created_at->format('d-m-Y H:i')); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item edit">
                                            <a href="<?php echo e(route('admin.reviews.edit', $value->id)); ?>"><i
                                                    class="icon-edit-3"></i></a>
                                        </div>
                                        
                                    </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị <?php echo e($reviews->firstItem()); ?> đến <?php echo e($reviews->lastItem()); ?> trong tổng số
                        <?php echo e($reviews->total()); ?> bản ghi
                    </div>

                    <ul class="wg-pagination">
                        
                        <li class="<?php echo e($reviews->onFirstPage() ? 'disabled' : ''); ?>">
                            <a href="<?php echo e($reviews->previousPageUrl() ?? '#'); ?>">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        
                        <?php for($i = 1; $i <= $reviews->lastPage(); $i++): ?>
                            <li class="<?php echo e($reviews->currentPage() == $i ? 'active' : ''); ?>">
                                <a href="<?php echo e($reviews->url($i)); ?>"><?php echo e($i); ?></a>
                            </li>
                        <?php endfor; ?>

                        
                        <li class="<?php echo e($reviews->hasMorePages() ? '' : 'disabled'); ?>">
                            <a href="<?php echo e($reviews->nextPageUrl() ?? '#'); ?>">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /order-list -->
        </div>
        <!-- /main-content-wrap -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>