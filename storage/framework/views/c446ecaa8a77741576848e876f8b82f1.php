<div class="w-full overflow-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-3 bg-gray-100">Услуга</th>
                <th class="px-4 py-3 bg-gray-100">Цена от</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $price = $service->preferredPrice($service->device_id); ?>

                <tr>
                    <td class="border-b-2 border-gray-200 px-4 py-3 whitespace-nowrap">
                        <?php echo e($service->name); ?>

                    </td>
                    <td class="border-b-2 border-gray-200 px-4 py-3">
                        <?php if($price && $price->price_from): ?>
                            от <?php echo e(number_format($price->price_from, 0, '.', ' ')); ?> <?php echo e($price->units ?? '₽'); ?>

                        <?php else: ?>
                            по договорённости
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /var/www/html/resources/views/components/sections/prices/table.blade.php ENDPATH**/ ?>