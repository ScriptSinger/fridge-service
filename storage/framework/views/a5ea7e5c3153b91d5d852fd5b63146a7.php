<?php if (isset($component)) { $__componentOriginal386dc8449d6925e995096d9b8aa1f23d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['id' => 'pricing']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'pricing']); ?>
    <div class="flex flex-col   w-full mb-12">
        <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Примерные цены на ремонт
            бытовой
            техники</h2>
        <p class="lg:w-2/3 leading-relaxed text-base">Точная стоимость определяется после диагностики</p>
    </div>

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
<?php if (isset($__attributesOriginal386dc8449d6925e995096d9b8aa1f23d)): ?>
<?php $attributes = $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d; ?>
<?php unset($__attributesOriginal386dc8449d6925e995096d9b8aa1f23d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal386dc8449d6925e995096d9b8aa1f23d)): ?>
<?php $component = $__componentOriginal386dc8449d6925e995096d9b8aa1f23d; ?>
<?php unset($__componentOriginal386dc8449d6925e995096d9b8aa1f23d); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/sections/home/pricing.blade.php ENDPATH**/ ?>