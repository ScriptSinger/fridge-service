<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device->title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device->description)]); ?>
    <?php if (isset($component)) { $__componentOriginal8cf0999d3b47e512090d9f940d848847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cf0999d3b47e512090d9f940d848847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.breadcrumbs','data' => ['model' => $device,'route' => 'devices.show']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device),'route' => 'devices.show']); ?>
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
    <?php if (isset($component)) { $__componentOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d77bb759cf09fb7609ab7d50dcb0764 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => ['model' => $device,'h1' => $device->h1,'subtitle' => $device->subtitle,'containerClass' => 'pt-9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device),'h1' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device->h1),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device->subtitle),'containerClass' => 'pt-9']); ?>
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
    <?php if (isset($component)) { $__componentOriginal38df05f019cbe7712f9a08ba46b3fab0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal38df05f019cbe7712f9a08ba46b3fab0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.brands','data' => ['models' => $brands,'device' => $device]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.brands'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['models' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($brands),'device' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal38df05f019cbe7712f9a08ba46b3fab0)): ?>
<?php $attributes = $__attributesOriginal38df05f019cbe7712f9a08ba46b3fab0; ?>
<?php unset($__attributesOriginal38df05f019cbe7712f9a08ba46b3fab0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal38df05f019cbe7712f9a08ba46b3fab0)): ?>
<?php $component = $__componentOriginal38df05f019cbe7712f9a08ba46b3fab0; ?>
<?php unset($__componentOriginal38df05f019cbe7712f9a08ba46b3fab0); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal49c996d1f0208ad5f918311e429079e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49c996d1f0208ad5f918311e429079e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.common.services.index','data' => ['services' => $services]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.common.services.index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['services' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($services)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49c996d1f0208ad5f918311e429079e6)): ?>
<?php $attributes = $__attributesOriginal49c996d1f0208ad5f918311e429079e6; ?>
<?php unset($__attributesOriginal49c996d1f0208ad5f918311e429079e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49c996d1f0208ad5f918311e429079e6)): ?>
<?php $component = $__componentOriginal49c996d1f0208ad5f918311e429079e6; ?>
<?php unset($__componentOriginal49c996d1f0208ad5f918311e429079e6); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalbd6682a686d18752ee21d4fbbcac6f86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd6682a686d18752ee21d4fbbcac6f86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.common.problems','data' => ['problems' => $problems,'device' => $device]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.common.problems'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['problems' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($problems),'device' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd6682a686d18752ee21d4fbbcac6f86)): ?>
<?php $attributes = $__attributesOriginalbd6682a686d18752ee21d4fbbcac6f86; ?>
<?php unset($__attributesOriginalbd6682a686d18752ee21d4fbbcac6f86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd6682a686d18752ee21d4fbbcac6f86)): ?>
<?php $component = $__componentOriginalbd6682a686d18752ee21d4fbbcac6f86; ?>
<?php unset($__componentOriginalbd6682a686d18752ee21d4fbbcac6f86); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal94f121500a9e13e948e5e55eab3f6814 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal94f121500a9e13e948e5e55eab3f6814 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.faq','data' => ['faqs' => $faqs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.faq'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['faqs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($faqs)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal94f121500a9e13e948e5e55eab3f6814)): ?>
<?php $attributes = $__attributesOriginal94f121500a9e13e948e5e55eab3f6814; ?>
<?php unset($__attributesOriginal94f121500a9e13e948e5e55eab3f6814); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal94f121500a9e13e948e5e55eab3f6814)): ?>
<?php $component = $__componentOriginal94f121500a9e13e948e5e55eab3f6814; ?>
<?php unset($__componentOriginal94f121500a9e13e948e5e55eab3f6814); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal62de9fc3ebe431a0d746cd50eda6c97f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62de9fc3ebe431a0d746cd50eda6c97f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.contact','data' => ['model' => $device]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($device)]); ?>
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
<?php /**PATH /var/www/html/resources/views/pages/device.blade.php ENDPATH**/ ?>