 <?php if (isset($component)) { $__componentOriginal263f3aa38afc89c383bd3cbcc88ff560 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal263f3aa38afc89c383bd3cbcc88ff560 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.toggle-list','data' => ['limit' => 4,'count' => $services->count()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.toggle-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['limit' => 4,'count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($services->count())]); ?>
     <div class="divide-y">
         <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php $price = $service->prices->first(); ?>

             <div class="py-3" x-show="showAll || <?php echo e($index); ?> < limit" x-cloak>
                 <div class="font-medium"><?php echo e($service->name); ?></div>

                 <?php if($service->description): ?>
                     <div class="text-sm text-gray-500">
                         <?php echo e($service->description); ?>

                     </div>
                 <?php endif; ?>

                 <div class="text-sm mt-1">
                     <?php echo e($price?->price_from ? 'от ' . number_format($price->price_from, 0, '.', ' ') . ' ₽' : ' '); ?>

                 </div>
             </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal263f3aa38afc89c383bd3cbcc88ff560)): ?>
<?php $attributes = $__attributesOriginal263f3aa38afc89c383bd3cbcc88ff560; ?>
<?php unset($__attributesOriginal263f3aa38afc89c383bd3cbcc88ff560); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal263f3aa38afc89c383bd3cbcc88ff560)): ?>
<?php $component = $__componentOriginal263f3aa38afc89c383bd3cbcc88ff560; ?>
<?php unset($__componentOriginal263f3aa38afc89c383bd3cbcc88ff560); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/sections/common/services/mobile.blade.php ENDPATH**/ ?>