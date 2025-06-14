<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
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
    <form action="<?php echo e(route('admin.attributes.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <fieldset class="name">
            <div class="body-title">Attribute</div>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                <option value="">-- Select Attribute --</option>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="name">
            <div class="body-title">Value</div>
            <input class="flex-grow" type="text" placeholder="Attribute value" name="value" tabindex="0" value="" aria-required="true" required="">
        </fieldset>
        <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Create</button>
            <a href="<?php echo e(route('admin.attributes.index')); ?>" class="btn btn-secondary">Back</a>

        </div>
    </form>
</div>

=======
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
>>>>>>> c9d4f3a268865ac8e0d7ac4322e51f500868f71c
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/attributes/create.blade.php ENDPATH**/ ?>