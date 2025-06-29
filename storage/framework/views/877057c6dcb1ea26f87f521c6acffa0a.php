


<?php $__env->startSection('content'); ?>

    <div class="box-banner-shop">
        <div class="in-box-banner">
            <div class="text-title-banner">
                Shop
            </div>
            <div class="box-path">
                <div>
                    Home
                </div>
                <div class="icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div>
                    Shop
                </div>
            </div>
            <div class="box-list-product">
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-19.jpg" alt="">
                        <div class="name-product">
                            <p>Armchairs</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-18.jpg" alt="">
                        <div class="name-product">
                            <p>Outdoor</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-6.jpg" alt="">
                        <div class="name-product">
                            <p>Sofas</p>
                        </div>
                    </a>
                </div>
                <div class="box-shop-product">
                    <a href="">
                        <img src="../Picture/Shop/categories-10.jpg" alt="">
                        <div class="name-product">
                            <p>Storage</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-shop">
        <div class="box-sidebar">
            <div class="first-sidebar" style="margin-bottom: 20px;">
                <div class="title-sidebar">
                    Categories
                </div>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="in-sidebar">
                        <a href="<?php echo e(route('shop', ['category_id' => $category->id])); ?>"
                            style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:inherit;">
                            <div class="name" <?php if(request('category_id') == $category->id): ?> style="font-weight:bold;color:#fcad02;"
                            <?php endif; ?>>
                                <?php echo e($category->name); ?>

                            </div>
                            <div class="box-number"><?php echo e($category->products_count); ?></div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="box-price">
                <div class="price-title">Price</div>
                <input type="range" name="" id="">
                <div class="box-range">
                    Range:
                    <span>$50</span>
                    <span>-</span>
                    <span>$500</span>
                </div>
            </div>

            <div class="all-box-brands">
                <div class="title-brands">Brands</div>
                <div class="box-list-brands">
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-1-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-2-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-3-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="box-img-brands">
                        <a href="">
                            <img src="../Picture/Shop/brand-4-1.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="box-feature-product">
                <div class="text-feature-product">Feature Product</div>
                <div>
                    <div class="box-product-in">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="../Picture/Shop/products-10-7.jpg" alt="">
                            </a>
                        </div>
                        <div class="box-in-content">
                            <div class="box-star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="title-feature-product">
                                Theo Round Dining Table
                            </div>
                            <div class="price-feature-prod">
                                <del>$80.00</del>
                                <span>$50.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-product-in">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="../Picture/Shop/products-4.jpg" alt="">
                            </a>
                        </div>
                        <div class="box-in-content">
                            <div class="box-star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="title-feature-product">
                                Egg Dining Table
                            </div>
                            <div class="price-feature-prod">
                                <del>$150.00</del>
                                <span>$100.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-product-in" style="border: none;">
                        <div class="picture-product-in">
                            <a href="">
                                <img src="../Picture/Shop/products-16-6.jpg" alt="">
                            </a>
                        </div>
                        <div class="box-in-content">
                            <div class="box-star">
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                                <i style="color: rgb(219, 218, 218);" class="fa-solid fa-star"></i>
                            </div>
                            <div class="title-feature-product">
                                T12 Dining Table - Black
                            </div>
                            <div class="price-feature-prod">
                                <del>$500.00</del>
                                <span>$450.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-all-product">
            <div class="header-product">
                <div class="show-item">
                    <div>
                        Hiển thị <?php echo e($products->firstItem()); ?>–<?php echo e($products->lastItem()); ?> trên tổng số
                        <?php echo e($products->total()); ?> sản phẩm
                    </div>
                </div>
                <select name="" id="box-all-list">
                    <option value="">Default Sorting</option>
                    <option value="">Sort By Popularity</option>
                    <option value="">Sort By Average Rating</option>
                    <option value="">Sort By Latest</option>
                    <option value="">Sort By Price: Low To High</option>
                    <option value="">Sort By Price: High To Low</option>
                </select>
            </div>
            <div class="all-box-new-product" style="display: flex; flex-wrap: wrap; gap: 24px;">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="new-product-1">
                        <div class="pic-product-1">
                            <a href="">
                                <img src="<?php echo e($product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png')); ?>"
                                    alt="<?php echo e($product->name); ?>"
                                    onmouseover="this.src='<?php echo e($product->images->get(1) ? asset($product->images->get(1)->image_url) : asset($product->images->first() ? $product->images->first()->image_url : 'images/no-image.png')); ?>'"
                                    onmouseout="this.src='<?php echo e($product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png')); ?>'">
                                <div class="box-icon-new-product">
                                    <i style="font-size: 19px;" id="cart-Product" class="fa-solid fa-cart-shopping"></i>
                                    <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                                    <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </a>
                        </div>
                        <div class="box-star" style="width: 100%; height: 23px;">
                            <?php
                                $avg = round($product->reviews->avg('rating'), 1);
                                $count = $product->reviews->count();
                            ?>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= floor($avg)): ?>
                                    <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star"></i>
                                <?php elseif($i - $avg < 1 && $avg - floor($avg) >= 0.5): ?>
                                    <i style="color: #fcad02; margin-left: 0;" class="fa-solid fa-star-half-stroke"></i>
                                <?php else: ?>
                                    <i style="color: #ccc; margin-left: 0;" class="fa-solid fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <span style="margin-left: 5px; color: rgb(201, 201, 201); font-size: 12px;">
                                (<?php echo e($count); ?> review<?php echo e($count != 1 ? 's' : ''); ?>)
                            </span>
                        </div>
                        <div class="title-new-product">
                            <a href="   "><?php echo e($product->name); ?></a>
                        </div>
                        <div style="font-size: 16px; color: rgb(170, 167, 167);">
                            <?php echo e(number_format($product->regular_price, 0, ',', '.')); ?> đ
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="box-footer-product">
                <div class="title-footer-product">
                    Hiển thị <?php echo e($products->firstItem()); ?>–<?php echo e($products->lastItem()); ?> trên tổng số <?php echo e($products->total()); ?>

                    sản phẩm
                </div>
                <div class="box-percent">
                    <div class="in-percent"></div>
                </div>
                <div class="buttom-load">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/client/shop.blade.php ENDPATH**/ ?>