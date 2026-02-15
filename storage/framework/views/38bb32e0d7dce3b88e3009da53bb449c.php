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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.header','data' => ['title' => 'Контактная информация','subtitle' => 'Телефон, email, график работы и зона выезда.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Контактная информация','subtitle' => 'Телефон, email, график работы и зона выезда.']); ?>
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

    <div class="flex flex-wrap -m-4 text-center">
        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.8"
                    class="text-yellow-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10.5 1.5h3m-4.5 0h6a2.25 2.25 0 0 1 2.25 2.25v16.5A2.25 2.25 0 0 1 15 22.5H9a2.25 2.25 0 0 1-2.25-2.25V3.75A2.25 2.25 0 0 1 9 1.5z" />
                    <path d="M11.25 18.75h1.5" />
                </svg>
                <p class="text-sm text-gray-500">Телефон</p>
                <div class="mt-1">
                    <?php if (isset($component)) { $__componentOriginal068cc96cf51f1c56d971e8c803681b29 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal068cc96cf51f1c56d971e8c803681b29 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.phone','data' => ['class' => 'justify-center text-gray-900 hover:text-yellow-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'justify-center text-gray-900 hover:text-yellow-600']); ?>
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
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.8"
                    class="text-yellow-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75" />
                    <path d="M21.75 6.75A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75" />
                    <path d="M21.75 6.75v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91A2.25 2.25 0 0 1 2.25 6.993V6.75" />
                </svg>
                <p class="text-sm text-gray-500">Email</p>
                <a href="mailto:<?php echo e(config('contacts.email')); ?>"
                    class="leading-relaxed text-gray-900 mt-1 inline-block break-all hover:text-yellow-600">
                    <?php echo e(config('contacts.email')); ?>

                </a>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.8"
                    class="text-yellow-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 6v6l4 2"></path>
                </svg>
                <p class="text-sm text-gray-500">График работы</p>
                <p class="leading-relaxed text-gray-900 mt-1"><?php echo e(config('contacts.opening_hours_display')); ?></p>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.8"
                    class="text-yellow-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 22s8-4 8-10a8 8 0 10-16 0c0 6 8 10 8 10z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <p class="text-sm text-gray-500">Зона выезда</p>
                <p class="leading-relaxed text-gray-900 mt-1"><?php echo e(config('contacts.area_served')); ?></p>
            </div>
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