<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách liên hệ</h3>
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
                            <div class="text-tiny">Liên hệ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh sách liên hệ</div>
                    </li>
                </ul>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên hoặc email..." name="keyword"
                                    value="<?php echo e(request('keyword')); ?>">
                            </fieldset>
                            <fieldset>
                                <select name="status">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="new" <?php echo e(request('status') == 'new' ? 'selected' : ''); ?>>Mới</option>
                                    <option value="read" <?php echo e(request('status') == 'read' ? 'selected' : ''); ?>>Đã đọc</option>
                                    <option value="replied" <?php echo e(request('status') == 'replied' ? 'selected' : ''); ?>>Đã trả lời</option>
                                    <option value="resolved" <?php echo e(request('status') == 'resolved' ? 'selected' : ''); ?>>Đã xử lý</option>
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="#">
                        <i class="icon-file-text"></i>Xuất tất cả liên hệ
                    </a>
                </div>
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li><div class="body-title">Email</div></li>
                        <li><div class="body-title">Họ tên</div></li>
                        <li><div class="body-title">Số điện thoại</div></li>
                        <li><div class="body-title">Tiêu đề</div></li>
                        <li><div class="body-title">Nội dung</div></li>
                        <li><div class="body-title">Trạng thái</div></li>
                        <li><div class="body-title">Phản hồi của admin</div></li>
                        <li><div class="body-title">Người trả lời</div></li>
                        <li><div class="body-title">Ngày tạo</div></li>
                        <li><div class="body-title">Thao tác</div></li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->email); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->name); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->phone); ?></div>
                                <div class="body-text text-main-dark mt-4"><?php echo e($value->subject); ?></div>
                                <div class="body-text text-main-dark mt-4">(Xem chi tiết)</div>
                                <div>
                                    <div class="block-available status-<?php echo e($value->status); ?> fw-7">
                                        <?php
                                            $statusText = match($value->status) {
                                                'new' => 'Mới',
                                                'read' => 'Đã đọc',
                                                'replied' => 'Đã trả lời',
                                                'resolved' => 'Đã xử lý',
                                                default => ucfirst($value->status)
                                            };
                                        ?>
                                        <?php echo e($statusText); ?>

                                    </div>
                                </div>
                                <div class="body-text text-main-dark mt-4">(Xem chi tiết)</div>
                                <div class="body-text text-main-dark mt-4">
                                    <?php if($value->replied_by): ?>
                                        <?php echo e(\App\Models\User::find($value->replied_by)->full_name ?? 'Không rõ'); ?>

                                    <?php else: ?>
                                        <span class="badge bg-danger">Không rõ</span>
                                    <?php endif; ?>
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    <?php echo e($value->created_at->format('d-m-Y')); ?>

                                </div>
                                <div class="list-icon-function">
                                    <div class="item eye" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal<?php echo e($value->id); ?>">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <!-- Modal Quick View contact -->
                                    <div class="modal fade" id="quickViewModal<?php echo e($value->id); ?>" tabindex="-1"
                                        aria-labelledby="quickViewLabel<?php echo e($value->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content shadow-lg rounded-5 border-0"
                                                style="font-size: 18px; border-radius: 32px;">
                                                <div class="modal-header bg-gradient-primary text-white rounded-top-5"
                                                    style="background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%); border-top-left-radius: 32px; border-top-right-radius: 32px;">
                                                    <h3 class="modal-title fw-bold mb-0 text-light"
                                                        id="quickViewLabel<?php echo e($value->id); ?>">
                                                        <i class="fa-solid fa-envelope-open-text me-2"></i>Chi tiết liên hệ
                                                    </h3>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                </div>
                                                <div class="modal-body px-5 py-4"
                                                    style="background: #f8fafc; border-bottom-left-radius: 32px; border-bottom-right-radius: 32px;">
                                                    <div class="row gy-4">
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-user me-2 text-primary"></i>
                                                            <strong>Họ tên:</strong>
                                                            <span class="text-dark ms-1 fs-5"><?php echo e($value->name); ?></span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-envelope me-2 text-primary"></i>
                                                            <strong>Email:</strong>
                                                            <span class="text-dark ms-1 fs-5"><?php echo e($value->email); ?></span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-phone me-2 text-primary"></i>
                                                            <strong>Số điện thoại:</strong>
                                                            <span class="text-dark ms-1 fs-5"><?php echo e($value->phone); ?></span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-tag me-2 text-primary"></i>
                                                            <strong>Tiêu đề:</strong>
                                                            <span class="text-dark ms-1 fs-5"><?php echo e($value->subject); ?></span>
                                                        </div>
                                                        <div class="col-12 mb-2">
                                                            <i class="fa-solid fa-message me-2 text-primary"></i>
                                                            <strong>Nội dung:</strong>
                                                            <div class="border rounded-4 p-4 bg-white text-secondary fst-italic mt-2 fs-5 shadow-sm">
                                                                <?php echo e($value->message); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-circle-info me-2 text-primary"></i>
                                                            <strong>Trạng thái:</strong>
                                                            <span class="badge ms-2 fs-6"
                                                                style="background: #007bff; color: #fff; font-weight: bold; border-radius: 12px; padding: 8px 18px;">
                                                                <?php echo e($statusText); ?>

                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-user-shield me-2 text-primary"></i>
                                                            <strong>Phản hồi của admin:</strong>
                                                            <div class="border rounded-4 p-3 bg-light text-secondary fst-italic mt-2 fs-6 shadow-sm">
                                                                <?php echo e($value->admin_reply ?? '(Chưa có phản hồi)'); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-user-tie me-2 text-primary"></i>
                                                            <strong>Người trả lời:</strong>
                                                            <span class="text-dark ms-1 fs-5">
                                                                <?php if($value->replied_by): ?>
                                                                    <?php echo e(\App\Models\User::find($value->replied_by)->full_name ?? 'Không rõ'); ?>

                                                                <?php else: ?>
                                                                    Không rõ
                                                                <?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-calendar-days me-2 text-primary"></i>
                                                            <strong>Ngày tạo:</strong>
                                                            <span class="text-dark ms-1 fs-5"><?php echo e($value->created_at->format('d-m-Y H:i')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item edit">
                                        <a href="<?php echo e(route('admin.contacts.edit', $value->id)); ?>"><i class="icon-edit-3"></i></a>
                                    </div>
                                    
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <!-- /order-list -->
        </div>
        <!-- /main-content-wrap -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/contacts/index.blade.php ENDPATH**/ ?>