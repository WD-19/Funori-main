<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <div class="button-show-hide">
                <i class="icon-chevron-left"></i>
            </div>
        </div>
        <div class="header-grid">
            <?php
                use Illuminate\Support\Str;
                use App\Models\ContactSubmission;
                $newContactCount = ContactSubmission::where('status', 'new')->count();
                $contacts = ContactSubmission::where('status', 'new')->orderBy('created_at', 'desc')->get();
            ?>
            <div class="header-item country">
                <select class="image-select no-text">
                    <option data-thumbnail="<?php echo e(asset('images/country/1.png')); ?>">ENG</option>
                    <option data-thumbnail="<?php echo e(asset('images/country/9.png')); ?>">VIE</option>
                </select>
            </div>
            <div class="header-item button-dark-light">
                <i class="icon-moon"></i>
            </div>
            <div class="popup-wrap noti type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <span class="text-tiny"><?php echo e($newContactCount); ?></span>
                            <i class="icon-message-square"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <h6>Tin Nhắn</h6>
                        </li>
                        <div style="max-height: 320px; overflow-y: auto; padding-right: 4px;">
                            <ul style="margin: 0; padding: 0; list-style: none;">
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="margin-bottom: 14px;">
                                        <div class="noti-item w-full wg-user active">
                                            <div class="image">
                                                <img src="<?php echo e(asset('images/customers/customer-1.jpg')); ?>"
                                                    alt="">
                                            </div>
                                            <div class="flex-grow">
                                                <div class="flex items-center justify-between">
                                                    <a href="<?php echo e(route('admin.contacts.edit', $contact->id)); ?>"
                                                        class="body-title"><?php echo e($contact->name); ?></a>
                                                    <div class="time"><?php echo e($contact->created_at->format('H:i d/m')); ?>

                                                    </div>
                                                </div>
                                                <div class="text-tiny"><?php echo e(Str::limit($contact->message, 30)); ?></div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <li><a href="<?php echo e(route('admin.contacts.index')); ?>" class="tf-button w-full">View all</a></li>
                    </ul>

                    <style>
                        .dropdown-menu.has-content {
                            min-width: 320px;
                        }

                        .dropdown-menu.has-content ul li {
                            margin-bottom: 14px;
                        }

                        .dropdown-menu.has-content ul li:last-child {
                            margin-bottom: 0;
                        }

                        .dropdown-menu.has-content div[style*="overflow-y: auto"]::-webkit-scrollbar {
                            width: 6px;
                            background: #f1f1f1;
                            border-radius: 3px;
                        }

                        .dropdown-menu.has-content div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb {
                            background: #ccc;
                            border-radius: 3px;
                        }
                    </style>
                </div>
            </div>
            <div class="popup-wrap message type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <span class="text-tiny">1</span>
                            <i class="icon-bell"></i>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
                        <li>
                            <h6>Thông Báo</h6>
                        </li>
                        <li>
                            <div class="message-item item-1">
                                <div class="image">
                                    <i class="icon-noti-1"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Discount available</div>
                                    <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec
                                        diam</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-2">
                                <div class="image">
                                    <i class="icon-noti-2"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Account has been verified</div>
                                    <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus et</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-3">
                                <div class="image">
                                    <i class="icon-noti-3"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Order shipped successfully</div>
                                    <div class="text-tiny">Integer aliquam eros nec sollicitudin sollicitudin</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-4">
                                <div class="image">
                                    <i class="icon-noti-4"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Order pending: <span>ID 305830</span></div>
                                    <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="tf-button w-full">View all</a></li>
                    </ul>
                </div>
            </div>
            <div class="header-item button-zoom-maximize">
                <div class="">
                    <i class="icon-maximize"></i>
                </div>
            </div>
            <div class="popup-wrap apps type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton4"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.625 0.812501C3.06874 0.812501 2.52497 0.977451 2.06246 1.28649C1.59995 1.59553 1.23946 2.03479 1.02659 2.5487C0.813719 3.06262 0.758022 3.62812 0.866543 4.17369C0.975064 4.71926 1.24293 5.2204 1.63626 5.61374C2.0296 6.00707 2.53074 6.27494 3.07631 6.38346C3.62188 6.49198 4.18738 6.43628 4.7013 6.22341C5.21522 6.01054 5.65447 5.65006 5.96351 5.18754C6.27255 4.72503 6.4375 4.18126 6.4375 3.625C6.4375 2.87908 6.14118 2.16371 5.61374 1.63626C5.08629 1.10882 4.37092 0.812501 3.625 0.812501ZM3.625 5.3125C3.29125 5.3125 2.96498 5.21353 2.68748 5.02811C2.40997 4.84268 2.19368 4.57913 2.06595 4.27078C1.93823 3.96243 1.90481 3.62313 1.96993 3.29579C2.03504 2.96844 2.19576 2.66776 2.43176 2.43176C2.66776 2.19576 2.96844 2.03504 3.29579 1.96993C3.62313 1.90481 3.96243 1.93823 4.27078 2.06595C4.57913 2.19368 4.84268 2.40997 5.02811 2.68748C5.21353 2.96498 5.3125 3.29125 5.3125 3.625C5.3125 4.07255 5.13471 4.50178 4.81824 4.81824C4.50178 5.13471 4.07255 5.3125 3.625 5.3125ZM10.375 6.4375C10.9313 6.4375 11.475 6.27255 11.9375 5.96351C12.4001 5.65447 12.7605 5.21522 12.9734 4.7013C13.1863 4.18738 13.242 3.62188 13.1335 3.07631C13.0249 2.53074 12.7571 2.0296 12.3637 1.63626C11.9704 1.24293 11.4693 0.975064 10.9237 0.866543C10.3781 0.758022 9.81262 0.813719 9.2987 1.02659C8.78479 1.23946 8.34553 1.59995 8.03649 2.06246C7.72745 2.52497 7.5625 3.06874 7.5625 3.625C7.5625 4.37092 7.85882 5.08629 8.38626 5.61374C8.91371 6.14118 9.62908 6.4375 10.375 6.4375ZM10.375 1.9375C10.7088 1.9375 11.035 2.03647 11.3125 2.2219C11.59 2.40732 11.8063 2.67087 11.934 2.97922C12.0618 3.28757 12.0952 3.62687 12.0301 3.95422C11.965 4.28156 11.8042 4.58224 11.5682 4.81824C11.3322 5.05425 11.0316 5.21496 10.7042 5.28008C10.3769 5.34519 10.0376 5.31177 9.72922 5.18405C9.42087 5.05633 9.15732 4.84003 8.9719 4.56253C8.78647 4.28502 8.6875 3.95876 8.6875 3.625C8.6875 3.17745 8.86529 2.74823 9.18176 2.43176C9.49823 2.11529 9.92745 1.9375 10.375 1.9375ZM3.625 7.5625C3.06874 7.5625 2.52497 7.72745 2.06246 8.03649C1.59995 8.34553 1.23946 8.78479 1.02659 9.2987C0.813719 9.81262 0.758022 10.3781 0.866543 10.9237C0.975064 11.4693 1.24293 11.9704 1.63626 12.3637C2.0296 12.7571 2.53074 13.0249 3.07631 13.1335C3.62188 13.242 4.18738 13.1863 4.7013 12.9734C5.21522 12.7605 5.65447 12.4001 5.96351 11.9375C6.27255 11.475 6.4375 10.9313 6.4375 10.375C6.4375 9.62908 6.14118 8.91371 5.61374 8.38626C5.08629 7.85882 4.37092 7.5625 3.625 7.5625ZM3.625 12.0625C3.29125 12.0625 2.96498 11.9635 2.68748 11.7781C2.40997 11.5927 2.19368 11.3291 2.06595 11.0208C1.93823 10.7124 1.90481 10.3731 1.96993 10.0458C2.03504 9.71844 2.19576 9.41776 2.43176 9.18176C2.66776 8.94576 2.96844 8.78504 3.29579 8.71993C3.62313 8.65481 3.96243 8.68823 4.27078 8.81595C4.57913 8.94368 4.84268 9.15997 5.02811 9.43748C5.21353 9.71498 5.3125 10.0412 5.3125 10.375C5.3125 10.8226 5.13471 11.2518 4.81824 11.5682C4.50178 11.8847 4.07255 12.0625 3.625 12.0625ZM10.375 7.5625C9.81874 7.5625 9.27497 7.72745 8.81246 8.03649C8.34995 8.34553 7.98946 8.78479 7.77659 9.2987C7.56372 9.81262 7.50802 10.3781 7.61654 10.9237C7.72506 11.4693 7.99293 11.9704 8.38626 12.3637C8.7796 12.7571 9.28074 13.0249 9.82631 13.1335C10.3719 13.242 10.9374 13.1863 11.4513 12.9734C11.9652 12.7605 12.4045 12.4001 12.7135 11.9375C13.0226 11.475 13.1875 10.9313 13.1875 10.375C13.1875 9.62908 12.8912 8.91371 12.3637 8.38626C11.8363 7.85882 11.1209 7.5625 10.375 7.5625ZM10.375 12.0625C10.0412 12.0625 9.71498 11.9635 9.43748 11.7781C9.15997 11.5927 8.94368 11.3291 8.81595 11.0208C8.68823 10.7124 8.65481 10.3731 8.71993 10.0458C8.78504 9.71844 8.94576 9.41776 9.18176 9.18176C9.41776 8.94576 9.71844 8.78504 10.0458 8.71993C10.3731 8.65481 10.7124 8.68823 11.0208 8.81595C11.3291 8.94368 11.5927 9.15997 11.7781 9.43748C11.9635 9.71498 12.0625 10.0412 12.0625 10.375C12.0625 10.8226 11.8847 11.2518 11.5682 11.5682C11.2518 11.8847 10.8226 12.0625 10.375 12.0625Z"
                                    fill="#0A0A0C" />
                            </svg>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton4">
                        <li>
                            <h6>Related apps</h6>
                        </li>
                        <li>
                            <ul class="list-apps">
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-1.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Photoshop</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-2.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">illustrator</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-3.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Sheets</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-4.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Gmail</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-5.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Messenger</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-6.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Youtube</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-7.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Flaticon</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-8.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">Instagram</div>
                                    </a>
                                </li>
                                <li class="item">
                                    <div class="image">
                                        <img src="<?php echo e(asset('images/apps/item-9.png')); ?>" alt="">
                                    </div>
                                    <a href="#">
                                        <div class="text-tiny">PDF</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#" class="tf-button w-full">View all app</a></li>
                    </ul>
                </div>
            </div>
            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <?php
                        $user = Auth::user();
                    ?>

                    <?php if($user): ?>
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="header-user wg-user">
                                <span class="image">
                                    <img src="<?php echo e(asset($user->avatar_url ?? 'images/images.jpg')); ?>" alt=""
                                        style="width: 50px; height: 35px; border-radius: 50%; object-fit: cover;">
                                </span>
                                <span class="flex flex-column">
                                    <span class="body-text text-main-dark"><?php echo e($user->full_name); ?></span>
                                    <span class="text-tiny">Sale Administrator</span>
                                </span>
                            </span>
                        </button>
                    <?php endif; ?>

                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="body-title-2">Inbox</div>
                                <div class="number">27</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-file-text"></i>
                                </div>
                                <div class="body-title-2">Taskboard</div>
                            </a>
                        </li>
                        <li>
                            <a href="setting.html" class="user-item">
                                <div class="icon">
                                    <i class="icon-settings"></i>
                                </div>
                                <div class="body-title-2">Setting</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-headphones"></i>
                                </div>
                                <div class="body-title-2">Support</div>
                            </a>
                        </li>
                        <li>
                            
                            <form action="<?php echo e(route('client.logout')); ?>" method="POST" class="d-inline w-100">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-danger btn-lg w-100">
                                    <i class="icon-log-out"></i> Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/partials/header.blade.php ENDPATH**/ ?>