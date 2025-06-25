<?php $__env->startSection('title', 'Danh sách phương thức thanh toán'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success mb-3" style="font-size:1.25rem; font-weight:bold;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Danh sách phương thức thanh toán</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Bảng điều khiển</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Phương thức thanh toán</div></li>
            </ul>
        </div>

        <div style="margin-bottom: 20px;">
            <a class="tf-button style-1 w208" href="<?php echo e(route('admin.payment_methods.create')); ?>">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>

        <div class="wg-box">
            <div class="title-box">
                <i class="icon-credit-card"></i>
                <div class="body-text">
                    Quản lý các phương thức thanh toán tại đây. Bạn có thể bật/tắt hoặc xóa phương thức theo nhu cầu.
                </div>
            </div>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li style="width:7%"><div class="body-title">ID</div></li>
                    <li style="width:18%"><div class="body-title">Tên</div></li>
                    <li style="width:15%"><div class="body-title">Mã</div></li>
                    <li style="width:30%"><div class="body-title">Mô tả</div></li>
                    <li style="width:12%"><div class="body-title">Trạng thái</div></li>
                    <li style="width:18%"><div class="body-title">Hành động</div></li>
                </ul>
                <ul class="flex flex-column">
                    <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="wg-product item-row gap20" style="align-items:center;">
                        <div class="body-text" style="width:7%"><?php echo e($method->id); ?></div>
                        <div class="body-text fw-7" style="width:18%"><?php echo e($method->name); ?></div>
                        <div class="body-text" style="width:15%"><?php echo e($method->code); ?></div>
                        <div class="body-text" style="width:30%"><?php echo e(Str::limit($method->description, 40)); ?></div>
                        <div style="width:12%">
                            <?php if($method->is_active): ?>
                                <span class="block-available bg-1 fw-7">Đang bật</span>
                            <?php else: ?>
                                <span class="block-stock bg-1 fw-7">Đang tắt</span>
                            <?php endif; ?>
                        </div>
                        <div class="list-icon-function" style="width:18%;display:flex;gap:8px;align-items:center;">
                            <form action="<?php echo e(route('admin.payment_methods.toggle', $method->id)); ?>" method="POST" style="display:inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button type="submit" class="tf-button style-1 small">
                                    <i class="bi <?php echo e($method->is_active ? 'bi-toggle-off' : 'bi-toggle-on'); ?>"></i> <?php echo e($method->is_active ? 'Tắt' : 'Bật'); ?>

                                </button>
                            </form>
                            <form action="<?php echo e(route('admin.payment_methods.destroy', $method->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="tf-button style-2 custom-danger">
                                    <i class="bi bi-trash"></i>
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
    .tf-button.custom-danger:hover, .tf-button.custom-danger:focus {
        background: #b91c1c;
        border-color: #b91c1c;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/payment_method/index.blade.php ENDPATH**/ ?>