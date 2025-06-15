<?php $__env->startSection('title', 'Order' . $order->order_code); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Order #<?php echo e($order->order_code); ?></h3>
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
                        <a href="<?php echo e(route('admin.orders.index')); ?>">
                            <div class="text-tiny">Order</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order detail</div>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order #<?php echo e($order->order_code); ?></div>
                    </li>
                </ul>
            </div>
            <!-- order-detail -->
            <div class="wg-order-detail">
                <div class="left flex-grow">
                    <div class="wg-box mb-20">
                        <div class="wg-table table-order-detail">
                            <ul class="table-title flex items-center justify-between gap20 mb-24">
                                <li>
                                    <div class="body-title">All items</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column">
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="wg-product">
                                        <div class="name">
                                            <div class="image">
                                                <img src="<?php echo e(optional($item->product)->image_url ?: asset('images/products/default.jpg')); ?>"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="text-tiny">Product name</div>
                                                <div class="title">
                                                    <a href="#"
                                                        class="body-title-2"><?php echo e($item->product->name ?? 'N/A'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-tiny">Quantity</div>
                                            <div class="title">
                                                <div class="body-title-2"><?php echo e($item->quantity); ?></div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="wg-box">
                        <div class="wg-table table-cart-totals">
                            <ul class="table-title flex mb-24">
                                <li>
                                    <div class="body-title">Cart Totals</div>
                                </li>
                                <li>
                                    <div class="body-title">Price</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column gap14">
                                <li class="cart-totals-item">
                                    <span class="body-text">Subtotal:</span>
                                    <span class="body-title-2">$<?php echo e(number_format($order->subtotal_amount, 2)); ?></span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Shipping:</span>
                                    <span class="body-title-2">$<?php echo e(number_format($order->shipping_fee, 2)); ?></span>
                                </li>
                                <?php if($order->discount_amount): ?>
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Discount:</span>
                                        <span class="body-title-2">- $<?php echo e(number_format($order->discount_amount, 2)); ?></span>
                                    </li>
                                <?php endif; ?>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Tax (GST):</span>
                                    <span class="body-title-2">$<?php echo e(number_format($order->tax_amount, 2)); ?></span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-title">Total price:</span>
                                    <span
                                        class="body-title tf-color-1">$<?php echo e(number_format($order->total_amount, 2)); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Summary</div>
                        <div class="summary-item">
                            <div class="body-text">Order ID</div>
                            <div class="body-title-2">#<?php echo e($order->order_code); ?></div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Status</div>
                            <div class="body-title-2">
                                <?php if($order->order_status === 'delivered'): ?>
                                    <span class="block-available bg-1 fw-7">Delivered</span>
                                <?php elseif($order->order_status === 'pending' || $order->order_status === 'pending_confirmation'): ?>
                                    <span class="block-pending bg-1 fw-7">Pending</span>
                                <?php elseif($order->order_status === 'cancelled'): ?>
                                    <span class="block-pending bg-1 fw-7" style="background:#f87171">Cancelled</span>
                                <?php else: ?>
                                    <span
                                        class="block-pending bg-1 fw-7"><?php echo e(ucfirst(str_replace('_', ' ', $order->order_status))); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Date</div>
                            <div class="body-title-2">
                                <?php echo e($order->ordered_at ? $order->ordered_at->format('d M Y H:i') : '-'); ?></div>
                        </div>
                        <div class="summary-item">
                            <div class="body-text">Total</div>
                            <div class="body-title-2 tf-color-1">$<?php echo e(number_format($order->total_amount, 2)); ?></div>
                        </div>
                        <?php if($order->customer_note): ?>
                            <div class="summary-item">
                                <div class="body-text">Customer Note</div>
                                <div class="body-title-2"><?php echo e($order->customer_note); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if($order->admin_note): ?>
                            <div class="summary-item">
                                <div class="body-text">Admin Note</div>
                                <div class="body-title-2"><?php echo e($order->admin_note); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Shipping Address</div>
                        <div class="body-text"><?php echo e($order->shipping_address); ?></div>
                    </div>
                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Payment Method</div>
                        <div class="body-text"><?php echo e($order->paymentMethod->name ?? ($order->payment_method ?? 'N/A')); ?></div>
                    </div>
                    <div class="wg-box mb-20 gap10">
                        <div class="body-title">Shipping Method</div>
                        <div class="body-text"><?php echo e($order->shippingMethod->name ?? ($order->shipping_method ?? 'N/A')); ?></div>
                    </div>
                    <div class="wg-box gap10">
                        <div class="body-title">Expected Date Of Delivery</div>
                        <div class="body-title-2 tf-color-2">
                            <?php echo e($order->delivered_at ? $order->delivered_at->format('d M Y') : '-'); ?>

                        </div>
                        <a class="tf-button style-1 w-full" href="<?php echo e(route('admin.orders.tracking', $order->id)); ?>"><i
                                class="icon-truck"></i>Track order</a>
                        <a class="tf-button w-full" target="_blank"
                            href="<?php echo e(route('admin.orders.printInvoice', $order->id)); ?>"><i
                                class="icon-file-text"></i>print invoice
                        </a>
                        <a class="tf-button w-full" target="_blank"
                            href="<?php echo e(route('admin.orders.printShipping', $order->id)); ?>"><i
                                class="icon-file-text"></i>Print delivery note
                        </a>
                    </div>
                </div>
            </div>
            <!-- /order-detail -->
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="https://themesflat.co/html/ecomus/index.html">Ecomus</a>. Design
            by Themesflat All rights reserved</div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>