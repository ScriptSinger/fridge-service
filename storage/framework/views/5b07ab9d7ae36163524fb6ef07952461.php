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

    <div x-data="{ showAll: false }" class="w-full mx-auto overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 bg-gray-100">Услуга</th>
                    <th class="px-4 py-3 bg-gray-100">Описание</th>
                    <th class="px-4 py-3 bg-gray-100">Цена от</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $price = $service->prices->first();
                    ?>
                    <tr x-show="showAll || <?php echo e($index); ?> < 6" x-cloak>
                        <td class="border-t-2 border-gray-200 px-4 py-3"> <?php echo e($service->name); ?></td>
                        <td class="border-t-2 border-gray-200 px-4 py-3"><?php echo e($service->description ?? '—'); ?></td>
                        <td class="border-t-2 border-gray-200 px-4 py-3">
                            <?php if($price && $price->price_from): ?>
                                от <?php echo e(number_format($price->price_from, 0, '.', ' ')); ?> <?php echo e($price->units); ?>

                            <?php else: ?>
                                по договорённости
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
        
        <?php if(count($services) > 6): ?>
            <div class="flex pl-4 mt-4 w-full mx-auto">
                <a @click.prevent="showAll = !showAll" class="text-yellow-500 inline-flex items-center cursor-pointer">
                    <span x-show="!showAll">Узнать больше</span>
                    <span x-show="showAll">Скрыть</span>

                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }"
                        viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
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
<?php /**PATH /var/www/html/resources/views/components/sections/common/services.blade.php ENDPATH**/ ?>