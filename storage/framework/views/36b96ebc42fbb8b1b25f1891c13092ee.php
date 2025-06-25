<?php $__env->startSection('title', 'Thêm phương thức giao hàng'); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Thêm phương thức giao hàng</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="<?php echo e(route('admin.shipping_methods.index')); ?>">
                        <div class="text-tiny">Giao hàng</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Thêm phương thức</div></li>
            </ul>
        </div>
        <div class="wg-box">
            <div class="title-box mb-20">
                <i class="icon-truck"></i>
                <div class="body-text">Điền thông tin phương thức giao hàng mới vào form bên dưới.</div>
            </div>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
              <?php if(session('success')): ?>
                <div class="alert alert-success mb-3" style="font-size:1.25rem; font-weight:bold;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('admin.shipping_methods.store')); ?>" class="form-grid">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label for="name" class="form-label label-lg">Tên phương thức <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Tên phương thức" value="<?php echo e(old('name')); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label label-lg">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Mô tả"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="cost" class="form-label label-lg">Chi phí <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="cost" id="cost" class="form-control" placeholder="Chi phí" value="<?php echo e(old('cost')); ?>" required>
                </div>
                <div class="form-group mt-4 d-flex align-items-center gap-2">
                    <button type="submit" class="tf-button style-1">Thêm phương thức</button>
                    <a href="<?php echo e(route('admin.shipping_methods.index')); ?>" class="tf-button style-1">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .label-lg {
        font-size: 1.15rem;
        font-weight: bold;
        color: #222;
        margin-bottom: 6px;
        display: block;
    }
     .form-control, .form-control textarea {
        font-size: 1.5rem;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/shipping_method/create.blade.php ENDPATH**/ ?>