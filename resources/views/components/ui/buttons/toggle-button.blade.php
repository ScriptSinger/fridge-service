<button
    {{ $attributes->merge(['class' => 'flex text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer']) }}>
    {{ $slot }}
</button>
