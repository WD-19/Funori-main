<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Chỉnh sửa liên hệ</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="<?php echo e(route('admin.contacts.index')); ?>">
                            <div class="text-tiny">Liên hệ</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Chỉnh sửa liên hệ</div>
                    </li>
                </ul>
            </div>
            <!-- form-edit-contact -->
            <form class="form-edit-contact" method="POST" action="<?php echo e(route('admin.contacts.update', $contacts->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="wg-box mb-30">
                    <fieldset class="email">
                        <div class="body-title mb-10">Email</div>
                        <input type="email" class="form-control" name="email" value="<?php echo e(old('email', $contacts->email)); ?>" readonly>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Họ tên</div>
                        <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $contacts->name)); ?>" readonly>
                    </fieldset>
                    <fieldset class="phone">
                        <div class="body-title mb-10">Số điện thoại</div>
                        <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone', $contacts->phone)); ?>" readonly>
                    </fieldset>
                    <fieldset class="subject">
                        <div class="body-title mb-10">Tiêu đề</div>
                        <input type="text" class="form-control" name="subject" value="<?php echo e(old('subject', $contacts->subject)); ?>" readonly>
                    </fieldset>
                    <fieldset class="message">
                        <div class="body-title mb-10">Nội dung</div>
                        <input type="text" name="message" class="form-control" value="<?php echo e(old('message', $contacts->message)); ?>" readonly>
                    </fieldset>
                    <fieldset class="status">
                        <div class="body-title mb-10">Trạng thái</div>
                        <select name="status">
                            <option value="new" <?php echo e($contacts->status == 'new' ? 'selected' : ''); ?>>Mới</option>
                            <option value="read" <?php echo e($contacts->status == 'read' ? 'selected' : ''); ?>>Đã đọc</option>
                            <option value="replied" <?php echo e($contacts->status == 'replied' ? 'selected' : ''); ?>>Đã trả lời</option>
                            <option value="resolved" <?php echo e($contacts->status == 'resolved' ? 'selected' : ''); ?>>Đã xử lý</option>
                        </select>
                    </fieldset>
                    <fieldset class="admin_reply">
                        <div class="body-title mb-10">Phản hồi của admin</div>
                        <textarea name="admin_reply" class="card rounded-3 border-2" rows="3"><?php echo e(old('admin_reply', $contacts->admin_reply)); ?></textarea>
                    </fieldset>
                    <?php
                        $admins = \App\Models\User::where('role', 'admin')->get();
                    ?>
                    <fieldset class="replied_by">
                        <div class="body-title mb-10">Người trả lời (Admin)*</div>
                        <select name="replied_by">
                            <option value="">-- Chọn admin --</option>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($admin->id); ?>" <?php echo e(old('replied_by', $contacts->replied_by) == $admin->id ? 'selected' : ''); ?>>
                                    <?php echo e($admin->full_name ?? $admin->email); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </fieldset>
                    <fieldset class="created_at">
                        <div class="body-title mb-10">Ngày tạo</div>
                        <input type="text" class="form-control" value="<?php echo e($contacts->created_at->format('d-m-Y H:i')); ?>" disabled>
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Cập nhật liên hệ</button>
                    <a href="<?php echo e(route('admin.contacts.index')); ?>" class="tf-button style-3 w380">Hủy</a>
                </div>
            </form>
            <!-- /form-edit-contact -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/contacts/edit.blade.php ENDPATH**/ ?>