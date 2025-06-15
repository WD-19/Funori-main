

<?php $__env->startSection('content'); ?>
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>Thêm giá trị thuộc tính</h3>
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
                <div class="text-tiny">Thuộc tính</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <div class="text-tiny">Thêm giá trị thuộc tính</div>
        </li>
    </ul>
</div>
<div class="wg-box">
    <form action="<?php echo e(route('admin.attributes.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <fieldset class="name">
            <div class="body-title">Thuộc tính</div>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                <option value="">-- Chọn thuộc tính --</option>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="name">
            <div class="body-title">Giá trị</div>
            <input class="flex-grow" type="text" placeholder="Nhập giá trị thuộc tính" name="value" tabindex="0" value="" aria-required="true" required="">
        </fieldset>
        <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Thêm mới</button><br>
            <a href="<?php echo e(route('admin.attributes.index')); ?>" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/attributes/create.blade.php ENDPATH**/ ?>