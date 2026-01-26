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
        <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Этапы ремонта</h2>
        <p class="lg:w-2/3 leading-relaxed text-base">Как правило, ремонт выполняется в день обращения</p>
    </div>

    <div class="flex flex-wrap w-full">
        <div class="lg:w-2/5 md:w-1/2 md:pr-10 md:py-6">
            <div class="flex relative pb-12">
                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                        </path>
                    </svg>
                </div>
                <div class="flex-grow pl-4">
                    <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Оставляете
                        заявку
                    </h2>
                    <p class="leading-relaxed">Заполните форму или позвоните — уточним детали и время.</p>
                </div>
            </div>

            <div class="flex relative pb-12">
                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d=" M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125
                                 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3
                                 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0
                                 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554
                                 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0
                                 0h-12"></path>
                    </svg>
                </div>
                <div class="flex-grow pl-4">
                    <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Выезд мастера
                    </h2>
                    <p class="leading-relaxed">Специалист приезжает в удобное время.</p>
                </div>
            </div>

            <div class="flex relative pb-12">
                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z">
                        </path>
                    </svg>
                </div>
                <div class="flex-grow pl-4">
                    <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">
                        Диагностика и согласование стоимости</h2>
                    <p class="leading-relaxed">Мастер определяет причину поломки и согласует цену.</p>
                </div>
            </div>

            <div class="flex relative pb-12">
                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                </div>
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495">
                        </path>
                    </svg>
                </div>
                <div class="flex-grow pl-4">
                    <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Ремонт на
                        месте
                    </h2>
                    <p class="leading-relaxed">Проводится ремонт с учётом нужных запчастей.</p>
                </div>
            </div>

            <div class="flex relative">
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                        <path d="M22 4L12 14.01l-3-3"></path>
                    </svg>
                </div>
                <div class="flex-grow pl-4">
                    <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">Проверка
                        результата и гарантия</h2>
                    <p class="leading-relaxed">Клиент принимает работу, получает гарантию.</p>
                </div>
            </div>
        </div>
        <img class="lg:w-3/5 md:w-1/2 object-cover object-center rounded-lg md:mt-0 mt-12"
            src="<?php echo e(asset('assets/images/steps.png')); ?>" alt="steps">
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
<?php /**PATH /var/www/html/resources/views/components/sections/home/steps.blade.php ENDPATH**/ ?>