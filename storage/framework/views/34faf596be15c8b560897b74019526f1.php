<?php $__env->startSection('title', 'Cập nhật sản phẩm'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>Edit Product</h3>
    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
        <li>
            <a href="index.html">
                <div class="text-tiny">Dashboard</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <a href="#">
                <div class="text-tiny">Product</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <div class="text-tiny">Edit Product</div>
        </li>
    </ul>
</div>
<!-- form-edit-product -->
<form class="form-edit-product" method="POST" action="<?php echo e(route('admin.products.update', $product->id)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="wg-box mb-30">
        <fieldset>
            <div class="body-title mb-10">Upload images</div>
            <div class="upload-image mb-16" id="drop-area" style="border:2px dashed #ccc; border-radius:8px;">
                <div class="up-load">
                    <label class="uploadfile" for="myFile" style="width:100%;cursor:pointer;">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <div class="text-tiny">
                            Drop your images here or select <span class="text-secondary">click to browse</span>
                        </div>
                        <input type="file" id="myFile" name="images[]" multiple style="display:none;">
                    </label>
                </div>
                <div class="flex gap20 flex-wrap" id="gallery">
                    <?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <img src="<?php echo e(asset($img->image_url)); ?>" style="max-width:80px; max-height:80px; object-fit:cover; border:1px solid #eee; border-radius:4px;">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="wg-box mb-30">
        <fieldset class="name">
            <div class="body-title mb-10">Product title <span class="tf-color-1">*</span></div>
            <input class="mb-10" type="text" placeholder="Enter title" name="name" value="<?php echo e($product->name); ?>" maxlength="100" required>
        </fieldset>
        <fieldset class="category">
            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
            <select name="category_id" required>
                <option value="">-- Choose category --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if($product->category_id == $category->id): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="brand">
            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
            <select name="brand_id" required>
                <option value="">-- Choose brand --</option>
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($brand->id); ?>" <?php if($product->brand_id == $brand->id): ?> selected <?php endif; ?>><?php echo e($brand->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="price">
            <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
            <input type="number" name="regular_price" min="0" step="0.01" value="<?php echo e($product->regular_price); ?>" required>
        </fieldset>
        <fieldset class="short_description">
            <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
            <textarea name="short_description" maxlength="255" required><?php echo e($product->short_description); ?></textarea>
        </fieldset>
        <fieldset class="description">
            <div class="body-title mb-10">Description</div>
            <textarea name="description"><?php echo e($product->description); ?></textarea>
        </fieldset>

        <!-- VARIANTS -->
        <fieldset class="variants">
            <div class="body-title mb-10">Variants</div>
            <div id="variant-list">
                <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="variant-row flex gap10 mb-2 align-items-center">
                    <input type="hidden" name="variants[<?php echo e($i); ?>][id]" value="<?php echo e($variant->id); ?>">
                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <select style="width: 60%;" name="variants[<?php echo e($i); ?>][attribute_values][<?php echo e($attribute->id); ?>]" required>
                        <option value="">-- <?php echo e($attribute->name); ?> --</option>
                        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>"
                            <?php if($variant->attributeValues->contains('id', $value->id)): ?> selected <?php endif; ?>>
                            <?php echo e($value->value); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <input type="text" name="variants[<?php echo e($i); ?>][size]" value="<?php echo e(old('variants.'.$i.'.size', $variant->size ?? '')); ?>" placeholder="Kích thước (ví dụ: 120x60x75 cm)">
                    <input style="width: 150px;" type="number" name="variants[<?php echo e($i); ?>][price_modifier]" value="<?php echo e($variant->price_modifier); ?>" placeholder="Giá chênh lệch" step="0.01">
                    <input style="width: 100px;" type="number" name="variants[<?php echo e($i); ?>][stock_quantity]" value="<?php echo e($variant->stock_quantity); ?>" placeholder="Kho" min="0">

                    <div class="d-flex flex-column align-items-center" style="min-width:150px;">
                        <img
                            class="variant-preview mb-1"
                            src="<?php echo e($variant->image ? asset($variant->image->image_url) : ''); ?>"
                            style="width:100px;height:100px;object-fit:cover;border-radius:4px;border:1px solid #eee;">
                        <input type="file" name="variants[<?php echo e($i); ?>][new_image]" accept="image/*" class="form-control form-control-sm variant-file-input" style="width:110px;">
                    </div>
                    <button type="hidden" style="padding:0 8px; width: 50px; height: 50px;"></button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button type="button" class="tf-button style-1 mt-10" id="add-variant-btn">
                <i class="icon-plus"></i> Add Variant
            </button>
        </fieldset>
    </div>
    <div class="cols gap10">
        <button class="tf-button w380" type="submit">Update product</button>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="tf-button style-3 w380">Cancel</a>
    </div>
</form>


<?php
$attributeSelects = '';
foreach($attributes as $attribute) {
$attributeSelects .= '<select  style="width: 60%;" name="VARIANT_NAME[attribute_values]['.$attribute->id.']" required>';
    $attributeSelects .= '<option value="">-- '.$attribute->name.' --</option>';
    foreach($attribute->values as $value) {
    $attributeSelects .= '<option value="'.$value->id.'">'.$value->value.'</option>';
    }
    $attributeSelects .= '</select>';
}

$imageOptions = '<option value="">-- Ảnh variant (chọn từ gallery) --</option>';
foreach($productImages as $img) {
$imageOptions .= '<option value="'.$img->id.'" data-url="'.asset($img->image_url).'">Ảnh #'.$img->id.'</option>';
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const input = document.getElementById('myFile');
        const gallery = document.getElementById('gallery');
        let filesArray = [];

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, e => e.preventDefault(), false);
            dropArea.addEventListener(eventName, e => e.stopPropagation(), false);
        });
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.style.borderColor = '#007bff', false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.style.borderColor = '#ccc', false);
        });
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = Array.from(dt.files);
            filesArray = filesArray.concat(files);
            updateInputFiles();
            previewFiles(filesArray);
        };
        dropArea.querySelector('label').onclick = () => input.click();
        input.addEventListener('change', function() {
            const files = Array.from(this.files);
            filesArray = filesArray.concat(files);
            updateInputFiles();
            previewFiles(filesArray);
        });

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        };

        function previewFiles(files) {
            gallery.innerHTML = '';
            files.forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement('div');
                    div.className = 'item';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '80px';
                    img.style.maxHeight = '80px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #eee';
                    img.style.borderRadius = '4px';
                    div.appendChild(img);
                    gallery.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        };

        const variantList = document.getElementById('variant-list');
        const addVariantBtn = document.getElementById('add-variant-btn');
        const attributeSelectsTemplate = `<?php echo addslashes($attributeSelects); ?>`;
        const imageOptionsTemplate = `<?php echo addslashes($imageOptions); ?>`;
        let variantIndex = variantList.querySelectorAll('.variant-row').length;
        addVariantBtn.addEventListener('click', function() {
            const variantDiv = document.createElement('div');
            variantDiv.className = 'variant-row flex gap10 mb-2 align-items-center';
            let selects = attributeSelectsTemplate.replace(/VARIANT_NAME/g, `variants[${variantIndex}]`);
            variantDiv.innerHTML = `
                ${selects}
                <input type="text" name="variants[${variantIndex}][size]" placeholder="Kích thước (ví dụ: 120x60x75 cm)" class="form-control form-control-sm">
                <input type="number" name="variants[${variantIndex}][price_modifier]" placeholder="Giá chênh lệch" step="0.01" class="form-control form-control-sm" style="width: 150px;">
                <input style="width: 100px;" type="number" name="variants[${variantIndex}][stock_quantity]" placeholder="Kho" min="0" class="form-control form-control-sm">
                <div class="d-flex flex-column align-items-center" style="min-width:150px;">
                    <img class="variant-preview mb-1" src="" style="width:80px;height:80px;object-fit:cover;border-radius:4px;border:1px solid #eee;display:none;">
                    <input type="file" name="variants[${variantIndex}][new_image]" accept="image/*" class="form-control form-control-sm variant-file-input" style="width:110px;">
                </div>
                <button type="button" class="remove-variant tf-button style-3" style="padding:0 8px; width: 50px; height: 50px;">&times;</button>
            `;
            variantDiv.querySelector('.remove-variant').onclick = function() {
                variantDiv.remove();
            };
            variantList.appendChild(variantDiv);

            // Hiển thị ảnh khi chọn
            const selectImg = variantDiv.querySelector('select[name^="variants"][name$="[image_id]"]');
            const previewImg = variantDiv.querySelector('.variant-preview');
            selectImg.addEventListener('change', function() {
                const imgId = this.value;
                if (imgId) {
                    const imgOption = this.querySelector('option[value="' + imgId + '"]');
                    if (imgOption) {
                        // Lấy url ảnh từ data-url nếu có, hoặc render url ảnh vào option khi build $imageOptions
                        const url = imgOption.getAttribute('data-url');
                        if (url) {
                            previewImg.src = url;
                            previewImg.style.display = '';
                        }
                    }
                } else {
                    previewImg.style.display = 'none';
                }
            });

            variantDiv.querySelector('.remove-variant').onclick = function() {
                variantDiv.remove();
            };
            variantIndex++;
        });

        document.querySelectorAll('#variant-list .variant-row').forEach(function(variantDiv) {
            const selectImg = variantDiv.querySelector('select[name$="[image_id]"]');
            const previewImg = variantDiv.querySelector('.variant-preview');
            selectImg.addEventListener('change', function() {
                const imgId = this.value;
                const imgOption = this.querySelector('option[value="' + imgId + '"]');
                if (imgId && imgOption) {
                    const url = imgOption.getAttribute('data-url');
                    if (url) {
                        previewImg.src = url;
                        previewImg.style.display = '';
                    }
                } else {
                    previewImg.style.display = 'none';
                }
            });

        });

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>