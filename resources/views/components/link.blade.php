@php
    $clases = "text-muted me-3";
@endphp


<a {{ $attributes->merge(['class' => $clases]) }}>
    {{ $slot }}
</a>