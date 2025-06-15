<?php $__env->startSection('title', 'Quản lý Banner'); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap-20 mb-30">
            <div>
                <h3 class="text-lg font-semibold">Danh sách Banner</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10 mt-2">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>"><div class="text-tiny">Bảng điều khiển</div></a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Banner</div>
                    </li>
                </ul>
            </div>
            <a href="<?php echo e(route('admin.banners.create')); ?>" class="tf-button">+ Thêm banner mới</a>
        </div>

        <form method="get" class="flex flex-wrap gap-4 mb-4">
            <select name="position" class="form-select" style="min-width:140px;">
                <option value="">-- Vị trí --</option>
                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pos); ?>" <?php if(request('position')==$pos): ?> selected <?php endif; ?>><?php echo e($pos); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="is_active" class="form-select" style="min-width:120px;">
                <option value="">-- Trạng thái --</option>
                <option value="1" <?php if(request('is_active')==='1'): ?> selected <?php endif; ?>>Hiện</option>
                <option value="0" <?php if(request('is_active')==='0'): ?> selected <?php endif; ?>>Ẩn</option>
            </select>
            <button class="tf-button" type="submit">Lọc</button>
        </form>
        <div class="wg-box">
            <div class="wg-table table-all-category mt-2">
                <ul class="table-title flex gap10 mb-14" style="background:#f3f4f6;">
                    <li style="min-width:100px"><div class="body-title">Ảnh</div></li>
                    <li style="min-width:160px"><div class="body-title">Tiêu đề</div></li>
                    <li style="min-width:100px"><div class="body-title">Vị trí</div></li>
                    <li style="min-width:70px"><div class="body-title">Thứ tự</div></li>
                    <li style="min-width:180px"><div class="body-title">Thời gian sử dụng</div></li>
                    <li style="min-width:90px"><div class="body-title">Trạng thái</div></li>
                    <li style="min-width:140px"><div class="body-title">Hành động</div></li>
                </ul>
                <ul class="flex flex-column">
                    <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="wg-product item-row gap10" style="align-items:center; border-bottom:1px solid #eee; padding:12px 0;">
                        <div style="min-width:100px">
                            <div class="image" style="width:60px;height:32px;border-radius:4px;overflow:hidden;background:#f3f4f6;">
                                <img src="<?php echo e(asset('storage/' . $banner->image_url)); ?>" alt="" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        </div>
                        <div class="body-text" style="min-width:160px"><?php echo e($banner->title); ?></div>
                       
                        <div style="min-width:100px"><span class="badge bg-info"><?php echo e($banner->position); ?></span></div>
                        <div style="min-width:70px"><span class="badge bg-light text-dark"><?php echo e($banner->order); ?></span></div>
                        <div style="min-width:180px">
                            <div class="text-tiny">
                                <?php echo e($banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('d/m/Y H:i') : '-'); ?>

                                <br>
                                <?php echo e($banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('d/m/Y H:i') : '-'); ?>

                            </div>
                        </div>
                        <div style="min-width:90px">
                            <form method="post" action="<?php echo e(route('admin.banners.toggle', $banner->id)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()" <?php echo e($banner->is_active ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </form>
                        </div>
                        <div class="list-icon-function" style="min-width:140px">
                            <a href="<?php echo e(route('admin.banners.show', $banner->id)); ?>" class="item eye" title="Xem chi tiết"><i class="icon-eye"></i></a>
                            <a href="<?php echo e(route('admin.banners.edit', $banner->id)); ?>" class="item edit" title="Sửa"><i class="icon-edit-3"></i></a>
                            <form method="post" action="<?php echo e(route('admin.banners.destroy', $banner->id)); ?>" onsubmit="return confirm('Xác nhận xóa?')" style="display:inline;">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="item trash" type="submit" title="Xóa" style="background:none;border:none;padding:0;"><i class="icon-trash-2"></i></button>
                            </form>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li>
                        <div class="body-text text-center py-4">Chưa có banner nào.</div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 38px;
  height: 22px;
  vertical-align: middle;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .3s;
  border-radius: 22px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 16px; width: 16px;
  left: 3px; bottom: 3px;
  background-color: white;
  transition: .3s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #10b981;
}
input:checked + .slider:before {
  transform: translateX(16px);
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/banners/index.blade.php ENDPATH**/ ?>