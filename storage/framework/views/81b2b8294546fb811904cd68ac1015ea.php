<div x-data="{ showAll: false }" class="w-full overflow-auto">

    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-3 bg-gray-100">Услуга</th>
                
                <th class="px-4 py-3 bg-gray-100">Цена от</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $price = $service->prices->first();
                ?>
                <tr x-show="showAll || <?php echo e($index); ?> < 6" x-cloak>
                    <td class="border-b-2 border-gray-200 px-4 py-3"> <?php echo e($service->name); ?></td>
                    
                    <td class="border-b-2 border-gray-200 px-4 py-3">
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
                <span x-show="showAll">Свернуть</span>

                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }"
                    viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/sections/common/services/table.blade.php ENDPATH**/ ?>