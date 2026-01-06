 <title>{{ $meta['title'] ?? 'Repair Center' }}</title>
 <meta name="description" content="{{ $meta['description'] ?? '' }}">
 <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">

 @if (!empty($meta['json_ld']))
     <script type="application/ld+json">
        {!! json_encode($meta['json_ld'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
    </script>
 @endif
