@props(['problem', 'device'])

<div {{ $attributes }}>
    <a href="{{ route('problems.show', [$device, $problem->slug]) }}"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full flex flex-col transition hover:border-yellow-300">
        <div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-3">
                {{ $problem->title }}
            </h2>
            @if ($problem->subtitle)
                <p class="text-gray-700 leading-6">
                    {{ $problem->subtitle }}
                </p>
            @endif
        </div>
    </a>
</div>
