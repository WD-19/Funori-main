<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'success']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'success']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="alert alert-<?php echo e($type); ?> alert-dismissible fade show mt-2" role="alert" style="font-size: 16px;">
    <?php echo e($slot); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if (alert) alert.classList.remove('show');
        }, 3500);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\Funori-main\resources\views/admin/components/alert.blade.php ENDPATH**/ ?>