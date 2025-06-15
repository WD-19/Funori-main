
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></title>
    <!-- CSS & meta -->
    <link rel="stylesheet" href="<?php echo e(asset('css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/animation.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('font/fonts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('icon/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(asset('images/favicon.png')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="<?php echo e(asset('css/user.css')); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body>
    <div id="wrapper">
        <div id="page">
            <div class="layout-wrap">

                <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="section-content-right">
                    <?php echo $__env->make('admin.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <?php if(session('success')): ?>
                                    <?php if (isset($component)) { $__componentOriginalb5e767ad160784309dfcad41e788743b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e767ad160784309dfcad41e788743b = $attributes; } ?>
<?php $component = App\View\Components\Alert::resolve(['type' => 'success'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Alert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php echo e(session('success')); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $attributes = $__attributesOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__attributesOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $component = $__componentOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__componentOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
                                <?php endif; ?>

                                <?php if(session('error')): ?>
                                    <?php if (isset($component)) { $__componentOriginalb5e767ad160784309dfcad41e788743b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e767ad160784309dfcad41e788743b = $attributes; } ?>
<?php $component = App\View\Components\Alert::resolve(['type' => 'danger'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Alert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php echo e(session('error')); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $attributes = $__attributesOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__attributesOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $component = $__componentOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__componentOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
                                <?php endif; ?>
                                <?php echo $__env->yieldContent('content'); ?>

                                <?php echo $__env->make('admin.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/zoom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/raphael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/morris.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jvectormap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jvectormap-us-lcc.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jvectormap-data.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jvectormap.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-2.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-3.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-4.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-5.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-6.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apexcharts/line-chart-7.js')); ?>"></script>
    <script src="<?php echo e(asset('js/switcher.js')); ?>"></script>
    <script defer src="<?php echo e(asset('js/theme-settings.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/layout/admin.blade.php ENDPATH**/ ?>