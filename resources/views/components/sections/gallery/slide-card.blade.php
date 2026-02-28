<template x-for="(slide, index) in slides" :key="index">
    <article class="relative shrink-0 border-r border-gray-200 last:border-r-0 cursor-zoom-in basis-full md:basis-1/2 lg:basis-1/3"
        data-card @click="openFullscreen(index)">

        <img :src="slide.image" :alt="slide.image_alt" :loading="index < 3 ? 'eager' : 'lazy'" decoding="async"
            :fetchpriority="index === 0 ? 'high' : 'low'" width="1200" height="800"
            class="h-64 w-full object-cover object-center md:h-72 lg:h-80">

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-3 md:p-6 lg:p-8 text-white">

            <p class="mb-1 text-[10px] font-medium tracking-widest text-yellow-400 md:text-sm" x-text="slide.subtitle"></p>

            <h3 class="text-yellow-400 mb-1 text-sm font-semibold md:text-base lg:text-lg line-clamp-2" x-text="slide.title"></h3>

            <p class="text-xs text-white/90 md:text-sm line-clamp-2" x-text="slide.description"></p>

        </div>
    </article>
</template>
