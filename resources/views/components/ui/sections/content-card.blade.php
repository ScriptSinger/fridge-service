<div {{ $attributes }}>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full flex flex-col justify-between">
        <h2 class="text-lg text-gray-900 font-medium title-font mb-3">{{ $problem->h1 }}</h2>
        <p class="text-gray-700 leading-6">
            {{ strip_tags($problem->content) }}
        </p>
    </div>
</div>
