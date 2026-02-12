<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'header',
]));

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

foreach (array_filter(([
    'variant' => 'header',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php ($navItems = $navItems ?? collect()); ?>
<?php ($repairItems = $repairItems ?? collect()); ?>

<?php if($variant === 'footer'): ?>
    <nav class="list-none mb-10">
        <ul>
            <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e($item['href']); ?>" class="text-gray-600 hover:text-gray-800">
                        <?php echo e($item['label']); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
<?php elseif($variant === 'mobile'): ?>
    <nav <?php echo e($attributes->merge(['class' => 'md:hidden'])); ?> x-cloak x-show="open" @click.away="open = false">
        <div class="container mx-auto px-4 pb-4" x-data="{ repairOpen: false }">
            <div class="py-2">
                <button type="button"
                    class="w-full text-left text-base hover:text-gray-900 cursor-pointer inline-flex items-center justify-between"
                    @click="repairOpen = !repairOpen">
                    <span>Ремонт</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': repairOpen }" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="pl-4 mt-1" x-show="repairOpen" x-transition>
                    <?php $__currentLoopData = $repairItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repairItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($repairItem['href']); ?>" class="block py-2 text-sm hover:text-gray-900"
                            @click="open = false; repairOpen = false">
                            <?php echo e($repairItem['label']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($item['href']); ?>" class="block py-2 text-base hover:text-gray-900" @click="open = false">
                    <?php echo e($item['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </nav>
<?php else: ?>
    <nav
        <?php echo e($attributes->merge(['class' => 'hidden md:flex md:ml-auto md:items-center md:text-base md:justify-center'])); ?>>
        <div class="relative mr-5" x-data="{ repairOpen: false }" @mouseenter="repairOpen = true"
            @mouseleave="repairOpen = false">
            <button type="button" class="hover:text-gray-900 cursor-pointer inline-flex items-center gap-1"
                @click="repairOpen = !repairOpen">
                <span>Ремонт</span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': repairOpen }" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="absolute left-0 top-full pt-2 w-56 z-50" x-show="repairOpen" x-transition x-cloak>
                <div class="rounded-md border border-gray-200 bg-white shadow-lg py-2">
                    <?php $__currentLoopData = $repairItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repairItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($repairItem['href']); ?>" class="block px-4 py-2 hover:text-gray-900">
                            <?php echo e($repairItem['label']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($item['href']); ?>" class="mr-5 hover:text-gray-900"><?php echo e($item['label']); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/ui/nav.blade.php ENDPATH**/ ?>