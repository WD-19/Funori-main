<?php $__env->startSection('content'); ?>
    <div class="banner">
    <script>
        var img = [
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo e(asset('storage/' . $banner->image_url)); ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];
    </script>
    <img id="pic" src="<?php echo e(count($banners) ? asset('storage/' . $banners[0]->image_url) : ''); ?>" alt="" />

    <div class="in-content">
        <div class="tran-box">
            <div class="title">Thiết kế cho cuộc sống</div>
            <div class="text-title">
                Chào đón những sản phẩm mới nhất của chúng tôi.
            </div>
            <div class="all-button">
                <button>Xem sản phẩm</button>
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
        <ul id="banner-dots">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><button onclick="indexNumber(<?php echo e($index); ?>)"></button></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

    <div class="box-room">
        <a href="">
            <div class="living-room">
                <img src="<?php echo e(asset('client/picture/Living-room.jpg')); ?>" alt="" />
                <div class="title-Living-room">Phòng khách</div>
                <div class="Shop-col">Xem bộ sưu tập</div>
            </div>
        </a>
        <a href="">
            <div class="bed-room">
                <img src="<?php echo e(asset('client/picture/bedroom.jpg')); ?>" alt="" />
                <div class="title-bed-room">Phòng ngủ</div>
                <div class="Shop-col">Xem bộ sưu tập</div>
            </div>
        </a>
        <a href="">
            <div class="ketchen-room">
                <img src="<?php echo e(asset('client/picture/ketchen-room.jpg')); ?>" alt="" />
                <div class="title-kitchen-room">Phòng bếp</div>
                <div class="Shop-col">Xem bộ sưu tập</div>
            </div>
        </a>
    </div>
    <div class="setion-shop">
        <div class="box-title">
            <div class="title-shop">Chọn nội thất theo nhu cầu</div>
        </div>
        <div class="all-box-product">
            <div class="box-product">
                <a href="">
                    <img src="<?php echo e(asset('client/picture/categories-9.jpg')); ?>" alt="" />
                    <div class="title-product">Ghế bành</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#1">
                    <img src="<?php echo e(asset('client/picture/categories-7.jpg')); ?>" alt="" />
                    <div class="title-product">Ghế ăn</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#2">
                    <img src="<?php echo e(asset('client/picture/categories-6.jpg')); ?>" alt="" />
                    <div class="title-product">Sofa</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#3">
                    <img src="<?php echo e(asset('client/picture/categories-11.jpg')); ?>" alt="" />
                    <div class="title-product">Đèn chiếu sáng</div>
                </a>
            </div>
            <div class="box-product">
                <a href="#4">
                    <img src="<?php echo e(asset('client/picture/categories-10.jpg')); ?>" alt="" />
                    <div class="title-product">Tủ kệ</div>
                </a>
            </div>
        </div>
    </div>
    <div class="box-product-sell">
        <div class="box-product-sell-2">
            <div class="in-title">
                <div class="word">Ưu đãi trong ngày</div>
                <div class="see-deals">
                    <a href="">
                        Xem tất cả ưu đãi
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="all-new-product">
               <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="new-product">
        <div class="all-product">
            <a href="" style="text-decoration: none">
                <div class="new-img-product">
                  <img src="<?php echo e(asset ($product->thumbnail->image_url ?? 'default.jpg')); ?>"
               alt="<?php echo e($product->thumbnail->alt_text ?? $product->name); ?>">
                    <div class="note-notif">
                        <?php if($product->is_featured): ?>
                            <div class="title-hot">Hot</div>
                        <?php endif; ?>
                    </div>
                    <div class="all-box-icon">
                        <i class="fa-regular fa-heart"></i>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="contents-new-product">
                    <div class="star">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="view-product">
                        (<?php echo e($product->reviews->count()); ?> đánh giá)
                    </div>
                </div>
            </a>
            <div class="box-name-product">
                <div class="name-product"><?php echo e($product->name); ?></div>
                <div id="Prict-prod" class="price-product">
                    <span><?php echo e(number_format($product->regular_price, decimals: 2)); ?> đ</span>
                </div>
                <div class="buttom-1">
                    <button type="submit">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span>Thêm vào giỏ</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
                
            </div>
        </div>
    </div>
    <div class="box-bg">
        <div class="box-img">
            <img class="pic-animation" src="<?php echo e(asset('client/picture/text-animation.png')); ?>" alt="" />
            <img class="pic-chair" src="<?php echo e(asset('client/picture/img-1.png')); ?>" alt="" />
        </div>
        <div class="box-content" style="background: #f5f5f5; padding: 32px 0; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
            <div class="title-content" style="color: #222; font-size: 2rem; font-weight: bold;">Funori furniture</div>
            <div class="box-first-content">
                <div class="first-content">
                    <!-- SVG giữ nguyên -->
                    <!-- ... -->
                </div>
               <div class="word-content">
          <h3 style="color: #ff9b42; font-weight: bold;">DỊCH VỤ TỐT NHẤT</h3>
        <p style="color: #333;">
        Chúng tôi luôn đặt khách hàng lên hàng đầu. Dịch vụ chuyên nghiệp,<br />
        tận tâm và sẵn sàng phục vụ bạn mọi lúc. Trải nghiệm chất lượng tuyệt vời tại đây.
         </p>
        </div>

            </div>
            <div class="box-first-content">
                <div class="first-content">
                    <!-- SVG giữ nguyên -->
                    <!-- ... -->
                </div>
              <div class="word-content">
          <h3 style="color: #ff9b42; font-weight: bold;">Thiết kế nội thất hiện đại</h3>
         <p style="color: #333;">
        Chúng tôi cung cấp các mẫu nội thất với thiết kế tinh tế, phù hợp với mọi không gian sống.<br />
        Chất lượng cao, kiểu dáng hiện đại, mang lại sự tiện nghi và thẩm mỹ cho ngôi nhà của bạn.
        </p>
           </div>

            </div>
            <div class="box-button">
                <button style="background: #ff9b42; color: #fff; border: none; padding: 10px 32px; border-radius: 6px; font-weight: bold;">Khám phá</button>
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
         <h3>Biến ngôi nhà thành tổ ấm hoàn hảo</h3>
         <a href="">Xem Bộ Sưu Tập</a>
          </div>

        </div>
        <div class="box-first-banner">
            <div class="box-img-banner">
                <a href="">
                    <img src="<?php echo e(asset('client/Picture/banner-7-1.jpg')); ?>" alt="" />
                </a>
            </div>
            <div class="title-in-banner">
          <h3>Từ sofa nhỏ đến bộ ghế cao cấp</h3>
          <a href="">Xem Bộ Sưu Tập</a>
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