@props(['class' => ''])

<nav {{ $attributes->merge(['class' => $class]) }}>
    <a href="#services" class="mr-5 hover:text-gray-900">Услуги</a>
    <a href="#pricing" class="mr-5 hover:text-gray-900">Цены</a>
    <a href="#blog" class="mr-5 hover:text-gray-900">Неисправности</a>
    <a href="#contact" class="mr-5 hover:text-gray-900">Контакты</a>
</nav>
