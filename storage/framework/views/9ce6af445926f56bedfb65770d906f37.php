<?php if (isset($component)) { $__componentOriginal386dc8449d6925e995096d9b8aa1f23d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['id' => 'services']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'services']); ?>
    <div class="flex flex-col   w-full mb-12">
        <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Что нужно ремонтировать?</h2>
        <p class="lg:w-2/3 leading-relaxed text-base">Выберите тип вашей техники</p>
    </div>
    <div class="flex flex-wrap -m-4 ">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$service->slug) continue; ?>
            <div class="w-full md:w-full lg:w-1/2 sm:w-1/2 p-4 ">
                <div class="flex relative cursor-pointer">

                    <a href="<?php echo e(route('services.show', $service->slug)); ?>"
                        class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative block">
                        <?php if($service->image): ?>
                            <img alt="gallery"
                                class="w-full object-cover h-full object-center block opacity-25 hover:opacity-60 transition-opacity duration-300 absolute inset-0"
                                src="<?php echo e(Storage::url($service->image)); ?>">
                        <?php endif; ?>

                        <div class="text-center relative z-10 w-full">
                            <h3 class="text-xl text-gray-900 font-medium title-font mb-2"><?php echo e($service->type); ?>


                            </h3>
                        </div>
                    </a>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal386dc8449d6925e995096d9b8aa1f23d)): ?>
<?php $attributes = $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d; ?>
<?php unset($__attributesOriginal386dc8449d6925e995096d9b8aa1f23d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal386dc8449d6925e995096d9b8aa1f23d)): ?>
<?php $component = $__componentOriginal386dc8449d6925e995096d9b8aa1f23d; ?>
<?php unset($__componentOriginal386dc8449d6925e995096d9b8aa1f23d); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/sections/home/services.blade.php ENDPATH**/ ?>