<?php if (isset($component)) { $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.wrapper','data' => ['id' => 'problems']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'problems']); ?>
    <?php if (isset($component)) { $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.header','data' => ['title' => 'Частые неисправности '.e(Str::lower($device->typeInCase('genitive'))).' '.e($brand->name).'','subtitle' => 'Мы собрали самые распространённые поломки '.e(Str::lower($device->typeInCase('genitive'))).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Частые неисправности '.e(Str::lower($device->typeInCase('genitive'))).' '.e($brand->name).'','subtitle' => 'Мы собрали самые распространённые поломки '.e(Str::lower($device->typeInCase('genitive'))).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8)): ?>
<?php $attributes = $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8; ?>
<?php unset($__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0801d0fb74ec05d77bd33020e23b75f8)): ?>
<?php $component = $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8; ?>
<?php unset($__componentOriginal0801d0fb74ec05d77bd33020e23b75f8); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal263f3aa38afc89c383bd3cbcc88ff560 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal263f3aa38afc89c383bd3cbcc88ff560 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.toggle-list','data' => ['limit' => 6,'count' => $problems->count()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.toggle-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['limit' => 6,'count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($problems->count())]); ?>
        <div class="flex flex-wrap -m-4">
            <?php $__currentLoopData = $problems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginald7e7e717925d32f99901cb92d349f154 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald7e7e717925d32f99901cb92d349f154 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.content-card','data' => ['problem' => $problem,'xShow' => 'showAll || '.e($index).' < limit','xCloak' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.content-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['problem' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($problem),'x-show' => 'showAll || '.e($index).' < limit','x-cloak' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald7e7e717925d32f99901cb92d349f154)): ?>
<?php $attributes = $__attributesOriginald7e7e717925d32f99901cb92d349f154; ?>
<?php unset($__attributesOriginald7e7e717925d32f99901cb92d349f154); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald7e7e717925d32f99901cb92d349f154)): ?>
<?php $component = $__componentOriginald7e7e717925d32f99901cb92d349f154; ?>
<?php unset($__componentOriginald7e7e717925d32f99901cb92d349f154); ?>
<?php endif; ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a)): ?>
<?php $attributes = $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a; ?>
<?php unset($__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbda7854c2841beaee0e9cbf64d042c0a)): ?>
<?php $component = $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a; ?>
<?php unset($__componentOriginalbda7854c2841beaee0e9cbf64d042c0a); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/sections/brands/problems.blade.php ENDPATH**/ ?>