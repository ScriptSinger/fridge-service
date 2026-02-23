<x-ui.footer.column title="КОНТАКТЫ">
    <address class="not-italic">
        <ul class="list-none mb-10">
            <li>город {{ config('contacts.address_city') }}</li>
            <li><x-ui.phone class="text-gray-900 hover:text-yellow-600" /></li>
            <li>{{ config('contacts.opening_hours_display') }}</li>
        </ul>
    </address>
</x-ui.footer.column>
