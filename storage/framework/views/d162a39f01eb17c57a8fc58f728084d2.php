<?php $__env->startSection('content'); ?>
    <?php use Illuminate\Support\Str; ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thùng rác liên hệ</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.contacts.index')); ?>">
                            <div class="text-tiny">Liên hệ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thùng rác</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Email</div>
                        </li>
                        <li>
                            <div class="body-title">Họ tên</div>
                        </li>
                        <li>
                            <div class="body-title">Số điện thoại</div>
                        </li>
                        <li>
                            <div class="body-title">Tiêu đề</div>
                        </li>
                        <li>
                            <div class="body-title">Nội dung</div>
                        </li>
                        <li>
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li>
                            <div class="body-title">Ngày xóa</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->email); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->name); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->phone); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->subject); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e(Str::limit($value->message, 30)); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->status); ?></div>
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->deleted_at ? $value->deleted_at->format('d-m-Y H:i') : ''); ?></div>
                                <div class="list-icon-function flex gap10">
                                    <!-- Khôi phục -->
                                    <div class="item undo">
                                        <form action="<?php echo e(route('admin.contacts.restore', $value->id)); ?>" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục liên hệ này?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;"
                                                title="Khôi phục">
                                                <i class="icon-rotate-ccw" style="color: green; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Xóa vĩnh viễn -->
                                    <div class="item trash">
                                        <form action="<?php echo e(route('admin.contacts.forceDelete', $value->id)); ?>" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn liên hệ này?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;"
                                                title="Xóa vĩnh viễn">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="body-text text-center w-full py-4" style="font-size: 1.1rem; color: #888;">
                                Không có liên hệ nào trong thùng rác.
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị <?php echo e($contacts->firstItem()); ?> đến <?php echo e($contacts->lastItem()); ?> trong tổng số
                        <?php echo e($contacts->total()); ?> bản ghi
                    </div>
                    <ul class="wg-pagination">
                        <li class="<?php echo e($contacts->onFirstPage() ? 'disabled' : ''); ?>">
                            <a href="<?php echo e($contacts->previousPageUrl() ?? '#'); ?>">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        <?php for($i = 1; $i <= $contacts->lastPage(); $i++): ?>
                            <li class="<?php echo e($contacts->currentPage() == $i ? 'active' : ''); ?>">
                                <a href="<?php echo e($contacts->url($i)); ?>"><?php echo e($i); ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="<?php echo e($contacts->hasMorePages() ? '' : 'disabled'); ?>">
                            <a href="<?php echo e($contacts->nextPageUrl() ?? '#'); ?>">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/contacts/trash.blade.php ENDPATH**/ ?>