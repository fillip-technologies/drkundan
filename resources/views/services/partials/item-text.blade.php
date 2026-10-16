{{-- A section item's text, followed by a link when it points to a published catalog page. --}}
@php
    $target = $item['serviceId'] ? $catalog->find($item['serviceId']) : null;
    $href = $target ? $catalog->url($target) : null;
@endphp
{{ $item['text'] }}
@if ($href)
    <a href="{{ $href }}" class="ml-1 inline-flex items-center gap-1 font-semibold text-brand-600 hover:text-brand-700 whitespace-nowrap">
        {{ $target['title'] }} <i class="fa-solid fa-arrow-right text-[10px]" aria-hidden="true"></i>
    </a>
@endif
