<?php $__env->startSection('title', 'Danh sách danh mục'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="w-100">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-3" role="alert"
                        style="max-width: 600px; margin: 0 auto;">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-3" role="alert"
                        style="max-width: 600px; margin: 0 auto;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>All Category</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Category</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All Category</div>
                    </li>
                </ul>

            </div>
            <!-- all-category -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="<?php echo e(route('admin.categories.create')); ?>"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-attribute">
                    <thead>
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">Category name</div>
                            </li>
                            <li>
                                <div class="body-title">Parent Category</div>
                            </li>
                            <li>
                                <div class="body-title">Image</div>
                            </li>
                            <li>
                                <div class="body-title">Status</div>
                            </li>
                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                    </thead>
                    <tbody>
                        <ul class="flex flex-column">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="attribute-item item-row flex items-center justify-between gap20">
                                    <div class="name">
                                        <a href="#"
                                            class="body-title-2"><?php echo e(str_repeat('--', $category->depth ?? 0)); ?><?php echo e($category->name); ?></a>
                                    </div>
                                    <div class="body-text"><?php echo e($category->parent ? $category->parent->name : 'Không có'); ?>

                                    </div>
                                    <div class="body-text">
                                        <?php if($category->image_url): ?>
                                            <img src="<?php echo e(asset('storage/' . $category->image_url)); ?>" alt="Ảnh"
                                                style="max-width:60px;max-height:60px;">
                                        <?php else: ?>
                                            Không có ảnh
                                        <?php endif; ?>
                                    </div>
                                    <div class="body-text">
                                        <?php if($category->is_active): ?>
                                            <span class="badge bg-success">Kích hoạt</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Không kích hoạt</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="list-icon-function">
                                        


                                        <!-- Quick View Modal for Category Parent -->
                                        <div class="item eye" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModalParent<?php echo e($category->id); ?>">
                                            <i class="icon-eye"></i>
                                        </div>
                                        <div class="modal fade" id="quickViewModalParent<?php echo e($category->id); ?>" tabindex="-1"
                                            aria-labelledby="quickViewLabelParent<?php echo e($category->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content shadow-lg rounded-4 border-0"
                                                    style="font-size: 16px;">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h3 class="modal-title fw-bold mb-0 text-light"
                                                            id="quickViewLabelParent<?php echo e($category->id); ?>">
                                                            <i class="bi bi-info-circle me-2"></i>Chi tiết danh mục
                                                        </h3>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                    </div>
                                                    <div class="modal-body px-5 py-4">
                                                        <div class="row gy-3">
                                                            <div class="col-sm-6">
                                                                <strong>Tên danh mục:</strong>
                                                                <div class="text-muted"><?php echo e($category->name); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Slug:</strong>
                                                                <div class="text-muted"><?php echo e($category->slug); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Danh mục cha:</strong>
                                                                <div class="text-muted">
                                                                    <?php echo e($category->parent ? $category->parent->name : 'Không có'); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Trạng thái:</strong>
                                                                <?php if($category->is_active): ?>
                                                                    <span class="badge bg-success">Kích hoạt</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-danger">Không kích hoạt</span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-12">
                                                                <strong>Mô tả:</strong>
                                                                <div class="text-muted">
                                                                    <?php echo e($category->description ?? '(Không có mô tả)'); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <strong>Ảnh:</strong><br>
                                                                <?php if($category->image_url): ?>
                                                                    <img src="<?php echo e(asset('storage/' . $category->image_url)); ?>"
                                                                        alt="Ảnh"
                                                                        style="max-width:120px;max-height:120px;">
                                                                <?php else: ?>
                                                                    <span class="text-muted">Không có ảnh</span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Ngày tạo:</strong>
                                                                <div class="text-muted"><?php echo e($category->created_at); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Ngày cập nhật:</strong>
                                                                <div class="text-muted"><?php echo e($category->updated_at); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="item edit">
                                            <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>"><i
                                                    class="icon-edit-3"></i></a>
                                        </div>

                                        
                                        <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
                                            method="POST" style="display:inline;"
                                            onclick="return confirm('Xóa danh mục này??');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>

                                    </div>
                                </li>
                                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="attribute-item item-row flex items-center justify-between gap20">
                                        <div class="name">
                                            <a href="#"
                                                class="body-title-2"><?php echo e(str_repeat('--', $child->depth ?? 1)); ?><?php echo e($child->name); ?></a>
                                        </div>
                                        <div class="body-text"><?php echo e($child->parent ? $child->parent->name : 'Không có'); ?>

                                        </div>
                                        <div class="body-text">
                                            <?php if($child->image_url): ?>
                                                <img src="<?php echo e(asset('storage/' . $child->image_url)); ?>" alt="Ảnh"
                                                    style="max-width:60px;max-height:60px;">
                                            <?php else: ?>
                                                Không có ảnh
                                            <?php endif; ?>
                                        </div>
                                        <div class="body-text">
                                            <?php if($child->is_active): ?>
                                                <span class="badge bg-success">Kích hoạt</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Không kích hoạt</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="list-icon-function">
                                            <div class="item eye" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal<?php echo e($child->id); ?>">
                                                <i class="icon-eye"></i>
                                            </div>

                                            <!-- Quick View Modal for Category Child -->
                                            <div class="modal fade" id="quickViewModal<?php echo e($child->id); ?>"
                                                tabindex="-1" aria-labelledby="quickViewLabel<?php echo e($child->id); ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content shadow-lg rounded-4 border-0"
                                                        style="font-size: 16px;">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h3 class="modal-title fw-bold mb-0 text-light"
                                                                id="quickViewLabel<?php echo e($child->id); ?>">
                                                                <i class="bi bi-info-circle me-2"></i>Chi tiết danh mục
                                                            </h3>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                        </div>
                                                        <div class="modal-body px-5 py-4">
                                                            <div class="row gy-3">
                                                                <div class="col-sm-6">
                                                                    <strong>Tên danh mục:</strong>
                                                                    <div class="text-muted"><?php echo e($child->name); ?></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Slug:</strong>
                                                                    <div class="text-muted"><?php echo e($child->slug); ?></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Danh mục cha:</strong>
                                                                    <div class="text-muted">
                                                                        <?php echo e($child->parent ? $child->parent->name : 'Không có'); ?>

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Trạng thái:</strong>
                                                                    <?php if($child->is_active): ?>
                                                                        <span class="badge bg-success">Kích hoạt</span>
                                                                    <?php else: ?>
                                                                        <span class="badge bg-danger">Không kích
                                                                            hoạt</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Mô tả:</strong>
                                                                    <div class="text-muted">
                                                                        <?php echo e($child->description ?? '(Không có mô tả)'); ?>

                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Ảnh:</strong><br>
                                                                    <?php if($child->image_url): ?>
                                                                        <img src="<?php echo e(asset('storage/' . $child->image_url)); ?>"
                                                                            alt="Ảnh"
                                                                            style="max-width:120px;max-height:120px;">
                                                                    <?php else: ?>
                                                                        <span class="text-muted">Không có ảnh</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Ngày tạo:</strong>
                                                                    <div class="text-muted"><?php echo e($child->created_at); ?></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <strong>Ngày cập nhật:</strong>
                                                                    <div class="text-muted"><?php echo e($child->updated_at); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item edit">
                                                <a href="<?php echo e(route('admin.categories.edit', $child->id)); ?>"><i
                                                        class="icon-edit-3"></i></a>
                                            </div>

                                            
                                            <form action="<?php echo e(route('admin.categories.destroy', $child->id)); ?>"
                                                method="POST" style="display:inline;"
                                                onclick="return confirm('Xóa danh mục này??');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                    <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </tbody>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 mt-3">
                    <div class="text-tiny">
                        Showing <?php echo e($categories->firstItem()); ?> to <?php echo e($categories->lastItem()); ?> of
                        <?php echo e($categories->total()); ?> entries
                    </div>
                    <ul class="wg-pagination">
                        
                        <li>
                            <a href="<?php echo e($categories->previousPageUrl() ?? '#'); ?>" <?php echo $categories->onFirstPage() ? 'class=disabled' : ''; ?>>
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        
                        <?php for($i = 1; $i <= $categories->lastPage(); $i++): ?>
                            <li class="<?php echo e($categories->currentPage() == $i ? 'active' : ''); ?>">
                                <a href="<?php echo e($categories->url($i)); ?>"><?php echo e($i); ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <li>
                            <a href="<?php echo e($categories->nextPageUrl() ?? '#'); ?>" <?php echo $categories->currentPage() == $categories->lastPage() ? 'class=disabled' : ''; ?>>
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /all-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>