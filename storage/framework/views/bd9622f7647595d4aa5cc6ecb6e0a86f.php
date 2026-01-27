 <div class="mb-10">
     <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Наши услуги</h2>
     <ul class="list-none">
         <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if(!$device->slug) continue; ?>
             <li class="mb-2">
                 <a href="<?php echo e(route('devices.show', $device->slug)); ?>" class="text-gray-600 hover:text-gray-800">
                     <?php echo e($device->permalink); ?>

                 </a>
             </li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </ul>
 </div>
<?php /**PATH /var/www/html/resources/views/components/footer/devices.blade.php ENDPATH**/ ?>