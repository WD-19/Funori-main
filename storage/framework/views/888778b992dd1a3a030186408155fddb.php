

<?php $__env->startSection('title', 'Danh sách thuộc tính'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>All Attributes</h3>
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
            <div class="text-tiny">All Attributes</div>
        </li>
    </ul>
</div>
<!-- all-attribute -->
<div class="wg-box">
    <div class="flex items-center justify-between gap10 flex-wrap">
        <div class="wg-filter flex-grow">
            <form class="form-search" method="GET" action="<?php echo e(route('admin.attributes.index')); ?>">
                <fieldset class="name">
                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                        value="<?php echo e(request('name')); ?>">
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
        <a class="tf-button style-1 w208" href="add-attributes.html"><i class="icon-plus"></i>Add new</a>
    </div>
    <div class="wg-table table-all-attribute">
        <ul class="table-title flex gap20 mb-14">
            <li>
                <div class="body-title">Category</div>
            </li>
            <li>
                <div class="body-title">Value</div>
            </li>
            <li>
                <div class="body-title">Action</div>
            </li>
        </ul>
        <ul class="flex flex-column">
            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="attribute-item item-row flex items-center justify-between gap20">
                <div class="name">
                    <span class="body-title-2"><?php echo e($attributeValue->attribute->name ?? 'N/A'); ?></span>
                </div>
                <div class="body-text"><?php echo e($attributeValue->value); ?></div>
                <div class="list-icon-function">
                    <div class="item edit">
                        <a href="<?php echo e(route('admin.attributes.edit', $attributeValue->id)); ?>"><i class="icon-edit-3"></i></a>
                    </div>
                    <div class="item trash">
                        <form action="<?php echo e(route('admin.attributes.destroy', $attributeValue->id)); ?>" method="POST" onsubmit="return confirm('Are you sure?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" style="background:transparent;border:none;padding:0;">
                                <i class="icon-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="divider"></div>
    <div class="flex items-center justify-between flex-wrap gap10">
        <div class="text-tiny">
            Showing <?php echo e($attributes->firstItem()); ?> to <?php echo e($attributes->lastItem()); ?> of <?php echo e($attributes->total()); ?> entries
        </div>
        <ul class="wg-pagination">
            <li>
                <?php if($attributes->onFirstPage()): ?>
                <span><i class="icon-chevron-left"></i></span>
                <?php else: ?>
                <a href="<?php echo e($attributes->previousPageUrl()); ?>"><i class="icon-chevron-left"></i></a>
                <?php endif; ?>
            </li>
            <?php for($page = 1; $page <= $attributes->lastPage(); $page++): ?>
                <li class="<?php echo e($page == $attributes->currentPage() ? 'active' : ''); ?>">
                    <?php if($page == $attributes->currentPage()): ?>
                    <a href="#"><?php echo e($page); ?></a>
                    <?php else: ?>
                    <a href="<?php echo e($attributes->url($page)); ?>"><?php echo e($page); ?></a>
                    <?php endif; ?>
                </li>
                <?php endfor; ?>
                <li>
                    <?php if($attributes->hasMorePages()): ?>
                    <a href="<?php echo e($attributes->nextPageUrl()); ?>"><i class="icon-chevron-right"></i></a>
                    <?php else: ?>
                    <span><i class="icon-chevron-right"></i></span>
                    <?php endif; ?>
                </li>
        </ul>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/attributes/index.blade.php ENDPATH**/ ?>