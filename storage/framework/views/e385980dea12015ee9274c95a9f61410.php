<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['galleries']));

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

foreach (array_filter((['galleries']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php ($slides = $galleries->filter(fn($item) => !empty($item->image))->values()); ?>

<?php if($slides->isNotEmpty()): ?>
    <?php if (isset($component)) { $__componentOriginalbda7854c2841beaee0e9cbf64d042c0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda7854c2841beaee0e9cbf64d042c0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.wrapper','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal0801d0fb74ec05d77bd33020e23b75f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0801d0fb74ec05d77bd33020e23b75f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sections.header','data' => ['title' => 'Примеры выполненных работ','subtitle' => 'Реальные кейсы и типовые задачи, которые мы решаем']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sections.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Примеры выполненных работ','subtitle' => 'Реальные кейсы и типовые задачи, которые мы решаем']); ?>
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

        <div class="mx-auto w-full px-4 md:px-0"
            x-data="aboutGallerySlider(<?php echo \Illuminate\Support\Js::from($slides->map(fn($item) => [
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'description' => $item->description,
                'image' => asset('storage/' . $item->image),
                'image_alt' => $item->image_alt ?: $item->title,
            ])->all())->toHtml() ?>)">
            <div class="relative overflow-hidden rounded-2xl border border-gray-200 shadow-lg"
                @touchstart="onTouchStart($event)" @touchend="onTouchEnd($event)">
                <div class="flex transition-transform duration-500 ease-out"
                    :style="`width: ${(slides.length / perView) * 100}%; transform: translateX(-${current * (100 / slides.length)}%);`">
                    <template x-for="(slide, index) in slides" :key="index">
                        <article class="relative shrink-0 border-r border-gray-200 last:border-r-0"
                            :style="`width: ${100 / slides.length}%`">
                            <img :src="slide.image" :alt="slide.image_alt"
                                class="h-64 w-full object-cover object-center md:h-72 lg:h-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 text-white md:p-8">
                                <p class="mb-1 text-xs font-medium tracking-widest text-yellow-400 md:text-sm"
                                    x-text="slide.subtitle"></p>
                                <h3 class="mb-2 text-lg font-semibold md:text-2xl" x-text="slide.title"></h3>
                                <p class="text-sm text-white/90 md:text-base" x-text="slide.description"></p>
                            </div>
                        </article>
                    </template>
                </div>

                <button type="button"
                    class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
                    aria-label="Предыдущий слайд" @click="prev()">
                    <span class="text-xl leading-none">‹</span>
                </button>
                <button type="button"
                    class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
                    aria-label="Следующий слайд" @click="next()">
                    <span class="text-xl leading-none">›</span>
                </button>
            </div>

            <div class="mt-4 flex items-center justify-center gap-2">
                <template x-for="dotIndex in maxIndex + 1" :key="`dot-${dotIndex}`">
                    <button type="button" class="h-2.5 cursor-pointer rounded-full transition-all"
                        :class="current === (dotIndex - 1) ? 'w-7 bg-yellow-500' : 'w-2.5 bg-gray-300 hover:bg-gray-400'"
                        @click="goTo(dotIndex - 1)" :aria-label="`Перейти к слайду ${dotIndex}`"></button>
                </template>
            </div>
        </div>
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
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/sections/about/gallery.blade.php ENDPATH**/ ?>