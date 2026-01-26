<?php if (isset($component)) { $__componentOriginal386dc8449d6925e995096d9b8aa1f23d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="flex flex-col   w-full mb-12">
        <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"> Бренды
            <?php echo e(Str::lower($service->typeInCase('genitive'))); ?>,
            которые мы ремонтируем</h2>
        <p class="lg:w-2/3 leading-relaxed text-base">Работаем с большинством популярных марок. Ремонтируем бытовые и
            коммерческие <?php echo e(Str::lower($service->typeInCase('accusative'))); ?>.</p>
    </div>
    <div class="flex flex-wrap -m-4">
        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$model->slug) continue; ?>
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full shadow-sm hover:shadow-lg transition">
                <a href="<?php echo e(route('services.brands.show', [$service->slug, $model->slug])); ?>"
                    class="block relative h-48 rounded overflow-hidden">
                    <img alt="<?php echo e($model->name); ?>" aria-label="Перейти на страницу бренда <?php echo e($model->name); ?>"
                        class="object-contain object-center w-full h-full block cursor-pointer"
                        src="<?php echo e(asset('storage/' . $model->image)); ?>">
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal386dc8449d6925e995096d9b8aa1f23d)): ?>
<?php $attributes = $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d; ?>
<?php unset($__attributesOriginal386dc8449d6925e995096d9b8aa1f23d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal386dc8449d6925e995096d9b8aa1f23d)): ?>
<?php $component = $__componentOriginal386dc8449d6925e995096d9b8aa1f23d; ?>
<?php unset($__componentOriginal386dc8449d6925e995096d9b8aa1f23d); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/sections/brands.blade.php ENDPATH**/ ?>