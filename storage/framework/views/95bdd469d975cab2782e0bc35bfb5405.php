<?php $__env->startSection('title', 'Cập nhật banner'); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        
    <?php endif; ?>
    <div class="main-content-wrap">
        <h3 class="mb-4">Cập nhật banner</h3>
        <form action="<?php echo e(route('admin.banners.update', $banner->id)); ?>" method="POST" enctype="multipart/form-data" class="wg-box" style="max-width:600px;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Tiêu đề</label>
                <input type="text" name="title" class="input-field" required value="<?php echo e(old('title', $banner->title)); ?>">
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Ảnh banner</label>
                <input type="file" name="image" id="banner-image" class="input-field" accept="image/*">
                <input type="hidden" name="cropped_image" id="cropped-image">
                <div id="cropper-preview" class="mt-2">
                    <?php if($banner->image_url): ?>
                        <img src="<?php echo e(asset('storage/'.$banner->image_url)); ?>" style="max-width:100%;">
                    <?php endif; ?>
                </div>
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Link</label>
                <input type="text" name="link" class="input-field" value="<?php echo e(old('link', $banner->link)); ?>">
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Vị trí</label>
                <select name="position" class="input-field" required>
                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pos); ?>" <?php if($banner->position==$pos): ?> selected <?php endif; ?>><?php echo e($pos); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="main" <?php if($banner->position=='main'): ?> selected <?php endif; ?>>main</option>
                    <option value="sidebar" <?php if($banner->position=='sidebar'): ?> selected <?php endif; ?>>sidebar</option>
                </select>
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Thứ tự</label>
                <input type="number" name="order" class="input-field" value="<?php echo e(old('order', $banner->order)); ?>">
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Thời gian hiển thị</label>
                <div class="flex gap-2">
                    <input type="datetime-local" name="start_at" class="input-field" value="<?php echo e(old('start_at', $banner->start_at ? \Carbon\Carbon::parse($banner->start_at)->format('Y-m-d\TH:i') : '')); ?>">
                    <span>đến</span>
                    <input type="datetime-local" name="end_at" class="input-field" value="<?php echo e(old('end_at', $banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('Y-m-d\TH:i') : '')); ?>">
                </div>
            </fieldset>
            <fieldset class="mb-4">
                <label class="body-title mb-2">Trạng thái</label>
                <label class="switch">
                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $banner->is_active) ? 'checked' : ''); ?>>
                    <span class="slider round"></span>
                </label>
            </fieldset>
            <button class="tf-button" type="submit" id="submit-btn">Cập nhật</button>
            <a href="<?php echo e(route('admin.banners.index')); ?>" class="tf-button style-2 ml-2">Quay lại</a>
        </form>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
<script>
let cropper;
let croppedData = '';
document.getElementById('banner-image')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        let img = document.createElement('img');
        img.src = ev.target.result;
        img.style.maxWidth = '100%';
        document.getElementById('cropper-preview').innerHTML = '';
        document.getElementById('cropper-preview').appendChild(img);
        if (cropper) cropper.destroy();
        cropper = new Cropper(img, {
            aspectRatio: 2/1,
            viewMode: 1,
            autoCropArea: 1,
        });
    };
    reader.readAsDataURL(file);
});

document.getElementById('submit-btn').addEventListener('click', function(e) {
    if (cropper) {
        e.preventDefault();
        cropper.getCroppedCanvas({
            width: 1200,
            height: 600,
            imageSmoothingQuality: 'high'
        }).toBlob(function(blob) {
            let reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById('cropped-image').value = reader.result;
                e.target.form.submit();
            };
            reader.readAsDataURL(blob);
        }, 'image/jpeg', 0.92);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/banners/edit.blade.php ENDPATH**/ ?>