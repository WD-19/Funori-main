<?php $__env->startSection('title', 'Đăng ký'); ?>

<?php $__env->startSection('content'); ?>

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="login-page">
                <div class="left">
                    <div class="login-box type-signup">
                        <div>
                            <h3>Tạo tài khoản mới</h3>
                            <div class="body-text text-white">Nhập thông tin cá nhân của bạn để đăng ký tài khoản
                            </div>
                        </div>
                        <div class="flex flex-column gap16 w-full">
                            <a href="#" class="tf-button style-2 w-full">
                                <span class="">Đăng nhập để tiếp tục sử dụng hệ thống.</span>
                            </a>
                        </div>
                        <form class="form-login flex flex-column gap22 w-full" action="<?php echo e(route('client.register.store')); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <div>
                                <div class="body-title mb-10 text-white">Họ và tên <span class="tf-color-1">*</span></div>
                                <div class="cols gap10">
                                    <fieldset class="name">
                                        <input class="flex-grow" type="text" placeholder="Nhập họ và tên" name="name"
                                            tabindex="0" value="<?php echo e(old('name')); ?>">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="email">
                                <div class="body-title mb-10 text-white">Địa chỉ email <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="email" placeholder="Nhập địa chỉ email" name="email"
                                    tabindex="0" value="<?php echo e(old('email')); ?>">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </fieldset>
                            <fieldset class="phone">
                                <div class="body-title mb-10 text-white">Số điện thoại <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="text" placeholder="Nhập số điện thoại" name="phone"
                                    tabindex="0" value="<?php echo e(old('phone')); ?>">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Mật khẩu <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Nhập mật khẩu" name="password"
                                    tabindex="0">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Xác nhận mật khẩu <span class="tf-color-1">*</span>
                                </div>
                                <input class="password-input" type="password" placeholder="Nhập lại mật khẩu"
                                    name="password_confirmation" tabindex="0">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mt-1" style="color: #ffb3b3; font-size: 16px;"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </fieldset>
                            <div class="flex justify-between items-center">
                                <div class="flex gap10">
                                    <input class="tf-check" type="checkbox" id="signed" required>
                                    <label class="body-text text-white" for="signed">
                                        Tôi đồng ý với
                                        <span style="color: #ffd700; text-decoration: underline;">Chính sách bảo mật</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="tf-button w-full" id="register-btn" disabled
                                style="opacity: 0.5; cursor: not-allowed;">Đăng ký</button>
                        </form>
                        <div class="bottom body-text text-center text-white w-full">
                            Đã có tài khoản?
                            <a href="<?php echo e(route('client.login.index')); ?>" class="body-text tf-color">Đăng nhập tại đây</a>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <!-- <img src="<?php echo e(asset('images/images-section/bg.jpg')); ?>" alt=""> -->
                </div>
            </div>
        </div>
        <!-- /#page -->
    </div>
    <script>
        // Disable/enable button theo checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('signed');
            const btn = document.getElementById('register-btn');
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    btn.disabled = false;
                    btn.style.opacity = 1;
                    btn.style.cursor = 'pointer';
                } else {
                    btn.disabled = true;
                    btn.style.opacity = 0.5;
                    btn.style.cursor = 'not-allowed';
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.auth.layout.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/client/auth/register.blade.php ENDPATH**/ ?>