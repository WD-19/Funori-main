<?php $__env->startSection('title', 'Tin Tức'); ?>

<?php $__env->startSection('content'); ?>
    <div class="custom-banner-full">
        <div class="custom-banner">
            <div class="banner-image">
                <img src="<?php echo e(asset('client/picture/Living-room.jpg')); ?>" alt="Tin tức">
                <div class="banner-overlay">
                    <h1 class="banner-title">Tin Tức</h1>
                    <div class="banner-breadcrumb">Trang chủ &nbsp; > &nbsp; Tin tức</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        
        <div class="box-content-blog">
            <style>
                /* CSS banner */
                .custom-banner {
                    width: 100%;
                    position: relative;
                    overflow: hidden;
                    border-radius: 12px;
                    margin-bottom: 40px;
                }

                .banner-image {
                    position: relative;
                    width: 100%;
                    height: 360px;
                    overflow: hidden;
                }

                .banner-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s ease;
                }

                .banner-image:hover img {
                    transform: scale(1.05);
                }

                .banner-overlay {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    text-align: center;
                    color: #fff;
                    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
                }

                .banner-title {
                    font-size: 3rem;
                    font-weight: 800;
                    margin-bottom: 12px;
                    text-transform: uppercase;
                }

                .banner-breadcrumb {
                    font-size: 1rem;
                    font-weight: 400;
                }

                /* CSS nôi dung */
                .blog-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 32px;
                }

                .blog-card {
                    background: #fff;
                    border-radius: 14px;
                    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    transition: box-shadow 0.2s;
                    height: 100%;
                }

                .blog-card:hover {
                    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
                }

                .blog-card-img-wrap {
                    width: 100%;
                    aspect-ratio: 4/3;
                    background: #eee;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .blog-card-img-wrap img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                .blog-card-body {
                    padding: 18px 18px 14px 18px;
                    display: flex;
                    flex-direction: column;
                    flex: 1;
                }

                .blog-card-title {
                    font-size: 1.15rem;
                    font-weight: 700;
                    margin-bottom: 10px;
                    color: #222;
                    min-height: 48px;
                    line-height: 1.3;
                }

                .blog-card-meta {
                    color: #888;
                    font-size: 0.97rem;
                    margin-top: auto;
                }

                @media (max-width: 1200px) {
                    .blog-grid {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }

                @media (max-width: 900px) {
                    .blog-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
            <div class="blog-grid">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="blog-card">
                        <a href="<?php echo e(route('client.page.show', $post->slug)); ?>" style="display:block; position:relative;">
                            <div class="blog-card-img-wrap" style="position:relative;">
                                <?php if($post->published_at): ?>
                                    <div class="blog-card-date">
                                        <?php echo e($post->published_at->format('d')); ?>

                                        <span><?php echo e($post->published_at->format('m/Y')); ?></span>
                                    </div>
                                <?php endif; ?>
                                <img src="<?php echo e($post->featured_image_url ? asset('storage/' . $post->featured_image_url) : asset('client/Picture/Blog/default.jpg')); ?>"
                                    alt="<?php echo e($post->meta_title); ?>">
                            </div>
                        </a>
                        <div class="blog-card-body" style="align-items: center; text-align: center;">
                            <div class="blog-card-title" style="margin-bottom: 12px;">
                                <a href="<?php echo e(route('client.page.show', $post->slug)); ?>"
                                    style="color:inherit; text-decoration:none; display: inline-block;">
                                    <?php echo e($post->meta_title); ?>

                                </a>
                            </div>
                            <div class="blog-card-desc"
                                style="
                    color: #555;
                    font-size: 1rem;
                    margin-bottom: 14px;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    min-height: 2.6em;
                    max-width: 95%;
                ">
                                <?php echo e($post->meta_description); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Không có bài viết nào.</p>
                <?php endif; ?>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($posts->links('pagination::bootstrap-4')); ?>

            </div>

            <style>
                .blog-card-img-wrap {
                    width: 100%;
                    aspect-ratio: 4/3;
                    background: #eee;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 16px 16px 0 0;
                    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                    position: relative;
                    transition: box-shadow 0.2s;
                }

                .blog-card-img-wrap img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    border-radius: 16px 16px 0 0;
                    transition: transform 0.3s;
                }

                .blog-card:hover .blog-card-img-wrap img {
                    transform: scale(1.04);
                    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.13);
                }

                .blog-card-date {
                    position: absolute;
                    top: 14px;
                    left: 14px;
                    background: rgba(255, 255, 255, 0.92);
                    color: #222;
                    font-weight: 700;
                    font-size: 1.1rem;
                    padding: 7px 13px 4px 13px;
                    border-radius: 12px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
                    text-align: center;
                    z-index: 2;
                    line-height: 1.1;
                    min-width: 48px;
                }

                .blog-card-date span {
                    display: block;
                    font-size: 0.85em;
                    font-weight: 400;
                    color: #888;
                    margin-top: 1px;
                }
            </style>

        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/client/page/page.blade.php ENDPATH**/ ?>