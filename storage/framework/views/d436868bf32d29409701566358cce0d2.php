<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->description)]); ?>
    <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => ['model' => $page]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page)]); ?>
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
    <?php if (isset($component)) { $__componentOriginal54b3acece057faabd7084a7aca97804f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54b3acece057faabd7084a7aca97804f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.services','data' => ['services' => $services]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.services'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['services' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($services)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54b3acece057faabd7084a7aca97804f)): ?>
<?php $attributes = $__attributesOriginal54b3acece057faabd7084a7aca97804f; ?>
<?php unset($__attributesOriginal54b3acece057faabd7084a7aca97804f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54b3acece057faabd7084a7aca97804f)): ?>
<?php $component = $__componentOriginal54b3acece057faabd7084a7aca97804f; ?>
<?php unset($__componentOriginal54b3acece057faabd7084a7aca97804f); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal27e3926b5509f06a5367689fb7ef6d7e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal27e3926b5509f06a5367689fb7ef6d7e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.steps','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.steps'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal27e3926b5509f06a5367689fb7ef6d7e)): ?>
<?php $attributes = $__attributesOriginal27e3926b5509f06a5367689fb7ef6d7e; ?>
<?php unset($__attributesOriginal27e3926b5509f06a5367689fb7ef6d7e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal27e3926b5509f06a5367689fb7ef6d7e)): ?>
<?php $component = $__componentOriginal27e3926b5509f06a5367689fb7ef6d7e; ?>
<?php unset($__componentOriginal27e3926b5509f06a5367689fb7ef6d7e); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalb2a6a8f422c927342180e7423973ba2a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2a6a8f422c927342180e7423973ba2a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.pricing','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.pricing'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2a6a8f422c927342180e7423973ba2a)): ?>
<?php $attributes = $__attributesOriginalb2a6a8f422c927342180e7423973ba2a; ?>
<?php unset($__attributesOriginalb2a6a8f422c927342180e7423973ba2a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2a6a8f422c927342180e7423973ba2a)): ?>
<?php $component = $__componentOriginalb2a6a8f422c927342180e7423973ba2a; ?>
<?php unset($__componentOriginalb2a6a8f422c927342180e7423973ba2a); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginaldbb7a66e9e2fd8493ff7d49eb74055db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbb7a66e9e2fd8493ff7d49eb74055db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.blog','data' => ['problems' => $problems]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.blog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['problems' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($problems)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbb7a66e9e2fd8493ff7d49eb74055db)): ?>
<?php $attributes = $__attributesOriginaldbb7a66e9e2fd8493ff7d49eb74055db; ?>
<?php unset($__attributesOriginaldbb7a66e9e2fd8493ff7d49eb74055db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbb7a66e9e2fd8493ff7d49eb74055db)): ?>
<?php $component = $__componentOriginaldbb7a66e9e2fd8493ff7d49eb74055db; ?>
<?php unset($__componentOriginaldbb7a66e9e2fd8493ff7d49eb74055db); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.contact','data' => ['model' => $page]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page)]); ?>
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
    <?php if (isset($component)) { $__componentOriginal070c0d0a50045cf1b6b6a24423c3ac7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal070c0d0a50045cf1b6b6a24423c3ac7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.scroll-up','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.scroll-up'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal070c0d0a50045cf1b6b6a24423c3ac7c)): ?>
<?php $attributes = $__attributesOriginal070c0d0a50045cf1b6b6a24423c3ac7c; ?>
<?php unset($__attributesOriginal070c0d0a50045cf1b6b6a24423c3ac7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal070c0d0a50045cf1b6b6a24423c3ac7c)): ?>
<?php $component = $__componentOriginal070c0d0a50045cf1b6b6a24423c3ac7c; ?>
<?php unset($__componentOriginal070c0d0a50045cf1b6b6a24423c3ac7c); ?>
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