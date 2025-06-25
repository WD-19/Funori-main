<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img id="pic" src="<?php echo e(asset('client/picture/slider-4.jpg')); ?>" alt="" />
        <div class="in-content">
            <div class="tran-box">
                <div class="title">Design for life</div>
                <div class="text-title">
                    Say hello to our brand new arrivals.
                </div>
                <div class="all-button">
                    <button>Shop all new in</button>
                </div>
            </div>
            <button id="left">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button id="right">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
        <div id="list">
            <ul>
                <li><button onclick="indexNumber(0)"></button></li>
                <li><button onclick="indexNumber(1)"></button></li>
                <li><button onclick="indexNumber(2)"></button></li>
            </ul>
        </div>
    </div>
    <div class="box-room">
        <a href="">
            <div class="living-room">
                <img src="<?php echo e(asset('client/picture/Living-room.jpg')); ?>" alt="" />
                <div class="title-Living-room">Living room</div>
                <div class="Shop-col">Shop Collection</div>
            </div>
        </a>
        <a href="">
            <div class="bed-room">
                <img src="<?php echo e(asset('client/picture/bedroom.jpg')); ?>" alt="" />
                <div class="title-bed-room">Bed room</div>
                <div class="Shop-col">Shop Collection</div>
            </div>
        </a>
        <a href="">
            <div class="ketchen-room">
                <img src="<?php echo e(asset('client/picture/ketchen-room.jpg')); ?>" alt="" />
                <div class="title-kitchen-room">kitchen room</div>
                <div class="Shop-col">Shop Collection</div>
            </div>
        </a>
    </div>
    <div class="setion-shop">
        <div class="box-title">
            <div class="title-shop">Shop by categories</div>
        </div>
        <div class="all-box-product">
            <div class="box-product">
                <a href="">
                    <img src="<?php echo e(asset('client/picture/categories-9.jpg')); ?>" alt="" />
                    <div class="title-product">Armchairs</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#1">
                    <img src="<?php echo e(asset('client/picture/categories-7.jpg')); ?>" alt="" />
                    <div class="title-product">Dining Chairs</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#2">
                    <img src="<?php echo e(asset('client/picture/categories-6.jpg')); ?>" alt="" />
                    <div class="title-product">Lighting</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#3">
                    <img src="<?php echo e(asset('client/picture/categories-11.jpg')); ?>" alt="" />
                    <div class="title-product">Sofas</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#4">
                    <img src="<?php echo e(asset('client/picture/categories-10.jpg')); ?>" alt="" />
                    <div class="title-product">Storage</div>
                </a>
            </div>
        </div>
    </div>
    <div class="box-product-sell">
        <div class="box-product-sell-2">
            <div class="in-title">
                <div class="word">Deals of the days</div>
                <div class="see-deals">
                    <a href="">
                        View all deals
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="all-new-product">
                <div class="new-product">
                    <div class="all-product">
                        <a href="" style="text-decoration: none">
                            <div class="new-img-product">
                                <img id="Pic-1" src="<?php echo e(asset('client/picture/products-7-600x600.jpg')); ?>"
                                    alt="" />
                                <div class="note-notif">
                                    <div class="box-sell">-33%</div>
                                    <div class="title-hot">Hot</div>
                                </div>
                                <div class="all-box-icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="contents-new-product">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="view-product">(4 review)</div>
                            </div>
                        </a>
                        <div class="box-name-product">
                            <div class="name-product">
                                VB1 Little Petra Lounge Chair & ATD1 Pouf
                            </div>
                            <div id="Prict-prod" class="price-product">
                                <del>$ 150.00</del>
                                <span>$ 100.00</span>
                            </div>
                            <div class="buttom-1">
                                <button type="submit">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>add to cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new-product">
                    <div class="all-product">
                        <a href="" style="text-decoration: none">
                            <div class="new-img-product">
                                <img id="Pic-2" src="<?php echo e(asset('client/picture/img-15-9-600x600.jpg')); ?>"
                                    alt="" />
                                <div class="note-notif">
                                    <!-- <div class="box-sell">
                                                    -33%
                                                </div> -->
                                    <div class="title-hot">Hot</div>
                                </div>
                                <div class="all-box-icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="contents-new-product">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="view-product">(4 review)</div>
                            </div>
                        </a>
                        <div class="box-name-product">
                            <div class="name-product">Zunkel Schawarz</div>
                            <div id="Prict-prod" class="price-product">
                                <!-- <del>$ 150.00</del> -->
                                <span>$ 100.00</span>
                            </div>
                            <div class="buttom-1">
                                <button type="submit">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>add to cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new-product">
                    <div class="all-product">
                        <a href="" style="text-decoration: none">
                            <div class="new-img-product">
                                <img id="Pic-3" src="<?php echo e(asset('client/picture/products-1-600x600.jpg')); ?>"
                                    alt="" />
                                <div class="note-notif">
                                    <div class="box-sell">-33%</div>
                                    <div class="title-hot">Hot</div>
                                </div>
                                <div class="all-box-icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="contents-new-product">
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="view-product">(4 review)</div>
                            </div>
                        </a>
                        <div class="box-name-product">
                            <div class="name-product">
                                Drop Dining Chair
                            </div>
                            <div id="Prict-prod" class="price-product">
                                <del>$ 200.00</del>
                                <span>$ 180.00</span>
                            </div>
                            <div class="buttom-1">
                                <button type="submit">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>add to cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-bg">
        <div class="box-img">
            <img class="pic-animation" src="<?php echo e(asset('client/picture/text-animation.png')); ?>" alt="" />
            <img class="pic-chair" src="<?php echo e(asset('client/picture/img-1.png')); ?>" alt="" />
        </div>
        <div class="box-content">
            <div class="title-content">Funori furniture</div>
            <div class="box-first-content">
                <div class="first-content">
                    <!-- SVG giữ nguyên -->
                    <!-- ... -->
                </div>
                <div class="word-content">
                    <h3>BEST SEVICES</h3>
                    <p>
                        Nullam quis ante. Pellentesque libero tortor,
                        tincidunt et, tinciduntamet est
                        <br />
                        platea dictumst. Praesent nec nisl a purus blandit
                        viverra
                    </p>
                </div>
            </div>
            <div class="box-first-content">
                <div class="first-content">
                    <!-- SVG giữ nguyên -->
                    <!-- ... -->
                </div>
                <div class="word-content">
                    <h3>Free shipping worldwide</h3>
                    <p>
                        Nullam quis ante. Pellentesque libero tortor,
                        tincidunt et, tinciduntamet est
                        <br />
                        platea dictumst. Praesent nec nisl a purus blandit
                        viverra
                    </p>
                </div>
            </div>
            <div class="box-button">
                <button>Discovery</button>
            </div>
        </div>
    </div>
    <div class="all-box-banner">
        <div class="box-first-banner">
            <div class="box-img-banner">
                <a href="">
                    <img src="<?php echo e(asset('client/Picture/banner-6-1.jpg')); ?>" alt="" />
                </a>
            </div>
            <div class="title-in-banner">
                <h3>Revive your retreat</h3>
                <a href=""> Shop Collection </a>
            </div>
        </div>
        <div class="box-first-banner">
            <div class="box-img-banner">
                <a href="">
                    <img src="<?php echo e(asset('client/Picture/banner-7-1.jpg')); ?>" alt="" />
                </a>
            </div>
            <div class="title-in-banner">
                <h3>From loveseats to sectionals.</h3>
                <a href=""> Shop Collection </a>
            </div>
        </div>
    </div>
    <div class="box-brand">
        <div class="in-brand">
            <a href="">
                <img src="<?php echo e(asset('client/picture/brand-1-1.jpg')); ?>" alt="" />
            </a>
            <a href="">
                <img src="<?php echo e(asset('client/picture/brand-2-1.jpg')); ?>" alt="" />
            </a>
            <a href="">
                <img src="<?php echo e(asset('client/picture/brand-3-1.jpg')); ?>" alt="" />
            </a>
            <a href="">
                <img src="<?php echo e(asset('client/picture/brand-4-1.jpg')); ?>" alt="" />
            </a>
            <a href="">
                <img src="<?php echo e(asset('client/picture/brand-5-1.jpg')); ?>" alt="" />
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/client/home.blade.php ENDPATH**/ ?>