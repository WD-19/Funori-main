<?php $__env->startSection('title', 'lịch sủ mua hàng user'); ?>

<?php $__env->startSection('content'); ?>
 
 <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>Order #123783</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.html"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Order</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Order detail</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Order #123783</div>
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
                                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <a class="tf-button style-1 w208" href="add-new-user.html"><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-user product-scroll-container" style="max-height: 400px; min-width: 100%; overflow: auto;">
                                        <ul class="table-title flex mb-14" style="min-width: 700px;">
                                            <li style="width: 25%">
                                                <div class="body-title">User</div>
                                            </li>
                                            <li style="width: 20%">
                                                <div class="body-title">Phone</div>
                                            </li>
                                            <li style="width: 35%">
                                                <div class="body-title">Email</div>
                                            </li>
                                            <li style="width: 20%">
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column" style="min-width: 700px;">
                                            <li class="wg-product item-row">
                                                <div class="name flex-grow">
                                                    <div class="image">
                                                        <img src="images/products/product-1.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            <a href="#" class="body-title-2">V-neck linen T-shirt</a>
                                                        </div>
                                                        <div class="text-tiny">Product name</div>
                                                    </div>
                                                </div>
                                                <div class="body-text">(212) 555-1234</div>
                                                <div class="body-text">info@fashionshop.com</div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row">
                                                <div class="name flex-grow">
                                                    <div class="image">
                                                        <img src="images/products/product-2.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            <a href="#" class="body-title-2">Neptune Longsleeve</a>
                                                        </div>
                                                        <div class="text-tiny">Product name</div>
                                                    </div>
                                                </div>
                                                <div class="body-text">(212) 555-1234</div>
                                                <div class="body-text">info@fashionshop.com</div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row">
                                                <div class="name flex-grow">
                                                    <div class="image">
                                                        <img src="images/products/product-3.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            <a href="#" class="body-title-2">Ribbed Tank Top</a>
                                                        </div>
                                                        <div class="text-tiny">Product name</div>
                                                    </div>
                                                </div>
                                                <div class="body-text">(212) 555-1234</div>
                                                <div class="body-text">info@fashionshop.com</div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row">
                                                <div class="name flex-grow">
                                                    <div class="image">
                                                        <img src="images/products/product-4.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            <a href="#" class="body-title-2">Oversized Motif T-shirt</a>
                                                        </div>
                                                        <div class="text-tiny">Product name</div>
                                                    </div>
                                                </div>
                                                <div class="body-text">(212) 555-1234</div>
                                                <div class="body-text">info@fashionshop.com</div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row">
                                                <div class="name flex-grow">
                                                    <div class="image">
                                                        <img src="images/products/product-5.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <div class="title">
                                                            <a href="#" class="body-title-2">Jersey thong body</a>
                                                        </div>
                                                        <div class="text-tiny">Product name</div>
                                                    </div>
                                                </div>
                                                <div class="body-text">(212) 555-1234</div>
                                                <div class="body-text">info@fashionshop.com</div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10">
                                        <div class="text-tiny">Showing 10 entries</div>
                                        <ul class="wg-pagination">
                                            <li>
                                                <a href="#"><i class="icon-chevron-left"></i></a>
                                            </li>
                                            <li>
                                                <a href="#">1</a>
                                            </li>
                                            <li class="active">
                                                <a href="#">2</a>
                                            </li>
                                            <li>
                                                <a href="#">3</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-chevron-right"></i></a>
                                            </li>
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
    max-height: 400px;
    min-width: 100%;
    background: #fff;
    border-radius: 8px;
}
.product-scroll-container ul {
    min-width: 700px; /* hoặc lớn hơn nếu bảng nhiều cột */
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/users/order_history.blade.php ENDPATH**/ ?>