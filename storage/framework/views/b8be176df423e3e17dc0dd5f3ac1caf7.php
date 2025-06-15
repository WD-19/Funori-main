<?php $__env->startSection('title', 'Chi tiết user'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>User Detail</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?php echo e(route('admin.users.index')); ?>">
                            <div class="text-tiny">User List</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">User Detail</div>
                    </li>
                </ul>
            </div>
            <!-- user-detail -->
            <form class="form-add-new-user form-style-2">
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Account</h5>
                        <div class="body-text1">Thông tin tài khoản</div>
                        <div class="avatar-upload mt-3 mb-4">
                            <img src="<?php echo e($user->avatar_url ? asset($user->avatar_url) : asset('images/images.jpg')); ?>"
                                alt="Avatar" class="avatar-preview" id="avatarPreview"
                                style="width:120px;height:120px;border-radius:50%;">
                        </div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Name</div>
                            <input class="flex-grow" type="text" placeholder="Username" name="full_name"
                                value="<?php echo e($user->full_name); ?>" readonly>
                        </fieldset>
                        <fieldset class="email mb-24">
                            <div class="body-title mb-10">Email</div>
                            <input class="flex-grow" type="email" placeholder="Email" name="email"
                                value="<?php echo e($user->email); ?>" readonly>
                        </fieldset>
                        <fieldset class="phone mb-24">
                            <div class="body-title mb-10">Phone Number</div>
                            <input class="flex-grow" type="text" placeholder="Phone Number" name="phone_number"
                                value="<?php echo e($user->phone_number); ?>" readonly>
                        </fieldset>
                        <fieldset class="password mb-24">
                            <div class="body-title mb-10">Password</div>
                            <input class="password-input" type="password" placeholder="Password" value="********" readonly>
                        </fieldset>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Permission</h5>
                        <div class="body-text">Phân quyền tài khoản</div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Account Status</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="account_status" value="active"
                                        <?php echo e($user->account_status == 'active' ? 'checked' : ''); ?> disabled>
                                    <label><span class="body-title-2">Active</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" value="inactive"
                                        <?php echo e($user->account_status == 'inactive' ? 'checked' : ''); ?> disabled>
                                    <label><span class="body-title-2">Inactive</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" value="banned"
                                        <?php echo e($user->account_status == 'banned' ? 'checked' : ''); ?> disabled>
                                    <label><span class="body-title-2">Banned</span></label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Role</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="role" value="admin"
                                        <?php echo e($user->role == 'admin' ? 'checked' : ''); ?> disabled>
                                    <label><span class="body-title-2">Admin</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="role" value="user"
                                        <?php echo e($user->role == 'user' ? 'checked' : ''); ?> disabled>
                                    <label><span class="body-title-2">User</span></label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="bot mt-4">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="tf-button w180">Back</a>
                    <a href="<?php echo e(route('admin.users.orderHistory', $user->id)); ?>" class="tf-button w180 btn-primary">Order
                        History</a>
                </div>
            </form>
            <!-- /user-detail -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/users/detail.blade.php ENDPATH**/ ?>