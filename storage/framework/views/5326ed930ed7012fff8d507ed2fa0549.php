<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'header',
]));

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

foreach (array_filter(([
    'variant' => 'header',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $items = config('navigation', []);
?>

<?php
    $resolveHref = function (array $item): string {
        if (!empty($item['route'])) {
            return route($item['route']);
        }

        return $item['href'] ?? '#';
    };
?>

<?php if($variant === 'footer'): ?>
    <nav class="list-none mb-10">
        <ul>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e($resolveHref($item)); ?>" class="text-gray-600 hover:text-gray-800">
                        <?php echo e($item['label']); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
<?php elseif($variant === 'mobile'): ?>
    <nav <?php echo e($attributes->merge(['class' => 'md:hidden'])); ?> x-cloak x-show="open" @click.away="open = false">
        <div class="container mx-auto px-4 pb-4">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($resolveHref($item)); ?>" class="block py-2 text-base hover:text-gray-900" @click="open = false">
                    <?php echo e($item['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </nav>
<?php else: ?>
    <nav <?php echo e($attributes->merge(['class' => 'hidden md:flex md:ml-auto md:items-center md:text-base md:justify-center'])); ?>>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($resolveHref($item)); ?>" class="mr-5 hover:text-gray-900"><?php echo e($item['label']); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/ui/nav.blade.php ENDPATH**/ ?>