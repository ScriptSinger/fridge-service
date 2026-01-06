<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $attributes = $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764)): ?>
<?php $component = $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764; ?>
<?php unset($__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal3c60356ca7bfc9a60eb5905961d180db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3c60356ca7bfc9a60eb5905961d180db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.services','data' => ['services' => $services]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.services'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['services' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($services)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3c60356ca7bfc9a60eb5905961d180db)): ?>
<?php $attributes = $__attributesOriginal3c60356ca7bfc9a60eb5905961d180db; ?>
<?php unset($__attributesOriginal3c60356ca7bfc9a60eb5905961d180db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3c60356ca7bfc9a60eb5905961d180db)): ?>
<?php $component = $__componentOriginal3c60356ca7bfc9a60eb5905961d180db; ?>
<?php unset($__componentOriginal3c60356ca7bfc9a60eb5905961d180db); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal03fbf38201d2088aebad3c018b0cd143 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03fbf38201d2088aebad3c018b0cd143 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.steps','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.steps'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03fbf38201d2088aebad3c018b0cd143)): ?>
<?php $attributes = $__attributesOriginal03fbf38201d2088aebad3c018b0cd143; ?>
<?php unset($__attributesOriginal03fbf38201d2088aebad3c018b0cd143); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03fbf38201d2088aebad3c018b0cd143)): ?>
<?php $component = $__componentOriginal03fbf38201d2088aebad3c018b0cd143; ?>
<?php unset($__componentOriginal03fbf38201d2088aebad3c018b0cd143); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal67958b40bb9729ac877d83f1bb8ebdcf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67958b40bb9729ac877d83f1bb8ebdcf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.pricing','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.pricing'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67958b40bb9729ac877d83f1bb8ebdcf)): ?>
<?php $attributes = $__attributesOriginal67958b40bb9729ac877d83f1bb8ebdcf; ?>
<?php unset($__attributesOriginal67958b40bb9729ac877d83f1bb8ebdcf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67958b40bb9729ac877d83f1bb8ebdcf)): ?>
<?php $component = $__componentOriginal67958b40bb9729ac877d83f1bb8ebdcf; ?>
<?php unset($__componentOriginal67958b40bb9729ac877d83f1bb8ebdcf); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalaed99f3bd4731520540516efc36b2396 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaed99f3bd4731520540516efc36b2396 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.blog','data' => ['problems' => $problems]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.blog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['problems' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($problems)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaed99f3bd4731520540516efc36b2396)): ?>
<?php $attributes = $__attributesOriginalaed99f3bd4731520540516efc36b2396; ?>
<?php unset($__attributesOriginalaed99f3bd4731520540516efc36b2396); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaed99f3bd4731520540516efc36b2396)): ?>
<?php $component = $__componentOriginalaed99f3bd4731520540516efc36b2396; ?>
<?php unset($__componentOriginalaed99f3bd4731520540516efc36b2396); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.contact','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f)): ?>
<?php $attributes = $__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f; ?>
<?php unset($__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f)): ?>
<?php $component = $__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f; ?>
<?php unset($__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $attributes = $__attributesOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__attributesOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $component = $__componentOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__componentOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/pages/home.blade.php ENDPATH**/ ?>