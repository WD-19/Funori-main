


<?php $__env->startSection('title', 'Chi tiết danh mục'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Chi tiết danh mục</h2>
    <div class="mb-3">
        <strong>Tên danh mục:</strong> <?php echo e($category->name); ?>

    </div>
    <div class="mb-3">
        <strong>Slug:</strong> <?php echo e($category->slug); ?>

    </div>
    <div class="mb-3">
        <strong>Danh mục cha:</strong> <?php echo e($category->parent ? $category->parent->name : 'Không có'); ?>

    </div>
    <div class="mb-3">
        <strong>Mô tả:</strong> <?php echo e($category->description); ?>

    </div>
    <div class="mb-3">
        <strong>Trạng thái:</strong> <?php echo e($category->is_active ? 'Kích hoạt' : 'Không kích hoạt'); ?>

    </div>
    <div class="mb-3">
        <strong>Ảnh:</strong><br>
        <?php if($category->image_url): ?>
            <img src="<?php echo e(asset('storage/' . $category->image_url)); ?>" alt="Ảnh danh mục" style="max-width: 200px;">
        <?php else: ?>
            Không có ảnh
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <strong>Ngày tạo:</strong> <?php echo e($category->created_at); ?>

    </div>
    <div class="mb-3">
        <strong>Ngày cập nhật:</strong> <?php echo e($category->updated_at); ?>

    </div>
    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-secondary">Quay lại</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/categories/show.blade.php ENDPATH**/ ?>