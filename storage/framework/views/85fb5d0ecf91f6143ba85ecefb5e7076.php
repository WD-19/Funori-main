

<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Chỉnh sửa thương hiệu: <?php echo e($brand->name); ?></h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="<?php echo e(route('admin.brands.index')); ?>">
                        <div class="text-tiny">Brands</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Chỉnh sửa thương hiệu</div></li>
            </ul>
        </div>
        <div class="wg-box">
            <div class="title-box mb-20">
                <i class="icon-layers"></i>
                <div class="body-text">Cập nhật thông tin thương hiệu bên dưới.</div>
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
            <form method="POST" action="<?php echo e(route('admin.brands.update', $brand)); ?>" class="form-grid" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold fs-5" for="name">Tên thương hiệu <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $brand->name)); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold fs-5" for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="<?php echo e(old('slug', $brand->slug)); ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold fs-5" for="logo">Logo</label>
                    <?php if($brand->logo_url): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(Storage::url($brand->logo_url)); ?>" alt="Logo hiện tại" width="80">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="logo" id="logo" class="form-control">
                    <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold fs-5" for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="3"><?php echo e(old('description', $brand->description)); ?></textarea>
                </div>
                <div class="form-group mt-4 d-flex align-items-center gap-2">
                    <button type="submit" class="tf-button style-1">Cập nhật</button>
                    <a href="<?php echo e(route('admin.brands.index')); ?>" class="tf-button style-1">Quay lại</a>
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

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/brands/edit.blade.php ENDPATH**/ ?>