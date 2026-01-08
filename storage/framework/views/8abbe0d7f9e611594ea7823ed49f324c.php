 <div class="mb-10">
     <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Наши услуги</h2>
     <ul class="list-none">
         <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <li class="mb-2">
                 <a href="#" class="text-gray-600 hover:text-gray-800">
                     <?php echo e($service->title); ?>

                 </a>
             </li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </ul>
 </div>
<?php /**PATH /var/www/html/resources/views/components/footer/services.blade.php ENDPATH**/ ?>