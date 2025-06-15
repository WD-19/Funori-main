

<?php $__env->startSection('content'); ?>
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>Add Attribute</h3>
    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
        <li>
            <a href="index.html">
                <div class="text-tiny">Dashboard</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <a href="#">
                <div class="text-tiny">Attributes</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <div class="text-tiny">Add Attribute</div>
        </li>
    </ul>
</div>
<div class="wg-box">
    <form action="<?php echo e(route('admin.attributes.update', $attributeValue->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <fieldset class="name">
            <div class="body-title">Attribute</div>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($attribute->id); ?>" <?php echo e($attributeValue->attribute_id == $attribute->id ? 'selected' : ''); ?>>
                    <?php echo e($attribute->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="name">
            <div class="body-title">Value</div>
            <input class="flex-grow" type="text" placeholder="Attribute value" name="value" tabindex="0" value="<?php echo e(old('value', $attributeValue->value)); ?>" aria-required="true" required="">
        </fieldset>
        <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Update</button>
            <a href="<?php echo e(route('admin.attributes.index')); ?>" class="btn btn-secondary">Back</a>

        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/attributes/edit.blade.php ENDPATH**/ ?>