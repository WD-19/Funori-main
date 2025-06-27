<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Danh sách thương hiệu</h3>
            <a href="<?php echo e(route('admin.brands.create')); ?>" class="tf-button style-1 w208">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>
        <div class="wg-box">
            <div class="title-box">
                <i class="icon-layers"></i>
                <div class="body-text">Quản lý các thương hiệu của bạn tại đây. Bạn có thể chỉnh sửa, ẩn/hiện hoặc xóa thương hiệu theo nhu cầu.</div>
            </div>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li style="width:7%"><div class="body-title">ID</div></li>
                    <li style="width:18%"><div class="body-title">Tên</div></li>
                    <li style="width:18%"><div class="body-title">Slug</div></li>
                    <li style="width:15%"><div class="body-title">Logo</div></li>
                    <li style="width:12%"><div class="body-title">Trạng thái</div></li>
                    <li style="width:30%"><div class="body-title">Hành động</div></li>
                </ul>
                <ul class="flex flex-column">
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="wg-product item-row gap20" style="align-items:center;">
                        <div class="body-text" style="width:7%"><?php echo e($brand->id); ?></div>
                        <div class="body-text fw-7" style="width:18%"><?php echo e($brand->name); ?></div>
                        <div class="body-text" style="width:18%"><?php echo e($brand->slug); ?></div>
                        <div class="body-text" style="width:15%">
                            <?php if($brand->logo_url): ?>
                                <img src="<?php echo e(Storage::url($brand->logo_url)); ?>" alt="Logo" width="60">
                            <?php else: ?>
                                <span class="text-muted">Không có</span>
                            <?php endif; ?>
                        </div>
                        <div style="width:12%">
                            <?php if($brand->is_active): ?>
                                <span class="block-available bg-1 fw-7">Hiện</span>
                            <?php else: ?>
                                <span class="block-stock bg-1 fw-7">Ẩn</span>
                            <?php endif; ?>
                        </div>
                        <div class="list-icon-function" style="width:30%;display:flex;gap:8px;align-items:center;">
                            <a href="<?php echo e(route('admin.brands.edit', $brand)); ?>" class="tf-button style-1 small">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="<?php echo e(route('admin.brands.destroy', $brand)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn?');">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="tf-button style-2 custom-danger">
                                    <i class="bi bi-trash"></i> 
                                </button>
                            </form>
                            <form action="<?php echo e(route('admin.brands.toggle', $brand)); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="tf-button style-1 small">
                                    <i class="bi <?php echo e($brand->is_active ? 'bi-eye-slash' : 'bi-eye'); ?>"></i> <?php echo e($brand->is_active ? 'Ẩn' : 'Hiện'); ?>

                                </button>
                            </form>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .tf-button.custom-danger {
        background: #e3342f;
        border-color: #e3342f;
        color: #fff;
        transition: background 0.2s, border-color 0.2s;
    }
    .tf-button.custom-danger:hover,
    .tf-button.custom-danger:focus {
        background: #b91c1c;
        border-color: #b91c1c;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/brands/index.blade.php ENDPATH**/ ?>