<div {{ $attributes->merge(['class' => 'xl:w-1/3 md:w-1/2 p-4']) }}>
    <div class="border border-gray-200 p-6 rounded-lg h-full">
        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $problem->h1 }}</h2>
        <p class="leading-relaxed text-base">
            {{ strip_tags($problem->content) }}
        </p>
    </div>
</div>
