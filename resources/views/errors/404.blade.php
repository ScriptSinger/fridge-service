<x-layouts.app title="Страница не найдена" description="Запрашиваемая страница не найдена." :noindex="true">
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-16 md:py-24 items-center justify-center flex-col text-center">

            <div class="relative w-64 sm:w-[22rem] mb-10">
                <svg viewBox="0 0 320 380" class="w-full h-auto drop-shadow-xl" role="img" aria-label="Сломанная стиральная машина">
                    <ellipse cx="160" cy="356" rx="108" ry="14" fill="#111827" opacity="0.08" />

                    <rect x="66" y="330" width="22" height="20" rx="4" fill="#9ca3af" />
                    <rect x="232" y="330" width="22" height="20" rx="4" fill="#9ca3af" />

                    <rect x="40" y="36" width="240" height="300" rx="26" fill="#f3f4f6" stroke="#d1d5db"
                        stroke-width="3" />

                    <path d="M40 62 a26 26 0 0 1 26 -26 h188 a26 26 0 0 1 26 26 v46 h-240 z" fill="#111827" />

                    <rect x="60" y="46" width="72" height="34" rx="6" fill="#052e16" />
                    <text x="96" y="70" text-anchor="middle" font-family="ui-monospace, SFMono-Regular, Menlo, monospace"
                        font-size="22" font-weight="700" fill="#4ade80" class="animate-pulse">404</text>

                    <g>
                        <circle cx="164" cy="63" r="13" fill="#374151" stroke="#4b5563" stroke-width="2" />
                        <rect x="162" y="52" width="4" height="9" rx="2" fill="#facc15" />
                    </g>
                    <g>
                        <circle cx="202" cy="63" r="13" fill="#374151" stroke="#4b5563" stroke-width="2" />
                        <rect x="200" y="52" width="4" height="9" rx="2" fill="#9ca3af" />
                    </g>

                    <circle cx="238" cy="63" r="6" fill="#f59e0b" />

                    <circle cx="160" cy="228" r="98" fill="#d1d5db" />
                    <circle cx="160" cy="228" r="98" fill="none" stroke="#9ca3af" stroke-width="4" />
                    <circle cx="160" cy="228" r="80" fill="#1f2937" />
                    <path d="M96 178 a90 90 0 0 1 70 -38" fill="none" stroke="#374151" stroke-width="10"
                        stroke-linecap="round" opacity="0.6" />

                    <g stroke="#e5e7eb" stroke-width="4" stroke-linecap="round">
                        <line x1="122" y1="205" x2="140" y2="223" />
                        <line x1="140" y1="205" x2="122" y2="223" />
                        <line x1="180" y1="205" x2="198" y2="223" />
                        <line x1="198" y1="205" x2="180" y2="223" />
                    </g>
                    <path d="M128 260 q32 26 64 0" fill="none" stroke="#e5e7eb" stroke-width="5"
                        stroke-linecap="round" />

                    <g stroke="#f9fafb" stroke-width="2" opacity="0.8">
                        <line x1="216" y1="176" x2="236" y2="158" />
                        <line x1="222" y1="184" x2="248" y2="176" />
                        <line x1="212" y1="192" x2="230" y2="200" />
                    </g>

                    <path d="M248 18 L231 40 L240 40 L234 53 L253 30 L244 30 Z" fill="#f59e0b" />
                </svg>
            </div>

            <p class="uppercase tracking-[0.2em] text-base sm:text-lg font-bold text-yellow-600 mb-4">Ошибка 404</p>
            <h1 class="title-font text-2xl sm:text-3xl font-medium text-gray-900 mb-6">Эта страница сломалась</h1>
            <p class="mb-8 leading-relaxed max-w-md">
                Такую страницу мы точно не чиним — но вот с техникой справляемся отлично.
            </p>
            <a href="{{ route('home') }}"
                class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg">
                На главную
            </a>
        </div>
    </section>
</x-layouts.app>
