<?php $__env->startSection('title', 'Danh sách thuộc tính'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Danh sách sản phẩm</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tên thuộc tính</th>
                    <th>Giá trị</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <strong><?php echo e($attributea->attribute->name); ?></strong>
                    </td>
                    <td><?php echo e($attributea->value); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.attributes.edit', $attributea->id)); ?>" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="<?php echo e(route('admin.attributes.destroy', $attributea->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa thuộc tính này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div>
            <?php echo e($attributes->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/attributes/index.blade.php ENDPATH**/ ?>