<?php $__env->startSection('title', 'Danh sách sản phẩm'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center flex-wrap justify-between gap20 mb-30">
    <h3>Add Product</h3>
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
            <div class="text-tiny">Add Product</div>
        </li>
    </ul>
</div>
<!-- form-add-product -->
<<<<<<< HEAD
<form class="form-add-product">
    <div class="wg-box mb-30">
        <fieldset>
            <div class="body-title mb-10">Upload images</div>
            <div class="upload-image mb-16">
                <div class="up-load">
                    <label class="uploadfile" for="myFile">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <div class="text-tiny">Drop your images here or select <span class="text-secondary">click to browse</span></div>
                        <input type="file" id="myFile" name="filename">
                        <img src="#" id="myFile-input" alt="">
                    </label>
                </div>
                <div class="flex gap20 flex-wrap">
                    <div class="item">
                        <img src="images/upload/img-1.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="images/upload/img-2.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details</div>
=======
<form class="form-add-product" method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
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
                        <input type="file" id="myFile" name="images[]" multiple required style="display:none;">
                    </label>
                </div>
                <div class="flex gap20 flex-wrap" id="gallery">
                </div>
            </div>
>>>>>>> c9d4f3a268865ac8e0d7ac4322e51f500868f71c
        </fieldset>
    </div>
    <div class="wg-box mb-30">
        <fieldset class="name">
            <div class="body-title mb-10">Product title <span class="tf-color-1">*</span></div>
<<<<<<< HEAD
            <input class="mb-10" type="text" placeholder="Enter title" name="text" tabindex="0" value="" aria-required="true" required="">
            <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the product name.</div>
        </fieldset>
        <fieldset class="category">
            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
            <input class="" type="text" placeholder="Choose category" name="text" tabindex="0" value="" aria-required="true" required="">
        </fieldset>
        <div class="cols-lg gap22">
            <fieldset class="price">
                <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
                <input class="" type="number" placeholder="Price" name="text" tabindex="0" value="" aria-required="true" required="">
            </fieldset>
            <fieldset class="sale-price">
                <div class="body-title mb-10">Sale Price </div>
                <input class="" type="number" placeholder="Sale Price " name="text" tabindex="0" value="" aria-required="true" required="">
            </fieldset>
            <fieldset class="schedule">
                <div class="body-title mb-10">Schedule</div>
                <input type="date" name="date">
            </fieldset>
        </div>
        <div class="cols-lg gap22">
            <fieldset class="choose-brand">
                <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                <input class="" type="text" placeholder="Choose brand" name="text" tabindex="0" value="" aria-required="true" required="">
            </fieldset>
            <fieldset class="variant-picker-item">
                <div class="variant-picker-label body-title">
                    Color: <span class="body-title-2 fw-4 variant-picker-label-value">Orange</span>
                </div>
                <div class="variant-picker-values">
                    <input id="values-orange" type="radio" name="color" checked="">
                    <label class="radius-60" for="values-orange" data-value="Orange">
                        <span class="btn-checkbox bg-color-orange"></span>
                    </label>
                    <input id="values-blue" type="radio" name="color">
                    <label class="radius-60" for="values-blue" data-value="Blue">
                        <span class="btn-checkbox bg-color-blue"></span>
                    </label>
                    <input id="values-yellow" type="radio" name="color">
                    <label class="radius-60" for="values-yellow" data-value="Yellow">
                        <span class="btn-checkbox bg-color-yellow"></span>
                    </label>
                    <input id="values-black" type="radio" name="color">
                    <label class="radius-60" for="values-black" data-value="Black">
                        <span class="btn-checkbox bg-color-black"></span>
                    </label>
                </div>
            </fieldset>
            <fieldset class="variant-picker-item">
                <div class="variant-picker-label body-text">
                    Size: <span class="body-title-2 variant-picker-label-value">S</span>
                </div>
                <div class="variant-picker-values">
                    <input type="radio" name="size" id="values-s">
                    <label class="style-text" for="values-s" data-value="S">
                        <div class="text">S</div>
                    </label>
                    <input type="radio" name="size" id="values-m" checked="">
                    <label class="style-text" for="values-m" data-value="M">
                        <div class="text">M</div>
                    </label>
                    <input type="radio" name="size" id="values-l">
                    <label class="style-text" for="values-l" data-value="L">
                        <div class="text">L</div>
                    </label>
                    <input type="radio" name="size" id="values-xl">
                    <label class="style-text" for="values-xl" data-value="XL">
                        <div class="text">XL</div>
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="cols-lg gap22">
            <fieldset class="sku">
                <div class="body-title mb-10">SKU</div>
                <input class="" type="text" placeholder="Enter SKU" name="text" tabindex="0" value="" aria-required="true" required="">
            </fieldset>
            <fieldset class="category">
                <div class="body-title mb-10">Stock <span class="tf-color-1">*</span></div>
                <input class="" type="text" placeholder="Enter Stock" name="text" tabindex="0" value="" aria-required="true" required="">
            </fieldset>
            <fieldset class="sku">
                <div class="body-title mb-10">Tags</div>
                <input class="" type="text" placeholder="Enter a tag" name="text" tabindex="0" value="" aria-required="true" required="">
            </fieldset>
        </div>
        <fieldset class="description">
            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
            <textarea class="mb-10" name="description" placeholder="Short description about product" tabindex="0" aria-required="true" required=""></textarea>
            <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
        </fieldset>
    </div>

    <div class="cols gap10">
        <button class="tf-button w380" type="submit">Add product</button>
        <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
    </div>
</form>
=======
            <input class="mb-10" type="text" placeholder="Enter title" name="name" maxlength="100" required>
        </fieldset>
        <fieldset class="category">
            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
            <select name="category_id" required>
                <option value="">-- Choose category --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="brand">
            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
            <select name="brand_id" required>
                <option value="">-- Choose brand --</option>
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>
        <fieldset class="price">
            <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
            <input type="number" name="regular_price" min="0" step="0.01" required>
        </fieldset>
        <fieldset class="short_description">
            <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
            <textarea name="short_description" maxlength="255" required></textarea>
        </fieldset>
        <fieldset class="description">
            <div class="body-title mb-10">Description</div>
            <textarea name="description"></textarea>
        </fieldset>

        <!-- VARIANTS -->
        <fieldset class="variants">
            <div class="body-title mb-10">Variants</div>
            <div id="variant-list">
            </div>
            <button type="button" class="tf-button style-1 mt-10" id="add-variant-btn">
                <i class="icon-plus"></i> Add Variant
            </button>
        </fieldset>
    </div>
    <div class="cols gap10">
        <button class="tf-button w380" type="submit">Add product</button>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="tf-button style-3 w380">Cancel</a>
    </div>
</form>


<?php
    $attributeSelects = '';
    foreach($attributes as $attribute) {
        $attributeSelects .= '<select name="VARIANT_NAME[attribute_values]['.$attribute->id.']" required>';
        $attributeSelects .= '<option value="">-- '.$attribute->name.' --</option>';
        foreach($attribute->values as $value) {
            $attributeSelects .= '<option value="'.$value->id.'">'.$value->value.'</option>';
        }
        $attributeSelects .= '</select>';
    }

    $imageOptions = '<option value="">-- Ảnh variant (chọn từ gallery) --</option>';
    foreach($productImages as $img) {
        $imageOptions .= '<option value="'.$img->id.'">Ảnh #'.$img->id.'</option>';
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
    }
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
    }
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
    }

    const variantList = document.getElementById('variant-list');
    const addVariantBtn = document.getElementById('add-variant-btn');
    let variantIndex = 0;

    const attributeSelectsTemplate = `<?php echo addslashes($attributeSelects); ?>`;
    const imageOptionsTemplate = `<?php echo addslashes($imageOptions); ?>`;

    addVariantBtn.addEventListener('click', function() {
        const variantDiv = document.createElement('div');
        variantDiv.className = 'variant-row flex gap10 mb-2';
        let selects = attributeSelectsTemplate.replace(/VARIANT_NAME/g, `variants[${variantIndex}]`);
        variantDiv.innerHTML = `
            ${selects}
            <input type="number" name="variants[${variantIndex}][price_modifier]" placeholder="Giá chênh lệch" step="0.01" style="width:200px;">
            <input type="number" name="variants[${variantIndex}][stock_quantity]" placeholder="Kho" min="0" style="width:100px;">
            <input type="file" name="variants[${variantIndex}][image]" accept="image/*" style="width:180px;">
            <button type="button" class="remove-variant tf-button style-3" style="padding:0 8px;">&times;</button>
        `;
        variantList.appendChild(variantDiv);

        variantDiv.querySelector('.remove-variant').onclick = function() {
            variantDiv.remove();
        };
        variantIndex++;
    });
});
</script>
>>>>>>> c9d4f3a268865ac8e0d7ac4322e51f500868f71c
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/products/create.blade.php ENDPATH**/ ?>