<?php if (isset($component)) { $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.wrapper','data' => ['id' => 'contacts-info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'contacts-info']); ?>
    <?php if (isset($component)) { $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.header','data' => ['title' => 'Контактная информация','subtitle' => 'Телефон, адрес, режим работы и зона выезда.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Контактная информация','subtitle' => 'Телефон, адрес, режим работы и зона выезда.']); ?>
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Телефон</h3>
            <div class="mt-2 text-gray-900">
                <?php if (isset($component)) { $__componentOriginal068cc96cf51f1c56d971e8c803681b29 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal068cc96cf51f1c56d971e8c803681b29 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.phone','data' => ['class' => 'text-gray-900 hover:text-yellow-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-gray-900 hover:text-yellow-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal068cc96cf51f1c56d971e8c803681b29)): ?>
<?php $attributes = $__attributesOriginal068cc96cf51f1c56d971e8c803681b29; ?>
<?php unset($__attributesOriginal068cc96cf51f1c56d971e8c803681b29); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal068cc96cf51f1c56d971e8c803681b29)): ?>
<?php $component = $__componentOriginal068cc96cf51f1c56d971e8c803681b29; ?>
<?php unset($__componentOriginal068cc96cf51f1c56d971e8c803681b29); ?>
<?php endif; ?>
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Адрес</h3>
            <p class="mt-2 text-gray-900"><?php echo e(config('contacts.address_full')); ?></p>
            <p class="text-gray-700"><?php echo e(config('contacts.address_city')); ?></p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">График работы</h3>
            <p class="mt-2 text-gray-900"><?php echo e(config('contacts.opening_hours_display')); ?></p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Зона выезда</h3>
            <p class="mt-2 text-gray-900"><?php echo e(config('contacts.area_served')); ?></p>
        </div>
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
<?php /**PATH /var/www/html/resources/views/components/sections/contacts/info.blade.php ENDPATH**/ ?>