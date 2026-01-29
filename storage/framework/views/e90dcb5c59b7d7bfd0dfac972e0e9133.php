<?php if (isset($component)) { $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.wrapper','data' => ['id' => 'pricing']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'pricing']); ?>

    <?php if (isset($component)) { $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.header','data' => ['title' => 'Примерные цены на ремонт бытовой техники','subtitle' => 'Точная стоимость определяется после диагностики']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Примерные цены на ремонт бытовой техники','subtitle' => 'Точная стоимость определяется после диагностики']); ?>
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
            'services' => $services,
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    
    <div class="md:hidden">
        <?php echo $__env->make('components.sections.common.services.mobile', [
            'services' => $services,
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
<?php /**PATH /var/www/html/resources/views/components/sections/common/services/index.blade.php ENDPATH**/ ?>