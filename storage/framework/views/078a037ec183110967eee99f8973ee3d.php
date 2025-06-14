<?php $__env->startSection('title', 'lịch sủ mua hàng user'); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Order </h3>
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
                            <div class="text-tiny">Order</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Order detail</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order </div>
                    </li>
                </ul>
            </div>
            <!-- order-detail -->
            <div class="wg-order-detail">
                <div class="left flex-grow">
                    <div class="wg-box mb-20">
                        <div class="wg-table table-user-info">
                            <div class="body-title mb-16">User Information</div>

                            <div class="summary-item mb-12">
                                <div class="body-text">Full Name</div>
                                <div class="body-title-2"><?php echo e($user->full_name); ?></div>
                            </div>

                            <div class="summary-item mb-12">
                                <div class="body-text">Email</div>
                                <div class="body-title-2"><?php echo e($user->email); ?></div>
                            </div>

                            <div class="summary-item mb-0">
                                <div class="body-text">Phone</div>
                                <div class="body-title-2"><?php echo e($user->phone_number); ?></div>
                            </div>
                        </div>
                    </div>
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
                        </div>
                        <div class="wg-table table-all-user product-scroll-container"
                            style="max-height: 400px; min-width: 100%; overflow: auto;">
                            <ul class="table-title flex mb-14" style="min-width: 700px;">
                                <li style="width: 25%">
                                    <div class="body-title">Order code</div>
                                </li>
                                <li style="width: 20%">
                                    <div class="body-title">Date booked</div>
                                </li>
                                <li style="width: 20%">
                                    <div class="body-title">Order Status</div>
                                </li>
                                <li style="width: 35%">
                                    <div class="body-title">Payment Status</div>
                                </li>
                                <li style="width: 20%">
                                    <div class="body-title">Total amount</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" style="min-width: 700px;">

                                <ul class="flex flex-column" style="min-width: 700px;">
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="wg-product item-row flex">
                                            <div class="body-text" style="width: 25%;"><?php echo e($order->order_code); ?></div>
                                            <div class="body-text" style="width: 20%;">
                                                <?php echo e($order->ordered_at->format('d-m-Y')); ?></div>
                                            <div class="body-text" style="width: 20%;"><?php echo e($order->order_status); ?></div>
                                            <div class="body-text" style="width: 35%;"><?php echo e($order->payment_status); ?></div>
                                            <div class="body-text" style="width: 20%;"><?php echo e($order->total_amount); ?></div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                            </ul>
                        </div>
                      
                    </div>

                </div>

            </div>
            <!-- /order-detail -->
        </div>
        <!-- /main-content-wrap -->
    </div>

    <style>
        .product-scroll-container {
            overflow-x: auto !important;
            overflow-y: auto !important;
            max-height: 200px;
            min-width: 100%;
            background: #fff;
            border-radius: 8px;
        }

        /* Thanh scroll dọc nhỏ lại cho Chrome, Edge, Safari */
        .product-scroll-container::-webkit-scrollbar {
            width: 6px;
        }

        .product-scroll-container::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        /* Firefox */
        .product-scroll-container {
            scrollbar-width: thin;
            scrollbar-color: #ccc #fff;
        }

        .product-scroll-container ul {
            min-width: 700px;
            /* hoặc lớn hơn nếu bảng nhiều cột */
        }
    </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/users/orderHistory.blade.php ENDPATH**/ ?>