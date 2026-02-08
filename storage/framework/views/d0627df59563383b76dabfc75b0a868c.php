<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Цены на ремонт бытовой техники'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Примерные цены на ремонт по типам техники. Точная стоимость определяется после диагностики.')]); ?>
    <?php if (isset($component)) { $__componentOriginal8cf0999d3b47e512090d9f940d848847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cf0999d3b47e512090d9f940d848847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumbs','data' => ['route' => 'prices.index','model' => null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'prices.index','model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cf0999d3b47e512090d9f940d848847)): ?>
<?php $attributes = $__attributesOriginal8cf0999d3b47e512090d9f940d848847; ?>
<?php unset($__attributesOriginal8cf0999d3b47e512090d9f940d848847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cf0999d3b47e512090d9f940d848847)): ?>
<?php $component = $__componentOriginal8cf0999d3b47e512090d9f940d848847; ?>
<?php unset($__componentOriginal8cf0999d3b47e512090d9f940d848847); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => ['model' => null,'h1' => 'Стоимость услуг по ремонту','subtitle' => 'Цены сгруппированы по типам техники. Точная стоимость определяется после диагностики.','containerClass' => 'pt-9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(null),'h1' => 'Стоимость услуг по ремонту','subtitle' => 'Цены сгруппированы по типам техники. Точная стоимость определяется после диагностики.','containerClass' => 'pt-9']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $attributes = $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $component = $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.wrapper','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="max-w-3xl">
            <p class="text-gray-700 leading-relaxed">
                Ниже — ориентировочные цены на ремонт по типам техники. Итоговая стоимость зависит от
                модели, сложности неисправности и необходимости запчастей. Перед началом работ мастер
                проводит диагностику и согласует цену.
            </p>
            <ul class="mt-4 text-gray-700 list-disc pl-5">
                <li>Диагностика бесплатна при ремонте</li>
                <li>Цена фиксируется до начала работ</li>
                <li>Работаем с оригинальными и качественными аналогами запчастей</li>
            </ul>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a)): ?>
<?php $attributes = $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a; ?>
<?php unset($__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbda7854c2841beaee0e9cbf64d042c0a)): ?>
<?php $component = $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a; ?>
<?php unset($__componentOriginalbda7854c2841beaee0e9cbf64d042c0a); ?>
<?php endif; ?>

    <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.wrapper','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php if (isset($component)) { $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.header','data' => ['title' => $device->permalink,'subtitle' => $device->subtitle]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device->permalink),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device->subtitle)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8)): ?>
<?php $attributes = $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8; ?>
<?php unset($__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0801d0fb74ec05d77bd33020e23b75f8)): ?>
<?php $component = $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8; ?>
<?php unset($__componentOriginal0801d0fb74ec05d77bd33020e23b75f8); ?>
<?php endif; ?>

            <div class="hidden md:block">
                <?php echo $__env->make('components.sections.common.services.table', [
                    'services' => $device->services,
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="md:hidden">
                <?php echo $__env->make('components.sections.common.services.mobile', [
                    'services' => $device->services,
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a)): ?>
<?php $attributes = $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a; ?>
<?php unset($__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbda7854c2841beaee0e9cbf64d042c0a)): ?>
<?php $component = $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a; ?>
<?php unset($__componentOriginalbda7854c2841beaee0e9cbf64d042c0a); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $attributes = $__attributesOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__attributesOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $component = $__componentOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__componentOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/pages/prices.blade.php ENDPATH**/ ?>