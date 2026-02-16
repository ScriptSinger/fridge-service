<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'limit' => 6,
    'count' => 0,
    'toggleSpacingClass' => 'mt-4',
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
    'limit' => 6,
    'count' => 0,
    'toggleSpacingClass' => 'mt-4',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-data="{
    showAll: false,
    limit: <?php echo e($limit); ?>,
}">
    <?php echo e($slot); ?>


    <?php if($count > $limit): ?>
        <div class="<?php echo e($toggleSpacingClass); ?>">
            <a @click.prevent="showAll = !showAll" class="text-yellow-500 inline-flex items-center cursor-pointer">
                <span x-show="!showAll">Показать ещё</span>
                <span x-show="showAll">Скрыть</span>

                <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/ui/sections/toggle-list.blade.php ENDPATH**/ ?>