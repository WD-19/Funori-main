<?php $__env->startSection('title', 'Danh sách sản phẩm'); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Danh sách sản phẩm</h3>
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
                        <div class="text-tiny">Sản phẩm</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Tất cả sản phẩm</div>
                </li>
            </ul>
        </div>
        <!-- product-list -->
        <div class="wg-box">
            <div class="title-box">
                <i class="icon-coffee"></i>
                <div class="body-text">Mẹo tìm kiếm theo mã sản phẩm: Mỗi sản phẩm đều có mã riêng, bạn có thể sử dụng để tìm chính xác sản phẩm cần thiết.</div>
            </div>
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search" method="GET" action="<?php echo e(route('admin.products.index')); ?>">
                        <fieldset class="name">
                            <input type="text" placeholder="Tìm kiếm..." name="name" tabindex="2"
                                value="<?php echo e(request('name')); ?>">
                        </fieldset>
                        <div class="button-submit">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="<?php echo e(route('admin.products.create')); ?>"><i class="icon-plus"></i>Thêm mới</a>
            </div>
            <div class="wg-table table-product-list">
                <ul class="table-title flex gap20 mb-14">
                    <li>
                        <div class="body-title">Tên sản phẩm</div>
                    </li>
                    <li>
                        <div class="body-title">Mô tả</div>
                    </li>
                    <li>
                        <div class="body-title">Giá</div>
                    </li>
                    <li>
                        <div class="body-title">Thương hiệu</div>
                    </li>
                    <li>
                        <div class="body-title">Danh mục</div>
                    </li>
                    <li>
                        <div class="body-title">Số lượng</div>
                    </li>
                    <li>
                        <div class="body-title">Tồn kho</div>
                    </li>
                    <li>
                        <div class="body-title">Trạng thái</div>
                    </li>
                    <li>
                        <div class="body-title">Thao tác</div>
                    </li>
                </ul>

                <ul class="flex flex-column">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="wg-product item-row gap20">
                        <div class="name">
                            <div class="image">
                                <img src="<?php echo e($product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png')); ?>" alt="">
                            </div>
                            <div class="title line-clamp-2 mb-0">
                                <a href="#" class="body-text"><?php echo e($product->name); ?></a>
                            </div>
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            <?php echo e(Str::limit($product->short_description, 40)); ?>

                        </div>
                        <div class="body-text text-main-dark mt-4">
                            <?php echo e(number_format($product->regular_price, 0, ',', '.')); ?> đ
                        </div>
                        <div class="body-text text-main-dark mt-4">
                            <?php echo e($product->brand->name ?? 'Không xác định'); ?>

                        </div>
                        <div class="body-text text-main-dark mt-4">
                            <?php echo e($product->category->name ?? 'Không xác định'); ?>

                        </div>
                        <div class="body-text text-main-dark mt-4">
                            <?php echo e($product->variants->sum('stock_quantity')); ?>

                        </div>
                        <div>
                            <?php if($product->variants->sum('stock_quantity') > 0): ?>
                            <div class="block-available bg-1 fw-7">Còn hàng</div>
                            <?php else: ?>
                            <div class="block-stock bg-1 fw-7">Hết hàng</div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <form method="POST" action="<?php echo e(route('admin.products.update', $product->id)); ?>" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <select name="status" onchange="this.form.submit()" style="max-width:200px;">
                                    <option value="published" <?php echo e($product->status == 'published' ? 'selected' : ''); ?>>Hiển thị</option>
                                    <option value="draft" <?php echo e($product->status == 'draft' ? 'selected' : ''); ?>>Ngừng Kinh doanh</option>
                                    <option value="archived" <?php echo e($product->status == 'archived' ? 'selected' : ''); ?>>Lưu trữ</option>
                                </select>
                            </form>
                        </div>
                        <div class="list-icon-function">
                            <div class="item eye">
                                <a href="<?php echo e(route('admin.products.show', $product->id)); ?>"><i class="icon-eye"></i></a>
                            </div>
                            <div class="item edit">
                                <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>"><i class="icon-edit-3"></i></a>
                            </div>
                            <!-- <div class="item trash">
                                <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="background:transparent;border:none;padding:0;">
                                        <i class="icon-trash-2"></i>
                                    </button>
                                </form>
                            </div> -->
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div class="text-tiny">
                    Hiển thị <?php echo e($products->firstItem()); ?> đến <?php echo e($products->lastItem()); ?> trên tổng số <?php echo e($products->total()); ?> sản phẩm
                </div>
                <ul class="wg-pagination">
                    <li>
                        <?php if($products->onFirstPage()): ?>
                        <span><i class="icon-chevron-left"></i></span>
                        <?php else: ?>
                        <a href="<?php echo e($products->previousPageUrl()); ?>"><i class="icon-chevron-left"></i></a>
                        <?php endif; ?>
                    </li>
                    <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($page == $products->currentPage() ? 'active' : ''); ?>">
                        <?php if($page == $products->currentPage()): ?>
                        <span><?php echo e($page); ?></span>
                        <?php else: ?>
                        <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <?php if($products->hasMorePages()): ?>
                        <a href="<?php echo e($products->nextPageUrl()); ?>"><i class="icon-chevron-right"></i></a>
                        <?php else: ?>
                        <span><i class="icon-chevron-right"></i></span>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/products/index.blade.php ENDPATH**/ ?>