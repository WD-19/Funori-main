<?php $__env->startSection('title', 'Danh sách trang'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
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
                <h3>All Pages</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">All Pages</div>
                    </li>
                </ul>
            </div>
            <!-- all-pages -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="<?php echo e(route('admin.pages.index')); ?>">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="q"
                                    value="<?php echo e(request('q')); ?>">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="<?php echo e(route('admin.pages.create')); ?>"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-attribute">
                    <thead>
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Tiêu đề</div></li>
                            <li><div class="body-title">Slug</div></li>
                            <li><div class="body-title">Tác giả</div></li>
                            <li><div class="body-title">Loại trang</div></li>
                            <li><div class="body-title">Trạng thái</div></li>
                            <li><div class="body-title">Ảnh</div></li>
                            <li><div class="body-title">Ngày xuất bản</div></li>
                            <li><div class="body-title">Hành động</div></li>
                        </ul>
                    </thead>
                    <tbody>
                        <ul class="flex flex-column">
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="attribute-item item-row flex items-center justify-between gap20">
                                    <div class="body-text"><?php echo e($page->title); ?></div>
                                    <div class="body-text"><?php echo e($page->slug); ?></div>
                                    <div class="body-text"><?php echo e($page->author ? $page->author->full_name : 'N/A'); ?></div>
                                    <div class="body-text"><?php echo e($page->page_type); ?></div>
                                    <div class="body-text">
                                        <?php if($page->status == 'published'): ?>
                                            <span class="badge bg-success">Đã xuất bản</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Nháp</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="body-text">
                                        <?php if($page->featured_image_url): ?>
                                            <img src="<?php echo e(asset('storage/' . $page->featured_image_url)); ?>" alt="Ảnh"
                                                style="max-width:60px;max-height:60px;">
                                        <?php else: ?>
                                            Không có ảnh
                                        <?php endif; ?>
                                    </div>
                                    <div class="body-text">
                                        <?php echo e($page->published_at ? $page->published_at->format('d/m/Y H:i') : '-'); ?>

                                    </div>
                                    <div class="list-icon-function">
                                        <div class="item eye" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModalPage<?php echo e($page->id); ?>">
                                            <i class="icon-eye"></i>
                                        </div>
                                        <!-- Modal quick view -->
                                        <div class="modal fade" id="quickViewModalPage<?php echo e($page->id); ?>"
                                            tabindex="-1" aria-labelledby="quickViewLabelPage<?php echo e($page->id); ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content shadow-lg rounded-4 border-0"
                                                    style="font-size: 16px;">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h3 class="modal-title fw-bold mb-0 text-light"
                                                            id="quickViewLabelPage<?php echo e($page->id); ?>">
                                                            <i class="bi bi-info-circle me-2"></i>Chi tiết trang
                                                        </h3>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                    </div>
                                                    <div class="modal-body px-5 py-4">
                                                        <div class="row gy-3">
                                                            <div class="col-sm-6">
                                                                <strong>Tiêu đề:</strong>
                                                                <div class="text-muted"><?php echo e($page->title); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Slug:</strong>
                                                                <div class="text-muted"><?php echo e($page->slug); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Tác giả:</strong>
                                                                <div class="text-muted">
                                                                    <?php echo e($page->author ? $page->author->full_name : 'N/A'); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Loại trang:</strong>
                                                                <div class="text-muted"><?php echo e($page->page_type); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Trạng thái:</strong>
                                                                <?php if($page->status == 'published'): ?>
                                                                    <span class="badge bg-success">Đã xuất bản</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-secondary">Nháp</span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Ngày xuất bản:</strong>
                                                                <div class="text-muted">
                                                                    <?php echo e($page->published_at ? $page->published_at->format('d/m/Y H:i') : '-'); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <strong>Nội dung:</strong>
                                                                <div class="text-muted"
                                                                    style="white-space:pre-line;max-height:200px;overflow:auto;">
                                                                    <?php echo $page->content; ?>

                                                                </div>
                                                            </div>
                                                            <?php if(!empty($page->featured_image_url)): ?>
                                                                <div class="col-12">
                                                                    <strong>Ảnh đại diện:</strong><br>
                                                                    <img src="<?php echo e(asset('storage/' . $page->featured_image_url)); ?>"
                                                                        alt="Ảnh đại diện"
                                                                        style="max-width:120px;max-height:120px;">
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="col-12">
                                                                <strong>Meta title:</strong>
                                                                <div class="text-muted"><?php echo e($page->meta_title ?? '-'); ?></div>
                                                            </div>
                                                            <div class="col-12">
                                                                <strong>Meta description:</strong>
                                                                <div class="text-muted">
                                                                    <?php echo e($page->meta_description ?? '-'); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Ngày tạo:</strong>
                                                                <div class="text-muted"><?php echo e($page->created_at); ?></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Ngày cập nhật:</strong>
                                                                <div class="text-muted"><?php echo e($page->updated_at); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item edit">
                                            <a href="<?php echo e(route('admin.pages.edit', $page->id)); ?>"><i
                                                    class="icon-edit-3"></i></a>
                                        </div>
                                        <form action="<?php echo e(route('admin.pages.destroy', $page->id)); ?>" method="POST"
                                            style="display:inline;" onclick="return confirm('Xóa trang này?');">
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
                        </ul>
                    </tbody>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 mt-3">
                    <div class="text-tiny">
                        Showing <?php echo e($pages->firstItem()); ?> to <?php echo e($pages->lastItem()); ?> of <?php echo e($pages->total()); ?> entries
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            <a href="<?php echo e($pages->previousPageUrl() ?? '#'); ?>" <?php echo $pages->onFirstPage() ? 'class=disabled' : ''; ?>>
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        <?php for($i = 1; $i <= $pages->lastPage(); $i++): ?>
                            <li class="<?php echo e($pages->currentPage() == $i ? 'active' : ''); ?>">
                                <a href="<?php echo e($pages->url($i)); ?>"><?php echo e($i); ?></a>
                            </li>
                        <?php endfor; ?>
                        <li>
                            <a href="<?php echo e($pages->nextPageUrl() ?? '#'); ?>" <?php echo $pages->currentPage() == $pages->lastPage() ? 'class=disabled' : ''; ?>>
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /all-pages -->
        </div>
        <!-- /main-content-wrap -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>