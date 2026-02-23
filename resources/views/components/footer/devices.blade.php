<x-ui.footer.column title="НАШИ УСЛУГИ">
    <ul class="list-none mb-10">
        @foreach ($devices as $device)
            @continue(!$device->slug)
            <li>
                <a href="{{ route('devices.show', $device->slug) }}" class="text-gray-600 hover:text-gray-800">
                    {{ $device->permalink }}
                </a>
            </li>
        @endforeach
    </ul>
</x-ui.footer.column>
