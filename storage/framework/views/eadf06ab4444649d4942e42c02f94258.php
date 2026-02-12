<section id="contact" class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
        <div
            class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
            <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0"
                marginwidth="0" scrolling="no"
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1540.771020021799!2d56.115043209886295!3d54.77974630766362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2suk!4v1767811688709!5m2!1sru!2suk"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" width="600" height="450" style="border:0;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
            <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                <div class="lg:w-1/2 px-6">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">Адрес</h2>
                    <p class="mt-1"><?php echo e(config('contacts.address_full')); ?></p>
                </div>
                <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">Телефон</h2>
                    <p class="leading-relaxed">
                        <?php if (isset($component)) { $__componentOriginal068cc96cf51f1c56d971e8c803681b29 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal068cc96cf51f1c56d971e8c803681b29 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.phone','data' => ['class' => 'mt-4 md:mt-0 text-gray-900 hover:text-yellow-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4 md:mt-0 text-gray-900 hover:text-yellow-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal068cc96cf51f1c56d971e8c803681b29)): ?>
<?php $attributes = $__attributesOriginal068cc96cf51f1c56d971e8c803681b29; ?>
<?php unset($__attributesOriginal068cc96cf51f1c56d971e8c803681b29); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal068cc96cf51f1c56d971e8c803681b29)): ?>
<?php $component = $__componentOriginal068cc96cf51f1c56d971e8c803681b29; ?>
<?php unset($__componentOriginal068cc96cf51f1c56d971e8c803681b29); ?>
<?php endif; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
            <?php if (isset($component)) { $__componentOriginal788b25b48ffcc6963c4a37549101363b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal788b25b48ffcc6963c4a37549101363b = $attributes; } ?>
<?php $component = App\View\Components\Forms\Leads::resolve(['model' => $model] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('forms.leads'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Forms\Leads::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full','idPrefix' => 'contact']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal788b25b48ffcc6963c4a37549101363b)): ?>
<?php $attributes = $__attributesOriginal788b25b48ffcc6963c4a37549101363b; ?>
<?php unset($__attributesOriginal788b25b48ffcc6963c4a37549101363b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal788b25b48ffcc6963c4a37549101363b)): ?>
<?php $component = $__componentOriginal788b25b48ffcc6963c4a37549101363b; ?>
<?php unset($__componentOriginal788b25b48ffcc6963c4a37549101363b); ?>
<?php endif; ?>
        </div>

    </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/sections/contact.blade.php ENDPATH**/ ?>