<div class="flex flex-col w-full mb-12 text-center md:text-left">
    <?php if($title): ?>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-medium title-font mb-4 text-gray-900"><?php echo e($title); ?></h2>
    <?php endif; ?>

    <?php if($subtitle): ?>
        <p class="lg:w-2/3 leading-relaxed text-base"><?php echo e($subtitle); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/ui/sections/header.blade.php ENDPATH**/ ?>