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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.hero','data' => ['model' => $page,'h1' => $page->h1,'subtitle' => $page->subtitle]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['model' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page),'h1' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->h1),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page->subtitle)]); ?>
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
    <?php if (isset($component)) { $__componentOriginal70be85cc5258c88743d85bedabcbd525 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal70be85cc5258c88743d85bedabcbd525 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.devices','data' => ['devices' => $devices]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.devices'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['devices' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($devices)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal70be85cc5258c88743d85bedabcbd525)): ?>
<?php $attributes = $__attributesOriginal70be85cc5258c88743d85bedabcbd525; ?>
<?php unset($__attributesOriginal70be85cc5258c88743d85bedabcbd525); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal70be85cc5258c88743d85bedabcbd525)): ?>
<?php $component = $__componentOriginal70be85cc5258c88743d85bedabcbd525; ?>
<?php unset($__componentOriginal70be85cc5258c88743d85bedabcbd525); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalf4f1dfdecf844b69556b9865479b670d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4f1dfdecf844b69556b9865479b670d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.common.steps','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.common.steps'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4f1dfdecf844b69556b9865479b670d)): ?>
<?php $attributes = $__attributesOriginalf4f1dfdecf844b69556b9865479b670d; ?>
<?php unset($__attributesOriginalf4f1dfdecf844b69556b9865479b670d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4f1dfdecf844b69556b9865479b670d)): ?>
<?php $component = $__componentOriginalf4f1dfdecf844b69556b9865479b670d; ?>
<?php unset($__componentOriginalf4f1dfdecf844b69556b9865479b670d); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal373f381962c3c66943eda474148a283c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal373f381962c3c66943eda474148a283c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sections.home.benefits','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sections.home.benefits'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal373f381962c3c66943eda474148a283c)): ?>
<?php $attributes = $__attributesOriginal373f381962c3c66943eda474148a283c; ?>
<?php unset($__attributesOriginal373f381962c3c66943eda474148a283c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal373f381962c3c66943eda474148a283c)): ?>
<?php $component = $__componentOriginal373f381962c3c66943eda474148a283c; ?>
<?php unset($__componentOriginal373f381962c3c66943eda474148a283c); ?>
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