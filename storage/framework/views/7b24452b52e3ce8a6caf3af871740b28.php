<header class="text-gray-600 body-font sticky top-0 inset-x-0 z-50 bg-white shadow md:static md:shadow-none"
    x-data="{ open: false }"
    @keydown.escape.window="open = false">
    <div class="container mx-auto flex items-center justify-between p-4 md:p-5">
        <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
        <button type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded text-gray-700 hover:text-gray-900"
            aria-label="Открыть меню" @click="open = !open">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <nav class="hidden md:flex md:ml-auto md:items-center md:text-base md:justify-center">
            <a href="#services" class="mr-5 hover:text-gray-900">Услуги</a>
            <a href="#pricing" class="mr-5 hover:text-gray-900">Цены</a>
            <a href="#blog" class="mr-5 hover:text-gray-900">Неисправности</a>
            <a href="#contact" class="mr-5 hover:text-gray-900">Контакты</a>
        </nav>
        <?php if (isset($component)) { $__componentOriginal66797899f28fb20dbe6fbbf9bed6a699 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.phone-cta','data' => ['variant' => 'header']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.phone-cta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'header']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699)): ?>
<?php $attributes = $__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699; ?>
<?php unset($__attributesOriginal66797899f28fb20dbe6fbbf9bed6a699); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66797899f28fb20dbe6fbbf9bed6a699)): ?>
<?php $component = $__componentOriginal66797899f28fb20dbe6fbbf9bed6a699; ?>
<?php unset($__componentOriginal66797899f28fb20dbe6fbbf9bed6a699); ?>
<?php endif; ?>
    </div>
    <nav class="md:hidden" x-cloak x-show="open" @click.away="open = false">
        <div class="container mx-auto px-4 pb-4">
            <a href="#services" class="block py-2 text-base hover:text-gray-900" @click="open = false">Услуги</a>
            <a href="#pricing" class="block py-2 text-base hover:text-gray-900" @click="open = false">Цены</a>
            <a href="#blog" class="block py-2 text-base hover:text-gray-900" @click="open = false">Неисправности</a>
            <a href="#contact" class="block py-2 text-base hover:text-gray-900" @click="open = false">Контакты</a>
        </div>
    </nav>
</header>
<?php /**PATH /var/www/html/resources/views/components/layouts/header.blade.php ENDPATH**/ ?>