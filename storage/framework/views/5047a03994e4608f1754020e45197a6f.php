<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service->title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service->description)]); ?>
    <?php if (isset($component)) { $__componentOriginal8cf0999d3b47e512090d9f940d848847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cf0999d3b47e512090d9f940d848847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumbs','data' => ['model' => $brand,'route' => 'services.brands.show']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($brand),'route' => 'services.brands.show']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cf0999d3b47e512090d9f940d848847)): ?>
<?php $attributes = $__attributesOriginal8cf0999d3b47e512090d9f940d848847; ?>
<?php unset($__attributesOriginal8cf0999d3b47e512090d9f940d848847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cf0999d3b47e512090d9f940d848847)): ?>
<?php $component = $__componentOriginal8cf0999d3b47e512090d9f940d848847; ?>
<?php unset($__componentOriginal8cf0999d3b47e512090d9f940d848847); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala6167f818edef42cac826eaf1560c30d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6167f818edef42cac826eaf1560c30d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.brands.hero','data' => ['service' => $service,'brand' => $brand]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.brands.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['service' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service),'brand' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($brand)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6167f818edef42cac826eaf1560c30d)): ?>
<?php $attributes = $__attributesOriginala6167f818edef42cac826eaf1560c30d; ?>
<?php unset($__attributesOriginala6167f818edef42cac826eaf1560c30d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6167f818edef42cac826eaf1560c30d)): ?>
<?php $component = $__componentOriginala6167f818edef42cac826eaf1560c30d; ?>
<?php unset($__componentOriginala6167f818edef42cac826eaf1560c30d); ?>
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
    <?php if (isset($component)) { $__componentOriginale2f450239f13014f1c73811bb7fb05ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f450239f13014f1c73811bb7fb05ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.contact','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2f450239f13014f1c73811bb7fb05ad)): ?>
<?php $attributes = $__attributesOriginale2f450239f13014f1c73811bb7fb05ad; ?>
<?php unset($__attributesOriginale2f450239f13014f1c73811bb7fb05ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2f450239f13014f1c73811bb7fb05ad)): ?>
<?php $component = $__componentOriginale2f450239f13014f1c73811bb7fb05ad; ?>
<?php unset($__componentOriginale2f450239f13014f1c73811bb7fb05ad); ?>
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
<?php /**PATH /var/www/html/resources/views/pages/brands/show.blade.php ENDPATH**/ ?>