<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>404 HTML Template by Colorlib</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

    <!-- Font Awesome Icon -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('errors/css/font-awesome.min.css')); ?>" />

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('errors/css/style.css')); ?>" />
</head>

<body>

    <div id="notfound">
        <div class="notfound-bg"></div>
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>chúng tôi xin lỗi, nhưng trang bạn yêu cầu không được tìm thấy</h2>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="home-btn">Trang Chủ</a>
            
            <div class="notfound-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
        </div>
    </div>

</body>

</html>
<?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/errors/404.blade.php ENDPATH**/ ?>