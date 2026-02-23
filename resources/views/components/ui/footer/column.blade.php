<div class="{{ $class ?? 'lg:w-1/4 md:w-1/2 w-full px-4' }}">
    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">
        {{ $title }}
    </h2>

    {{ $slot }}
</div>
