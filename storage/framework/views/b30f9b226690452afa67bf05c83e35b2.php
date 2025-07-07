<?php $__env->startSection('title', $post->title); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .inspiration-article-bg {
            background: #f5f6fa;
            min-height: 100vh;
            padding: 40px 0;
        }

        .inspiration-article-container {
            width: 75%;
            max-width: 1300px;
            margin: 0 auto;
        }

        .inspiration-article-title {
            font-size: 2.4rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 18px;
            color: #222;
            line-height: 1.2;
        }

        .inspiration-article-image {
            margin-bottom: 32px;
            width: 100%;
            /* Đảm bảo container ảnh khớp với chiều rộng nội dung */
        }

        .inspiration-article-image img {
            width: 100%;
            max-width: 100%;
            height: auto;
            /* Bỏ chiều cao cố định để ảnh tỷ lệ đúng */
            box-shadow: none;
            object-fit: contain;
            /* Giữ ảnh hiển thị đầy đủ, không bị cắt */
            background: #eee;
            display: block;
            margin: 0 auto;
        }

        .inspiration-article-content {
            font-size: 1.15rem;
            color: #333;
            line-height: 1.8;
            text-align: justify;
            margin-bottom: 0;
        }

        @media (max-width: 900px) {
            .inspiration-article-container {
                width: 98%;
            }

            .inspiration-article-title {
                font-size: 1.4rem;
            }

            .inspiration-article-image img {
                width: 100%;
                height: auto;
                /* Đảm bảo ảnh tỷ lệ đúng trên màn hình nhỏ */
            }

            /* ...existing CSS... */

            .other-card,
            .product-card {
                background: #fff;
                padding: 12px 10px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
                border-radius: 0;
            }

            .other-card:hover,
            .product-card:hover {
                box-shadow: 0 6px 24px rgba(0, 0, 0, 0.13);
                background: #f5f7fa;
                transform: translateY(-4px) scale(1.03);
            }

            .other-card img,
            .product-card img {
                transition: transform 0.25s;
            }

            .other-card:hover img,
            .product-card:hover img {
                transform: scale(1.06);
            }
        }
    </style>
    <div class="inspiration-article-bg">
        <div class="inspiration-article-container">
            <?php if($post->featured_image_url): ?>
                <div class="inspiration-article-image">
                    <img src="<?php echo e(asset('storage/' . $post->featured_image_url)); ?>" alt="<?php echo e($post->title); ?>">
                </div>
            <?php endif; ?>
            <h1 class="inspiration-article-title"><?php echo e($post->title); ?></h1>
            <div class="inspiration-article-content">
                <?php echo str_replace('/admin/storage', '/storage', $post->content); ?>

            </div>
        </div>
    </div>

    <?php if($otherPosts->count()): ?>
        <div style="margin:48px auto 0 auto;max-width:1300px;">
            <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:18px;">Các bài viết khác</h2>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;">
                <?php $__currentLoopData = $otherPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="other-card">
                        <a href="<?php echo e(route('client.page.show', $item->slug)); ?>">
                            <img src="<?php echo e($item->featured_image_url ? asset('storage/' . $item->featured_image_url) : asset('client/Picture/Blog/default.jpg')); ?>"
                                alt="<?php echo e($item->meta_title); ?>" style="width:100%;height:120px;object-fit:cover;">
                            <div style="font-weight:600;margin:10px 0 6px 0;"><?php echo e($item->meta_title); ?></div>
                            <div
                                style="font-size:0.97rem;color:#666;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                <?php echo e($item->meta_description); ?>

                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div style="text-align:center;margin-top:18px;">
                <a href="<?php echo e(route('client.page')); ?>" class="btn btn-outline-primary"
                    style="padding:8px 28px;border-radius:8px;">Xem thêm bài viết</a>
            </div>
        </div>
    <?php endif; ?>

    <?php if($suggestedProducts->count()): ?>
        <div style="margin:48px auto 0 auto;max-width:1300px;">
            <h2 style="font-size:1.3rem;font-weight:700;margin-bottom:18px;">Các sản phẩm bạn có thể thích</h2>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;">
                <?php $__currentLoopData = $suggestedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card">
                        <a href="<?php echo e(route('client.product.show', $product->slug)); ?>">
                            <img src="<?php echo e($product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png')); ?>"
                                alt="<?php echo e($product->name); ?>" style="width:100%;height:120px;object-fit:cover;">
                            <div style="font-weight:600;margin:10px 0 6px 0;"><?php echo e($product->name); ?></div>
                            <div style="font-size:0.97rem;color:#666;"><?php echo e(number_format($product->price, 0, ',', '.')); ?> đ
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div style="text-align:center;margin-top:18px;">
                <a href="<?php echo e(route('shop')); ?>" class="btn btn-outline-primary"
                    style="padding:8px 28px;border-radius:8px;">Xem thêm sản phẩm</a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/client/page/show.blade.php ENDPATH**/ ?>