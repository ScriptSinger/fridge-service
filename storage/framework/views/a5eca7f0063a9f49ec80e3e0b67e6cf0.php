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

    <div class=" w-full mx-auto overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 bg-gray-100">Услуга</th>
                    <th class="px-4 py-3 bg-gray-100">Описание</th>
                    <th class="px-4 py-3 bg-gray-100">Цена от</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-3">Диагностика</td>
                    <td class="px-4 py-3">Определение причины неисправности</td>
                    <td class="px-4 py-3 text-lg">Бесплатно*</td>
                </tr>

                <tr>
                    <td class="border-t px-4 py-3">Замена ТЭНа</td>
                    <td class="border-t px-4 py-3">Стиральные машины</td>
                    <td class="border-t px-4 py-3 text-lg">от 1 500 ₽</td>
                </tr>

                <tr>
                    <td class="border-t px-4 py-3">Заправка фреоном</td>
                    <td class="border-t px-4 py-3">Холодильники</td>
                    <td class="border-t px-4 py-3 text-lg">от 2 500 ₽</td>
                </tr>

                <tr>
                    <td class="border-t px-4 py-3">Ремонт модуля</td>
                    <td class="border-t px-4 py-3">Плата управления</td>
                    <td class="border-t px-4 py-3 text-lg">от 2 000 ₽</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex pl-4 mt-4  w-full mx-auto">
        <p class="text-sm text-gray-500 mt-4">
            * Диагностика бесплатна при последующем ремонте
        </p>
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
<?php /**PATH /var/www/html/resources/views/components/sections/common/pricing.blade.php ENDPATH**/ ?>