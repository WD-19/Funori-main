<?php $__env->startSection('title', 'Quản lý khuyến mãi'); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>All Promotions</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Promotions</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap mb-20">
                <div class="wg-filter flex-grow">
                    <form class="form-search" method="GET" action="<?php echo e(route('admin.promotions.index')); ?>">
                        <fieldset class="name">
                            <input type="text" placeholder="Tìm kiếm tên hoặc mã..." name="q" tabindex="2"
                                value="<?php echo e(request('q')); ?>">
                        </fieldset>
                        <div class="button-submit">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="<?php echo e(route('admin.promotions.create')); ?>"><i class="icon-plus"></i>Thêm khuyến mãi</a>
            </div>
            <?php if(session('success')): ?>
                <div class="alert alert-success mb-3"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li><div class="body-title">Tên</div></li>
                    <li><div class="body-title">Mã</div></li>
                    <li><div class="body-title">Loại</div></li>
                    <li><div class="body-title">Giá trị</div></li>
                    <li><div class="body-title">Thời gian</div></li>
                    <li><div class="body-title">Trạng thái</div></li>
                    <li><div class="body-title">Áp dụng</div></li>
                    <li><div class="body-title">Ngày tạo</div></li>
                    <li><div class="body-title">Hành động</div></li>
                </ul>
                <ul class="flex flex-column">
                    <?php $__empty_1 = true; $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="wg-product item-row gap20">
                        <div class="body-text"><?php echo e($promotion->name); ?></div>
                        <div class="body-text"><?php echo e($promotion->code); ?></div>
                        <div>
                            <span class="badge bg-info">
                                <?php echo e($promotion->discount_type == 'percentage' ? 'Phần trăm' : 'Tiền mặt'); ?>

                            </span>
                        </div>
                        <div class="body-text">
                            <?php echo e($promotion->discount_type == 'percentage' ? $promotion->discount_value.'%' : number_format($promotion->discount_value,0,',','.') . ' đ'); ?>

                        </div>
                        <div class="body-text">
                            <?php echo e($promotion->start_date ? $promotion->start_date->format('d/m/Y') : '-'); ?><br>
                            <?php echo e($promotion->end_date ? $promotion->end_date->format('d/m/Y') : '-'); ?>

                        </div>
                        <div>
                            <?php if($promotion->is_active): ?>
                                <span class="badge bg-success">Kích hoạt</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Ẩn</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if($promotion->applies_to == 'all_products'): ?>
                                <span class="badge bg-info text-dark">Tất cả SP</span>
                            <?php elseif($promotion->applies_to == 'specific_products'): ?>
                                <span class="badge bg-primary">Sản phẩm</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Danh mục</span>
                            <?php endif; ?>
                        </div>
                        <div class="body-text">
                            <?php echo e($promotion->created_at ? $promotion->created_at->format('d/m/Y') : '-'); ?>

                        </div>
                        <div class="list-icon-function">
                            <div class="item edit">
                                <a href="<?php echo e(route('admin.promotions.edit', $promotion->id)); ?>"><i class="icon-edit-3"></i></a>
                            </div>
                            <div class="item trash">
                                <form action="<?php echo e(route('admin.promotions.destroy', $promotion->id)); ?>" method="POST" onsubmit="return confirm('Xóa khuyến mãi này?');" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="background:transparent;border:none;padding:0;">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="text-center text-muted py-4">Chưa có khuyến mãi nào.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div class="text-tiny">
                    Hiển thị <?php echo e($promotions->firstItem()); ?> đến <?php echo e($promotions->lastItem()); ?> của <?php echo e($promotions->total()); ?> khuyến mãi
                </div>
                <ul class="wg-pagination">
                    <li>
                        <?php if($promotions->onFirstPage()): ?>
                        <span><i class="icon-chevron-left"></i></span>
                        <?php else: ?>
                        <a href="<?php echo e($promotions->previousPageUrl()); ?>"><i class="icon-chevron-left"></i></a>
                        <?php endif; ?>
                    </li>
                    <?php $__currentLoopData = $promotions->getUrlRange(1, $promotions->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($page == $promotions->currentPage() ? 'active' : ''); ?>">
                        <?php if($page == $promotions->currentPage()): ?>
                        <span><?php echo e($page); ?></span>
                        <?php else: ?>
                        <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <?php if($promotions->hasMorePages()): ?>
                        <a href="<?php echo e($promotions->nextPageUrl()); ?>"><i class="icon-chevron-right"></i></a>
                        <?php else: ?>
                        <span><i class="icon-chevron-right"></i></span>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/promotions/index.blade.php ENDPATH**/ ?>