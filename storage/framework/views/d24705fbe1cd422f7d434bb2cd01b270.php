<?php $__env->startSection('title', 'Thêm user'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Add New User</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">User</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add New User</div>
                    </li>
                </ul>
            </div>
            <!-- add-new-user -->
            <form class="form-add-new-user form-style-2" enctype="multipart/form-data" method="POST"
                action="<?php echo e(route('admin.users.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Account</h5>
                        <div class="body-text1">Fill in the information below to add a new account</div>
                        <div class="avatar-upload mt-3 mb-4">
                            <label for="avatarInput">
                                <img src="<?php echo e(asset('images/images.jpg')); ?>" alt="Avatar" class="avatar-preview"
                                    id="avatarPreview">
                            </label>
                            <input type="file" id="avatarInput" name="avatar_url" accept="image/*"
                                style="display: none;">
                            <?php $__errorArgs = ['avatar_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Name</div>
                            <input class="flex-grow" type="text" placeholder="Username" name="full_name" tabindex="0"
                                value="" aria-required="true" value="<?php echo e(old('full_name')); ?>">
                            <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                        <fieldset class="email mb-24">
                            <div class="body-title mb-10">Email</div>
                            <input class="flex-grow" type="email" placeholder="Email" name="email" tabindex="0"
                                value="" aria-required="true" value="<?php echo e(old('email')); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                        <fieldset class="phone mb-24">
                            <div class="body-title mb-10">Phone Number</div>
                            <input class="flex-grow" type="text" placeholder="Phone Number" name="phone_number"
                                tabindex="0" value="<?php echo e(old('phone_number')); ?>" aria-required="true">
                            <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                        <fieldset class="password mb-24">
                            <div class="body-title mb-10">Password</div>
                            <input class="password-input" type="password" placeholder="Enter password" name="password"
                                tabindex="0" aria-required="true">
                            <span class="show-pass">
                                <i class="icon-eye view"></i>
                                <i class="icon-eye-off hide"></i>
                            </span>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                        <fieldset class="password">
                            <div class="body-title mb-10">Confirm password</div>
                            <input class="password-input" type="password" placeholder="Confirm password"
                                name="password_confirmation" tabindex="0" aria-required="true">
                            <span class="show-pass">
                                <i class="icon-eye view"></i>
                                <i class="icon-eye-off hide"></i>
                            </span>
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Permission</h5>
                        <div class="body-text">Items that the account is allowed to edit</div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Account Status</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product1" value="active"
                                        <?php echo e(old('account_status') == 'active' ? 'checked' : ''); ?>>
                                    <label for="apply-product1"><span class="body-title-2">Active</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product2" value="inactive"
                                        <?php echo e(old('account_status', 'inactive') == 'inactive' ? 'checked' : ''); ?>>
                                    <label for="apply-product2"><span class="body-title-2">Inactive</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product3" value="banned"
                                        <?php echo e(old('account_status') == 'banned' ? 'checked' : ''); ?>>
                                    <label for="apply-product3"><span class="body-title-2">Banned</span></label>
                                </div>
                            </div>
                            <?php $__errorArgs = ['account_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Role</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="role" id="create-product1" value="admin"
                                        <?php echo e(old('role') == 'admin' ? 'checked' : ''); ?>>
                                    <label for="create-product1"><span class="body-title-2">Admin</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="role" id="create-product2" value="user"
                                        <?php echo e(old('role', 'user') == 'user' ? 'checked' : ''); ?>>
                                    <label for="create-product2"><span class="body-title-2">User</span></label>
                                </div>
                            </div>
                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="bot">
                    <button class="tf-button w180" type="submit">Save</button>
                </div>
            </form>
            <!-- /add-new-user -->
        </div>
        <!-- /main-content-wrap -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('avatarInput');
            var preview = document.getElementById('avatarPreview');
            if (input && preview) {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/users/create.blade.php ENDPATH**/ ?>