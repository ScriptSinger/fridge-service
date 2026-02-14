<div class="divide-y">
    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $price = $service->preferredPrice($service->device_id); ?>

        <div class="py-3">
            <div class="font-medium"><?php echo e($service->name); ?></div>
            <div class="text-sm mt-1 whitespace-nowrap">
                <?php if($price && $price->price_from): ?>
                    от <?php echo e(number_format($price->price_from, 0, '.', ' ')); ?> <?php echo e($price->units ?? '₽'); ?>

                <?php else: ?>
                    по договорённости
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/sections/prices/mobile.blade.php ENDPATH**/ ?>