<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['payload' => [], 'model' => null]));

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

foreach (array_filter((['payload' => [], 'model' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-cloak x-show="open" style="display: none;" class="fixed inset-0 bg-black/90 flex items-center justify-center z-50"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div @click.away="closeModal()" class="bg-white rounded-lg p-6 w-full max-w-md relative">
        <button @click="closeModal()"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-900 cursor-pointer">✕</button>
        <?php if (isset($component)) { $__componentOriginal897620b40651a3282cad306fdc12aab3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal897620b40651a3282cad306fdc12aab3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.lead-form','data' => ['class' => 'w-full','id' => 'my-form','payload' => [
            'leadable_type' => get_class($model),
            'leadable_id' => $model->id,
            'utm_source' => session('utm_source'),
            'utm_medium' => session('utm_medium'),
            'utm_campaign' => session('utm_campaign'),
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.lead-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full','id' => 'my-form','payload' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            'leadable_type' => get_class($model),
            'leadable_id' => $model->id,
            'utm_source' => session('utm_source'),
            'utm_medium' => session('utm_medium'),
            'utm_campaign' => session('utm_campaign'),
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal897620b40651a3282cad306fdc12aab3)): ?>
<?php $attributes = $__attributesOriginal897620b40651a3282cad306fdc12aab3; ?>
<?php unset($__attributesOriginal897620b40651a3282cad306fdc12aab3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal897620b40651a3282cad306fdc12aab3)): ?>
<?php $component = $__componentOriginal897620b40651a3282cad306fdc12aab3; ?>
<?php unset($__componentOriginal897620b40651a3282cad306fdc12aab3); ?>
<?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/ui/modal-phone.blade.php ENDPATH**/ ?>