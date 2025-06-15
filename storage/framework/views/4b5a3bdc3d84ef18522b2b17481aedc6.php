<?php $__env->startSection('content'); ?>
    <?php use Illuminate\Support\Str; ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thùng rác đánh giá</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.reviews.index')); ?>">
                            <div class="text-tiny">Đánh giá</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thùng rác</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Người dùng</div>
                        </li>
                        <li>
                            <div class="body-title">Sản phẩm</div>
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
                            <div class="body-title">Ngày xóa</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="wg-product item-row gap20">
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->user->full_name ?? 'Không rõ'); ?>

                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->product->name ?? 'Không rõ'); ?>

                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <span class="badge" style="background: #ffc107; color: #111; font-weight: bold;">
                                        ★ <?php echo e($value->rating ?? 'N/A'); ?>

                                    </span>
                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e(Str::limit($value->comment, 30)); ?>

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
                                        $statusText = match ($status) {
                                            'approved' => 'Đã duyệt',
                                            'pending' => 'Chờ duyệt',
                                            'rejected' => 'Từ chối',
                                            default => 'Không rõ',
                                        };
                                    ?>
                                    <span class="badge"
                                        style="background: <?php echo e($statusColor); ?>; color: #fff; font-weight: bold;">
                                        <?php echo e($statusText); ?>

                                    </span>
                                </div>
                                
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->deleted_at ? $value->deleted_at->format('d-m-Y H:i') : ''); ?>

                                </div>
                                
                                <div class="list-icon-function flex gap10">
                                    <!-- Khôi phục -->
                                    <div class="item undo">
                                        <form action="<?php echo e(route('admin.reviews.restore', $value->id)); ?>" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục đánh giá này?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;"
                                                title="Khôi phục">
                                                <i class="icon-rotate-ccw" style="color: green; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Xóa vĩnh viễn -->
                                    <div class="item trash">
                                        <form action="<?php echo e(route('admin.reviews.forceDelete', $value->id)); ?>" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đánh giá này?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;"
                                                title="Xóa vĩnh viễn">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="body-text text-center w-full py-4" style="font-size: 1.1rem; color: #888;">
                                Không có đánh giá nào trong thùng rác.
                            </li>
                        <?php endif; ?>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/reviews/trash.blade.php ENDPATH**/ ?>