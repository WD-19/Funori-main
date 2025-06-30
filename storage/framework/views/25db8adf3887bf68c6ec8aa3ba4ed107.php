<?php $__env->startSection('title', 'Tin Tức'); ?>

<?php $__env->startSection('content'); ?>
    <div class="box-banner-about" style="background-position: 50%;">
        <div class="in-banner-about">
            <div class="title-banner">Tin Tức</div>
            <div class="box-path-about">
                <div>Trang chủ</div>
                <div class="icon">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div>Tin Tức</div>
            </div>
        </div>
    </div>
    <div class="container">
        
        <div class="box-content-blog">
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 30px;">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="blog-1" style="flex: 1 1 45%; max-width: 48%; box-sizing: border-box; margin-bottom: 30px;">
                        <a href="<?php echo e(route('client.page.show', $post->slug)); ?>">
                            <img src="<?php echo e($post->featured_image_url ? asset('storage/' . $post->featured_image_url) : asset('client/Picture/Blog/default.jpg')); ?>"
                                alt="<?php echo e($post->title); ?>" style="width:100%;height:350px;object-fit:cover;display:block;">
                        </a>
                        <div class="content-blog-1">
                            <div class="list-link">
                                
                            </div>
                            <div class="title">
                                <a href="<?php echo e(route('client.page.show', $post->slug)); ?>"><?php echo e($post->title); ?></a>
                            </div>
                            <div class="box-by">
                                <span>Bởi: <?php echo e($post->author->name ?? 'N/A'); ?></span>
                                <span>|</span>
                                <span><?php echo e($post->published_at ? $post->published_at->format('d/m/Y') : ''); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Không có bài viết nào.</p>
                <?php endif; ?>
            </div>
        </div>
        
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/client/page/page.blade.php ENDPATH**/ ?>