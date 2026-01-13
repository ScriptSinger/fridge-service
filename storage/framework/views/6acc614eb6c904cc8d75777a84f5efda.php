<section class="bg-white">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center text-sm">
        <nav aria-label="breadcrumb" class="flex items-center">
            <ol class="flex items-center space-x-1 text-gray-500">
                <?php
                    $breadcrumbs = $route ? Breadcrumbs::generate($route, $model) : Breadcrumbs::current();
                ?>

                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-center">
                        <?php if($breadcrumb->url && !$loop->last): ?>
                            <a href="<?php echo e($breadcrumb->url); ?>" class="hover:text-gray-700">
                                <?php echo e($breadcrumb->title); ?>

                            </a>
                            <span class="mx-2 text-gray-400">/</span>
                        <?php else: ?>
                            <span class="text-gray-400"><?php echo e($breadcrumb->title); ?></span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </nav>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/ui/breadcrumbs.blade.php ENDPATH**/ ?>