<?php $__env->startSection('title', 'Thêm khuyến mãi'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>Thêm khuyến mãi</h3>
    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
        <li>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <div class="text-tiny">Dashboard</div>
            </a>
        </li>
        <li><i class="icon-chevron-right"></i></li>
        <li>
            <a href="<?php echo e(route('admin.promotions.index')); ?>">
                <div class="text-tiny">Promotions</div>
            </a>
        </li>
        <li><i class="icon-chevron-right"></i></li>
        <li><div class="text-tiny">Thêm khuyến mãi</div></li>
    </ul>
</div>
<form class="form-add-promotion" method="POST" action="<?php echo e(route('admin.promotions.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="wg-box mb-30">
        <fieldset class="name">
            <div class="body-title mb-10">Tên khuyến mãi <span class="tf-color-1">*</span></div>
            <input class="mb-10" type="text" placeholder="Nhập tên khuyến mãi" name="name" maxlength="100" required value="<?php echo e(old('name')); ?>">
        </fieldset>
        <fieldset class="code">
            <div class="body-title mb-10">Mã khuyến mãi</div>
            <input class="mb-10" type="text" placeholder="Nhập mã" name="code" maxlength="50" value="<?php echo e(old('code')); ?>">
        </fieldset>
        <fieldset class="discount_type">
            <div class="body-title mb-10">Loại giảm giá <span class="tf-color-1">*</span></div>
            <select name="discount_type" required>
                <option value="percentage" <?php echo e(old('discount_type') == 'percentage' ? 'selected' : ''); ?>>Phần trăm (%)</option>
                <option value="fixed_amount" <?php echo e(old('discount_type') == 'fixed_amount' ? 'selected' : ''); ?>>Tiền mặt (VNĐ)</option>
            </select>
        </fieldset>
        <fieldset class="discount_value">
            <div class="body-title mb-10">Giá trị giảm <span class="tf-color-1">*</span></div>
            <input type="number" name="discount_value" min="0" step="0.01" required value="<?php echo e(old('discount_value')); ?>">
        </fieldset>
        <fieldset class="max_discount_amount">
            <div class="body-title mb-10">Giảm tối đa (nếu là %)</div>
            <input type="number" name="max_discount_amount" min="0" step="0.01" value="<?php echo e(old('max_discount_amount')); ?>">
        </fieldset>
        <fieldset class="min_order_value">
            <div class="body-title mb-10">Đơn tối thiểu áp dụng</div>
            <input type="number" name="min_order_value" min="0" step="0.01" value="<?php echo e(old('min_order_value')); ?>">
        </fieldset>
        <fieldset class="usage_limit_per_voucher">
            <div class="body-title mb-10">Số lượt dùng tối đa cho mã</div>
            <input type="number" name="usage_limit_per_voucher" min="0" value="<?php echo e(old('usage_limit_per_voucher')); ?>">
        </fieldset>
        <fieldset class="usage_limit_per_user">
            <div class="body-title mb-10">Số lượt dùng tối đa mỗi người</div>
            <input type="number" name="usage_limit_per_user" min="0" value="<?php echo e(old('usage_limit_per_user')); ?>">
        </fieldset>
        <fieldset class="start_date">
            <div class="body-title mb-10">Ngày bắt đầu</div>
            <input type="date" name="start_date" value="<?php echo e(old('start_date')); ?>">
        </fieldset>
        <fieldset class="end_date">
            <div class="body-title mb-10">Ngày kết thúc</div>
            <input type="date" name="end_date" value="<?php echo e(old('end_date')); ?>">
        </fieldset>
        <fieldset class="applies_to">
            <div class="body-title mb-10">Áp dụng cho <span class="tf-color-1">*</span></div>
            <select name="applies_to" id="applies_to" required>
                <option value="all_products" <?php echo e(old('applies_to') == 'all_products' ? 'selected' : ''); ?>>Tất cả sản phẩm</option>
                <option value="specific_brands" <?php echo e(old('applies_to') == 'specific_brands' ? 'selected' : ''); ?>>Thương hiệu cụ thể</option>
                <option value="specific_categories" <?php echo e(old('applies_to') == 'specific_categories' ? 'selected' : ''); ?>>Danh mục cụ thể</option>
            </select>
        </fieldset>
        <fieldset id="brand-select-field" style="display:none;">
            <div class="body-title mb-10">Chọn thương hiệu áp dụng</div>
            <div class="row">
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-2">
                        <label>
                            <input type="checkbox" name="brand_ids[]" value="<?php echo e($brand->id); ?>"
                                <?php echo e(collect(old('brand_ids'))->contains($brand->id) ? 'checked' : ''); ?>>
                            <?php echo e($brand->name); ?>

                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </fieldset>
        <fieldset id="category-select-field" style="display:none;">
            <div class="body-title mb-10">Chọn danh mục áp dụng</div>
            <div class="row">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-2">
                        <label>
                            <input type="checkbox" name="category_ids[]" value="<?php echo e($category->id); ?>"
                                <?php echo e(collect(old('category_ids'))->contains($category->id) ? 'checked' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </fieldset>
        <fieldset class="description">
            <div class="body-title mb-10">Mô tả</div>
            <textarea name="description"><?php echo e(old('description')); ?></textarea>
        </fieldset>
        <fieldset class="is_active">
            <div class="body-title mb-10">Kích hoạt</div>
            <select name="is_active">
                <option value="1" <?php echo e(old('is_active', 1) == 1 ? 'selected' : ''); ?>>Có</option>
                <option value="0" <?php echo e(old('is_active', 1) == 0 ? 'selected' : ''); ?>>Không</option>
            </select>
        </fieldset>
    </div>
    <div class="cols gap10">
        <button class="tf-button w380" type="submit">Thêm khuyến mãi</button>
        <a href="<?php echo e(route('admin.promotions.index')); ?>" class="tf-button style-3 w380">Hủy</a>
    </div>
</form>
<script>
    function togglePromotionFields() {
        var appliesTo = document.getElementById('applies_to').value;
        document.getElementById('brand-select-field').style.display = appliesTo === 'specific_brands' ? '' : 'none';
        document.getElementById('category-select-field').style.display = appliesTo === 'specific_categories' ? '' : 'none';
    }
    document.getElementById('applies_to').addEventListener('change', togglePromotionFields);
    window.addEventListener('DOMContentLoaded', togglePromotionFields);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/promotions/create.blade.php ENDPATH**/ ?>