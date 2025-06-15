<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Attribute Value</h2>
    <form action="<?php echo e(route('admin.attributes.update', $attributeValue->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="attribute_id" class="form-label">Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($attribute->id); ?>" <?php echo e($attributeValue->attribute_id == $attribute->id ? 'selected' : ''); ?>>
                        <?php echo e($attribute->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" name="value" id="value" class="form-control" value="<?php echo e(old('value', $attributeValue->value)); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?php echo e(route('admin.attributes.index')); ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/attributes/edit.blade.php ENDPATH**/ ?>