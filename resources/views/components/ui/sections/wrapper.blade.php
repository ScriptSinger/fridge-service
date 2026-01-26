<section {{ $attributes->merge(['class' => 'body-font text-gray-600']) }}>
    <div {{ $attributes->class(['container mx-auto px-5 py-10 md:py-24']) }}>
        {{ $slot }}
    </div>
</section>
