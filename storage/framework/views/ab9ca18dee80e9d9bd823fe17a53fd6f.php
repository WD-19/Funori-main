<?php $__env->startSection('title', 'Quản lý phương thức giao hàng'); ?>

<?php $__env->startSection('content'); ?>
 <?php if(session('success')): ?>
                <div class="alert alert-success mb-3" style="font-size:1.25rem; font-weight:bold;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Shipping Methods</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Shipping Methods</div></li>
            </ul>
        </div>
        <div style="margin-bottom: 20px;">
            <a class="tf-button style-1 w208" href="<?php echo e(route('admin.shipping_methods.create')); ?>">
                <i class="icon-plus"></i> Add new
            </a>
        </div>
        <div class="wg-box">
            <div class="title-box">
                <i class="icon-truck"></i>
                <div class="body-text">Manage shipping methods. You can hide or delete methods here.</div>
            </div>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li style="width:20%"><div class="body-title">Name</div></li>
                    <li style="width:30%"><div class="body-title">Description</div></li>
                    <li style="width:15%"><div class="body-title">Cost</div></li>
                    <li style="width:15%"><div class="body-title">Active</div></li>
                    <li style="width:20%"><div class="body-title">Action</div></li>
                </ul>
                <ul class="flex flex-column">
                    <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="wg-product item-row gap20" style="align-items:center;">
                        <div class="body-text fw-7" style="width:20%"><?php echo e($method->name); ?></div>
                        <div class="body-text" style="width:30%"><?php echo e($method->description); ?></div>
                        <div class="body-text" style="width:15%"><?php echo e(number_format($method->cost, 2)); ?> đ</div>
                        <div style="width:15%">
                            <?php if($method->is_active): ?>
                                <span class="block-available bg-1 fw-7">Active</span>
                            <?php else: ?>
                                <span class="block-stock bg-1 fw-7">Inactive</span>
                            <?php endif; ?>
                        </div>
                        <div class="list-icon-function" style="width:20%;display:flex;gap:8px;align-items:center;">
                            <?php if($method->is_active): ?>
                            <form method="POST" action="<?php echo e(route('admin.shipping_methods.deactivate', $method->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="tf-button style-1 small">Disable</button>
                            </form>
                            <?php else: ?>
                            <form method="POST" action="<?php echo e(route('admin.shipping_methods.activate', $method->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="tf-button style-1 small">Enable</button>
                            </form>
                            <?php endif; ?>
                            <form method="POST" action="<?php echo e(route('admin.shipping_methods.destroy', $method->id)); ?>" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="tf-button style-2 custom-danger" style="background:#e3342f; border-color:#e3342f; color:#fff;">Delete</button>
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

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/shipping_method/index.blade.php ENDPATH**/ ?>