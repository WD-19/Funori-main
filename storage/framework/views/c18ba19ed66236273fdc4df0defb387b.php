<?php $__env->startSection('title', 'Chi tiết sản phẩm'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Chi tiết sản phẩm</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white px-3 py-2 rounded shadow-sm">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.products.index')); ?>">Sản phẩm</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Thông tin sản phẩm -->
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Tên sản phẩm:</dt>
                        <dd class="col-sm-8 fw-semibold"><?php echo e($product->name); ?></dd>

                        <dt class="col-sm-4">Slug:</dt>
                        <dd class="col-sm-8"><?php echo e($product->slug); ?></dd>

                        <dt class="col-sm-4">Danh mục:</dt>
                        <dd class="col-sm-8"><?php echo e($product->category->name ?? '-'); ?></dd>

                        <dt class="col-sm-4">Thương hiệu:</dt>
                        <dd class="col-sm-8"><?php echo e($product->brand->name ?? '-'); ?></dd>

                        <dt class="col-sm-4">Giá gốc:</dt>
                        <dd class="col-sm-8 text-danger fw-bold"><?php echo e(number_format($product->regular_price, 0, ',', '.')); ?> đ</dd>

                        <dt class="col-sm-4">Tổng kho:</dt>
                        <dd class="col-sm-8"><?php echo e($product->variants->sum('stock_quantity')); ?></dd>

                        <dt class="col-sm-4">Trạng thái:</dt>
                        <dd class="col-sm-8">
                            <?php if($product->status == 'published'): ?>
                                <span class="badge bg-success">Hiển thị</span>
                            <?php elseif($product->status == 'draft'): ?>
                                <span class="badge bg-warning text-dark">Nháp</span>
                            <?php elseif($product->status == 'archived'): ?>
                                <span class="badge bg-secondary">Lưu trữ</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Hết hàng</span>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-4">Ngày cập nhật:</dt>
                        <dd class="col-sm-8"><?php echo e($product->updated_at->format('d/m/Y H:i')); ?></dd>

                        <dt class="col-sm-4">Mô tả:</dt>
                        <dd class="col-sm-8"><?php echo nl2br(e($product->description)); ?></dd>
                    </dl>
                </div>
            </div>

            <?php if(isset($product->variants) && count($product->variants)): ?>
            <!-- Biến thể -->
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Biến thể sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Kích thước</th>
                                    <th>Giá</th>
                                    <th>Kho</th>
                                    <th>Thuộc tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if($variant->image): ?>
                                            <img src="<?php echo e(asset($variant->image->image_url)); ?>" alt="Ảnh variant" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?php echo e($variant->size ?? '-'); ?></td>
                                    <td class="text-danger text-center">
                                        <?php $gia = $product->regular_price + $variant->price_modifier; ?>
                                        <?php echo e(number_format($gia, 0, ',', '.')); ?> đ
                                    </td>
                                    <td class="text-center"><?php echo e($variant->stock_quantity ?? '-'); ?></td>
                                    <td>
                                        <?php if(isset($variant->attributeValues) && count($variant->attributeValues)): ?>
                                            <?php $__currentLoopData = $variant->attributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="badge bg-secondary me-1"><?php echo e($attrVal->attribute->name); ?>: <?php echo e($attrVal->value); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Ảnh và tác vụ -->
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Ảnh sản phẩm</h5>
                </div>
                <div class="card-body text-center">
                    <?php if($product->images->count()): ?>
                        <img src="<?php echo e(asset($product->images->first()->image_url)); ?>" class="img-fluid rounded shadow mb-3" style="max-height:180px; object-fit: cover;" alt="Ảnh sản phẩm">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(asset($img->image_url)); ?>" class="img-thumbnail border border-1" style="width:48px; height:48px; object-fit:cover;" alt="Ảnh phụ">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-light text-muted py-5 rounded">Không có ảnh</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Tác vụ</h5>
                </div>
                <div class="card-body">
                    <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-pencil-square me-1"></i> Sửa sản phẩm
                    </a>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-list me-1"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/products/detail.blade.php ENDPATH**/ ?>