<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['model', 'h1', 'subtitle', 'containerClass' => '']));

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

foreach (array_filter((['model', 'h1', 'subtitle', 'containerClass' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section x-data="modalPhone()" class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center <?php echo e($containerClass); ?> ">
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            
            <img src="<?php echo e(asset('assets/images/hero.png')); ?>" alt="Мастер по ремонту бытовой техники в Уфе">
        </div>
        <div
            class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
            <h1 class="title-font text-2xl sm:text-3xl lg:text-4xl mb-4 font-medium text-gray-900"><?php echo e($h1); ?>

            </h1>
            <p class="mb-8 leading-relaxed "><?php echo e($subtitle); ?> </p>
            <div class="flex justify-center">
                <button @click="openModal()"
                    class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer">Заказать
                    ремонт</button>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalcbe49f6e5340e477c5cce7d23df25248 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbe49f6e5340e477c5cce7d23df25248 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.modal-phone','data' => ['xRef' => 'modal','model' => $model]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.modal-phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'modal','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($model)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbe49f6e5340e477c5cce7d23df25248)): ?>
<?php $attributes = $__attributesOriginalcbe49f6e5340e477c5cce7d23df25248; ?>
<?php unset($__attributesOriginalcbe49f6e5340e477c5cce7d23df25248); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbe49f6e5340e477c5cce7d23df25248)): ?>
<?php $component = $__componentOriginalcbe49f6e5340e477c5cce7d23df25248; ?>
<?php unset($__componentOriginalcbe49f6e5340e477c5cce7d23df25248); ?>
<?php endif; ?>
</section>
<?php /**PATH /var/www/html/resources/views/components/sections/hero.blade.php ENDPATH**/ ?>