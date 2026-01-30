 <?php if (isset($component)) { $__componentOriginal263f3aa38afc89c383bd3cbcc88ff560 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal263f3aa38afc89c383bd3cbcc88ff560 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.toggle-list','data' => ['limit' => 6,'count' => $services->count()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.toggle-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['limit' => 6,'count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($services->count())]); ?>
     <div class="w-full overflow-auto">
         <table class="table-auto w-full text-left whitespace-no-wrap">
             <thead>
                 <tr>
                     <th class="px-4 py-3 bg-gray-100">Услуга</th>
                     <th class="px-4 py-3 bg-gray-100">Цена от</th>
                 </tr>
             </thead>

             <tbody>
                 <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php $price = $service->prices->first(); ?>

                     <tr x-show="showAll || <?php echo e($index); ?> < limit" x-cloak>
                         <td class="border-b-2 border-gray-200 px-4 py-3">
                             <?php echo e($service->name); ?>

                         </td>
                         <td class="border-b-2 border-gray-200 px-4 py-3">
                             <?php if($price && $price->price_from): ?>
                                 от <?php echo e(number_format($price->price_from, 0, '.', ' ')); ?> <?php echo e($price->units); ?>

                             <?php else: ?>
                                 по договорённости
                             <?php endif; ?>
                         </td>
                     </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tbody>
         </table>
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
<?php /**PATH /var/www/html/resources/views/components/sections/common/services/table.blade.php ENDPATH**/ ?>