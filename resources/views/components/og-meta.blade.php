    <meta property="og:title" content="{{ $metadata['title'] }}" />
    <meta property="og:type" content="{{ $metadata['type'] }}" />
    <meta property="og:url" content="{{ $metadata['url'] }}" />
@if($metadata['image'] !== '')
    <meta property="og:image" content="{{ $metadata['image'] }}" />
@endif
