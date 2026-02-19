@props(['faqs'])

@php($items = collect($faqs)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="faq">
        <x-ui.sections.header title="Часто задаваемые вопросы"
            subtitle="Ответы на популярные вопросы о наших услугах по ремонту бытовой техники" />
        <div class="mx-auto mt-6">
            <div class="space-y-4">
                <div x-data="{ active: 0 }" class="space-y-4">
                    @foreach ($items as $index => $faq)
                        <div class="border-bottom rounded-lg">
                            <button @click="active === {{ $index }} ? active = null : active = {{ $index }}"
                                class="w-full flex justify-between items-center p-4 font-medium text-left text-gray-900 bg-gray-100 rounded-lg focus:outline-none cursor-pointer">
                                <span>{{ $faq->question }}</span>

                                <svg :class="{ 'rotate-180': active === {{ $index }} }"
                                    class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="active === {{ $index }}" x-collapse class="p-4 text-gray-700 bg-white">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-ui.sections.wrapper>
@endif
