<?php $__env->startSection('title', 'Chi tiết Banner'); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap-20 mb-30">
            <h3 class="text-lg font-semibold">Chi tiết Banner</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"><div class="text-tiny">Bảng điều khiển</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.banners.index')); ?>"><div class="text-tiny">Banner</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Chi tiết</div>
                </li>
            </ul>
        </div>
        <div class="wg-box" style="max-width:600px;margin:auto;">
            <div class="mb-4 text-center">
                <img src="<?php echo e(asset('storage/' . $banner->image_url)); ?>" alt="" style="max-width:100%;height:auto;border-radius:8px;">
            </div>
            <div class="mb-3">
                <strong>Tiêu đề:</strong> <?php echo e($banner->title); ?>

            </div>
            <div class="mb-3">
                <strong>Link:</strong>
                <?php if($banner->link): ?>
                    <a href="<?php echo e($banner->link); ?>" target="_blank" class="text-blue-600 underline"><?php echo e($banner->link); ?></a>
                <?php else: ?>
                    <span>-</span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <strong>Vị trí:</strong> <?php echo e($banner->position); ?>

            </div>
            <div class="mb-3">
                <strong>Thứ tự:</strong> <?php echo e($banner->order); ?>

            </div>
            <div class="mb-3">
                <strong>Thời gian sử dụng:</strong>
                <div>
                    <?php echo e($banner->start_at ? \Carbon\Carbon::parse($banner->start_at)->format('d/m/Y H:i') : '-'); ?>

                    &rarr;
                    <?php echo e($banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('d/m/Y H:i') : '-'); ?>

                </div>
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong>
                <?php if($banner->is_active): ?>
                    <span class="badge bg-success">Hiện</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Ẩn</span>
                <?php endif; ?>
            </div>
            <div class="mt-4 flex gap-2">
                <a href="<?php echo e(route('admin.banners.index')); ?>" class="tf-button style">Quay lại</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/banners/show.blade.php ENDPATH**/ ?>