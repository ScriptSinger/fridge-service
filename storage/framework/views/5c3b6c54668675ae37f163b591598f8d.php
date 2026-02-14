<!DOCTYPE html>
<html lang="ru">

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => null, 'description' => null]));

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

foreach (array_filter((['title' => null, 'description' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<head>
    <meta charset="UTF-8">
    <?php echo $__env->make('components.seo.base', ['title' => $title ?? null, 'description' => $description ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.seo.canonical', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.seo.og', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.seo.robots', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.seo.jsonld', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body>

    <?php if (isset($component)) { $__componentOriginal508dd3e42d353d46f68538c5a8e15cd5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5)): ?>
<?php $attributes = $__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5; ?>
<?php unset($__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal508dd3e42d353d46f68538c5a8e15cd5)): ?>
<?php $component = $__componentOriginal508dd3e42d353d46f68538c5a8e15cd5; ?>
<?php unset($__componentOriginal508dd3e42d353d46f68538c5a8e15cd5); ?>
<?php endif; ?>

    <main>
        <?php echo e($slot); ?>

    </main>

    <?php if (isset($component)) { $__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68)): ?>
<?php $attributes = $__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68; ?>
<?php unset($__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68)): ?>
<?php $component = $__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68; ?>
<?php unset($__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal66797899f28fb20dbe6fbbf9bed6a699 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.phone-cta','data' => ['variant' => 'fab']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.phone-cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'fab']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699)): ?>
<?php $attributes = $__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699; ?>
<?php unset($__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66797899f28fb20dbe6fbbf9bed6a699)): ?>
<?php $component = $__componentOriginal66797899f28fb20dbe6fbbf9bed6a699; ?>
<?php unset($__componentOriginal66797899f28fb20dbe6fbbf9bed6a699); ?>
<?php endif; ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>

</html>
<?php /**PATH /var/www/html/resources/views/components/layouts/app.blade.php ENDPATH**/ ?>