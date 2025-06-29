<div class="headermain">
    <div class="contentmain">
        
        <nav class="box-menu">
            <ul class="all-list-menu">
                <li>
                    <a href="<?php echo e(route('client.home')); ?>" class="hover-a">Trang chủ</a>
                </li>
                <li class="padding-list-menu">
                    <a href="<?php echo e(route('client.shop')); ?>" class="hover-a">Cửa hàng</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                <li class="padding-list-menu">
                    <a href="<?php echo e(route('client.about')); ?>" class="hover-a">Về chúng tôi</a>
                    <!-- <a href="">
                            <i class="fa-solid fa-angle-down angle-down"></i>
                        </a> -->
                </li>
                
                <li class="padding-list-menu">
                    <a href="<?php echo e(route('client.page')); ?>" class="hover-a">Tin tức</a>
                </li>
            </ul>
        </nav>
        <div class="box-logo">
            <div class="logo">
                <a href="<?php echo e(route('client.home')); ?>">
                    <img src="<?php echo e(asset('client/picture/logo.png')); ?>" alt="Logo" />
                </a>
            </div>
        </div>
        <div class="box-icon">
            <a href="" class="box-search">
                <i class="fa-solid fa-magnifying-glass search"></i>
            </a>
            <a href="<?php echo e(route('client.login.index')); ?>" class="box-user">
                <i class="fa-regular fa-user user"></i>
            </a>
            <a href="" class="box-heart">
                <i class="fa-regular fa-heart heart"></i>
            </a>
            <a href="" class="box-cart">
                <i class="fa-solid fa-cart-shopping cart"></i>
            </a>
        </div>
    </div>
</div>
<?php /**PATH D:\laragon\www\Funori-main\resources\views/client/partials/header.blade.php ENDPATH**/ ?>