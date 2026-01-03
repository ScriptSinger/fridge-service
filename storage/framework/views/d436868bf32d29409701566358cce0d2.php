<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal3c25fe26703cf045b6db5b371eaf8a5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3c25fe26703cf045b6db5b371eaf8a5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.hero','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3c25fe26703cf045b6db5b371eaf8a5a)): ?>
<?php $attributes = $__attributesOriginal3c25fe26703cf045b6db5b371eaf8a5a; ?>
<?php unset($__attributesOriginal3c25fe26703cf045b6db5b371eaf8a5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3c25fe26703cf045b6db5b371eaf8a5a)): ?>
<?php $component = $__componentOriginal3c25fe26703cf045b6db5b371eaf8a5a; ?>
<?php unset($__componentOriginal3c25fe26703cf045b6db5b371eaf8a5a); ?>
<?php endif; ?>


    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-wrap">
            <div class="flex flex-wrap -m-4">
                <div class="p-4 lg:w-1/2 md:w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                        <div
                            class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-8 h-8" viewBox="0 0 24 24">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Shooting Stars</h2>
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar
                                toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                            <a class="mt-3 text-yellow-500 inline-flex items-center">Learn More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-4 lg:w-1/2 md:w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                        <div
                            class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">The Catalyzer</h2>
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar
                                toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                            <a class="mt-3 text-yellow-500 inline-flex items-center">Learn More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($component)) { $__componentOriginal994f06ed14c12e0e0c537cf9d9942d9f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal994f06ed14c12e0e0c537cf9d9942d9f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.steps','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.steps'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal994f06ed14c12e0e0c537cf9d9942d9f)): ?>
<?php $attributes = $__attributesOriginal994f06ed14c12e0e0c537cf9d9942d9f; ?>
<?php unset($__attributesOriginal994f06ed14c12e0e0c537cf9d9942d9f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal994f06ed14c12e0e0c537cf9d9942d9f)): ?>
<?php $component = $__componentOriginal994f06ed14c12e0e0c537cf9d9942d9f; ?>
<?php unset($__componentOriginal994f06ed14c12e0e0c537cf9d9942d9f); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal95c1c9dfb3874b3efbc62512c1cba833 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95c1c9dfb3874b3efbc62512c1cba833 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pricing','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pricing'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95c1c9dfb3874b3efbc62512c1cba833)): ?>
<?php $attributes = $__attributesOriginal95c1c9dfb3874b3efbc62512c1cba833; ?>
<?php unset($__attributesOriginal95c1c9dfb3874b3efbc62512c1cba833); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95c1c9dfb3874b3efbc62512c1cba833)): ?>
<?php $component = $__componentOriginal95c1c9dfb3874b3efbc62512c1cba833; ?>
<?php unset($__componentOriginal95c1c9dfb3874b3efbc62512c1cba833); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal72bad77d1410e20f4512cbc04deb37d4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72bad77d1410e20f4512cbc04deb37d4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.blog','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.blog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72bad77d1410e20f4512cbc04deb37d4)): ?>
<?php $attributes = $__attributesOriginal72bad77d1410e20f4512cbc04deb37d4; ?>
<?php unset($__attributesOriginal72bad77d1410e20f4512cbc04deb37d4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72bad77d1410e20f4512cbc04deb37d4)): ?>
<?php $component = $__componentOriginal72bad77d1410e20f4512cbc04deb37d4; ?>
<?php unset($__componentOriginal72bad77d1410e20f4512cbc04deb37d4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal3df85818993e3c6c4ff45791ace105e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3df85818993e3c6c4ff45791ace105e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.contact','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3df85818993e3c6c4ff45791ace105e7)): ?>
<?php $attributes = $__attributesOriginal3df85818993e3c6c4ff45791ace105e7; ?>
<?php unset($__attributesOriginal3df85818993e3c6c4ff45791ace105e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3df85818993e3c6c4ff45791ace105e7)): ?>
<?php $component = $__componentOriginal3df85818993e3c6c4ff45791ace105e7; ?>
<?php unset($__componentOriginal3df85818993e3c6c4ff45791ace105e7); ?>
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