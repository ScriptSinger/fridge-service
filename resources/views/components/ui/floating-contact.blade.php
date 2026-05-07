@php
    $phoneTel = config('contacts.phone_tel');
    $phoneDisplay = config('contacts.phone_display');
    $telegramUrl = config('contacts.telegram_url');
    $telegramHref = $telegramUrl
        ? (preg_match('/^https?:\/\//i', $telegramUrl)
            ? $telegramUrl
            : 'https://t.me/' . ltrim($telegramUrl, '@/'))
        : null;
    $whatsappTel = config('contacts.whatsapp_tel') ?: $phoneTel;

    $channels = array_values(
        array_filter(
            [
                [
                    'key' => 'telegram',
                    'label' => 'Telegram',
                    'href' => $telegramHref,
                    'class' => 'bg-[#229ED9] text-white hover:bg-[#1f8fc7]',
                    'icon' => 'heroicon-o-paper-airplane',
                ],
                [
                    'key' => 'whatsapp',
                    'label' => 'WhatsApp',
                    'href' => $whatsappTel ? 'https://wa.me/' . preg_replace('/\D+/', '', $whatsappTel) : null,
                    'class' => 'bg-[#25D366] text-white hover:bg-[#20bf5a] ring-[#25D366]/20 shadow-[0_14px_30px_-14px_rgba(37,211,102,0.42),0_8px_18px_-14px_rgba(0,0,0,0.22)]',
                    'icon' => 'assets/images/svg/whatsapp.svg',
                ],
                [
                    'key' => 'phone',
                    'label' => $phoneDisplay,
                    'href' => $phoneTel ? 'tel:' . $phoneTel : null,
                    'class' => 'bg-gray-900 text-white hover:bg-gray-800',
                    'mobileOnly' => true,
                    'icon' => 'heroicon-o-phone',
                ],
            ],
            fn($channel) => !empty($channel['href']),
        ),
    );
@endphp

<div x-data="{ open: false }" x-cloak @keydown.escape.window="open = false"
    class="fixed bottom-20 right-4 sm:bottom-24 sm:right-6 z-[60] " @click.outside="open = false">
    <div class="relative flex flex-col items-end gap-3">
        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-3 scale-95" id="floating-contact-menu"
            class="flex flex-col items-end gap-3 origin-bottom-right">
            @foreach ($channels as $channel)
                @if (!empty($channel['mobileOnly']))
                    <a href="{{ $channel['href'] }}" aria-label="{{ $channel['label'] }}"
                        title="{{ $channel['label'] }}"
                        class="flex h-14 w-14 items-center justify-center rounded-full shadow-xl ring-1 ring-black/5 transition duration-200 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-white md:hidden {{ $channel['class'] }}">
                        @if ($channel['icon'] === 'assets/images/svg/whatsapp.svg')
                            <img src="{{ asset($channel['icon']) }}" alt="" class="h-5 w-5" loading="lazy">
                        @else
                            <x-dynamic-component :component="$channel['icon']" class="h-5 w-5" />
                        @endif
                    </a>
                @else
                    <a href="{{ $channel['href'] }}" aria-label="{{ $channel['label'] }}"
                        title="{{ $channel['label'] }}"
                        class="flex h-14 w-14 items-center justify-center rounded-full shadow-xl ring-1 ring-black/5 transition duration-200 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-white {{ $channel['class'] }}">
                        @if ($channel['icon'] === 'assets/images/svg/whatsapp.svg')
                            <img src="{{ asset($channel['icon']) }}" alt="" class="h-5 w-5" loading="lazy">
                        @else
                            <x-dynamic-component :component="$channel['icon']" class="h-5 w-5" />
                        @endif
                    </a>
                @endif
            @endforeach
        </div>

        <button type="button" @click="open = !open" :aria-expanded="open.toString()"
            aria-controls="floating-contact-menu" aria-label="Связаться"
            class="group relative flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-yellow-500 text-white shadow-xl ring-1 ring-black/5 transition duration-200 hover:scale-105 hover:bg-yellow-600 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-white">
            <span
                class="absolute -left-24 hidden rounded-full bg-gray-900 px-3 py-1 text-xs font-semibold tracking-wide text-white shadow-lg group-hover:block group-focus-visible:block">
                Связаться
            </span>
            <x-heroicon-o-chat-bubble-left-right class="h-5 w-5 transition duration-200 group-hover:scale-110" />
        </button>
    </div>
</div>
