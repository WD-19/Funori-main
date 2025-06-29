<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('client/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/blog.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/about.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/shop.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/main-mobile.css')); ?>">


    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>

<body>
    <!-- Phần header -->
    <?php echo $__env->make('client.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Phần nội dung chính -->
    <?php echo $__env->yieldContent('content'); ?>

    <!-- Phần footer -->
    <?php echo $__env->make('client.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- <div style="margin-bottom: 600px;"></div> -->
</body>

<script src="https://kit.fontawesome.com/eda05fcf5c.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('client/js/main.js')); ?>"></script>

<script src="<?php echo e(asset('client/ecomus/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/swiper-bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/carousel.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/lazysize.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/count-down.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/multiple-modal.js')); ?>"></script>
<script src="<?php echo e(asset('client/ecomus/js/main.js')); ?>"></script>

</html>
<?php /**PATH D:\laragon\www\Funori-main\resources\views/client/layout/client.blade.php ENDPATH**/ ?>