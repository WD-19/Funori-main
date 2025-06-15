<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Add Attribute Value</h2>
    <form action="<?php echo e(route('admin.attributes.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="attribute_id" class="form-label">Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                <option value="">-- Select Attribute --</option>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" name="value" id="value" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="<?php echo e(route('admin.attributes.index')); ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/attributes/create.blade.php ENDPATH**/ ?>