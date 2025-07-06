<?php $__env->startSection('content'); ?>
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-30">
            <h3>Thêm trang mới</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.pages.index')); ?>">
                        <div class="text-tiny">Trang</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thêm trang mới</div>
                </li>
            </ul>
        </div>
        <!-- new-page -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="<?php echo e(route('admin.pages.store')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <!-- Tiêu đề -->
                <fieldset class="name">
                    <div class="body-title">Tiêu đề trang <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                        placeholder="Tiêu đề trang" name="title" id="title" value="<?php echo e(old('title')); ?>">
                    <?php $__errorArgs = ['title'];
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
                <input type="hidden" name="slug" id="slug" value="<?php echo e(old('slug')); ?>">
                <!-- Nội dung -->
                <fieldset>
                    <div class="body-title">Nội dung <span class="tf-color-1">*</span></div>
                    <div class="ck-editor-container">
                        <textarea class="flex-grow <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="content" id="content" rows="6"
                            placeholder="Nội dung trang"><?php echo e(old('content')); ?></textarea>
                        <?php $__errorArgs = ['content'];
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
                    <div class="body-title">Tác giả <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="author_id" id="author_id" class="<?php $__errorArgs = ['author_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">-- Chọn tác giả --</option>
                            <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($author->id); ?>" <?php echo e(old('author_id') == $author->id ? 'selected' : ''); ?>>
                                    <?php echo e($author->full_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['author_id'];
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
                    <div class="body-title">Loại trang <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="page_type" id="page_type" class="<?php $__errorArgs = ['page_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="blog_post" <?php echo e(old('page_type', 'blog_post') == 'blog_post' ? 'selected' : ''); ?>>
                                Blog Post</option>
                            <option value="page" <?php echo e(old('page_type') == 'page' ? 'selected' : ''); ?>>Page</option>
                        </select>
                        <?php $__errorArgs = ['page_type'];
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
                    <div class="body-title">Trạng thái <span class="tf-color-1">*</span></div>
                    <div class="select flex-grow">
                        <select name="status" id="status" class="<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="draft" <?php echo e(old('status') == 'draft' ? 'selected' : ''); ?>>Nháp</option>
                            <option value="published" <?php echo e(old('status') == 'published' ? 'selected' : ''); ?>>Đã xuất bản
                            </option>
                        </select>
                        <?php $__errorArgs = ['status'];
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
                <!-- Ảnh đại diện -->
                <fieldset>
                    <div class="body-title">Ảnh đại diện <span class="tf-color-1">*</span></div>
                    <div class="upload-image flex-grow d-block">
                        <div class="item up-load">
                            <label class="uploadfile h250" for="featured_image_url">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Kéo thả ảnh vào đây hoặc <span class="tf-color">nhấn để
                                        chọn</span></span>
                                <img id="featured_image_url-preview" src="" alt=""
                                    style="display: none; max-width:120px; margin-top:10px; border-radius:8px; object-fit:cover;">
                                <input type="file" id="featured_image_url" name="featured_image_url"
                                    class="<?php $__errorArgs = ['featured_image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                            </label>
                        </div>
                        <?php $__errorArgs = ['featured_image_url'];
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
                    <div class="body-title">Meta title <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                        placeholder="Meta title" name="meta_title" id="meta_title" value="<?php echo e(old('meta_title')); ?>">
                    <?php $__errorArgs = ['meta_title'];
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
                <fieldset>
                    <div class="body-title">Meta description <span class="tf-color-1">*</span></div>
                    <textarea class="flex-grow <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="meta_description"
                        id="meta_description" rows="2" placeholder="Meta description"><?php echo e(old('meta_description')); ?></textarea>
                    <?php $__errorArgs = ['meta_description'];
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
                <fieldset>
                    <div class="body-title">Ngày xuất bản <span class="tf-color-1">*</span></div>
                    <input class="flex-grow form-control <?php $__errorArgs = ['published_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        type="datetime-local" name="published_at" id="published_at" value="<?php echo e(old('published_at')); ?>">
                    <?php $__errorArgs = ['published_at'];
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
                <div class="row mt-5">
                    <div class="col-md-6">
                        <button type="submit" class="tf-button w-100 py-3 fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Thêm mới
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo e(route('admin.pages.index')); ?>" class="tf-button style-3 w-100 py-3 fs-5">
                            <i class="bi bi-list me-1"></i> Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- /new-page -->
    </div>
    <script>
        // Tạo slug tự động khi nhập tiêu đề
        document.getElementById('title').addEventListener('input', function() {
            let title = this.value;
            let slug = title.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-');
            document.getElementById('slug').value = slug;
        });

        // Hiển thị ảnh xem trước khi tải lên
        document.getElementById('featured_image_url').addEventListener('change', function(event) {
            const [file] = event.target.files;
            const preview = document.getElementById('featured_image_url-preview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.tiny.cloud/1/hs04m6101y0gorgukhuffqutjnhs52o68gb16y52y7nvuj6u/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                plugins: 'image media link table lists advlist',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | image media link | table bullist numlist | styleselect | formatselect | fontselect | fontsizeselect',
                height: 400,
                menubar: false,
                images_upload_url: '<?php echo e(route('admin.pages.upload-image')); ?>',
                images_upload_credentials: true,
                images_upload_handler: async (blobInfo, progress) => {
                    let formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('_token', '<?php echo e(csrf_token()); ?>');

                    const response = await fetch('<?php echo e(route('admin.pages.upload-image')); ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const json = await response.json();
                    if (!json.location) {
                        throw new Error('Tải ảnh thất bại: ' + (json.error || 'Lỗi không xác định'));
                    }
                    return json.location;
                },
                readonly: false,
                image_caption: true,
                image_advtab: true,
                content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; } img { max-width: 100%; height: auto; }'
            });
        </script>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('head'); ?>
        <style>
            .tox-tinymce {
                min-height: 300px;
                max-height: 600px;
                overflow-y: auto;
                width: 100%;
                box-sizing: border-box;
                word-break: break-word;
                overflow-wrap: break-word;
                max-width: 100%;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .wg-box {
                width: 100%;
                overflow-x: hidden;
            }
            .form-new-product {
                max-width: 100%;
            }
            .ck-editor-container {
                width: 100%;
                max-width: 100%;
                margin-bottom: 15px;
            }
        </style>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/pages/create.blade.php ENDPATH**/ ?>