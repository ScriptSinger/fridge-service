<div x-data="{ showAll: false }" class="divide-y">
    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $price = $service->prices->first(); ?>

        <div class="py-3" x-show="showAll || <?php echo e($index); ?> < 4">
            <div class="font-medium"><?php echo e($service->name); ?></div>
            <div class="text-sm text-gray-500"><?php echo e($service->description); ?></div>
            <div class="text-sm mt-1">
                <?php echo e($price?->price_from ? 'от ' . number_format($price->price_from, 0, '.', ' ') . ' ₽' : ' '); ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if($services->count() > 4): ?>
        <div class="flex   mt-4 w-full mx-auto">
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
<?php /**PATH /var/www/html/resources/views/components/sections/common/services/mobile.blade.php ENDPATH**/ ?>