<?php $__env->startSection('title', $post->title); ?>

<?php $__env->startSection('content'); ?>
<style>
    .inspiration-article-bg {
        background: #f5f6fa;
        min-height: 100vh;
        padding: 40px 0;
    }
    .inspiration-article-container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 40px 32px 48px 32px;
    }
    .inspiration-article-title {
        font-size: 2.4rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 18px;
        color: #222;
        line-height: 1.2;
    }
    .inspiration-article-meta {
        text-align: center;
        color: #888;
        font-size: 1rem;
        margin-bottom: 32px;
    }
    .inspiration-article-image {
        text-align: center;
        margin-bottom: 32px;
    }
    .inspiration-article-image img {
        max-width: 100%;
        max-height: 420px;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        object-fit: cover;
        background: #eee;
    }
    .inspiration-article-content {
        font-size: 1.15rem;
        color: #333;
        line-height: 1.8;
        text-align: justify;
        margin-bottom: 0;
    }
    @media (max-width: 600px) {
        .inspiration-article-container {
            padding: 18px 6px 28px 6px;
        }
        .inspiration-article-title {
            font-size: 1.4rem;
        }
    }
</style>
<div class="inspiration-article-bg">
    <div class="inspiration-article-container">
        <h1 class="inspiration-article-title"><?php echo e($post->title); ?></h1>
        <div class="inspiration-article-meta">
            Tác giả: <?php echo e($post->author->name ?? 'N/A'); ?> | 
            Ngày đăng: <?php echo e($post->published_at ? $post->published_at->format('d/m/Y') : ''); ?>

        </div>
        <?php if($post->featured_image_url): ?>
        <div class="inspiration-article-image">
            <img src="<?php echo e(asset('storage/' . $post->featured_image_url)); ?>" alt="<?php echo e($post->title); ?>">
        </div>
        <?php endif; ?>
        <div class="inspiration-article-content">
            <?php echo $post->content; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/client/page/show.blade.php ENDPATH**/ ?>