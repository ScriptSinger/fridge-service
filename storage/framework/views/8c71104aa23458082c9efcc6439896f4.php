<h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Контакты</h2>
<address class="not-italic mb-10 text-gray-600">
    <p class="text-gray-600 hover:text-gray-800">город <?php echo e(config('contacts.address_city')); ?></p>
    <p class="text-gray-600 hover:text-gray-800">
        <?php if (isset($component)) { $__componentOriginal068cc96cf51f1c56d971e8c803681b29 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal068cc96cf51f1c56d971e8c803681b29 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.phone','data' => ['class' => 'inline-flex items-center bg-yellow-500 text-white border-0 py-2 px-4 rounded text-base hover:bg-yellow-600 focus:outline-none mt-4 md:mt-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'inline-flex items-center bg-yellow-500 text-white border-0 py-2 px-4 rounded text-base hover:bg-yellow-600 focus:outline-none mt-4 md:mt-0']); ?>
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
    </p>
    <p class="text-gray-600 hover:text-gray-800"><?php echo e(config('contacts.opening_hours_display')); ?></p>
</address>
<?php /**PATH /var/www/html/resources/views/components/footer/contacts.blade.php ENDPATH**/ ?>