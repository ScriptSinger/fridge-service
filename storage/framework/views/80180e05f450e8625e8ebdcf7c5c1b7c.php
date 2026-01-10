    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            
            <div class="flex flex-wrap -m-4 ">

                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <div class="flex relative cursor-pointer">

                            

                            <img src="<?php echo e(asset('storage/' . $service->image)); ?>" alt="<?php echo e($service->image_alt); ?>"
                                class="absolute inset-0 w-full h-full object-cover object-center">

                            <div
                                class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                <h2 class="tracking-widest text-sm title-font font-medium text-yellow-500 mb-1">THE
                                    SUBTITLE
                                </h2>
                                <h2 class="title-font text-lg font-medium text-gray-900 mb-3"><?php echo e($service->title); ?></h2>
                                <p class="leading-relaxed"> <?php echo e($service->excerpt); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
        </div>
    </section>
<?php /**PATH /var/www/html/resources/views/components/sections/service.blade.php ENDPATH**/ ?>