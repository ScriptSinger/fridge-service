<div <?php echo e($attributes->merge(['class' => 'xl:w-1/3 md:w-1/2 p-4'])); ?>>
    <div class="border border-gray-200 p-6 rounded-lg cursor-pointer"
        x-data="{ open: false }"
        @click="open = !open"
        :aria-expanded="open.toString()">
        
        <h2 class="text-lg text-gray-900 font-medium title-font mb-2"><?php echo e($problem->h1); ?></h2>
        <p class="leading-relaxed text-base"
            :class="{ 'line-clamp-1': !open }">
            <?php echo e(strip_tags($problem->content)); ?>

        </p>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/ui/sections/content-card.blade.php ENDPATH**/ ?>