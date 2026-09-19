<a href="tel:{{ config('contacts.phone_tel') }}" data-contact-channel="phone"
    {{ $attributes->merge(['class' => 'inline-flex items-center whitespace-nowrap']) }}>
    <span class="font-semibold whitespace-nowrap">{{ config('contacts.phone_display') }}</span>
</a>
