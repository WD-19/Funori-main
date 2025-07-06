<?php $__env->startSection('content'); ?>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Chỉnh sửa danh mục</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <a href="<?php echo e(route('admin.categories.index')); ?>">
                        <div class="text-tiny">Danh mục</div>
                    </a>
                </li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <div class="text-tiny">Chỉnh sửa danh mục</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="<?php echo e(route('admin.categories.update', $category->id)); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <fieldset class="name">
                    <div class="body-title">Tên danh mục <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                        placeholder="Tên danh mục" name="name" id="name" value="<?php echo e(old('name', $category->name)); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback fw-bold fs-5" style="display:block;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </fieldset>

                <input type="hidden" name="slug" id="slug" value="<?php echo e(old('slug', $category->slug)); ?>">

                <fieldset class="category">
                    <div class="body-title">Danh mục</div>
                    <div class="select flex-grow">
                        <select name="parent_id" id="parent_id" class="<?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">-- Danh mục cha --</option>
                            <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($parent->id); ?>" <?php if(session('error') && is_null($category->parent_id) && $category->children()->count() > 0
                                        ? $category->parent_id == $parent->id
                                        : old('parent_id', $category->parent_id) == $parent->id): ?> selected <?php endif; ?>>
                                    <?php echo e($parent->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="body-title">Mô tả</div>
                    <textarea class="flex-grow" name="description" id="description" placeholder="Mô tả danh mục"><?php echo e(old('description', $category->description)); ?></textarea>
                </fieldset>

                <fieldset>
                    <div class="body-title">Ảnh</div>
                    <div class="upload-image flex-grow d-block">
                        <div class="item up-load" style="display: flex; align-items: flex-start; gap: 24px;">
                            <label class="uploadfile h250" for="image_url" style="flex:1;">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Kéo thả ảnh vào đây hoặc <span class="tf-color">nhấn để
                                        chọn</span></span>
                                <img id="image_url-preview" src="#" alt=""
                                    style="display: none; max-width:120px; margin-top:10px;">
                                <input type="file" id="image_url" name="image_url"
                                    class="<?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                            </label>
                        </div>
                        <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </fieldset>

                
                <?php if($category->image_url): ?>
                    <div id="old-image-wrap" style="text-align:center;">
                        <div style="font-size:13px; color:#888;">Ảnh hiện tại</div>
                        <img id="old-image" src="<?php echo e(asset('storage/' . $category->image_url)); ?>" alt="Ảnh danh mục"
                            style="max-width: 120px; margin-top:10px;">
                    </div>
                <?php endif; ?>

                <fieldset class="category">
                    <div class="body-title">Trạng thái <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="is_active" id="is_active" class="<?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1" <?php echo e(old('is_active', $category->is_active) == '1' ? 'selected' : ''); ?>>
                                Kích hoạt</option>
                            <option value="0" <?php echo e(old('is_active', $category->is_active) == '0' ? 'selected' : ''); ?>>
                                Không kích hoạt</option>
                        </select>
                        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback fw-bold fs-5" style="display:block;"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="body-title">Ngày tạo</div>
                    <input type="text" class="form-control" value="<?php echo e($category->created_at); ?>" readonly>
                </fieldset>
                <fieldset>
                    <div class="body-title">Ngày cập nhật</div>
                    <input type="text" class="form-control" value="<?php echo e($category->updated_at); ?>" readonly>
                </fieldset>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <button type="submit" class="tf-button w-100 py-3 fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Cập nhật
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="tf-button style-3 w-100 py-3 fs-5">
                            <i class="bi bi-list me-1"></i> Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Tạo slug tự động khi nhập tên
        document.getElementById('name').addEventListener('input', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-');
            document.getElementById('slug').value = slug;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>