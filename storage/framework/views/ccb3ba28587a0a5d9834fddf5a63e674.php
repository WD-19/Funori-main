<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('client/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/main-mobile.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/Shop.css')); ?>">
    <title>Home</title>
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

</html>
<script src="https://kit.fontawesome.com/eda05fcf5c.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('client/js/main.js')); ?>"></script>
<?php /**PATH D:\laragon\www\Funori-main\resources\views/client/layout/client.blade.php ENDPATH**/ ?>