<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['problems']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['problems']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if (isset($component)) { $__componentOriginal386dc8449d6925e995096d9b8aa1f23d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal386dc8449d6925e995096d9b8aa1f23d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.section','data' => ['id' => 'blog']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'blog']); ?>
    <div class="flex flex-col">
        <div class="h-1 bg-gray-200 rounded overflow-hidden">
            <div class="w-24 h-full bg-yellow-500"></div>
        </div>
        <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
            <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Частые неисправности
                бытовой техники
            </h2>
            <p class="lg:w-2/3 leading-relaxed text-base">Мы собрали самые распространённые поломки
                бытовой техники, с которыми
                к нам обращаются клиенты. Для каждой проблемы указаны симптомы,
                причины и возможные способы ремонта.</p>
        </div>
    </div>

    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
        <?php $__currentLoopData = $problems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="" class="p-4 md:w-1/3 sm:mb-0 mb-6 block">

                <div class="rounded-lg h-64 overflow-hidden">
                    <img alt="content" class="object-cover object-center h-full w-full"
                        src="https://dummyimage.com/1203x503">
                </div>
                <h3 class="text-xl font-medium title-font text-gray-900 mt-5"><?php echo e($problem->h1); ?></h3>
                <p class="text-base leading-relaxed mt-2">
                    <p><?php echo e($problem->short_content); ?></p>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="  mt-8">
        <a href="/problems"
            class="inline-block bg-yellow-500 text-white py-3 px-6 rounded hover:bg-yellow-600 transition">
            Смотреть все проблемы →
        </a>
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
<?php /**PATH /var/www/html/resources/views/components/sections/home/blog.blade.php ENDPATH**/ ?>