<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col   w-full mb-12">
            <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"> Бренды
                <?php echo e(Str::lower($service->typeInCase('genitive'))); ?>,
                которые мы ремонтируем</h2>
            <p class="lg:w-2/3 leading-relaxed text-base">Работаем с большинством популярных марок. Ремонтируем бытовые и
                коммерческие <?php echo e(Str::lower($service->typeInCase('accusative'))); ?>.</p>
        </div>
        <div class="flex flex-wrap -m-4">
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lg:w-1/4 md:w-1/2 p-4 w-full shadow-sm hover:shadow-lg transition">
                    <a href="<?php echo e(route('services.brands.show', [$service->slug, $brand->slug])); ?>"
                        class="block relative h-48 rounded overflow-hidden">
                        <img alt="<?php echo e($brand->name); ?>" aria-label="Перейти на страницу бренда <?php echo e($brand->name); ?>"
                            class="object-contain object-center w-full h-full block cursor-pointer"
                            src="<?php echo e(asset('storage/' . $brand->image)); ?>">
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/sections/service/brands.blade.php ENDPATH**/ ?>