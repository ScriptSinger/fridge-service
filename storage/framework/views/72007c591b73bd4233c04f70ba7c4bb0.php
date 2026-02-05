<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['model']));

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

foreach (array_filter((['model']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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

    <div @click.away="closeModal()" class="bg-white rounded-lg p-4 sm:p-6 w-full max-w-md relative mx-4 sm:mx-0">
        <button @click="closeModal()"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-900 cursor-pointer">✕</button>

        <?php if (isset($component)) { $__componentOriginal788b25b48ffcc6963c4a37549101363b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal788b25b48ffcc6963c4a37549101363b = $attributes; } ?>
<?php $component = App\View\Components\Forms\Leads::resolve(['model' => $model] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('forms.leads'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Forms\Leads::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal788b25b48ffcc6963c4a37549101363b)): ?>
<?php $attributes = $__attributesOriginal788b25b48ffcc6963c4a37549101363b; ?>
<?php unset($__attributesOriginal788b25b48ffcc6963c4a37549101363b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal788b25b48ffcc6963c4a37549101363b)): ?>
<?php $component = $__componentOriginal788b25b48ffcc6963c4a37549101363b; ?>
<?php unset($__componentOriginal788b25b48ffcc6963c4a37549101363b); ?>
<?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/ui/modal-phone.blade.php ENDPATH**/ ?>