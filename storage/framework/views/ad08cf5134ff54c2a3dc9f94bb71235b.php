<?php $__env->startSection('title', 'Thêm phương thức thanh toán'); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Thêm phương thức thanh toán</h3>
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
                    <a href="<?php echo e(route('admin.payment_methods.index')); ?>">
                        <div class="text-tiny">Payment Methods</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thêm phương thức</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <div class="title-box mb-20">
                <i class="icon-credit-card"></i>
                <div class="body-text">Điền thông tin phương thức thanh toán mới vào form bên dưới.</div>
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
            <form action="<?php echo e(route('admin.payment_methods.store')); ?>" method="POST" class="form-grid">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label for="name" class="form-label fw-bold fs-5">Tên phương thức <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Tên phương thức" value="<?php echo e(old('name')); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="code" class="form-label fw-bold fs-5">Mã phương thức <span class="text-danger">*</span></label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Mã phương thức (viết liền, không dấu)" value="<?php echo e(old('code')); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label fw-bold fs-5">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Mô tả"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="instructions" class="form-label fw-bold fs-5">Hướng dẫn thanh toán</label>
                    <textarea name="instructions" id="instructions" class="form-control" placeholder="Hướng dẫn thanh toán"><?php echo e(old('instructions')); ?></textarea>
                </div>
                <div class="form-group mt-4 d-flex align-items-center gap-2">
                    <button type="submit" class="tf-button style-1">Thêm mới</button>
                    <a href="<?php echo e(route('admin.payment_methods.index')); ?>" class="tf-button style-1">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .form-control, .form-control textarea {
        font-size: 1.5rem;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/payment_method/create.blade.php ENDPATH**/ ?>