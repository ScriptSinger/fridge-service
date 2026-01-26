<section <?php echo e($attributes->merge(['class' => 'body-font text-gray-600'])); ?>>
    <div <?php echo e($attributes->class(['container mx-auto px-5 py-10 md:py-24'])); ?>>
        <?php echo e($slot); ?>

    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/ui/sections/wrapper.blade.php ENDPATH**/ ?>