@props(['member'])

<article class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-start items-center gap-6">
        <div class="w-40 h-40 sm:w-44 sm:h-44 lg:w-48 lg:h-48 shrink-0 overflow-hidden rounded-2xl bg-gray-100">
            <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover" loading="lazy"
                decoding="async">
        </div>

        <div class="flex-1 min-w-0 text-center sm:text-left">
            <h3 class="text-2xl font-semibold text-gray-900">{{ $member['name'] }}</h3>
            <p class="mt-1 text-yellow-600 font-medium">{{ $member['role'] }}</p>
            <p class="mt-4 text-gray-700 leading-relaxed">{{ $member['description'] }}</p>
        </div>
    </div>
</article>
