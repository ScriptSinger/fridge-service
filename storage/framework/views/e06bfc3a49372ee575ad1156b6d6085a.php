<h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Навигация</h2>
<?php if (isset($component)) { $__componentOriginalb55e525bcf4e336a3dc267e7f66aa1e0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb55e525bcf4e336a3dc267e7f66aa1e0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.nav','data' => ['variant' => 'footer']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'footer']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb55e525bcf4e336a3dc267e7f66aa1e0)): ?>
<?php $attributes = $__attributesOriginalb55e525bcf4e336a3dc267e7f66aa1e0; ?>
<?php unset($__attributesOriginalb55e525bcf4e336a3dc267e7f66aa1e0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb55e525bcf4e336a3dc267e7f66aa1e0)): ?>
<?php $component = $__componentOriginalb55e525bcf4e336a3dc267e7f66aa1e0; ?>
<?php unset($__componentOriginalb55e525bcf4e336a3dc267e7f66aa1e0); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/footer/navigation.blade.php ENDPATH**/ ?>