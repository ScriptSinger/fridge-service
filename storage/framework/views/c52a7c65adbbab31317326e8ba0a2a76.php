<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class' => '']));

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

foreach (array_filter((['class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav <?php echo e($attributes->merge(['class' => $class])); ?>>
    <a href="#services" class="mr-5 hover:text-gray-900">Услуги</a>
    <a href="#pricing" class="mr-5 hover:text-gray-900">Цены</a>
    <a href="#blog" class="mr-5 hover:text-gray-900">Неисправности</a>
    <a href="#contact" class="mr-5 hover:text-gray-900">Контакты</a>
</nav>
<?php /**PATH /var/www/html/resources/views/components/ui/nav-links.blade.php ENDPATH**/ ?>